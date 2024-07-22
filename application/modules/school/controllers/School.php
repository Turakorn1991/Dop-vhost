<?php
defined('BASEPATH') or exit('No direct script access allowed');

class School extends MX_Controller
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

    public function school_list($process_action = 'View')
    { // ตารางข้อมูล
        $data = array(); //Set Initial Variable to Views
        /*-- Initial Data for Check User Permission --*/
        $user_id = get_session('user_id');
        $app_id = 58;
        $process_path = 'school/school_list';
        /*--END Inizial Data for Check User Permission--*/

        $this->webinfo_model->LogSave($app_id, $process_action, 'Sign In', 'Success'); //Save Sign In Log
        $usrpm = $this->admin_model->chkOnce_usrmPermiss($app_id, $user_id); //Check User Permission

        if (@$usrpm['perm_status'] == 'No' || !isset($usrpm['app_id'])) {
            page500();
            $this->webinfo_model->LogSave($app_id, $process_action, 'Sign Out', 'Fail'); //Save Sign In Log
        } else {
            $app_name = $usrpm['app_name'];
            $data['usrpm'] = $usrpm;
            $data['user_id'] = $user_id;

            $data['schl_info'] = $this->school_model->get_filteredSchoolList();
            // die(json_encode($data['schl_info']));

            $this->load->library('template',
                array('name' => 'admin_template1',
                    'setting' => array('data_output' => ''))
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

            set_js_asset_footer('school_list.js', 'school'); //Set JS Index.js

            set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/ionRangeSlider/ion.rangeSlider.min.js'); //Set JS Index.js

            $data['process_action'] = $process_action;
            $data['content_view'] = 'school_list';

            $tmp = $this->admin_model->getOnce_Application($usrpm['app_parent_id']); //Used for find root application
            $data['head_title'] = $tmp['app_name'];
            $data['title'] = $usrpm['app_name'];
            $data['csrf'] = array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash(),
            );
            $data['posted'] = $this->input->post();
            $this->template->load('index_page', $data, 'school');
            $this->webinfo_model->LogSave($app_id, $process_action, 'Sign Out', 'Success'); //Save Sign Out Log
        }

    }

    public function update_status()
    {
        $this->db->update('schl_info', array(
            'schl_status' => $this->input->post('schl_status'),
            'update_user_id' => getUser(),
            'update_org_id' => get_session('org_id'),
            'update_datetime' => getDatetime(),
        ), array('schl_id' => $this->input->post('schl_id')));
        redirect('school/school_list', 'refresh');
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

    private function clr_schlInfo_center()
    {
        return array(

            'qlc_name' => '',
            'addr_sub_district' => '',
            'addr_district' => '',
            'addr_province' => '',
            'addr_gps' => '',
            'tel_no' => '',
            'fax_no' => '',
            'email_addr' => '',
            'agency_org' => '',
        );
    }

    private function clr_schlInfo_school1()
    {
        return array(
            'schl_name' => '',
            'date_of_established' => '',
            'month_of_established' => '',
            'year_of_established' => '',
            'addr_home_no' => '',
            'addr_moo' => '',
            'addr_alley' => '',
            'addr_lane' => '',
            'addr_road' => '',
            'addr_sub_district' => '',
            'addr_district' => '',
            'addr_province' => '',
            'addr_zipcode' => '',
            'addr_gps' => '',
            'tel_no' => '',
            'fax_no' => '',
            'email_addr' => '',
            'agency_org' => '',

        );
    }

    //add code qlc_kpi
    private function clr_schlInfo_school_info_contacts()
    {
        return array(
            'sch_cnt_name' => '',
            'sch_cnt_title' => '',
            'sch_cnt_tel_no' => '',
        );
    }

    //add code qlc_coordinator
    private function clr_schlInfo_center_coor()
    {
        return array(

            'pren_code' => '',
            'qlc_coor_firstname_th' => '',
            'qlc_coor_lastname_th' => '',
            'qlc_coor_position' => '',
            'qlc_coor_tel_no' => '',
            'qlc_tel_no' => '',
            'qlc_fax_no' => '',
            'qlc_coor_email_addr' => '',
        );
    }

    //add code qlc_agency
    private function clr_schlInfo_center_agency()
    {
        return array(
            'qlc_agency_name' => '',
            'addr_home_no' => '',
            'addr_moo' => '',
            'addr_alley' => '',
            'addr_lane' => '',
            'addr_road' => '',
            'addr_sub_district' => '',
            'addr_district' => '',
            'addr_province' => '',
            'addr_zipcode' => '',
            'addr_gps' => '',
            'tel_no' => '',
            'fax_no' => '',
            'email_addr' => '',
        );
    }

    //add code qlc_agency_coordinator
    private function clr_schlInfo_center_agency_coor()
    {
        return array(

            'pren_code' => '',
            'qlc_agency_coor_firstname_th' => '',
            'qlc_agency_coor_lastname_th' => '',
            'qlc_agency_coor_position' => '',
            'qlc_agency_coor_tel_no' => '',
            'qlc_agency_tel_no' => '',
            'qlc_agency_fax_no' => '',
            'qlc_agency_coor_email_addr' => '',
        );
    }

    //add code qlc_kpi
    private function clr_schlInfo_center_kpi()
    {
        return array(
            'qlc_id' => '',
            'qlc_kpi_code' => '',
            'qlc_kpi_result' => '',
        );
    }

    public function school1($process_action = 'Add', $schl_id = 0)
    { //แบบขึ้นทะเบียน (โรงเรียน)
        $data = array(); //Set Initial Variable to Views
        /*-- Initial Data for Check User Permission --*/
        $user_id = get_session('user_id');
        $app_id = 59;
        $process_path = 'school/school1';
        /*--END Inizial Data for Check User Permission--*/

        $this->webinfo_model->LogSave($app_id, $process_action, 'Sign In', 'Success'); //Save Sign In Log
        $usrpm = $this->admin_model->chkOnce_usrmPermiss($app_id, $user_id); //Check User Permission

        if (@$usrpm['perm_status'] == 'No' || !isset($usrpm['app_id'])) {
            page500();
            $this->webinfo_model->LogSave($app_id, $process_action, 'Sign Out', 'Fail'); //Save Sign Out Log
        } else {
            $app_name = $usrpm['app_name'];
            $data['usrpm'] = $usrpm;
            $data['user_id'] = $user_id;

            $this->load->library('template',
                array('name' => 'admin_template1',
                    'setting' => array('data_output' => ''))
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

            set_js_asset_footer('mapmarker.js', 'webconfig'); //Set JS mapmarker.js --

            set_js_asset_footer('school1.js', 'school'); //Set JS sufferer_form1.js

            $data['process_action'] = $process_action;
            $data['content_view'] = 'school1';

            $tmp = $this->admin_model->getOnce_Application($usrpm['app_parent_id']); //Used for find root application
            $data['head_title'] = $tmp['app_name'];
            $data['title'] = $usrpm['app_name'];

            $data['csrf'] = array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash(),
            );

            if ($process_action == 'Add' && get_inpost('bt_submit') == '' && $usrpm['perm_status'] == 'Yes') {

                $data['schl_info'] = $this->clr_schlInfo_school1();
                $data['schl_contacts'] = $this->clr_schlInfo_school1();
                $data['std_model'] = $this->school_model->get_std_model(); //แสดงคุณสมบัติต้นแบบ
                $this->template->load('index_page', $data, 'school');
                $this->webinfo_model->LogSave($app_id, $process_action, 'Sign Out', 'Success'); //Save Sign Out Log

            } else if ($process_action == 'Added' && get_inpost('bt_submit') != '' && $usrpm['perm_status'] == 'Yes') { //Add && Submit Form

                //dieArray($_POST);

                $data_insert = array();
                $data_insert = @get_inpost_arr('schl_info');

                // dieArray($data_insert);
                $data_insert['insert_user_id'] = getUser();
                $data_insert['insert_org_id'] = get_session('org_id');
                $data_insert['insert_datetime'] = getDatetime();

                $id = $this->common_model->insert('schl_info', $data_insert);

                $tmp_cnt_name = @get_inpost_arr('schl_contacts[sch_cnt_name]'); //ชื่อ-นามสกุลเจ้าหน้าที่
                $tmp_cnt_title = @get_inpost_arr('schl_contacts[sch_cnt_title]'); //ตำแหน่งงาน
                $tmp_mobile = @get_inpost_arr('schl_contacts[tel_no]'); //เบอร์ตืดต่อ
                $tmp_model = @get_inpost_arr('std_model'); //คุณสมบัติโรงเรียนต้นแบบ
                $tmp_mdl_remark = @get_inpost_arr('mdl_remark'); //ความคิดเห็นเจ้าหน้าที่

                if (!empty($tmp_model)) {
                    foreach ($tmp_model as $key_model => $val_model) {

                        $insert_model = array('schl_id' => $id,
                            'mdl_code' => $val_model,
                            'mdl_remark' => $tmp_mdl_remark[$key_model],
                        );
                        $this->common_model->insert('schl_model', $insert_model);
                    }
                }

                if (!empty($tmp_cnt_name)) {

                    foreach ($tmp_cnt_name as $key => $value) {
                        $insert_contacts = array('sch_id' => $id,
                            'sch_cnt_name' => $value,
                            'sch_cnt_title' => $tmp_cnt_title[$key],
                            'sch_cnt_tel_no' => $tmp_mobile[$key],
                        );
                        $this->common_model->insert('schl_info_contacts', $insert_contacts);
                    } //close loop foreach ($tmp_cnt_name as $key => $value)
                    //dieArray($_POST);
                }

                $this->session->set_flashdata('msg', setMsg('011')); //Set Message code 011

                $this->webinfo_model->LogSave($app_id, $process_action, 'Sign Out', 'Success'); //Save Sign Out Log

                redirect('school/photo2/Edit/' . $id, 'refresh');

            } else if ($process_action == 'Edit' && get_inpost('bt_submit') == '' && $usrpm['perm_status'] == 'Yes') {

                if ($schl_id != '') {

                    $schl_info = $this->school_model->getOnce_schlInfo($schl_id);

                    if (isset($schl_info['schl_id'])) {
                        foreach ($schl_info as $key => $value) {
                            $data['schl_info'][$key] = $value;
                            $data['std_model'] = $this->school_model->get_std_model(); //แสดงคุณสมบัติต้นแบบ
                        }
                    }

                    $data['edit_model'] = $this->school_model->edit_std_model($schl_id); //แก้ไขคุณสมบัติโรงเรียนต้นแบบ
                    $data['schl_contacts'] = $this->common_model->custom_query("SELECT * FROM schl_info_contacts WHERE sch_id = {$schl_id}");
                    // = ;
                    // dieArray($data);
                    $this->template->load('index_page', $data, 'school');

                } else {
                    page500();
                    $this->webinfo_model->LogSave($app_id, $process_action, 'Sign Out', 'Fail'); //Save Sign Out Log
                }

            } else if ($process_action == 'Edited' && get_inpost('bt_submit') != '' && $usrpm['perm_status'] == 'Yes') { //Edit && Submit Form
                $process_action = 'Edited';

                $data_insert = array();
                $data_insert = @get_inpost_arr('schl_info');
                $data_insert['update_user_id'] = getUser();
                $data_insert['update_org_id'] = get_session('org_id');
                $data_insert['update_datetime'] = getDatetime();

                $this->common_model->update('schl_info', $data_insert, array('schl_id' => $schl_id));

                $update_contacts = @get_inpost_arr('update_contacts'); //จำนวนเจ้าหน้าที่ที่มีการเพิ่มอยู่แล้ว
                $tmp_cnt_name = @get_inpost_arr('schl_contacts[sch_cnt_name]'); //ชื่อ-นามสกุลเจ้าหน้าที่
                $tmp_cnt_title = @get_inpost_arr('schl_contacts[sch_cnt_title]'); //ตำแหน่งงาน
                $tmp_mobile = @get_inpost_arr('schl_contacts[sch_cnt_tel_no]'); //เบอร์ตืดต่อ
                $tmp_model = @get_inpost_arr('std_model'); //แสดงคุณสมบัติต้นแบบ
                $tmp_mdl_remark = @get_inpost_arr('mdl_remark'); //ความคิดเห็นเจ้าหน้าที่

                $this->common_model->delete_where("schl_model", 'schl_id', $schl_id);
                if (!empty($tmp_model)) {
                    foreach ($tmp_model as $key_model => $val_model) {

                        $insert_model = array('schl_id' => $schl_id,
                            'mdl_code' => $val_model,
                            'mdl_remark' => $tmp_mdl_remark[$key_model],
                        );
                        $this->common_model->insert('schl_model', $insert_model);
                    }
                }

                if (!empty($tmp_cnt_name)) {

                    foreach ($tmp_cnt_name as $key => $value) {

                        if (!empty($update_contacts[$key])) {
                            $data_contacts = array('sch_cnt_name' => $value,
                                'sch_cnt_title' => $tmp_cnt_title[$key],
                                'sch_cnt_tel_no' => $tmp_mobile[$key],
                            );

                            $this->common_model->update('schl_info_contacts', $data_contacts, array('sch_cnt_id' => $update_contacts[$key]));
                        } else {
                            $insert_contacts = array('sch_id' => $schl_id,
                                'sch_cnt_name' => $value,
                                'sch_cnt_title' => $tmp_cnt_title[$key],
                                'sch_cnt_tel_no' => $tmp_mobile[$key],
                            );
                            $this->common_model->insert('schl_info_contacts', $insert_contacts);
                        }
                    } //close loop foreach ($tmp_cnt_name as $key => $value)
                    //dieArray($_POST);
                }

                $this->session->set_flashdata('msg', setMsg('021')); //Set Message code 021

                $this->webinfo_model->LogSave($app_id, $process_action, 'Sign Out', 'Success'); //Save Sign Out Log

                redirect('school/school1/Edit/' . $schl_id, 'refresh');

            } else if ($process_action == 'Delete' && $usrpm['perm_status'] == 'Yes') { //Delete process
                //Delete process
                $data_update = array();
                $data_update['delete_user_id'] = getUser();
                $data_update['delete_org_id'] = get_session('org_id');
                $data_update['delete_datetime'] = getDatetime();

                $this->common_model->update('schl_info', $data_update, array('schl_id' => $schl_id));
                $this->session->set_flashdata('msg', setMsg('031')); //Set Message code 031
                $this->webinfo_model->LogSave($app_id, $process_action, 'Sign Out', 'Success'); //Save Sign Out Log
                redirect('school/school_list', 'refresh');
            } else {
                page500();
                $this->template->load('index_page', $data, 'difficult');
                $this->webinfo_model->LogSave($app_id, $process_action, 'Sign Out', 'Fail'); //Save Sign Out Log
            }

        }

    }

    //=== START - NEW!!! tab 4 - School_Model ===

    public function school_model($process_action = 'Add', $schl_id = 0)
    { //แบบขึ้นทะเบียน (โรงเรียน)
        $data = array(); //Set Initial Variable to Views
        /*-- Initial Data for Check User Permission --*/
        $user_id = get_session('user_id');
        $app_id = 59;
        $process_path = 'school/school_model';
        /*--END Inizial Data for Check User Permission--*/

        $this->webinfo_model->LogSave($app_id, $process_action, 'Sign In', 'Success'); //Save Sign In Log
        $usrpm = $this->admin_model->chkOnce_usrmPermiss($app_id, $user_id); //Check User Permission

        if (@$usrpm['perm_status'] == 'No' || !isset($usrpm['app_id'])) {
            page500();
            $this->webinfo_model->LogSave($app_id, $process_action, 'Sign Out', 'Fail'); //Save Sign Out Log
        } else {
            $app_name = $usrpm['app_name'];
            $data['usrpm'] = $usrpm;
            $data['user_id'] = $user_id;

            $this->load->library('template',
                array('name' => 'admin_template1',
                    'setting' => array('data_output' => ''))
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

            set_js_asset_footer('mapmarker.js', 'webconfig'); //Set JS mapmarker.js --
            set_js_asset_footer('school_model.js', 'school'); //Set JS sufferer_form1.js

            $data['process_action'] = $process_action;
            $data['content_view'] = 'school_model';

            $tmp = $this->admin_model->getOnce_Application($usrpm['app_parent_id']); //Used for find root application
            $data['head_title'] = $tmp['app_name'];
            $data['title'] = $usrpm['app_name'];

            $data['csrf'] = array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash(),
            );

            if ($process_action == 'Add' && get_inpost('bt_submit') == '' && $usrpm['perm_status'] == 'Yes') {

                $data['schl_info'] = $this->clr_schlInfo_school1();
                $data['schl_contacts'] = $this->clr_schlInfo_school1();
                $data['std_model'] = $this->school_model->get_std_model(); //แสดงคุณสมบัติต้นแบบ
                $this->template->load('index_page', $data, 'school');
                $this->webinfo_model->LogSave($app_id, $process_action, 'Sign Out', 'Success'); //Save Sign Out Log

            } else if ($process_action == 'Added' && get_inpost('bt_submit') != '' && $usrpm['perm_status'] == 'Yes') { //Add && Submit Form

                //dieArray($_POST);

                $data_insert = array();
                $data_insert = @get_inpost_arr('schl_info');

                // dieArray($data_insert);
                $data_insert['insert_user_id'] = getUser();
                $data_insert['insert_org_id'] = get_session('org_id');
                $data_insert['insert_datetime'] = getDatetime();

                $id = $this->common_model->insert('schl_info', $data_insert);

                $tmp_cnt_name = @get_inpost_arr('schl_contacts[sch_cnt_name]'); //ชื่อ-นามสกุลเจ้าหน้าที่
                $tmp_cnt_title = @get_inpost_arr('schl_contacts[sch_cnt_title]'); //ตำแหน่งงาน
                $tmp_mobile = @get_inpost_arr('schl_contacts[tel_no]'); //เบอร์ตืดต่อ
                $tmp_model = @get_inpost_arr('std_model'); //คุณสมบัติโรงเรียนต้นแบบ
                $tmp_mdl_remark = @get_inpost_arr('mdl_remark'); //ความคิดเห็นเจ้าหน้าที่

                if (!empty($tmp_model)) {
                    foreach ($tmp_model as $key_model => $val_model) {

                        $insert_model = array('schl_id' => $id,
                            'mdl_code' => $val_model,
                            'mdl_remark' => $tmp_mdl_remark[$key_model],
                        );
                        $this->common_model->insert('schl_model', $insert_model);
                    }
                }

                if (!empty($tmp_cnt_name)) {

                    foreach ($tmp_cnt_name as $key => $value) {
                        $insert_contacts = array('sch_id' => $id,
                            'sch_cnt_name' => $value,
                            'sch_cnt_title' => $tmp_cnt_title[$key],
                            'sch_cnt_tel_no' => $tmp_mobile[$key],
                        );
                        $this->common_model->insert('schl_info_contacts', $insert_contacts);
                    } //close loop foreach ($tmp_cnt_name as $key => $value)
                    //dieArray($_POST);
                }

                $this->session->set_flashdata('msg', setMsg('011')); //Set Message code 011

                $this->webinfo_model->LogSave($app_id, $process_action, 'Sign Out', 'Success'); //Save Sign Out Log

                redirect('school/photo2/Edit/' . $id, 'refresh');

            } else if ($process_action == 'Edit' && get_inpost('bt_submit') == '' && $usrpm['perm_status'] == 'Yes') {

                if (empty($schl_id)) {
                    page500();
                    $this->webinfo_model->LogSave($app_id, $process_action, 'Sign Out', 'Fail'); //Save Sign Out Log
                }

                $data['schl_info'] = $this->school_model->getOnce_schlInfo($schl_id);
                $data['schl_evaluations_raw'] = $this->school_model->get_rawSchoolEvaluations($schl_id);
                $data['schl_evaluations_group'] = $this->school_model->get_groupSchoolEvaluations($schl_id);
                $data['std_model'] = $this->school_model->get_std_model();
                $data['schl_contacts'] = $this->common_model->custom_query("SELECT * FROM schl_info_contacts WHERE sch_id = {$schl_id}");

                $this->template->load('index_page', $data, 'school');

            } else if ($process_action == 'Edited' && get_inpost('bt_submit') != '' && $usrpm['perm_status'] == 'Yes') { //Edit && Submit Form
                $process_action = 'Edited';

                $data_insert = array();
                $data_insert = @get_inpost_arr('schl_info');
                $data_insert['update_user_id'] = getUser();
                $data_insert['update_org_id'] = get_session('org_id');
                $data_insert['update_datetime'] = getDatetime();

                $this->common_model->update('schl_info', $data_insert, array('schl_id' => $schl_id));

                $update_contacts = @get_inpost_arr('update_contacts'); //จำนวนเจ้าหน้าที่ที่มีการเพิ่มอยู่แล้ว
                $tmp_cnt_name = @get_inpost_arr('schl_contacts[sch_cnt_name]'); //ชื่อ-นามสกุลเจ้าหน้าที่
                $tmp_cnt_title = @get_inpost_arr('schl_contacts[sch_cnt_title]'); //ตำแหน่งงาน
                $tmp_mobile = @get_inpost_arr('schl_contacts[sch_cnt_tel_no]'); //เบอร์ตืดต่อ
                $tmp_model = @get_inpost_arr('std_model'); //แสดงคุณสมบัติต้นแบบ
                $tmp_mdl_remark = @get_inpost_arr('mdl_remark'); //ความคิดเห็นเจ้าหน้าที่

                $this->common_model->delete_where("schl_model", 'schl_id', $schl_id);
                if (!empty($tmp_model)) {
                    foreach ($tmp_model as $key_model => $val_model) {

                        $insert_model = array('schl_id' => $schl_id,
                            'mdl_code' => $val_model,
                            'mdl_remark' => $tmp_mdl_remark[$key_model],
                        );
                        $this->common_model->insert('schl_model', $insert_model);
                    }
                }

                if (!empty($tmp_cnt_name)) {

                    foreach ($tmp_cnt_name as $key => $value) {

                        if (!empty($update_contacts[$key])) {
                            $data_contacts = array('sch_cnt_name' => $value,
                                'sch_cnt_title' => $tmp_cnt_title[$key],
                                'sch_cnt_tel_no' => $tmp_mobile[$key],
                            );

                            $this->common_model->update('schl_info_contacts', $data_contacts, array('sch_cnt_id' => $update_contacts[$key]));
                        } else {
                            $insert_contacts = array('sch_id' => $schl_id,
                                'sch_cnt_name' => $value,
                                'sch_cnt_title' => $tmp_cnt_title[$key],
                                'sch_cnt_tel_no' => $tmp_mobile[$key],
                            );
                            $this->common_model->insert('schl_info_contacts', $insert_contacts);
                        }
                    } //close loop foreach ($tmp_cnt_name as $key => $value)
                    //dieArray($_POST);
                }

                $this->session->set_flashdata('msg', setMsg('021')); //Set Message code 021

                $this->webinfo_model->LogSave($app_id, $process_action, 'Sign Out', 'Success'); //Save Sign Out Log

                redirect('school/school1/Edit/' . $schl_id, 'refresh');

            } else if ($process_action == 'Delete' && $usrpm['perm_status'] == 'Yes') { //Delete process
                //Delete process
                $data_update = array();
                $data_update['delete_user_id'] = getUser();
                $data_update['delete_org_id'] = get_session('org_id');
                $data_update['delete_datetime'] = getDatetime();

                $this->common_model->update('schl_info', $data_update, array('schl_id' => $schl_id));
                $this->session->set_flashdata('msg', setMsg('031')); //Set Message code 031
                $this->webinfo_model->LogSave($app_id, $process_action, 'Sign Out', 'Success'); //Save Sign Out Log
                redirect('school/school_list', 'refresh');
            } else {
                page500();
                $this->template->load('index_page', $data, 'difficult');
                $this->webinfo_model->LogSave($app_id, $process_action, 'Sign Out', 'Fail'); //Save Sign Out Log
            }

        }

    }

    public function add_schl_models()
    {
        $mdl_codes = $this->input->post('mdl_code');
        $mdl_comments = $this->input->post('mdl_comment');
        $now = getDatetime();
        foreach ($mdl_codes as $code) {
            $batch[] = array(
                'schl_id' => $this->input->post('schl_id'),
                'mdl_code' => $code,
                'mdl_comment' => $mdl_comments[$code],
                'mdl_result' => 'มี',
                'insert_datetime' => $now,
                'insert_user_id' => get_session('user_id'),
                'insert_org_id' => get_session('org_id'),
            );
        }

        $this->school_model->insertBatch_schoolModels($batch);
        redirect("school/school_model/Edit/" . $this->input->post('schl_id'), "refresh");
    }

    public function delete_schl_models()
    {
        $this->school_model->delete_schoolModels(array(
            'schl_id' => $this->input->post('schl_id'),
            'insert_datetime' => $this->input->post('insert_datetime'),
        ));
        redirect("school/school_model/Edit/" . $this->input->post('schl_id'), "refresh");
    }

    //=== END - NEW!!! tab 4 - Model ===

    //=== upload image : start code ===
    public function aof()
    { //ฟังก์ชันสำหรับทดสอบ แต่ไม่ได้ใช้จริง
        $config = [
            //'upload_path' => './uploads',
            'upload_path' => './assets/modules/school/images/uploads',
            'allowed_types' => 'gif|png|jpg|jpeg',
        ];
        // $config['upload_path']          = './uploads/';
        // $config['allowed_types']        = 'gif|jpg|png|jpeg';
        // $config['max_size']             = 100;
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;

        $this->load->library('upload', $config);

        // $this->form_validation->set_error_delimiters();
        if ($this->upload->do_upload()) {
            $data = $this->input->post();
            $info = $this->upload->data();
/*             echo '<pre>';
print_r($info);
echo '</pre>'; */
        } else {

            echo "<p>" . "DIE" . "</p>";
        }
    }

    public function opal()
    { //ฟังก์ชันสำหรับทดสอบ แต่ไม่ได้ใช้จริง

        $this->load->model('files_model', 'files_model');

        if ($_FILES['img']['name'][0] != "") {
            $info = $this->files_model->getMultiImg("img", 'assets/modules/school/images/uploads');
/*             echo '<pre>';
print_r($info);
echo '</pre>'; */
        } else {
            echo "<p>" . "DIE" . "</p>";
        }
    }

    public function del_impv_photo()
    { //ฟังก์ชันสำหรับทดสอบ แต่ไม่ได้ใช้จริง

        //Delete process
        //$data_update                    = array();

        $id_photo = $this->input->get('photo_id'); //filename

        //$center_kpi_info = $this->school_model->getAll_CenterAgency($qlc_id);//add code qlc_agency
        //$id = $qlc_id;
        //$center_kpi_results = $this->common_model->update('qlc_kpi',$data_update,array('qlc_id'=>$id, 'insert_datetime'=>$kpi_qlc_insert_dt));

        //$id_photo = get_inpost('id_photo');

        $photo_file_name = $this->common_model->custom_query("select photo_file_name from schl_photo where photo_id = {$id_photo}");

        $photo_file = $photo_file_name[0]['photo_file_name'];

        $this->load->helper('string');

        //$rpath = $_SERVER['DOCUMENT_ROOT'].'/uploads/';

        $rpath = $_SERVER['DOCUMENT_ROOT'];

        $path = increment_string($rpath, '/assets/modules/school/images/uploads/', $photo_file);

        //$path = increment_string($rpath, '/', $photo_file);

        echo '<pre>';
        //print_r($photo_file);
        print_r($path);
        echo '</pre>';

        $this->load->helper("file");

        delete_files($path);

        unlink($path);

        $this->common_model->delete_where('schl_photo', 'photo_id', $id_photo);

        //echo "remove";

        //redirect('school/photo2/Edit/'.$id,'refresh');
    }

    public function photo_modal()
    { //js will called data from this model-function (photo album - photos [view photo in album])
        $id_album = $this->input->get('album_id'); //filename

        //$photo_file_name = $this->common_model->custom_query("select photo_file_name from schl_photo where album_id = {$id_album}");

        $photo_file_name = $this->common_model->custom_query("select b.album_id	as al_album_id,
		b.album_title		    as al_album_title,
		b.album_description		as al_album_description,
		b.schl_id			  	as al_schl_id,
		b.insert_user_id	 	as al_insert_user_id,
		b.insert_org_id		 	as al_insert_org_id,
		b.insert_datetime	  	as al_insert_datetime,
		b.update_user_id	 	as al_update_user_id,
		b.update_org_id		 	as al_update_org_id,
		b.update_datetime	 	as al_update_datetime,
		b.delete_user_id	  	as al_delete_user_id,
		b.delete_org_id		  	as al_delete_org_id,
		b.delete_datetime   	as al_delete_datetime,
		a.photo_id 			    as ph_photo_id,
		a.photo_title 		  	as ph_photo_title,
		a.schl_id 			    as ph_schl_id,
		a.photo_file_name 		as ph_photo_file_name,
		a.photo_thumbnail 		as ph_photo_thumbnail,
		a.photo_description 	as ph_photo_description,
		a.album_id 			    as ph_album_id,
		a.insert_user_id 	  	as ph_insert_user_id,
		a.insert_org_id 	  	as ph_insert_org_id,
		a.insert_datetime 		as ph_insert_datetime,
		a.update_user_id 	  	as ph_update_user_id,
		a.update_org_id 	  	as ph_update_org_id,
		a.update_datetime 		as ph_update_datetime,
		a.delete_user_id 	  	as ph_delete_user_id,
		a.delete_org_id 	  	as ph_delete_org_id,
		a.delete_datetime 		as ph_delete_datetime
			FROM schl_photo a
			JOIN schl_photo_album b
			ON a.album_id = b.album_id
			WHERE b.album_id = {$id_album}
			and a.insert_datetime not like '' and a.insert_datetime is not null and a.delete_user_id IS NULL AND (a.delete_datetime IS NULL || a.delete_datetime = '0000-00-00 00:00:00')
			and b.insert_datetime not like '' and b.insert_datetime is not null and b.delete_user_id IS NULL AND (b.delete_datetime IS NULL || b.delete_datetime = '0000-00-00 00:00:00')
			order by a.photo_id ASC, a.insert_datetime ASC, a.photo_title ASC;");

        //$date = date('Y-m-d',strtotime($album_query_result['al_insert_datetime']));
        //$time = date('H:i:s',strtotime($album_query_result['al_insert_datetime']));

        if ($photo_file_name[0]['ph_photo_id'] != '') {
            echo json_encode($photo_file_name);
        } else {
            $photo_file_name_2 = $this->common_model->custom_query("select b.album_id	as al_album_id,
			b.album_id				as al2_album_id,
			b.album_title		    as al_album_title,
			b.album_description		as al_album_description,
			b.schl_id			  	as al_schl_id,
			b.insert_user_id	 	as al_insert_user_id,
			b.insert_org_id		 	as al_insert_org_id,
			b.insert_datetime	  	as al_insert_datetime,
			b.update_user_id	 	as al_update_user_id,
			b.update_org_id		 	as al_update_org_id,
			b.update_datetime	 	as al_update_datetime,
			b.delete_user_id	  	as al_delete_user_id,
			b.delete_org_id		  	as al_delete_org_id,
			b.delete_datetime   	as al_delete_datetime
				FROM schl_photo_album b
				WHERE b.album_id = {$id_album}
				and b.insert_datetime not like '' and b.insert_datetime is not null and b.delete_user_id IS NULL AND (b.delete_datetime IS NULL || b.delete_datetime = '0000-00-00 00:00:00')
				order by b.album_id ASC, b.insert_datetime ASC, b.album_title ASC;");

            echo json_encode($photo_file_name_2);
        }

    }

    public function album_modal()
    { //js will called data from this model-function (photo album - album info [edit album])
        $id_album = $this->input->get('album_id'); //filename

        $album_info = $this->common_model->custom_query("select b.album_id	as al_album_id,
		b.album_id				as al2_album_id,
		b.album_title		    as al_album_title,
		b.album_description		as al_album_description,
		b.schl_id			  	as al_schl_id,
		b.insert_user_id	 	as al_insert_user_id,
		b.insert_org_id		 	as al_insert_org_id,
		b.insert_datetime	  	as al_insert_datetime,
		b.update_user_id	 	as al_update_user_id,
		b.update_org_id		 	as al_update_org_id,
		b.update_datetime	 	as al_update_datetime,
		b.delete_user_id	  	as al_delete_user_id,
		b.delete_org_id		  	as al_delete_org_id,
		b.delete_datetime   	as al_delete_datetime
			FROM schl_photo_album b
			WHERE b.album_id = {$id_album}
			and b.insert_datetime not like '' and b.insert_datetime is not null and b.delete_user_id IS NULL AND (b.delete_datetime IS NULL || b.delete_datetime = '0000-00-00 00:00:00')
			order by b.album_id ASC, b.insert_datetime ASC, b.album_title ASC;");

        echo json_encode($album_info);

    }

    public function photo_modal_edit()
    { //js will called data from this model-function (photo album - photo [edit photo])
        //$id_album = $this->input->get('album_id');//filename
        $id_photo = $this->input->get('photo_id'); //filename

        //$photo_file_name = $this->common_model->custom_query("select photo_file_name from schl_photo where album_id = {$id_album}");

        $photo_info = $this->common_model->custom_query("select b.album_id	as al_album_id,
		b.album_title		    as al_album_title,
		b.album_description		as al_album_description,
		b.schl_id			  	as al_schl_id,
		b.insert_user_id	 	as al_insert_user_id,
		b.insert_org_id		 	as al_insert_org_id,
		b.insert_datetime	  	as al_insert_datetime,
		b.update_user_id	 	as al_update_user_id,
		b.update_org_id		 	as al_update_org_id,
		b.update_datetime	 	as al_update_datetime,
		b.delete_user_id	  	as al_delete_user_id,
		b.delete_org_id		  	as al_delete_org_id,
		b.delete_datetime   	as al_delete_datetime,
		a.photo_id 			    as ph_photo_id,
		a.photo_title 		  	as ph_photo_title,
		a.schl_id 			    as ph_schl_id,
		a.photo_file_name 		as ph_photo_file_name,
		a.photo_thumbnail 		as ph_photo_thumbnail,
		a.photo_description 	as ph_photo_description,
		a.album_id 			    as ph_album_id,
		a.insert_user_id 	  	as ph_insert_user_id,
		a.insert_org_id 	  	as ph_insert_org_id,
		a.insert_datetime 		as ph_insert_datetime,
		a.update_user_id 	  	as ph_update_user_id,
		a.update_org_id 	  	as ph_update_org_id,
		a.update_datetime 		as ph_update_datetime,
		a.delete_user_id 	  	as ph_delete_user_id,
		a.delete_org_id 	  	as ph_delete_org_id,
		a.delete_datetime 		as ph_delete_datetime
			FROM schl_photo a
			JOIN schl_photo_album b
			ON a.album_id = b.album_id
			WHERE a.photo_id = {$id_photo}
			and a.insert_datetime not like '' and a.insert_datetime is not null and a.delete_user_id IS NULL AND (a.delete_datetime IS NULL || a.delete_datetime = '0000-00-00 00:00:00')
			and b.insert_datetime not like '' and b.insert_datetime is not null and b.delete_user_id IS NULL AND (b.delete_datetime IS NULL || b.delete_datetime = '0000-00-00 00:00:00')
			order by a.photo_id ASC, a.insert_datetime ASC, a.photo_title ASC;");

        echo json_encode($photo_info);
    }

    public function del_album_photo()
    { //js will sent data to this function (photo album - album [confirm delete album & photo])

        $id_album = $this->input->get('album_id'); //filename

        //$photo_file_name = $this->common_model->custom_query("select photo_file_name from schl_photo where album_id = {$id_album}");

        $photo_file_name2 = $this->common_model->query("select photo_file_name from schl_photo where album_id = {$id_album}")->result_array();
        $photo_schl_id = $this->common_model->query("select schl_id from schl_photo_album where album_id = {$id_album}")->result_array();

        $id = $photo_schl_id[0]['schl_id'];

/*         $photo_file = $photo_file_name[0]['photo_file_name'];

$photo_file2 = $photo_file_name2[0]['photo_file_name']; */

        $this->load->helper('string');

        $rpath = $_SERVER['DOCUMENT_ROOT'];

        //echo '<pre>';
        //print_r($id_album);
        $i = 0;
/*         print_r($photo_file);
print_r($photo_file2); */

        //print_r($id);

        $this->load->helper("file");

        foreach ($photo_file_name2 as $file_name => $val) {

            $photo_file2 = $val['photo_file_name'];

            $path = increment_string($rpath, '/assets/modules/school/images/uploads/', $photo_file2); //$path

            print_r($path); //$photo file name

            delete_files($path);

            unlink($path);

            $this->common_model->delete_where('schl_photo', 'photo_id', $id_photo);

        }
        //echo '</pre>';

        //Delete process
        $data_update = array();
        $data_update['delete_user_id'] = getUser();
        $data_update['delete_org_id'] = get_session('org_id');
        $data_update['delete_datetime'] = getDatetime();

        $this->common_model->update('schl_photo_album', $data_update, array('album_id' => $id_album));

        $this->session->set_flashdata('msg', setMsg('031')); //Set Message code 031
        //$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Success'); //Save Sign Out Log

        redirect('school/photo2/Edit/' . $id, 'refresh');
    }

    public function edt_album_photo()
    { //js will sent data to this model (photo album - album [confirm edit album])
        $id = $this->input->post('schl_album_id_edit');
/*         $album_title = "test001name";
$album_desc = "test001desc"; */

        $schl_id = $this->input->post('schl_id_edit_album');

        $album_title = $this->input->post('schl_album_title_edit'); //filename
        $album_desc = $this->input->post('schl_album_description_edit'); //filename

        $data_update = array();
        //$data_insert                     = @get_inpost_arr('schl_album');

        //$data_update['album_id']                 = $id;

        $data_update['album_title'] = $album_title;

        $data_update['album_description'] = $album_desc;

/*         echo '<pre>';
print_r($id);
print_r($album_title);
print_r($album_desc);
//print_r($count_title);
echo '</pre>';  */

        // dieArray($data_insert);
        $data_update['update_user_id'] = getUser();
        $data_update['update_org_id'] = get_session('org_id');
        $data_update['update_datetime'] = getDatetime();

        $this->common_model->update('schl_photo_album', $data_update, array('album_id' => $id)); //$id_center_info =

        $this->session->set_flashdata('msg', setMsg('021')); //Set Message code 031
        //$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Success'); //Save Sign Out Log

        redirect('school/photo2/Edit/' . $schl_id, 'refresh');
    }

    public function edt_photo()
    { //js will sent data to this model (photo album - photo [confirm edit photo])
        $id = $this->input->post('schl_photo_id_edit');
/*         $album_title = "test001name";
$album_desc = "test001desc"; */

        $schl_id = $this->input->post('schl_id_edit_photo');

        $photo_title = $this->input->post('schl_photo_title_edit'); //filename
        $photo_desc = $this->input->post('schl_photo_description_edit'); //filename

        $data_update = array();
        //$data_insert                     = @get_inpost_arr('schl_album');

        //$data_update['album_id']                 = $id;

        $data_update['photo_title'] = $photo_title;

        $data_update['photo_description'] = $photo_desc;

/*         echo '<pre>';
print_r($id);
print_r($photo_title);
print_r($photo_desc);
//print_r($count_title);
echo '</pre>';  */

        // dieArray($data_insert);
        $data_update['update_user_id'] = getUser();
        $data_update['update_org_id'] = get_session('org_id');
        $data_update['update_datetime'] = getDatetime();

        $this->common_model->update('schl_photo', $data_update, array('photo_id' => $id)); //$id_center_info =

        $this->session->set_flashdata('msg', setMsg('021')); //Set Message code 031
        //$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Success'); //Save Sign Out Log

        redirect('school/photo2/Edit/' . $schl_id, 'refresh');
    }

    //=== upload image : end code ===

    public function photo2($process_action = 'Add', $schl_id = 0)
    { //แบบขึ้นทะเบียน (ภาพถ่าย)
        $data = array(); //Set Initial Variable to Views
        /*-- Initial Data for Check User Permission --*/
        $user_id = get_session('user_id');
        $app_id = 60;
        $process_path = 'school/photo2';
        /*--END Inizial Data for Check User Permission--*/

        $this->webinfo_model->LogSave($app_id, $process_action, 'Sign In', 'Success'); //Save Sign In Log
        $usrpm = $this->admin_model->chkOnce_usrmPermiss($app_id, $user_id); //Check User Permission

        if (@$usrpm['perm_status'] == 'No' || !isset($usrpm['app_id'])) {
            page500();
            $this->webinfo_model->LogSave($app_id, $process_action, 'Sign Out', 'Fail'); //Save Sign Out Log
        } else {
            $app_name = $usrpm['app_name'];
            $data['usrpm'] = $usrpm;
            $data['user_id'] = $user_id;

            $this->load->library('template',
                array('name' => 'admin_template1',
                    'setting' => array('data_output' => ''))
            ); // Set Template

            /*-- datepicker --*/
            set_css_asset_head('../plugins/bootstrap-datepicker1.3.0/css/datepicker.css');
            set_js_asset_head('../plugins/bootstrap-datepicker1.3.0/js/bootstrap-datepicker.js');
            /*-- End datepicker --*/

            /*-- Toastr style --*/
            set_css_asset_head('../plugins/Static_Full_Version/css/plugins/toastr/toastr.min.css');
            set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/toastr/toastr.min.js');
            /*-- End Toastr style --*/

            set_css_asset_head('../modules/school/css/gallery_img.css');
            set_js_asset_footer('photo2.js', 'school'); //Set JS sufferer_form1.js

            $data['process_action'] = $process_action;
            $data['content_view'] = 'photo2';

            $tmp = $this->admin_model->getOnce_Application($usrpm['app_parent_id']); //Used for find root application
            $data['head_title'] = $tmp['app_name'];
            $data['title'] = $usrpm['app_name'];

            $data['csrf'] = array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash(),
            );
            // dieArray($usrpm);

            if ($process_action == 'Add' && get_inpost('bt_submit') == '' && $usrpm['perm_status'] == 'Yes') {

                /* opal - comment
            $this->template->load('index_page',$data,'school');
            $this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Success'); //Save Sign Out Log
            }else if($process_action=='Added' && get_inpost('bt_submit')!='' && $usrpm['perm_status']=='Yes'){ //Add && Submit Form
            $this->load->library('form_validation');
            $frm=$this->form_validation;

            $frm->set_rules('diff_info[date_of_req]','วันที่แจ้งเรื่อง','required|callback_date_check');

            if(get_inpost('rd_pers_id')==1) {
            $frm->set_rules('diff_info[pers_id]','เลขประจำตัวประชาชน','required');
            }

            $frm->set_rules('diff_info[elder_firstname]','ชื่อตัว','required');
            $frm->set_rules('diff_info[elder_lastname]','ชื่อสกุล','required');

            if(get_inpost('rd_req_pers_id')==1) {
            $frm->set_rules('diff_info[req_pers_id]','เลขประจำตัวประชาชนข้อมูลผู้ยื่นคำขอ','required');
            }

            $frm->set_rules('diff_info[req_firstname]','ชื่อสกุลผู้ยื่นคำขอ','required');
            $frm->set_rules('diff_info[req_channel]','ช่องทางการรับแจ้ง','required');

            $frm->set_rules('diff_info[date_of_visit]','วันที่ตรวจเยี่ยม','required|callback_date_check');
            $frm->set_rules('diff_info[visitor_name]','เจ้าหน้าที่ผู้ตรวจเยี่ยม','required');

            $frm->set_message("required","กรุณากรอกข้อมูล %s");
            $frm->set_message("numeric","%s ต้องเป็นตัวเลข");
            $frm->set_message("date_check","%s รูปบบของวันที่ต้องถูกต้อง");

            if($frm->run($this)){//Valid Data*/

            } else //opal comment >> if($process_action=='Added' && get_inpost('bt_submit')!='' && $usrpm['perm_status']=='Yes'){ //Add && Submit Form    //opal add if-else

            if ($process_action == 'Added') { //Add Album process

                $id = $schl_id;
/*                         $album_title = "test001name";
$album_desc = "test001desc"; */

                $album_title = $this->input->post('schl_album_title'); //filename
                $album_desc = $this->input->post('schl_album_description'); //filename

                $data_insert = array();
                //$data_insert                     = @get_inpost_arr('schl_album');

                $data_insert['album_title'] = $album_title;

                $data_insert['album_description'] = $album_desc;

                $data_insert['schl_id'] = $id;

                // dieArray($data_insert);
                $data_insert['insert_user_id'] = getUser();
                $data_insert['insert_org_id'] = get_session('org_id');
                $data_insert['insert_datetime'] = getDatetime();

                $this->common_model->insert('schl_photo_album', $data_insert);

                $this->session->set_flashdata('msg', setMsg('011')); //Set Message code 031
                $this->webinfo_model->LogSave($app_id, $process_action, 'Sign Out', 'Success'); //Save Sign Out Log

                redirect('school/photo2/Edit/' . $id, 'refresh');

/*                    opal - comment
$data_insert = $_POST['diff_info'];
$data_insert['date_of_req'] = dateChange($data_insert['date_of_req'],4);
$data_insert['insert_user_id'] = getUser();
$data_insert['insert_datetime'] = getDatetime();

$data_insert['date_of_visit'] = dateChange($data_insert['date_of_visit'],4);

$this->common_model->insert('diff_info',$data_insert);
$this->session->set_flashdata('msg',setMsg('011')); //Set Message code 011

$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Success'); //Save Sign Out Log

if(get_inpost('state')==1) {
$data['diff_info'] = $this->clr_diffInfo_form1();
$data['rd_pers_id'] = '';
$data['rd_req_pers_id'] = '';
}else {
redirect('difficult/assist_list','refresh');
}

}else {
$data['diff_info'] = $_POST['diff_info'];
$data['rd_pers_id'] = set_value('rd_pers_id');
$data['rd_req_pers_id'] = set_value('rd_req_pers_id');
$this->session->set_flashdata('msg',setMsg('012')); //Set Message code 012
$this->template->load('index_page',$data,'difficult');
$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Fail'); //Save Sign Out Log
} */

            } else if ($process_action == 'Edit' && get_inpost('bt_submit') == '' && $usrpm['perm_status'] == 'Yes') {

                if ($schl_id != '') {

                    //$data['schl_photo_album'] = $this->school_model->get_schl_photo_album($schl_id); //opal photo func //error

                    $data['schl_id'] = $schl_id;

                    $this->load->model('school_model', 'school_model');

                    $data['schl_info'] = $this->school_model->getOnce_schlInfo($schl_id);

                    // dieArray($data);
                    $this->template->load('index_page', $data, 'school');

                } else {
                    page500();
                    $this->webinfo_model->LogSave($app_id, $process_action, 'Sign Out', 'Fail'); //Save Sign Out Log
                }

            } else if ($process_action == 'Edited' && get_inpost('bt_submit') != '' && $usrpm['perm_status'] == 'Yes') { //Edit && Submit Form

                //========= start : opal ex code ===========

                //dieArray($_POST);
                $process_action = 'Edited';

                //$data_insert                     = array();
                //$data_insert                     = @get_inpost_arr('center_info');
                //$data_insert['update_user_id']     = getUser();
                //$data_insert['update_org_id']     = get_session('org_id');
                //$data_insert['update_datetime'] = getDatetime();

                //$this->common_model->update('qlc_info',$data_insert,array('qlc_id'=>$qlc_id));

                //--- add code / edit code qlc_kpi ---

                $id = $schl_id;

                //$update_photo = array();
                $update_photo = @get_inpost_arr('photo2');
                $update_album_id = @get_inpost_arr('albumid');
                $update_photo_desc = @get_inpost_arr('photo2desc');

                $count_title = count($update_photo) - 1;

                //$this->common_model->update('qlc_info',$data_insert,array('qlc_id'=>$qlc_id));

                if ($_FILES['img']['name'][0] != "") {

                    //$photo2 = $this->opal();

                    $this->load->model('files_model', 'files_model');

                    if ($_FILES['img']['name'][0] != "") {
                        $photo2info = $this->files_model->getMultiImg("img", 'assets/modules/school/images/uploads');
/*                              echo '<pre>';
print_r($update_photo);
print_r($update_album_id);
print_r($update_photo_desc);
//print_r($count_title);
echo '</pre>';  */

                        $i = 0;
                        $j = 0;

                        foreach ($photo2info as $key_photo => $value_photo) {

                            if ($j == $count_title) {
                                break;
                            }

                            if ($_FILES['img']['name'][$i] != "") {

                                $insert_photo = array('schl_id' => $id,
                                    'album_id' => $update_album_id[0],
                                    'photo_title' => $update_photo[$j],
                                    'photo_description' => $update_photo_desc[$j],
                                    'photo_file_name' => $value_photo['file'],
                                    'insert_user_id' => getUser(),
                                    'insert_org_id' => get_session('org_id'),
                                    'insert_datetime' => getDatetime(),
                                    //'schl_photo_label'       =>$value_photo['name'],
                                    //'schl_photo_size'       =>$_FILES['img']['size'][$i],
                                    //'schl_photo_default'    =>""
                                );

                                $this->common_model->insert('schl_photo', $insert_photo);

                            }$i++;
                            $j++;
                        } // close loop foreach ($id_photo as $key_photo => $value_photo)

                    } else {
                        echo "<p>" . "ERROR!!!" . "</p>";
                    }

                }

                // dieArray($_POST);
                //$update_qlc = array();
                //----------------$update_photo2 = @get_inpost_arr('photo2');//จำนวนเจ้าหน้าที่ที่มีการเพิ่มอยู่แล้ว
                //$this->common_model->delete_where("qlc_kpi",'qlc_id',$qlc_id); //ลบของที่มีอยู่

/*                     opal - comment
if(!empty($update_qlc)){
foreach ($update_qlc as $key_model => $val_model) {

$insert_model = array(
'qlc_id'             => $id,
'qlc_kpi_code'       => $key_model,
'qlc_kpi_result'     => 'มี',
'insert_user_id'    => getUser(),
'insert_org_id'        => get_session('org_id'),
'insert_datetime'    => getDatetime()
);
$this->common_model->insert('qlc_kpi',$insert_model);
}
}

$this->session->set_flashdata('msg',setMsg('021')); //Set Message code 021

$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Success'); //Save Sign Out Log

redirect('school/center_kpi/Edit/'.$qlc_id,'refresh'); */

                //========= end : opal ex code ===========

/*                  if($_FILES['img']['name'][0]!=""){

$photo = $this->files_model->getMultiImg("img",'assets/modules/school/images');

$i=0;
foreach ($photo as $key_photo => $value_photo) {

if($_FILES['img']['name'][$i]!=""){

$insert_photo = array('schl_id'               =>$schl_id,
'schl_photo_file'       =>$value_photo['file'],
'schl_photo_label'       =>$value_photo['name'],
'schl_photo_size'       =>$_FILES['img']['size'][$i],
'schl_photo_default'    =>"");

$this->common_model->insert('schl_info_photo',$insert_photo);

}
$i++;
}// close loop foreach ($id_photo as $key_photo => $value_photo)

} */

                /*$data['msg'] = setMsg('021'); //Set Message code 021
                $this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Success'); //Save Sign Out Log
                 */

                $this->session->set_flashdata('msg', setMsg('011')); //Set Message code 021
                $this->webinfo_model->LogSave($app_id, $process_action, 'Sign Out', 'Success'); //Save Sign Out Log
                //$this->template->load('index_page',$data,'school');
                redirect('school/photo2/Edit/' . $id, 'refresh');

            } else if ($process_action == 'Delete' && $usrpm['perm_status'] == 'Yes') { //Delete process

                $id = $schl_id;

                $id_photo = $this->input->get('photo_id'); //filename

                $photo_file_name = $this->common_model->custom_query("select photo_file_name from schl_photo where photo_id = {$id_photo}");

                $photo_file = $photo_file_name[0]['photo_file_name'];

                $this->load->helper('string');

                $rpath = $_SERVER['DOCUMENT_ROOT'];

                $path = increment_string($rpath, '/assets/modules/school/images/uploads/', $photo_file);

/*                 echo '<pre>';
print_r($path);
echo '</pre>'; */

                $this->load->helper("file");

                delete_files($path);

                unlink($path);

                $this->common_model->delete_where('schl_photo', 'photo_id', $id_photo);

                $this->session->set_flashdata('msg', setMsg('031')); //Set Message code 031
                $this->webinfo_model->LogSave($app_id, $process_action, 'Sign Out', 'Success'); //Save Sign Out Log

                redirect('school/photo2/Edit/' . $id, 'refresh');

            } else {
                page500();
                $this->template->load('index_page', $data, 'difficult');
                $this->webinfo_model->LogSave($app_id, $process_action, 'Sign Out', 'Fail'); //Save Sign Out Log
            }

        }

    }

    //=== Start Add Code : Generation ===//

    public function generation_modal()
    { //js will called data from this model-function (gen - photos [view gen_info in schl])
        $gen_id = $this->input->get('gen_id'); //filename

        $schl_id = $this->common_model->custom_query("select schl_id from schl_edu_generation where gen_id = {$gen_id}");

        $schl_id_use = $schl_id[0]['schl_id'];

        $schl_gen_info = $this->common_model->custom_query("select 	a.gen_id 				as gn_gen_id,
			a.gen_code 				as gn_gen_code,
			a.gen_status 			as gn_gen_status,
			a.schl_id 				as gn_schl_id,
			a.crse_code 			as gn_crse_code,
			a.crse_custom 			as gn_crse_custom,
			a.first_date_of_edu 	as gn_first_date_of_edu,
            CONCAT(SUBSTR(a.first_date_of_edu,9,2), '/',
				SUBSTR(a.first_date_of_edu,6,2), '/' ,
                SUBSTR(a.first_date_of_edu,1,4))
                as gn_first_date_of_edu_dpk,
			a.last_date_of_edu 		as gn_last_date_of_edu,
			a.hours_per_week 		as gn_hours_per_week,
			a.days_per_week 		as gn_days_per_week,
			a.crse_att_file 		as gn_crse_att_file,
			a.insert_user_id 		as gn_insert_user_id,
			a.insert_org_id 		as gn_insert_org_id,
			a.insert_datetime 		as gn_insert_datetime,
			a.update_user_id 		as gn_update_user_id,
			a.update_org_id 		as gn_update_org_id,
			a.update_datetime 		as gn_update_datetime,
			a.delete_user_id 		as gn_delete_user_id,
			a.delete_org_id 		as gn_delete_org_id,
			a.delete_datetime 		as gn_delete_datetime,
			c.crse_id 				as cs_crse_id,
			c.crse_code 			as cs_crse_code,
			c.crse_grp 				as cs_crse_grp,
			c.crse_cate 			as cs_crse_cate,
			c.crse_title 			as cs_crse_title,
			c.crse_objective 		as cs_crse_objective,
			c.crse_contents 		as cs_crse_contents,
			c.hours_per_week 		as cs_hours_per_week
				FROM schl_edu_generation a
				LEFT JOIN std_schl_edu_course c
				ON a.crse_code = c.crse_code
				WHERE a.gen_id = {$gen_id} and a.schl_id = {$schl_id_use}
				and a.insert_datetime not like '' and a.insert_datetime is not null and a.delete_user_id IS NULL AND (a.delete_datetime IS NULL || a.delete_datetime = '0000-00-00 00:00:00')
				order by a.gen_code ASC, a.first_date_of_edu ASC;");

        //$date = date('Y-m-d',strtotime($album_query_result['al_insert_datetime']));
        //$time = date('H:i:s',strtotime($album_query_result['al_insert_datetime']));

        echo json_encode($schl_gen_info);

    }

    public function std_crse_modal()
    { //js will called data from this model-function (gen - std [view std crse of schl])

        $std_crse = $this->common_model->custom_query("select * FROM std_schl_edu_course order by crse_title ASC;");

        echo json_encode($std_crse);

    }

    public function student_modal()
    { //js will called data from this model-function (gen - stud_info [view stud in gen])
        $gen_id = $this->input->get('gen_id'); //filename

        //$schl_id = $this->common_model->custom_query("select schl_id from schl_edu_generation where gen_id = {$gen_id}");

        //$schl_id_use = $schl_id[0]['schl_id'];

        $gen_stud_info = $this->common_model->custom_query("select b.*
				FROM schl_edu_student b
				WHERE b.gen_id = {$gen_id}
				and b.insert_datetime not like '' and b.insert_datetime is not null and b.delete_user_id IS NULL AND (b.delete_datetime IS NULL || b.delete_datetime = '0000-00-00 00:00:00')
				order by b.stud_id ASC, b.stud_age ASC;");

        //$date = date('Y-m-d',strtotime($album_query_result['al_insert_datetime']));
        //$time = date('H:i:s',strtotime($album_query_result['al_insert_datetime']));

        echo json_encode($gen_stud_info);

    }

    public function active_gen_1()
    { //ฟังก์ชันสำหรับทดสอบ แต่ไม่ได้ใช้จริง

        $id_gen = $this->input->get('gen_id');

        $gen_status = $this->common_model->custom_query("select gen_status from schl_edu_generation where gen_id = {$id_gen}");

        $old_status = $gen_status[0]['gen_status'];

        $new_status;

        if ($old_status == "เปิดการศึกษา") {
            $new_status = "ปิดการศึกษา";
        } else if ($old_status == "ปิดการศึกษา") {
            $new_status = "เปิดการศึกษา";
        } else {
            echo '<pre>';
        }

        //print_r($photo_file);
        print_r($id_gen);
        print_r($old_status);
        print_r($new_status);
        echo '</pre>';

        //$this->common_model->delete_where('schl_photo','photo_id', $id_photo);

        $this->common_model->update('schl_edu_generation', $data_update, array('gen_id' => $gen_id)); //$id_center_info

        $this->session->set_flashdata('msg', setMsg('021')); //Set Message code 011
        $this->webinfo_model->LogSave($app_id, $process_action, 'Sign Out', 'Success'); //Save Sign Out Log
        $this->template->load('index_page', $data, 'school');
        redirect('school/generation3/Edit/' . $schl_id, 'refresh');

        //echo "remove";

        //redirect('school/photo2/Edit/'.$id,'refresh');
    }

    public function active_gen()
    { //js will called data from this model-function (gen - gen_stud [view stud in gen])
        $schl_gen = @get_inpost_arr('schl_gen');
        $schl_id = $schl_gen['schl_id'];
        $gen_id = $schl_gen['gen_id'];
        $gen_status = $schl_gen['gen_status'];

        $data_update = array();
        //$data_update                             = @get_inpost_arr('schl_gen');
        $data_update['gen_status'] = $gen_status;

        $data_update['update_user_id'] = getUser();
        $data_update['update_org_id'] = get_session('org_id');
        $data_update['update_datetime'] = getDatetime();

        //echo $gen_status;

        $this->common_model->update('schl_edu_generation', $data_update, array('gen_id' => $gen_id)); //$id_center_info

        $this->session->set_flashdata('msg', setMsg('021')); //Set Message code 011
        //$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Success'); //Save Sign Out Log
        //$this->template->load('index_page',$data,'school');
        redirect('school/generation3/Edit/' . $schl_id, 'refresh');
    }

    public function delete_gen()
    { //js will called data from this model-function (gen - gen_stud [view stud in gen]) //ฟังก์ชันสำหรับทดสอบ แต่ไม่ได้ใช้จริง
        $schl_gen = @get_inpost_arr('schl_gen');
        $schl_id = $schl_gen['schl_id'];
        $gen_id = $schl_gen['gen_id'];
        $gen_status = $schl_gen['gen_status'];

        $data_update = array();
        //$data_update                             = @get_inpost_arr('schl_gen');
        $data_update['gen_status'] = $gen_status;

        $data_update['update_user_id'] = getUser();
        $data_update['update_org_id'] = get_session('org_id');
        $data_update['update_datetime'] = getDatetime();

        //echo $gen_status;

        $this->common_model->update('schl_edu_generation', $data_update, array('gen_id' => $gen_id)); //$id_center_info

        $this->session->set_flashdata('msg', setMsg('021')); //Set Message code 011
        //$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Success'); //Save Sign Out Log
        //$this->template->load('index_page',$data,'school');
        redirect('school/generation3/Edit/' . $schl_id, 'refresh');
    }

    //=== End Add Code : Generation ===//

    public function generation3($process_action = 'Add', $schl_id = 0, $gen_id = 0)
    { //แบบขึ้นทะเบียน (รุ่น/หลักสูตร) หน้าแสดง
        $data = array(); //Set Initial Variable to Views
        /*-- Initial Data for Check User Permission --*/
        $user_id = get_session('user_id');
        $app_id = 61;
        $process_path = 'school/generation3';
        /*--END Inizial Data for Check User Permission--*/

        $this->webinfo_model->LogSave($app_id, $process_action, 'Sign In', 'Success'); //Save Sign In Log
        $usrpm = $this->admin_model->chkOnce_usrmPermiss($app_id, $user_id); //Check User Permission

        if (@$usrpm['perm_status'] == 'No' || !isset($usrpm['app_id'])) {
            page500();
            $this->webinfo_model->LogSave($app_id, $process_action, 'Sign Out', 'Fail'); //Save Sign Out Log
        } else {
            $app_name = $usrpm['app_name'];
            $data['usrpm'] = $usrpm;
            $data['user_id'] = $user_id;

            $data['generation_info'] = $this->school_model->getAll_generationInfo($schl_id);

            $this->load->library('template',
                array('name' => 'admin_template1',
                    'setting' => array('data_output' => ''))
            ); // Set Template

            /*-- datepicker --*/
/*             set_css_asset_head('../plugins/bootstrap-datepicker1.3.0/css/datepicker.css');
set_js_asset_head('../plugins/bootstrap-datepicker1.3.0/js/bootstrap-datepicker.js'); */
            /*-- End datepicker --*/

            /*-- datepicker custom --*/
            set_css_asset_head('../plugins/bootstrap-datepicker-custom/dist/css/bootstrap-datepicker.css');
            set_js_asset_head('../plugins/bootstrap-datepicker-custom/dist/js/bootstrap-datepicker-custom.js');
            set_js_asset_head('../plugins/bootstrap-datepicker-custom/dist/locales/bootstrap-datepicker.th.min.js');
            /*-- End datepicker custom--*/

            set_css_asset_head('../plugins/Static_Full_Version/css/plugins/dataTables/datatables.min.css');
            set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/dataTables/datatables.min.js');

            /*-- Toastr style --*/
            set_css_asset_head('../plugins/Static_Full_Version/css/plugins/toastr/toastr.min.css');
            set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/toastr/toastr.min.js');
            /*-- End Toastr style --*/
            set_js_asset_footer('generation3.js', 'school'); //Set JS sufferer_form1.js

            set_css_asset_head('../modules/school/css/gallery_img.css');

            $data['process_action'] = $process_action;
            $data['content_view'] = 'generation3';

            $tmp = $this->admin_model->getOnce_Application($usrpm['app_parent_id']); //Used for find root application
            $data['head_title'] = $tmp['app_name'];
            $data['title'] = $usrpm['app_name'];
            $data['schl_id'] = $schl_id;

            $data['csrf'] = array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash(),
            );

            // dieArray($usrpm);
            if ($process_action == 'Add' && get_inpost('bt_submit') == '' && $usrpm['perm_status'] == 'Yes') {

/*               page500();
$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Fail');  *///Save Sign Out Log
            } else /* if($process_action=='Added' && get_inpost('bt_submit')!='' && $usrpm['perm_status']=='Yes'){ *///Add && Submit Form

            if ($process_action == 'Added') { //Add Gen process

                /* $process_action='Added'; */

                //$gen_id                                 = @get_inpost_arr('schl_gen[gen_id]');

                $schl_gen = @get_inpost_arr('schl_gen');
                $schl_id = $schl_gen['schl_id'];

                $first_date_of_edu = $schl_gen['first_date_of_edu'];
                $last_date_of_edu = $schl_gen['last_date_of_edu'];

                $first_date = explode("/", $first_date_of_edu);
                $last_date = explode("/", $last_date_of_edu);

                $fdate = ($first_date[2] - 543) . '-' . $first_date[1] . '-' . $first_date[0];

                $ldate = ($last_date[2] - 543) . '-' . $last_date[1] . '-' . $last_date[0];

                $data_insert = array();
                //$data_update                             = @get_inpost_arr('schl_gen');
                $data_insert['gen_code'] = $schl_gen['gen_code'];
                $data_insert['schl_id'] = $schl_gen['schl_id'];
                $data_insert['first_date_of_edu'] = $fdate;
                $data_insert['last_date_of_edu'] = $ldate;
                $data_insert['days_per_week'] = $schl_gen['days_per_week'];
                $data_insert['hours_per_week'] = $schl_gen['hours_per_week'];
                $data_insert['crse_code'] = $schl_gen['crse_code'];
                $data_insert['crse_custom'] = $schl_gen['crse_custom'];

                $data_insert['insert_user_id'] = getUser();
                $data_insert['insert_org_id'] = get_session('org_id');
                $data_insert['insert_datetime'] = getDatetime();

/*                 if($_FILES['img2']['name']!=""){

$this->load->model('files_model', 'files_model');

if($_FILES['img2']['name']!=""){

$photo2info = $this->files_model->getOnceImg("img2",'assets/modules/school/images/uploads');

$data_update['crse_att_file'] = $photo2info; */
/*                             $data_update['adm_req_photo_label'] = $_FILES['img2']['name'];
$data_update['adm_req_photo_size'] = $_FILES['img2']['size']; */

/*                     }

}
else
{ */
                /* echo "<p>"."ERROR!!!"."</p>"; */
/*                     $old_photo = $this->common_model->query("SELECT crse_att_file FROM schl_edu_generation where gen_id = {$gen_id};")->result_array();

$data_update['crse_att_file'] = $old_photo[0]['crse_att_file'];
} */

/*                 echo '<pre>';
echo 'OPAL!!';
print_r($schl_gen); */
/*                 print_r($photo2info);
print_r($no_photo); */
/*                 print_r($data_insert); */
                //print_r($schl_gen['gen_code']);
                /*                 echo '</pre>';  */

                $this->common_model->insert('schl_edu_generation', $data_insert); //$id_center_info

                $this->session->set_flashdata('msg', setMsg('011')); //Set Message code 011
                $this->webinfo_model->LogSave($app_id, $process_action, 'Sign Out', 'Success'); //Save Sign Out Log
                $this->template->load('index_page', $data, 'school');
                redirect('school/generation3/Edit/' . $schl_id, 'refresh');

                /* page500();
                $this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Fail'); *///Save Sign Out Log

            } else if ($process_action == 'Edit' && get_inpost('bt_submit') == '' && $usrpm['perm_status'] == 'Yes') {

                if ($schl_id != '') {

                    $data['schl_id'] = $schl_id;

                    $this->load->model('school_model', 'school_model');

                    $data['schl_info'] = $this->school_model->getOnce_schlInfo($schl_id);

                    //$data['schl_gen'] = $this->school_model->getAll_generationInfo($schl_id);
                    // dieArray($row);

                    $this->template->load('index_page', $data, 'school');
                } else {
                    page500();
                    $this->webinfo_model->LogSave($app_id, $process_action, 'Sign Out', 'Fail'); //Save Sign Out Log
                }

            } else if ($process_action == 'Edited' && get_inpost('bt_submit') != '' && $usrpm['perm_status'] == 'Yes') { //Edit && Submit Form
                $process_action = 'Edited';

                //$gen_id                                 = @get_inpost_arr('schl_gen[gen_id]');

                $schl_gen = @get_inpost_arr('schl_gen');
                $gen_id = $schl_gen['gen_id'];

                $first_date_of_edu = $schl_gen['first_date_of_edu'];
                $last_date_of_edu = $schl_gen['last_date_of_edu'];

                $first_date = explode("/", $first_date_of_edu);
                $last_date = explode("/", $last_date_of_edu);

                $fdate = ($first_date[2] - 543) . '-' . $first_date[1] . '-' . $first_date[0];

                $ldate = ($last_date[2] - 543) . '-' . $last_date[1] . '-' . $last_date[0];

                $data_update = array();
                //$data_update                             = @get_inpost_arr('schl_gen');
                $data_update['gen_code'] = $schl_gen['gen_code'];
                $data_update['first_date_of_edu'] = $fdate;
                $data_update['last_date_of_edu'] = $ldate;
                $data_update['days_per_week'] = $schl_gen['days_per_week'];
                $data_update['hours_per_week'] = $schl_gen['hours_per_week'];
                $data_update['crse_code'] = $schl_gen['crse_code'];

                $data_update['update_user_id'] = getUser();
                $data_update['update_org_id'] = get_session('org_id');
                $data_update['update_datetime'] = getDatetime();

                if ($_FILES['img2']['name'] != "") {

                    $this->load->model('files_model', 'files_model');

                    if ($_FILES['img2']['name'] != "") {

                        $photo2info = $this->files_model->getOnceImg("img2", 'assets/modules/school/images/uploads');

                        $data_update['crse_att_file'] = $photo2info;
/*                             $data_update['adm_req_photo_label'] = $_FILES['img2']['name'];
$data_update['adm_req_photo_size'] = $_FILES['img2']['size']; */

                    }

                } else {
                    /* echo "<p>"."ERROR!!!"."</p>"; */
                    $old_photo = $this->common_model->query("SELECT crse_att_file FROM schl_edu_generation where gen_id = {$gen_id};")->result_array();

                    $data_update['crse_att_file'] = $old_photo[0]['crse_att_file'];
                }

/*                 echo '<pre>';
print_r($schl_gen);
print_r($photo2info);
print_r($old_photo);
print_r($data_update);
//print_r($schl_gen['gen_code']);
echo '</pre>';  */

                $this->common_model->update('schl_edu_generation', $data_update, array('gen_id' => $gen_id)); //$id_center_info

                $this->session->set_flashdata('msg', setMsg('021')); //Set Message code 011
                $this->webinfo_model->LogSave($app_id, $process_action, 'Sign Out', 'Success'); //Save Sign Out Log
                $this->template->load('index_page', $data, 'school');
                redirect('school/generation3/Edit/' . $schl_id, 'refresh');

            } else if ($process_action == 'Delete' && $usrpm['perm_status'] == 'Yes') { //Delete process

                $id_gen = $this->input->get('gen_id');

                //echo $id_gen;

                $data_update = array();
                //$data_update                             = @get_inpost_arr('schl_gen');
                //$data_update['gen_id']                   = $id_gen;

                $data_update['delete_user_id'] = getUser();
                $data_update['delete_org_id'] = get_session('org_id');
                $data_update['delete_datetime'] = getDatetime();

                //echo $gen_status;

                $this->common_model->update('schl_edu_student', $data_update, array('gen_id' => $id_gen)); //$id_center_info
                $this->common_model->update('schl_edu_generation', $data_update, array('gen_id' => $id_gen)); //$id_center_info

                //$this->common_model->delete_where('schl_info_generation','gen_id',$gen_id);
                $this->session->set_flashdata('msg', setMsg('031')); //Set Message code 031
                $this->webinfo_model->LogSave($app_id, $process_action, 'Sign Out', 'Success'); //Save Sign Out Log
                redirect('school/generation3/Edit/' . $schl_id, 'refresh');
            } else {
                page500();
                $this->template->load('index_page', $data, 'school');
                $this->webinfo_model->LogSave($app_id, $process_action, 'Sign Out', 'Fail'); //Save Sign Out Log
            }

        }

    }

    public function import_student_list($schl_id, $gen_id)
    {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/application/modules/import/libraries/ImportFormExcel.php';

        $path = './assets/import_excel/';
        $config['upload_path'] = $path;
        $config['allowed_types'] = '*';
        $config['remove_spaces'] = true;

        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('importfile')) {
            die($this->upload->display_errors());
        } else {
            $data = array('upload_data' => $this->upload->data());
        }

        if (!empty($data['upload_data']['file_name'])) {
            $import_xls_file = $data['upload_data']['file_name'];
        } else {
            die('File does not have key "name".');
        }
        $inputFileName = $path . $import_xls_file;
        try {
            $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($inputFileName);
        } catch (Exception $e) {
            die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage());
        }
        $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);

        foreach ($allDataInSheet as $row) {
            if ($row['G'] !== true) {
                continue;
            }
            if ($row['C'] == 'ชาย') {
                $row['C'] = '1';
            } elseif ($row['C'] == 'หญิง') {
                $row['C'] = '2';
            } else {
                $row['B'] = '0';
            }

            $studentList[] = array(
                'schl_id' => $schl_id,
                'gen_id' => $gen_id,
                'pid' => $row['B'],
                'gender_code' => $row['C'],
                'stud_firstname_th' => $row['D'],
                'stud_lastname_th' => $row['E'],
                'stud_age' => $row['F'],
                'insert_user_id' => get_session('user_id'),
                'insert_org_id' => get_session('org_id'),
                'insert_datetime' => getDatetime(),
            );
        }
        // die(json_encode($studentList));
        $this->load->model('school_model');
        $this->school_model->insertBatch_studentList($studentList);
        unlink($path . $import_xls_file);
        redirect("school/generation3/Edit/$schl_id", "refresh");
    }

    public function generation_detail($process_action = 'Add', $schl_id = 0, $gen_id = 0)
    { //แบบขึ้นทะเบียน (รุ่น/หลักสูตร) // ไม่ใช้อันนี้แล้ว ไปใช้ modal และ js แทน
        $data = array(); //Set Initial Variable to Views
        /*-- Initial Data for Check User Permission --*/
        $user_id = get_session('user_id');
        $app_id = 61;
        $process_path = 'school/generation_detail';
        /*--END Inizial Data for Check User Permission--*/

        $this->webinfo_model->LogSave($app_id, $process_action, 'Sign In', 'Success'); //Save Sign In Log
        $usrpm = $this->admin_model->chkOnce_usrmPermiss($app_id, $user_id); //Check User Permission

        if (@$usrpm['perm_status'] == 'No' || !isset($usrpm['app_id'])) {
            page500();
            $this->webinfo_model->LogSave($app_id, $process_action, 'Sign Out', 'Fail'); //Save Sign Out Log
        } else {
            $app_name = $usrpm['app_name'];
            $data['usrpm'] = $usrpm;
            $data['user_id'] = $user_id;

            //$data['diff_info'] = $this->school_model->getAll_diffInfo();

            $this->load->library('template',
                array('name' => 'admin_template1',
                    'setting' => array('data_output' => ''))
            ); // Set Template

            /*-- datepicker --*/
            set_css_asset_head('../plugins/bootstrap-datepicker1.3.0/css/datepicker.css');
            set_js_asset_head('../plugins/bootstrap-datepicker1.3.0/js/bootstrap-datepicker.js');
            /*-- End datepicker --*/

            /*-- Toastr style --*/
            set_css_asset_head('../plugins/Static_Full_Version/css/plugins/toastr/toastr.min.css');
            set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/toastr/toastr.min.js');
            //swicth on-off

            set_css_asset_head('../plugins/Static_Full_Version/css/plugins/jasny/jasny-bootstrap.min.css');
            set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/jasny/jasny-bootstrap.min.js');

            set_css_asset_head('../modules/school/css/swicthon.css');
            /*-- End Toastr style --*/
            set_js_asset_footer('webservice.js', 'personals'); //Set JS sufferer_form1.js
            set_js_asset_footer('generation_detail.js', 'school'); //Set JS sufferer_form1.js

            $data['process_action'] = $process_action;
            $data['content_view'] = 'generation_detail';

            $tmp = $this->admin_model->getOnce_Application($usrpm['app_parent_id']); //Used for find root application
            $data['head_title'] = $tmp['app_name'];
            $data['title'] = $usrpm['app_name'];
            $data['schl_id'] = $schl_id;

            $data['csrf'] = array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash(),
            );

            // dieArray($usrpm);
            if ($process_action == 'Add' && get_inpost('bt_submit') == '' && $usrpm['perm_status'] == 'Yes') {

                $data['schl_id'] = $schl_id;

                $this->load->model('school_model', 'school_model');

                $data['schl_info'] = $this->school_model->getOnce_schlInfo($schl_id);

                if ($schl_id != "") {

                    $data['schl_gen'] = array('schl_id' => $schl_id,
                        'gen_code' => '',
                        'year_of_study' => '',
                        'gen_status' => 'เปิด');
                    $data['schl'] = $schl_id;
                    $data['gen_id'] = '';
                    $this->template->load('index_page', $data, 'school');
                    $this->webinfo_model->LogSave($app_id, $process_action, 'Sign Out', 'Success');

                } else {
                    page500();
                    $this->webinfo_model->LogSave($app_id, $process_action, 'Sign Out', 'Fail'); //Save Sign Out Log
                }

            } else if ($process_action == 'Added' && get_inpost('bt_submit') != '' && $usrpm['perm_status'] == 'Yes') { //Add && Submit Form

                if ($schl_id != "") {

                    if (get_inpost('schl_gen[gen_status]') == '') {
                        $status = "ปิด";

                    } else {
                        $status = "เปิด";
                    }

                    $insert_gen = array('schl_id' => $schl_id,
                        'gen_code' => get_inpost('schl_gen[gen_code]'),
                        'date_of_start' => get_inpost('schl_gen[date_of_start]'),
                        // 'gen_status'    => $status
                    );

                    $id = $this->common_model->insert('schl_info_generation', $insert_gen);

                    // $tmp_edu      = get_inpost_arr('schl_info_edu[crse_code]');//จำนวนหลักสูตร
                    // $tem_identify = get_inpost_arr('schl_info_edu[crse_identify]');//ความคิดเห็นเจ้าหน้าที่

                    // if(!empty($tmp_edu)){
                    //     foreach ($tmp_edu as $key => $crse_id) {
                    //     $data_edu = $this->school_model->get_std_schl_course($crse_id);

                    //        if($tem_identify[$key]!=''){
                    //              $comment = $tem_identify[$key];
                    //        }else{
                    //              $comment = $data_edu['crse_title'];
                    //        }

                    //        $insert_edu =array('gen_id'         => $id,
                    //                              'crse_code'      => $data_edu['crse_code'],
                    //                              'crse_identify'  => $comment,
                    //                              'crse_objective' => $data_edu['crse_objective'],
                    //                              'crse_contents'  => $data_edu['crse_contents'],
                    //                              'hours_per_week' => $data_edu['hours_per_week'],
                    //                              'att_file'       => $data_edu['att_file'],
                    //                              'att_label'      => $data_edu['att_label'],
                    //                              'att_size'       => $data_edu['att_size']
                    //                             );
                    //         $this->common_model->insert('schl_info_edu',$insert_edu);
                    //     }
                    // }
                    redirect('school/generation3/Edit/' . $schl_id, 'refresh');
                } else {
                    page500();
                    $this->webinfo_model->LogSave($app_id, $process_action, 'Sign Out', 'Fail'); //Save Sign Out Log
                }

            } else if ($process_action == 'Edit' && get_inpost('bt_submit') == '' && $usrpm['perm_status'] == 'Yes') {

                $data['schl_id'] = $schl_id;

                $this->load->model('school_model', 'school_model');

                $data['schl_info'] = $this->school_model->getOnce_schlInfo($schl_id);

                if (($schl_id != '') && ($gen_id != '')) {

                    $data['schl_gen'] = $this->school_model->edit_generationID($gen_id);
                    $data['schl'] = $schl_id;
                    $data['gen_id'] = $gen_id;

                    $this->template->load('index_page', $data, 'school');
                } else {
                    page500();
                    $this->webinfo_model->LogSave($app_id, $process_action, 'Sign Out', 'Fail'); //Save Sign Out Log
                }

            } else if ($process_action == 'Edited' && get_inpost('bt_submit') != '' && $usrpm['perm_status'] == 'Yes') { //Edit && Submit Form
                $process_action = 'Edited';

                if (($schl_id != '') && ($gen_id != '')) {

                    //dieArray($_POST);
                    if (get_inpost('schl_gen[gen_status]') == '') {
                        $status = "ปิด";

                    } else {
                        $status = "เปิด";
                    }

                    $update_gen = array('schl_id' => $schl_id,
                        'gen_code' => get_inpost('schl_gen[gen_code]'),
                        'year_of_study' => get_inpost('schl_gen[year_of_study]'),
                        'gen_status' => $status,
                    );

                    $this->common_model->update('schl_info_generation', $update_gen, array('gen_id' => $gen_id));

                    // $tmp_edu     = get_inpost_arr('schl_info_edu[crse_code]');//จำนวนหลักสูตร
                    // $tem_identify = get_inpost_arr('schl_info_edu[crse_identify]');//ความคิดเห็นเจ้าหน้าที่
                    // $tem_update_edu = get_inpost_arr('edit_gduID');//จำนวนหลักสูตร ของการอัพเดท

                    // if(!empty($tmp_edu)){

                    //                foreach ($tmp_edu as $key => $crse_id) {
                    //                $data_edu = $this->school_model->get_std_schl_course($crse_id);

                    //                   if($tem_identify[$key]!=''){
                    //                         $comment = $tem_identify[$key];
                    //                   }else{
                    //                         $comment = $data_edu['crse_title'];
                    //                   }

                    //                   if(isset($tem_update_edu[$key])){

                    //                      $update_edu =array('gen_id'         => $gen_id,
                    //                                          'crse_code'      => $data_edu['crse_code'],
                    //                                          'crse_identify'  => $comment,
                    //                                          'crse_objective' => $data_edu['crse_objective'],
                    //                                          'crse_contents'  => $data_edu['crse_contents'],
                    //                                          'hours_per_week' => $data_edu['hours_per_week'],
                    //                                          'att_file'       => $data_edu['att_file'],
                    //                                          'att_label'      => $data_edu['att_label'],
                    //                                          'att_size'       => $data_edu['att_size']
                    //                                         );
                    //                     $this->common_model->update('schl_info_edu',$update_edu,array('edu_id'=>$tem_update_edu[$key]));

                    //                   }else{

                    //                    $insert_edu =array('gen_id'         => $gen_id,
                    //                                          'crse_code'      => $data_edu['crse_code'],
                    //                                          'crse_identify'  => $comment,
                    //                                          'crse_objective' => $data_edu['crse_objective'],
                    //                                          'crse_contents'  => $data_edu['crse_contents'],
                    //                                          'hours_per_week' => $data_edu['hours_per_week'],
                    //                                          'att_file'       => $data_edu['att_file'],
                    //                                          'att_label'      => $data_edu['att_label'],
                    //                                          'att_size'       => $data_edu['att_size']
                    //                                         );
                    //                     $this->common_model->insert('schl_info_edu',$insert_edu);
                    //                   }
                    //                   }

                    //            }

                    redirect('school/generation_detail/Edit/' . $schl_id . '/' . $gen_id);

                } else {
                    page500();
                    $this->webinfo_model->LogSave($app_id, $process_action, 'Sign Out', 'Fail'); //Save Sign Out Log
                }

                /*$this->session->set_flashdata('msg',setMsg('011')); //Set Message code 011
            $this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Success'); //Save Sign Out Log
            $this->template->load('index_page',$data,'school');
            redirect('school/photo2/Edit/'.$schl_id,'refresh');*/

            } else if ($process_action == 'Delete' && $usrpm['perm_status'] == 'Yes') { //Delete process
                /*$data_update = array();
            $data_update['delete_user_id'] = getUser();
            $data_update['delete_datetime'] = getDatetime();

            $this->common_model->update('diff_info',$data_update,array('diff_id'=>$diff_id));
            $this->session->set_flashdata('msg',setMsg('031')); //Set Message code 031
            $this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Success'); //Save Sign Out Log
            redirect('difficult/assist_list','refresh');*/
            } else {
                page500();
                $this->template->load('index_page', $data, 'school');
                $this->webinfo_model->LogSave($app_id, $process_action, 'Sign Out', 'Fail'); //Save Sign Out Log
            }

        }
    }

    public function participant($process_action = 'Add', $schl_id = 0, $gen_id = 0, $stu_id = 0)
    { // (ผู้สูงอายุที่เข้าร่วม)
        $data = array(); //Set Initial Variable to Views
        /*-- Initial Data for Check User Permission --*/
        $user_id = get_session('user_id');
        $app_id = 61;
        $process_path = 'school/participant';
        /*--END Inizial Data for Check User Permission--*/

        $this->webinfo_model->LogSave($app_id, $process_action, 'Sign In', 'Success'); //Save Sign In Log
        $usrpm = $this->admin_model->chkOnce_usrmPermiss($app_id, $user_id); //Check User Permission

        if (@$usrpm['perm_status'] == 'No' || !isset($usrpm['app_id'])) {
            page500();
            $this->webinfo_model->LogSave($app_id, $process_action, 'Sign Out', 'Fail'); //Save Sign Out Log
        } else {
            $app_name = $usrpm['app_name'];
            $data['usrpm'] = $usrpm;
            $data['user_id'] = $user_id;

            $tmp = $this->admin_model->getOnce_Application($usrpm['app_parent_id']); //Used for find root application
            $data['head_title'] = $tmp['app_name'];
            $data['title'] = $usrpm['app_name'];
            $data['schl_id'] = $schl_id;

            $this->load->library('template',
                array('name' => 'admin_template1',
                    'setting' => array('data_output' => ''))
            ); // Set Template

            /*-- datepicker --*/
            set_css_asset_head('../plugins/bootstrap-datepicker1.3.0/css/datepicker.css');
            set_js_asset_head('../plugins/bootstrap-datepicker1.3.0/js/bootstrap-datepicker.js');
            /*-- End datepicker --*/
            /*-- Load Datatables for Theme --*/
            set_css_asset_head('../plugins/Static_Full_Version/css/plugins/dataTables/datatables.min.css');
            set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/dataTables/datatables.min.js');

            /*-- Toastr style --*/
            set_css_asset_head('../plugins/Static_Full_Version/css/plugins/toastr/toastr.min.css');
            set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/toastr/toastr.min.js');
            //swicth on-off

            /*-- End Toastr style --*/
            set_js_asset_footer('participant.js', 'school'); //Set JS sufferer_form1.js

            $data['process_action'] = $process_action;
            $data['content_view'] = 'participant';

            $data['csrf'] = array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash(),
            );

            // dieArray($usrpm);
            if ($process_action == 'Add' && get_inpost('bt_submit') == '' && $usrpm['perm_status'] == 'Yes') {

                if (($schl_id != '') && ($gen_id != '')) {

                    $schl_stu = $this->school_model->get_student($schl_id, $gen_id); //แสดงข้อมูลนักเรียนที่ลงทะเบียน
                    $data['schl_stu'] = $schl_stu;
                    $data['schl_id'] = $schl_id;
                    $data['gen_id'] = $gen_id;

                    $this->template->load('index_page', $data, 'school');
                } else {
                    page500();
                    $this->webinfo_model->LogSave($app_id, $process_action, 'Sign Out', 'Fail'); //Save Sign Out Log
                }
            } else if ($process_action == 'Added' && get_inpost('bt_submit') != '' && $usrpm['perm_status'] == 'Yes') { //Add && Submit Form

                if (($schl_id != '') && ($gen_id != '')) {

                    if (get_inpost('tel_no_home') == '') {
                        $tel_no_home = null;
                    } else {
                        $tel_no_home = get_inpost('tel_no_home');
                    }

                    if (get_inpost('healthy_congenital_disease') == '') {
                        $healthy_congenital_disease = null;
                    } else {
                        $healthy_congenital_disease = get_inpost('healthy_congenital_disease');
                    }

                    $update_pers_info = array('tel_no_home' => $tel_no_home,
                        'healthy_congenital_disease' => $healthy_congenital_disease,
                    );
                    $this->common_model->update('pers_info', $update_pers_info, array('pers_id' => get_inpost('pers_id')));

                    $insert_schl_info_student = array('schl_id' => $schl_id,
                        'gen_id' => $gen_id,
                        'pers_id' => get_inpost('pers_id'),
                        'date_of_regis' => date("Y-d-m"));
                    $this->common_model->insert('schl_info_student', $insert_schl_info_student);

                    $this->session->set_flashdata('msg', setMsg('011')); //Set Message code 011
                    $this->webinfo_model->LogSave($app_id, $process_action, 'Sign Out', 'Success'); //Save Sign Out Log
                    redirect('school/participant/Add/' . $schl_id . '/' . $gen_id, 'refresh');

                } else {
                    page500();
                    $this->webinfo_model->LogSave($app_id, $process_action, 'Sign Out', 'Fail'); //Save Sign Out Log
                }

            } else if ($process_action == 'Edit' && get_inpost('bt_submit') == '' && $usrpm['perm_status'] == 'Yes') {

                if (($schl_id != '') && ($gen_id != '')) {

                    echo $schl_id . "<br>" . $gen_id;

                    //$this->template->load('index_page',$data,'school');
                } else {
                    page500();
                    $this->webinfo_model->LogSave($app_id, $process_action, 'Sign Out', 'Fail'); //Save Sign Out Log
                }

            } else if ($process_action == 'Edited' && $usrpm['perm_status'] == 'Yes') { //Edit && Submit Form
                $process_action = 'Edited';

                if (($schl_id != '') && ($gen_id != '')) {

                    if (get_inpost('tel_no_mobile') == '') {
                        $tel_no_mobile = null;
                    } else {
                        $tel_no_mobile = get_inpost('tel_no_mobile');
                    }

                    if (get_inpost('healthy_congenital_disease') == '') {
                        $healthy_congenital_disease = null;
                    } else {
                        $healthy_congenital_disease = get_inpost('healthy_congenital_disease');
                    }

                    $update_pers_info = array('tel_no' => $tel_no_mobile,
                        'healthy_congenital_disease' => $healthy_congenital_disease,
                    );
                    $this->common_model->update('pers_info', $update_pers_info, array('pers_id' => get_inpost('pers_id')));

                    $this->session->set_flashdata('msg', setMsg('011')); //Set Message code 011
                    $this->webinfo_model->LogSave($app_id, $process_action, 'Sign Out', 'Success'); //Save Sign Out Log
                    redirect('school/participant/Add/' . $schl_id . '/' . $gen_id, 'refresh');
                } else {
                    page500();
                    $this->webinfo_model->LogSave($app_id, $process_action, 'Sign Out', 'Fail'); //Save Sign Out Log
                }

            } else if ($process_action == 'Delete' && $usrpm['perm_status'] == 'Yes') { //Delete process

                $this->common_model->delete_where('schl_info_student', 'stu_id', $stu_id);
                $this->session->set_flashdata('msg', setMsg('031')); //Set Message code 031
                $this->webinfo_model->LogSave($app_id, $process_action, 'Sign Out', 'Success'); //Save Sign Out Log
                redirect('school/participant/Add/' . $schl_id . "/" . $gen_id, 'refresh');
            } else {
                page500();
                $this->template->load('index_page', $data, 'school');
                $this->webinfo_model->LogSave($app_id, $process_action, 'Sign Out', 'Fail'); //Save Sign Out Log
            }

        }
    }

    public function del_schl_contacts()
    {
        $contacts_id = get_inpost('contacts_id');
        $this->common_model->delete_where('schl_info_contacts', 'sch_cnt_id', $contacts_id);
        echo "remove";
    }

    public function del_schl_photo()
    {
        $id_photo = get_inpost('id_photo');
        $this->common_model->delete_where('schl_info_photo', 'schl_photo_id', $id_photo);
        echo "remove";

    }

    public function del_schl_edu()
    {
        $id_edu = get_inpost('id_edu');
        $this->common_model->delete_where('schl_info_edu', 'edu_id', $id_edu);
        echo "remove";

    }

    public function center_list($process_action = 'View')
    { // ตารางข้อมูล
        $data = array(); //Set Initial Variable to Views
        /*-- Initial Data for Check User Permission --*/
        $user_id = get_session('user_id');
        $app_id = 170; //170ตาราง
        $process_path = 'school/center_list';
        /*--END Inizial Data for Check User Permission--*/

        $this->webinfo_model->LogSave($app_id, $process_action, 'Sign In', 'Success'); //Save Sign In Log
        $usrpm = $this->admin_model->chkOnce_usrmPermiss($app_id, $user_id); //Check User Permission

        if ($usrpm['perm_status'] == 'No' || !isset($usrpm['app_id'])) {
            page500();
            return $this->webinfo_model->LogSave($app_id, $process_action, 'Sign Out', 'Fail'); //Save Sign In Log
        }

        $app_name = $usrpm['app_name'];
        $data['usrpm'] = $usrpm;
        $data['user_id'] = $user_id;
        $data['csrf'] = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash(),
        );
        $data['center_info'] = $this->school_model->getAll_CenterInfo();
        //$data['center_coor'] = $this->school_model->getAll_CenterCoordinator();//add code qlc_coordinator
        //$data['center_agency'] = $this->school_model->getAll_CenterAgency();//add code qlc_agency
        //$data['center_agency_coor'] = $this->school_model->getAll_CenterAgencyCoordinator();//add code qlc_agency_coordinator

        $this->load->library('template',
            array('name' => 'admin_template1',
                'setting' => array('data_output' => ''))
        ); // Set Template

        /*-- Load Datatables for Theme --*/
        set_css_asset_head('../plugins/Static_Full_Version/css/plugins/dataTables/datatables.min.css');
        set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/dataTables/datatables.min.js');
        /*-- End Load Datatables for Theme --*/
        /*-- Toastr style --*/
        set_css_asset_head('../plugins/Static_Full_Version/css/plugins/toastr/toastr.min.css');
        set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/toastr/toastr.min.js');
        /*-- End Toastr style --*/
        set_js_asset_footer('center_list_ajax.js', 'school'); //Set JS Index.js
        set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/ionRangeSlider/ion.rangeSlider.min.js'); //Set JS Index.js

        $data['process_action'] = $process_action;
        $data['content_view'] = 'center_list_ajax';

        $tmp = $this->admin_model->getOnce_Application($usrpm['app_parent_id']); //Used for find root application //app_parent_id
        $data['head_title'] = $tmp['app_name']; //163 ศพอส
        $data['title'] = $usrpm['app_name']; //$usrpm['app_name'] or 'ตารางข้อมูล' 170

        $this->template->load('index_page', $data, 'school');
        $this->webinfo_model->LogSave($app_id, $process_action, 'Sign Out', 'Success'); //Save Sign Out Log
    }

    public function center_list_ajax($process_action = 'View')
    { // รายการสงเคราะห์ผู้สูงอายุในภาวะยากลำบาก //รายการ ศพอส
        //ini_set('max_execution_time', 300);
        $data = array(); //Set Initial Variable to Views
        /*-- Initial Data for Check User Permission --*/
        $user_id = get_session('user_id');
        $app_id = 170;
        /*--END Inizial Data for Check User Permission--*/

        $this->webinfo_model->LogSave($app_id, $process_action, 'Sign In', 'Success'); //Save Sign In Log
        $usrpm = $this->admin_model->chkOnce_usrmPermiss($app_id, $user_id); //Check User Permission

        if ($usrpm['perm_status'] == 'No' || !isset($usrpm['app_id'])) {
            echo json_encode(array());
            return $this->webinfo_model->LogSave($app_id, $process_action, 'Sign Out', 'Fail'); //Save Sign In Log
        }
        $app_name = $usrpm['app_name'];
        $data['usrpm'] = $usrpm;
        $data['user_id'] = $user_id;

        $app_id = 59;
        $usrpm = $this->admin_model->chkOnce_usrmPermiss($app_id, $user_id);
        $this->load->model('center_model');
        $list = $this->center_model->get_filteredCenters();
        $data = array();
        $qlcIndex = $_POST['start'];
        // dieArray($list);

        foreach ($list as $i => $center) {
            $qlcIndex++;
            $row = array();

            $row[] = $qlcIndex;
            $row[] = empty($center['region']) ? '-' : $center['region'];
            $row[] = empty($center['province']) ? '-' : $center['province'];
            $row[] = $center['qlc_name'];
            $row[] = empty($center['latest_assess_year']) ? '-' : $center['latest_assess_year'];

            if (empty($center['score'])) {
                $row[] = '-';
            } else {
                $qlc_kpi_grade = $center['score'] === 0 ? '-' :
                ($center['score'] < 50 ? 'D' :
                    ($center['score'] < 60 ? 'C' :
                        ($center['score'] < 80 ? 'B' : 'A')));
                $row[] = "<center>$qlc_kpi_grade ({$center['score']})</center>";
            }

            $row[] = empty($center['amphur']) ? '-' : $center['amphur'];

            if (empty($center['year_of_sponsorship']) || $center['year_of_sponsorship'] == '0') {
                $row[] = '-';
            } else {
                $center['year_of_sponsorship'] += 543;
                $row[] = "<center>{$center['year_of_sponsorship']}</center>";
            }
            $row[] = "<center>N/A</center>";
            $row[] = empty($center['school_count']) ? '-' : $center['school_count'];

            $tmp = $this->admin_model->getOnce_Application(3);
            $tmp1 = $this->admin_model->chkOnce_usrmPermiss(3, $user_id); //Check User Permission
            $btn = '';
            $btn = $btn . '<!-- Single button -->
							<div class="btn-group" style="cursor: pointer;">
								<i  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle fa fa-gear" aria-hidden="true" style="color: #000"></i>

								<ul class="dropdown-menu" style="position: absolute;left: -190px;">';

            $btn = $btn . '<li><a  style="font-size:16px;"';

            if (!isset($tmp1['perm_status'])) {$btn = $btn . 'class="disabled"';} else { $btn = $btn . 'href="' . site_url("school/center_info/Edit/{$center['qlc_id']}");}
            $btn = $btn . '"><i class="fa fa-pencil" aria-hidden="true" style="color: #000"></i> แก้ไขรายการ</a></li>';

            $tmp = $this->admin_model->chkOnce_usrmPermiss(3, $user_id); //Check User Permission
            if (isset($tmp['perm_status'])) {
                if ($tmp['perm_status'] == 'Yes') {
                    $btn = $btn . '<li><a style="font-size:16px;" data-id=' . $center->qlc_id . ' onclick="opn(this)" title="ลบ" >
														<i class="fa fa-trash" style="color: #000"></i> ลบรายการ
												</a></li>';
                }
            }

            $btn = $btn . '</ul>
														</div>';

            $btn = $btn . '<!-- Print Modal -->
									<div class="modal fade" id="prt' . $center->qlc_id . '" role="dialog">
										<div class="modal-dialog">

											<!-- Modal content-->
											<div class="modal-content">
												<div class="modal-header text-left">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h4 class="modal-title" style="color: #333; font-size: 16px;">พิมพ์แบบฟอร์ม</h4>
												</div>
												<div class="modal-body">
													<div class="row">';

            $tmp = $this->admin_model->getOnce_Application(25);
            $tmp1 = $this->admin_model->chkOnce_usrmPermiss(25, get_session('user_id')); //Check User Permission

            $btn = $btn . '<div class="col-xs-12 col-sm-12 text-left" style="margin-bottom: 10px;"';
            if (!isset($tmp1['perm_status'])) {
                $btn = $btn . ' class="disabled "';
            } else if ($usrpm['app_id'] == 25) {
                $btn = $btn . ' class="active "';
            }
            $btn = $btn . '>
																<a style="color: #333; font-size: 16px;" target="_blank" href="' . site_url('report/C1/pdf?id=' . $center->qlc_id) . '"><i class="fa fa-print" aria-hidden="true"></i> ';
            if (isset($tmp1['perm_status'])) {
                $btn = $btn . $tmp1['app_name'];
            }
            $btn = $btn . '  </a>
														</div>';

            $tmp = $this->admin_model->getOnce_Application(26);
            $tmp1 = $this->admin_model->chkOnce_usrmPermiss(26, get_session('user_id')); //Check User Permission
            $btn = $btn . '<div class="col-xs-12 col-sm-12 text-left" style="margin-bottom: 10px;" ';
            if (!isset($tmp1['perm_status'])) {
                $btn = $btn . ' class="disabled" ';
            } else if ($usrpm['app_id'] == 26) {
                $btn = $btn . ' class="active" ';
            }
            $btn = $btn . '>';

            $btn = $btn . '<a style="color: #333; font-size: 16px; margin-bottom: 50px;" target="_blank" href="' . site_url('report/C2/pdf?id=' . $center->qlc_id) . '"><i class="fa fa-print" aria-hidden="true"></i> ';
            if (isset($tmp1['perm_status'])) {
                $btn = $btn . $tmp1['app_name'];
            }
            $btn = $btn . '
													</a>
												</div>';

            $tmp = $this->admin_model->getOnce_Application(27);
            $tmp1 = $this->admin_model->chkOnce_usrmPermiss(27, get_session('user_id')); //Check User Permission

            $btn = $btn . '<div class="col-xs-12 col-sm-12 text-left" style="margin-bottom: 10px;" ';
            if (!isset($tmp1['perm_status'])) {
                $btn = $btn . ' class="disabled" ';
            } else if ($usrpm['app_id'] == 27) {
                $btn = $btn . ' class="active" ';
            }
            $btn = $btn . '>';
            $btn = $btn . '<a style="color: #333; font-size: 16px; margin-bottom: 50px;" target="_blank" href="' . site_url('report/C3/pdf?id=' . $center->qlc_id) . '"><i class="fa fa-print" aria-hidden="true"></i> ';
            if (isset($tmp1['perm_status'])) {
                $btn = $btn . $tmp1['app_name'];
            }
            $btn = $btn . '</a>
													</div>';

            $btn = $btn . '

													</div>
													<br />

											</div>
										</div>

									</div>
									</div>
									<!-- End Print Modal -->';

            $row[] = "<center>" . $btn . "</center>";

            $data[] = $row;
        }

        $this->load->model('school_model', 'school');
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->school->count_all(),
            "recordsFiltered" => $this->school->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
        $this->webinfo_model->LogSave($app_id, $process_action, 'Sign Out', 'Success'); //Save Sign Out Log

    }

    public function center_info($process_action = 'Add', $qlc_id = 0)
    { //แบบขึ้นทะเบียน (โรงเรียน)
        $data = array(); //Set Initial Variable to Views
        /*-- Initial Data for Check User Permission --*/
        $user_id = get_session('user_id');
        $app_id = 169;
        $process_path = 'school/center_info';
        /*--END Inizial Data for Check User Permission--*/

        $this->webinfo_model->LogSave($app_id, $process_action, 'Sign In', 'Success'); //Save Sign In Log
        $usrpm = $this->admin_model->chkOnce_usrmPermiss($app_id, $user_id); //Check User Permission

        if (@$usrpm['perm_status'] == 'No' || !isset($usrpm['app_id'])) {
            page500();
            $this->webinfo_model->LogSave($app_id, $process_action, 'Sign Out', 'Fail'); //Save Sign Out Log
        } else {
            $app_name = $usrpm['app_name'];
            $data['usrpm'] = $usrpm;
            $data['user_id'] = $user_id;

            $this->load->library('template',
                array('name' => 'admin_template1',
                    'setting' => array('data_output' => ''))
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

            set_js_asset_footer('mapmarker.js', 'webconfig'); //Set JS mapmarker.js --

            set_js_asset_footer('center_info.js', 'school'); //Set JS sufferer_form1.js

            $data['process_action'] = $process_action;
            $data['content_view'] = 'center_info';

            $tmp = $this->admin_model->getOnce_Application($usrpm['app_parent_id']); //Used for find root application //app_parent_id
            $data['head_title'] = $tmp['app_name']; //163ศพอส
            $data['title'] = $usrpm['app_name']; //169แบบขึ้นทะเบียน ศพอส

            $data['csrf'] = array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash(),
            );

            if ($process_action == 'Add' && get_inpost('bt_submit') == '' && $usrpm['perm_status'] == 'Yes') {

                $data['center_info'] = $this->clr_schlInfo_center();

                //--- not sure ---
                $data['center_coor'] = $this->clr_schlInfo_center_coor(); //add code qlc_coordinator
                $data['center_agency'] = $this->clr_schlInfo_center_agency(); //add code qlc_agency
                $data['center_agency_coor'] = $this->clr_schlInfo_center_agency_coor(); //add code qlc_agency_coordinator

                //$data['center_coor_show'] = $this->school_model->getAll_CenterCoordinator();//add code qlc_coordinator
                //$data['center_agency_show'] = $this->school_model->getAll_CenterAgency();//add code qlc_agency
                //$data['center_agency_coor_show'] = $this->school_model->getAll_CenterAgencyCoordinator();//add code qlc_agency_coordinator
                //-----------------

                //$data['std_model'] = $this->school_model->get_std_model();//show std_school_model แสดงคุณสมบัติต้นแบบ

                //$data['std_qlc'] = $this->school_model->getAll_Center_qlc();//show std_qlc_kpi

                $this->template->load('index_page', $data, 'school');
                $this->webinfo_model->LogSave($app_id, $process_action, 'Sign Out', 'Success'); //Save Sign Out Log

            } else if ($process_action == 'Added' && get_inpost('bt_submit') != '' && $usrpm['perm_status'] == 'Yes') { //Add && Submit Form

                $data_insert_1 = array();
                $data_insert_1 = @get_inpost_arr('center_info');
                // dieArray($qlc_insert);
                $data_insert_1['insert_user_id'] = getUser();
                $data_insert_1['insert_org_id'] = get_session('org_id');
                $data_insert_1['insert_datetime'] = getDatetime();

                $data_insert_2 = array();
                $data_insert_2 = @get_inpost_arr('center_coor'); //add code qlc_coordinator
                // dieArray($qlc_insert);
                $data_insert_2['insert_user_id'] = getUser();
                $data_insert_2['insert_org_id'] = get_session('org_id');
                $data_insert_2['insert_datetime'] = getDatetime();

                $data_insert_3 = array();
                $data_insert_3 = @get_inpost_arr('center_agency'); //add code qlc_agency
                // dieArray($qlc_insert);
                $data_insert_3['insert_user_id'] = getUser();
                $data_insert_3['insert_org_id'] = get_session('org_id');
                $data_insert_3['insert_datetime'] = getDatetime();

                $data_insert_4 = array();
                $data_insert_4 = @get_inpost_arr('center_agency_coor'); //add code qlc_agency_coordinator
                // dieArray($qlc_insert);
                $data_insert_4['insert_user_id'] = getUser();
                $data_insert_4['insert_org_id'] = get_session('org_id');
                $data_insert_4['insert_datetime'] = getDatetime();

                //add id variable
                $id_center_info = $this->common_model->insert('qlc_info', $data_insert_1);

                $data_insert_2['qlc_id'] = $id_center_info;
                $id_center_coor = $this->common_model->insert('qlc_coordinator', $data_insert_2);

                $data_insert_3['qlc_id'] = $id_center_info;
                $id_center_agency = $this->common_model->insert('qlc_agency', $data_insert_3);

                $data_insert_4['qlc_agency_id'] = $id_center_agency;
                $id_center_agency_coor = $this->common_model->insert('qlc_agency_coordinator', $data_insert_4);

                //$id = $this->common_model->insert('qlc_info',$data_insert);

                //--- ซ่อน การ insert qlc_kpi_result ---
                //    dieArray($_POST);
                /*$qlc_insert = array();
                $qlc_insert = @get_inpost_arr('qlc');
                if(!empty($qlc_insert)){
                foreach ($qlc_insert as $key_model => $val_model) {

                $insert_model = array('qlc_id'     => $id,
                'qlc_kpi_code'   => $key_model,
                'qlc_kpi_result' => 'มี'
                );
                $this->common_model->insert('qlc_kpi',$insert_model);
                }
                }*/

                $this->session->set_flashdata('msg', setMsg('011')); //Set Message code 011

                $this->webinfo_model->LogSave($app_id, $process_action, 'Sign Out', 'Success'); //Save Sign Out Log

                redirect('school/center_list', 'refresh');

            } else if ($process_action == 'Edit' && get_inpost('bt_submit') == '' && $usrpm['perm_status'] == 'Yes') {

                if ($qlc_id != '') {

                    $data['center_info'] = $this->school_model->getAll_CenterInfo($qlc_id);
                    $data['center_coor'] = $this->school_model->getAll_CenterCoordinator($qlc_id); //add code qlc_coordinator
                    $data['center_agency'] = $this->school_model->getAll_CenterAgency($qlc_id); //add code qlc_agency
                    $data['center_agency_coor'] = $this->school_model->getAll_CenterAgencyCoordinator($qlc_id); //add code qlc_agency_coordinator

                    //$data['std_qlc'] = $this->school_model->getAll_Center_qlc();//show std_qlc_kpi
                    $this->template->load('index_page', $data, 'school');

                } else {
                    page500();
                    $this->webinfo_model->LogSave($app_id, $process_action, 'Sign Out', 'Fail'); //Save Sign Out Log
                }

            } else if ($process_action == 'Edited' && get_inpost('bt_submit') != '' && $usrpm['perm_status'] == 'Yes') { //Edit && Submit Form
                //dieArray($_POST);
                $process_action = 'Edited';

                //$data_insert                     = array();
                //$data_insert                     = @get_inpost_arr('center_info');
                //$data_insert                     = @get_inpost_arr('center_coor'); //add code qlc_coordinator
                //$data_insert                     = @get_inpost_arr('center_agency'); //add code qlc_agency
                //$data_insert                     = @get_inpost_arr('center_agency_coor'); //add code qlc_agency_coordinator
                //$data_insert['update_user_id']     = getUser();
                //$data_insert['update_org_id']     = get_session('org_id');
                //$data_insert['update_datetime'] = getDatetime();

                //$this->common_model->update('qlc_info',$data_insert,array('qlc_id'=>$qlc_id));

                // add code
                $data_insert_1 = array();
                $data_insert_1 = @get_inpost_arr('center_info');
                // dieArray($qlc_insert);
                $data_insert_1['update_user_id'] = getUser();
                $data_insert_1['update_org_id'] = get_session('org_id');
                $data_insert_1['update_datetime'] = getDatetime();

                $data_insert_2 = array();
                $data_insert_2 = @get_inpost_arr('center_coor'); //add code qlc_coordinator
                // dieArray($qlc_insert);
                $data_insert_2['update_user_id'] = getUser();
                $data_insert_2['update_org_id'] = get_session('org_id');
                $data_insert_2['update_datetime'] = getDatetime();

                $data_insert_3 = array();
                $data_insert_3 = @get_inpost_arr('center_agency'); //add code qlc_agency
                // dieArray($qlc_insert);
                $data_insert_3['update_user_id'] = getUser();
                $data_insert_3['update_org_id'] = get_session('org_id');
                $data_insert_3['update_datetime'] = getDatetime();

                $data_insert_4 = array();
                $data_insert_4 = @get_inpost_arr('center_agency_coor'); //add code qlc_agency_coordinator
                // dieArray($qlc_insert);
                $data_insert_4['update_user_id'] = getUser();
                $data_insert_4['update_org_id'] = get_session('org_id');
                $data_insert_4['update_datetime'] = getDatetime();

                //add id variable
                $this->common_model->update('qlc_info', $data_insert_1, array('qlc_id' => $qlc_id)); //$id_center_info =
                $this->common_model->update('qlc_coordinator', $data_insert_2, array('qlc_id' => $qlc_id)); //$id_center_coor =
                $this->common_model->update('qlc_agency', $data_insert_3, array('qlc_id' => $qlc_id)); //$id_center_agency =

                $center_agency = $this->school_model->getAll_CenterAgency($qlc_id); //add code qlc_agency
                $id_center_agency_coor = $this->common_model->update('qlc_agency_coordinator', $data_insert_4, array('qlc_agency_id' => $center_agency['qlc_agency_id']));

                //--- ซ่อนการ calculate qlc_kpi_result ---
                /*$update_qlc = @get_inpost_arr('qlc');//จำนวนเจ้าหน้าที่ที่มีการเพิ่มอยู่แล้ว

                $this->common_model->delete_where("qlc_kpi",'qlc_id',$qlc_id);
                if(!empty($update_qlc)){
                foreach ($update_qlc as $key_model => $val_model) {

                $insert_model = array('qlc_id'     => $qlc_id,
                'qlc_kpi_code'   => $key_model,
                'qlc_kpi_result' => 'มี'
                );
                $this->common_model->insert('qlc_kpi',$insert_model);
                }
                }*/

                $this->session->set_flashdata('msg', setMsg('021')); //Set Message code 021

                $this->webinfo_model->LogSave($app_id, $process_action, 'Sign Out', 'Success'); //Save Sign Out Log

                redirect('school/center_info/Edit/' . $qlc_id, 'refresh');

            } else if ($process_action == 'Delete' && $usrpm['perm_status'] == 'Yes') { //Delete process
                //Delete process
                $data_update = array();
                $data_update['delete_user_id'] = getUser();
                $data_update['delete_org_id'] = get_session('org_id');
                $data_update['delete_datetime'] = getDatetime();

                //$this->common_model->update('qlc_info',$data_update,array('qlc_id'=>$qlc_id));

                $this->common_model->update('qlc_info', $data_update, array('qlc_id' => $qlc_id)); //$id_center_info =
                $this->common_model->update('qlc_coordinator', $data_update, array('qlc_id' => $qlc_id)); //$id_center_coor =

                $center_agency = $this->school_model->getAll_CenterAgency($qlc_id); //add code qlc_agency
                $id_center_agency_coor = $this->common_model->update('qlc_agency_coordinator', $data_update, array('qlc_agency_id' => $center_agency['qlc_agency_id']));

                $this->common_model->update('qlc_agency', $data_update, array('qlc_id' => $qlc_id)); //$id_center_agency =

                //------------------------------------------------------------
                $this->common_model->delete_where("qlc_kpi", 'qlc_id', $qlc_id);

                $this->session->set_flashdata('msg', setMsg('031')); //Set Message code 031
                $this->webinfo_model->LogSave($app_id, $process_action, 'Sign Out', 'Success'); //Save Sign Out Log
                redirect('school/center_list', 'refresh');
            } else {
                page500();
                $this->template->load('index_page', $data, 'difficult');
                $this->webinfo_model->LogSave($app_id, $process_action, 'Sign Out', 'Fail'); //Save Sign Out Log
            }

        }

    }

    public function center_kpi($process_action = 'Add', $qlc_id = 0)
    { //แบบขึ้นทะเบียน (โรงเรียน) // แบบประเมิณ KPI
        $data = array(); //Set Initial Variable to Views
        /*-- Initial Data for Check User Permission --*/
        $user_id = get_session('user_id');
        $app_id = 169;
        $process_path = 'school/center_kpi';
        /*--END Inizial Data for Check User Permission--*/

        $this->webinfo_model->LogSave($app_id, $process_action, 'Sign In', 'Success'); //Save Sign In Log
        $usrpm = $this->admin_model->chkOnce_usrmPermiss($app_id, $user_id); //Check User Permission

        if (@$usrpm['perm_status'] == 'No' || !isset($usrpm['app_id'])) {
            page500();
            $this->webinfo_model->LogSave($app_id, $process_action, 'Sign Out', 'Fail'); //Save Sign Out Log
        } else {
            $app_name = $usrpm['app_name'];
            $data['usrpm'] = $usrpm;
            $data['user_id'] = $user_id;

            $this->load->library('template',
                array('name' => 'admin_template1',
                    'setting' => array('data_output' => ''))
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

            set_js_asset_footer('mapmarker.js', 'webconfig'); //Set JS mapmarker.js --

            set_js_asset_footer('center_kpi.js', 'school'); //Set JS sufferer_form1.js //center_info.js

            $data['process_action'] = $process_action;
            $data['content_view'] = 'center_kpi'; //center_info

            $tmp = $this->admin_model->getOnce_Application($usrpm['app_parent_id']); //Used for find root application //app_parent_id
            $data['head_title'] = $tmp['app_name']; //163ศพอส
            $data['title'] = $usrpm['app_name']; //169แบบขึ้นทะเบียน ศพอส

            $data['csrf'] = array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash(),
            );

            if ($process_action == 'Add' && get_inpost('bt_submit') == '' && $usrpm['perm_status'] == 'Yes') {

                $data['center_info'] = $this->clr_schlInfo_center();

                //--- not sure ---
                $data['center_kpi'] = $this->clr_schlInfo_center_kpi(); //add code qlc_kpi

                //$data['std_model'] = $this->school_model->get_std_model();//show std_school_model แสดงคุณสมบัติต้นแบบ
                $data['std_qlc'] = $this->school_model->getAll_Center_qlc(); //show std_qlc_kpi

                $this->template->load('index_page', $data, 'school');
                $this->webinfo_model->LogSave($app_id, $process_action, 'Sign Out', 'Success'); //Save Sign Out Log

            } else if ($process_action == 'Added' && get_inpost('bt_submit') != '' && $usrpm['perm_status'] == 'Yes') { //Add && Submit Form

                //$data_insert_1                     = array();
                //$data_insert_1                     = @get_inpost_arr('center_kpi');

                // dieArray($qlc_insert);
                //$data_insert_1['insert_user_id']     = getUser();
                //$data_insert_1['insert_org_id']     = get_session('org_id');
                //$data_insert_1['insert_datetime']     = getDatetime();

                //$id = $this->common_model->insert('qlc_info',$data_insert_1);

                //=============================================================================
                //--- add code / edit code qlc_kpi ---
                /*$id = $qlc_id;*/

                // dieArray($_POST);
                /*$qlc_insert = array();
                $qlc_insert = @get_inpost_arr('qlc');
                if(!empty($qlc_insert)){
                foreach ($qlc_insert as $key_model => $val_model) {

                $insert_model = array('qlc_id'             => $id,
                'qlc_kpi_code'       => $key_model,
                'qlc_kpi_result'     => 'มี',
                'insert_user_id'        => getUser(),
                'insert_org_id'        => get_session('org_id'),
                'insert_datetime'    => getDatetime()
                );
                $this->common_model->insert('qlc_kpi',$insert_model);
                }
                }*/
                //=============================================================================

                //--- add code / edit code qlc_kpi ---
                $id = $qlc_id;

                // dieArray($_POST);
                //$update_qlc = array();
                $update_qlc = @get_inpost_arr('qlc'); //จำนวนเจ้าหน้าที่ที่มีการเพิ่มอยู่แล้ว
                //$this->common_model->delete_where("qlc_kpi",'qlc_id',$qlc_id); //ลบของที่มีอยู่
                if (!empty($update_qlc)) {
                    foreach ($update_qlc as $key_model => $val_model) {

                        $insert_model = array(
                            'qlc_id' => $id,
                            'qlc_kpi_code' => $key_model,
                            'qlc_kpi_result' => 'มี',
                            'insert_user_id' => getUser(),
                            'insert_org_id' => get_session('org_id'),
                            'insert_datetime' => getDatetime(),
                        );
                        $this->common_model->insert('qlc_kpi', $insert_model);
                    }
                }

                $this->session->set_flashdata('msg', setMsg('011')); //Set Message code 011

                $this->webinfo_model->LogSave($app_id, $process_action, 'Sign Out', 'Success'); //Save Sign Out Log

                redirect('school/center_kpi', 'refresh');

            } else if ($process_action == 'Edit' && get_inpost('bt_submit') == '' && $usrpm['perm_status'] == 'Yes') {

                if ($qlc_id != '') {

                    $data['center_info'] = $this->school_model->getAll_CenterInfo($qlc_id);
                    //$data['std_qlc'] = $this->school_model->getAll_Center_qlc();//show std_qlc_kpi
                    $data['std_qlc'] = $this->school_model->getAll_Center_qlc(); //show std_qlc_kpi
                    $this->template->load('index_page', $data, 'school');

                } else {
                    page500();
                    $this->webinfo_model->LogSave($app_id, $process_action, 'Sign Out', 'Fail'); //Save Sign Out Log
                }

            } else if ($process_action == 'Edited' && get_inpost('bt_submit') != '' && $usrpm['perm_status'] == 'Yes') { //Edit && Submit Form
                //dieArray($_POST);
                $process_action = 'Edited';

                //$data_insert                     = array();
                //$data_insert                     = @get_inpost_arr('center_info');
                //$data_insert['update_user_id']     = getUser();
                //$data_insert['update_org_id']     = get_session('org_id');
                //$data_insert['update_datetime'] = getDatetime();

                //$this->common_model->update('qlc_info',$data_insert,array('qlc_id'=>$qlc_id));

                //--- add code / edit code qlc_kpi ---
                $id = $qlc_id;

                // dieArray($_POST);
                //$update_qlc = array();
                $update_qlc = @get_inpost_arr('qlc'); //จำนวนเจ้าหน้าที่ที่มีการเพิ่มอยู่แล้ว
                //$this->common_model->delete_where("qlc_kpi",'qlc_id',$qlc_id); //ลบของที่มีอยู่
                if (!empty($update_qlc)) {
                    foreach ($update_qlc as $key_model => $val_model) {

                        $insert_model = array(
                            'qlc_id' => $id,
                            'qlc_kpi_code' => $key_model,
                            'qlc_kpi_result' => 'มี',
                            'insert_user_id' => getUser(),
                            'insert_org_id' => get_session('org_id'),
                            'insert_datetime' => getDatetime(),
                        );
                        $this->common_model->insert('qlc_kpi', $insert_model);
                    }
                }

                $this->session->set_flashdata('msg', setMsg('021')); //Set Message code 021

                $this->webinfo_model->LogSave($app_id, $process_action, 'Sign Out', 'Success'); //Save Sign Out Log

                redirect('school/center_kpi/Edit/' . $qlc_id, 'refresh');

            } else if ($process_action == 'Delete' && $usrpm['perm_status'] == 'Yes') { //Delete process
                //Delete process
                $data_update = array();
                $data_update['delete_user_id'] = getUser();
                $data_update['delete_org_id'] = get_session('org_id');
                $data_update['delete_datetime'] = getDatetime();

                $kpi_qlc_insert_dt = $this->input->get('insert_datetime');

                //$this->common_model->update('qlc_info',$data_update,array('qlc_id'=>$qlc_id));
                //$this->common_model->delete_where("qlc_kpi",'qlc_id',$qlc_id);

                //$center_kpi_info = $this->school_model->getAll_CenterAgency($qlc_id);//add code qlc_agency
                $id = $qlc_id;
                $center_kpi_results = $this->common_model->update('qlc_kpi', $data_update, array('qlc_id' => $id, 'insert_datetime' => $kpi_qlc_insert_dt));

                $this->session->set_flashdata('msg', setMsg('031')); //Set Message code 031
                $this->webinfo_model->LogSave($app_id, $process_action, 'Sign Out', 'Success'); //Save Sign Out Log
                //redirect('school/center_kpi','refresh');

                redirect('school/center_kpi/Edit/' . $qlc_id, 'refresh'); //add code
            } else {
                page500();
                $this->template->load('index_page', $data, 'difficult');
                $this->webinfo_model->LogSave($app_id, $process_action, 'Sign Out', 'Fail'); //Save Sign Out Log
            }

        }

    }

    public function center_activity($process_action = 'Add', $schl_id = 0)
    { //แบบขึ้นทะเบียน (โรงเรียน) // แบบประเมิณ KPI
        $data = array(); //Set Initial Variable to Views
        /*-- Initial Data for Check User Permission --*/
        $user_id = get_session('user_id');
        $app_id = 169;
        $process_path = 'school/center_activity';
        /*--END Inizial Data for Check User Permission--*/

        $this->webinfo_model->LogSave($app_id, $process_action, 'Sign In', 'Success'); //Save Sign In Log
        $usrpm = $this->admin_model->chkOnce_usrmPermiss($app_id, $user_id); //Check User Permission

        if (@$usrpm['perm_status'] == 'No' || !isset($usrpm['app_id'])) {
            page500();
            $this->webinfo_model->LogSave($app_id, $process_action, 'Sign Out', 'Fail'); //Save Sign Out Log
        } else {
            $app_name = $usrpm['app_name'];
            $data['usrpm'] = $usrpm;
            $data['user_id'] = $user_id;

            $this->load->library('template',
                array('name' => 'admin_template1',
                    'setting' => array('data_output' => ''))
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

            set_js_asset_footer('mapmarker.js', 'webconfig'); //Set JS mapmarker.js --

            set_js_asset_footer('center_info.js', 'school'); //Set JS sufferer_form1.js

            $data['process_action'] = $process_action;
            $data['content_view'] = 'center_activity'; //center_info

            $tmp = $this->admin_model->getOnce_Application($usrpm['app_parent_id']); //Used for find root application //app_parent_id
            $data['head_title'] = $tmp['app_name']; //163ศพอส
            $data['title'] = $usrpm['app_name']; //169แบบขึ้นทะเบียน ศพอส

            $data['csrf'] = array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash(),
            );

            if ($process_action == 'Add' && get_inpost('bt_submit') == '' && $usrpm['perm_status'] == 'Yes') {

                $data['center_info'] = $this->clr_schlInfo_center();
                $data['std_model'] = $this->school_model->get_std_model(); //แสดงคุณสมบัติต้นแบบ
                $data['std_qlc'] = $this->school_model->getAll_Center_qlc(); //show qlc

                $this->template->load('index_page', $data, 'school');
                $this->webinfo_model->LogSave($app_id, $process_action, 'Sign Out', 'Success'); //Save Sign Out Log

            } else if ($process_action == 'Added' && get_inpost('bt_submit') != '' && $usrpm['perm_status'] == 'Yes') { //Add && Submit Form

                $data_insert = array();
                $data_insert = @get_inpost_arr('center_info');

                // dieArray($qlc_insert);
                $data_insert['insert_user_id'] = getUser();
                $data_insert['insert_org_id'] = get_session('org_id');
                $data_insert['insert_datetime'] = getDatetime();

                $id = $this->common_model->insert('qlc_info', $data_insert);

                // dieArray($_POST);
                $qlc_insert = array();
                $qlc_insert = @get_inpost_arr('qlc');
                if (!empty($qlc_insert)) {
                    foreach ($qlc_insert as $key_model => $val_model) {

                        $insert_model = array('qlc_id' => $id,
                            'qlc_kpi_code' => $key_model,
                            'qlc_kpi_result' => 'มี',
                        );
                        $this->common_model->insert('qlc_kpi', $insert_model);
                    }
                }

                $this->session->set_flashdata('msg', setMsg('011')); //Set Message code 011

                $this->webinfo_model->LogSave($app_id, $process_action, 'Sign Out', 'Success'); //Save Sign Out Log

                redirect('school/center_activity', 'refresh');

            } else if ($process_action == 'Edit' && get_inpost('bt_submit') == '' && $usrpm['perm_status'] == 'Yes') {

                if ($schl_id != '') {

                    $data['center_info'] = $this->school_model->getAll_CenterInfo($schl_id);
                    $data['std_qlc'] = $this->school_model->getAll_Center_qlc(); //show qlc

                    // pii fixed
                    $this->load->model('center_model');
                    $data['activities'] = $this->center_model->get_activities($schl_id);
                    $data['link']['get_participants_ajax'] = base_url() . 'school/get_participants_ajax/';
                    $this->template->load('index_page', $data, 'school');

                } else {
                    page500();
                    $this->webinfo_model->LogSave($app_id, $process_action, 'Sign Out', 'Fail'); //Save Sign Out Log
                }

            } else if ($process_action == 'Edited' && get_inpost('bt_submit') != '' && $usrpm['perm_status'] == 'Yes') { //Edit && Submit Form
                //dieArray($_POST);
                $process_action = 'Edited';

                $data_insert = array();
                $data_insert = @get_inpost_arr('center_info');
                $data_insert['update_user_id'] = getUser();
                $data_insert['update_org_id'] = get_session('org_id');
                $data_insert['update_datetime'] = getDatetime();

                $this->common_model->update('qlc_info', $data_insert, array('qlc_id' => $schl_id));

                //$update_qlc = @get_inpost_arr('qlc');//จำนวนเจ้าหน้าที่ที่มีการเพิ่มอยู่แล้ว //ซ่อน

                //------------------------------qlc-kpi-----------------------------
                $this->common_model->delete_where("qlc_kpi", 'qlc_id', $schl_id);
                if (!empty($update_qlc)) {
                    foreach ($update_qlc as $key_model => $val_model) {

                        $insert_model = array('qlc_id' => $schl_id,
                            'qlc_kpi_code' => $key_model,
                            'qlc_kpi_result' => 'มี',
                        );
                        $this->common_model->insert('qlc_kpi', $insert_model);
                    }
                }

                $this->session->set_flashdata('msg', setMsg('021')); //Set Message code 021

                $this->webinfo_model->LogSave($app_id, $process_action, 'Sign Out', 'Success'); //Save Sign Out Log

                redirect('school/center_activity/Edit/' . $schl_id, 'refresh');

            } else if ($process_action == 'Delete' && $usrpm['perm_status'] == 'Yes') { //Delete process
                //Delete process
                $data_update = array();
                $data_update['delete_user_id'] = getUser();
                $data_update['delete_org_id'] = get_session('org_id');
                $data_update['delete_datetime'] = getDatetime();

                $this->common_model->update('qlc_info', $data_update, array('qlc_id' => $schl_id));
                $this->common_model->delete_where("qlc_kpi", 'qlc_id', $schl_id);

                $this->session->set_flashdata('msg', setMsg('031')); //Set Message code 031
                $this->webinfo_model->LogSave($app_id, $process_action, 'Sign Out', 'Success'); //Save Sign Out Log
                redirect('school/center_activity', 'refresh');
            } else {
                page500();
                $this->template->load('index_page', $data, 'difficult');
                $this->webinfo_model->LogSave($app_id, $process_action, 'Sign Out', 'Fail'); //Save Sign Out Log
            }

        }

    }

    public function get_participants_ajax($acti_id)
    {
        $this->load->model('center_model');
        echo json_encode($this->center_model->get_participants($acti_id));
    }

}
