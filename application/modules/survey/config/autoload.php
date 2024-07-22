<?php  
    $autoload = array(
        'helper'    => array('url','form','general','file','html','asset'),
        'libraries' => array('session','encrypt'),
        'model' => array('webconfig/webinfo_model', 'member/admin_model', 'common_model', 'survey_model')
    );
?>