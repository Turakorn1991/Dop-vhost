<!DOCTYPE html>
<html>
    <head>
        <?php 
            $site = $this->webinfo_model->getSiteInfo(); 
            $title = $site['site_title'].'(Login selection)';

            $csrf = array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
            );
        ?>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta name="description" content="<?php echo $site['deprt_descp'];?>">
        <meta name="keywords" content="<?php echo $site['deprt_keywd'];?>">
        <meta name="author" content="Sonchai058">

        <link rel="shortcut icon" href="<?php echo path($site['site_icon_file'],'webconfig');?>" type="image/x-icon">
        <link rel="icon" href="<?php echo path($site['site_icon_file'],'webconfig');?>" type="image/x-icon">

        <!-- Load css -->
        <link rel="stylesheet" href="<?php echo site_url('assets/css/bootstrap.min.css'); ?>" />
        <link rel="stylesheet" href="<?php echo site_url('assets/css/font-awesome.min.css'); ?>" />
        <link rel="stylesheet" href="<?php echo site_url('assets/css/style.css'); ?>" />

        <style tyle="text/css">
            body {
              background: url('<?php echo path($site['site_bg_file'],'webconfig');?>');
            }
        </style>

        	<style tyle="text/css">
		html{
			min-height:100%;
		}

		body {
			background-repeat: no-repeat;
			font-weight: normal;
			color: #2f4050 !important;

			background-attachment:fixed;
			background-origin: initial;
			height:100%;
			background-color: #0b253c; /* For browsers that do not support gradients */
			background-image: linear-gradient(to bottom right, #0b253c, #245684); /* Standard syntax (must be last) */
		}

        .modal-header {
            border: none;
            margin-top: 15px;
        }
        .modal-header:before{
            content:url('/assets/images/fingerprint-process.png'); 
            margin: auto;
        }
        .modal-header h3 {
            text-align: center;
        }
        .modal-header h3 label {
            color: #000 !important;
        }
        .modal-body .progress{
            display:none;
        }
    </style>

        <title><?php echo $title; ?></title>
    </head>

    <body>
        <div class="row" style="margin-right:0px !important;">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0; background: transparent !important;">
                <a href="<?php echo site_url('/');?>" title="">	
                    <div class="navbar-header" style="margin: 0px auto auto 50px;">
                        <h1 class="title">DOP CENTER</h1>
                        <h2 class="sec1_title">ศูนย์ข้อมูลกลางผู้สูงอายุ</h2>
                    </div>
                </a>
            </nav>
        </div>

        <div style="padding-top:19vh; padding-bottom:19vh;"> <!-- 18vh -->
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-6 item" style="padding-top: 10px; padding-bottom: 10px;"> <!--163ศพอส-->
                        <a href="<?php echo site_url('login');?>" target="_blank">
                            <div class="col-sm-2 icon text-left" style="background-color: #a91d37">
                                <i class="fa fa-unlock-alt" aria-hidden="true"></i>
                            </div>
                            <div class="col-sm-9 txt">
                                <span class="">เข้าสู่ระบบด้วยรหัสบัญชีผู้ใช้</span><br/>
                                <span class="">Username & Password</span>
                            </div>
                         </a>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6 item" style="padding-top: 10px; padding-bottom: 10px;"> <!--163ศพอส-->
                        <a id="fingerprint-login-link" href="javascript:void(0);" target="_blank">
                            <div class="col-sm-2 icon text-left" style="background-color: #a91d37">
                                <i class="fa fa-unlock-alt" aria-hidden="true"></i>
                            </div>
                            <div class="col-sm-9 txt">
                                <span class="">เข้าสู่ระบบด้วยการแสกนลายนิ้วมือ</span><br/>
                                <span class="">Fingerprint scan</span>
                            </div>
                         </a>
                    </div>
                </div>
            </div>
        </div>

        <?php
            $csrf = array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
            );
        ?>

        <form id="login-form" action="<?php echo site_url('member/login_selection/login');?>" method="post"  >
            <input type="hidden" name="<?php echo $csrf['name'];?>" value="<?php echo $csrf['hash'];?>" />
            <input type="hidden" id="fingerprint_key" name="fingerprint_key" />
            <!-- <input type="submit" name="bt_submit" > -->
        </form>
       
        <!-- <h2> Base URL: <?php echo $this->config->item('base_url'); ?></h2> -->
        
    </body>

    <!-- Load JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo site_url('assets/js/bootstrap.min.js'); ?>"></script>    
    <script type="text/javascript" src="<?php echo site_url('assets/js/waitingfor.js'); ?>"></script>
    
    <script type="text/javascript">
        $("#fingerprint-login-link").click(function() {
            //TODO: Must be config.php
            var path = "C:\\_deploy\\dop-fingerprint\\Application\\";
            var fingerprintServiceHostUrl = "http://localhost:9090/";

            waitingDialog.show("<label>กำลังเชื่อมโยงกับเครื่องแสกนลายนิ้วมือ</label> <br/><label style='text-decoration:underline'>กรุณาทำตามขั้นตอน</label>");

            //Set exe parameter
            $.get(fingerprintServiceHostUrl + "SetApplicationArgument?mode=auth", function(isSuccess) {
                if(isSuccess) {
                    //Run exe
                    location.href = "webrun:" + path + "dop-fingerprint-app.exe";

                     //Check auth key from exe result every 2 second
                    var interval = setInterval(function(){    
                        $.get(fingerprintServiceHostUrl + "GetAuthorizeKey", function(key) {
                            if(key.length > 0){
                                clearInterval(interval);
                                waitingDialog.hide();

                                waitingDialog.show("กำลังเข้าสู่ระบบ กรุณารอ");

                                $.get(fingerprintServiceHostUrl + "DeleteAuthorizeKey", function(isDeleted) {
                                    if(isDeleted) {
                                        $("#fingerprint_key").val(key);
                                        $("#login-form").submit();
                                    }
                                });
                            }
                        });
                    }, 2000);
                }
            });

            setTimeout(function(){
                clearInterval(interval);
                waitingDialog.hide();
            }, 1800000);
        });
    </script>
</html>