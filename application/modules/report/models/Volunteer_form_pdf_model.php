<?php defined('BASEPATH') OR exit('No direct script access allowed');

ini_set('memory_limit', '600000M');

class Volunteer_form_pdf_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function reportF2($id) {
        $data = $this->get_stdTables();
        $data['person'] = $this->get_volunteerData($id);

        if (empty($data['person']))
            die('This volunteer does not exist.');

        $data = array_merge($data, $this->get_volunteerExperiences($id));
        $data['person']['done_activities'] = $this->uniq_doneActivities($data['exp_care_progress']);
        return $data;
    }

    private function get_volunteerData($id) {
        $data = $this->db
            ->from('volt_info a')
            ->join('pers_info b', 'a.pers_id=b.pers_id', 'left')
            ->join('pers_addr c', 'b.pre_addr_id=c.addr_id', 'left')
            ->where('a.volt_id', $id)
            ->get()
            ->row_array();
        $data['date_of_birth_th'] = $this->format_thaiDate($data['date_of_birth']);
        $data = array_merge($data, $this->db
            ->from('volt_info_training')
            ->order_by('date_of_training', 'desc')
            ->where('volt_id', $id)
            ->get()
            ->row_array());
        $data['date_of_training'] = $this->format_thaiDate($data['date_of_training']);
        $data['amphur'] = $this->get_areaName($data['addr_sub_district']);
        $data['tambon'] = $this->get_areaName($data['addr_district']);
        $data['province'] = $this->get_areaName($data['addr_province']);
        return $data;
    }

    private function get_stdTables() {
        return array(
            'std_education' => $this->db->get('std_edu_level')->result_array(),
            'std_position' => $this->db->get('std_village_position')->result_array(),
            'std_activity' => $this->db->get('std_care_activity')->result_array(),
            'std_prename' => $this->db->get('std_prename')->result_array()
        );
    }

    private function get_volunteerExperiences($id) {
        return array(
            'exp_position' => $this->get_whereVolunteer('volt_info_village_position', $id),
            'exp_care_progress' => $this->get_whereVolunteer('volt_info_care_progress', $id, 'care_prog_volt_id'),
            'exp_elders_in_charge' => $this->db
                ->from('volt_info_elderly_care a')
                ->join('pers_info b', 'a.pers_id=b.pers_id', 'left')
                ->where('a.volt_id', $id)
                ->get()
                ->result_array()
        );
    }

    private function get_areaName($areaId) {
        $row = $this->db->get_where('std_area', array('area_code' => $areaId))->row_array();
        return $row['area_name_th'];
    }

    private function get_whereVolunteer($table, $id, $idKey = 'volt_id') {
        return $this->db->get_where($table, array($idKey => $id))->result_array();
    }

    private function uniq_doneActivities($progress) {
        $done = array();
        foreach ($progress as $each) {
            $idSet = json_decode($each['care_prog_acti_id_set']);
            $done = array_unique(array_merge($done, is_array($idSet) ? $idSet : array()));
        }
        return $done;
    }

    private function format_thaiDate($d) {
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $d) || $d == '0000-00-00')
            return '';
        $thaiMonth = explode(',', ',มกราคม,กุมภาพันธ์,มีนาคม,เมษายน,พฤษภาคม,มิถุนายน,กรกฎาคม,สิงหาคม,กันยายน,ตุลาคม,พฤศจิกายน,ธันวาคม');
        $d = explode('-', $d);
        return (int)$d[2] . ' ' . $thaiMonth[(int)$d[1]] . ' ' . ($d[0] + 543);
    }
}
