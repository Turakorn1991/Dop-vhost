<?php defined('BASEPATH') OR exit('No direct script access allowed');
	class Webinfo_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	public function newsList() {
		return $this->common_model->custom_query("
				SELECT 		*
				FROM		web_news
				WHERE		(delete_user_id IS NULL && delete_datetime IS NULL)
				ORDER BY	news_id DESC
			");
	}

	public function aboutList() {
		return $this->common_model->custom_query("
				SELECT 		*
				FROM		web_about
				WHERE		(delete_user_id IS NULL && delete_datetime IS NULL)
				ORDER BY	about_id ASC
			");
	}

    public function getSiteInfo(){
        return rowArray($this->common_model->custom_query("select
            A.*,B.user_prename,B.user_firstname,B.user_lastname
            from site_setting as A
            left join usrm_user as B on A.update_user_id=B.user_id
          	"));
    }

    public function LogSave($app_id=0,$process_action="",$log_action="",$log_status='') {
        return $this->common_model->insert('usrm_log',
            array('app_id'=>$app_id,
                'process_action'=>$process_action,
                'log_action'=>$log_action,
                'user_id'=>get_session('user_id'),
                'org_id'=>get_session('org_id'),
                'log_datetime'=>getDatetime(),
                'log_status'=>$log_status
                )
            );
    }

	public function getDataNews($news_id=0) {
		return rowArray($this->common_model->custom_query("
			SELECT		*
			FROM		web_news
			WHERE		news_id = '$news_id' AND (delete_user_id IS NULL && delete_datetime IS NULL)
		"));
	}

	public function getDataAbout($about_id=0) {
		return rowArray($this->common_model->custom_query("
			SELECT		*
			FROM		web_about
			WHERE		about_id = '$about_id' AND (delete_user_id IS NULL && delete_datetime IS NULL)
		"));
	}

	public function getDataWebDetail(){
		return rowArray($this->common_model->custom_query("
			SELECT		*
			FROM		web_detail
			WHERE		web_id = '1'
		"));
	}

	public function getDataSlide() {
		return $this->common_model->custom_query("
			SELECT		*
			FROM		web_slide
			WHERE		(delete_user_id IS NULL && dalete_datetime IS NULL)
		");
	}

	public function getDataSlideRow($slide_id = 0) {
		return rowArray($this->common_model->custom_query("
			SELECT		*
			FROM		web_slide
			WHERE		slide_id = '$slide_id' AND (delete_user_id IS NULL && dalete_datetime IS NULL)
		"));
	}

	public function getDataArticle() {
		return $this->common_model->custom_query("
			SELECT		*
			FROM		web_article
			WHERE		(delete_user_id IS NULL && delete_datetime IS NULL)
		");
	}

	public function getDataArticleRow($article_id = 0) {
		return rowArray($this->common_model->custom_query("
			SELECT		*
			FROM		web_article
			WHERE		article_id = '$article_id' AND (delete_user_id IS NULL && delete_datetime IS NULL)
		"));
	}

	public function getDataEvent() {
		return $this->common_model->custom_query("
			SELECT		*
			FROM		web_event
			WHERE		(delete_user_id IS NULL && delete_datetime IS NULL)
		");
	}

	public function getDataEventRow($event_id = 0) {
		return rowArray($this->common_model->custom_query("
			SELECT		*
			FROM		web_event
			WHERE		event_id = '$event_id' AND (delete_user_id IS NULL && delete_datetime IS NULL)
		"));
	}

}
?>
