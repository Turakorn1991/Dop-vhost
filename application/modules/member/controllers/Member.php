<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends MX_Controller {

	function __construct() {
		parent::__construct();

		$this->load->library('template',
			array('name'=>'admin_template1',
				  'setting'=>array('data_output'=>''))
		);
	}
	function __deconstruct() {
		$this->db->close();
	}

	public function edit_profile($process_action='edit',$user_id=0){

		
	
      $data = array(); //Set Initial Variable to Views
      	$user_id = get_session('user_id');
		$app_id = 71;
		$process_path = 'member/edit_profile';

		$this->load->library('template',
				array('name'=>'admin_template1',
					  'setting'=>array('data_output'=>''))
			); // Set Template

		
           $data['usrpm'] = 70;
			$data['user_id'] = 1;
			
			$data['head_title'] = 'บัญชีผู้ใช้งาน';
			$data['title'] = 'แก้ไขบัญชีผู้ใช้งาน';

			set_css_asset_head('../modules/member/css/gallery_img.css');
		
		    $data['content_view'] = 'edit_profile';
		    $data['ficon'] = 'fa fa-user';
	
			if($process_action=='edit' && get_inpost('bt_submit')=='') {

			 $data['prename'] = $this->common_model->custom_query("SELECT * FROM std_prename");

			 $data['usrm_user'] = $this->member_model->getedit_user($user_id);
             $this->template->load('index_page',$data,'member');
            }else{
               $data_update = array();
               $data_update = get_inpost_arr("usrm_user");
               
               $data_update['update_user_id']  = getUser();
               $data_update['update_org_id']   = get_session('org_id');
               $data_update['update_datetime'] = getDatetime();


               if($_FILES['img']['name']!=''){
               	$namephoto = $this->files_model->getOnceImg("img",'assets/modules/member/images');
                
                $data_update['user_photo_file'] = 'assets/modules/member/images/'.$namephoto;
                $data_update['user_photo_label'] = $_FILES['img']['name'];
                $data_update['user_photo_size'] = $_FILES['img']['size'];
               }

               $this->common_model->update('usrm_user',$data_update,array('user_id'=>getUser()));
              
               redirect('control/main_module','refresh');
            }
	}	

/*	public function member_manage($mode='',$M_ID=''){
		$GP_Value = 7;
		$this->admin_model->get_permiss_iniz($GM_ID,$GP_Value,$P_Process,$data);

		$data['mode'] = $mode;

		$data['content_view'] = 'member';
		$data['P_Name']	= uns($data['Permission']['P_Name']);
		$data['title'] = $data['P_Name']['TH'];

		if($mode==''){
			$data['members'] = $this->member_model->getAll_members();
		}else if($mode=='add'){
			if(get_inpost('bt_submit') == ''){
				$data['member'] = array(
					'M_ID' => $M_ID,
					'M_Img' => '',
					'M_Username' => '',
					'M_Password' => '',
					'M_Password_conf' => '',
					'M_TName' => '1',
					'M_ThName' => '',
					'M_EnName' => '',
					'M_Sex' => 'M',
					'M_Birthdate' => '',
					'M_npID' => '',
					'M_Tel' => '',
					'M_Email' => '',
					'M_Address' => '',
					'M_Position' => '',
					'M_UnitName' => '',
					'GM_ID' => '0',
					'M_Allow' => '1',
				);
			}else{

				$this->load->library('form_validation');
				$frm=$this->form_validation;

				$frm->set_rules('M_ID','ID','trim');
				$frm->set_rules('M_Img','รูปประจำตัว','trim');
				$frm->set_rules('M_Username','Username','required|callback_username_valid|min_length[3]|max_length[15]',
					array(
                    'required' => '%s ต้องไม่ซ้ำกันในระบบ ไม่เป็นภาษาไทยหรืออักขระพิเศษ และต้องมีความยาว 3-15 ตัว',
                	));
				$frm->set_rules('M_Password','Password','required|callback_password_valid',array(
                    'required' => '%s ต้องไม่ซ้ำกันในระบบ ไม่เป็นภาษาไทยหรืออักขระพิเศษ และต้องมีความยาว 3 ตัวขึ้นไป',
                	));
				$frm->set_rules('M_Password_conf','Password Confirmation','required|callback_password_valid|matches[M_Password]',array(
                    'required' => '%s ต้องไม่ซ้ำกันในระบบ ไม่เป็นภาษาไทยหรืออักขระพิเศษ และต้องมีความยาว 3 ตัวขึ้นไป',
                	));
				$frm->set_rules('M_TName','คำนำหน้าชื่อ','required');
				$frm->set_rules('M_ThName','ชื่อไทย','required');
				$frm->set_rules('M_EnName','ชื่ออังกฤษ','required');
				$frm->set_rules('M_Sex','เพศ','required');
				$frm->set_rules('M_Birthdate','วัน/เดือน/ปีเกิด','required|callback_date_valid');
				$frm->set_rules('M_npID','หมายเลขบัตรประชาชน','required|callback_npID_valid');
				$frm->set_rules('M_Tel','เบอร์โทรศัพท์','trim');
				$frm->set_rules('M_Email','อีเมล','required|valid_email');
				$frm->set_rules('M_Address','ที่อยู่','trim');
				$frm->set_rules('M_Position','ตำแหน่งในการบริหารงาน','trim');
				$frm->set_rules('M_UnitName','หน่วยงาน','trim');
				$frm->set_rules('GM_ID','กลุ่มผู้ใช้งาน','required');
				$frm->set_rules('M_Allow','สถานะ','required');

				$frm->set_message("required","กรุณากรอกข้อมูล %s");
				$frm->set_message("numeric","%s กรุณากรอกข้อมูลเป็นตัวเลข");
				$frm->set_message("date_valid","%s นี้ไม่ถูกต้อง");
				$frm->set_message("valid_email","รูปแบบอีเมล์ต้องถูกต้อง");
				$frm->set_message("npID_valid","หมายเลขบัตรประชาชนนี้มีอยู่แล้ว");
				$frm->set_message("matches","รหัสผ่านต้องเหมือนกัน");

				if($frm->run($this)){

					$data_insert = array(
						'M_Username'=>get_inpost('M_Username'),
						'M_Password'=>$this->encrypt->encode(get_inpost('M_Password')),
						'M_TName'=>get_inpost('M_TName'),
						'M_ThName'=>get_inpost('M_ThName'),
						'M_EnName'=>get_inpost('M_EnName'),
						'M_Sex'=>get_inpost('M_Sex'),
						'M_Birthdate'=>@dateChange(get_inpost('M_Birthdate'),2),
						'M_npID'=>get_inpost('M_npID'),
						'M_Tel'=>get_inpost('M_Tel'),
						'M_Email'=>get_inpost('M_Email'),
						'M_Address'=>get_inpost('M_Address'),
						'M_Position'=>get_inpost('M_Position'),
						'M_UnitName'=>get_inpost('M_UnitName'),
						'GM_ID'=>get_inpost('GM_ID'),
						'M_UserAdd'=>getUser(),
						'M_DateTimeAdd'=>getDatetime(),
						'M_UserUpdate'=>getUser(),
						'M_DateTimeUpdate'=>getDatetime(),
						'M_Type'=>'1',
						'M_Allow'=>get_inpost('M_Allow')
					);

					$M_Img = $this->files_model->getOnceImg('M_Img',"./assets/modules/member/images/");
					if($M_Img == ''){
						$M_Img = rowArray2(json_decode($this->input->post('M_Img',true)));
					}

					if(!$M_Img == ''){
						$data_insert['M_Img']=$M_Img;
					}

					$this->common_model->insert('member',$data_insert);

					echo "<script>alert('เพิ่มข้อมูลเสร็จสิ้น');</script>";
					redirect('member/member_manage','refresh');
				}else{
					$data['member'] = array(
						'M_ID' => $M_ID,
						'M_Img' => '',
						'M_Username' => trim(set_value('M_Username')),
						'M_Password' => trim(set_value('M_Password')),
						'M_Password_conf' => '',
						'M_TName' => trim(set_value('M_TName')),
						'M_ThName' => trim(set_value('M_ThName')),
						'M_EnName' => trim(set_value('M_EnName')),
						'M_Sex' => trim(set_value('M_Sex')),
						'M_Birthdate' => trim(set_value('M_Birthdate')),
						'M_npID' => trim(set_value('M_npID')),
						'M_Tel' => trim(set_value('M_Tel')),
						'M_Email' => trim(set_value('M_Email')),
						'M_Address' => trim(set_value('M_Address')),
						'M_Position' => trim(set_value('M_Position')),
						'M_UnitName' => trim(set_value('M_UnitName')),
						'GM_ID' => trim(set_value('GM_ID')),
						'M_Allow' => trim(set_value('M_Allow')),
					);

				}
			}
		}else if($mode=='edit'){
			$data['member'] = $this->member_model->getOnce_members($M_ID);
			$data['member']['M_Password_conf'] = '';
			$data['member']['M_Birthdate'] = @dateChange($data['member']['M_Birthdate'],3);
			
			if(get_inpost('bt_submit') == ''){
				if(!isset($data['member']['M_ID'])){
					$this->admin_model->cannot_access();
				}
			}else{
				$this->load->library('form_validation');
				$frm=$this->form_validation;

				$frm->set_rules('M_ID','ID','trim');
				$frm->set_rules('M_Img','รูปประจำตัว','trim');
				$frm->set_rules('M_Username','Username','trim');
				$frm->set_rules('M_Password','Password','required|callback_password_valid',array(
                    'required' => '%s ต้องไม่ซ้ำกันในระบบ ไม่เป็นภาษาไทยหรืออักขระพิเศษ และต้องมีความยาว 3 ตัวขึ้นไป',
                	));
				$frm->set_rules('M_Password_conf','Password Confirmation','required|callback_password_valid|matches[M_Password]',array(
                    'required' => '%s ต้องไม่ซ้ำกันในระบบ ไม่เป็นภาษาไทยหรืออักขระพิเศษ และต้องมีความยาว 3 ตัวขึ้นไป',
                	));
				$frm->set_rules('M_TName','คำนำหน้าชื่อ','required');
				$frm->set_rules('M_ThName','ชื่อไทย','required');
				$frm->set_rules('M_EnName','ชื่ออังกฤษ','required');
				$frm->set_rules('M_Sex','เพศ','required');
				$frm->set_rules('M_Birthdate','วัน/เดือน/ปีเกิด','required|callback_date_valid');
				$frm->set_rules('M_npID','หมายเลขบัตรประชาชน','required|callback_npID_valid');
				$frm->set_rules('M_Tel','เบอร์โทรศัพท์','trim');
				$frm->set_rules('M_Email','อีเมล','required|valid_email');
				$frm->set_rules('M_Address','ที่อยู่','trim');
				$frm->set_rules('M_Position','ตำแหน่งในการบริหารงาน','trim');
				$frm->set_rules('M_UnitName','หน่วยงาน','trim');
				$frm->set_rules('GM_ID','กลุ่มผู้ใช้งาน','required');
				$frm->set_rules('M_Allow','สถานะ','required');

				$frm->set_message("required","กรุณากรอกข้อมูล %s");
				$frm->set_message("numeric","%s กรุณากรอกข้อมูลเป็นตัวเลข");
				$frm->set_message("date_valid","%s นี้ไม่ถูกต้อง");
				$frm->set_message("valid_email","รูปแบบอีเมล์ต้องถูกต้อง");
				$frm->set_message("npID_valid","หมายเลขบัตรประชาชนนี้มีอยู่แล้ว");
				$frm->set_message("matches","รหัสผ่านต้องเหมือนกัน");

				if($frm->run($this)){
					$data_update = array(
						'M_Password'=>$this->encrypt->encode(get_inpost('M_Password')),
						'M_TName'=>get_inpost('M_TName'),
						'M_ThName'=>get_inpost('M_ThName'),
						'M_EnName'=>get_inpost('M_EnName'),
						'M_Sex'=>get_inpost('M_Sex'),
						'M_Birthdate'=>@dateChange(get_inpost('M_Birthdate'),2),
						'M_npID'=>get_inpost('M_npID'),
						'M_Tel'=>get_inpost('M_Tel'),
						'M_Email'=>get_inpost('M_Email'),
						'M_Address'=>get_inpost('M_Address'),
						'M_Position'=>get_inpost('M_Position'),
						'M_UnitName'=>get_inpost('M_UnitName'),
						'GM_ID'=>get_inpost('GM_ID'),
						'M_UserUpdate'=>getUser(),
						'M_DateTimeUpdate'=>getDatetime(),
						'M_Type'=>'1',
						'M_Allow'=>get_inpost('M_Allow')
					);


					$M_Img = $this->files_model->getOnceImg('M_Img',"./assets/modules/member/images/");
					if($M_Img == ''){
						$M_Img = rowArray2(json_decode($this->input->post('M_Img',true)));
					}
					if(!$M_Img == ''){
						$data_update['M_Img']=$M_Img;
					}

					$this->common_model->update('member',$data_update,array('M_ID'=>uri_seg(4)));

					echo "<script>alert('แก้ไขข้อมูลเสร็จสิ้น');</script>";
					redirect('member/member_manage','refresh');
				}else{
					$data['member']['M_ID'] = $M_ID;
					$data['member']['M_Password_conf'] = '';
					$data['member']['M_TName'] = trim(set_value('M_TName'));
					$data['member']['M_ThName'] = trim(set_value('M_ThName'));
					$data['member']['M_EnName'] = trim(set_value('M_EnName'));
					$data['member']['M_Sex'] = trim(set_value('M_Sex'));
					$data['member']['M_Birthdate'] = trim(set_value('M_Birthdate'));
					$data['member']['M_npID'] = trim(set_value('M_npID'));
					$data['member']['M_Tel'] = trim(set_value('M_Tel'));
					$data['member']['M_Email'] = trim(set_value('M_Email'));
					$data['member']['M_Address'] = trim(set_value('M_Address'));
					$data['member']['M_Position'] = trim(set_value('M_Position'));
					$data['member']['M_UnitName'] = trim(set_value('M_UnitName'));
					$data['member']['GM_ID'] = trim(set_value('GM_ID'));
					$data['member']['M_Allow'] = trim(set_value('M_Allow'));
				}
			}

		}else if($mode=='del'){
			$this->common_model->update('member',
				array('M_Allow'=>'3','M_UserUpdate'=>getUser(),'M_DateTimeUpdate'=>getDatetime()),
				array('M_ID'=>uri_seg(4))
			);
			echo "<script>alert('ลบข้อมูลเสร็จสิ้น');</script>";
			redirect('member/member_manage','refresh');
		}
		
		$this->template->load('index_page',$data,'member');
	}

	public function password_valid($data){
		if(preg_match('/[a-z0-9]{3,}/',$data)) return true;
		else return false;
	}
	public function username_valid($username){
		$temp = $this->member_model->getUsername_with_MID($username);
		if(!isset($temp['M_ID']) && preg_match('/^[a-z][a-z0-9]{2,}/',$username))return true;
		else return false;
	}
	public function npID_valid($npID){
		$temp = $this->member_model->getUsername_with_npID($npID);
		if(!isset($temp['M_ID']))return true;
		else if($temp['M_ID'] == uri_seg(4) || $temp['M_ID'] == uri_seg(3))return true;
		else return false;
	}
	public function date_valid($date){
	    $arr=explode('/',$date);
	    if(count($arr)>2)
	    	return @checkdate($arr[1], $arr[0],$arr[2]);
	    else
	    	return false;
	}	

	public function edit_profile($M_ID = ''){
		if($M_ID == ''){
			header('Location: '.base_url('member/edit_profile/'.get_session('M_ID')));
			dieFont(' อิอิแอิ');
		}

		$GP_Value = 7;
		$this->admin_model->get_permiss_iniz($GM_ID,$GP_Value,$P_Process,$data);

		$data['mode'] = 'edit';

		$data['content_view'] = 'member';
		$data['P_Name']	= uns($data['Permission']['P_Name']);
		$data['title'] = $data['P_Name']['TH'];

		$data['member'] = $this->member_model->getOnce_members($M_ID);
		$data['member']['M_Password_conf'] = '';
		$data['member']['M_Birthdate'] = @dateChange($data['member']['M_Birthdate'],3);
		$data['member']['M_Password_conf'] = '';
		$data['member']['GM_ID'] = $data['member']['GM_ID'];
		$data['member']['M_Allow'] = $data['member']['M_Allow'];
			
		if(get_inpost('bt_submit') == ''){
			if(!isset($data['member']['M_ID']) || uri_seg(3)!=get_session('M_ID')){
				$this->admin_model->cannot_access();
			}
		}else{
			$this->load->library('form_validation');
			$frm=$this->form_validation;

			$frm->set_rules('M_ID','ID','trim');
			$frm->set_rules('M_Img','รูปประจำตัว','trim');
			$frm->set_rules('M_Username','Username','trim');
			$frm->set_rules('M_Password','Password','required|callback_password_valid',array(
                   'required' => '%s ต้องไม่ซ้ำกันในระบบ ไม่เป็นภาษาไทยหรืออักขระพิเศษ และต้องมีความยาว 3 ตัวขึ้นไป',
                ));
			$frm->set_rules('M_Password_conf','Password Confirmation','required|callback_password_valid|matches[M_Password]',array(
                   'required' => '%s ต้องไม่ซ้ำกันในระบบ ไม่เป็นภาษาไทยหรืออักขระพิเศษ และต้องมีความยาว 3 ตัวขึ้นไป',
                ));
			$frm->set_rules('M_TName','คำนำหน้าชื่อ','required');
			$frm->set_rules('M_ThName','ชื่อไทย','required');
			$frm->set_rules('M_EnName','ชื่ออังกฤษ','required');
			$frm->set_rules('M_Sex','เพศ','required');
			$frm->set_rules('M_Birthdate','วัน/เดือน/ปีเกิด','required|callback_date_valid');
			$frm->set_rules('M_npID','หมายเลขบัตรประชาชน','required|callback_npID_valid');
			$frm->set_rules('M_Tel','เบอร์โทรศัพท์','trim');
			$frm->set_rules('M_Email','อีเมล','required|valid_email');
			$frm->set_rules('M_Address','ที่อยู่','trim');
			$frm->set_rules('M_Position','ตำแหน่งในการบริหารงาน','trim');
			$frm->set_rules('M_UnitName','หน่วยงาน','trim');
			$frm->set_rules('GM_ID','กลุ่มผู้ใช้งาน','trim');
			$frm->set_rules('M_Allow','สถานะ','trim');

			$frm->set_message("required","กรุณากรอกข้อมูล %s");
			$frm->set_message("numeric","%s กรุณากรอกข้อมูลเป็นตัวเลข");
			$frm->set_message("date_valid","%s นี้ไม่ถูกต้อง");
			$frm->set_message("valid_email","รูปแบบอีเมล์ต้องถูกต้อง");
			$frm->set_message("npID_valid","หมายเลขบัตรประชาชนนี้มีอยู่แล้ว");
			$frm->set_message("matches","รหัสผ่านต้องเหมือนกัน");

			if($frm->run($this)){
				// $M_Img = $this->files_model->getOnceImg('M_Img',"./assets/modules/member/images/");

				$data_update = array(
					'M_Password'=>$this->encrypt->encode(get_inpost('M_Password')),
					'M_TName'=>get_inpost('M_TName'),
					'M_ThName'=>get_inpost('M_ThName'),
					'M_EnName'=>get_inpost('M_EnName'),
					'M_Sex'=>get_inpost('M_Sex'),
					'M_Birthdate'=>@dateChange(get_inpost('M_Birthdate'),2),
					'M_npID'=>get_inpost('M_npID'),
					'M_Tel'=>get_inpost('M_Tel'),
					'M_Email'=>get_inpost('M_Email'),
					'M_Address'=>get_inpost('M_Address'),
					'M_Position'=>get_inpost('M_Position'),
					'M_UnitName'=>get_inpost('M_UnitName'),
					'M_UserUpdate'=>getUser(),
					'M_DateTimeUpdate'=>getDatetime(),
				);
				
				$M_Img = $this->files_model->getOnceImg('M_Img',"./assets/modules/member/images/");
					if($M_Img == ''){
						$M_Img = rowArray2(json_decode($this->input->post('M_Img',true)));
					}
					if(!$M_Img == ''){
						$data_update['M_Img']=$M_Img;
					}

				$this->common_model->update('member',$data_update,array('M_ID'=>uri_seg(3)));

				echo "<script>alert('แก้ไขข้อมูลเสร็จสิ้น');</script>";
				redirect('member/edit_profile/'.$M_ID,'refresh');
			}else{
				$data['member']['M_ID'] = $M_ID;
				$data['member']['M_Password_conf'] = '';
				$data['member']['M_TName'] = trim(set_value('M_TName'));
				$data['member']['M_ThName'] = trim(set_value('M_ThName'));
				$data['member']['M_EnName'] = trim(set_value('M_EnName'));
				$data['member']['M_Sex'] = trim(set_value('M_Sex'));
				$data['member']['M_Birthdate'] = trim(set_value('M_Birthdate'));
				$data['member']['M_npID'] = trim(set_value('M_npID'));
				$data['member']['M_Tel'] = trim(set_value('M_Tel'));
				$data['member']['M_Email'] = trim(set_value('M_Email'));
				$data['member']['M_Address'] = trim(set_value('M_Address'));
				$data['member']['M_Position'] = trim(set_value('M_Position'));
				$data['member']['M_UnitName'] = trim(set_value('M_UnitName'));
			}
		}
		
		$this->template->load('index_page',$data,'member');
	}

	public function fg_pass(){
		$row=$this->webinfo_model->getOnceWebMain();
		$row['WD_Name']=uns($row['WD_Name']);
		if($this->input->post('bt_submit')==''){
			$data['title']=$row['WD_Name']['TH'].'(Forgot Password?)';
			$this->template->load('fg_pass',$data);
		}else{
			$this->load->library('email');
			$this->load->helper('email');
			$this->load->library('form_validation');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			if ($this->form_validation->run() == FALSE)
			{
				echo "<script language='javascript'>alert('The email address is not valid or in the wrong format!'); history.back(); </script>";
				exit();
			}
			else
			{
				$member=rowArray($this->common_model->get_where_custom_and('member',array('M_Email'=>$this->input->post('email'),'M_Allow'=>'1')));
				if(count($member)>0)
					if(isset($member['M_Email'])){
						$this->email->from($row['WD_Email'],$row['WD_Name']['TH']);
						$this->email->to($this->input->post('email')); 
						$this->email->subject('อีเมลตอบกลับจาก '.$row['WD_Name']['TH']);	
						$this->email->message('Username : '.$member['M_Username']."\nPassword : ".$this->encrypt->decode($member['M_Password']));	
						@$this->email->send();
						print("<script language='javascript'>alert('Send completed. Please check your email inbox.');</script>");
					}else print("<script language='javascript'>alert('Please check your email!'); history.back();</script>");
				else print("<script language='javascript'>alert('No email in the system Or User is Blocked. Please contact your system administrator!'); history.back();</script>");
				redirect('login','refresh');
			}	
		}
	}*/

}
