<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Group_permissions extends MX_Controller {

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

	public function setting($mode='',$gm_id=''){
		$GP_Value = 7;
		$P_Process = uri_seg(1).'/'.uri_seg(2).'/'.uri_seg(3); //Add URI Seg3
		$this->admin_model->get_permiss_iniz($GM_ID,$GP_Value,$P_Process,$data);

		$data['mode'] = $mode;

		$data['content_view'] = 'group_permissions';
		$data['P_Name']	= uns($data['Permission']['P_Name']);
		$data['title'] = $data['P_Name']['TH'];

		if($mode==''){
			$data['group_members'] = $this->admin_model->getAll_group_members();
		}else if($mode=='add'){
			if(get_inpost('bt_submit') == ''){
				$count_process = count($this->admin_model->getAll_permissions());
				$P_ID_arr = array();
				for($i=0;$i<$count_process;$i++) {
					$P_ID_arr[] = 0;
				}

				$data['group_member'] = array(
					'GM_ID' => $gm_id,
					'GM_Name' => array('TH'=>'','EN'=>''),
					'GM_Descript' => array('TH'=>'','EN'=>''),
					'GM_Allow' => '1',
					'P_ID_arr'=>$P_ID_arr
				);

			}else{

				$this->load->library('form_validation');
				$frm=$this->form_validation;

				$frm->set_rules('GM_ID','ID','trim');
				$frm->set_rules('GM_Name[TH]','ชื่อไทย','required');
				$frm->set_rules('GM_Name[EN]','ชื่อังกฤษ','trim');
				$frm->set_rules('GM_Descript[TH]','คำอธิบายไทย','trim');
				$frm->set_rules('GM_Descript[EN]','คำอธิบายอังกฤษ','trim');
				$frm->set_rules('GM_Allow','สถานะ','required');

				$frm->set_message("required","กรุณากรอกข้อมูล %s");

				if($frm->run($this)){

					$this->db->trans_begin();
					$this->db->trans_strict(true);

					$data_insert = array(
						'GM_Name'=>ens(get_inpost_arr('GM_Name')),
						'GM_Descript'=>ens(get_inpost_arr('GM_Descript')),
						'GM_UserAdd'=>getUser(),
						'GM_DateTimeAdd'=>getDatetime(),
						'GM_UserUpdate'=>getUser(),
						'GM_DateTimeUpdate'=>getDatetime(),
						'GM_Allow'=>get_inpost('GM_Allow')
					);
					$gm_id = $this->common_model->insert('group_members',$data_insert);
		
					$arr = array();
					$p = get_inpost_arr('p');
					foreach($p as $key => $value){
						$temp = $this->admin_model->getOnce_permissions($value);
						if(isset($temp['P_ID'])){						
							$arr[] = array('GP_Value'=>7,
								'GM_ID'=>$gm_id,
								'P_ID'=>$value,
								'GP_UserAdd'=>getUser(),
								'GP_DateTimeAdd'=>getDatetime(),
								'GP_UserUpdate'=>getUser(),
								'GP_DateTimeUpdate'=>getDatetime(),
								'GP_Allow'=>'1');
						}
					}
					$this->common_model->insert_batch('group_permissions',$arr);

					if($this->db->trans_status() === FALSE)
					{
						$this->db->trans_rollback();
						dieFont('processing error!');
					}else{
						$this->db->trans_commit();
					}

					echo "<script>alert('เพิ่มข้อมูลเสร็จสิ้น');</script>";
					redirect('member/group_permissions/setting','refresh');
				}else{
					$data['group_member']['GM_ID'] = $gm_id;
					$data['group_member']['GM_Name']['TH'] = trim(set_value('GM_Name[TH]'));
					$data['group_member']['GM_Name']['EN'] = trim(set_value('GM_Name[EN]'));
					$data['group_member']['GM_Descript']['TH'] = trim(set_value('GM_Descript[TH]'));
					$data['group_member']['GM_Descript']['EN'] = trim(set_value('GM_Descript[EN]'));
					$data['group_member']['GM_Allow'] = trim(set_value('GM_Allow'));
					
					$temp = set_value('p');

					$P_ID_arr = array();
					$All_permissions = $this->admin_model->getAll_permissions();

					foreach ($All_permissions as $key => $value) {

						if(in_array($value['P_ID'],$temp)){
							$P_ID_arr[] = 1;
						}else {
							$P_ID_arr[] = 0;
						}
					}
					$data['group_member']['P_ID_arr'] = $P_ID_arr;
				}
			}
		}else if($mode=='edit'){
			$data['group_member'] = $this->admin_model->getOnce_group_members($gm_id);
			$data['group_member']['GM_Name'] = uns($data['group_member']['GM_Name']);
			$data['group_member']['GM_Descript'] = uns($data['group_member']['GM_Descript']);

			if(get_inpost('bt_submit') == ''){
				$P_ID_arr = array();
				$this->member_model->getPGP($P_ID_arr,$gm_id,0);
				$data['group_member']['P_ID_arr'] = $P_ID_arr;			
			}else if(get_inpost('bt_submit') != ''){

				$this->load->library('form_validation');
				$frm=$this->form_validation;

				$frm->set_rules('GM_ID','ID','trim');
				$frm->set_rules('GM_Name[TH]','ชื่อไทย','required');
				$frm->set_rules('GM_Name[EN]','ชื่อังกฤษ','trim');
				$frm->set_rules('GM_Descript[TH]','คำอธิบายไทย','trim');
				$frm->set_rules('GM_Descript[EN]','คำอธิบายอังกฤษ','trim');
				$frm->set_rules('GM_Allow','สถานะ','required');

				$frm->set_message("required","กรุณากรอกข้อมูล %s");

				if($frm->run($this)){
					
					$this->db->trans_begin();
					$this->db->trans_strict(true);

					$data_update = array(
						'GM_Name'=>ens(get_inpost_arr('GM_Name')),
						'GM_Descript'=>ens(get_inpost_arr('GM_Descript')),
						'GM_UserUpdate'=>getUser(),
						'GM_DateTimeUpdate'=>getDatetime(),
						'GM_Allow'=>get_inpost('GM_Allow')
					);
					$this->common_model->update('group_members',$data_update,array('GM_ID'=>uri_seg(5)));

					$this->common_model->update('group_permissions'
						,array('GP_Allow'=>'3',
							'GP_UserUpdate'=>getUser(),
							'GP_DateTimeUpdate'=>getDatetime())
						,array('GM_ID'=>$gm_id)
					);

					$arr = array();
					$p = get_inpost_arr('p');
					foreach($p as $key => $value){
						$temp = $this->admin_model->getOnce_permissions($value);
						if(isset($temp['P_ID'])){					
							$arr[] = array('GP_Value'=>7,
								'GM_ID'=>$gm_id,
								'P_ID'=>$value,
								'GP_UserAdd'=>getUser(),
								'GP_DateTimeAdd'=>getDatetime(),
								'GP_UserUpdate'=>getUser(),
								'GP_DateTimeUpdate'=>getDatetime(),
								'GP_Allow'=>'1');
						}
					}
					$this->common_model->insert_batch('group_permissions',$arr);

					if($this->db->trans_status() === FALSE)
					{
						$this->db->trans_rollback();
						dieFont('processing error!');
					}else{
						$this->db->trans_commit();
					}

					echo "<script>alert('แก้ไขข้อมูลเสร็จสิ้น');</script>";
					redirect('member/group_permissions/setting','refresh');
				}else{
					$data['group_member']['GM_ID'] = $gm_id;
					$data['group_member']['GM_Name[TH]'] = trim(set_value('GM_Name[TH]'));
					$data['group_member']['GM_Name[EN]'] = trim(set_value('GM_Name[EN]'));
					$data['group_member']['GM_Descript[TH]'] = trim(set_value('GM_Descript[TH]'));
					$data['group_member']['GM_Descript[EN]'] = trim(set_value('GM_Descript[EN]'));
					$data['group_member']['GM_Allow'] = trim(set_value('GM_Allow'));

					$temp = set_value('p');

					$P_ID_arr = array();
					$All_permissions = $this->admin_model->getAll_permissions();

					foreach ($All_permissions as $key => $value) {

						if(in_array($value['P_ID'],$temp)){
							$P_ID_arr[] = 1;
						}else {
							$P_ID_arr[] = 0;
						}
					}
					$data['group_member']['P_ID_arr'] = $P_ID_arr;
				}
			}

		}else if($mode=='del'){
			$this->common_model->update('group_members',
				array('GM_Allow'=>'3','GM_UserUpdate'=>getUser(),'GM_DateTimeUpdate'=>getDatetime()),
				array('GM_ID'=>uri_seg(5))
			);
			echo "<script>alert('ลบข้อมูลเสร็จสิ้น');</script>";
			redirect('member/group_permissions/setting','refresh');
		}

		$this->template->load('index_page',$data,'member');
	}

}
