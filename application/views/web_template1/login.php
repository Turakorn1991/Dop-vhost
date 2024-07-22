<!DOCTYPE html>
<html lang="th">
<head>
    <?php 
    $site = $this->webinfo_model->getOnceWebMain(); 

    $site['WD_Descrip'] = uns($site['WD_Descrip']);
    $site['WD_Keyword'] = uns($site['WD_Keyword']);
    $site['WD_Name'] = uns($site['WD_Name']);
    ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="description" content="<?php echo @$site['WD_Descrip'][getLang()]?>">
    <meta name="keywords" content="<?php echo @$site['WD_Keyword'][getLang()]?>">
    <meta name="author" content="<?php echo @$site['WD_Name'][getLang()]?>">

    <link rel="shortcut icon" href="<?php echo path(@$site['WD_Icon'],'webconfig');?>" type="image/x-icon">
    <link rel="icon" href="<?php echo path(@$site['WD_Icon'],'webconfig');?>" type="image/x-icon">

    <title>
    <?php
        if(isset($title)){
            echo $title;
        }else{
             $site['WD_Title'] = uns($site['WD_Title']);
             echo nameTitle($site['WD_Title'][getLang()],120);
        }
    ?>
    </title>
<?php
  echo css_asset('reset.css');
  echo css_asset('fontsset.css');
  
  echo js_asset('jquery-2.1.4.min.js');

  echo css_asset('../plugin/Materialize/Materialize/dist/css/materialize.min.css');
  echo js_asset('../plugin/Materialize/Materialize/dist/js/materialize.min.js');

  echo css_asset('../plugin/font-awesome/css/font-awesome.min.css');

  echo css_asset('login.css');
?>
</head>
<body class="bg-login">
	<div class="login-wrapper">
		<div class="head-login"></div>
		<div class="container">
			<div class="field-login">
			<?php echo form_open('member/portal_login/login',"class='form-login'")?>
					<label for="id-login">เลขประจำตัวประชาชน 13 หลัก</label>
					<input name="user_id" type="text" id="id-login" placeholder="XXXXXXXXXXXXX" title="เลขประจำตัวประชาชน 13 หลัก" onKeyPress="CheckNum()" autofocus>

					<label for="pass-login">วัน/เดือน/ปี เกิด ( DDMMYYYY )</label>
					<input name="user_pass" type="password" id="pass-login" placeholder="เช่น 08052535" title="Password">
					<input type="submit" value="เข้าสู่ระบบ" title="เข้าสู่ระบบ">
			<?php echo form_close();?>
			</div>
			
			<div class="note-box">
				<div class="note-head">
					<h2>หมายเหตุเพิ่มเติม<i class="fa fa-angle-down right"></i></h2>
				</div>
				<ol>
					<li>กรมการปกครองขอเปลี่ยนแปลงวิธีการเข้าใช้งานระบบงานภายในใหม่ โดยก่อนคลิกระบบงานภายใน จะต้อง Log In ผ่าน ระบบ Intranet ของกรมก่อนทุกครั้งเพื่อยืนยันว่าเป็นบุคคลที่ปฏิบัติ
					งานภายใน ปค.</li>
					<li>ชื่อผู้ใข้งานคือ เลขประจำตัวประชาชน 13 หลัก รหัสผ่านคือ วันเดือนปีเกิด(ววดดปปปป เช่น 31032521) </li>
					<li>เฉพาะข้าราชการและพนักงานราชการเท่านั้น กรณีลูกจ้าง พนักงานราชการ และข้าราชการ หากไม่มีรหัสให้ ส่งแบบฟอร์มลงทะเบียน โดย Donwnload ได้ที่นี้ มายังหมายเลข Fax. 0-2283-1222 ต่อ 031710 </li>
					<li>สำหรับการใช้งานระบบงานภายในต่างๆ เมื่อเข้าระบบแล้วสามารถคลิกที่ระบบงานนั้นๆ แล้ว Log in ระบบงานนั้น โดยใช้ Username และรหัสผ่านเดิมของแต่ละระบบตามปกติ</li>
					<li>หากไม่สามารถเข้าระบบได้ ติดต่อ ศูนย์สารสนเทศ กรมการปกครอง โทร 0-2283-1222 แจ้งเรื่องการเข้าใช้งานระบบ Intranet</li>
				</ol>
			</div>
		</div>
	</div>
	
	<script language="javascript">
		function CheckNum(){
		if (event.keyCode < 48 || event.keyCode > 57){
		      event.returnValue = false;
	    	}
	}
</script>
</body>

</html>
