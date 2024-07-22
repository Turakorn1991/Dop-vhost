<!DOCTYPE html>
<html>
<title><?php echo $title?></title>
<head>
  <meta name="_token" content="<?php echo  $this->security->get_csrf_hash();?>">
    <?php echo css_asset('../modules/usm/css/style.css'); ?>
    <?php echo css_asset('../modules/usm/bootstrap/css/bootstrap.min.css'); ?>
    <?php echo css_asset('../modules/usm/bootstrap/css/ionicons.min.css'); ?>
    <?php echo js_asset('../modules/usm/js/jquery.min.js'); ?>
    <?php echo js_asset('../modules/usm/bootstrap/js/bootstrap.js'); ?>
</head>
<body>


<?php
$this->load->file(APPPATH . 'modules/' . uri_seg(1) . '/views/' . $content_view . '.php');
?>

<?php echo js_asset('../modules/usm/js/script.js'); ?>
</body>
</html>
