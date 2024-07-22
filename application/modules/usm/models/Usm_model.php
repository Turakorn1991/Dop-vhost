<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: sanitkeawtawan
 * Date: 6/16/2017 AD
 * Time: 20:28
 */
class Usm_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    private function _error($message, $data = array())
    {
        return array('error' => 1, 'message' => $message, 'data' => $data);
    }

    private function _success($message, $data = array())
    {
        return array('error' => 0, 'message' => $message, 'data' => $data);
    }

    function userById($id)
    {

        $query = $this->db
            ->select('*,std_prename.prename_th,org_title')
            ->from('usrm_user')
            ->join('std_prename', 'usrm_user.user_prename=std_prename.pren_code', 'left')
            ->join('usrm_org', 'usrm_user.org_id=usrm_org.org_id', 'left')
            ->where('usrm_user.user_id', $id)->get();
        $new = new stdClass();
        $row = $query->row();
        $new = $row;
        $new->last = true;
        $new->type = 'user';
        $new->parentId = 'org_'.$row->org_id;
        $new->iconCls = 'icon-user';
        list($y,$m,$d)=explode('-',$row->date_of_birth);
        $new->date_of_birth = "{$d}/{$m}/".($y+543);
        $new->id = 'user_' . $row->user_id;
        $new->title = $row->prename_th . "" . $row->user_firstname . " " . $row->user_lastname;
        return $new;
    }

    function userByOrg($org)
    {
        $rows = array();
        $query = $this->db
            ->select('*,std_prename.prename_th,org_title')
            ->from('usrm_user')
            ->join('std_prename', 'usrm_user.user_prename=std_prename.pren_code', 'left')
            ->join('usrm_org', 'usrm_user.org_id=usrm_org.org_id', 'left')
            ->where('usrm_user.org_id', $org)
            ->get();
        foreach ($query->result() as $row) {
            $new = new stdClass();
            $new = $row;
            $new->last = true;
            $new->type = 'user';
            $new->parentId = 'org_'.$org;
            list($y,$m,$d)=explode('-',$row->date_of_birth);
            $new->date_of_birth = "{$d}/{$m}/".($y+543);
            $new->iconCls = 'icon-user';
            $new->id = 'user_' . $row->user_id;
            $new->title = $row->prename_th . "" . $row->user_firstname . " " . $row->user_lastname;
            $rows[] = $new;
        }
        return $rows;
    }

    function orgAndUser($parent = 0)
    {
        $rows = array();
        $query = $this->db
            ->select('*')
            ->from('usrm_org')
            ->where('org_parent_id', $parent)
            ->order_by('org_sort','asc')
            ->get();
        foreach ($query->result() as $row) {
            $new = new stdClass();
            $new = $row;
            $new->type = 'org';
            $new->parentId = 'org_'.$row->org_parent_id;
            $new->id = 'org_' . $row->org_id;
            $new->title = $row->org_title;
            $new->iconCls = 'icon-org';
            $new->children = $this->orgAndUser($row->org_id);
            $new->last = false;
            if (!count($new->children)) {
                $new->last = true;
                $new->children = $this->userByOrg($row->org_id);
            } else {
                $users=$this->userByOrg($row->org_id);
                if($users){
                    $new->children =array_merge($new->children,$users);
                }

                $new->last = false;
            }
            $rows[] = $new;
        }
        return $rows;
    }

    function orgAll()
    {
        return $this->orgAndUser();
    }

    function create_org($data)
    {
        unset($data['org_id']);
         $data['org_sort']= $this->orgMax($data['org_parent_id']);
        if ($this->db->insert('usrm_org', $data)) {
            $new = (object)$data;
            $new->org_id = $this->db->insert_id();
            $new->children = array();
            $new->type = 'org';
            $new->id = 'org_' . $new->org_id;
            $new->title = $new->org_title;
            $new->iconCls = 'icon-org';
            $new->last = true;
            $new->children = array();
            return $this->_success('บันทึกข้อมูลเรียบร้อย', $new);
        } else {
            return $this->_error('บันทึกข้อมูลไม่สำเร็จกรุณาลองใหม่อีกครัง');
        }
    }

    function update_org($data)
    {
        if ($this->db->update('usrm_org', array('org_title' => $data['org_title']), array('org_id' => $data['org_id']))) {
            return $this->_success('บันทึกข้อมูลเรียบร้อย', array('org_title' => $data['org_title']));
        } else {
            return $this->_error('บันทึกข้อมูลไม่สำเร็จกรุณาลองใหม่อีกครัง');
        }
    }

    function remove_org($data)
    {
        $id[] = $data['org_id'];
        $this->idOrgAllChildren($data['org_id'], $id);
        if ($this->db->where_in('org_id', $id)->delete('usrm_org')) {
            return $this->_success('ลบข้อมูลเรียบร้อย');
        } else {
            return $this->_error('บันทึกข้อมูลไม่สำเร็จกรุณาลองใหม่อีกครัง');
        }
    }
    function remove_user($data)
    {
        $id = $data['user_id'];
        if ($this->db->where('user_id', $id)->delete('usrm_user')) {
            return $this->_success('ลบข้อมูลเรียบร้อย');
        } else {
            return $this->_error('บันทึกข้อมูลไม่สำเร็จกรุณาลองใหม่อีกครัง');
        }
    }

    function update_user($data)
    {
        $this->db->trans_begin();
        $this->db->set('pid', $data['pid']);
        $this->db->set('passcode', $data['passcode']);
        $this->db->set('user_prename', @$data['user_prename']);
        $this->db->set('user_firstname', @$data['user_firstname']);
        $this->db->set('user_lastname', @$data['user_lastname']);
        $this->db->set('user_gender', @$data['user_gender']);
        list($d,$m,$y)=explode('/',$data['date_of_birth']);
        $data['date_of_birth']= ($y-543)."-{$m}-{$d}";
        $this->db->set('date_of_birth', @$data['date_of_birth']);
        $this->db->set('user_position', @$data['user_position']);
        $this->db->set('tel_no', @$data['tel_no']);
        $this->db->set('email_addr', @$data['email_addr']);
        $this->db->set('org_id', @$data['org_id']);
        $this->db->set('user_photo_file', @$data['user_photo_file']);
        $this->db->set('active_status', (@$data['active_status'] == 'Active') ? "Active" : "Inactive");
        if ($data['user_id']) {// on update
            $this->db->set('update_user_id', '');
            $this->db->set('update_org_id', '');
            $this->db->set('update_datetime', date('Y-m-d H:i:s'));
            $this->db->where('user_id', $data['user_id']);
            $this->db->update('usrm_user');
            $user_id=$data['user_id'];
        } else {
            $this->db->set('user_id', $data['user_id']);
            $this->db->set('insert_user_id', '');
            $this->db->set('insert_org_id', '');
            $this->db->set('insert_datetime', date('Y-m-d H:i:s'));
            $this->db->insert('usrm_user');
            $user_id=$this->db->insert_id();
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return $this->_error('บันทึกข้อมูลไม่สำเร็จกรุณาลองใหม่อีกครัง');
        } else {
            $this->db->where('user_id', $user_id)->delete('usrm_permission');
            if (is_array(@$data['permit'])) {

                $insert = array();
                foreach ($data['permit'] as $appid) {
                    $insert[] = array(
                        'user_id' => $user_id,
                        'app_id' => $appid,
                        'perm_status' => 'Yes'
                    );
                }
                $this->db->insert_batch('usrm_permission', $insert);

            $grp_id =  @$data['user_position'];
            if(isset($grp_id)){
                $grp_info = $this->temp_permission($grp_id);
                foreach($grp_info as $i => $row){
                         $update_view['perm_view']   =  $row->perm_view ;
                }
                $this->common_model->update('usrm_permission',$update_view,array('user_id'=>$user_id));

            }
            $this->db->trans_commit();
            $user=$this->userById($user_id);
            return $this->_success('บันทึกข้อมูลเรียบร้อย',$user);
            }
        }
    }


    function idOrgAllChildren($id, &$ids)
    {
        $query = $this->db
            ->select('*')
            ->from('usrm_org')
            ->where('org_parent_id', $id)
            ->get();
        foreach ($query->result() as $row) {
            $ids[] = $row->org_id;
            $this->idOrgAllChildren($row->org_id, $ids);
        }
    }

    function prename($q = "")
    {
        $query = $this->db
            ->select('*')
            ->from('std_prename')
            ->like('prename_th', $q, 'both')
            ->limit(20)
            ->get();
        return $query->result();
    }

    function template()
    {
        $data = array();
        $query = $this->db
            ->select('*')
            ->from('usrm_grp')
            ->get();
        foreach ($query->result() as $row) {
            $new = new stdClass();
            $new = $row;
            $new->permission = $this->temp_permission($row->grp_id);
            $data[] = $new;

        }

        return $data;
    }

    function temp_permission($grp_id)
    {
        $query = $this->db
            ->select('*')
            ->from('usrm_grp_permission')
            ->where('grp_id', $grp_id)
            ->get();
        return $query->result();
    }

    function app_permission($app, $user)
    {
        $count = $this->db
            ->select('*')
            ->from('usrm_permission')
            ->where('user_id', $user)
            ->where('app_id', $app)
            ->where('perm_status', 'Yes')
            ->count_all_results();
        return ($count) ? true : false;
    }

    function application($parent, $user)
    {
        $data = array();
        $query = $this->db
            ->select('app_id as id,app_name as text,app_parent_id as parent')
            ->from('usrm_application')
            ->where('app_parent_id', $parent)
            ->order_by('app_sort')
            ->get();
        foreach ($query->result() as $row) {
            $new = new stdClass();
            $new = $row;
            $new->iconCls = 'icon-none';
            $new->checked = $this->app_permission($row->id, $user);
            $new->children = $this->application($row->id, $user);
            $data[] = $new;
        }
        return $data;
    }

    function user_permission($user)
    {
        return $this->application(0, $user);
    }

    function user_permissionWithoutChildren($user, $exludeChildrenOf) {
        $data = $this->application(0, $user);
        foreach($data as $i => $row)
            if (in_array($row->id, $exludeChildrenOf))
                unset($data[$i]->children);
        return $data;
    }

    function  move($data){

        $this->db->trans_begin();
        if($data['from_type']==$data['to_type']){
            if($data['from_type']=='org'&&$data['action']=='append'){//update org org_parent_id
                $this->db->set('org_parent_id', $data['to_id'])
                    ->where('org_id', $data['from_id'])
                    ->update('usrm_org');
            }
            elseif($data['from_type']=='org'){//update org org_parent_id and order
                if($data['from_parent']!=$data['to_parent']){
                    $this->db
                        ->set('org_parent_id', $data['to_parent'])
                       // ->set('org_order',$order)
                        ->where('org_id', $data['from_id'])
                        ->update('usrm_org');
                }
            }
        }
        elseif($data['from_type']=="user"&&$data['to_type']=="org")
        {//update user org_id
            $this->db->set('org_id', $data['to_id'])
                ->where('user_id', $data['from_id'])
                ->update('usrm_user');
        }
        if(is_array($data['org_ar'])){
            foreach ($data['org_ar'] as $org){
                $this->db->set('org_sort',$org['order'])->where('org_id',$org['id'])->update('usrm_org');
            }
        }
        if(is_array($data['user_ar'])){
            foreach ($data['user_ar'] as $user){

            }
        }
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return $this->_error('บันทึกข้อมูลไม่สำเร็จ');
        }else{
                $this->db->trans_commit();
                return $this->_success('บันทึกข้อมูลเรียบร้อย');
        }
    }
    function orgMax($id){
        $result= $this->db->select('*')
            ->from('usrm_org')
            ->where('org_parent_id',$id)
            ->order_by('org_sort')
            ->get();
        if($result){
            $row=$result->row();
            return $row->org_sort+1;
        }
        return 0;
    }

}
