<?php
class School_model extends CI_Model
{
    public $column_search = array(); //set column field database for datatable searchable

    public $order = array('insert_datetime' => 'DESC', 'update_datetime', 'DESC'); // default order
    public function __construct()
    {
        parent::__construct();
    }

    public function getAll_schlInfo()
    {
        return $this->common_model->custom_query("SELECT * FROM schl_info WHERE delete_user_id IS NULL AND (delete_datetime IS NULL || delete_datetime = '0000-00-00 00:00:00')");
    }

    public function get_filteredSchoolList()
    {
        $this->db->select(
            'a.*,
            ifnull(models_count, 0) models_count,
            datediff(now(), update_datetime) last_update,
            d.area_name_th province,
            ifnull(gens_count, 0) gens_count,
            ifnull(students_count, 0) students_count'
        )
            ->from('schl_info a')
            ->join('(
                select count(schl_id) models_count, schl_id
                from schl_model
                where delete_user_id is null and delete_datetime is null
                group by schl_id
            ) b', 'a.schl_id=b.schl_id', 'left')
            ->join('(
                select c1.schl_id, gens_count
                from schl_edu_generation c1
                join (
                    select schl_id, count(schl_id) gens_count, max(last_date_of_edu) last_edu_date
                    from schl_edu_generation
                    where delete_user_id is null and delete_datetime is null
                    group by schl_id
                ) c2 on c1.schl_id=c2.schl_id and c1.last_date_of_edu=last_edu_date
            ) c', 'a.schl_id=c.schl_id', 'left')
            ->join('std_area d', 'a.addr_province=d.area_code', 'left')
            ->join('(
                select schl_id, count(stud_id) students_count
                from schl_edu_student
                group by schl_id
            ) e', 'a.schl_id=e.schl_id', 'left')
            ->where(array('delete_user_id' => null, 'delete_datetime' => null));

        if ($this->input->post('schl_name')) {
            $this->db->like('schl_name', $this->input->post('schl_name'), 'both');
        }
        if ($this->input->post('addr_province')) {
            $this->db->where('addr_province', $this->input->post('addr_province'));
        }
        if ($this->input->post('year_of_established_from')) {
            $this->db->where('year_of_established>=', $this->input->post('year_of_established_from'));
        }
        if ($this->input->post('year_of_established_to')) {
            $this->db->where('year_of_established<=', $this->input->post('year_of_established_to'));
        }
        if ($this->input->post('models_count')) {
            $modelsCount = explode(',', $this->input->post('models_count'));
            $this->db->where('models_count>', $modelsCount[0]);
            $this->db->where('models_count<=', $modelsCount[1]);
        }
        if ($this->input->post('schl_status')) {
            $this->db->where('schl_status', $this->input->post('schl_status'));
        }
        // die($this->db->get_compiled_select());

        return $this->db->get()->result_array();
    }

    public function insertBatch_studentList($batch)
    {
        $this->db->insert_batch('schl_edu_student', $batch);
    }

    public function insertBatch_schoolModels($batch)
    {
        $this->db->insert_batch('schl_model', $batch);
    }

    public function delete_schoolModels($where)
    {
        $this->db->update('schl_model', array(
            'delete_user_id' => get_session('user_id'),
            'delete_org_id' => get_session('org_id'),
        ), $where);
    }

    public function get_studentsInGeneration($gen_id)
    {
        return $this->db->join('std_gender b', 'a.gender_code=b.gender_code', 'left')
            ->select('a.*,b.gender_name as gender')
            ->order_by('stud_id', 'asc')
            ->get_where('schl_edu_student a', array('gen_id' => $gen_id))
            ->result_array();
    }

    public function get_rawSchoolEvaluations($schl_id)
    {
        return $this->db->get_where('schl_model', array('schl_id' => $schl_id, 'delete_user_id' => null))->result_array();
    }

