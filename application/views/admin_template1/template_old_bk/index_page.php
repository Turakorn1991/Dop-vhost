<!DOCTYPE html>
<html>
    <head>
        <?php 
            $site = $this->webinfo_model->getSiteInfo();

            $title = $title==''?$site['site_title'].'(Index_page)':$title;
        ?>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <meta name="description" content="<?php echo $site['deprt_descp'];?>">
        <meta name="keywords" content="<?php echo $site['deprt_keywd'];?>">
        <meta name="author" content="Sonchai058">

        <link rel="shortcut icon" href="<?php echo path($site['site_icon'],'webconfig');?>" type="image/x-icon">
        <link rel="icon" href="<?php echo path($site['site_icon'],'webconfig');?>" type="image/x-icon">

        <?php //Set Background Path?>
        <style tyle="text/css">
            body {
              background: url('<?php echo path($site['site_bg'],'webconfig');?>');
            }
        </style>

        <?php $this->load->file('assets/admin/tools/tools_config.php');?>

        <?php
            if($this->template->content_view_set==1){
                //$this->load->file(APPPATH.'modules/'.uri_seg(1).'/assets/tools/back-end/tools_config.php');
                $this->load->file('assets/modules/'.uri_seg(1).'/tools/back-end/tools_config.php');
            }
        ?>

        <title><?php echo $title;?></title>
        <!-- <title><?php echo $title; ?></title> -->

    </head>

<body>

    <div class="main">

    <?php
        $this->load->view($this->template->name.'/header');
    ?>
        

        <div class="row w_container" style="margin-top: -20px;">

        <?php
            $this->load->view($this->template->name.'/leftmenu');
        ?>
        
            <div class="article col-xs-12 col-sm-12 col-md-11">

                <?php
                    $this->load->view($this->template->name.'/submenu',array('head_title'=>$head_title,'title'=>$title));
                ?>

                <?php

                if($this->template->content_view_set==0)
                	$this->load->view($this->template->name.'/'.$content_view);
                else
                    $this->load->file(APPPATH.'modules/'.uri_seg(1).'/views/back-end/'.$content_view.'.php'); 
                
                ?>

                <?php
                $this->load->view($this->template->name.'/footer');
                ?>
                
            </div>
        </div>

  </div>
<br /><br />
</body>
<?php $this->load->file('assets/admin/tools/tools_script.php'); ?>
<?php
    if($this->template->content_view_set==1){
        //$this->load->file(APPPATH.'modules/'.uri_seg(1).'/assets/tools/back-end/tools_script.php');
        $this->load->file('assets/modules/'.uri_seg(1).'/tools/back-end/tools_script.php');
    }
?>
</html>

