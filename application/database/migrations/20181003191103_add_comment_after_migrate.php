<?php

class Migration_add_comment_after_migrate extends CI_Migration {

    public function up() {
        $this->db->query("ALTER TABLE  `edoe_job_survey` COMMENT =  'ตารางส่งเสริมการจ้างงาน (แบบสำรวจการจ้างงานผู้สูงอายุ)' 
                        CHANGE `job_sur_id` `job_sur_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'รหัสแบบสำรวจการจ้างงานผู้สูงอายุ', 
                        CHANGE `job_sur_title` `job_sur_title` VARCHAR(256) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'ชื่อแบบสำรวจการจ้างงานผู้สูงอายุ', 
                        CHANGE `job_sur_url` `job_sur_url` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'ลิงค์กูเกิลฟอร์มแบบสำรวจการจ้างงานผู้สูงอายุ', 
                        CHANGE `job_sur_slug` `job_sur_slug` VARCHAR(256) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'ลิงค์สำหรับทำแบบสำรวจการจ้างงานผู้สูงอายุ', 
                        CHANGE `job_sur_status` `job_sur_status` ENUM('Active','Inactive') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'Inactive' COMMENT 'สถานะแบบสำรวจการจ้างงานผู้สูงอายุ', 
                        CHANGE `job_sur_insert_user_id` `job_sur_insert_user_id` INT(11) NULL DEFAULT NULL COMMENT 'เจ้าหน้าที่ ผู้เพิ่มรายการ', 
                        CHANGE `job_sur_insert_org_id` `job_sur_insert_org_id` INT(11) NULL DEFAULT NULL COMMENT 'หน่วยงาน ผู้เพิ่มรายการ', 
                        CHANGE `job_sur_update_user_id` `job_sur_update_user_id` INT(11) NULL DEFAULT NULL COMMENT 'เจ้าหน้าที่ ที่แก้ไขรายการล่าสุด', 
                        CHANGE `job_sur_update_org_id` `job_sur_update_org_id` INT(11) NULL DEFAULT NULL COMMENT 'หน่วยงาน ที่แก้ไขรายการล่าสุด', 
                        CHANGE `job_sur_insert_datetime` `job_sur_insert_datetime` DATETIME NULL DEFAULT NULL COMMENT 'วันเวลา ที่เพิ่มรายการ', 
                        CHANGE `job_sur_update_datetime` `job_sur_update_datetime` DATETIME NULL DEFAULT NULL COMMENT 'วันเวลา ที่แก้ไขรายการล่าสุด'"
                    );

        $this->db->query("ALTER TABLE  `volt_info`
                        CHANGE `date_of_resign` `date_of_resign` DATE NULL DEFAULT NULL COMMENT 'วันที่พ้นจากการเป็นอาสาสมัคร',
                        CHANGE `resign_reason` `resign_reason` VARCHAR(256) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'สาเหตุที่พ้นจากการเป็นอาสาสมัคร'
                    ");

        $this->db->query("ALTER TABLE  `pers_info`
                        CHANGE `relg_code` `relg_code` INT(11) NULL DEFAULT NULL COMMENT 'รหัสศาสนา'
                    ");

        $this->db->query("ALTER TABLE  `volt_info_care_progress` COMMENT =  'ตารางอาสาสมัครดูแลผู้สูงอายุ (ผลการดำเนินงาน)' 
                        CHANGE `care_prog_id` `care_prog_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'รหัสแบบสำรวจการจ้างงานผู้สูงอายุ',
                        CHANGE `care_prog_acti_id` `care_prog_acti_id` INT(11) NULL DEFAULT NULL COMMENT 'รหัสกิจกรรมการดูแลช่วยเหลือและคุ้มครองพิทักษ์สิทธิผู้สูงอายุ', 
                        CHANGE `care_prog_volt_id` `care_prog_volt_id` INT(11) NULL DEFAULT NULL COMMENT 'รหัสอาสาสมัครดูแลผู้สูงอายุ', 
                        CHANGE `care_prog_pers_id` `care_prog_pers_id` INT(11) NULL DEFAULT NULL COMMENT 'รหัสทะเบียนประวัติผู้สูงอายุ', 
                        CHANGE `care_prog_care_date` `care_prog_care_date` DATE NULL DEFAULT NULL COMMENT 'วันเดือนปี ที่ให้การดูแลผู้สูงอายุ',
                        CHANGE `care_prog_specify` `care_prog_specify` VARCHAR(256) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'ระบุรหัสกิจกรรมการดูแลช่วยเหลือและคุ้มครองพิทักษ์สิทธิผู้สูงอายุ',
                        CHANGE `job_sur_status` `job_sur_status` ENUM('Active','Inactive') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'Inactive' COMMENT 'สถานะแบบสำรวจการจ้างงานผู้สูงอายุ', 

                    ");
    }

    public function down() {

    }

}