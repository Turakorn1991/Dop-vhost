<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: sanitkeawtawan
 * Date: 6/15/2017 AD
 * Time: 19:31
 */


class Main_Controller extends CI_Controller
{
    public $download = 0;
    public $preview = 1;
    public $save = 2;
    public $open = 3;


    public function __construct()
    {

        parent::__construct();
        $this->load->database();
        $this->load->library('template',
            array('name' => 'report_template',
                'setting' => array('data_output' => ''))
        );
    }

    protected function getParam()
    {
        return $this->input->get();
    }

    protected function generate($view, $data, $mode, $filename, $options = array(),$header=array())
    {
        try {
            $html = $this->load->view($view, $data, TRUE);
            $this->html2pdf->setOption('user-style-sheet', APPPATH . '/../assets/modules/report/css/report.css');

            if($header){
                $this->html2pdf->setOption('header-html',$header['html']);
                $this->html2pdf->setOption('margin-top',$header['top']);
                $this->html2pdf->setOption('margin-bottom',$header['bottom']);

            }
                $this->html2pdf->setHtml($html);
                $this->html2pdf->setPath(APPPATH . '/../assets/modules/report/download/');
                $this->html2pdf->output($mode, $filename, $options);

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    protected function excel($template,$data, $mode, $filename,$options,$start=7)
    {
        try {
                $this->html2excel->setData2Template($template,$data,true,$start);
                $this->html2excel->setPath(APPPATH . '/../assets/modules/report/download/');
                return $this->html2excel->output($mode, $filename, $options);

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    function dataempty(){
        die('ไม่พบข้อมูล');
    }
}