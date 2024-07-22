<?php

class Center_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_filteredCenters()
    {
        if ($usrpm['perm_view'] == 'Organization') {
            $this->db->where(array('A.insert_org_id' => get_session('org_id')));
        }
        if ($usrpm['perm_view'] == 'Person') {
            $this->db->where(array('A.insert_user_id' => get_session('user_id')));
        }

        $this->db->select('A.*')
            ->from('qlc_info A')
            ->where(array('A.delete_user_id' => null, 'A.delete_datetime' => null));

        $this->db->join('std_area B1', 'A.addr_province=B1.area_code', 'left')
            ->select('B1.four_regions as region, B1.area_name_th as province');

        $this->db->join('std_area B2', 'A.addr_district=B2.area_code', 'left')
            ->select('B2.area_name_th as amphur');

        $this->db->join('qlc_kpi C', 'A.qlc_id=C.qlc_id', 'left')
            ->select('max(year(C.insert_datetime))+543 as latest_assess_year');

        $this->db->join('(
            select d1.qlc_id,
                (count(if(qlc_kpi_code>=0101 and qlc_kpi_code<=0110, 1, null)) +
                count(if(qlc_kpi_code>=0201 and qlc_kpi_code<=0210, 1, null)) +
                count(if(qlc_kpi_code>=0301 and qlc_kpi_code<=0302, 1, null)) +
                count(if(qlc_kpi_code>=0401 and qlc_kpi_code<=0408, 1, null)) +
                count(if(qlc_kpi_code>=0501 and qlc_kpi_code<=0503, 1, null)) +
                count(if(qlc_kpi_code>=0601 and qlc_kpi_code<=0612, 1, null))) * 2 as score
            from qlc_kpi d1
            join (
                select qlc_id, max(insert_datetime) as maxdate
                from qlc_kpi
                group by qlc_id
            ) as d2 on d1.qlc_id=d2.qlc_id and d1.insert_datetime=d2.maxdate
            group by d1.qlc_id
        ) as D', 'A.qlc_id=D.qlc_id', 'left')
            ->select('D.score');

        $this->db->join('(
            select qlc_id, count(qlc_id) as school_count
            from schl_info
            group by qlc_id
        ) as E', 'A.qlc_id=E.qlc_id', 'left')
            ->select('E.school_count');

        if ($_POST['length'] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        // filter name
        if (!empty($_POST['columns'][1]['search']['value'])) {
            $this->db->like('A.qlc_name', $_POST['columns'][1]['search']['value']);
        }
        // filter amphur else filter province else filter region
        if (!empty($_POST['columns'][4]['search']['value'])) {
            $this->db->like('B2.area_code', $_POST['columns'][4]['search']['value'], 'after');
        } elseif (!empty($_POST['columns'][3]['search']['value'])) {
            $this->db->where('B1.area_code', $_POST['columns'][3]['search']['value']);
        } elseif (!empty($_POST['columns'][2]['search']['value'])) {
            $this->db->where('B1.four_regions', $_POST['columns'][2]['search']['value']);
        }
        // filter sponsorship year from
        if (!empty($_POST['columns'][5]['search']['value'])) {
            $this->db->where('A.year_of_sponsorship>=', $_POST['columns'][5]['search']['value']);
        }
        // filter sponsorship year to
        if (!empty($_POST['columns'][6]['search']['value'])) {
            $this->db->where('A.year_of_sponsorship<=', $_POST['columns'][6]['search']['value']);
        }
        // filter grade
        if (!empty($_POST['columns'][7]['search']['value'])) {
            $this->db->order_by('A.qlc_id', 'desc');
            if ($_POST['columns'][7]['search']['value'] == 'D') {
                $this->db->where(array('D.score>=' => 0, 'D.score<=' => 49));
            }
            if ($_POST['columns'][7]['search']['value'] == 'C') {
                $this->db->where(array('D.score>=' => 50, 'D.score<=' => 59));
            }
            if ($_POST['columns'][7]['search']['value'] == 'B') {
                $this->db->where(array('D.score>=' => 60, 'D.score<=' => 79));
            }
            if ($_POST['columns'][7]['search']['value'] == 'A') {
                $this->db->where(array('D.score>=' => 80, 'D.score<=' => 100));
            }
        }
        // filter sort column
        if (!empty($_POST['columns'][8]['search']['value'])) {
            $this->db->order_by($_POST['columns'][8]['search']['value'], 'asc');
        }

        $qlc = $this->db->group_by('A.qlc_id')->get()->result_array();

        return $qlc;
    }

    public function get_activities($qlc_id)
    {
        return $this->db->get_where('qlc_activity', array('qlc_id' => $qlc_id))->result_array();
    }

    public function get_participants($acti_id)
    {
        return $this->db->get_where('qlc_participate', array('acti_id' => $acti_id, 'delete_datetime' => null))->result_array();
    }

}
