<!DOCTYPE html>
<html lang="en">

<head>
   
   
    <meta name="viewport" content="width=device-width">
    <meta charset="utf-8">
</head>


<body>
	<?php 
	//$this->load->view("web_template1/header/header"); 
	$this->load->view("history_login");
	$this->load->view($content_view);
	//$this->load->view("web_template1/footer/footer"); 
	?>

<?php $this->load->file("assets/tools/tools_webscript.php");?>
   
</body>
</html>