<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Elderly_care extends MX_Controller {

private $user_id;
private $app_id;
private $process_action;
private $usrpm;

function __construct() {
    parent::__construct();

    $exceptAuth = [];
    $method_name = $this->uri->segment(3);

    if(!in_array($method_name, $exceptAuth)){

        chkUserLogin();

        $this->user_id = get_session('user_id');
        $this->app_id = 52; //Fix for dev.

        if($method_name == 'index' || $method_name == '' ){
            $this->process_action = 'View';

        }else if($method_name == 'create'){
            $this->process_action = 'Add';

        }else if( $method_name == 'store' && is_empty($this->input->post('volt_info[volt_id]')) ){
            $this->process_action = 'Added';

        }else if($method_name == 'edit'){
            $this->process_action = 'Edit';

        }else if($method_name == 'store' && !is_empty($this->input->post('volt_info[volt_id]')) ){
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

        $this->load->library('template',
        array(  
                'name'=>'admin_template1',
                'setting'=>array('data_output'=>'')
            )
        ); // Set Template

    }
}

function __deconstruct() {
    $this->db->close();
}

public function edit($id = 0){
    $volunteer_id = $id;
    $volt_info = $this->volunteer_model->get_id($volunteer_id);

    if(count($volt_info) != 0){
        $data = array();

        $data['volt_info'] = $volt_info;
        $data['volt_info_elderly_care'] = $this->volunteer_model->elderly_care($volunteer_id); //Get data elderly_care
        $data['cause_of_cares'] = $this->volunteer_model->get_cause_of_care();
        $data['marital_status'] = json_decode(read_file("./assets/json/marital_status.json") , true);
        $data['occupation'] = json_decode(read_file("./assets/json/occupation.json") , true);
        $data['revenue_source'] = json_decode(read_file("./assets/json/revenue_source.json") , true);
        $data['relationship'] = json_decode(read_file("./assets/json/relationship.json") , true);
        $data['community_activity'] = json_decode(read_file("./assets/json/community_activity.json") , true);
        $data['health_issues'] = json_decode(read_file("./assets/json/health_issues.json") , true);
        $data['mental_health_issues'] = json_decode(read_file("./assets/json/mental_health_issues.json") , true);
        $data['social_issues'] = json_decode(read_file("./assets/json/social_issues.json") , true);
        $data['economy_issues'] = json_decode(read_file("./assets/json/economy_issues.json") , true);
        $data['elderly_requirement'] = json_decode(read_file("./assets/json/elderly_requirement.json") , true);
        $data['edu_level'] = $this->volunteer_model->get_edu_level();

        // echo '<pre>';
        // print_r($data['volt_info_elderly_care']);
        // echo '</pre>';
        // die;
        // echo count($data['cause_of_cares']);
        // die;

        /*-- Toastr style --*/
        set_css_asset_head('../plugins/Static_Full_Version/css/plugins/toastr/toastr.min.css');
        set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/toastr/toastr.min.js');
        /*-- End Toastr style --*/

        set_js_asset_footer('webservice.js','personals'); //Set JS sufferer_form1.js
        // set_js_asset_footer('volunteer_info.js','volunteer'); //Set JS volunteer_info.js


        $data['usrpm'] = $this->usrpm;
        $data['user_id'] = $this->user_id;
        $data['process_action'] = $this->process_action;
        $data['content_heading'] = 'partial/_menu_tab_list_page';
        $data['content_view']     = 'form_elderly_care';

        $tmp = $this->admin_model->getOnce_Application($this->usrpm['app_parent_id']); //Used for find root application

        $data['head_title']     = $tmp['app_name'];
        $data['title']             = $this->usrpm['app_name'];

        $data['csrf'] = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );


        $this->template->load('index_page_module_heading_blank',$data,'volunteer');
    }else {
          // no volunteer data
          page500();
          $this->webinfo_model->LogSave($this->app_id, $this->process_action, 'Sign Out', 'Fail'); //Save Sign Out Log
    }

}

public function store(){
    $volunteer_id = get_inpost('volt_info[volt_id]');
    $this->handle_volunteerEldersInCharge($volunteer_id , $this->process_action);

    redirect('volunteer/elderly_care/edit/'.$volunteer_id,'refresh');

}

private function handle_volunteerEldersInCharge($volunteer_id, $mode = 'Added') {
    $tmp_elderly_care = get_inpost_arr('elderly_care[pers_id]');

    if (is_empty($tmp_elderly_care)){ //Case empty data
        return;
    }
     // print_r($tmp_elderly_care) ;die;

    foreach ($tmp_elderly_care as $key => $value ) {

        if( get_inpost('elderly_care[care_store_status]['.$key.']') == 'update' || trim( get_inpost('elderly_care[fullname]['.$key.']') ) != '' ){ //Fix case create fullname required

            if($this->config->item('app_env') != 'production' && get_inpost('elderly_care[care_id]['.$key.']') == ''){
                $pers_id = rand(1 ,100); //Random id for dev

            }else{ //Case production
                $pers_id = $value;
            }

            // echo get_inpost('elderly_care[care_economy_issues_specify]['.$key.']');die;
            // echo '<pre>';
            // print_r( get_inpost_arr('elderly_care[care_assistance_opinion_set]['.$key.']') )  ;
            // echo '</pre>';
            // die;

            $elder_care_update = array(
                'volt_id'                    => $volunteer_id,
                'pers_id'                   => $pers_id,
                'care_freq'                => get_inpost('elderly_care[care_freq]['.$key.']'),
                'care_freq_per'        => get_inpost('elderly_care[care_freq_per]['.$key.']'),
                'care_health_problems' => get_inpost('elderly_care[healthy]['.$key.']'),
                'care_help_yourself'   => get_inpost('elderly_care[healthy_self_help]['.$key.']'),
                'care_cause_code'      => get_inpost('elderly_care[care_cause_code]['.$key.']'),
                'care_cause_identify'  => get_inpost('elderly_care[care_cause_identify]['.$key.']'),

                'care_talent' => get_inpost('elderly_care[care_talent]['.$key.']'),

                'care_src_of_income' => json_encode(get_inpost_arr('elderly_care[care_src_of_income]['.$key.']') , JSON_UNESCAPED_UNICODE),
                'care_src_of_income_specify' => get_inpost('elderly_care[care_src_of_income_specify]['.$key.']'),

                'care_relationship' => get_inpost('elderly_care[care_relationship]['.$key.']'),
                'care_relationship_specify' => get_inpost('elderly_care[care_relationship_specify]['.$key.']'),

                'care_community_activity' => json_encode( get_inpost_arr('elderly_care[care_community_activity]['.$key.']') , JSON_UNESCAPED_UNICODE ),
                'care_community_activity_specify' => json_encode(get_inpost_arr('elderly_care[care_community_activity_specify]['.$key.']') , JSON_UNESCAPED_UNICODE ),

                'care_health_issues' => json_encode( get_inpost_arr('elderly_care[care_health_issues]['.$key.']') , JSON_UNESCAPED_UNICODE ),
                'care_health_issues_specify' => json_encode( get_inpost_arr('elderly_care[care_health_issues_specify]['.$key.']') , JSON_UNESCAPED_UNICODE ),

                'care_mental_health_issues' => json_encode( get_inpost_arr('elderly_care[care_mental_health_issues]['.$key.']') , JSON_UNESCAPED_UNICODE ),
                'care_mental_health_issues_specify' => get_inpost('elderly_care[care_mental_health_issues_specify]['.$key.']'),

                'care_social_issues' => json_encode( get_inpost_arr('elderly_care[care_social_issues]['.$key.']') , JSON_UNESCAPED_UNICODE ),
                'care_social_issues_specify' => get_inpost('elderly_care[care_social_issues_specify]['.$key.']'),

                'care_economy_issues' => json_encode( get_inpost_arr('elderly_care[care_economy_issues]['.$key.']') , JSON_UNESCAPED_UNICODE ),
                'care_economy_issues_specify' => get_inpost('elderly_care[care_economy_issues_specify]['.$key.']'),

                'care_elderly_requirement' => json_encode( get_inpost_arr('elderly_care[care_elderly_requirement]['.$key.']') , JSON_UNESCAPED_UNICODE ),
                'care_elderly_requirement_specify' => json_encode( get_inpost_arr('elderly_care[care_elderly_requirement_specify]['.$key.']') , JSON_UNESCAPED_UNICODE ),

                'care_assistance_opinion_set' => json_encode( get_inpost_arr('elderly_care[care_assistance_opinion_set]['.$key.']') , JSON_UNESCAPED_UNICODE ),

            );


            $pers_info = array(
                'marital_status'  => get_inpost('elderly_care[marital_status]['.$key.']'),
                'edu_code'  => get_inpost('elderly_care[edu_code]['.$key.']'),
                'edu_identify'  => get_inpost('elderly_care[edu_identify]['.$key.']'),
                'occupation' => ( get_inpost('elderly_care[occupation_identify]['.$key.']') != '' ? get_inpost('elderly_care[occupation_identify]['.$key.']') : get_inpost('elderly_care[occupation]['.$key.']') ) ,
                'mth_avg_income' => get_inpost('elderly_care[mth_avg_income]['.$key.']')

            );

            $pers_info = array_filter($pers_info); //Clear array empty for not update.

            if(!is_empty($pers_info)) {
                $this->common_model->update('pers_info', $pers_info, array('pers_id'=>get_inpost('elderly_care[pers_id]['.$key.']') ) );

            }

            // echo '<pre>';
            // print_r(array_filter($pers_info));
            // echo '</pre>';

            // die;

            // print_r($elder_care_update);die;
            if (get_inpost('elderly_care[care_id]['.$key.']') !='' )
                $this->common_model->update('volt_info_elderly_care', $elder_care_update, array('care_id'=>get_inpost('elderly_care[care_id]['.$key.']')));
            else
                $this->common_model->insert('volt_info_elderly_care', $elder_care_update);

        }//End if pid != ''

        
    }//End foreach

  }

}
?>