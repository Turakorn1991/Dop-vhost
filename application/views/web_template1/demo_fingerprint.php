<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Top
 * Date: 12/9/13 AD
 * Time: 10:36 AM
 * To change this template use File | Settings | File Templates.
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://ogp.me/ns/fb#" xmlns:fb="http://www.facebook.com/2008/fbml">
<head>

    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <!-- <link rel="shortcut icon" href="<?php echo base_url('assets/images/logo.gif')?>" type="image/x-icon">
    <link rel="icon" href="<?php echo base_url('assets/images/logo.gif')?>" type="image/x-icon"> -->

    <!-- <link rel="shortcut icon" href="<?php echo base_url('assets/images/favicon.ico')?>" /> -->
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
    <style type="text/css">
    	html, body
		{
		    width: 100%;
		    height: 100%;
		    font-family: SukhumvitSet;
		}
		body
		{
		  
		    width: 100%;
		    height: 100%;
		
		}
    	#asdbody{
    		background: -moz-linear-gradient(45deg, rgba(0,255,0,1) 0%, rgba(0,255,255,1) 100%); /* ff3.6+ */
			background: -webkit-gradient(linear, left bottom, right top, color-stop(0%, rgba(0,255,0,1)), color-stop(100%, rgba(0,255,255,1))); /* safari4+,chrome */
			background: -webkit-linear-gradient(45deg, rgba(0,255,0,1) 0%, rgba(0,255,255,1) 100%); /* safari5.1+,chrome10+ */
			background: -o-linear-gradient(45deg, rgba(0,255,0,1) 0%, rgba(0,255,255,1) 100%); /* opera 11.10+ */
			background: -ms-linear-gradient(45deg, rgba(0,255,0,1) 0%, rgba(0,255,255,1) 100%); /* ie10+ */
			background: linear-gradient(45deg, rgba(0,255,0,1) 0%, rgba(0,255,255,1) 100%); /* w3c */
			filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#00ffff', endColorstr='#00ff00',GradientType=1 ); /* ie6-9 */
			
    	}
    	body{
    		  background-image: url("assets/images/bg.jpg");
    		  background-position: center top;
    		  background-size: 100% auto;
    		  background-repeat: no-repeat, repeat;
    	}
    	.modal { width: 75% !important ; max-height: 100% !important } 
    	@font-face {
		    font-family: SukhumvitSet;
		    src: url(assets/fonts/SukhumvitSet/SukhumvitSet.ttc);
		}
		a span {
		  cursor: pointer;
		  display: inline-block;
		  position: relative;
		  transition: 0.5s;
		}
		a span:after {
		  /*content: '\00bb';*/
		  position: absolute;
		  opacity: 0;
		  top: 0;
		  right: -20px;
		  transition: 0.5s;
		}

		a:hover span {
		  /*padding-right: 25px;*/
		  color: #2d5ab2;
		  box-shadow: 5px 10px;
		}

		a:hover span:after {
		  opacity: 1;
		  right: 0;
		}
    </style>


    <script type="text/javascript">
        var domain='<?php  echo base_url() ?>';
    </script>
    <title>demo_สแกนลายนิ้วมือ</title>
    
</head>
<body>
	<div class="container">

	    <main>
	        <center>
	        
	            <div style="display: inline-block; padding: 32px 48px 0px 48px; border: 1px; margin-top: 450px;">
	       <!--          <div class="section"></div>
	                <div class="section"></div> -->
	      
	                <center>
	                    <div class='row' id ="btn_sacnner" style="cursor: pointer; ">
	                    	
	                          <a href="webrun:C:\Users\pengjankul\Desktop\fingerprinttest\Enrollment\bin\Release\EnrollmentSample CS.exe"  role="button" id="btn_sacnner"><span><img src="<?php base_url();?>assets/images/btn.jpg"></span></a>
	                    </div>
	                   
	                </center>
	    
	             </div>
	    
	    </center>
	   </main>
	  <!-- Page Content goes here -->
    </div>


	<div id="modal1" class="modal" style="background: #262231; color: #fff;">
	  <div class="modal-content" id ="modal_body">
	  </div>
	  <div class="modal-footer" style="background: #262231; ">
	     <a style="background:#232124;color: #fff; border-radius: 25px;" href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">ยืนยัน</a>
	  </div>
	</div>


  
   
          
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>

</body>
<script type="text/javascript">
  var csrf_hash='<?php echo @$csrf['hash'];?>';
	$(function(){
		//getFingerprint();
		$('.modal').modal();
		$('#btn_sacnner').click(function(){
		    scan_status = true;
		    $('#btn_sacnner').addClass('disabled');
		    $("body").css("cursor", "progress");

		    var str = '';
		    if(scan_status){
		        $(document).keyup(function (e) {
		            str += String.fromCharCode(e.which);
	                if( str == 'K' ){
	                  getFingerprint();
	                  str = '';
	                }else{
	                	$('#btn_sacnner').removeClass('disabled');
	                }
		        }); 
		    }    
		});
	});

	function getFingerprint(){

		var URL = domain+'demo/getfingerprint';
		$.ajax({
			 url: URL,
			 type: "POST",
			 data: {'csrf_dop': csrf_hash}, 
			 success: function (res) {
			 	console.log(res);
			 	var html = '';
			      if(res.value){
			      	// console.log(res.value[0].value);
			      	// console.log();
			      	if (res.value[res.max].value > 90){
			      		html += '<h4>ผลลัพธ์ตรวจสอบลายนิ้วมือ</h4>';
				    	html += '<div class="row">';
				    	html += '<div class="col s6">';
				    	html += '<center><div style="width:200px; height:200px; background:#473f4e;padding: 5px;">';
				    	html += '<img src="<?php echo base_url();?>assets/images/user1.png" height="200" width="200">'

				    	html += ''+res.value[res.max].user_fname+res.value[res.max].user_lname+'';
				    	html += '</div></center>'
				    	html += '</div>';
			      	}else{
			      		html += '<h5>ผลลัพธ์ การเปรียบเทียบ</h5><hr>';
				    	html += '<div class="row">';
				    	html += '<div class="col s6">';
				    	html += ''+'ไม่พบ ลายนิ้วมือ'+'';
				    	html += '</div>';
			      	}
			      
			  
			      	html += '<div class="col s6" style="background:#232124;color: #fff; border-radius: 25px;">';
			      	html += '<div class="row"><h5>ผลการทดสอบ</h5>';
			      	$.each(res.value, function(index, value) {
			      		html += '<div class="row">';
                        html += '<div class="col s6"> ผู้ใช้ : '+value.user_fname + value.user_lname+'</div>';
                        html += '<div class="col s6"> ความเหมือน : '+value.value+'%'+'</div>';
                        html += '</div>';
                       
			      	});
			      	html += '</div';
			      	html += '</div';
			      	html += '</div>';
			      	$('#modal_body').html(html);

			      	$('#modal1').modal('open');
			        $("body").css("cursor", "default");
			        $('#btn_sacnner').removeClass('disabled');
			      }
			 }
		});
		
	}
</script>

</html>