    public function get_groupSchoolEvaluations($schl_id)
    {
        return $this->db->select('insert_datetime, count(insert_id) as n')
            ->group_by('insert_datetime')
            ->order_by('insert_datetime', 'desc')
            ->get_where('schl_model', array('schl_id' => $schl_id, 'mdl_result' => 'มี', 'delete_user_id' => null))
            ->result_array();
    }

    //add code -----------------------------------------
    public function get_schlInfo_byqlcid($qlc_id)
    {
        return $this->common_model->custom_query("SELECT * FROM schl_info WHERE qlc_id = {$qlc_id} AND delete_user_id IS NULL AND (delete_datetime IS NULL || delete_datetime = '0000-00-00 00:00:00')");
    }
    //--------------------------------------------------

    public function getAll_generationInfo($schl_id = 0)
    {
        return $this->common_model->custom_query("SELECT * FROM schl_edu_generation WHERE schl_id = {$schl_id}");
    }

    public function edit_generationID($gen_id = 0)
    {
        return $this->common_model->query("SELECT * FROM schl_edu_generation WHERE gen_id = {$gen_id}")->row_array();
    }

    public function edit_gduID($gen_id = 0)
    {
        return $this->common_model->custom_query("SELECT * FROM schl_info_edu WHERE gen_id = {$gen_id}");
    }

    public function get_student($schl_id = 0, $gen_id = 0)
    {
        return $this->common_model->custom_query("SELECT * FROM schl_info_student LEFT JOIN pers_info ON schl_info_student.pers_id = pers_info.pers_id WHERE schl_info_student.schl_id = {$schl_id} AND schl_info_student.gen_id = {$gen_id}");
    }

    public function getOnce_schlInfo($schl_id = 0)
    {
        return rowArray($this->common_model->custom_query("SELECT * FROM schl_info WHERE schl_id = {$schl_id}"));
    }

    public function get_img($schl_id = 0)
    {
        return $this->common_model->custom_query("SELECT * FROM schl_info_photo WHERE schl_id = {$schl_id}");

    }

