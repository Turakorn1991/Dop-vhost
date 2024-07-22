<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="description" content="<?php echo $web_description; ?>">
	<meta name="keywords" content="<?php echo $web_keyword; ?>">
	<meta name="author" content="<?php echo $web_author; ?>">
	<link rel="shortcut icon" href="<?php echo site_url("assets/modules/webconfig/images/".$web_icon);?>" type="image/x-icon">
    <link rel="icon" href="<?php echo site_url("assets/modules/webconfig/images/".$web_icon);?>" type="image/x-icon">
	<title>กรมกิจการผู้สูงอายุ</title>
	<?php $this->load->file("assets/tools/tools_webconfig.php");?>
	<style tyle="text/css">
		html{
			min-height:100%;
		}

		body {
			/* background: url('<?php echo site_url("assets/modules/webconfig/images/".$web_background_image);?>'); */
			background-repeat: no-repeat;
/* 			background-size: cover;
			-moz-background-size: cover;
			-webkit-background-size: cover;
			-o-background-size: cover;
			background-color: #f7f8fa; */
			font-weight: normal;
			color: #2f4050 !important;

			background-attachment:fixed;
			background-origin: initial;
			height:100%;
			/* background: #0b253c; */ /* Fallback */
			background-color: #0b253c; /* For browsers that do not support gradients */
			background-image: linear-gradient(to bottom right, #0b253c, #245684); /* Standard syntax (must be last) */

			/* background: rgba(11,37,60,1); *//* Old Browsers */
			/* background: -moz-linear-gradient(-45deg, rgba(11,37,60,1) 0%, rgba(24,60,93,1) 41%, rgba(36,86,132,1) 100%);  *//* FF3.6+ */
			/* background: -webkit-gradient(left top, right bottom, color-stop(0%, rgba(11,37,60,1)), color-stop(41%, rgba(24,60,93,1)), color-stop(100%, rgba(36,86,132,1))); *//* Chrome, Safari4+ */
			/* background: -webkit-linear-gradient(-45deg, rgba(11,37,60,1) 0%, rgba(24,60,93,1) 41%, rgba(36,86,132,1) 100%);  *//* Chrome10+,Safari5.1+ */
			/* background: -o-linear-gradient(-45deg, rgba(11,37,60,1) 0%, rgba(24,60,93,1) 41%, rgba(36,86,132,1) 100%);  *//* Opera 11.10+ */
			/* background: -ms-linear-gradient(-45deg, rgba(11,37,60,1) 0%, rgba(24,60,93,1) 41%, rgba(36,86,132,1) 100%);  *//* IE 10+ */
			/* background: linear-gradient(135deg, rgba(11,37,60,1) 0%, rgba(24,60,93,1) 41%, rgba(36,86,132,1) 100%); *//* W3C */
			/* filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#0b253c', endColorstr='#245684', GradientType=1 ); *//* IE6-9 fallback on horizontal gradient */
		}
    </style>
</head>
<body>
	<?php 
	$this->load->view("web_template1/header/header");
	$this->load->view($content_view);
	$this->load->view("web_template1/footer/footer"); 
	?>

<?php $this->load->file("assets/tools/tools_webscript.php");?>
   
</body>
</html>