<!DOCTYPE html>
<html>
<title><?php echo $title?></title>
<head>
  <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <?php echo css_asset('../modules/report/css/report.css'); ?>
    <?php echo css_asset('../modules/report/css/preview.css'); ?>

</head>
<body>


      <?php
      $this->load->file(APPPATH . 'modules/' . uri_seg(1) . '/views/' . $content_view . '.php');
      ?>


</body>
</html>