    //add code -----------------------------------------
    /* public function get_schl_photo_album($id = ''){
    if ($id != ''){
    $query = $this->common_model->custom_query("SELECT     b.album_id            as al_album_id,
    b.album_title        as al_album_title,
    b.album_description    as al_album_description,
    b.schl_id            as al_schl_id,
    b.insert_user_id    as al_insert_user_id,
    b.insert_org_id        as al_insert_org_id,
    b.insert_datetime    as al_insert_datetime,
    b.update_user_id    as al_update_user_id,
    b.update_org_id        as al_update_org_id,
    b.update_datetime    as al_update_datetime,
    b.delete_user_id    as al_delete_user_id,
    b.delete_org_id        as al_delete_org_id,
    b.delete_datetime   as al_delete_datetime,
    a.photo_id             as ph_photo_id,
    a.photo_title         as ph_photo_title,
    a.schl_id             as ph_schl_id,
    a.photo_file_name     as ph_photo_file_name,
    a.photo_thumbnail     as ph_photo_thumbnail,
    a.photo_description as ph_photo_description,
    a.album_id             as ph_album_id,
    a.insert_user_id     as ph_insert_user_id,
    a.insert_org_id     as ph_insert_org_id,
    a.insert_datetime     as ph_insert_datetime,
    a.update_user_id     as ph_update_user_id,
    a.update_org_id     as ph_update_org_id,
    a.update_datetime     as ph_update_datetime,
    a.delete_user_id     as ph_delete_user_id,
    a.delete_org_id     as ph_delete_org_id,
    a.delete_datetime     as ph_delete_datetime
    FROM schl_photo a
    JOIN schl_photo_album b
    ON a.album_id = b.album_id
    where b.schl_id = {$id} and a.schl_id = {$id} and a.insert_datetime not like '' and a.insert_datetime is not null and a.delete_user_id IS NULL AND (a.delete_datetime IS NULL || a.delete_datetime = '0000-00-00 00:00:00')
    order by a.photo_id ASC, a.insert_datetime ASC, a.photo_title ASC;");
    $data = $query->row_array(); //error this line
    return $data;
    }else{
    return $this->common_model->custom_query("SELECT b.album_id            as al_album_id,
    b.album_title        as al_album_title,
    b.album_description    as al_album_description,
    b.schl_id            as al_schl_id,
    b.insert_user_id    as al_insert_user_id,
    b.insert_org_id        as al_insert_org_id,
    b.insert_datetime    as al_insert_datetime,
    b.update_user_id    as al_update_user_id,
    b.update_org_id        as al_update_org_id,
    b.update_datetime    as al_update_datetime,
    b.delete_user_id    as al_delete_user_id,
    b.delete_org_id        as al_delete_org_id,
    b.delete_datetime   as al_delete_datetime,
    a.photo_id             as ph_photo_id,
    a.photo_title         as ph_photo_title,
    a.schl_id             as ph_schl_id,
    a.photo_file_name     as ph_photo_file_name,
    a.photo_thumbnail     as ph_photo_thumbnail,
    a.photo_description as ph_photo_description,
    a.album_id             as ph_album_id,
    a.insert_user_id     as ph_insert_user_id,
    a.insert_org_id     as ph_insert_org_id,
    a.insert_datetime     as ph_insert_datetime,
    a.update_user_id     as ph_update_user_id,
    a.update_org_id     as ph_update_org_id,
    a.update_datetime     as ph_update_datetime,
    a.delete_user_id     as ph_delete_user_id,
    a.delete_org_id     as ph_delete_org_id,
    a.delete_datetime     as ph_delete_datetime
    FROM schl_photo a
    JOIN schl_photo_album b
    ON a.album_id = b.album_id
    WHERE delete_user_id IS NULL AND (delete_datetime IS NULL || delete_datetime = '0000-00-00 00:00:00')");
    }
    } */
    //--------------------------------------------------

    // std_school_model
    public function get_std_model()
    {
        return $this->common_model->custom_query("SELECT * FROM std_model_school");
    }

    public function edit_std_model($schl_id)
    {
        return $this->common_model->custom_query("SELECT * FROM schl_model WHERE schl_id= {$schl_id}");
    }

    public function get_diffTrouble($diff_id = '')
    {
        $tmp = array();
        $tmp = $this->common_model->get_where_custom('diff_trouble', 'diff_id', $diff_id);
        $tmp = sort_array_with($tmp, 'trb_code');
        return $tmp;
    }
    public function get_diffHelp($diff_id = '')
    {
        $tmp = array();
        $tmp = $this->common_model->get_where_custom('diff_help', 'diff_id', $diff_id);
        $tmp = sort_array_with($tmp, 'help_code');
        return $tmp;
    }
    public function get_diffHelpGuide($diff_id = '')
    {
        $tmp = array();
        $tmp = $this->common_model->get_where_custom('diff_help_guide', 'diff_id', $diff_id);
        $tmp = sort_array_with($tmp, 'help_guide_code');
        return $tmp;
    }

/*        public function getOnce_diffInfo($diff_id=0) {
return rowArray($this->common_model->get_where_custom('diff_info', 'diff_id', $diff_id));
}
 */

    public function getAll_reqChanel()
    {
        return $this->common_model->getTableOrder('std_req_channel', 'chn_id', 'ASC');
    }

    public function getOnce_reqChanel($chn_code = '')
    {
        return rowArray($this->common_model->get_where_custom('std_edu_level', 'chn_code', $chn_code));
    }

    public function get_std_schl_course($crse_id = '')
    {
        return $this->common_model->query("SELECT * FROM std_schl_course WHERE crse_id ={$crse_id}")->row_array();

    }

