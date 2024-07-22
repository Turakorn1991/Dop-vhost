<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Survey extends MX_Controller {

	private $user_id;
	private $app_id;
	private $process_action;
	private $usrpm;

	function __construct() {
		parent::__construct();

		$exceptAuth = ['government','private', 'to'];
		$method_name = $this->uri->segment(2);
		
		if(!in_array($method_name, $exceptAuth)){

			chkUserLogin();

			$this->user_id = get_session('user_id');
			$this->app_id = 151; //Fix for dev.
			

			if($method_name == 'index' || $method_name == ''){
				$this->process_action = 'View';

			}else if($method_name == 'create'){
				$this->process_action = 'Add';

			}else if( $method_name == 'store' && empty($this->input->post('job_sur_id')) ){
				$this->process_action = 'Added';

			}else if($method_name == 'edit'){
				$this->process_action = 'Edit';

			}else if($method_name == 'store' && !empty($this->input->post('job_sur_id')) ){
				$this->process_action = 'Edited';
			}

			$this->webinfo_model->LogSave($this->app_id,$this->process_action,'Sign In','Success'); //Save Sign In Log
			$this->usrpm = $this->admin_model->chkOnce_usrmPermiss($this->app_id,$this->user_id); //Check User Permission

			//Check permission
			if(!isset($this->usrpm['app_id']) || $this->usrpm['perm_status']=='No'){
				$this->webinfo_model->LogSave($this->app_id,$this->process_action,'Sign Out','Fail'); //Save Sign In Log
				page500();
				die;
			}

		}
	}

	function __deconstruct() {
		
		$this->webinfo_model->LogSave($this->app_id,$this->process_action,'Sign Out','Success'); //Save Sign Out Log

		$this->db->close();
	}

	public function index(){
		// // echo 'for list or index';
		$data = array();//Set Initial Variable to Views

		$app_name = $this->usrpm['app_name'];
		$data['usrpm'] = $this->usrpm;
		$data['user_id'] = $this->user_id;
		

		$this->load->library('template',
			array('name'=>'admin_template1',
				  'setting'=>array('data_output'=>''))
		); // Set Template

		$data['process_action'] = $this->process_action;
		$data['content_view'] = 'index';

		$tmp = $this->admin_model->getOnce_Application($this->usrpm['app_parent_id']); //Used for find root application
		$data['head_title'] = $tmp['app_name'];
		$data['title'] = $this->usrpm['app_name'];

		$Survey_model = new Survey_model();
		$data['surveys'] = $Survey_model->get_all_desc();

		$this->template->load('index_page',$data,'survey');
	}

	public function to_slug($id, $slug){
		
		$result = $this->common_model->custom_query("SELECT * FROM web_detail WHERE web_id = '1'");
		$data = rowArray($result);

		$Survey_model = new Survey_model();
		$data['survey'] = $Survey_model->get_id($id);

		$data['title'] = $data['web_title'];

		// $data['content_view'] = APPPATH.'modules/survey/views/front-end/government';
		$data['content_view'] = '../modules/survey/views/front-end/show';
		$this->load->view("web_template1/index_page", $data);
	}

	public function government_survey(){
		// echo 'government';
		//Get detail website
		$result = $this->common_model->custom_query("SELECT * FROM web_detail WHERE web_id = '1'");
		$data = rowArray($result);

		$Survey_model = new Survey_model();
		$data['survey'] = $Survey_model->get_latest();

		$data['title'] = $data['web_title'];

		// $data['content_view'] = APPPATH.'modules/survey/views/front-end/show';
		$data['content_view'] = '../modules/survey/views/front-end/show';
		$this->load->view("web_template1/index_page", $data);

	}

	public function private_survey(){
		echo 'private';
	}	

	public function create(){
		// // echo 'for show form create';
		$data = array();

		$data['survey'] = new Survey_model();

		$app_name = $this->usrpm['app_name'];
		$data['usrpm'] = $this->usrpm;
		$data['user_id'] = $this->user_id;
		

		$this->load->library('template',
			array('name'=>'admin_template1',
				  'setting'=>array('data_output'=>''))
		); // Set Template

		set_css_asset_head('../plugins/Static_Full_Version/css/plugins/switchery/switchery.css');
		set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/switchery/switchery.js');

		set_js_asset_footer('form.js','survey'); //Set JS Index.js

		$data['process_action'] = $this->process_action;
		$data['content_view'] = 'form';

		$tmp = $this->admin_model->getOnce_Application($this->usrpm['app_parent_id']); //Used for find root application
		$data['head_title'] = $tmp['app_name'];
		$data['title'] = $this->usrpm['app_name'];

		$data['csrf'] = array(
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash()
		);

		$this->template->load('index_page',$data,'survey');

		$this->webinfo_model->LogSave($this->app_id,$this->process_action,'Sign Out','Success'); //Save Sign Out Log

	}

	public function edit($id){
		// echo 'for show form edit';
		$data = array();

		$Survey_model = new Survey_model();
		$data['survey'] = $Survey_model->get_id($id);

		$app_name = $this->usrpm['app_name'];
		$data['usrpm'] = $this->usrpm;
		$data['user_id'] = $this->user_id;
		

		$this->load->library('template',
			array('name'=>'admin_template1',
				  'setting'=>array('data_output'=>''))
		); // Set Template

		set_css_asset_head('../plugins/Static_Full_Version/css/plugins/switchery/switchery.css');
		set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/switchery/switchery.js');

		set_js_asset_footer('form.js','survey'); //Set JS Index.js

		$data['process_action'] = $this->process_action;
		$data['content_view'] = 'form';

		$tmp = $this->admin_model->getOnce_Application($this->usrpm['app_parent_id']); //Used for find root application
		$data['head_title'] = $tmp['app_name'];
		$data['title'] = $this->usrpm['app_name'];

		$data['csrf'] = array(
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash()
		);

		$this->template->load('index_page',$data,'survey');

		$this->webinfo_model->LogSave($this->app_id,$this->process_action,'Sign Out','Success'); //Save Sign Out Log
		
	}

	public function store(){
		// echo 'for save date to DB';

		$Survey_model = new Survey_model();

		if(empty($this->input->post('job_sur_id'))){ //Case Insert
			$Survey_model->job_sur_insert_datetime = getDatetime();
			$Survey_model->job_sur_insert_user_id = getUser();
			$Survey_model->job_sur_insert_org_id = get_session('org_id');
		}

		$Survey_model->job_sur_id = $this->input->post('job_sur_id');
		$Survey_model->job_sur_title = $this->input->post('job_sur_title');
		$Survey_model->job_sur_url = $this->input->post('job_sur_url');
		$Survey_model->job_sur_slug = $this->make_slug($this->input->post('job_sur_slug'), 80);
		$Survey_model->job_sur_status = ( !empty($this->input->post('job_sur_status')) ? 'Active' : 'Inactive' );
		$Survey_model->job_sur_update_user_id = getUser();
		$Survey_model->job_sur_update_org_id = get_session('org_id');
		$Survey_model->job_sur_update_datetime = getDatetime();
		$Survey_model->save();

		// print_r($Survey_model);
		redirect('survey','refresh');
	}

	public function no_diacritics($string) { //cyrylic transcription 
		$cyrylicFrom = array('А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я'); $cyrylicTo = array('A', 'B', 'W', 'G', 'D', 'Ie', 'Io', 'Z', 'Z', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'Ch', 'C', 'Tch', 'Sh', 'Shtch', '', 'Y', '', 'E', 'Iu', 'Ia', 'a', 'b', 'w', 'g', 'd', 'ie', 'io', 'z', 'z', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'ch', 'c', 'tch', 'sh', 'shtch', '', 'y', '', 'e', 'iu', 'ia');

		$from = array("Á", "À", "Â", "Ä", "Ă", "Ā", "Ã", "Å", "Ą", "Æ", "Ć", "Ċ", "Ĉ", "Č", "Ç", "Ď", "Đ", "Ð", "É", "È", "Ė", "Ê", "Ë", "Ě", "Ē", "Ę", "Ə", "Ġ", "Ĝ", "Ğ", "Ģ", "á", "à", "â", "ä", "ă", "ā", "ã", "å", "ą", "æ", "ć", "ċ", "ĉ", "č", "ç", "ď", "đ", "ð", "é", "è", "ė", "ê", "ë", "ě", "ē", "ę", "ə", "ġ", "ĝ", "ğ", "ģ", "Ĥ", "Ħ", "I", "Í", "Ì", "İ", "Î", "Ï", "Ī", "Į", "Ĳ", "Ĵ", "Ķ", "Ļ", "Ł", "Ń", "Ň", "Ñ", "Ņ", "Ó", "Ò", "Ô", "Ö", "Õ", "Ő", "Ø", "Ơ", "Œ", "ĥ", "ħ", "ı", "í", "ì", "i", "î", "ï", "ī", "į", "ĳ", "ĵ", "ķ", "ļ", "ł", "ń", "ň", "ñ", "ņ", "ó", "ò", "ô", "ö", "õ", "ő", "ø", "ơ", "œ", "Ŕ", "Ř", "Ś", "Ŝ", "Š", "Ş", "Ť", "Ţ", "Þ", "Ú", "Ù", "Û", "Ü", "Ŭ", "Ū", "Ů", "Ų", "Ű", "Ư", "Ŵ", "Ý", "Ŷ", "Ÿ", "Ź", "Ż", "Ž", "ŕ", "ř", "ś", "ŝ", "š", "ş", "ß", "ť", "ţ", "þ", "ú", "ù", "û", "ü", "ŭ", "ū", "ů", "ų", "ű", "ư", "ŵ", "ý", "ŷ", "ÿ", "ź", "ż", "ž");
		$to   = array("A", "A", "A", "A", "A", "A", "A", "A", "A", "AE", "C", "C", "C", "C", "C", "D", "D", "D", "E", "E", "E", "E", "E", "E", "E", "E", "G", "G", "G", "G", "G", "a", "a", "a", "a", "a", "a", "a", "a", "a", "ae", "c", "c", "c", "c", "c", "d", "d", "d", "e", "e", "e", "e", "e", "e", "e", "e", "g", "g", "g", "g", "g", "H", "H", "I", "I", "I", "I", "I", "I", "I", "I", "IJ", "J", "K", "L", "L", "N", "N", "N", "N", "O", "O", "O", "O", "O", "O", "O", "O", "CE", "h", "h", "i", "i", "i", "i", "i", "i", "i", "i", "ij", "j", "k", "l", "l", "n", "n", "n", "n", "o", "o", "o", "o", "o", "o", "o", "o", "o", "R", "R", "S", "S", "S", "S", "T", "T", "T", "U", "U", "U", "U", "U", "U", "U", "U", "U", "U", "W", "Y", "Y", "Y", "Z", "Z", "Z", "r", "r", "s", "s", "s", "s", "B", "t", "t", "b", "u", "u", "u", "u", "u", "u", "u", "u", "u", "u", "w", "y", "y", "y", "z", "z", "z");


		$from = array_merge($from, $cyrylicFrom);
		$to   = array_merge($to, $cyrylicTo);

		$newstring=str_replace($from, $to, $string);   
		return $newstring;
	}

	public function remove_duplicates($sSearch, $sReplace, $sSubject) { 
	  $i=0; 

	  do{

	     $sSubject=str_replace($sSearch, $sReplace, $sSubject);         
	     $pos=strpos($sSubject, $sSearch);

	     $i++;
	     if($i>100)
	     {
	        die('remove_duplicates() loop error');
	     }

	  }while($pos!==false);

	  return $sSubject;
	}

	public function make_slug($string, $maxlen=0)
    {
        $newStringTab=array(); 
        $string=strtolower($this->no_diacritics($string)); if(function_exists('str_split')) { $stringTab=str_split($string); } else { $stringTab=my_str_split($string); }

		$numbers=array("0","1","2","3","4","5","6","7","8","9","-");
		//$numbers=array("0","1","2","3","4","5","6","7","8","9");

		foreach($stringTab as $letter)
		{
		 if(in_array($letter, range("a", "z")) || in_array($letter, $numbers))
		 {
		    $newStringTab[]=$letter;
		    //print($letter);
		 }
		 elseif($letter==" ")
		 {
		    $newStringTab[]="-";
		 }
		 elseif(preg_match("/^[ก-๙เแ]+$/", $letter ) ){ 
		 	$newStringTab[]=$letter;
		 }
		}

		if(count($newStringTab))
		{
		 $newString=implode($newStringTab);
		 if($maxlen>0)
		 {
		    $newString=substr($newString, 0, $maxlen);
		 }

		 $newString = $this->remove_duplicates('--', '-', $newString);
		}
		else
		{
		 $newString='';
		}      

		return $newString;
	
    }
}
?>