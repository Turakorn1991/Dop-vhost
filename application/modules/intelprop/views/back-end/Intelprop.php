<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Intelprop extends MX_Controller
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

    public function getChart(){
        ini_set('max_execution_time', 300);
        $dataChart = array();
        $wisdom = $this->common_model->custom_query("SELECT
            COUNT(wisd_info.knwl_id) AS count_knwl,
            std_area.area_name_th AS name
            FROM  wisd_info
            JOIN db_center.pers_info
            ON wisd_info.pers_id = pers_info.pers_id
            JOIN pers_addr
            ON pers_info.pre_addr_id = pers_addr.addr_id
            JOIN std_area
            ON pers_addr.addr_province = std_area.area_code
            GROUP BY std_area.area_name_th ");
        foreach ($wisdom as $key => $row) {
            $dataChart[] = array(
                'province' => $row['name'],
                'value' => $row['count_knwl'],
                // 'value' => 10,
            );
        }
        echo json_encode($dataChart);

    }
    public function getChart2(){
        ini_set('max_execution_time', 800);
        $dataChart = array();
        // $prov = $this->personal_model->getAll_Province();
        $wisdom = $this->common_model->custom_query("SELECT * FROM std_wisdom ORDER BY wis_code ASC");
        foreach ($wisdom as $key => $row) {
            $dataChart[] = array(
                'wisdom' => $row['wis_name'],
                'value' => rand(0,500),
                // 'value' => 10,
            );
        }
        echo json_encode($dataChart);

    }

    public function getChart3(){
        ini_set('max_execution_time', 800);
        $dataChart = array();
        // $prov = $this->personal_model->getAll_Province();
        $wisdom = $this->common_model->custom_query("SELECT
            COUNT(wisd_info.knwl_id) AS count_knwl,
            std_area.region AS name
            FROM  wisd_info
            JOIN db_center.pers_info
            ON wisd_info.pers_id = pers_info.pers_id
            JOIN pers_addr
            ON pers_info.pre_addr_id = pers_addr.addr_id
            JOIN std_area
            ON pers_addr.addr_province = std_area.area_code
            GROUP BY std_area.region ");
        foreach ($wisdom as $key => $row) {
            $dataChart[] = array(
                'wisdom' => $row['name'],
                'value' => $row['count_knwl'],
                // 'value' => 10,
            );
        }
        echo json_encode($dataChart);

    }

    public check_addr($process_action='View'){
        $data = array(); //Set Initial Variable to Views
        /*-- Initial Data for Check User Permission --*/
        $user_id = get_session('user_id');
        $app_id = 44;
        $process_path = 'intelprop/check_addr';
        /*--END Inizial Data for Check User Permission--*/

        $addr_code = get_inpost('addr_code');

    $this->webinfo_model->LogSave($app_id,$process_action,'Sign In','Success'); //Save Sign In Log
    $usrpm = $this->admin_model->chkOnce_usrmPermiss($app_id,$user_id); //Check User Permission

    if(@$usrpm['perm_status']=='No' || !isset($usrpm['app_id'])){
      echo json_encode(array('code'=>'-1','message'=>'Permission Invalid!'));
      $this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Fail'); //Save Sign Out Log
    }else {
         $rows = $this->common_model->custom_query("SELECT * FROM pers_addr WHERE addr_code={$addr_code} AND delete_datetime IS NULL AND delete_datetime IS NULL");
        // // dieArray($rows);

                 $rs = array();
                 if(count($rows)>0){         
                  $rs['history'] = $rows;
                  }else {
                  $rs['history'] = 'ไม่พบ';
                }
     

             echo json_encode($rs);

            $this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Success'); //Save Sign Out Log
  }
    }

  public function getHistory($process_action='View') {
    $data = array(); //Set Initial Variable to Views
    /*-- Initial Data for Check User Permission --*/
    $user_id = get_session('user_id');
    $app_id = 44;
    $process_path = 'intelprop/getHistory';
    /*--END Inizial Data for Check User Permission--*/

     $pers_id = get_inpost('pers_id');
    
    $this->webinfo_model->LogSave($app_id,$process_action,'Sign In','Success'); //Save Sign In Log
    $usrpm = $this->admin_model->chkOnce_usrmPermiss($app_id,$user_id); //Check User Permission

    if(@$usrpm['perm_status']=='No' || !isset($usrpm['app_id'])){
      echo json_encode(array('code'=>'-1','message'=>'Permission Invalid!'));
      $this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Fail'); //Save Sign Out Log
    }else {
        $rows = $this->common_model->custom_query("SELECT * FROM wisd_info WHERE pers_id={$pers_id} AND delete_datetime IS NULL AND delete_datetime IS NULL");
        // dieArray($rows);

        $rs = array();
        if(count($rows)>0){
             $row_branch = $this->common_model->custom_query("SELECT * FROM wisd_branch WHERE knwl_id={$rows[0]['knwl_id']} AND delete_datetime IS NULL AND delete_datetime IS NULL");
            if(count($row_branch)>0) {
              $rs['history'] = count($row_branch)." ภูมิปัญญา";
            }else {
              $rs['history'] = 'ไม่มีภูมิปัญญา';
            }
       }else{
            $rs['history'] = 'ไม่มีภูมิปัญญา';
       }

        echo json_encode($rs);

      $this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Success'); //Save Sign Out Log
    }
  }

    public function intelprop_list_ajax($process_action='View') { // รายการสงเคราะห์ผู้สูงอายุในภาวะยากลำบาก
        ini_set('max_execution_time', 300);
        $data = array(); //Set Initial Variable to Views
        /*-- Initial Data for Check User Permission --*/
        $user_id = get_session('user_id');
        $app_id = 45;
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

            $this->load->model('intelprop_list_model','intelprop_transfer');
             $list = $this->intelprop_transfer->get_datatables();
            // dieArray($list);
            // echo count($list);
            
            $data = array();
            $no = $_POST['start'];

            foreach ($list as $i=>$intelprop_transfer) {

                 $addr = $this->personal_model->getOnce_PersonalAddress($intelprop_transfer->reg_addr_id);

                $no++;
                $row = array();

                $row[] = "<center>".$no."</center>";
                $row[] = $intelprop_transfer->pid;
                
                $row[] = $intelprop_transfer->prename_th.$intelprop_transfer->name;

                $age = '';
                if($intelprop_transfer->date_of_birth!='') {
                  $date = new DateTime($intelprop_transfer->date_of_birth);
                  $now = new DateTime();
                  $interval = $now->diff($date);
                  $age = $interval->y;
                }
                 $row[] = "<center>".$age."</center>";

               

                $province_district = "";
                //ถ้ามีข้อมูลอำเภอและจังหวัด ให้แสดงทั้งสอง
                                if ((isset($addr['addr_district'])) || (isset($addr['addr_province']))) {
                                    if (($addr['addr_district'] != '') && ($addr['addr_province'] != '')) {
                                        $province_district = $addr['addr_district'] . "," . $addr['addr_province'];
                                    } else if ($addr['addr_district'] != '') {
                                        $province_district = $addr['addr_district'];
                                    } else if ($addr['addr_province'] != '') {
                                        $province_district = $addr['addr_province'];
                                    } else {
                                        $province_district = "-";
                                    }
                                } else {
                                    $province_district = "-";
                                }

                $row[] = "<center>".$province_district."</center>";


                $row[] = "<center>".$intelprop_transfer->tel_no."</center>";

                $date_of_req = '';
                if($intelprop_transfer->date_of_req!='' && $intelprop_transferr->date_of_req!='0000-00-00') {
                    $date_of_req = '<font class="text-sucsess" color="green">'.dateChange($intelprop_transfer->date_of_req,5).'</font>';
                }else {
                    $date_of_req = '<font class="text-sucsess" color="#B9B9B9">-</font>';
                }
                $row[] = "<center>".$date_of_req."</center>";

                $wisd_branch = "";
                //แสดงชื่อสาขาภูมิปัญญา ตามเลขไอดี
                $wisdom = $this->wisd_model->get_wisd_branch_by_knwlid($intelprop_transfer->knwl_id);
                            //dieArray($wisdom);
                            if (!empty($wisdom)) {

                                foreach ($wisdom as $key1 => $value1) {
                                    $wisd_branch =  $wisd_branch.$value1['wis_name']."<br>"; # code...
                                }
                            } else {
                                $wisd_branch = "-";
                            }

                $row[] = $wisd_branch;

                $tmp = $this->admin_model->getOnce_Application(3);
                $tmp1 = $this->admin_model->chkOnce_usrmPermiss(3,$user_id); //Check User Permission
                $btn = '';
                $btn =$btn.'<!-- Single button -->
                <div class="btn-group" style="cursor: pointer;">
                  <i  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle fa fa-gear" aria-hidden="true" style="color: #000"></i>

                  <ul class="dropdown-menu" style="position: absolute;left: -190px;">';

                  $btn = $btn.' <li><a style="font-size:16px;" data-toggle="modal" data-target="#prt'.$manage_transfer->pid.'" title="พิมพ์แบบฟอร์ม" >
                       <i class="fa fa-file-pdf-o" aria-hidden="true" style="color: #000"></i> พิมพ์แบบฟอร์ม (.PDF)
                   </a></li>';


                  $btn =$btn.'<li><a  style="font-size:16px;"';

                  if(!isset($tmp1['perm_status'])){ $btn =$btn.'class="disabled"';}else{ $btn =$btn.'href="'.site_url("intelprop/olderp_info/Edit/".$intelprop_transfer->knwl_id); }
                  $btn =$btn.'"><i class="fa fa-pencil" aria-hidden="true" style="color: #000"></i> แก้ไขรายการ</a></li>';




                    $tmp = $this->admin_model->chkOnce_usrmPermiss(3,$user_id); //Check User Permission
                    if(isset($tmp['perm_status'])) {
                        if($tmp['perm_status']=='Yes') {
                         $btn = $btn.'<li><a style="font-size:16px;" data-id='.$intelprop_transfer->knwl_id.' onclick="opn(this)" title="ลบ" >
                             <i class="fa fa-trash" style="color: #000"></i> ลบรายการ
                          </a></li>';
                      }
                    }

                  $btn = $btn.'</ul>
                              </div>';

                $btn =$btn.'<!-- Print Modal -->
                   <div class="modal fade" id="prt'.$manage_transfer->pid.'" role="dialog">
                     <div class="modal-dialog">

                        <!-- Modal content-->
                       <div class="modal-content">
                         <div class="modal-header text-left">
                           <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title" style="color: #333; font-size: 16px;">พิมพ์แบบฟอร์ม</h4>
                          </div>
                         <div class="modal-body">
                           <div class="row">';

                    $tmp = $this->admin_model->getOnce_Application(49);
                    $tmp1 = $this->admin_model->chkOnce_usrmPermiss(49,get_session('user_id')); //Check User Permission

                    $btn = $btn.'<div class="col-xs-12 col-sm-12 text-left" style="margin-bottom: 10px;"';
                    if(!isset($tmp1['perm_status'])) {
                      $btn = $btn.' class="disabled "';
                    }else if($usrpm['app_id']==49) {
                      $btn = $btn.' class="active "';
                    }
                    $btn = $btn.'>
                                 <a style="color: #333; font-size: 16px;" target="_blank" href="'.site_url('report/E1/pdf?id='.$intelprop_transfer->knwl_id).'"><i class="fa fa-print" aria-hidden="true"></i> ';
                    if(isset($tmp1['perm_status'])) {
                     $btn = $btn.$tmp1['app_name'];
                    }
                    $btn = $btn.'  </a>
                             </div>';

           
                    $btn = $btn.'                          
                           </div>
                           <br />

                        </div>
                      </div>

                    </div>
                   </div>
                   <!-- End Print Modal -->';


                $row[] = "<center>".$btn."<center>";

                $data[] = $row;
            }


            $output = array(
                            "draw" => $_POST['draw'],
                            "recordsTotal" => $this->intelprop_transfer->count_all(),
                            "recordsFiltered" => $this->intelprop_transfer->count_filtered(),
                            "data" => $data,
                    );
            //output to json format
            echo json_encode($output);
            $this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Success'); //Save Sign Out Log
        }

    }

    public function intelprop_list($process_action = 'View')
    {
        // ini_set('max_execution_time', 300);
        // ตารางข้อมูล
        $data = array(); //Set Initial Variable to Views
        /*-- Initial Data for Check User Permission --*/
        $user_id      = get_session('user_id');
        $app_id       = 45;
        $process_path = 'intelprop/intelprop_list';
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

            $data['csrf'] = array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash(),
            );

            // $str               = "SELECT * FROM wisd_info LEFT JOIN pers_info ON wisd_info.pers_id=pers_info.pers_id WHERE wisd_info.delete_user_id IS NULL AND (wisd_info.delete_datetime IS NULL || wisd_info.delete_datetime = '0000-00-00 00:00:00')";
            // $data['wisd_info'] = $this->common_model->custom_query($str);

            $this->load->library('template',
                array('name' => 'admin_template1',
                    'setting'    => array('data_output' => ''))
            ); // Set Template

            /*-- Load Datatables for Theme --*/
            set_css_asset_head('../plugins/Static_Full_Version/css/plugins/dataTables/datatables.min.css');
            set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/dataTables/datatables.min.js');
            /*-- End Load Datatables for Theme --*/
            /*-- Toastr style --*/
            set_css_asset_head('../plugins/Static_Full_Version/css/plugins/toastr/toastr.min.css');
            set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/toastr/toastr.min.js');
            /*-- End Toastr style --*/
            
            /*-- datepicker custom --*/
            set_css_asset_head('../plugins/bootstrap-datepicker-custom/dist/css/bootstrap-datepicker.css');
            set_js_asset_head('../plugins/bootstrap-datepicker-custom/dist/js/bootstrap-datepicker-custom.js');
            set_js_asset_head('../plugins/bootstrap-datepicker-custom/dist/locales/bootstrap-datepicker.th.min.js');
            /*-- End datepicker custom--*/

            set_js_asset_footer('intelprop_list_ajax.js', 'intelprop'); //Set JS Index.js

            set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/ionRangeSlider/ion.rangeSlider.min.js'); //Set JS Index.js


            $data['process_action'] = $process_action;
            $data['content_view']   = 'intelprop_list_ajax';

            $tmp                = $this->admin_model->getOnce_Application($usrpm['app_parent_id']); //Used for find root application
            $data['head_title'] = $tmp['app_name'];
            $data['title']      = $usrpm['app_name'];

            $this->template->load('index_page', $data, 'intelprop');
            $this->webinfo_model->LogSave($app_id, $process_action, 'Sign Out', 'Success'); //Save Sign Out Log
        }

    }

     public function intelprop_list_ajax1($process_action='View') { // รายการสงเคราะห์ผู้สูงอายุในภาวะยากลำบาก
        ini_set('max_execution_time', 300);
        $data = array(); //Set Initial Variable to Views
        /*-- Initial Data for Check User Permission --*/
        $user_id = get_session('user_id');
        $app_id = 45;
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

            $this->load->model('intelprop_list_model','intelprop_transfer');
             $list = $this->intelprop_transfer->get_datatables();
             // dieArray($list);
             // echo count($list);
            
            $data = array();
            $no = $_POST['start'];

            foreach ($list as $i=>$intelprop_transfer) {

                 $addr = $this->personal_model->getOnce_PersonalAddress($intelprop_transfer->reg_addr_id);

                $no++;
                $row = array();

                $row[] = "<center>".$no."</center>";                     
                $row[] = "โครงการ/กิจกรรม";
                $row[] = $intelprop_transfer->prename_th.$intelprop_transfer->name;       
                $row[] = "<center>".$no."</center>";
                $row[] = "<center>".$no."</center>";
                $row[] = "พื้นที่ดำเนินการ";


                // $date_of_req = '';
                // if($intelprop_transfer->date_of_req!='' && $intelprop_transferr->date_of_req!='0000-00-00') {
                //     $date_of_req = '<font class="text-sucsess" color="green">'.dateChange(date("Y-d-m"),5).'</font>';
                // }else {
                //     $date_of_req = '<font class="text-sucsess" color="#B9B9B9">ยังไม่ได้ขึ้นทะเบียน</font>';
                // }

                $date_of_req = '<font class="text-sucsess" color="green">'.dateChange(date("Y-m-d"),5).'</font>';

                $row[] = "<center>".$date_of_req."</center>";

                

                $row[] = "<div class=\"text-right\">".number_format(2000,2)."</div>";

                $tmp = $this->admin_model->getOnce_Application(3);
                $tmp1 = $this->admin_model->chkOnce_usrmPermiss(3,$user_id); //Check User Permission
                $btn = '';
                $btn =$btn.'<!-- Single button -->
                <div class="btn-group" style="cursor: pointer;">
                  <i  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle fa fa-gear" aria-hidden="true" style="color: #000"></i>

                  <ul class="dropdown-menu" style="position: absolute;left: -190px;">';

                  $btn = $btn.' <li><a style="font-size:16px;" data-toggle="modal" data-target="#prt'.$manage_transfer->pid.'" title="พิมพ์แบบฟอร์ม" >
                       <i class="fa fa-file-pdf-o" aria-hidden="true" style="color: #000"></i> พิมพ์แบบฟอร์ม (.PDF)
                   </a></li>';


                  $btn =$btn.'<li><a  style="font-size:16px;"';

                  if(!isset($tmp1['perm_status'])){ $btn =$btn.'class="disabled"';}else{ $btn =$btn.'href="'.site_url("intelprop/olderp_info/Edit/".$intelprop_transfer->knwl_id); }
                  $btn =$btn.'"><i class="fa fa-pencil" aria-hidden="true" style="color: #000"></i> แก้ไขรายการ</a></li>';




                    $tmp = $this->admin_model->chkOnce_usrmPermiss(3,$user_id); //Check User Permission
                    if(isset($tmp['perm_status'])) {
                        if($tmp['perm_status']=='Yes') {
                         $btn = $btn.'<li><a style="font-size:16px;" data-id='.$intelprop_transfer->knwl_id.' onclick="opn(this)" title="ลบ" >
                             <i class="fa fa-trash" style="color: #000"></i> ลบรายการ
                          </a></li>';
                      }
                    }

                  $btn = $btn.'</ul>
                              </div>';

                $btn =$btn.'<!-- Print Modal -->
                   <div class="modal fade" id="prt'.$manage_transfer->pid.'" role="dialog">
                     <div class="modal-dialog">

                        <!-- Modal content-->
                       <div class="modal-content">
                         <div class="modal-header text-left">
                           <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title" style="color: #333; font-size: 16px;">พิมพ์แบบฟอร์ม</h4>
                          </div>
                         <div class="modal-body">
                           <div class="row">';

                    $tmp = $this->admin_model->getOnce_Application(49);
                    $tmp1 = $this->admin_model->chkOnce_usrmPermiss(49,get_session('user_id')); //Check User Permission

                    $btn = $btn.'<div class="col-xs-12 col-sm-12 text-left" style="margin-bottom: 10px;"';
                    if(!isset($tmp1['perm_status'])) {
                      $btn = $btn.' class="disabled "';
                    }else if($usrpm['app_id']==49) {
                      $btn = $btn.' class="active "';
                    }
                    $btn = $btn.'>
                                 <a style="color: #333; font-size: 16px;" target="_blank" href="'.site_url('report/E1/pdf?id='.$intelprop_transfer->knwl_id).'"><i class="fa fa-print" aria-hidden="true"></i> ';
                    if(isset($tmp1['perm_status'])) {
                     $btn = $btn.$tmp1['app_name'];
                    }
                    $btn = $btn.'  </a>
                             </div>';

           
                    $btn = $btn.'                          
                           </div>
                           <br />

                        </div>
                      </div>

                    </div>
                   </div>
                   <!-- End Print Modal -->';


                $row[] = "<center>".$btn."<center>";

                $data[] = $row;
            }
            
            // dieArray($row);

            $output = array(
                            "draw" => $_POST['draw'],
                            "recordsTotal"  => $this->intelprop_transfer->count_all(),
                            "recordsFiltered" => $this->intelprop_transfer->count_filtered(),
                            "data" => $data,
                    );
            //output to json format
            echo json_encode($output);
            $this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Success'); //Save Sign Out Log
        }

    }

      public function intelprop_list1($process_action = 'View')
    {
        // ini_set('max_execution_time', 300);
        // ตารางข้อมูล
        $data = array(); //Set Initial Variable to Views
        /*-- Initial Data for Check User Permission --*/
        $user_id      = get_session('user_id');
        $app_id       = 45;
        $process_path = 'intelprop/intelprop_list1';
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

            $data['csrf'] = array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash(),
            );

            // $str               = "SELECT * FROM wisd_info LEFT JOIN pers_info ON wisd_info.pers_id=pers_info.pers_id WHERE wisd_info.delete_user_id IS NULL AND (wisd_info.delete_datetime IS NULL || wisd_info.delete_datetime = '0000-00-00 00:00:00')";
            // $data['wisd_info'] = $this->common_model->custom_query($str);

            $this->load->library('template',
                array('name' => 'admin_template1',
                    'setting'    => array('data_output' => ''))
            ); // Set Template

            /*-- Load Datatables for Theme --*/
            set_css_asset_head('../plugins/Static_Full_Version/css/plugins/dataTables/datatables.min.css');
            set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/dataTables/datatables.min.js');
            /*-- End Load Datatables for Theme --*/
            /*-- Toastr style --*/
            set_css_asset_head('../plugins/Static_Full_Version/css/plugins/toastr/toastr.min.css');
            set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/toastr/toastr.min.js');
            /*-- End Toastr style --*/
            
            /*-- datepicker custom --*/
            set_css_asset_head('../plugins/bootstrap-datepicker-custom/dist/css/bootstrap-datepicker.css');
            set_js_asset_head('../plugins/bootstrap-datepicker-custom/dist/js/bootstrap-datepicker-custom.js');
            set_js_asset_head('../plugins/bootstrap-datepicker-custom/dist/locales/bootstrap-datepicker.th.min.js');
            /*-- End datepicker custom--*/

            set_js_asset_footer('intelprop_list_ajax1.js', 'intelprop'); //Set JS Index.js

            set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/ionRangeSlider/ion.rangeSlider.min.js'); //Set JS Index.js


            $data['process_action'] = $process_action;
            $data['content_view']   = 'intelprop_list_ajax1';

            $tmp                = $this->admin_model->getOnce_Application($usrpm['app_parent_id']); //Used for find root application
            $data['head_title'] = $tmp['app_name'];
            $data['title']      = $usrpm['app_name'];

            $this->template->load('index_page', $data, 'intelprop');
            $this->webinfo_model->LogSave($app_id, $process_action, 'Sign Out', 'Success'); //Save Sign Out Log
        }

    }

       public function intelprop_info($process_action = 'Add')
    {
        // ini_set('max_execution_time', 300);
        // ตารางข้อมูล
        $data = array(); //Set Initial Variable to Views
        /*-- Initial Data for Check User Permission --*/
        $user_id      = get_session('user_id');
        $app_id       = 162;
        $process_path = 'intelprop/intelprop_info';
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

            $data['csrf'] = array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash(),
            );

            // $str               = "SELECT * FROM wisd_info LEFT JOIN pers_info ON wisd_info.pers_id=pers_info.pers_id WHERE wisd_info.delete_user_id IS NULL AND (wisd_info.delete_datetime IS NULL || wisd_info.delete_datetime = '0000-00-00 00:00:00')";
            // $data['wisd_info'] = $this->common_model->custom_query($str);

            $this->load->library('template',
                array('name' => 'admin_template1',
                    'setting'    => array('data_output' => ''))
            ); // Set Template

            /*-- Load Datatables for Theme --*/
            set_css_asset_head('../plugins/Static_Full_Version/css/plugins/dataTables/datatables.min.css');
            set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/dataTables/datatables.min.js');
            /*-- End Load Datatables for Theme --*/
            /*-- Toastr style --*/
            set_css_asset_head('../plugins/Static_Full_Version/css/plugins/toastr/toastr.min.css');
            set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/toastr/toastr.min.js');
            /*-- End Toastr style --*/
            
            /*-- datepicker custom --*/
            set_css_asset_head('../plugins/bootstrap-datepicker-custom/dist/css/bootstrap-datepicker.css');
            set_js_asset_head('../plugins/bootstrap-datepicker-custom/dist/js/bootstrap-datepicker-custom.js');
            set_js_asset_head('../plugins/bootstrap-datepicker-custom/dist/locales/bootstrap-datepicker.th.min.js');
            /*-- End datepicker custom--*/

          

            set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/ionRangeSlider/ion.rangeSlider.min.js'); //Set JS Index.js


            $data['process_action'] = $process_action;
            $data['content_view']   = 'intelprop_list1';

            $tmp                = $this->admin_model->getOnce_Application($usrpm['app_parent_id']); //Used for find root application
            $data['head_title'] = $tmp['app_name'];
            $data['title']      = $usrpm['app_name'];

            $data['prename'] = $this->common_model->custom_query("SELECT * FROM std_prename");

            if($process_action=='Add' && get_inpost('bt_submit')=='' && $usrpm['perm_status']=='Yes') {
                
                $this->template->load('index_page', $data, 'intelprop');
                $this->webinfo_model->LogSave($app_id, $process_action, 'Sign Out', 'Success'); //Save Sign Out Log
            }
        }

    }


    public function date_check($str) {
    //$str = str_replace("-","",$str);
        if(strlen($str)==10) {
      $year = iconv_substr($str,6,4,'utf-8');
      //settype("integer",$year);
      $year = $year-543;
            if(checkdate(iconv_substr($str,3,2,'utf-8'),iconv_substr($str,0,2,'utf-8'),$year)){
                return true;
            }
            else{
                return false;
            }
        }else return false;
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
            // 'req_tel_no_home'    => '',
            'req_tel_no_mobile'  => '',
            // 'req_fax_no'         => '',
            // 'req_email_addr'     => '',
            'chn_code'           => '',
            'addr_gps'           => '',

            'pid'                => '',
            'pers_id'            => '',
            'name'               => ' - ',
            'date_of_birth'      => ' - ',
            'gender_name'        => ' - ',
            'nation_name_th'     => ' - ',
            'relg_title'         => ' - ',
            // 'tel_no_home'        => '',
            'tel_no_mobile'      => '',
            // 'fax_no'             => '',
            // 'email_addr'         => '',
            'reg_addr_id'        => '',
            'pre_addr_id'        => '',
        );
    }

    public function olderp_info($process_action = 'Add', $adm_id = 0)
    {
        //(ข้อมูลทะเบียนประวัติผู้สูงอายุที่มีภูมิปัญญา)
        $data = array(); //Set Initial Variable to Views
        /*-- Initial Data for Check User Permission --*/
        $user_id      = get_session('user_id');
        $app_id       = 161;
        $process_path = 'intelprop/olderp_info';

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
      //set_css_asset_head('../plugins/bootstrap-datepicker1.3.0/css/datepicker.css');
      //set_js_asset_head('../plugins/bootstrap-datepicker1.3.0/js/bootstrap-datepicker.js');
      /*-- End datepicker --*/

      /*-- datepicker custom --*/
      set_css_asset_head('../plugins/bootstrap-datepicker-custom/dist/css/bootstrap-datepicker.css');
      set_js_asset_head('../plugins/bootstrap-datepicker-custom/dist/js/bootstrap-datepicker-custom.js');
      set_js_asset_head('../plugins/bootstrap-datepicker-custom/dist/locales/bootstrap-datepicker.th.min.js');
      /*-- End datepicker custom--*/

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

            /*-- fileupload style --*/

            // set_js_asset_footer('mapmarker.js','webconfig'); //Set JS mapmarker.js --

            set_css_asset_head('../modules/intelprop/css/gallery_img.css');
            set_js_asset_footer('webservice.js','personals'); //Set JS sufferer_form1.js
            set_js_asset_footer('olderp_info.js', 'intelprop'); //Set JS
            set_js_asset_footer('mapmarker_interprop.js', 'intelprop'); //Set JS

            $data['process_action'] = $process_action;
            $data['content_view']   = 'olderp_info';

            $tmp                = $this->admin_model->getOnce_Application($usrpm['app_parent_id']); //Used for find root application
            $data['head_title'] = $tmp['app_name'];
            $data['title']      = $usrpm['app_name'];

            $data['csrf'] = array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash(),
            );

            if ($process_action == 'Add' && get_inpost('bt_submit') == '' && $usrpm['perm_status'] == 'Yes') {
                // $data['adm_info']  = $this->clr_admInfo_form1();
                $data['wisd_info'] = $this->clr_olderp_info();
                $data['pers_addr'] = array();
                $data['pers_info'] = array();

                $this->template->load('index_page', $data, 'intelprop');
                $this->webinfo_model->LogSave($app_id, $process_action, 'Sign Out', 'Success'); //Save Sign Out Log
            } else if ($process_action == 'Added' && get_inpost('bt_submit') != '' && $usrpm['perm_status'] == 'Yes') {
                //Add && Submit Form
                // dieArray($_POST);
                $this->load->library('form_validation');
                $frm = $this->form_validation;

                $frm->set_rules('wisd_info[date_of_reg]', 'วันขึ้นทะเบียน', 'required|callback_date_check');
                //$frm->set_rules('wisd_info[req_pers_id]','เลขประจำตัวประชาชน (ผู้แจ้งเรื่อง)','required');
                $frm->set_rules('wisd_info[pers_id]', 'เลขประจำตัวประชาชน (ผู้สูงอายุ)', 'required');

                //if(get_inpost('rd_pers_id')==1) {
                //    $frm->set_rules('adm_info[pers_id]','เลขประจำตัวประชาชน','required');
                //}

                //$frm->set_rules('adm_info[elder_firstname]','ชื่อตัว','required');
                //$frm->set_rules('adm_info[elder_lastname]','ชื่อสกุล','required');

                //if(get_inpost('rd_req_pers_id')==1) {
                //    $frm->set_rules('adm_info[req_pers_id]','เลขประจำตัวประชาชนข้อมูลผู้ยื่นคำขอ','required');
                //}

                //$frm->set_rules('adm_info[req_firstname]','ชื่อสกุลผู้ยื่นคำขอ','required');
                //$frm->set_rules('adm_info[req_channel]','ช่องทางการรับแจ้ง','required');

                //$frm->set_rules('adm_info[date_of_visit]','วันที่ตรวจเยี่ยม','required|callback_date_check');
                //$frm->set_rules('adm_info[visitor_name]','เจ้าหน้าที่ผู้ตรวจเยี่ยม','required');

                $frm->set_message("required", "กรุณากรอกข้อมูล %s");
                $frm->set_message("numeric", "%s ต้องเป็นตัวเลข");
                $frm->set_message("date_check", "%s รูปบบของวันที่ต้องถูกต้อง");

                if ($frm->run($this)) {
                     //Valid Data
                    //dieArray($_FILES);
                    //dieArray($_POST);
                    $data_insert                    = array();
                    $data_insert                    = get_inpost_arr('wisd_info');
                    $data_update_pers               = get_inpost_arr('pers_info');

                    $data_update_pers['tel_no']     = $data_update_pers['tel_no_mobile'];
                    unset($data_update_pers['tel_no_mobile']);

                    $data_insert['date_of_reg']     = dateChange($data_insert['date_of_reg']);
                    $data_insert['insert_user_id']  = getUser();
                    $data_insert['insert_org_id']   = get_session('org_id');
                    $data_insert['insert_datetime'] = getDatetime();


                    unset($data_insert['pid']);
                     //dieArray($data_insert);
                    $id = $this->common_model->insert('wisd_info', $data_insert);

                    /////////////////////////////////////////////////////////
                     //update pers_info
                    if(get_inpost('elder_addr_chk')!='on') {

                        $data_insert_addr = get_inpost_arr('pers_addr');
                        $data_insert_addr['insert_user_id']     = getUser();
                        $data_insert_addr['insert_datetime']    = getDatetime();

                        $new_addr_id = $this->common_model->insert('pers_addr',$data_insert_addr);
                        $data_update_pers['pre_addr_id'] = $new_addr_id;
                    }else{
                        $data_update_pers['pre_addr_id'] = $data_update_pers['reg_addr_id'];
                    }

                    $data_update_pers['update_user_id']  = getUser();
                    $data_update_pers['update_org_id']   = get_session('org_id');
                    $data_update_pers['update_datetime'] = getDatetime();

                    $this->common_model->update('pers_info',$data_update_pers,array('pers_id'=>$data_insert['pers_id']));
                    /////////////////////////////////////////////////////////

                    $tmp_wisd  = @get_inpost_arr('wisd_branch[wisd_code]'); //รหัสสาขาภูมิปัญญา
                    $tmp_title = @get_inpost_arr('wisd_branch[wisd_sp_title]'); //เชี่ยวชาญเรื่อง
                    $tmp_url   = @get_inpost_arr('wisd_branch[wisd_sp_url]'); //ลิ้งค์เชี่ยวชาญเรื่อง

                    if (!empty($tmp_wisd)) {

                        // File upload //////////////////
                        $fileUpload = $this->files_model->do_multi_upload("wisd_file", 'assets/modules/intelprop/uploads/files');

                        //////////////////////////////////////////////////////

                        foreach ($tmp_wisd as $key => $value) {

                            if ($fileUpload != '') {
                                $wisd_sp_file  = $fileUpload[$key]['file'];
                                $wisd_sp_label = $fileUpload[$key]['name'];
                                $wisd_sp_size  = $_FILES['wisd_file']['size'][$key];
                            } else {
                                $wisd_sp_file  = "";
                                $wisd_sp_label = "";
                                $wisd_sp_size  = "";
                            }

                            $insert = array('knwl_id' => $id,
                                'wisd_code'               => $value,
                                'wisd_sp_title'           => $tmp_title[$key],
                                'wisd_sp_file'            => $wisd_sp_file,
                                'wisd_sp_label'           => $wisd_sp_label,
                                'wisd_sp_size'            => $wisd_sp_size,
                                'wisd_sp_url'             => $tmp_url[$key],
                                'insert_user_id'          => getUser(),
                                'insert_org_id'           => get_session('org_id'),
                                'insert_datetime'         => getDatetime(),
                            );

                            $id_branch = $this->common_model->insert('wisd_branch', $insert);

                            $id_photo = $this->files_model->getMultiImg("img_" . $key, 'assets/modules/intelprop/images');
                            if ($id_photo != "") {
                                foreach ($id_photo as $key_photo => $value_photo) {
                                    if ($value_photo['name'] != "") {
                                        $insert_photo = array('branch_id' => $id_branch,
                                            'wisdom_photo_file'               => $value_photo['file'],
                                            'wisdom_photo_label'              => $value_photo['name'],
                                            'wisdom_photo_size'               => $_FILES['img_' . $key]['size'][$key_photo],
                                            'wisdom_photo_describe'           => "");

                                        $this->common_model->insert('wisd_photo', $insert_photo);
                                    }
                                } // close loop foreach ($id_photo as $key_photo => $value_photo)
                            } // close loop if($id_photo!="")
                        } // close loop foreach ($tmp_wisd as $key => $value )

                    } // close loop if empty

                    $this->session->set_flashdata('msg', setMsg('011')); //Set Message code 011

                    $this->webinfo_model->LogSave($app_id, $process_action, 'Sign Out', 'Success'); //Save Sign Out Log

                    redirect('intelprop/intelprop_list', 'refresh');

                } else {

                    $data['wisd_info']      = array_merge($this->clr_olderp_info(),get_inpost_arr('wisd_info'));
                    $data['elder_addr_chk'] = set_value('elder_addr_chk');
                    $data['Valid']          = 'error';

                    $this->session->set_flashdata('msg', setMsg('012')); //Set Message code 012

                    $this->template->load('index_page', $data, 'intelprop');
                    $this->webinfo_model->LogSave($app_id, $process_action, 'Sign Out', 'Fail'); //Save Sign Out Log
                }

            } else if ($process_action == 'Edit' && get_inpost('bt_submit') == '' && $usrpm['perm_status'] == 'Yes') {
                $row = $this->wisd_model->getOnce_admInfo($adm_id);

                //เรียกข้อมูลสาขาปัญาตามเลขไดดี
                $wisd_branch = $this->wisd_model->get_wisd_branch_by_knwlid($row['knwl_id']);

                // dieArray($row);
                if (isset($row['knwl_id'])) {
                    $tmp_req_pers            = $this->personal_model->getPersonalInfo($row['pers_id']);
                    //dieArray($tmp_req_pers);
                    $data['pers_disability'] = $this->wisd_model->getAll_Disability($row['pers_id']);
                    $data['addr_info']       = $this->personal_model->getOnce_PersonalAddress($tmp_req_pers['pre_addr_id']);
                    $data['wisd_info']       = $row;

                    $tmp2 = $this->personal_model->getOnce_PersonalAddress($row['reg_addr_id']);
                    $data['wisd_info']['reg_add_info'] = @"{$tmp2['addr_home_no']} หมู่ {$tmp2['addr_moo']} ต. {$tmp2['addr_sub_district']} อ. {$tmp2['addr_district']} จ. {$tmp2['addr_province']} {$tmp2['addr_zipcode']}";
                    // dieArray($tmp_req_pers);

                    if ($row['date_of_reg'] != '') {
                        $tmp                              = explode('-', $row['date_of_reg']);
                        $data['wisd_info']['date_of_reg'] = $tmp[2] . '-' . $tmp[1] . '-' . $tmp[0];
                    } else {
                        $data['wisd_info']['date_of_reg'] = date("d-m-Y");
                    }

                    $data['wisd_info']['req_pid']            = $tmp_req_pers['pid'];
                    $data['wisd_info']['req_name']           = $tmp_req_pers['name'];
                    $data['wisd_info']['req_date_of_birth']  = $tmp_req_pers['date_of_birth'];
                    $data['wisd_info']['req_gender_name']    = $tmp_req_pers['gender_name'];
                    $data['wisd_info']['req_nation_name_th'] = $tmp_req_pers['nation_name_th'];
                    $data['wisd_info']['req_relg_title']     = $tmp_req_pers['relg_title'];

                    // $data['wisd_info']['tel_no_home']        = $tmp_req_pers['tel_no_home'];
                    $data['wisd_info']['tel_no_mobile']      = $tmp_req_pers['tel_no'];
                    // $data['wisd_info']['fax_no']             = $tmp_req_pers['fax_no'];
                    // $data['wisd_info']['email_addr']         = $tmp_req_pers['email_addr'];

                    $tmp_pers                            = $this->personal_model->getPersonalInfo($row['pers_id']);
                    $data['wisd_info']['pid']            = $tmp_pers['pid'];
                    $data['wisd_info']['name']           = $tmp_pers['name'];
                    $data['wisd_info']['date_of_birth']  = $tmp_pers['date_of_birth'];
                    $data['wisd_info']['gender_name']    = $tmp_pers['gender_name'];
                    $data['wisd_info']['nation_name_th'] = $tmp_pers['nation_name_th'];
                    $data['wisd_info']['relg_title']     = $tmp_pers['relg_title'];



                    $data['wisd_info']['reg_addr_id'] = $tmp_pers['reg_addr_id'];
                    $data['wisd_info']['pre_addr_id'] = $tmp_pers['pre_addr_id'];

                    //////////////////////////////////////////////////////////////////
                    $data['wisd_branch'] = $wisd_branch;
                    /////////////////////////////////////////////////////////////////

                    // dieArray($tmp_pers);
                    $this->template->load('index_page', $data, 'intelprop');
                } else {
                    page500();
                    $this->webinfo_model->LogSave($app_id, $process_action, 'Sign Out', 'Fail'); //Save Sign Out Log
                }

            } else if ($process_action == 'Edited' && get_inpost('bt_submit') != '' && $usrpm['perm_status'] == 'Yes') {
                //Edit && Submit Form
                $process_action = 'Edited';

                $this->load->library('form_validation');
                $frm = $this->form_validation;

                $frm->set_rules('wisd_info[date_of_reg]', 'วันที่แจ้งเรื่อง', 'callback_date_check');
                //$frm->set_rules('wisd_info[req_pid]','เลขประจำตัวประชาชน (ผู้แจ้งเรื่อง)','required');
                //$frm->set_rules('wisd_info[pid]','เลขประจำตัวประชาชน (ผู้สูงอายุ)','required');

                //if(get_inpost('rd_pers_id')==1) {
                //    $frm->set_rules('adm_info[pers_id]','เลขประจำตัวประชาชน','required');
                //}

                //$frm->set_rules('adm_info[elder_firstname]','ชื่อตัว','required');
                //$frm->set_rules('adm_info[elder_lastname]','ชื่อสกุล','required');

                //if(get_inpost('rd_req_pers_id')==1) {
                //    $frm->set_rules('adm_info[req_pers_id]','เลขประจำตัวประชาชนข้อมูลผู้ยื่นคำขอ','required');
                //}

                //$frm->set_rules('adm_info[req_firstname]','ชื่อสกุลผู้ยื่นคำขอ','required');
                //$frm->set_rules('adm_info[req_channel]','ช่องทางการรับแจ้ง','required');

                //$frm->set_rules('adm_info[date_of_visit]','วันที่ตรวจเยี่ยม','required|callback_date_check');
                //$frm->set_rules('adm_info[visitor_name]','เจ้าหน้าที่ผู้ตรวจเยี่ยม','required');

                $frm->set_message("required", "กรุณากรอกข้อมูล %s");
                $frm->set_message("numeric", "%s ต้องเป็นตัวเลข");
                $frm->set_message("date_check", "%s รูปแบบของวันที่ต้องถูกต้อง");

                if ($frm->run($this)) {
                    //Valid Data
                    //dieArray($_POST);

                    $data_update                    = array();
                    $data_update                    = get_inpost_arr('wisd_info');
                    $data_update_pers               = get_inpost_arr('pers_info');

                    $data_update_pers['tel_no']     = $data_update_pers['tel_no_mobile'];
                    unset($data_update_pers['tel_no_mobile']);

                    $data_update['date_of_reg']     = dateChange($data_update['date_of_reg']);
                    $data_update['update_user_id']  = getUser();
                    $data_update['update_org_id']   = get_session('org_id');
                    $data_update['update_datetime'] = getDatetime();

                    unset($data_update['pid']);

                    // dieArray($data_update);
                    $this->common_model->update('wisd_info', $data_update, array('knwl_id' => $adm_id));

                    /////////////////////////////////////////////////////////
                    $data_update_pers['update_user_id']  = getUser();
                    $data_update_pers['update_org_id']   = get_session('org_id');
                    $data_update_pers['update_datetime'] = getDatetime();

                     //update pers_info
                    if(get_inpost('elder_addr_chk')!='on') {

                        //กรณีทีไม่ได้เลือกที่อยู่ตามทะเบียนบ้าน
                        if(get_inpost('pre_addr_id')==''){//ไม่ได้ใส่ที่อยู่ปัจจุบัน
                           $this->common_model->update('pers_info',$data_update_pers,array('pers_id'=>$data_update['pers_id']));
                        }else{//กรณีเลือกที่อยูาตามทะเบียนบ้านอยู่ก่อนการแก้ไข
                            $data_insert_addr                       = get_inpost_arr('pers_addr');
                             //กรณีที่เลือกที่อยู่ปัจจุบันตรงตามทะเบียนบ้าน
                            if($data_update_pers['reg_addr_id'] ==get_inpost('pre_addr_id')){

                                $data_insert_addr['insert_user_id']     = getUser();
                                $data_insert_addr['insert_datetime']    = getDatetime();
                                $new_addr_id                            = $this->common_model->insert('pers_addr',$data_insert_addr);
                                $data_update_pers['pre_addr_id']        = $new_addr_id;
                                $this->common_model->update('pers_info',$data_update_pers,array('pers_id'=>$data_update['pers_id']));
                            }else{
                                $this->common_model->update('pers_info',$data_update_pers,array('pers_id'=>$data_update['pers_id']));
                                $this->common_model->update('pers_addr',$data_insert_addr,array('addr_id'=>get_inpost('pre_addr_id')));
                            }
                        }

                    }else{

                        if($data_update_pers['reg_addr_id'] !=get_inpost('pre_addr_id')){
                            $data_per_add = array();
                            $data_per_add['delete_user_id']  = getUser();
                            $data_per_add['delete_datetime'] = getDatetime();
                            $this->common_model->update('pers_addr',$data_per_add,array('addr_id'=>get_inpost('pre_addr_id')));

                            $data_update_pers['pre_addr_id'] = $data_update_pers['reg_addr_id'];
                        }

                        $this->common_model->update('pers_info',$data_update_pers,array('pers_id'=>$data_update['pers_id']));

                    }


                    /////////////////////////////////////////////////////////


                    ////////////////////////////////////////////////////////////////////////

                    $tmp_wisdupdate = @get_inpost_arr('wisd_branch[branch_id]'); //รหัส id สาขาภูมิปัญญา
                    $tmp_wisd       = @get_inpost_arr('wisd_branch[wisd_code]'); //รหัสสาขาภูมิปัญญา
                    $tmp_title      = @get_inpost_arr('wisd_branch[wisd_sp_title]'); //เชี่ยวชาญเรื่อง
                    $tmp_url        = @get_inpost_arr('wisd_branch[wisd_sp_url]'); //ลิ้งค์เชี่ยวชาญเรื่อง

                    if (!empty($tmp_wisd)) {

                        // File upload //////////////////
                        $fileUpload = $this->files_model->do_multi_upload("wisd_file", 'assets/modules/intelprop/uploads/files');

                        //////////////////////////////////////////////////////
                        foreach ($tmp_wisd as $key => $value) {

                            if (!empty($tmp_wisdupdate[$key])) {
                                 //ถ้ามีการแก้ไขข้อมูลในสาขาภูมิปัญญาที่มีอยู่เดิม

                                if ($fileUpload != '') {
                                    $wisd_sp_file  = $fileUpload[$key]['file'];
                                    $wisd_sp_label = $fileUpload[$key]['name'];
                                    $wisd_sp_size  = $_FILES['wisd_file']['size'][$key];

                                    $update_branch = array('wisd_code' => $tmp_wisd[$key],
                                        'wisd_sp_title'                    => $tmp_title[$key],
                                        'wisd_sp_file'                     => $wisd_sp_file,
                                        'wisd_sp_label'                    => $wisd_sp_label,
                                        'wisd_sp_size'                     => $wisd_sp_size,
                                        'update_user_id'                   => getUser(),
                                        'update_org_id'                    => get_session('org_id'),
                                        'update_datetime'                  => getDatetime());

                                    $this->common_model->update('wisd_branch', $update_branch, array('branch_id' => $tmp_wisdupdate[$key]));
                                } else {

                                    $update_branch = array('wisd_code' => $tmp_wisd[$key],
                                        'wisd_sp_title'                    => $tmp_title[$key],
                                        'update_user_id'                   => getUser(),
                                        'update_org_id'                    => get_session('org_id'),
                                        'update_datetime'                  => getDatetime());

                                    $this->common_model->update('wisd_branch', $update_branch, array('branch_id' => $tmp_wisdupdate[$key]));
                                }

                                $id_photo = $this->files_model->getMultiImg("img_".$key,'assets/modules/intelprop/images');
                                if ($id_photo != "") {
                                    foreach ($id_photo as $key_photo => $value_photo) {
                                        if ($value_photo['name'] != "") {

                                            $insert_photo = array('branch_id' => $tmp_wisdupdate[$key],
                                                'wisdom_photo_file'               => $value_photo['file'],
                                                'wisdom_photo_label'              => $value_photo['name'],
                                                'wisdom_photo_size'               => $_FILES['img_'.$key]['size'][$key_photo],
                                                'wisdom_photo_describe'           => "");

                                                 $this->common_model->insert('wisd_photo', $insert_photo);
                                        }
                                    } // close loop foreach ($id_photo as $key_photo => $value_photo)
                                } // close loop if($id_photo!="")

                            } else {

                                if ($fileUpload != '') {
                                    $wisd_sp_file  = $fileUpload[$key]['file'];
                                    $wisd_sp_label = $fileUpload[$key]['name'];
                                    $wisd_sp_size  = $_FILES['wisd_file']['size'][$key];
                                } else {
                                    $wisd_sp_file  = "";
                                    $wisd_sp_label = "";
                                    $wisd_sp_size  = "";
                                }

                                $insert = array('knwl_id' => $adm_id,
                                    'wisd_code'               => $value,
                                    'wisd_sp_title'           => $tmp_title[$key],
                                    'wisd_sp_file'            => $wisd_sp_file,
                                    'wisd_sp_label'           => $wisd_sp_label,
                                    'wisd_sp_size'            => $wisd_sp_size,
                                    'wisd_sp_url'             => $tmp_url[$key],
                                    'insert_user_id'          => getUser(),
                                    'insert_org_id'           => get_session('org_id'),
                                    'insert_datetime'         => getDatetime(),
                                );

                                $id_branch = $this->common_model->insert('wisd_branch', $insert);

                                $id_photo = $this->files_model->getMultiImg("img_" . $key, 'assets/modules/intelprop/images');
                                if ($id_photo != "") {
                                    foreach ($id_photo as $key_photo => $value_photo) {
                                        if ($value_photo['name'] != "") {
                                            $insert_photo = array('branch_id' => $id_branch,
                                                'wisdom_photo_file'               => $value_photo['file'],
                                                'wisdom_photo_label'              => $value_photo['name'],
                                                'wisdom_photo_size'               => $_FILES['img_' . $key]['size'][$key_photo],
                                                'wisdom_photo_describe'           => "");

                                          $this->common_model->insert('wisd_photo', $insert_photo);
                                        }
                                    } // close loop foreach ($id_photo as $key_photo => $value_photo)
                                } // close loop if($id_photo!="")

                            } // close loop else->if(!empty($tmp_wisdupdate))

                        } // close loop foreach ($tmp_wisd as $key => $value )

                    } // close loop if(!empty($tmp_wisd))

                    $this->session->set_flashdata('msg', setMsg('021')); //Set Message code 021
                    $this->webinfo_model->LogSave($app_id, $process_action, 'Sign Out', 'Success'); //Save Sign Out Log
                    redirect('intelprop/intelprop_list', 'refresh');

                } else {
                    // set value ////////////////////////////////////////////
                    $data['wisd_info']      = get_inpost_arr('wisd_info');
                    $data['elder_pers_chk'] = set_value('elder_pers_chk');
                    /////////////////////////////////////////////////////////
                    $this->session->set_flashdata('msg', setMsg('022')); //Set Message code 022
                    $this->template->load('index_page', $data, 'intelprop');
                    $this->webinfo_model->LogSave($app_id, $process_action, 'Sign Out', 'Fail'); //Save Sign Out Log
                }

            } else if ($process_action == 'Delete' && $usrpm['perm_status'] == 'Yes') {
                //Delete process
                $data_update                    = array();
                $data_update['delete_user_id']  = getUser();
                $data_update['delete_org_id']   = get_session('org_id');
                $data_update['delete_datetime'] = getDatetime();

                $this->common_model->update('wisd_info', $data_update, array('knwl_id' => $adm_id));
                $this->session->set_flashdata('msg', setMsg('031')); //Set Message code 031
                $this->webinfo_model->LogSave($app_id, $process_action, 'Sign Out', 'Success'); //Save Sign Out Log
                redirect('intelprop/intelprop_list', 'refresh');
            } else {
                page500();
                $this->template->load('index_page', $data, 'intelprop');
                $this->webinfo_model->LogSave($app_id, $process_action, 'Sign Out', 'Fail'); //Save Sign Out Log
            }
        }
    }

    public function olderp_info2($process_action = 'Add', $adm_id = 0)
    {
        //(ข้อมูลทะเบียนประวัติผู้สูงอายุที่มีภูมิปัญญา)
        $data = array(); //Set Initial Variable to Views
        /*-- Initial Data for Check User Permission --*/
        $user_id      = get_session('user_id');
        $app_id       = 161;
        $process_path = 'intelprop/olderp_info2';

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
              //set_css_asset_head('../plugins/bootstrap-datepicker1.3.0/css/datepicker.css');
              //set_js_asset_head('../plugins/bootstrap-datepicker1.3.0/js/bootstrap-datepicker.js');
              /*-- End datepicker --*/

              /*-- datepicker custom --*/
              set_css_asset_head('../plugins/bootstrap-datepicker-custom/dist/css/bootstrap-datepicker.css');
              set_js_asset_head('../plugins/bootstrap-datepicker-custom/dist/js/bootstrap-datepicker-custom.js');
              set_js_asset_head('../plugins/bootstrap-datepicker-custom/dist/locales/bootstrap-datepicker.th.min.js');
              /*-- End datepicker custom--*/

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

            /*-- fileupload style --*/

            // set_js_asset_footer('mapmarker.js','webconfig'); //Set JS mapmarker.js --

            set_css_asset_head('../modules/intelprop/css/gallery_img.css');
            set_js_asset_footer('webservice.js','personals'); //Set JS sufferer_form1.js
            set_js_asset_footer('olderp_info.js', 'intelprop'); //Set JS
            set_js_asset_footer('mapmarker_interprop.js', 'intelprop'); //Set JS

            $data['process_action'] = $process_action;
            $data['content_view']   = 'olderp_info2';

            $tmp                = $this->admin_model->getOnce_Application($usrpm['app_parent_id']); //Used for find root application
            $data['head_title'] = $tmp['app_name'];
            $data['title']      = $usrpm['app_name'];

            $data['csrf'] = array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash(),
            );
            if ($process_action == 'Add' && get_inpost('bt_submit') == '' && $usrpm['perm_status'] == 'Yes') {
                 $this->template->load('index_page', $data, 'intelprop');           
            }
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
