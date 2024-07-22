
<div class="tab-content">
	<div id="tab-1" >
		<div class="panel-body">

				 <div class="row">
					 <div class="col-xs-12 col-sm-8">&nbsp;</div>
					 <div class="col-xs-12 col-sm-2 right">
 						<button style="height: 40px;width: 100% !important;" type="button" class="btn btn-primary btn-save" onclick="window.open('<?php echo site_url("report/J1")."/pdf/?id=".$this->uri->segment('3');?>','_blank');"><i class="fa fa-print" aria-hidden="true"></i> ส่งออกไฟล์ PDF</button>
 					</div>
					 <div class="col-xs-12 col-sm-2 right">
						 <button style="height: 40px;width: 100% !important;" type="button" class="btn btn-primary btn-cancel" onclick="window.location.href='<?php echo site_url('individual/individual_list');?>'"><i class="fa fa-undo" aria-hidden="true"></i> ย้อนกลับ</button>
					 </div>
				 </div><!-- close class row-->
			<div class="form-group row">
				<div class="col-xs-12 col-sm-12">
					<?php /*<iframe src="<?php echo 'report/J1/?id=239';?>" width="100%" height="500"></iframe>*/?>
					<center>
						<div style=" width: 100%;height: 450px;overflow: scroll;border: 1px solid #EEE;"><div  id="show_info"/></div></div>
					</center>
				</div>
			</div>

		</div>
	</div>
</div>
<script>
function loadInfo(){

			$.ajax({
			        method: "GET",
			        url: "<?php echo base_url('report/J1').'/?id='.$this->uri->segment('3');?>",
			        data: {}
			        }).done(function( data ) {
			            $('#show_info').html(data);
			});
}
loadInfo();
</script>
<style>
strong{
		font-size: 14px;
}
.table{
	font-size: 12px;
}
#show_info{
	padding-top: 10px;
}
#show_info > .break-inside{
	font-size: 12px !important;

}
.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td{
	font-size: 12px !important;
}
</style>
