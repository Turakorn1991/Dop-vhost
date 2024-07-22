<!DOCTYPE html>
<html lang="en">


   
<head>
    <link rel="stylesheet" type="text/css" href="\assets\modules\gold_app_api\css\Styles.css">
    <link rel="stylesheet" type="text/css" href="\assets\modules\gold_app_api\css\uikit.css">
    <script type="text/javascript" src="\assets\modules\gold_app_api\js\uikit.min.js"></script>
    <script type="text/javascript" src="\assets\modules\gold_app_api\js\uikit-icons.js"></script>
    <meta name="viewport" content="width=device-width">
    <meta charset="utf-8">

</head>


<body>
	<?php 
	
	$this->load->view("history_table");
	$this->load->view($content_view);
	
	?>


   
</body>
</html>