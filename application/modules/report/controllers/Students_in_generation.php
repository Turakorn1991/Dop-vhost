<?php

include_once "Main.php";
class Students_in_generation extends Main_Controller
{

    public function __construct()
    {
        parent::__construct();
        $param = $this->getParam();
    }

    public function xls($gen_id)
    {
        $this->load->model('../../modules/school/models/school_model');
        foreach ($this->school_model->get_studentsInGeneration($gen_id) as $i => $student) {
            $rows[] = array(
                ($i + 1) . ".",
                $student['pid'],
                '',
                $student['gender'] ? $student['gender'] : '-',
                $student['stud_firstname_th'],
                $student['stud_lastname_th'],
                $student['stud_age'],
            );
        }
        $data = array(
            'title' => "รายชื่อนักเรียน - รหัสรุ่น: $gen_id",
            'res' => array('rows' => $rows),
        );
        $this->excel(APPPATH . '/../assets/modules/report/static/student_list.xlsx', $data, 'D', 'Student List', array(), 2);
    }

    public function form_studentList()
    {
        $this->load->helper('download');
        $path = file_get_contents(APPPATH . '/../assets/modules/report/static/student_list.xlsx');
        $name = "Student List Form.xlsx";
        force_download($name, $path);
    }

}
