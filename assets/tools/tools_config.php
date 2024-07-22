<?php
  //echo css_asset('reset.css');
  //echo css_asset('fontsset.css');
  
  //echo js_asset('jquery-2.1.4.min.js'); 
  //echo css_asset('main.css');
?>

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

<script>
  /*
  function no_img_banner(image) {
    image.onerror = "";
    image.src = '<?php echo base_url('assets/images/no-img-banner.png');?>';
    return true;
  }
  function noimage(image) {
    image.onerror = "";
    image.src = '<?php echo base_url('assets/images/noimage.gif');?>';
    return true;
  }
*/
</script>

<script>
  var base_url = "<?php echo base_url();?>";
</script>