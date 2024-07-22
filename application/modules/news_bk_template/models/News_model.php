<?php
	class News_model extends CI_Model {

        function __construct() {
            parent::__construct();
        }
        
        public function getAllCategory(){
            $sql = "SELECT * FROM category_news AS A LEFT JOIN category_news_icons AS B ON A.CNI_ID = B.CNI_ID WHERE A.CN_Allow != '3' ORDER BY CN_Order ASC";
            return $this->common_model->custom_query($sql);
        }
        public function getOneCategory($id=''){
            $sql = "SELECT A.*,B.*,C.M_ThName AS CN_UserUpdate  FROM category_news AS A 
            LEFT JOIN category_news_icons AS B ON A.CNI_ID = B.CNI_ID 
            LEFT JOIN member AS C ON A.CN_UserUpdate = C.M_ID
            WHERE A.CN_ID = {$id} AND A.CN_Allow != '3' ORDER BY CN_Order ASC";
            return $this->common_model->custom_query($sql);
        }

        public function getAllCategoryIcons(){
            $sql = "SELECT * FROM category_news_icons WHERE CNI_Allow != '3' ORDER BY CNI_Order ASC";
            return $this->common_model->custom_query($sql);
        }
        public function getOneCategoryIcons($id=''){
            $sql = "SELECT A.*,B.M_ThName AS CNI_UserUpdate FROM category_news_icons AS A 
                LEFT JOIN member AS B ON B.M_ID = A.CNI_UserUpdate
                WHERE CNI_ID = {$id} AND CNI_Allow != '3' ORDER BY CNI_Order ASC";
            return $this->common_model->custom_query($sql);
        }

        public function getAllNews($CN_ID=''){
            if($CN_ID=='')
                return array();
            $sql = "SELECT * FROM news WHERE CN_ID = {$CN_ID} AND N_Allow != '3' ORDER BY N_DateTimeupdate DESC";
            return $this->common_model->custom_query($sql);
        }
        public function getOneNews($N_ID=''){
            if($N_ID=='')
                return array();
            $sql = "SELECT A.*,B.M_ThName AS N_UserUpdate FROM news AS A 
            LEFT JOIN member AS B ON A.N_UserUpdate = B.M_ID
            WHERE A.N_ID = {$N_ID} AND A.N_Allow != '3'";
            return $this->common_model->custom_query($sql);
        }

        public function getAllNewsFiles($N_ID=''){
            $sql = "SELECT * FROM news_document WHERE ND_Allow !='3' AND N_ID = {$N_ID}";
            return $this->common_model->custom_query($sql);
        }
    }
?>