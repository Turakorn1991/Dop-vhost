<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Volunteer extends MX_Controller {

	function __construct() {
		parent::__construct();

		chkUserLogin();

	}
	function __deconstruct() {
		$this->db->close();
	}

	public function getChart(){
    ini_set('max_execution_time', 300);
    $dataChart = array();
    $prov = $this->personal_model->getAll_Province();
    foreach ($prov as $key => $row) {
        $dataChart[] = array(
            'province' => $row['area_name_th'],
            'value' => rand(0,500),
            'older' => rand(0,100),
        );
    }
    echo json_encode($dataChart);

	}

	public function volunteer_list_ajax($process_action='View') { //อผส.
		//ini_set('max_execution_time', 300);
		$data = array(); //Set Initial Variable to Views
		/*-- Initial Data for Check User Permission --*/
		$user_id = get_session('user_id');
		$app_id = 51;
		/*--END Inizial Data for Check User Permission--*/

		$this->webinfo_model->LogSave($app_id,$process_action,'Sign In','Success'); //Save Sign In Log
		$usrpm = $this->admin_model->chkOnce_usrmPermiss($app_id,$user_id); //Check User Permission

		if (@$usrpm['perm_status']=='No' || !isset($usrpm['app_id'])) {
			echo json_encode(array());
			$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Fail'); //Save Sign In Log
		} else {
			$app_name = $usrpm['app_name'];
			$data['usrpm'] = $usrpm;
			$data['user_id'] = $user_id;

			//$data['diff_info'] = $this->difficult_model->getAll_diffInfo();

			$this->load->model('volunteer_list_model', 'manage_transfer');
			$list = $this->manage_transfer->get_datatables($this->input->post('filter_where'));
			$data = array();
			$no = $_POST['start'];
			foreach ($list as $i=>$volunteer) {
				$no++;
				$row = array();
				// *********************** data displayed in 10 columns *********************************
        $row[] = "<center>".$no."</center>";
        $row[] = $volunteer->pid;
        $row[] = $volunteer->prename_th.$volunteer->name;
				$row[] = "<center>".$this->calculate_age($volunteer->date_of_birth, $volunteer->date_of_death)."</center>";
        $row[] = "<center>".$this->set_dateFormat($volunteer->date_of_reg)."</center>";
				$row[] = "<center>".$this->set_telFormat($volunteer->tel_no)."</center>";
				$row[] = "$volunteer->org_title";
				$row[] = "<center style='color:".($volunteer->date_of_resign != '0000-00-00' && !empty($volunteer->date_of_resign) ? "red'> Inactive" : "limegreen'>Active")."</center>";
				// $row[] = "<center>".$this->set_dateFormat($volunteer->date_of_resign)."</center>";
				$row[] = "<center>". $volunteer->num_elderly_care ."</center>";

                $tmp = $this->admin_model->getOnce_Application(147);
                $tmp1 = $this->admin_model->chkOnce_usrmPermiss(147,$user_id); //Check User Permission
				$permission52 = $this->admin_model->chkOnce_usrmPermiss(52,$user_id); //Check User Permission

                $btn = '<!-- Single button -->
            	<div class="btn-group" style="cursor: pointer;">
              		<i
						data-toggle="dropdown"
						aria-haspopup="true"
						aria-expanded="false"
						class="dropdown-toggle fa fa-gear"
						aria-hidden="true"
						style="color: #000"
					></i>
              		<ul class="dropdown-menu" style="position: absolute;left: -190px;">
						<li>
							<a
								style="font-size:16px;"'.
								// 'data-toggle="modal"'.
								'data-target="#prt'.$volunteer->volt_id.'"
								title="พิมพ์แบบฟอร์ม"
								href="'.site_url("report/F2/pdf?id=".$volunteer->volt_id).'"
								target="_blank"
							>
								<i class="fa fa-file-pdf-o" aria-hidden="true" style="color: #000"></i> พิมพ์แบบฟอร์ม (.PDF)
						 	</a>
						</li>
						<li>
							<a
								style="font-size:16px;"' . (
								!isset($tmp1['perm_status']) ?
								'class="disabled"' :
								'href="'.site_url("volunteer/info/edit/".$volunteer->volt_id).'"'
								) . '
							>
								<i class="fa fa-pencil" aria-hidden="true" style="color: #000"></i> แก้ไขรายการ
							</a>
						</li>' . (
						$permission52['perm_status'] == 'Yes' ? '
						<li>
							<a style="font-size:16px;" data-id='.$volunteer->volt_id.' onclick="opn(this)" title="ลบ" >
                            	<i class="fa fa-trash" style="color: #000"></i> ลบรายการ
                         	</a>
						</li>' :
						''
						) . '
					</ul>
	            <div>';


                $btn =$btn.'<!-- Print Modal -->
                   <div class="modal fade" id="prt'.$volunteer->volt_id.'" role="dialog">
                     <div class="modal-dialog">

                        <!-- Modal content-->
                       <div class="modal-content">
                         <div class="modal-header text-left">
                           <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title" style="color: #333; font-size: 16px;">พิมพ์แบบฟอร์ม</h4>
                          </div>
                         <div class="modal-body">
                           <div class="row">';

                    $tmp = $this->admin_model->getOnce_Application(147);
                    $tmp1 = $this->admin_model->chkOnce_usrmPermiss(147,get_session('user_id')); //Check User Permission
                    $btn = $btn.'<div class="col-xs-12 col-sm-12 text-left" style="margin-bottom: 10px;" ';
                            if(!isset($tmp1['perm_status'])) {
                                $btn = $btn.' class="disabled" ';
                            }else if($usrpm['app_id']==147) {
                                $btn = $btn.' class="active" ';
                            }
                    $btn = $btn.'>
                              <a style="color: #333; font-size: 16px; margin-bottom: 50px;" target="_blank" href="'.site_url('report/F2/pdf?id='.$manage_transfer->volt_id).'"><i class="fa fa-print" aria-hidden="true"></i> ';
                             if(isset($tmp1['perm_status'])) {
                               $btn = $btn.$tmp1['app_name'];
                             }
                    $btn = $btn.'
                              </a>
                            </div>

                           </div>
                           <br/>

                        </div>
                      </div>

                    </div>
                   </div>
                   <!-- End Print Modal -->';

                $row[] = "<center>".$btn."<center>";

                $data[] = $row;
            }

			$output = array(
							"draw" => $_POST['draw'],
							"recordsTotal" => $this->manage_transfer->count_all(),
							"recordsFiltered" => $this->manage_transfer->count_filtered(),
							"data" => $data
					);
			//output to json format
			echo json_encode($output);
			$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Success'); //Save Sign Out Log
		}

	}

	public function volunteer_list($process_action='View') { // อผส
		//ini_set('max_execution_time', 300);
		$data = array(); //Set Initial Variable to Views
		/*-- Initial Data for Check User Permission --*/
		$user_id = get_session('user_id');
		$app_id = 51;
		$process_path = 'volunteer/volunteer_list';
		/*--END Inizial Data for Check User Permission--*/

		$this->webinfo_model->LogSave($app_id,$process_action,'Sign In','Success'); //Save Sign In Log
		$usrpm = $this->admin_model->chkOnce_usrmPermiss($app_id,$user_id); //Check User Permission

		if(@$usrpm['perm_status']=='No' || !isset($usrpm['app_id'])){
			page500();
			$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Fail'); //Save Sign In Log
		}else {
			$app_name = $usrpm['app_name'];
			$data['usrpm'] = $usrpm;
			$data['user_id'] = $user_id;

			$filter_where = $this->input->post();

			if(isset( $filter_where['pid'] )){
				$filter_where['pid'] = str_replace('-', '', $filter_where['pid']);
			}

			// $data['filter_where'] = $this->input->post();
			$data['filter_where'] = $filter_where;

			// $data['volt_info'] = $this->common_model->custom_query("
			// 	SELECT A.*,B.vpos_code,B.vpos_identify FROM volt_info AS A
			// 	LEFT JOIN volt_info_village_position AS B ON A.volt_id = B.volt_id
			// ");
			//$data['volt_info'] = $this->common_model->custom_query("SELECT * FROM volt_info");

			$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
			);

			$this->load->library('template',
				array('name'=>'admin_template1',
					  'setting'=>array('data_output'=>''))
			); // Set Template

			/*-- Load Datatables for Theme --*/
			set_css_asset_head('../plugins/Static_Full_Version/css/plugins/dataTables/datatables.min.css');
			set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/dataTables/datatables.min.js');
			/*-- End Load Datatables for Theme --*/

			/*-- Toastr style --*/
			set_css_asset_head('../plugins/Static_Full_Version/css/plugins/toastr/toastr.min.css');
			set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/toastr/toastr.min.js');
			/*-- End Toastr style --*/

		    /*-- datepicker --*/
		    //set_css_asset_head('../plugins/bootstrap-datepicker1.3.0/css/datepicker.css');
		    //set_js_asset_head('../plugins/bootstrap-datepicker1.3.0/js/bootstrap-datepicker.js');
		    /*-- End datepicker --*/

		    /*-- datepicker custom --*/
		    set_css_asset_head('../plugins/bootstrap-datepicker-custom/dist/css/bootstrap-datepicker.css');
		    set_js_asset_head('../plugins/bootstrap-datepicker-custom/dist/js/bootstrap-datepicker-custom.js');
		    set_js_asset_head('../plugins/bootstrap-datepicker-custom/dist/locales/bootstrap-datepicker.th.min.js');
		    /*-- End datepicker custom--*/

			/*-- datepicker --*/
			// set_css_asset_head('../plugins/bootstrap-datepicker-thai/css/datepicker.css');
			// set_js_asset_head('../plugins/bootstrap-datepicker-thai/js/bootstrap-datepicker.js');
			// set_js_asset_head('../plugins/bootstrap-datepicker-thai/js/bootstrap-datepicker-thai.js');
			// set_js_asset_head('../plugins/bootstrap-datepicker-thai/js/locales/bootstrap-datepicker.th.js');
			/*-- End datepicker --*/

			set_js_asset_footer('volunteer_list_ajax.js','volunteer'); //Set JS volunteer_list_ajax.js

     		set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/ionRangeSlider/ion.rangeSlider.min.js'); //Set JS Index.js

			$data['process_action'] = $process_action;
			$data['content_view'] 	= 'volunteer_list_ajax';

			$tmp = $this->admin_model->getOnce_Application($usrpm['app_parent_id']); //Used for find root application
			$data['head_title'] = $tmp['app_name'];
			$data['title'] = $usrpm['app_name'];

			$this->template->load('index_page',$data,'volunteer');
			$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Success'); //Save Sign Out Log
		}

	}

	public function date_check($str) {
    //$str = str_replace("-","",$str);
		if(strlen($str)==10) {
      $year = iconv_substr($str,6,4,'utf-8');
      //settype("integer",$year);
      $year = $year-543;
			if(checkdate(iconv_substr($str,3,2,'utf-8'),iconv_substr($str,0,2,'utf-8'),$year)){
				return true;
			}
			else{
				return false;
			}
		}else return false;
	}

	public function del_elderly_care()
    {
        $care_id = get_inpost('care_id');
        $this->common_model->delete_where('volt_info_elderly_care','care_id',$care_id);
        echo "remove";

    }

    public function del_train() {
        $train_id = get_inpost('train_id');
        $this->common_model->delete_where('volt_info_training','train_id',$train_id);
        echo "remove";
    }

  private function set_telFormat($tel) {
		if (preg_match("/\d{10}/", $tel)) {
			$tel = preg_replace("/(\d{6})(\d+)/", '$1-$2', $tel, 1);
			$tel = preg_replace("/(\d{3})(\d+)/", '$1-$2', $tel, 1);
		} else
			$tel = '-';
		return $tel;
	}

	private function set_dateFormat($date) {
		if ($date == '' || $date == '0000-00-00')
			$date = '-';
		else
			$date = dateChange($date, 5);
		return $date;
	}

	private function calculate_age($birth, $death) {
		$age = '-';
		$now = new DateTime();
		if (!!$death) {
			$age = "ถึงแก่กรรมแล้ว";
			if (checkdate(
				iconv_substr($death, 5, 2, 'utf-8'),
				iconv_substr($death, 8, 2, 'utf-8'),
				iconv_substr($death, 0, 4, 'utf-8')
			)) {
				$deathDate = new DateTime($death);
				$interval = $now->diff($deathDate);
				$age .= " $interval->y ปี";
			}
		}
		if (!!$birth && checkdate(
			iconv_substr($birth, 5, 2, 'utf-8'),
			iconv_substr($birth, 8, 2, 'utf-8'),
			iconv_substr($birth, 0, 4, 'utf-8')
		)) {
			$birthDate = new DateTime($birth);
			$interval = $now->diff($birthDate);
			$age = $interval->y;
		}
		return $age;
	}

	private function set_citizenIDFormat($id) {
		if (preg_match("/\d{13}/", $id)) {
			$id = preg_replace("/(\d{12})(\d+)/", '$1-$2', $id, 1);
			$id = preg_replace("/(\d{10})(\d+)/", '$1-$2', $id, 1);
			$id = preg_replace("/(\d{5})(\d+)/", '$1-$2', $id, 1);
			$id = preg_replace("/(\d{1})(\d+)/", '$1-$2', $id, 1);
		} else
			$id = '-';
		return $id;
	}

	public function getDataDead() { 
		$input = $this->input->post();		
		$rs = $this->common_model->getVolunteerDouble($input['req_id']);

		$this->output
	        ->set_content_type('application/json')
	        ->set_output(json_encode($rs));

	}


}
