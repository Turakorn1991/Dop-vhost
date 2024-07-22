<?php if ($this->uri->segment(2) == 'infrm1') {?>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="//cdn.ckeditor.com/4.7.3/basic/ckeditor.js"></script>
<script>
// Replace the <textarea id="editor1"> with a CKEditor
// instance, using default configuration.
CKEDITOR.replace( 'news_detail' );
</script>
<?php } ?>

<?php if ($this->uri->segment(2) == 'infrm2') {?>
<script src="//cdn.ckeditor.com/4.7.1/full/ckeditor.js"></script>
<script>
// Replace the <textarea id="editor1"> with a CKEditor
// instance, using default configuration.
CKEDITOR.replace( 'about_detail' );
</script>
<?php } ?>

<?php if ($this->uri->segment(2) == 'infrm4') {?>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="//cdn.ckeditor.com/4.7.3/basic/ckeditor.js"></script>
<script>
// Replace the <textarea id="editor1"> with a CKEditor
// instance, using default configuration.
CKEDITOR.replace( 'event_detail' );
</script>
<?php } ?>

<?php if ($this->uri->segment(2) == 'infrm5') {?>
<script src="//cdn.ckeditor.com/4.7.3/basic/ckeditor.js"></script>
<script>
// Replace the <textarea id="editor1"> with a CKEditor
// instance, using default configuration.
CKEDITOR.replace( 'article_detail' );
</script>
<?php } ?>