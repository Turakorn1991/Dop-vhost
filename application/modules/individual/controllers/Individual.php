<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Individual extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();

        chkUserLogin();

    }
    public function __deconstruct()
    {
        $this->db->close();
    }

        public function individual_list_ajax($process_action='View') { // รายการสงเคราะห์ผู้สูงอายุในภาวะยากลำบาก
        ini_set('max_execution_time', 300);

        $data = array(); //Set Initial Variable to Views
        /*-- Initial Data for Check User Permission --*/
        $user_id = get_session('user_id');
        $app_id = 70;
        /*--END Inizial Data for Check User Permission--*/

        $this->webinfo_model->LogSave($app_id,$process_action,'Sign In','Success'); //Save Sign In Log
        $usrpm = $this->admin_model->chkOnce_usrmPermiss($app_id,$user_id); //Check User Permission

        if(@$usrpm['perm_status']=='No' || !isset($usrpm['app_id'])){
            echo json_encode(array());
            $this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Fail'); //Save Sign In Log
        }else {
            $app_name = $usrpm['app_name'];
            $data['usrpm'] = $usrpm;
            $data['user_id'] = $user_id;

            //$data['diff_info'] = $this->difficult_model->getAll_diffInfo();

            $this->load->model('pers_list_model','manage_transfer');
            $list = $this->manage_transfer->get_datatables();
            // echo count($list);
            // dieArray($list);

            $data = array();
            $no = $_POST['start'];
            foreach ($list as $i=>$manage_transfer) {
                $no++;
                $row = array();

                $row[] = "<center>".$no."</center>";
                $row[] = $manage_transfer->pid;
                $row[] = $manage_transfer->prename_th.$manage_transfer->name;

                $age = '';
                if($manage_transfer->date_of_birth!='' && checkdate(iconv_substr($manage_transfer->date_of_birth,5,2,'utf-8'),iconv_substr($manage_transfer->date_of_birth,8,2,'utf-8'),iconv_substr($manage_transfer->date_of_birth,0,4,'utf-8'))) {
                  $date = new DateTime($manage_transfer->date_of_birth);
                  $now = new DateTime();
                  if($manage_transfer->date_of_death!='' && checkdate(iconv_substr($manage_transfer->date_of_death,5,2,'utf-8'),iconv_substr($manage_transfer->date_of_death,8,2,'utf-8'),iconv_substr($manage_transfer->date_of_death,0,4,'utf-8'))) {
                    $now = new DateTime($manage_transfer->date_of_death);
                    $interval = $now->diff($date);
                    $age = $interval->y;
                  }else if($manage_transfer->date_of_death!='') {
                    $age = '';
                  }else {
                    $interval = $now->diff($date);
                    $age = $interval->y;
                  }
                }
                $row[] = "<center>".$age."</center>";

                $addr_info = $this->personal_model->getOnce_PersonalAddress($manage_transfer->pre_addr_id);
                // dieArray($addr_info);

                $row[] = "".$addr_info['addr_home_no']." ".$addr_info['addr_road']." ".$addr_info['addr_moo']." ".$addr_info['addr_alley']." ".$addr_info['addr_lane']." ".$addr_info['addr_sub_district']." ".$addr_info['addr_district']." ".$addr_info['addr_province']." ".$addr_info['addr_zipcode'];

                $adm_irp = rowArray($this->welfare_model->getAll_admIrp($manage_transfer->pers_id));
    						$irp_result = $this->welfare_model->get_Percentage($adm_irp['irp_id']);
    						$ans_rate = $irp_result['ans_rate'];
    						$scroe = round($irp_result['ans_percent'],2);
                if($scroe <= 30){
                    $style_scroe = "background-color: #F44336 !important;";
                }else if($scroe <= 60){
                    $style_scroe = "background-color: #ffc107 !important;";
                }else{
                    $style_scroe = "background-color: #4caf50 !important;";
                }
                if($adm_irp['irp_id'] != ''){
    							$row[] = '<div style="float: left;margin-right:5px;" >'.$ans_rate.'</div><div class="progress" style="background-color: rgba(96, 125, 139, 0.34);margin-bottom: 0px !important;">
    													<div class="progress-bar" role="progressbar" aria-valuenow="'.$scroe.'" aria-valuemin="0" aria-valuemax="100" style="width: '.$scroe.'%; '.$style_scroe.' ">
    														'.$scroe.'%
    													</div>
    												</div>';
    						}else{
    							$row[] = '<center><span style="color:#D28928;">ไม่ได้รับการประเมิน</span></center>';
    						}


                $row[] = '<center><a href="'.base_url('individual/individual_info/'.$manage_transfer->pers_id).'"><i  class="fa fa-user" aria-hidden="true"></i></a><center>';

                $data[] = $row;
            }


            $output = array(
                            "draw" => $_POST['draw'],
                            "recordsTotal" => $this->manage_transfer->count_all(),
                            "recordsFiltered" => $this->manage_transfer->count_filtered(),
                            "data" => $data,
                    );
            //output to json format
            echo json_encode($output);
            $this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Success'); //Save Sign Out Log
        }

    }

    public function individual_list($process_action = 'View')
    {
        // ตารางข้อมูล
        $data = array(); //Set Initial Variable to Views
        /*-- Initial Data for Check User Permission --*/
        $user_id      = get_session('user_id');
        $app_id       = 71;
        $process_path = 'individual/individual_list';
        /*--END Inizial Data for Check User Permission--*/

        $this->webinfo_model->LogSave($app_id, $process_action, 'Sign In', 'Success'); //Save Sign In Log
        $usrpm = $this->admin_model->chkOnce_usrmPermiss($app_id, $user_id); //Check User Permission

        if (@$usrpm['perm_status'] == 'No' || !isset($usrpm['app_id'])) {
            page500();
            $this->webinfo_model->LogSave($app_id, $process_action, 'Sign Out', 'Fail'); //Save Sign In Log
        } else {
            $app_name        = $usrpm['app_name'];
            $data['usrpm']   = $usrpm;
            $data['user_id'] = $user_id;

            //$data['indivi_info']  = array();

            $this->load->library('template',
                array('name' => 'admin_template1',
                    'setting'    => array('data_output' => ''))
            ); // Set Template

            $data['csrf'] = array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
            );

            /*-- Load Datatables for Theme --*/
            set_css_asset_head('../plugins/Static_Full_Version/css/plugins/dataTables/datatables.min.css');
            set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/dataTables/datatables.min.js');
            /*-- End Load Datatables for Theme --*/
            /*-- Toastr style --*/
            set_css_asset_head('../plugins/Static_Full_Version/css/plugins/toastr/toastr.min.css');
            set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/toastr/toastr.min.js');
            /*-- End Toastr style --*/



            set_js_asset_footer('individual_list_ajax.js', 'individual'); //Set JS Index.js

            set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/ionRangeSlider/ion.rangeSlider.min.js'); //Set JS Index.js


            $data['process_action'] = $process_action;
            $data['content_view']   = 'individual_list';

            $tmp                = $this->admin_model->getOnce_Application($usrpm['app_parent_id']); //Used for find root application
            $data['head_title'] = $tmp['app_name'];
            $data['title']      = $usrpm['app_name'];


                $this->template->load('index_page', $data, 'individual');
                $this->webinfo_model->LogSave($app_id, $process_action, 'Sign Out', 'Success'); //Save Sign Out Log


        }

    }



    public function date_check($str)
    {

        $arr = explode('-', $str);

        if (count($arr) == 3) {
            if (checkdate($arr[1], $arr[0], $arr[2])) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }

    }

    private function clr_olderp_info()
    {
        return array(
            'date_of_reg'        => date('d-m-Y'),
            'req_pers_id'        => '',
            'req_pid'            => '',
            'req_name'           => ' - ',
            'req_date_of_birth'  => ' - ',
            'req_gender_name'    => ' - ',
            'req_nation_name_th' => ' - ',
            'req_relg_title'     => ' - ',
            'req_position'       => '',
            'req_org'            => '',
            'req_relation'       => '',
            'req_tel_no_home'    => '',
            'req_tel_no_mobile'  => '',
            'req_fax_no'         => '',
            'req_email_addr'     => '',
            'chn_code'           => '',
            'addr_gps'           => '',

            'pid'                => '',
            'pers_id'            => '',
            'name'               => ' - ',
            'date_of_birth'      => ' - ',
            'gender_name'        => ' - ',
            'nation_name_th'     => ' - ',
            'relg_title'         => ' - ',
            'tel_no_home'        => '',
            'tel_no_mobile'      => '',
            'fax_no'             => '',
            'email_addr'         => '',
            'reg_addr_id'        => '',
            'pre_addr_id'        => '',
        );
    }

    public function individual_info($process_action = 'Add', $adm_id = 0)
    {
        //(ข้อมูลทะเบียนประวัติผู้สูงอายุที่มีภูมิปัญญา)
        $data = array(); //Set Initial Variable to Views
        /*-- Initial Data for Check User Permission --*/
        $user_id      = get_session('user_id');
        $app_id       = 72;
        $process_path = 'individual/individual_info';

        /*--END Inizial Data for Check User Permission--*/

        $this->webinfo_model->LogSave($app_id, $process_action, 'Sign In', 'Success'); //Save Sign In Log
        $usrpm = $this->admin_model->chkOnce_usrmPermiss($app_id, $user_id); //Check User Permission

        if (@$usrpm['perm_status'] == 'No' || !isset($usrpm['app_id'])) {
            page500();
            $this->webinfo_model->LogSave($app_id, $process_action, 'Sign Out', 'Fail'); //Save Sign Out Log
        } else {
            $app_name        = $usrpm['app_name'];
            $data['usrpm']   = $usrpm;
            $data['user_id'] = $user_id;

            // $data['adm_info'] = $this->difficult_model->getAll_diffInfo();

            $this->load->library('template',
                array('name' => 'admin_template1',
                    'setting'    => array('data_output' => ''))
            ); // Set Template

            /*-- datepicker --*/
            set_css_asset_head('../plugins/bootstrap-datepicker1.3.0/css/datepicker.css');
            set_js_asset_head('../plugins/bootstrap-datepicker1.3.0/js/bootstrap-datepicker.js');
            /*-- End datepicker --*/

            /*-- Toastr style --*/
            set_css_asset_head('../plugins/Static_Full_Version/css/plugins/toastr/toastr.min.css');
            set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/toastr/toastr.min.js');
            /*-- End Toastr style --*/

            set_css_asset_head('../plugins/Static_Full_Version/css/plugins/jasny/jasny-bootstrap.min.css');
            set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/jasny/jasny-bootstrap.min.js');

            /*-- select2 style --*/
            set_css_asset_head('../plugins/Static_Full_Version/css/plugins/select2/select2.min.css');
            set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/select2/select2.full.min.js');
            /*-- End select2 style --*/

            //  // Custom and plugin javascript
            //  set_js_asset_footer('../plugins/Static_Full_Version/js/inspinia.js');
            // set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/pace/pace.min.js');

            // chart
            set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/chartJs/Chart.min.js');
            set_js_asset_footer('spider.js', 'individual');

            /*-- fileupload style --*/

             //set_js_asset_footer('mapmarker.js','webconfig'); //Set JS mapmarker.js --

            // set_js_asset_footer('amcharts.js','individual'); //Set JS mapmarker.js --
            // set_js_asset_footer('radar.js','individual'); //Set JS mapmarker.js --
            // set_js_asset_footer('export.min.js','individual'); //Set JS mapmarker.js --
            // set_js_asset_footer('none.js','individual'); //Set JS mapmarker.js --
            //  set_css_asset_head('../modules/individual/css/export.css');


            set_css_asset_head('../modules/intelprop/css/gallery_img.css');
            set_js_asset_footer('webservice.js','personals'); //Set JS sufferer_form1.js
            set_js_asset_footer('individual_info.js', 'individual'); //Set JS

            $data['process_action'] = $process_action;
            $data['content_view']   = 'individual_profile';

            $tmp                = $this->admin_model->getOnce_Application($usrpm['app_parent_id']); //Used for find root application
            $data['head_title'] = $tmp['app_name'];
            $data['title']      = $usrpm['app_name'];

            $data['csrf'] = array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash(),
            );

            $this->template->load('index_page', $data, 'individual');
            $this->webinfo_model->LogSave($app_id, $process_action, 'Sign Out', 'Success'); //Save Sign Out Log
            }

    }

    public function del_wisd_photo()
    {
        $id_photo = get_inpost('id_photo');
        $str      = "DELETE FROM wisd_photo WHERE wisdom_photo_id = {$id_photo}";
        $row      = $this->common_model->custom_query($str);

        echo "remove";

    }

    public function del_wisd_branch()
    {
        $branch_id = get_inpost('branch_id');
        $data      = array('delete_user_id' => getUser(),
            'delete_org_id'                     => get_session('org_id'),
            'delete_datetime'                   => getDatetime());

        $this->common_model->update('wisd_branch', $data, array('branch_id' => $branch_id));
        echo "remove";

    }

}
