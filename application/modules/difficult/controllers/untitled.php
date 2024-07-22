    $tmp = $this->admin_model->getOnce_Application("010000");
    if(!isset($tmp['app_id'])) {
      dieFont('Application Invalid!');
    }
    $app_code = $tmp['app_code'];

    /*-- Initial Data for Check User Permission --*/
    $user_id = get_session('user_id');
    $app_id = $tmp['app_id'];
		/*--END Inizial Data for Check User Permission--*/




      $usrpm['app_parent_id'] = $usrpm['app_parent_id']=='0'?$usrpm['app_id']:$usrpm['app_parent_id'];

			$tmp = $this->admin_model->getOnce_Application_wid($usrpm['app_parent_id']); //Used for find root application
      $data['app_parent_code'] = $tmp['app_code'];
			$data['head_title'] = $tmp['app_name'];
			$data['title'] = $usrpm['app_name'];