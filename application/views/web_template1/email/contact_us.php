<?php 
	/*
	 *	CONTACT EMAIL SENDER (2015-12-24) BY CHAMP
	 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<body>
    <p>Contact email from: <?php echo base_url(); ?></p>
    <p>
    	<?php echo label('MAIL_CONTACT'); ?>: <?php echo label('MAIL_ADMIN_NAME'); ?><br>
    	<?php echo label('MAIL_CONTACT_TIME'); ?>: <?php echo $CU_Date; ?>
	</p>
    <p>---------------------------------------------------------------------</p>
    <p>
    	<?php echo label('MAIL_SUBJECT'); ?>: <?php echo $CU_Subject; ?><br>
    	<?php echo label('MAIL_MSG'); ?>: <?php echo $CU_Descipt; ?>
    </p>
    <p>
    	<?php echo label('MAIL_CONTACT_NAME'); ?>: <?php echo $CU_Name; ?><br>
      	<?php echo label('MAIL_CONTACT_EMAIL'); ?>: <?php echo $CU_Email; ?><br>
      	<?php echo label('MAIL_CONTACT_TEL'); ?>: <?php echo $CU_Phone; ?>
    </p>
    <p>---------------------------------------------------------------------</p>
</body>
</html>





<!-- 
///////////////////////////////////////////////////
START BACKUP FIRST VERSION SOURCE CODE (2015-12-24)
///////////////////////////////////////////////////
-->


<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<body>
    Contact Us Email from <?php echo base_url();?><br><br>
    ติดต่อ : ผู้ดูแลระบบ <br><br>
    ติดต่อเมื่อเวลา : <?php echo $CU_Date;?> <br><br>

    หัวข้อ : <?php echo $CU_Subject;?> <br><br>
    ข้อความ : <?php echo $CU_Descipt;?> <br><br>

    ข้อมูลของผู้ติดต่อ : <br>
    ชื่อผู้ติดต่อ : <?php echo $CU_Name;?> <br>
    อีเมล์ผู้ติดต่อ : <?php echo $CU_Email;?> <br>
    เบอร์โทรศัพท์ผู้ติดต่อ : <?php echo $CU_Phone;?> <br>

</body>
</html> -->


<!-- 
///////////////////////////////////////////////////
END BACKUP FIRST VERSION SOURCE CODE (2015-12-24)
///////////////////////////////////////////////////
-->