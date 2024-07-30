<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: sanitkeawtawan
 * Date: 6/16/2017 AD
 * Time: 20:28
 */
ini_set('memory_limit', '600000M');
class Report_mock extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    function reportA0_ktb($filter){
        $results = $this->report_model->getDiffInfo($filter);
        if(!$results){
            return null;
        }
        $data = array();
        $rows = array();
        if(!is_array($results)){
            $rows[]=$results;
        }else{
            $rows=$results;
        }
        foreach ($rows as $index=>$result){
            if($data[count($data)-1][9] != $result->diff_id){
                $new=array();
                $new[]= '600';
                $new[]=$result->bank_acc_no;
                $new[]=$result->pers_firstname_th." ".$result->pers_lastname_th;
                $new[]=number_format($result->pay_amount);
                $new[]=$result->pid;
                $new[]='';
                $new[]='';
                $new[]=$result->email_addr;
                $new[]=$result->tel_no;
                $new[]= $result->diff_id;
                unset($data[count($data)-2][9]);
                array_push($data,$new);
            }else{
                unset($data[count($data)-2][9]); 
            }
        }
        unset($data[count($data)-2][9]);
        unset($data[count($data)-1][9]);
        return $data;
    }

    function reportA0($filter)//for excel
    {
        $row_no = 0;
        $results = $this->report_model->getDiffInfo($filter);
        if(!$results){
            return null;
        }
        $data = array();
        $rows = array();
        if(!is_array($results)){
            $rows[]=$results;
        }else{
            $rows=$results;
        }
        foreach ($rows as $index=>$result){
            if($data[count($data)-1][17] != $result->diff_id){
                $new=array();
               // $new[]=$index+1;
                $new[]=++$row_no;
                $new[]=$result->prename_th." ".$result->pers_firstname_th." ".$result->pers_lastname_th;
                $new[]=$result->pid;

                $new[]=!empty($result->addr_home_no)?$result->addr_home_no." ":"" ;  
                $new[]=!empty($result->addr_moo)?$result->addr_moo." ":"" ;  
                $new[]=!empty($result->addr_sub_district)?$result->addr_sub_district." ":"" ;  
                $new[]=!empty($result->addr_district)?$result->addr_district." ":"" ;  
                $new[]=!empty($result->addr_province)?$result->addr_province." ":"" ; 
                $new[]=dateTH($result->date_of_req);
                $new[]=dateTH($result->date_of_visit);
                $new[]=$result->trb_title." ".$result->trb_remark;
                $new[]=$result->help_title." ".$result->help_remark;
                $new[]=dateTH($result->date_of_pay);
                $new[]=$result->help_guide_title." ".$result->help_guide_remark;
                $new[]= $result->pay_amount;
                $new[]= $result->payee_type;
                $new[]= $result->pay_channel;
                $org=$this->report_model->getOrg($result->insert_org_id);
                $new[]=$org->org_title;
                $new[]= $result->diff_id;
                unset($data[count($data)-2][18]);
                array_push($data,$new);
            }else{
                $data[count($data)-1][10] .= $result->trb_title." ".$result->trb_remark;
                unset($data[count($data)-2][18]); 
            }
        }
        unset($data[count($data)-2][18]);
        unset($data[count($data)-1][18]);
        return $data;
        
      
    }

    function reportB0($filter)//for excel
    {
        $results = $this->report_model->getAdmInfo($filter);
        if(!$results){
            return null;
        }
        $data = array();
        $rows = array();
        if(!is_array($results)){
            $rows[]=$results;
        }else{
            $rows=$results;
        }
        foreach ($rows as $index=>$result){
            $new=array();
            $new[]=$index+1;
            $new[]=$result->prename_th." ".$result->pers_firstname_th." ".$result->pers_lastname_th;
            $new[]=$result->pid;
            $new[]=age($result->date_of_birth);
            $org=$this->report_model->getOrg($result->insert_org_id);
            $new[]=@$org->org_title;
            $new[]=dateTH($result->date_of_req);
            $new[]=dateTH($result->date_of_adm);
            $new[]=dateTH($result->date_of_dis);
            $new[]=dateTH($result->date_of_irp);
            $irp_result = $this->report_model->get_Percentage($result->irp_id);
            $new[]=$irp_result['ans_rate'];
            array_push($data,$new);
        }
        return $data;
    }
    function reportC0_ktb($filter)//for excel
    {
   
        $results = $this->report_model->getFnrlInfo($filter,true);
        if(!$results){
            return null;
        }
        $data = array();
        $rows = array();
        if(!is_array($results)){
            $rows[]=$results;
        }else{
            $rows=$results;
        }
        foreach ($rows as $index=>$result){
            $new=array();
            $new[]= '600';
            // $person_req = $this->report_model->getPersInfo($result->req_pers_id);
            $new[]=$result->req_pers_bank_acc_no;
            $new[]=$result->req_pers_pers_firstname_th." ".$result->req_pers_pers_lastname_th;
            $new[]=number_format($result->pay_amount);
            $new[]=$result->req_pers_pid;
            $new[]='';
            $new[]='';
            $new[]=$result->req_pers_email_addr;
            $new[]=$result->req_pers_tel_no;
            array_push($data,$new);
        }
        return $data;
    }
    function reportC0($filter)//for excel
    {
   
        $results = $this->report_model->getFnrlInfo($filter);
        if(!$results){
            return null;
        }
        $data = array();
        $rows = array();
        if(!is_array($results)){
            $rows[]=$results;
        }else{
            $rows=$results;
        }
        foreach ($rows as $index=>$result){
            $new=array();
            $new[]=$index+1;
            // $person_req = $this->report_model->getPersInfoFullname($result->req_pers_id);
            $new[]=$result->req_pers_prename_th." ".$result->req_pers_pers_firstname_th." ".$result->req_pers_pers_lastname_th;
            $new[]=$result->req_pers_pid;
            // $addr = $this->report_model->getAddrSelect($result->req_pers_reg_addr_id);
            $new[]=!empty($result->req_pers_addr_home_no)?$result->req_pers_addr_home_no." ":"" ;  
            $new[]=!empty($result->req_pers_addr_moo)?$result->req_pers_addr_moo." ":"" ;  
            $new[]=!empty($result->req_pers_locality)?$result->req_pers_locality." ":"" ;  
            $new[]=!empty($result->req_pers_district)?$result->req_pers_district." ":"" ;  
            $new[]=!empty($result->req_pers_province)?$result->req_pers_province." ":"" ; 
            $new[]=$result->prename_th." ".$result->pers_firstname_th." ".$result->pers_lastname_th;
            $new[]=$result->pid;
            // $person = $this->report_model->getPersInfoFullname($result->req_pers_aprv_pers_id);
            $new[]=$result->req_pers_aprv_prename_th." ".$result->req_pers_aprv_pers_firstname_th." ".$result->req_pers_aprv_pers_lastname_th;
            $new[]=$result->req_pers_aprv_position;
            $new[]=dateTH($result->date_of_req);
            $new[]=dateTH($result->date_of_pay);
            $new[]=!empty($result->req_pers_bank_name)?$result->req_pers_bank_name:""; 
            $new[]=!empty($result->req_pers_bank_acc_no)?$result->req_pers_bank_acc_no:"" ; 
            $new[]=number_format($result->pay_amount);
            $new[]=$result->payee_type;
            $new[]=$result->pay_channel;
            // $org=$this->report_model->getOrg($result->insert_org_id);
            $new[]=$result->org_title;
            array_push($data,$new);
        }
        return $data;
    }
    function reportD0_ktb($filter)//for excel
    {
   
        $results = $this->report_model->getImpvHomeInfo($filter);
        if(!$results){
            return null;
        }
        $data = array();
        $rows = array();
        if(!is_array($results)){
            $rows[]=$results;
        }else{
            $rows=$results;
        }
        foreach ($rows as $index=>$result){
            $new=array();
            $new[]= '600';
            $new[]=$result->bank_acc_no;
            $new[]=$result->pers_firstname_th." ".$result->pers_lastname_th;
            $new[]=number_format($result->case_budget);
            $new[]=$result->pid;
            $new[]='';
            $new[]='';
            $new[]=$result->email_addr;
            $new[]=$result->tel_no;
            array_push($data,$new);
        }
        return $data;
    }
    function reportD0($filter)//for excel
    {
        //$id=(!is_array($id))?array($id):$id;
        $results = $this->report_model->getImpvHomeInfo($filter);
        if(!$results){
            return null;
        }
        $data = array();
        $rows = array();
        if(!is_array($results)){
            $rows[]=$results;
        }else{
            $rows=$results;
        }
        foreach ($rows as $index=>$result){
            $new=array();
            $new[]=$index+1;
            $new[]=$result->prename_th." ".$result->pers_firstname_th." ".$result->pers_lastname_th;
            $new[]=$result->pid;
            $new[]=!empty($result->addr_home_no)?$result->addr_home_no." ":"" ;  
            $new[]=!empty($result->addr_moo)?$result->addr_moo." ":"" ;  
            $new[]=!empty($result->addr_sub_district)?$result->addr_sub_district." ":"" ;  
            $new[]=!empty($result->addr_district)?$result->addr_district." ":"" ;  
            $new[]=!empty($result->addr_province)?$result->addr_province." ":"" ; 
            $total = $result->case_budget + $result->mgt_budget;
            $new[]=number_format($total) . " บาท";
            $new[]=dateTH($result->date_of_finish);
            $org=$this->report_model->getOrg($result->insert_org_id);
            $new[]=$org->org_title;
            array_push($data,$new);
        }
        return $data;
    }

    function reportD6($id = '')//for excel
    {
       // $id=(!is_array($id))?array($id):$id;
        $results = $this->report_model->getImpvPlace_Info($id);
        if(!$results){
            return null;
        }

        $data = array();
        $rows = array();
        if(!is_array($results)){
            $rows[]=$results;
        }else{
            $rows=$results;
        }
        foreach ($rows as $index=>$result){
            $new=array();
            $new[]=$index+1;
            $new[]=dateTH($result->date_of_svy);
            $person = $this->report_model->getPersInfo($result->pers_id);
            $new[]=$person->pid;
            $new[]=$person->prename_th.$person->pers_firstname_th." ".$person->pers_lastname_th;
            $new[]=dateTH($person->date_of_birth);
            $new[]=dateTH($person->date_of_death);
            $new[]=($person)?age($person->date_of_birth):"";
            $gender = "";
            if($person){
                if($person->gender_code==0){
                    $gender = "ไม่ทราบ";
                }elseif($person->gender_code==1){
                    $gender = "ชาย";
                }elseif($person->gender_code==2){
                    $gender = "หญิง";
                }elseif($person->gender_code==9){
                    $gender = "ไม่สามารถระบุได้";
                }}
            $new[]= $gender;
            $addr = $this->report_model->getAddr($person->pre_addr_id);
            $new[]=@$addr->addr_home_no;
            $new[]= @$addr->addr_moo;
            $new[]= @$addr->alley;
            $new[]=@$addr->addr_lane;
            $new[]= @$addr->addr_road;
            $new[]=@$addr->locality;
            $new[]= @$addr->district;
            $new[]=@$addr->province;
            // $new[]=@$addr->addr_zipcode;
            $new[]=$person->tel_no_mobile;
            $member=$this->report_model->getMember($result->impv_place_id);
            $new[]=count($member);
            $new[]=$result->ptype_title." ".$result->ptype_code_remark;
            $new[]=$result->staff_review;
            $new[]=dateTH($result->date_of_svy);

             $person = $this->report_model->getPersInfo($result->cns_pers_id);
            $new[]=$person->pid;
            $new[]=$person->prename_th.$person->pers_firstname_th." ".$person->pers_lastname_th;
            $new[]=dateTH($person->date_of_birth);
            $new[]=dateTH($person->date_of_death);
            $new[]=($person)?age($person->date_of_birth):"";
            $gender = "";
            if($person){
                if($person->gender_code==0){
                    $gender = "ไม่ทราบ";
                }elseif($person->gender_code==1){
                    $gender = "ชาย";
                }elseif($person->gender_code==2){
                    $gender = "หญิง";
                }elseif($person->gender_code==9){
                    $gender = "ไม่สามารถระบุได้";
                }
            }
            $new[]= $gender;
            $new[]= $result->cns_status;
            $new[]= $result->cns_relation;
            $new[]=$person->tel_no_mobile;
            $new[]=dateTH($result->date_of_consi);
            $new[]=$result->consi_result.' '.$result->consi_result_remark;
            $new[]=dateTH($result->date_of_finish);
            $new[]=$result->case_budget;

            array_push($data,$new);
        }
        return $data;
    }
    function reportE0($id = '')//for excel
    {
       // $id=(!is_array($id))?array($id):$id;
        $results = $this->report_model->getWisdInfo($id);
        if(!$results){
            return null;
        }


        $data = array();
        $rows = array();
        if(!is_array($results)){
            $rows[]=$results;
        }else{
            $rows=$results;
        }
        foreach ($rows as $index=>$result) {
            $new = array();
            $new[] = $index + 1;
            $new[]=dateTH($result->date_of_reg);
            $person = $this->report_model->getPersInfo($result->pers_id);
            $new[]=$person->pid;
            $new[]=$person->prename_th.$person->pers_firstname_th." ".$person->pers_lastname_th;
            $new[]=dateTH($person->date_of_birth);
            $new[]=dateTH($person->date_of_death);
            $new[]=($person)?age($person->date_of_birth):"";
            $gender = "";
            if($person){
                if($person->gender_code==0){
                    $gender = "ไม่ทราบ";
                }elseif($person->gender_code==1){
                    $gender = "ชาย";
                }elseif($person->gender_code==2){
                    $gender = "หญิง";
                }elseif($person->gender_code==9){
                    $gender = "ไม่สามารถระบุได้";
                }
            }
            $new[]= $gender;
            $addr = $this->report_model->getAddr($person->pre_addr_id);
            $new[]=@$addr->addr_home_no;
            $new[]= @$addr->addr_moo;
            $new[]= @$addr->alley;
            $new[]=@$addr->addr_lane;
            $new[]= @$addr->addr_road;
            $new[]=@$addr->locality;
            $new[]= @$addr->district;
            $new[]=@$addr->province;
            // $new[]=@$addr->addr_zipcode;
            $new[]=$person->tel_no_mobile;
            $new[]=$person->marital_status;
            $edu = $person->edu;
            if($person->edu_identify){
                $edu.=" ".$person->edu_identify;
            }
            $new[]=$edu;
            $new[]=$person->occupation;
            $new[]=$person->mth_avg_income;
            $incomefrom = $person->src_of_income;
            if($person->src_of_income_identify){
                $incomefrom.=" ".$person->src_of_income_identify;
            }
            $new[]= $incomefrom;
            $branchs=$this->report_model->getLastWisdBranch($result->knwl_id);
            $new[]= count($branchs);
            if($branchs){
                $last=array_pop($branchs);
                $new[]=dateTH(substr($last->insert_datetime,0,10));
                $new[]=$last->wis_name;
                $new[]=$last->wisd_sp_title;
            }else{
                $new[]="";
                $new[]="";
                $new[]="";
            }
            array_push($data,$new);
        }

        return $data;
    }
    function reportF0($id = '')//for excel
    {
        //$id=(!is_array($id))?array($id):$id;
        $results = $this->report_model->getVoltInfo($id);
        if(!$results){
            return null;
        }

        $data = array();
        $rows = array();
        if(!is_array($results)){
            $rows[]=$results;
        }else{
            $rows=$results;
        }
        foreach ($rows as $index=>$result) {
            $new = array();
            $new[] = $index + 1;
            $new[]=dateTH($result->date_of_reg);
            $person = $this->report_model->getPersInfo($result->pers_id);
            $new[]=$person->pid;
            $new[]=$person->prename_th.$person->pers_firstname_th." ".$person->pers_lastname_th;
            $new[]=dateTH($person->date_of_birth);
            $new[]=dateTH($person->date_of_death);
            $new[]=($person)?age($person->date_of_birth):"";
            $gender = "";
            if($person){
                if($person->gender_code==0){
                    $gender = "ไม่ทราบ";
                }elseif($person->gender_code==1){
                    $gender = "ชาย";
                }elseif($person->gender_code==2){
                    $gender = "หญิง";
                }elseif($person->gender_code==9){
                    $gender = "ไม่สามารถระบุได้";
                }
            }
            $new[]= $gender;
            $addr = $this->report_model->getAddr($person->pre_addr_id);
            $new[]=@$addr->addr_home_no;
            $new[]= @$addr->addr_moo;
            $new[]= @$addr->alley;
            $new[]=@$addr->addr_lane;
            $new[]= @$addr->addr_road;
            $new[]=@$addr->locality;
            $new[]= @$addr->district;
            $new[]=@$addr->province;
            // $new[]=@$addr->addr_zipcode;
            $new[]=$person->tel_no_mobile;
            $edu = $person->edu;
            if($person->edu_identify){
                $edu.=" ".$person->edu_identify;
            }
            $new[]=$edu;
            $new[]=$result->older_care_training.' '.$result->older_care_training_identify;
            $new[]=dateTH($result->date_of_training);
            $new[]=$result->older_care_training_org;
            $new[]=$result->older_care_training_course;
            $care=$this->report_model->getElderlyCare($result->volt_id);
            $new[]=count($care);

        array_push($data,$new);
        }
        return $data;
    }
    function reportJ0($id = '')//for excel
    {
       // $id=(!is_array($id))?array($id):$id;
        $results = $this->report_model->getPersInfo($id);
        if(!$results){
            return null;
        }

        $data = array();
        $rows = array();
        if(!is_array($results)){
            $rows[]=$results;
        }else{
            $rows=$results;
        }
        foreach ($rows as $index=>$person) {
            $new=array();
            $new[] = $index + 1;
            $new[]=dateTH(substr($person->insert_datetime,0,10));
            $new[]=$person->pid;
            $new[]=$person->prename_th.$person->pers_firstname_th." ".$person->pers_lastname_th;
            $new[]=dateTH($person->date_of_birth);
            $new[]=dateTH($person->date_of_death);
            $new[]=($person)?age($person->date_of_birth):"";
            $gender = "";
            if($person){
                if($person->gender_code==0){
                    $gender = "ไม่ทราบ";
                }elseif($person->gender_code==1){
                    $gender = "ชาย";
                }elseif($person->gender_code==2){
                    $gender = "หญิง";
                }elseif($person->gender_code==9){
                    $gender = "ไม่สามารถระบุได้";
                }
            }
            $new[]= $gender;
            $new[]=$person->nation;
            $new[]=$person->relg;
            $new[]=$person->father_pid;
            $new[]=$person->mother_pid;
            $addr = $this->report_model->getAddr($person->reg_addr_id);
            $new[]=@$addr->addr_code;
            $new[]=@$addr->addr_home_no;
            $new[]= @$addr->addr_moo;
            $new[]= @$addr->alley;
            $new[]=@$addr->addr_lane;
            $new[]= @$addr->addr_road;
            $new[]=@$addr->locality;
            $new[]= @$addr->district;
            $new[]=@$addr->province;
            $addr = $this->report_model->getAddr($person->pre_addr_id);
            $new[]=@$addr->addr_code;
            $new[]=@$addr->addr_home_no;
            $new[]= @$addr->addr_moo;
            $new[]= @$addr->alley;
            $new[]=@$addr->addr_lane;
            $new[]= @$addr->addr_road;
            $new[]=@$addr->locality;
            $new[]= @$addr->district;
            $new[]=@$addr->province;

            $new[]=$person->pre_addr_status;
            $new[]=$person->pre_addr_estate." ".$person->pre_addr_estate_identify;;
            $new[]=$person->tel_no;
            $new[]=@$person->tel_no_mobile;
            $new[]=@$person->fax_no;
            $new[]=@$person->email_addr;
            $new[]=$person->marital_status;
            $new[]=$person->edu;
            $new[]=$person->occupation;
            $new[]=$person->mth_avg_income;
            $new[]=$person->src_of_income." ".$person->src_of_income_identify;
            $familys = $this->report_model->getFamily($person->pers_id);

            $new[]=count($familys);
            $new[]=$person->healthy;
            $new[]=$person->healthy_self_help;
            $new[]=$person->healthy_congenital_disease;
            $new[]=$person->healthy_drug_allergy;
            $new[]=$person->dept_status;
            $new[]=$person->dept_loan_system;
            $new[]=$person->dept_loan_shark;

            $staff = $this->report_model->getStaff($person->update_user_id);
            $new[]=@$staff->prename.@$staff->user_firstname." ".@$staff->user_lastname;
            $org=$this->report_model->getOrg($person->update_org_id);
            $new[]=@$org->org_title;
            if($person->update_datetime){
                list($d,$t)=explode(' ',$person->update_datetime);
                $new[]=dateTH($d)." ".$t;
            }else{
                $new[]="";
            }


            array_push($data,$new);
        }

        return $data;
    }
    function reportG0($id =''){//for excel
        //$id=(!is_array($id))?array($id):$id;
        $results = $this->report_model->getSchInfo($id);
        if(!$results){
            return null;
        }

        $data = array();
        $rows = array();
        if(!is_array($results)){
            $rows[]=$results;
        }else{
            $rows=$results;
        }
        foreach ($rows as $index=>$result) {
            $new = array();
            $new[] = $index + 1;
            $new[] = $result->schl_name;
            $new[] = "";
            $model=$this->report_model->getSchModel($result->schl_id);
            $new[] = ($model)?"ใช่":"ไม่ใช่";
            $new[] = @$model->mdl_grp;
            $new[] = $result->schl_established_year;
            $new[] = $result->addr_home_no;
            $new[] = $result->addr_moo;
            $new[] = $result->alley;
            $new[] = $result->addr_lane;
            $new[] = $result->addr_road;
            $new[] = $result->locality;
            $new[] = $result->district;
            $new[] = $result->province;
            $new[] = $result->addr_zipcode;
            $new[] = $result->addr_gps;
            $new[] = $result->tel_no;
            $new[] = @$result->fax_no;
            $new[] = @$result->email_addr;
            $new[] = $result->agency_org;
            $contact=$this->report_model->getSchInfoContacts($result->schl_id);
            $new[] =@$contact->sch_cnt_name;
            $new[] =@$contact->sch_cnt_title;
            $new[] =@$contact->tel_no_mobile;
            $gen=$this->report_model->getSchInfoGeneration($result->schl_id);
            $stu=$this->report_model->getSchInfoStu($result->schl_id);
            $new[] =count($gen);
            $new[] =count($stu);
            array_push($data,$new);
        }
        return $data;
    }
    function reportH0($m,$y){//for excel
        $start=9;
        $results = $this->report_model->statThaiPopulation($m,$y);

        if(!$results){
            return null;
        }
        $row = array();
        $total =0;
        $stop =$start-1;
        foreach ($results as $index=>$result) {
            $total_male =0;
            $total_female =0;
            $total_ =0;
            $stop++;
            $new = array();
            $new[] = $index + 1;
            $new[] = $result->province;
            $male_less46=$result->male_less1;
            $female_less46=$result->female_less1;
                for($i=1;$i<46;$i++){
                    $male="male_{$i}";
                    $female="male_{$i}";
                    $male_less46+=$result->$male;
                    $female_less46+=$result->$female;
                }
            $new[] =$male_less46;
            $new[] =$female_less46;
            $new[] =$male_less46+$female_less46;
            $total_male +=$male_less46;
            $total_female +=$female_less46;
            $total_ +=$male_less46+$female_less46;
            for($y=46;$y<=100;$y+=5) {
                $male_val = 0;
                $female_val = 0;
                for ($i = $y; $i < $y+5; $i++) {
                    $male = "male_{$i}";
                    $female = "female_{$i}";
                    $male_val += $result->$male;
                    $female_val += $result->$female;
                }
                $new[] = $male_val;
                $new[] = $female_val;
                $new[] = $male_val + $female_val;

                $total_male +=$male_val;
                $total_female += $female_val;
                $total_ += $male_val + $female_val;
            }
            $new[] =$result->male_over100;
            $new[] =$result->female_over100;
            $new[] =$result->male_over100+$result->female_over100;
            $total_male +=$result->male_over100;
            $total_female +=$result->female_over100;
            $total_ +=$result->male_over100+$result->female_over100;

            $new[] =$total_male;
            $new[] =$total_female;
            $new[] =$total_;
            $total+=$total_;

            array_push($row,$new);
        }
        $new = array();
        $new[]="";
        $new[]="รวม";
        for($c=2;$c<=43;$c++){
           $col=$this->getIntToChar($c);
            $new[]="=SUM({$col}{$start}:{$col}{$stop})";
        }

        array_push($row,$new);
        return array('row'=>$row,'total'=>$total);
     }
    function reportL0($id =array()){//for excel
        //$id=(!is_array($id))?array($id):$id;
        $results = $this->report_model->getJobVacancy($id);

        if(!$results){
            return null;
        }

        $data = array();
        $rows = array();
        if(!is_array($results)){
            $rows[]=$results;
        }else{
            $rows=$results;
        }
        foreach ($rows as $index=>$result) {
            $new = array();
            $new[] = $index + 1;
            $new[]=dateTH($result->date_of_post);
            $new[]=$result->posi_type_title;
            $new[]=$result->posi_title;
            $new[]=$result->posi_workday." ".$result->posi_work_day_identify;
            $new[]=$result->edu_title;
            $new[]=$result->exp_name;
            $new[]=$result->posi_experience;
            $new[]=$result->org_title;
            $new[]=$result->org_type;
            $new[]=$result->locality;
            $new[]=$result->district;
            $new[]=$result->province;
            $new[]=$result->post_status;


            array_push($data,$new);
        }
        return $data;
    }
    function reportL1($id = array())//for excel
    {
        //$id=(!is_array($id))?array($id):$id;
        $results = $this->report_model->getJobInfo($id);
        if(!$results){
            return null;
        }

        $data = array();
        $rows = array();
        if(!is_array($results)){
            $rows[]=$results;
        }else{
            $rows=$results;
        }
        foreach ($rows as $index=>$result) {
            $new=array();
            $new[] = $index + 1;
            $new[]=dateTH($result->date_of_reg);
            $person = $this->report_model->getPersInfo($result->pers_id);
            $new[]=$person->pid;
            $new[]=$person->prename_th.$person->pers_firstname_th." ".$person->pers_lastname_th;
            $new[]=dateTH($person->date_of_birth);
            $new[]=dateTH($person->date_of_death);
            $new[]=($person)?age($person->date_of_birth):"";
            $gender = "";
            if($person){
                if($person->gender_code==0){
                    $gender = "ไม่ทราบ";
                }elseif($person->gender_code==1){
                    $gender = "ชาย";
                }elseif($person->gender_code==2){
                    $gender = "หญิง";
                }elseif($person->gender_code==9){
                    $gender = "ไม่สามารถระบุได้";
                }
            }
            $new[]= $gender;
            $addr = $this->report_model->getAddr($person->pre_addr_id);
            $new[]=@$addr->addr_home_no;
            $new[]= @$addr->addr_moo;
            $new[]= @$addr->alley;
            $new[]=@$addr->addr_lane;
            $new[]= @$addr->addr_road;
            $new[]=@$addr->locality;
            $new[]= @$addr->district;
            $new[]=@$addr->province;

            $new[]=$result->exp_name;
            $new[]=$result->org_type;
            $new[]=$result->reg_status;


            array_push($data,$new);
        }

        return $data;
    }
    function reportA1($id)
    {
        $diffInfo = $this->report_model->getDiff_Info($id);

        if ($diffInfo == null) {
            return null;
        }
        $result = new stdClass();
        $result->inform_date = dateTH($diffInfo->date_of_req,' ','long');

        $result->no = $this->report_model->calDiff_no($diffInfo);
        list($result->year) = explode('-', $diffInfo->date_of_req);
        $result->year += 543;
        $person = $this->report_model->getPersInfo($diffInfo->req_pers_id);
        $result->prename = @$person->prename_th;
        $result->name = @$person->pers_firstname_th;
        $result->surname = @$person->pers_lastname_th;
        $result->idcard = @$person->pid;
        $result->position = $diffInfo->req_position;
        if(@$person->date_of_birth != '' && checkdate(iconv_substr(@$person->date_of_birth,5,2,'utf-8'),iconv_substr(@$person->date_of_birth,8,2,'utf-8'),iconv_substr(@$person->date_of_birth,0,4,'utf-8'))){
            $result->birth = dateTH(@$person->date_of_birth,' ','long');
        }
        else {
            $birthdate = iconv_substr(@$person->date_of_birth,0,4,'utf-8')+543; 
            $result->birth = '0/0/'.$birthdate;
        }
        $result->age = age(@$person->date_of_birth);
        $result->citizenship = @$person->nation;
        $result->religion = @$person->relg;
        $result->image = @$person->img_file;

        $result->org = $diffInfo->req_org;
        $result->visit_channel ="";
        if($diffInfo->visit_channel=="Mobile"){
            $result->visit_channel=  "โทรศัพท์";
        }else if($diffInfo->visit_channel=="PC") {
            $result->visit_channel="คอมพิวเตอร์";
        }
        $result->addr = new stdClass();

        $addr = $this->report_model->getAddr(@$person->reg_addr_id);
        $result->addr->no = @$addr->addr_home_no;
        $result->addr->moo = @$addr->addr_moo;
        $result->addr->lane = @$addr->alley;
        $result->addr->side_street = @$addr->addr_lane;
        $result->addr->street = @$addr->addr_road;
        $result->addr->locality = @$addr->locality;
        $result->addr->district = @$addr->district;
        $result->addr->province = @$addr->province;
        $result->addr->postcode = @$addr->addr_zipcode;
        $result->phone = @$person->tel_no;

        $result->email = @$person->email_addr;
        $result->survey_date = dateTH($diffInfo->date_of_visit,' ','long');

        $person = $this->report_model->getPersInfo($diffInfo->pers_id);
        $result->req = new stdClass();

        $result->req->prename = @$person->prename_th;
        $result->req->name = @$person->pers_firstname_th;
        $result->req->surname = @$person->pers_lastname_th;
        $result->req->idcard = @$person->pid;
        $result->req->image = @$person->img_file;
        $result->req->edu = @$person->edu;
        $result->req->idcard_ext = "";

        $result->req->birth = dateTH(@$person->date_of_birth,' ','long');
        $result->req->age = age(@$person->date_of_birth);
        $result->req->sex = sex(@$person->gender_code);
        $result->req->nationality = @$person->nation;
        $result->req->citizenship = @$person->nation;
        $result->req->religion = @$person->relg;
        $result->req->status = @$person->marital_status;
        
        if(@$person->occupation != 'อื่นๆ'){
            $result->req->job = @$person->occupation;
        }
        else{
            $result->req->job = @$person->other_occupation;
        }
  
        $result->req->income = number_format(@$person->mth_avg_income);
        $result->req->income_type = @$person->src_of_income;
        $result->req->income_desc = @$person->src_of_income_identify;
        $result->req->congenital_disease = @$person->healthy_congenital_disease;
        $result->req->drug_allergy = @$person->healthy_drug_allergy;


        $addr = $this->report_model->getAddr(@$person->reg_addr_id);
        $result->req->addr = new stdClass();
        $result->req->addr->type = @$person->pre_addr_status;
        if(@$person->reg_addr_id == @$person->pre_addr_id){
            $result->req->addr->addr_status=  "1";
        }
        else{
            $result->req->addr->addr_status = "0";
        }
        //$result->req->addr->status = @$person->pre_addr_id;
        $result->req->addr->no = @$addr->addr_home_no;
        $result->req->addr->moo = @$addr->addr_moo;
        $result->req->addr->lane = @$addr->alley;
        $result->req->addr->side_street = @$addr->addr_lane;
        $result->req->addr->street = @$addr->addr_road;
        $result->req->addr->locality = @$addr->locality;
        $result->req->addr->district = @$addr->district;
        $result->req->addr->province = @$addr->province;
        $result->req->addr->postcode = @$addr->addr_zipcode;
        $result->req->addr->phone = @$person->tel_no;
        $result->req->addr->phone_ex = "";
        $result->req->addr->mobile = @$person->tel_no;

        $addr = $this->report_model->getAddr($person->pre_addr_id);
        $result->req->addr2 = new stdClass();
        $result->req->addr2->type = 1;
        $result->req->addr2->no = @$addr->addr_home_no;
        $result->req->addr2->moo = @$addr->addr_moo;
        $result->req->addr2->lane = @$addr->alley;
        $result->req->addr2->side_street = @$addr->addr_lane;
        $result->req->addr2->street = @$addr->addr_road;
        $result->req->addr2->locality = @$addr->locality;
        $result->req->addr2->district = @$addr->district;
        $result->req->addr2->province = @$addr->province;
        $result->req->addr2->postcode = @$addr->addr_zipcode;

        $result->req->addr2->phone = @$person->tel_no;
        $result->req->addr2->phone_ex = "";
        $result->req->addr2->mobile = @$person->tel_no_mobile;
        $result->req->addr2->fax = @$person->fax_no;
        $result->req->addr2->email = @$person->email_addr;


        $familys = $this->report_model->getFamily($person->pers_id);
        foreach ($familys as $family) {
            $result->family[] = (object)array(
                'idcard' => $family->pid,
                'name' => $family->prename_th . $family->pers_firstname_th . ' ' . $family->pers_lastname_th,
                'age' => $family->age,
                'relation' => $family->fml_relation,
                'job' => $family->occupation,
                'income' => ($family->mth_avg_income) ? number_format($family->mth_avg_income) : '',
                'health' => $family->healthy,
                'self' => $family->healthy_self_help
            );
        }


        $result->visit = $diffInfo->visit_place;
        $result->visit_desc = $diffInfo->visit_place_identify;
        $items = $this->report_model->getTrouble($diffInfo->diff_id);
        $result->opinion = array();
        foreach ($items as $item) {
            $chk = ($item->diff_id) ? 1 : 0;
            $result->opinion[] = (object)array('check' => $chk, 'title' => $item->trb_title, 'remark' => $item->trb_remark);
        }

        $items = $this->report_model->getHelp($diffInfo->diff_id);
        $result->helpresult = array();
        foreach ($items as $item) {
            $chk = ($item->diff_id) ? 1 : 0;
            $result->helpresult[] = (object)array('check' => $chk, 'title' => $item->help_title, 'remark' => $item->help_remark);
        }

        $items = $this->report_model->getHelpGuide($diffInfo->diff_id);
        $result->nexthelpdesk = array();
        foreach ($items as $item) {
            $chk = ($item->diff_id) ? 1 : 0;
            $result->nexthelpdesk[] = (object)array('check' => $chk, 'title' => $item->help_guide_title, 'remark' => $item->help_guide_remark);
        }

        // $staff=$this->report_model->getStaff($diffInfo->insert_user_id);
        $result->staffname = '';//$staff->user_firstname.' '.$staff->user_lastname;
        $result->staffposition = '';//$staff->user_position;

        $result->debt = $person->dept_status;
        $result->debt1 = ($person->dept_loan_system) ? number_format($person->dept_loan_system) : '';
        $result->debt2 = ($person->dept_loan_shark) ? number_format($person->dept_loan_shark) : '';



        return $result;
    }
    function reportB1($id)
    {
        $diffInfo = $this->report_model->getAdm_Info($id);

        if ($diffInfo == null) {
            return null;
        }
        $result = new stdClass();
        $result->inform_date = dateTH($diffInfo->date_of_req,' ','long');
        $person = $this->report_model->getPersInfo($diffInfo->req_pers_id);

        list($result->year) = explode('-', $diffInfo->date_of_req);
        $result->year += 543;
        $result->prename = $person->prename_th;
        $result->name = $person->pers_firstname_th;
        $result->surname = $person->pers_lastname_th;
        $result->idcard = $person->pid;
        $result->position = $diffInfo->req_position;
        $result->birth = dateTH($person->date_of_birth,' ','long');
        $result->age = age($person->date_of_birth);
        $result->citizenship = $person->nation;
        $result->religion = $person->relg;
        $result->image = $diffInfo->adm_req_photo_file;

        $result->org = $diffInfo->req_org;
        $result->visit_channel =$diffInfo->chn_name;

        $result->adm_date =dateTH($diffInfo->date_of_adm,' ','long');

        $result->adm_reason =$this->report_model->getCaseReasonName( $diffInfo->adm_case_reason_code);
        $result->adm_reason =($result->adm_reason=='อื่น ๆ')?$diffInfo->adm_case_reason_identify:$result->adm_reason;
        //adm_case_reason_identify
        $result->belonging_with =$diffInfo->belonging_with;
        $result->case_history =$diffInfo->case_history;

        $result->dis_date =dateTH($diffInfo->date_of_dis,' ','long');
        $result->dis_reason =$this->report_model->getDisCaseReasonName( $diffInfo->dis_case_reason_code);
        $result->dis_reason =($result->dis_reason=='อื่น ๆ')?$diffInfo->dis_case_reason_identify:$result->dis_reason;
        //


        $result->addr = new stdClass();

        $addr = $this->report_model->getAddr($person->reg_addr_id);
        $result->addr->no = @$addr->addr_home_no;
        $result->addr->moo = @$addr->addr_moo;
        $result->addr->lane = @$addr->alley;
        $result->addr->side_street = @$addr->addr_lane;
        $result->addr->street = @$addr->addr_road;
        $result->addr->locality = @$addr->locality;
        $result->addr->district = @$addr->district;
        $result->addr->province = @$addr->province;
        $result->addr->postcode = @$addr->addr_zipcode;
        $result->phone = @$person->tel_no;



        $person = $this->report_model->getPersInfo($diffInfo->pers_id);
        $result->req = new stdClass();

        $result->req->prename = $person->prename_th;
        $result->req->name = $person->pers_firstname_th;
        $result->req->surname = $person->pers_lastname_th;
        $result->req->idcard = $person->pid;
        $result->req->image = $diffInfo->adm_photo_file;
        $result->req->edu = $person->edu;
        $result->req->idcard_ext = "";

        $health_info =  $this->report_model->test($diffInfo->pers_id);
        $result->req->pers_congenital_disease = $health_info->pers_congenital_disease;
        $result->req->pers_drug_allergy = $health_info->pers_drug_allergy;

        $result->req->birth = dateTH($person->date_of_birth,' ','long');
        $result->req->age = age($person->date_of_birth);
        $result->req->sex = sex($person->gender_code);
        $result->req->nationality = $person->nation;
        $result->req->citizenship = $person->nation;
        $result->req->religion = $person->relg;
        $result->req->status = $person->marital_status;
        if($person->occupation != 'อื่นๆ'){
            $result->req->job = $person->occupation;
        }
        else{
            $result->req->job = $person->other_occupation;
        }
       
        $result->req->income = number_format($person->mth_avg_income);
        $result->req->income_type = $person->src_of_income;
        $result->req->income_desc = $person->src_of_income_identify;

        $addr = $this->report_model->getAddr($person->reg_addr_id);
        $result->req->addr = new stdClass();
        if($person->reg_addr_id == $person->pre_addr_id){
            $result->req->addr->type = 1;
        }
        else{
            $result->req->addr->type = 0;
        }
        
        $result->req->addr->no = @$addr->addr_home_no;
        $result->req->addr->moo = @$addr->addr_moo;
        $result->req->addr->lane = @$addr->alley;
        $result->req->addr->side_street = @$addr->addr_lane;
        $result->req->addr->street = @$addr->addr_road;
        $result->req->addr->locality = @$addr->locality;
        $result->req->addr->district = @$addr->district;
        $result->req->addr->province = @$addr->province;
        $result->req->addr->postcode = @$addr->addr_zipcode;
        $result->req->addr->phone = @$diffInfo->tel_no;
        $result->req->addr->phone_ex = "";
        $result->req->addr->mobile = @$diffInfo->mobile;

        $addr = $this->report_model->getAddr($person->pre_addr_id);
        $result->req->addr2 = new stdClass();
        $result->req->addr2->type = 1;
        $result->req->addr2->no = @$addr->addr_home_no;
        $result->req->addr2->moo = @$addr->addr_moo;
        $result->req->addr2->lane = @$addr->alley;
        $result->req->addr2->side_street = @$addr->addr_lane;
        $result->req->addr2->street = @$addr->addr_road;
        $result->req->addr2->locality = @$addr->locality;
        $result->req->addr2->district = @$addr->district;
        $result->req->addr2->province = @$addr->province;
        $result->req->addr2->postcode = @$addr->addr_zipcode;

        $result->req->addr2->phone = @$person->tel_no;
        $result->req->addr2->phone_ex = "";
        $result->req->addr2->mobile = @$person->tel_no_mobile;
        $result->req->addr2->fax = @$person->fax_no;
        $result->req->addr2->email = @$person->email_addr;

        $result->family=array();
        $familys = $this->report_model->getFamily($person->pers_id);
        foreach ($familys as $family) {
            $result->family[] = (object)array(
                'idcard' => $family->pid,
                'name' => $family->prename_th . $family->pers_firstname_th . ' ' . $family->pers_lastname_th,
                'age' => $family->age,
                'relation' => $family->fml_relation,
                'job' => $family->occupation,
                'income' => ($family->mth_avg_income) ? number_format($family->mth_avg_income) : '',
                'health' => $family->healthy,
                'self' => $family->healthy_self_help
            );
        }



        $items=$this->report_model->getPerDisability($diffInfo->pers_id);
        $result->disability = array();
        foreach ($items as $item) {
            $chk = ($item->id) ? 1 : 0;
            $result->disability[] = (object)array('check' => $chk, 'title' => $item->title, 'remark' => $item->remark);
        }

        return $result;
    }
    function reportB3($id){
        $diffInfo = $this->report_model->getAdm_Info($id);

        if ($diffInfo == null) {
            return null;
        }


        $data = $this->report_model->getAdmIrpByPerson($diffInfo->pers_id);
        if ($data == null) {
            return null;
        }
        $result = new stdClass();
        $result->date=dateTH($data->date_of_irp,' ','long');
        $result->irp_name=$data->irp_name;
        $result->nurse_name=$data->nurse_name;
        $result->almoner_name=$data->almoner_name;
        $person = $this->report_model->getPersInfo($diffInfo->pers_id);
        $result->per = new stdClass();
        $result->per->prename = $person->prename_th;
        $result->per->name = $person->pers_firstname_th;
        $result->per->surname = $person->pers_lastname_th;
        $result->per->idcard = $person->pid;
        $result->per->birth = dateTH($person->date_of_birth,' ','long');
        $result->per->age = age($person->date_of_birth);
        $result->per->sex = sex($person->gender_code);
        $result->per->nationality = $person->nation;
        $result->per->religion = $person->relg;
        $result->per->status = $person->marital_status;
        $result->irp=$this->report_model->getStdIrpAns(0,$data->irp_id);
//        echo "<pre>";
//        print_r($result->irp);
        return $result;
    }
    function reportA2($id)
    {
        $diffInfo = $this->report_model->getDiff_Info($id);

        if ($diffInfo == null) {
            return null;
        }

        $result = new stdClass();

        $result->date = dateTH($diffInfo->date_of_req);
        $person = $this->report_model->getPersInfo($diffInfo->pers_id);
        $result->prename = $person->prename_th;
        $result->name = $person->pers_firstname_th;
        $result->surname = $person->pers_lastname_th;
        $result->idcard = $person->pid;


        $result->org = $diffInfo->req_org;
        $addr = $this->report_model->getAddr($person->pre_addr_id);
        $result->addr = new stdClass();

        $result->addr->no = @$addr->addr_home_no;
        $result->addr->moo = @$addr->addr_moo;
        $result->addr->lane = @$addr->alley;
        $result->addr->side_street = @$addr->addr_lane;
        $result->addr->street = @$addr->addr_road;
        $result->addr->locality = @$addr->locality;
        $result->addr->district = @$addr->district;
        $result->addr->province = @$addr->province;
        $result->addr->postcode = @$addr->addr_zipcode;
        $result->phone = @$person->tel_no;


        $result->amount = ($diffInfo->pay_amount) ? number_format($diffInfo->pay_amount) : "";
        $result->sign1 = $person->pers_firstname_th." ".$person->pers_lastname_th ;
        $result->sign2 = "";
        $result->sign3 = "";
        $result->sign4 = "";
        return $result;
    }
    function reportA3($id)
    {
        $diffInfo = $this->report_model->getDiff_Info($id);

        if ($diffInfo == null) {
            return null;
        }
        $result = new stdClass();
        $result->date = dateTH($diffInfo->date_of_req);
        $person = $this->report_model->getPersInfo($diffInfo->pers_id);
        $result->prename = $person->prename_th;
        $result->name = $person->pers_firstname_th;
        $result->surname = $person->pers_lastname_th;
        $result->idcard = $person->pid;
        $result->birth = dateTH($person->date_of_birth);
        $result->age = age($person->date_of_birth);

        $result->org = $diffInfo->req_org;
        $result->fromorg = "กลุ่มการคลังและพัสดุ กรมกิจการผู้สูงอายุ";
        $addr = $this->report_model->getAddr($person->pre_addr_id);
        $result->addr = new stdClass();
        $result->addr->no = @$addr->addr_home_no;
        $result->addr->moo = @$addr->addr_moo;
        $result->addr->lane = @$addr->alley;
        $result->addr->side_street = @$addr->addr_lane;
        $result->addr->street = @$addr->addr_road;
        $result->addr->locality = @$addr->locality;
        $result->addr->district = @$addr->district;
        $result->addr->province = @$addr->province;


        $result->to = new stdClass();
        $result->to->name = "";
        $result->to->surname = "";
        $result->to->position = "";

        $result->to->addr = new stdClass();
        $result->to->addr->text = "";
        $result->to->addr->no = "";
        $result->to->addr->moo = "";
        $result->to->addr->lane = "";
        $result->to->addr->side_street = "";
        $result->to->addr->street = "";
        $result->to->addr->locality = "";
        $result->to->addr->district = "";
        $result->to->addr->province = "";
        $result->amount = ($diffInfo->pay_amount) ? number_format($diffInfo->pay_amount) : "";
        $result->amounttext = ($diffInfo->pay_amount) ? ThaiBahtConversion($diffInfo->pay_amount) : "";

        $result->sign1 = "";
        $result->sign2 = "";
        $result->sign3 = "";
        return $result;
    }
    function reportA4($id)
    {
        $result = new stdClass();
        $diffInfo = $this->report_model->getDiff_Info($id);

        if ($diffInfo == null) {
            return null;
        }
        list($y, $m, $d) = explode('-', $diffInfo->date_of_req);

        $result->date = new stdClass();
        $result->date->day = $d;
        $result->date->month = monthName($m);
        $result->date->year = $y + 543;


        $person = $this->report_model->getPersInfo($diffInfo->pers_id);
        $result->prename = $person->prename_th;
        $result->name = $person->pers_firstname_th;
        $result->surname = $person->pers_lastname_th;


        $result->addr = new stdClass();
        $addr = $this->report_model->getAddr($person->pre_addr_id);
        $result->addr = new stdClass();
        $result->addr->no = @$addr->addr_home_no;
        $result->addr->moo = @$addr->addr_moo;
        $result->addr->lane = @$addr->alley;
        $result->addr->side_street = @$addr->addr_lane;
        $result->addr->street = @$addr->addr_road;
        $result->addr->locality = @$addr->locality;
        $result->addr->district = @$addr->district;
        $result->addr->province = @$addr->province;
        $result->addr->postcode = @$addr->addr_zipcode;
        $result->phone = $person->tel_no;


        $result->org = $diffInfo->req_org;
        $result->job = $person->occupation;
        $result->job_other = $person->other_occupation;
        $result->money = ($person->mth_avg_income) ? number_format($person->mth_avg_income) : "";

        $result->recived = "";
        $result->recived_org = "";

        $result->like = "";
        $result->comment = "";
        $result->notlike = "";

        $result->notlike_desc[0] = "";
        $result->notlike_desc[1] = " ";
        $result->notlike_desc[2] = " ";
        $result->notlike_desc[3] = " ";

        return $result;
    }
    function reportC1($id)
    {
        $fnrlInfo = $this->report_model->getFnrl_Info($id);
        if ($fnrlInfo == null) {
            return null;
        }
        $result = new stdClass();
        $result->date = new stdClass();

        list($y, $m, $d) = explode('-', $fnrlInfo->date_of_req);

        $result->date = new stdClass();
        $result->date->day = ((int)$d) ? $d : "";
        $result->date->month = ((int)$m) ? monthName($m) : "";
        $result->date->year = ((int)$y) ? $y + 543 : '';
        $person = $this->report_model->getPersInfo($fnrlInfo->req_pers_id);
        

        $org_info   =  $this->report_model->getOrg($fnrlInfo->insert_org_id);
        $result->org_title = $org_info->org_title;
        $result->org = $fnrlInfo->req_org;
        $result->prename = $person->prename_th;
        $result->name = $person->pers_firstname_th;
        $result->surname = $person->pers_lastname_th;
        $result->age = age($person->date_of_birth);
        $result->date_of_birth = dateTH($person->date_of_birth);
        $result->idcard = $person->pid;
        $result->idcard_by = "";
        $result->idcard_date = "";
        $result->idcard_exp = "";
        $result->job = $person->occupation;
        $addr = $this->report_model->getAddr($person->reg_addr_id);
        $result->addr = new stdClass();
        $result->addr->no = @$addr->addr_home_no;
        $result->addr->moo = @$addr->addr_moo;
        $result->addr->lane = @$addr->alley;
        $result->addr->side_street = @$addr->addr_lane;
        $result->addr->street = @$addr->addr_road;
        $result->addr->locality = @$addr->locality;
        $result->addr->district = @$addr->district;
        $result->addr->province = @$addr->province;
        $result->addr->postcode = @$addr->addr_zipcode;
        $result->phone = $person->tel_no_home;
        $result->mobile = @$person->tel_no;
        $result->relation = @$fnrlInfo->req_relation;

        $person = $this->report_model->getPersInfo($fnrlInfo->pers_id);

        $result->dead = new stdClass();
        $result->dead->prename = $person->prename_th;
        $result->dead->name = $person->pers_firstname_th;
        $result->dead->surname = $person->pers_lastname_th;
        $result->dead->idcard = $person->pid;
        $result->dead->date_of_birth = dateTH($person->date_of_birth);
        $result->dead->age = age($person->date_of_birth);
        $result->dead->idcard_by = "";
        $result->dead->idcard_date = "";
        $result->dead->idcard_exp = "";

        //present address for dead

        $pre_addr = $this->report_model->getAddr($person->pre_addr_id);

        $result->dead->pre_addr         = new stdClass();
        $result->dead->pre_addr->no     = @$pre_addr->addr_home_no;
        $result->dead->pre_addr->moo    = @$pre_addr->addr_moo;
        $result->dead->pre_addr->lane   = @$pre_addr->alley;
        $result->dead->pre_addr->side_street = @$pre_addr->addr_lane;
        $result->dead->pre_addr->street   = @$pre_addr->addr_road;
        $result->dead->pre_addr->locality = @$pre_addr->locality;
        $result->dead->pre_addr->district = @$pre_addr->district;
        $result->dead->pre_addr->province = @$pre_addr->province;
        $result->dead->pre_addr->postcode = @$pre_addr->addr_zipcode;

        //register address for dead
        $addr = $this->report_model->getAddr($person->reg_addr_id);

        $result->dead->addr = new stdClass();
        $result->dead->addr->no = @$addr->addr_home_no;
        $result->dead->addr->moo = @$addr->addr_moo;
        $result->dead->addr->lane = @$addr->alley;
        $result->dead->addr->side_street = @$addr->addr_lane;
        $result->dead->addr->street = @$addr->addr_road;
        $result->dead->addr->locality = @$addr->locality;
        $result->dead->addr->district = @$addr->district;
        $result->dead->addr->province = @$addr->province;
        $result->dead->addr->postcode = @$addr->addr_zipcode;
        $result->dead->phone = $person->tel_home_no;
        $result->dead->mobile = @$person->tel_no;
        
       

        //$cause_of_death =$this->report_model->getDeathCause($fnrlInfo->death_cause);
        if($fnrlInfo->death_cause == '009'){
            $result->dead->desc = $fnrlInfo->death_cause_identify;
        }
        else{
           // $result->dead->desc = $cause_of_death->cause_of_death;
            $result->dead->desc =$this->report_model->getDeathCause($fnrlInfo->death_cause);
        }
        //
        list($y, $m, $d) = explode('-', $person->date_of_death);


        $result->dead->date_of_death = dateTH($person->date_of_death);
        $result->dead->day = ((int)$d) ? $d : "";
        $result->dead->month = ((int)$m) ? monthName($m) : "";
        $result->dead->year = ((int)$y) ? $y + 543 : '';
        $result->dead->doc_no = $fnrlInfo->death_certificate_no;
        $result->dead->doc_by = $fnrlInfo->death_certificate_org;

        list($yy, $mm, $dd) = explode('-', $fnrlInfo->date_of_death_certificate);
        $result->dead->doc_date = dateTH($fnrlInfo->date_of_death_certificate);
        $result->dead->doc->day = ((int)$dd) ? $dd : "";
        $result->dead->doc->month = ((int)$mm) ? monthName($mm) : "";
        $result->dead->doc->year = ((int)$yy) ? $yy + 543 : '';

        //date_of_req_pers_aprv
        list($yyy, $mmm, $ddd) = explode('-', $fnrlInfo->date_of_req_pers_aprv);
        $result->accept->doc_date = dateTH($fnrlInfo->date_of_req_pers_aprv);
        $result->accept->doc->day = ((int)$ddd) ? $ddd : "";
        $result->accept->doc->month = ((int)$mmm) ? monthName($mmm) : "";
        $result->accept->doc->year = ((int)$yyy) ? $yyy + 543 : '';


        //
        $person = $this->report_model->getPersInfo($fnrlInfo->req_pers_aprv_pers_id);
        $result->aprv = new stdClass();
        $result->aprv->org = $fnrlInfo->req_pers_aprv_org;
        $result->aprv->prename = $person->prename_th;
        $result->aprv->name = $person->pers_firstname_th;
        $result->aprv->surname = $person->pers_lastname_th;
        $result->aprv->position = $fnrlInfo->req_pers_aprv_position;
        $result->aprv->org = $fnrlInfo->req_pers_aprv_org;
        $result->aprv->idcard = $person->pid;
        $result->aprv->date_of_birth = dateTH($person->date_of_birth);
        $result->aprv->date_of_req_pers_aprv = dateTH($fnrlInfo->date_of_req_pers_aprv);

        $addr = $this->report_model->getAddr($person->reg_addr_id);

        $result->aprv->addr = new stdClass();
        $result->aprv->addr->no = @$addr->addr_home_no;
        $result->aprv->addr->moo = @$addr->addr_moo;
        $result->aprv->addr->lane = @$addr->alley;
        $result->aprv->addr->side_street = @$addr->addr_lane;
        $result->aprv->addr->street = @$addr->addr_road;
        $result->aprv->addr->locality = @$addr->locality;
        $result->aprv->addr->district = @$addr->district;
        $result->aprv->addr->province = @$addr->province;
        $result->aprv->addr->postcode = @$addr->addr_zipcode;
        $result->aprv->phone = $person->tel_no_home;
        $result->aprv->mobile = $person->tel_no;



        //
        $person = $this->report_model->getPersInfo($fnrlInfo->not_survey_aprv_pers_id);
        $result->aprv2 = new stdClass();
        $result->aprv2->org = $fnrlInfo->not_survey_aprv_org;
        $result->aprv2->prename = @$person->prename_th;
        $result->aprv2->name = @$person->pers_firstname_th;
        $result->aprv2->surname = @$person->pers_lastname_th;
        $result->aprv2->position = $fnrlInfo->not_survey_aprv_position;
        $result->aprv2->org = $fnrlInfo->not_survey_aprv_org;
        $result->aprv2->idcard = @$person->pid;
        $result->aprv2->date_of_birth = dateTH(@$person->date_of_birth);
        $result->aprv2->date_of_not_survey_aprv = dateTH($fnrlInfo->date_of_not_survey_aprv);

        $addr = $this->report_model->getAddr(@$person->reg_addr_id);

        $result->aprv2->addr = new stdClass();
        $result->aprv2->addr->no = @$addr->addr_home_no;
        $result->aprv2->addr->moo = @$addr->addr_moo;
        $result->aprv2->addr->lane = @$addr->alley;
        $result->aprv2->addr->side_street = @$addr->addr_lane;
        $result->aprv2->addr->street = @$addr->addr_road;
        $result->aprv2->addr->locality = @$addr->locality;
        $result->aprv2->addr->district = @$addr->district;
        $result->aprv2->addr->province = @$addr->province;
        $result->aprv2->addr->postcode = @$addr->addr_zipcode;
        $result->aprv2->phone = @$person->tel_no;
        $result->aprv2->mobile = @$person->tel_no_mobile;

        return $result;
    }
    function reportC2($id)
    {
        $result = new stdClass();
        if ($result == null) {
            return null;
        }
        $fnrlInfo = $this->report_model->getFnrl_Info($id);
        $d=$m=$y="";
        if($fnrlInfo->date_of_req_pers_aprv){
            list($y, $m, $d) = explode('-', $fnrlInfo->date_of_req_pers_aprv);
        }

        $result->date = new stdClass();
        $result->date->day = ((int)$d) ? $d : "";
        $result->date->month = ((int)$m) ? monthName($m) : "";
        $result->date->year = ((int)$y) ? $y + 543 : '';


        $person = $this->report_model->getPersInfo($fnrlInfo->not_survey_aprv_pers_id);

        $result->org = $fnrlInfo->not_survey_aprv_org;

        $result->prename = $person->prename_th;
        $result->name = $person->pers_firstname_th;
        $result->surname = $person->pers_lastname_th;
        $result->position = $fnrlInfo->not_survey_aprv_position;
        $result->age = age($person->date_of_birth);
        $result->idcard = $person->pid;

        $result->idcard_by = $fnrlInfo->death_certificate_org;
        $result->idcard_date = $fnrlInfo->date_of_death_certificate;
        $result->idcard_exp = "";
        $addr = $this->report_model->getAddr($person->reg_addr_id);
        $result->addr = new stdClass();
        $result->addr->no = @$addr->addr_home_no;
        $result->addr->moo = @$addr->addr_moo;
        $result->addr->village = '';//
        $result->addr->lane = @$addr->alley;
        $result->addr->side_street = @$addr->addr_lane;
        $result->addr->street = @$addr->addr_road;
        $result->addr->locality = @$addr->locality;
        $result->addr->district = @$addr->district;
        $result->addr->province = @$addr->province;
        $result->addr->postcode = @$addr->addr_zipcode;
        $result->phone = $person->tel_no_home;
        $result->mobile = $person->tel_no;


        return $result;
    }
    function reportC3($id)
    {
        $fnrlInfo = $this->report_model->getFnrl_Info($id);
        if ($fnrlInfo == null) {
            return null;
        }
        $result = new stdClass();
        list($y, $m, $d) = explode('-', $fnrlInfo->date_of_pay);

        $result->date = new stdClass();

        $result->date->day = ((int)$d) ? $d : "";
        $result->date->month = ((int)$m) ? monthName($m) : "";
        $result->date->year = ((int)$y) ? $y + 543 : '';


        $person = $this->report_model->getPersInfo($fnrlInfo->req_pers_id);
        $result->org = $fnrlInfo->req_org;
        $result->prename = $person->prename_th;
        $result->name = $person->pers_firstname_th;
        $result->surname = $person->pers_lastname_th;


        $addr = $this->report_model->getAddr($person->reg_addr_id);
        $result->addr = new stdClass();
        $result->addr->no = @$addr->addr_home_no;
        $result->addr->moo = @$addr->addr_moo;
        $result->addr->lane = @$addr->alley;
        $result->addr->side_street = @$addr->addr_lane;
        $result->addr->street = @$addr->addr_road;
        $result->addr->locality = @$addr->locality;
        $result->addr->district = @$addr->district;
        $result->addr->province = @$addr->province;

        $result->dead = new stdClass();
        $person = $this->report_model->getPersInfo($fnrlInfo->pers_id);
        $result->dead->prename = $person->prename_th;
        $result->dead->name = $person->pers_firstname_th;
        $result->dead->surname = $person->pers_lastname_th;


        $result->money = number_format($fnrlInfo->pay_amount);
        $result->moneytext = ThaiBahtConversion($fnrlInfo->pay_amount);

        $result->staff = new stdClass();
        $result->staff->prename = "";
        $result->staff->name = "";
        $result->staff->surname = "";

        return $result;
    }
    function reportD1($id)
    {
        $impvHome = $this->report_model->getImpvPlace_Info($id);
        if ($impvHome == null) {
            return null;
        }
        $result = new stdClass();
        $person = $this->report_model->getPersInfo($impvHome->pers_id);

        $result->idcard = $person->pid;
        $result->prename = $person->prename_th;
        $result->name = $person->pers_firstname_th;
        $result->surname = $person->pers_lastname_th;
       
        if($person->occupation != 'อื่นๆ'){
            $result->job = $person->occupation;
        }
        else{
            $result->job = $person->other_occupation;
        }
        $result->age = age($person->date_of_birth);

        $result->salary = ($person->mth_avg_income) ? number_format($person->mth_avg_income) : '';
        $addr = $this->report_model->getAddr($person->pre_addr_id);
        $result->addr = new stdClass();
        $result->addr->no = @$addr->addr_home_no;
        $result->addr->moo = @$addr->addr_moo;
        $result->addr->lane = @$addr->alley;
        $result->addr->side_street = @$addr->addr_lane;
        $result->addr->street = @$addr->addr_road;
        $result->addr->locality = @$addr->locality;
        $result->addr->district = @$addr->district;
        $result->addr->province = @$addr->province;
        $result->addr->phone = $person->tel_no;

        $result->addr->type = $impvHome->cns_status;
        $result->addr->other = $impvHome->cns_relation;

        $result->home_status = 1;
        $result->home = '';
        $items = $this->report_model->getImpvHomeCondition($impvHome->imp_home_id);
        $result->conditions = array();
        foreach ($items as $item) {
            $chk = ($item->id) ? 1 : 0;
            $result->conditions[] = (object)array('check' => $chk, 'title' => $item->title, 'remark' => $item->remark);
        }

        $result->land_own = $impvHome->land_tenure;
        $result->land = $impvHome->land_tenure_remark;
        $result->comment_type = $impvHome->staff_review;
        $result->comment_type1 = ($result->comment_type == 'เห็นควรให้ความช่วยเหลือ') ? $impvHome->staff_review_remark : '';
        $result->comment_type2 = ($result->comment_type == 'เห็นควรให้ความช่วยเหลืออย่างเร่งด่วน') ? $impvHome->staff_review_remark : '';

        $result->staff = new stdClass();

        $result->staff->name = "";
        $result->staff->surname = "";
        $result->staff->position = "";
        $result->date = dateTH($impvHome->date_of_svy);
        $result->familys = array();
        $familys = $this->report_model->getFamily($person->pers_id);
        if ($familys) {
            foreach ($familys as $index => $family) {
                $result->familys[] = (object)array(
                    'no' => $index + 1,
                    'idcard' => $family->pid,
                    'name' => $family->prename_th . $family->pers_firstname_th . ' ' . $family->pers_lastname_th,
                    'age' => $family->age,
                    'relation' => $family->fml_relation,
                    'job' => $family->occupation,
                    'income' => ($family->mth_avg_income) ? number_format($family->mth_avg_income) : '',
                    'health' => $family->healthy,
                    'educate' => $family->edu_title,
                    'comment' => ''
                );
            }
        } else {
            $result->familys[] = (object)array(
                'no' => '&nbsp',
                'idcard' => '',
                'name' => '',
                'age' => '',
                'relation' => '',
                'job' => '',
                'income' => '',
                'health' => '',
                'educate' => '',
                'comment' => ''
            );
        }


        return $result;
    }
    function reportD2($id)
    {
        $impvHome = $this->report_model->getImpvPlace_Info($id);
        if ($impvHome == null) {
            return null;
        }
        $result = new stdClass();

        list($y, $m, $d) = explode('-', $impvHome->date_of_consi);
        $result->date = new stdClass();
        $result->date->day = ((int)$d) ? $d : "";
        $result->date->month = ((int)$m) ? monthName($m) : "";
        $result->date->year = ((int)$y) ? $y + 543 : '';

        $person = $this->report_model->getPersInfo($impvHome->cns_pers_id);

        $org_info   =  $this->report_model->getOrg($impvHome->insert_org_id);
        $result->org_title = $org_info->org_title;


        $result->name = $person->prename_th . $person->pers_firstname_th;
        $result->surname = $person->pers_lastname_th;
        $result->age = age($person->date_of_birth);
        $result->owner = $impvHome->cns_status;
        $result->relation = $impvHome->cns_relation;
        $result->relation_other = '';
        
        $addr = $this->report_model->getAddr($person->pre_addr_id);
        $result->addr = new stdClass();
        $result->addr->no = @$addr->addr_home_no;
        $result->addr->moo = @$addr->addr_moo;
        $result->addr->lane = @$addr->alley;
        $result->addr->side_street = @$addr->addr_lane;
        $result->addr->street = @$addr->addr_road;
        $result->addr->locality = @$addr->locality;
        $result->addr->district = @$addr->district;
        $result->addr->province = @$addr->province;


        $person = $this->report_model->getPersInfo($impvHome->pers_id);

        $result->oldman = $person->prename_th . $person->pers_firstname_th . ' ' . $person->pers_lastname_th;
        $result->delegate = $impvHome->cns_delegate;


        
        return $result;
    }
    function reportD3($id)
    {
        $impvPlace = $this->report_model->getImpvPlaceInfo($id);
        if ($impvPlace == null) {
            return null;
        }
        $result = new stdClass();
        $person = $this->report_model->getPersInfo($impvPlace->pers_id);

        $result->idcard = $person->pid;
        $result->prename = $person->prename_th;
        $result->name = $person->pers_firstname_th;
        $result->surname = $person->pers_lastname_th;
        $result->job = $person->occupation;
        $result->age = age($person->date_of_birth);
        $result->salary = ($person->mth_avg_income) ? number_format($person->mth_avg_income) : '';

        $addr = $this->report_model->getAddr($person->pre_addr_id);
        $result->addr = new stdClass();
        $result->addr->no = @$addr->addr_home_no;
        $result->addr->moo = @$addr->addr_moo;
        $result->addr->lane = @$addr->alley;
        $result->addr->side_street = @$addr->addr_lane;
        $result->addr->street = @$addr->addr_road;
        $result->addr->locality = @$addr->locality;
        $result->addr->district = @$addr->district;
        $result->addr->province = @$addr->province;
        $result->addr->phone = $person->tel_no_mobile;

        $result->placetype = array();
        $placetypes = $this->report_model->placetype();

        foreach ($placetypes as $placetype) {
            $result->placetype[] = (object)array('check' => ($placetype->ptype_code == $impvPlace->ptype_code), 'title' => $placetype->ptype_title);
        }

        $result->ptype_remark = $impvPlace->ptype_code_remark;
        $items = $this->report_model->getImpvPlaceCondition($impvPlace->impv_place_id);
        $result->conditions = array();
        foreach ($items as $item) {
            $chk = ($item->id) ? 1 : 0;
            $result->conditions[] = (object)array('check' => $chk, 'title' => $item->title, 'remark' => $item->remark);
        }


        $result->comment_type = $impvPlace->staff_review;
        $result->comment_type1 = ($result->comment_type == 'เห็นควรให้ความช่วยเหลือ') ? $impvPlace->staff_review_remark : '';
        $result->comment_type2 = ($result->comment_type == 'เห็นควรให้ความช่วยเหลืออย่างด่วน') ? $impvPlace->staff_review_remark : '';


        $result->staff = new stdClass();
        $result->staff->name = "";
        $result->staff->surname = "";
        $result->staff->position = "";
        $result->date = dateTH($impvPlace->date_of_svy);
        $result->members = array();
        $familys = $this->report_model->getMember($impvPlace->impv_place_id);
//        $result->members[]=(object)array('no'=>1,'name'=>"สมปอง มาดี1",'age'=>'10','job'=>"",'educate'=>'','health'=>'');
//        $result->members[]=(object)array('no'=>2,'name'=>"สมปอง มาดี2",'age'=>'20','job'=>"",'educate'=>'','health'=>'');
//        $result->members[]=(object)array('no'=>3,'name'=>"สมปอง มาดี3",'age'=>'30','job'=>"",'educate'=>'','health'=>'');
        if ($familys) {
            foreach ($familys as $index => $family) {
                $result->members[] = (object)array(
                    'no' => $index + 1,
                    'idcard' => $family->pid,
                    'name' => $family->prename_th . $family->pers_firstname_th . ' ' . $family->pers_lastname_th,
                    'age' => age($family->date_of_birth),

                    'job' => $family->occupation,
                    'income' => ($family->mth_avg_income) ? number_format($family->mth_avg_income) : '',
                    'health' => $family->healthy,
                    'educate' => $family->edu_title,
                    'comment' => ''
                );
            }
        } else {
            $result->members[] = (object)array(
                'no' => '&nbsp',
                'idcard' => '',
                'name' => '',
                'age' => '',

                'job' => '',
                'income' => '',
                'health' => '',
                'educate' => '',
                'comment' => ''
            );
        }


        return $result;

    }
    function reportD4($id)
    {
        $impvPlace = $this->report_model->getImpvPlaceInfo($id);
        if ($impvPlace == null) {
            return null;
        }
        $result = new stdClass();
        $result->date = new stdClass();

        list($y, $m, $d) = explode('-', $impvPlace->date_of_svy);
        $result->date = new stdClass();
        $result->date->day = ((int)$d) ? $d : "";
        $result->date->month = ((int)$m) ? monthName($m) : "";
        $result->date->year = ((int)$y) ? $y + 543 : '';
        $person = $this->report_model->getPersInfo($impvPlace->cns_pers_id);
        $result->org = "";

        $result->name = @$person->prename_th . @$person->pers_firstname_th;
        $result->surname = @$person->pers_lastname_th;
        $result->age = @age($person->date_of_birth);
        $result->owner = @$impvPlace->cns_status;
        $result->relation = @$impvPlace->cns_relation;
        $result->relation_other = '';

        $person = $this->report_model->getPersInfo($impvPlace->pers_id);


        $result->oldman = $person->prename_th . $person->pers_firstname_th . ' ' . $person->pers_lastname_th;
        $result->delegate = $impvPlace->cns_delegate;


        $addr = $this->report_model->getAddr($person->pre_addr_id);
        $result->addr = new stdClass();
        $result->addr->no = @$addr->addr_home_no;
        $result->addr->moo = @$addr->addr_moo;
        $result->addr->lane = @$addr->alley;
        $result->addr->side_street = @$addr->addr_lane;
        $result->addr->street = @$addr->addr_road;
        $result->addr->locality = @$addr->locality;
        $result->addr->district = @$addr->district;
        $result->addr->province = @$addr->province;
        return $result;
    }
    function reportD5($id)
    {
        $impvPlace = $this->report_model->getImpvPlaceInfo($id);
        if ($impvPlace == null) {
            return null;
        }
        $result = new stdClass();
        list($y, $m, $d) = explode('-', $impvPlace->date_of_svy);
        $result->date = new stdClass();
        $result->date->day = ((int)$d) ? $d : "";
        $result->date->month = ((int)$m) ? monthName($m) : "";
        $result->date->year = ((int)$y) ? $y + 543 : '';


        $result->staff = new stdClass();
        $result->staff->idcard = "";
        $result->staff->name = "";
        $result->staff->surname = "";
        $result->staff->position = "";

        $person = $this->report_model->getPersInfo($impvPlace->cns_pers_id);
        $result->org = "";

        $result->name = $person->prename_th . $person->pers_firstname_th;
        $result->surname = $person->pers_lastname_th;
        $result->age = '';


        $person = $this->report_model->getPersInfo($impvPlace->pers_id);


        $result->oldman = $person->prename_th . $person->pers_firstname_th . ' ' . $person->pers_lastname_th;
        $result->delegate = $impvPlace->cns_delegate;


        return $result;
    }
    function reportE1($id)
    {

        $wisdInfo = $this->report_model->getWisdInfo($id);
        if ($wisdInfo == null) {
            return null;
        }
        $result = new stdClass();
        $result->province = "";

        $result->date = dateTH($wisdInfo->date_of_reg);
        $person = $this->report_model->getPersInfo($wisdInfo->pers_id);
        $result->idcard = $person->pid;
        $result->img = $person->img_file;
        $result->name = @$person->prename_th . @$person->pers_firstname_th;
        $result->surname = @$person->pers_lastname_th;

        $result->birth = dateTH($person->date_of_birth);
        $result->age = age($person->date_of_birth);

        $result->idcard_addr = "";
        $result->idcard_date = "";
        $result->idcard_exp = "";
        $result->nationality = "";
        $result->citizenship = $person->nation;
        $result->religion = $person->relg;
        $result->phone = $person->tel_no;
        $result->fax = @$person->fax_no;
        $result->mobile = @$person->tel_no_mobile;
        $result->email = @$person->email_addr;

        $result->addr = $this->setAddr($this->report_model->getAddr($person->reg_addr_id));
        $result->addr2 = $this->setAddr($this->report_model->getAddr($person->pre_addr_id));

        $result->status = $person->marital_status;
        $result->status_other = "";
        $items = $this->report_model->getEducation($person->edu_code);

        $result->edu = array();
        foreach ($items as $item) {
            $chk = ($item->id) ? 1 : 0;
            $result->edu[] = (object)array('check' => $chk, 'title' => $item->title, 'remark' => ($item->code == "007") ? $person->edu_identify : "");
        }

        $result->job = $person->occupation;
        $result->job_desc = "";
        $result->job_old = "";
        $result->job_old_desc = "";
        $items = $this->report_model->getWisdBranch($wisdInfo->knwl_id);
        $result->experts = array();
        foreach ($items as $item) {
            $chk = ($item->id) ? 1 : 0;
            $result->experts[] = (object)array('check' => $chk, 'other' => ($item->code == '023') ? true : false, 'title' => $item->title, 'desc' => $item->desc);
        }


        return $result;
    }
    function reportF2($id)
    {
        $data=$this->report_model->getVoltInfo($id);
        if ($data == null) {
            return null;
        }
        $result = new stdClass();
        $result->number = "";
        $result->gov = "";
        $result->province = "";
        $person=$this->report_model->getPersInfo($data->pers_id);
        $result->sex = $person->gender_code;
        $result->name = @$person->prename_th .$person->pers_firstname_th;
        $result->surname = $person->pers_lastname_th;
        $result->age = age($person->date_of_birth);
        $result->org = "";
        $items = $this->report_model->getEducation($person->edu_code);

        $result->edu = array();
        foreach ($items as $item) {
            $chk = ($item->id) ? 1 : 0;
            $result->edu[] = (object)array('check' => $chk, 'title' => $item->title, 'remark' => ($item->code == "007") ? $person->edu_identify : "");
        }
        $items=$this->report_model->getVillagePosition($data->volt_id);



        $result->job = $person->occupation;
        $result->job_other = $person->occupation;


        $result->pos=array();
        foreach ($items as $item) {
            $chk = ($item->id) ? 1 : 0;
            $result->pos[] = (object)array('check' => $chk, 'title' => $item->title, 'remark' => $item->remark);
        }



        $result->experience = age($data->date_of_reg);
        $result->caring = $data->older_care_training;
        $result->caring1 = $data->older_care_training_identify;
        $result->caring2 = "";
        $diff=yeardiff($data->date_of_training);
        $result->train = @$diff['value'];
        $result->train_unit = @$diff['unit'];
        $result->comment = "";

        $carings = $this->report_model->getElderlyCare($data->volt_id);
        $result->carings=array();
        if($carings){
            foreach ($carings as $index => $caring) {
                $result->carings[] = (object)array(
                    'name' => $caring->prename_th . $caring->pers_firstname_th . ' ' . $caring->pers_lastname_th,
                    'age' => age($caring->date_of_birth),
                    'count' => $caring->care_freq,
                    'count_per' => $caring->care_freq_per,
                );
            }
        }else{
            for ($i=0;$i<3;$i++) {
                $result->carings[] = (object)array(
                    'name' => '&nbsp',
                    'age' => '',
                    'count' => '',
                    'count_per' => '',
                );
            }
        }



        $result->check[] = (object)array('title' => "เยี่ยมเยียนดูแลทุกข์สุข", 'check' => 1, 'comment' => '');
        $result->check[] = (object)array('title' => "ดูแลอาหารการกิน", 'check' => 0, 'comment' => '');

        $result->check[] = (object)array('title' => "ดูแลเรื่องการใช้ยา", 'check' => 0, 'comment' => '');
        $result->check[] = (object)array('title' => "ช่วยเรื่องออกกำลังกาย", 'check' => 0, 'comment' => '');
        $result->check[] = (object)array('title' => "พาไปหาหมอ", 'check' => 1, 'comment' => '');
        $result->check[] = (object)array('title' => "พาหมอมาตรวจรักษาที่บ้าน", 'check' => 1, 'comment' => '');
        $result->check[] = (object)array('title' => "พาไปร่วมกิจกรรมในชุมชน", 'check' => 0, 'comment' => '');
        $result->check[] = (object)array('title' => "พาไปพักผ่อนนอกบ้าน", 'check' => 0, 'comment' => '');
        $result->check[] = (object)array('title' => "พาไปร่วมกิจกรรมทางศาสนา", 'check' => 0, 'comment' => '');
        $result->check[] = (object)array('title' => "ช่วยปรับสภาพบ้าน บริเวณบ้าน หรือซ่อมบ้านให้เหมาะสมกับผู้สูงอายุ", 'check' => 0, 'comment' => '');
        $result->check[] = (object)array('title' => "รวมกลุ่มผู้สูงอายุทำกิจกรรม", 'check' => 0, 'comment' => '');
        $result->check[] = (object)array('title' => "ให้ความรู้แก่ผู้สูงอายุและครอบครัว", 'check' => 0, 'comment' => '');
        $result->check[] = (object)array('title' => "ให้คำปรึกษาแก่ผู้สูงอายุเมื่อเกิดปัญหา", 'check' => 0, 'comment' => '');
        $result->check[] = (object)array('title' => "ให้ความรู้เกี่ยวกับสิทธิและการเข้าถึงสิทธิ", 'check' => 0, 'comment' => '');
        $result->check[] = (object)array('title' => "ให้ข้อมูลบริการที่เป็นประโยชน์ต่อผู้สูงอายุ", 'check' => 0, 'comment' => '');
        $result->check[] = (object)array('title' => "ประสานหน่วยงานให้ความช่วยเหลือผู้สูงอายุ", 'check' => 0, 'comment' => '');
        $result->check[] = (object)array('title' => "เก็บข้อมูลผู้สูงอายุ", 'check' => 0, 'comment' => '');
        $result->check[] = (object)array('title' => "เฝ้าระวังปัญหาแก่ผู้สูงอายุ", 'check' => 0, 'comment' => '');
        $result->check[] = (object)array('title' => "พาไปทำกิจธุระ หรือไปทำกิจธุระแทนผู้สูงอายุ", 'check' => 0, 'comment' => '');
        $result->check[] = (object)array('title' => "จัดกิจกรรมที่เป็นประโยชน์แก่ผู้สูงอายุ", 'check' => 0, 'comment' => '');


        return $result;
    }
    function reportG6($id,$date="")
    {
        $result = new stdClass();
        $stu=$this->report_model->getStudent($id);
        if ($stu == null) {
            return null;
        }
        $person=$this->report_model->getPersInfo($stu->pers_id);
        $result->date = new stdClass();
        $result->school =$stu->schl_name;
        $result->name = @$person->prename_th .$person->pers_firstname_th.' '.$person->pers_lastname_th;

        $result->cer_name = '';
        $result->cer_no = digiTh($stu->gen_code);
        $result->cer_year = digiTh($stu->year_of_study+543);
        if(!$date){
            $date=date('Y-m-d');
        }
        list($y, $m, $d) = explode('-',$date);


        $result->date->day = ((int)$d) ?digiTh( (int)$d) : "";
        $result->date->month = ((int)$m) ? monthName($m) : "";
        $result->date->year = ((int)$y) ? digiTh($y + 543) : '';
        $result->sing1 = "";
        $result->sing2 = "";


        return $result;
    }
    function reportG7($id,$date="")
    {
        $result = new stdClass();
        if(!$date){
            $date=date('Y-m-d');
        }
        $person=$this->report_model->getSchInfoContacts($id);
//        if ($person == null) {
//            return null;
//        }
        $result->name = @$person->sch_cnt_name;

        $result->date=digiTh(dateTH($date,' ','long'));
    
        $result->sing = "อดุลย์   แสงสิงแก้ว";
        $result->singpre = "พลตำรวจเอก";
        $result->pos = "รัฐมนตรีว่าการกระทรวงการพัฒนาสังคมและความมั่นคงของมนุษย์";
        return $result;

    }
    function reportJ1($id){
        $person = $this->report_model->getPersInfo($id);
        if ($person == null) {
            return null;
        }
        $result = new stdClass();

        $result->date =dateTH(date('Y-m-d H:i:s'),' ','long');
        $result->prename = $person->prename_th;
        $result->name = $person->pers_firstname_th;
        $result->surname = $person->pers_lastname_th;
        $result->idcard = $person->pid;

        $result->father_pin = $person->father_pid;
        $result->mother_pin = $person->mother_pid;


        $result->birth = dateTH($person->date_of_birth,' ','long');
        $result->age = age($person->date_of_birth);

        $result->gender = "";
        if($person->gender_code==0){
            $result->gender = "ไม่ทราบ";
        }elseif($person->gender_code==1){
            $result->gender = "ชาย";
        }elseif($person->gender_code==2){
            $result->gender = "หญิง";
        }elseif($person->gender_code==9){
            $result->gender = "ไม่สามารถระบุได้";
        }
        $result->citizenship = ( $person->nation)?$person->nation:"(ไม่ระบุ)";
        $result->religion = ( $person->relg)?$person->relg:"(ไม่ระบุ)";
        $result->image = $person->img_file;

        $result->addr = new stdClass();

        $addr = $this->report_model->getAddr($person->reg_addr_id);
        $result->addr->code = (@$addr->addr_code)?$addr->addr_code:"-";
        $result->addr->no = (@$addr->addr_home_no)?$addr->addr_home_no:"-";
        $result->addr->moo = (@$addr->addr_moo)?$addr->addr_moo:"-";
        $result->addr->lane = (@$addr->alley)?$addr->alley:"-";
        $result->addr->side_street = (@$addr->addr_lane)?$addr->addr_lane:"-";
        $result->addr->street = (@$addr->addr_road)?$addr->addr_road:"-";
        $result->addr->locality = (@$addr->locality)?$addr->locality:"-";
        $result->addr->district = (@$addr->district)?$addr->district:"-";
        $result->addr->province = (@$addr->province)?$addr->province:"-";
        $result->addr->postcode = (@$addr->addr_zipcode)?$addr->addr_zipcode:"-";

        $result->addr->land_size =(@$addr->living_size)?$addr->living_size:"-";
        $result->addr->land_holding_no =(@$addr->land_holding_no)?$addr->land_holding_no:"-";
        $result->addr->land_gps =(@$addr->addr_gps)?$addr->addr_gps:"-";


        $addr = $this->report_model->getAddr($person->pre_addr_id);
        $result->addr2 = new stdClass();
        $result->addr2->code = (@$addr->addr_code)?$addr->addr_code:"-";
        $result->addr2->no = (@$addr->addr_home_no)?$addr->addr_home_no:"-";
        $result->addr2->moo = (@$addr->addr_moo)?$addr->addr_moo:"-";
        $result->addr2->lane = (@$addr->alley)?$addr->alley:"-";
        $result->addr2->side_street = (@$addr->addr_lane)?$addr->addr_lane:"-";
        $result->addr2->street = (@$addr->addr_road)?$addr->addr_road:"-";
        $result->addr2->locality = (@$addr->locality)?$addr->locality:"-";
        $result->addr2->district = (@$addr->district)?$addr->district:"-";
        $result->addr2->province = (@$addr->province)?$addr->province:"-";
        $result->addr2->postcode = (@$addr->addr_zipcode)?$addr->addr_zipcode:"-";

        $result->addr2->land_size =(@$addr->living_size)?$addr->living_size:"-";
        $result->addr2->land_holding_no =(@$addr->land_holding_no)?$addr->land_holding_no:"-";
        $result->addr2->land_gps =(@$addr->addr_gps)?$addr->addr_gps:"-";

        $result->pre_addr_status=$person->pre_addr_status;
        $result->pre_addr_estate=$person->pre_addr_estate;
        if( $person->pre_addr_estate_identify){
            $result->pre_addr_estate.= "( {$person->pre_addr_estate_identify} )";
        }




        $result->phone =@$person->tel_no;

        $result->status = $person->marital_status;
        $result->edu = $person->edu;
        if($person->edu_identify){
            $result->edu.=" ".$person->edu_identify;
        }
        $result->job = $person->occupation;
        $result->income =($person->mth_avg_income)?number_format($person->mth_avg_income):'';
        $result->incomefrom = $person->src_of_income;
        if($person->src_of_income_identify){
            $result->incomefrom.=" ".$person->src_of_income_identify;
        }
        $result->family=array();
        $familys = $this->report_model->getFamily($person->pers_id);
        $sum=$person->mth_avg_income;
        foreach ($familys as $family) {
            $sum+=$family->mth_avg_income;
            $result->family[] = (object)array(
                'idcard' => $family->pid,
                'name' => $family->prename_th . $family->pers_firstname_th . ' ' . $family->pers_lastname_th,
                'age' => $family->age,
                'relation' => $family->fml_relation,
                'job' => $family->occupation,
                'income' => ($family->mth_avg_income) ? number_format($family->mth_avg_income) : '',
                'health' => $family->healthy,
                'self' => $family->healthy_self_help
            );
        }
        $avg=$sum/(count($familys)+1);
        $result->incomefamiry=($avg)?number_format($avg):"";
        $result->healthy=$person->healthy;
        $result->healthy_self_help=$person->healthy_self_help;
        $result->healthy_congenital_disease=$person->healthy_congenital_disease;
        $result->healthy_drug_allergy=$person->healthy_drug_allergy;

        $result->dept_status=$person->dept_status;
        $result->dept_loan_system=($person->dept_loan_system)?number_format($person->dept_loan_system):"-";
        $result->dept_loan_shark=($person->dept_loan_shark)?number_format($person->dept_loan_shark):"-";
        list($date,$time)=explode(' ',($person->update_datetime)?$person->update_datetime:$person->insert_datetime);
        $result->update_time=dateTH($date)." เวลา ".$time.' น.';
        $staff=$this->report_model->getStaff($person->update_user_id);
        $result->update_by=($staff)?$staff->prename.$staff->user_firstname." ".$staff->user_lastname:" ";

        $result->hisdiffs=array();
        $items      = $this->report_model->getHisDiffinfo($person->pers_id);
        foreach ($items as $item){
            $org=$this->report_model->getOrg($item->insert_org_id);
            $result->hisdiffs[]=(object)array(
                'date'=>dateTH($item->date_of_req,' ','long'),
                'date_servey'=>dateTH($item->date_of_visit,' ','long'),
                'date_recive'=>dateTH($item->date_of_pay,' ','long'),
                'org'=>$org->org_title,
                'pay'=>($item->pay_amount)?number_format($item->pay_amount):""
            );
        }

        $result->adms=array();
        $items = $this->report_model->getHisAdmInfo($person->pers_id);
        foreach ($items as $item){
                $rip=$this->report_model->getLastIrp($person->pers_id);
                $org=$this->report_model->getOrg($item->insert_org_id);
            $score="";
                if($rip){
                    $ripscore=$this->report_model->getIrpScore($rip->irp_id);
                    $score="กลุ่ม {$ripscore->group} ({$ripscore->percent}%)"; ;
                }

            $result->adms[]=(object)array(
                'date'=>dateTH($item->date_of_req,' ','long'),
                'date_chkin'=>dateTH($item->date_of_adm,' ','long'),
                'date_chkout'=>dateTH($item->date_of_dis,' ','long'),
                'org'=>$org->org_title,
                'score'=>$score
            );
        }

        $result->fnrls=array();
        $items = $this->report_model->getHisFnrlInfo($person->pers_id);
        foreach ($items as $item){
            $req_pers=$this->report_model->getPersInfo($id);
            $org=$this->report_model->getOrg($item->insert_org_id);
            $result->fnrls[]=(object)array(
                'date'=>dateTH($item->date_of_req,' ','long'),
                'date_recive'=>dateTH($item->date_of_pay,' ','long'),
                'name'=>$req_pers->prename_th.$req_pers->pers_firstname_th.' '.$req_pers->pers_lastname_th,
                'org'=>$org->org_title,
                'pay'=>($item->pay_amount)?number_format($item->pay_amount):""
            );
        }

        $result->hismpvs=array();
        $items = $this->report_model->getHisMpvHome($person->pers_id);
        foreach ($items as $item){
            $org=$this->report_model->getOrg($item->insert_org_id);
            $org_title=@$org->org_title;
            $result->hismpvs[]=(object)array(
                'date'=>dateTH($item->date_of_svy,' ','long'),
                'date_finish'=>dateTH($item->date_of_finish,' ','long'),
                'result'=>$item->consi_result,
                //doing
                'org'=>$org_title,
                'pay'=>($item->case_budget)?number_format($item->case_budget):""
            );
        }

        $result->hiswisds=array();
        $items = $this->report_model->getHisWisdInfo($person->pers_id);
        foreach ($items as $item){
            $result->hiswisds[]=(object)array(
                'date'=>dateTH($item->date_of_reg,' ','long'),
                'expert'=>$item->wisd_sp_title,
                'branch'=>$item->wis_name,
            );
        }

        $result->hisvolts=array();
        $items = $this->report_model->getHisvoltInfo($person->pers_id);
        foreach ($items as $item){
            $result->hisvolts[]=(object)array(
                'date_reg'=>dateTH($item->date_of_reg,' ','long'),
                'date'=>dateTH($item->date_of_training,' ','long'),
                'status'=>$item->older_care_training,
                'name'=>$item->older_care_training_course,
                'count'=>$this->report_model->getHisvoltCount($item->volt_id)
            );
        }

        $result->histrns=array();
        $items = $this->report_model->getHisTrnInfo($person->pers_id);
        foreach ($items as $item){
            $result->histrns[]=(object)array(
                'date'=>dateTH($item->start_date,' ','long'),
                'title'=>$item->trn_title,
                'org'=>$item->trn_org,
            );
        }

        $result->hisschs=array();
        $items = $this->report_model->getHisSchInfo($person->pers_id);
        foreach ($items as $item){
            $result->hisschs[]=(object)array(
                'year'=>$item->year_of_study,
                'no'=>$item->gen_code,
                'sch'=>$item->schl_name,
            );
        }
        $result->hisjobs=array();
        $items = $this->report_model->getHisJobInfo($person->pers_id);
        foreach ($items as $item){
            $result->hisjobs[]=(object)array(
                'date'=>dateTH($item->date_of_reg,' ','long'),
                'job_sp'=>$item->exp_name,
                'type_comp'=>$item->org_type,
                'status'=>$item->reg_status,
            );
        }


        return $result;
    }
    function Avgincomefamiry($famiry){

    }
    function setAddr($addr)
    {
        $data = new stdClass();
        $data->no = @$addr->addr_home_no;
        $data->moo = @$addr->addr_moo;
        $data->lane = @$addr->alley;
        $data->side_street = @$addr->addr_lane;
        $data->street = @$addr->addr_road;
        $data->locality = @$addr->locality;
        $data->district = @$addr->district;
        $data->province = @$addr->province;
        $data->postcode = @$addr->addr_zipcode;
        return $data;
    }
     function getIntToChar($num)
    {
        $numeric = $num % 26;
        $letter = chr(65 + $numeric);
        $num2 = intval($num / 26);
        if ($num2 > 0) {
            return $this->getIntToChar($num2 - 1) . $letter;
        } else {
            return $letter;
        }
    }
}