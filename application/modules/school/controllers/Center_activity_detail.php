<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Center_activity_detail extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        chkUserLogin();
    }

    public function insert_activity()
    {
        $this->db->insert('qlc_activity', array(
            'qlc_id' => $this->input->post('qlc_id'),
            'acti_name' => $this->input->post('acti_name'),
            'cate_acti' => $this->input->post('cate_acti'),
            'care_acti_custom' => $this->input->post('care_acti_custom'),
            'acti_agency' => $this->input->post('acti_agency'),
            'start_date' => $this->input->post('start_date'),
            'end_date' => $this->input->post('end_date'),
            'budget' => $this->input->post('budget'),
            'insert_user_id' => get_session('user_id'),
            'insert_org_id' => get_session('org_id'),
            'insert_datetime' => getDatetime(),
        ));
        redirect("school/center_activity/Edit/" . $this->input->post('qlc_id'));
    }

    public function update_activity()
    {
        $this->db->update('qlc_activity', array(
            'acti_name' => $this->input->post('acti_name'),
            'cate_acti' => $this->input->post('cate_acti'),
            'care_acti_custom' => $this->input->post('care_acti_custom'),
            'acti_agency' => $this->input->post('acti_agency'),
            'start_date' => $this->input->post('start_date'),
            'end_date' => $this->input->post('end_date'),
            'budget' => $this->input->post('budget'),
            'update_user_id' => get_session('user_id'),
            'update_org_id' => get_session('org_id'),
            'update_datetime' => getDatetime(),
        ), array('acti_id' => $this->input->post('acti_id')));
        redirect("school/center_activity/Edit/" . $this->input->post('qlc_id'));
    }

    public function download_member_form()
    {
        $this->load->helper('download');
        $path = file_get_contents(APPPATH . '/../assets/modules/report/static/activity_member.xlsx');
        $name = "Activity Participants Form.xlsx";
        force_download($name, $path);
    }

    public function clear_participants()
    {
        $this->db->update('qlc_participate', array(
            'delete_user_id' => get_session('user_id'),
            'delete_org_id' => get_session('org_id'),
            'delete_datetime' => getDatetime(),
        ), array('acti_id' => $this->input->post('acti_id')));
        redirect("school/center_activity/Edit/" . $this->input->post('qlc_id'));
    }

    public function import_participants()
    {
        if ($_SERVER['DOCUMENT_ROOT'] === 'C:/xampp7/htdocs') {
            $_SERVER['DOCUMENT_ROOT'] .= '/dop';
        }
        require_once "{$_SERVER['DOCUMENT_ROOT']}/application/modules/import/libraries/ImportFormExcel.php";

        $path = './assets/uploads/files/';
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
            $participants[] = array(
                'acti_id' => $this->input->post('acti_id'),
                'pid' => $row['B'],
                'parti_title_th' => $row['C'],
                'parti_firstname_th' => $row['D'],
                'parti_lastname_th' => $row['E'],
                'parti_age' => $row['F'],
                'insert_user_id' => get_session('user_id'),
                'insert_org_id' => get_session('org_id'),
                'insert_datetime' => getDatetime(),
            );
        }
        // die(json_encode($participants));
        $this->db->insert_batch('qlc_participate', $participants);
        unlink($path . $import_xls_file);
        redirect("school/center_activity/Edit/" . $this->input->post('qlc_id'));
    }

}