    public function getAll_CenterInfo($id = '')
    {
        if ($id != '') {
            $query = $this->common_model->query("SELECT * FROM qlc_info WHERE qlc_id ={$id} AND delete_user_id IS NULL AND (delete_datetime IS NULL || delete_datetime = '0000-00-00 00:00:00')");

            $data = $query->row_array();
            return $data;
        } else {
            return $this->common_model->custom_query("SELECT * FROM qlc_info WHERE delete_user_id IS NULL AND (delete_datetime IS NULL || delete_datetime = '0000-00-00 00:00:00')");
        }

    }

    //add code------------------------------------
    public function getAll_CenterCoordinator($id = '')
    {
        if ($id != '') {
            $query = $this->common_model->query("SELECT * FROM qlc_coordinator WHERE qlc_id ={$id} AND delete_user_id IS NULL AND (delete_datetime IS NULL || delete_datetime = '0000-00-00 00:00:00')");

            $data = $query->row_array();
            return $data;
        } else {
            return $this->common_model->custom_query("SELECT * FROM qlc_coordinator WHERE delete_user_id IS NULL AND (delete_datetime IS NULL || delete_datetime = '0000-00-00 00:00:00')");
        }

    }

    public function getAll_CenterAgency($id = '')
    {
        if ($id != '') {
            $query = $this->common_model->query("SELECT * FROM qlc_agency WHERE qlc_id ={$id} AND delete_user_id IS NULL AND (delete_datetime IS NULL || delete_datetime = '0000-00-00 00:00:00')");

            $data = $query->row_array();
            return $data;
        } else {
            return $this->common_model->custom_query("SELECT * FROM qlc_agency WHERE delete_user_id IS NULL AND (delete_datetime IS NULL || delete_datetime = '0000-00-00 00:00:00')");
        }

    }

    public function getAll_CenterAgencyCoordinator($id = '')
    {
        if ($id != '') {
            $query = $this->common_model->query("SELECT * FROM qlc_agency_coordinator a INNER JOIN qlc_agency b ON a.qlc_agency_id = b.qlc_agency_id WHERE b.qlc_id ={$id} AND a.delete_user_id IS NULL AND (a.delete_datetime IS NULL || a.delete_datetime = '0000-00-00 00:00:00')");

            $data = $query->row_array();
            return $data;
        } else {
            return $this->common_model->custom_query("SELECT * FROM qlc_agency_coordinator WHERE delete_user_id IS NULL AND (delete_datetime IS NULL || delete_datetime = '0000-00-00 00:00:00')");
        }

    }
    //--------------------------------------------

    private function _get_datatables_query()
    {
        /*$this->db->select("*");
        $this->db->from('qlc_info');
        $this->db->order_by('qlc_id DESC');*///do new filter : ซ่อน query

        // $this->db->join('pers_info as C', 'A.req_pers_id=C.pers_id', 'left');

        $user_id = get_session('user_id');
        $app_id = 59;
        $usrpm = $this->admin_model->chkOnce_usrmPermiss($app_id, $user_id);

        if ($_POST['columns'][7][search][value]) {
            /*=== do new filter : start code ===*/
            //$this->db->distinct();
            $this->db->select("A.*, E.qlc_id, E.maxdatetime, F.score");
            //$this->db->select("A.*");
            $this->db->from('qlc_info as A'); //do new filter : qlc_info
            $this->db->join('std_area as B', 'A.addr_province=B.area_code', 'left'); //do new filter : four_regions/province
            //as C //do new filter : province
            $this->db->join('std_area as D', 'A.addr_district=D.area_code', 'left'); //do new filter : amphur
            $this->db->join('(select qlc_id, max(insert_datetime)  as maxdatetime
                                    FROM qlc_kpi
                                    group by qlc_id) as E',
                'A.qlc_id=E.qlc_id', 'inner'); //do new filter : grade
            $this->db->join('(select qlc_id, insert_datetime, COUNT(IF(SUBSTRING(qlc_kpi_code, 1 , 2) = "02",1, NULL)) as score
                                    FROM qlc_kpi
                                    group by qlc_id, insert_datetime) as F',
                'E.maxdatetime=F.insert_datetime', 'inner'); //do new filter : grade

