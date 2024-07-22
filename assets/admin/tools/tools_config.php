<!-- *************** inspinia-3 Template: CSS *************** -->
<?php echo css_asset('../plugins/Static_Full_Version/css/bootstrap.min.css'); ?>
<?php echo css_asset('../plugins/Static_Full_Version/font-awesome/css/font-awesome.css'); ?>
<?php echo css_asset('../plugins/Static_Full_Version/css/animate.css'); ?>
<?php echo css_asset('../plugins/Static_Full_Version/css/style.css'); ?>
<?php echo css_asset('../plugins/Static_Full_Version/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css'); ?>
<?php echo css_asset('../plugins/Static_Full_Version/css/plugins/iCheck/custom.css'); ?>
<!-- *************** End inspinia-3 Template: CSS *************** -->

<!-- *************** inspinia-3 Template: JS *************** -->
<?php echo js_asset('../plugins/Static_Full_Version/js/jquery-3.1.1.min.js'); ?>
<?php echo js_asset('../plugins/Static_Full_Version/js/plugins/iCheck/icheck.min.js'); ?>
<!-- *************** End inspinia-3 Template: JS *************** -->

<?php
  if(isset($this->template->js_assets_head))
    foreach ($this->template->js_assets_head as $key => $data) {
      echo $data;
    }
?>
<?php
  if(isset($this->template->css_assets_head))
    foreach ($this->template->css_assets_head as $key => $data) {
      echo $data;
    }
?>

<?php
  echo css_asset('../admin/css/fontsset.css');
  echo css_asset('../admin/css/main.css');

  echo css_asset('../admin/css/summary.css');
?>

<script>
  var base_url = "<?php echo base_url();?>"; //Set Base URL

  //Set Alert Notifications
  var toastr_type = null; //Set toast type
  var toastr_msg = null; //Set toast message
<?php

$msg = $this->session->flashdata('msg');

  if(isset($msg['msg_code'])) {
?>
  //set inizial toastr
  toastr_type = '<?php echo $msg['msg_type']?>';
  toastr_msg = '<?php echo $msg['msg_title']?>';
<?php 
  }
?>  
  //End Set Alert Notifications

  var frmKey = true;//Set Form key
</script>
<style tyle="text/css">
  .tooltip > .tooltip-inner {font-size:20px; background-color: #f00;}
  .tooltip > .tooltip-arrow { border-bottom-color:#f00; }

  #toast-container > .toast:before {
      font-size: 20px;
      margin: 0px 0em 5px -1.2em;
      content: "";
  }
  #toast-container > .toast:after {
      display: none;
  }

  .toast-title {
   font-size: 16px;
  }
  .toast-message {
    font-size: 14px;
  }

  .datepicker {
    width: 320px;
  }
  .datepicker .table-condensed {
    width: 100%;
  }
</style>

<script>
 var integration1 = function(info) {
  
 }
</script>