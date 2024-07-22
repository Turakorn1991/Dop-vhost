<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

    public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->helper(array('url','form','general','file','html','asset'));
		$this->load->library(array('session','encrypt'));
		$this->load->model(array('member/admin_model','member/member_model','common_model','useful_model','webconfig/webinfo_model'));
    }
	
	function __deconstruct() {
		$this->db->close();
	}
	
	public function index() {
		$result = $this->common_model->custom_query("SELECT * FROM web_detail WHERE web_id = '1'");
		$data = rowArray($result);
		$data['content_view'] = "web_template1/content/main";
		$this->load->view("web_template1/index_page", $data);
	}
	
	public function about() {
		$result = $this->common_model->custom_query("SELECT * FROM web_detail WHERE web_id = '1'");
		$resultAbout = $this->common_model->custom_query("SELECT * FROM web_about WHERE about_id = '1'");
		$data = rowArray($result);
		$data['about'] = rowArray($resultAbout);
		$data['title'] = $data['web_title'];
		$data['content_view'] = "web_template1/content/about";
		$this->load->view("web_template1/index_page", $data);
	}
	
	public function all_news() {
		$result = $this->common_model->custom_query("SELECT * FROM web_detail WHERE web_id = '1'");
		$data = rowArray($result);
		$resultNews = $this->common_model->custom_query("SELECT 		*
				FROM		web_news
				WHERE		(delete_user_id IS NULL && delete_datetime IS NULL)
				ORDER BY	news_id DESC
		");
		$data['title'] = $data['web_title'];
		$data['news'] = $resultNews;
		$data['content_view'] = "web_template1/content/all_news";
		$this->load->view("web_template1/index_page", $data);
	}
	
	public function employ() {
		$result = $this->common_model->custom_query("SELECT * FROM web_detail WHERE web_id = '1'");
		$data = rowArray($result);
		$data['title'] = $data['web_title'];
		$data['content_view'] = "web_template1/content/employ";
		$this->load->view("web_template1/index_page", $data);
	}
	
	public function news($news_id = "") {
		if ($news_id != "") {
			$result = $this->common_model->custom_query("SELECT * FROM web_detail WHERE web_id = '1'");
			$resultNews = $this->common_model->custom_query("SELECT 		*
				FROM		web_news
				WHERE		news_id = '$news_id' AND (delete_user_id IS NULL && delete_datetime IS NULL)
				ORDER BY	news_id DESC
			");
			$data = rowArray($result);
			$data['news'] = rowArray($resultNews);
			$data['title'] = $data['web_title'];
			$data['content_view'] = "web_template1/content/detail_news";
			$this->load->view("web_template1/index_page", $data);
		}
	}
	
	public function service() {
		$result = $this->common_model->custom_query("SELECT * FROM web_detail WHERE web_id = '1'");
		$data = rowArray($result);
		$data['title'] = $data['web_title'];
		$data['content_view'] = "web_template1/content/service";
		$this->load->view("web_template1/index_page", $data);
	}
	
	public function get_event() {
		$date = $this->input->get('date');
		$resultEvent = $this->common_model->custom_query("
			SELECT	* FROM web_event WHERE event_date_start <= '$date' AND event_date_end >= '$date' AND (delete_user_id IS NULL && delete_datetime IS NULL)
		");
		$data = array();
		foreach ($resultEvent AS $v) {
			if ($v['event_date_start'] == $v['event_date_end']) {
				$day = formatDateThai1($v['event_date_start']);
			} else {
				$day = date("d", strtotime($v['event_date_start']))." - ". formatDateThai1($v['event_date_end']);
			}
			
			$days = array('day1','day3', 'day6');
			$key = array_rand($days, 1);
			$data[] = array(
				'name' => $v['event_name'],
				'day' => $day,
				'place' => $v['event_place'],
				'class' => $days[$key]
			);
		}
		
		echo json_encode(array('data'=>$data));
	}
	
	public function article() {
		$result = $this->common_model->custom_query("SELECT * FROM web_detail WHERE web_id = '1'");
		$resultArticle = $this->common_model->custom_query("
			SELECT
				*
			FROM
				prep_dkm_info
			WHERE
				public_status = 'เผยแพร่'
		");
		$data = rowArray($result);
		$data['title'] = $data['web_title'];
		$data['article'] = $resultArticle;
		$data['content_view'] = "web_template1/content/article";
		$this->load->view("web_template1/index_page", $data);
	}
	
	public function article_detail($id=0) {
		$result = $this->common_model->custom_query("SELECT * FROM web_detail WHERE web_id = '1'");
		$data = rowArray($result);
		$resultArticle = $this->common_model->custom_query("
			SELECT
				*
			FROM
				prep_dkm_info
			WHERE
				public_status = 'เผยแพร่'
			AND dkm_id = '$id'
		");
		if (COUNT($resultArticle) == 1) {
			$resultFile = $this->common_model->custom_query("
				SELECT
					prep_dkm_info_file.dkm_file_id,
					prep_dkm_info_file.dkm_id,
					prep_dkm_info_file.dkm_file,
					prep_dkm_info_file.dkm_file_label,
					prep_dkm_info_file.dkm_file_size
				FROM
					prep_dkm_info_file
				WHERE
					dkm_id = '$id'
			");
			$data['title'] = $data['web_title'];
			$article = rowArray($resultArticle);
			$data['article'] = $article;
			$data['file'] = $resultFile;
			$data['content_view'] = "web_template1/content/article_detail";
			$this->common_model->update("prep_dkm_info",array("stat_views"=>$article['stat_views'] + 1),"dkm_id = '".$article['dkm_id']."'");
		} else {
			$data['content_view'] = "web_template1/content/blank_page";
		}
		$this->load->view("web_template1/index_page", $data);
	}
	
	public function school($page=0) {
		$result = $this->common_model->custom_query("SELECT * FROM web_detail WHERE web_id = '1'");
		$resultGPS = $this->common_model->custom_query("SELECT addr_gps FROM schl_info WHERE addr_gps != ''");
		
		foreach ($resultGPS AS $v) {
			$addr = explode(',',$v['addr_gps']);
			$arrAddress[] = array(
				'lat' => (int)$addr[0],
				'lng' => (int)$addr[1]
			);
		}
		
		$resultName = $this->common_model->custom_query("SELECT schl_name FROM schl_info");
		foreach ($resultName AS $v) {
			$arrName[] = $v['schl_name'];
		}
		
		$this->load->library('pagination');
		$resultSchool = $this->db->query("
			SELECT
				*
			FROM
				schl_info
			LEFT OUTER JOIN schl_info_photo ON schl_info.schl_id = schl_info_photo.schl_id
			LIMIT $page,15
		");
		$resultSchool2 = $this->db->query("
		SELECT
			*
		FROM
			schl_info
		LEFT OUTER JOIN schl_info_photo ON schl_info.schl_id = schl_info_photo.schl_id
		");
		$page = $resultSchool2->num_rows()/15;
		$data = rowArray($result);
		$data['page'] = $page;
		$data['page_active'] = $this->uri->segment(3)/15;
		$data['title'] = $data['web_title'];
		$data['gps'] = json_encode($arrAddress);
		$data['name'] = json_encode($arrName);
		//dieArray($data['name']);
		$data['school'] = $resultSchool->result_array();
		$data['content_view'] = "web_template1/content/school";
		$this->load->view("web_template1/index_page", $data);
	}
	
	public function get_school() {
		$id = $this->input->get('id');
		$resultSchool = $this->common_model->custom_query("
			SELECT
				*
			FROM
				schl_info
			WHERE
				schl_id = '$id'
		");
		echo json_encode(array('data'=>rowArray($resultSchool)));
	}


	
}