            //$this->db->order_by('A.qlc_id DESC');
        } else {
            /*=== do new filter : start code ===*/
            //$this->db->distinct();
            // $this->db->select("A.*, E.qlc_id, E.maxdatetime, F.score");
            $this->db->select("A.*");
            $this->db->from('qlc_info as A'); //do new filter : qlc_info
            $this->db->join('std_area as B', 'A.addr_province=B.area_code', 'left'); //do new filter : four_regions/province
            //as C //do new filter : province
            $this->db->join('std_area as D', 'A.addr_district=D.area_code', 'left'); //do new filter : amphur
            /*$this->db->join('(select qlc_id, max(insert_datetime)  as maxdatetime
            FROM db_center.qlc_kpi
            group by qlc_id) as E',
            'A.qlc_id=E.qlc_id', 'inner'); //do new filter : grade
            $this->db->join('(select qlc_id, insert_datetime, count(*) as score
            FROM db_center.qlc_kpi
            group by qlc_id, insert_datetime) as F',
            'E.maxdatetime=F.insert_datetime', 'inner'); //do new filter : grade
             */
            //$this->db->order_by('A.qlc_id DESC');
        }
        /*=== do new filter : end code ===*/

        if ($usrpm['perm_view'] == 'All') { //เห็นข้อมูลทั้งหมด
            $this->db->where("(A.delete_user_id IS NULL AND A.delete_datetime IS NULL)");
        } else if ($usrpm['perm_view'] == 'Organization') { //เห็นข้อมูลเฉพาะองค์กรของตนเองเท่านั้น
            $this->db->where("(A.delete_user_id IS NULL AND A.delete_datetime IS NULL) AND A.insert_org_id=" . get_session('org_id'));

        } else if ($usrpm['perm_view'] == 'Person') { //เห็นข้อมูลเฉพาะของตนเองเท่านั้น
            $this->db->where("(A.delete_user_id IS NULL AND A.delete_datetime IS NULL) AND A.insert_user_id=" . get_session('user_id'));
        }

        /*=== start foreach filter ===*/
        foreach ($_POST['columns'] as $colId => $col) {
            if ($col['search']['value']) // if datatable send POST for search
            {
                /*$arr = @explode('/', $col['search']['value']);
                if(count($arr) > 2){
                $this->db->like($col['name'], dateChange($col['search']['value'],0));
                // $this->db->like($col['name'], $col['search']['value']);
                // dieFont(dateChange($col['search']['value'],1));
                }else{
                $this->db->like($col['name'], $col['search']['value']);
                }*///do new filter : ซ่อน query

                /*=== do new filter : start code ===*/

                if ($col['name'] == 'B.four_regions') { //do new filter : four_regions

                    $this->db->where('B.four_regions', $col['search']['value']);

                } else if ($col['name'] == 'B.area_code') { //do new filter : Province

                    $this->db->where('B.area_code', $col['search']['value']);

                } else if ($col['name'] == 'D.area_code') { //do new filter : Amphur

                    $Amphur = $col['search']['value'];
                    $this->db->where("(D.area_code like '$Amphur')");

                } else if ($col['name'] == 'A.year_of_sponsorship') { //do new filter :Start Year of Sponsorship

                    $Year = $col['search']['value'];
                    $this->db->where("(A.year_of_sponsorship >= $Year)");

                } else if ($col['name'] == 'A.year_of_sponsorship_2') { //do new filter :End Year of Sponsorship

                    $Year = $col['search']['value'];
                    $this->db->where("(A.year_of_sponsorship <= $Year)");

                } else if ($col['name'] == 'qlc_kpi_grade') { //do new filter :End Year of Sponsorship
                    //where year(E.maxdatetime) = 2017  and F.score > 2
                    $LatestGrade = $col['search']['value'];
                    /*$st="(E.insert_datetime in (
                    select insert_datetime
                    FROM qlc_kpi
                    group by insert_datetime
                    having (2)*count(*) + COUNT(IF(SUBSTRING(qlc_kpi_code, 1 , 2) = '02',1, NULL)) = 100))";
                    $this->db->where($st, NULL, FALSE); */
                    //$this->db->where("(E.insert_datetime in )");
                    /*$st="(
                    where year(E.maxdatetime) = 2017  and F.score > 2;
                    )";*/
                    //$this->db->where($st, NULL, FALSE);
                    $LatestYear = date("Y");

                    if ($LatestGrade == 'D') {
                        $this->db->where("(year(E.maxdatetime) = $LatestYear and F.score >= 0 and F.score <= 49)");
                    } else if ($LatestGrade == 'C') {
                        $this->db->where("(year(E.maxdatetime) = $LatestYear and F.score >= 50 and F.score <= 59)");
                    } else if ($LatestGrade == 'B') {
                        $this->db->where("(year(E.maxdatetime) = $LatestYear and F.score >= 60 and F.score <= 79)");
                    } else if ($LatestGrade == 'A') {
                        $this->db->where("(year(E.maxdatetime) = $LatestYear and F.score >= 80 and F.score <= 100)");
                    }

                } else if ($col['name'] == 'obf') { //do new filter :End Year of Sponsorship

                    $obf = $col['search']['value'];

                    $this->db->order_by($obf, 'ASC');

                } else {

                    $this->db->like($col['name'], $col['search']['value']); //do new fliter : เพิ่ม code

                }
                /*=== do new filter : start code ===*/
            }
        }
        if (!$_POST['columns'][7][search][value]) {
            $this->db->order_by('A.qlc_id DESC');
        }
        /*=== end foreach filter ===*/

        // dieArray($this->db);

/*      if($_POST['search']['value']){
foreach ($allow as $key => $val) {
if(stristr($val,$_POST['search']['value']) == true){
//$this->db->or_where("D_Allow",$key);
}
}
}
 */
        // dieArray($this->db);
        /*      if(isset($_POST['order'])) // here order processing
        {
        $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }
        else if(isset($this->order))
        {
        $order = $this->order;
        $this->db->order_by(key($order), $order[key($order)]);
        }*/

        if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function get_datatables()
    {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        //$this->db->where("log_type =",'Import');// เพิ่ม where log_type = Import
        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered()
    {
        $this->_get_datatables_query();
        //$this->db->where("log_type =",'Import');// เพิ่ม where log_type = Import
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from('qlc_info');
        //$this->db->where("log_type =",'Import');// เพิ่ม where log_type = Import
        return $this->db->count_all_results();
    }

    //องค์ประกอบ std_qlc_kpi
    public function getAll_Center_qlc()
    {
        $data = array();
        $group = $this->common_model->custom_query("SELECT * FROM std_qlc_kpi GROUP BY qlc_kpi_grp");
        foreach ($group as $key => $value) {
            $data[$value['qlc_kpi_id']]['title'] = $value;
            //    $data[$value['qlc_kpi_id']]['title'] = $value['qlc_kpi_grp'];
            $list = $this->common_model->custom_query("SELECT * FROM std_qlc_kpi WHERE qlc_kpi_grp = '{$value['qlc_kpi_grp']}'");
            $data[$value['qlc_kpi_id']]['data'] = $list;
        }

        return $data;
    }

    //=== upload image : start code ===
    public function insertImages($data)
    {
        return $this->db->insert('school_test_photo', $data);
    }

    public function getImages()
    {
        $query = $this->db->get('tbl_images');
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
    //=== upload image : end code ===

}
