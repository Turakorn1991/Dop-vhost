 	<!-- Load CSS Theme for Datatable Reponsive -->
   <link href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css" rel="stylesheet">
   <link href="https://cdn.datatables.net/rowreorder/1.2.0/css/rowReorder.dataTables.min.css" rel="stylesheet">
   <link href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.dataTables.min.css" rel="stylesheet">
   <!-- End Load CSS Theme for Datatable Reponsive -->

<!-- Alert Notifications -->
<?php
$state_preform1= $this->session->flashdata('state_preform1');
if($state_preform1 =='2') {
?>
  <div class="alert alert-success alert-dismissable fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>เสร็จสิ้น!</strong> ระบบได้บันทึกแจ้งขอรับบริการสงเคราะห์แล้ว
  </div>
  <script>
    window.setTimeout(function() { $(".alert-success").alert('close'); }, 2000);
  </script>
<?php
}else if($state_preform1 =='-1') {
?>
  <div class="alert alert-danger alert-dismissable fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>ล้มเหลว!</strong> ระบบไม่สามารถบันทึกแจ้งขอรับบริการสงเคราะห์ได้
  </div>
<?php
}
?>
<!-- End Alert Notifications -->

   <div class="row" style="margin: 5px;">
	   <div class="col-xs-12 col-sm-12 text-right">
           <?php
            $tmp = $this->admin_model->chkOnce_usrmPermiss(20,$user_id); //Check User Permission
            if(isset($tmp['perm_can_edit'])) {
                if($tmp['perm_can_edit']=='Yes') {
           ?>
           <button style="background-color: #ee640c; color: #fff;" onclick="window.location.replace('<?php echo site_url('difficult/sufferer_preform1');?>')" title="<?php echo $tmp['app_name'];?>" type="button" class="btn btn-default" style="padding-left: 20px; padding-right:20px;margin-bottom:2px;"><span class="glyphicon glyphicon-plus"></span> <?php echo $tmp['app_name'];?>
           </button>       
           <?php
                }
            }
           ?>
           <?php
            $tmp = $this->admin_model->chkOnce_usrmPermiss(21,$user_id); //Check User Permission
            if(isset($tmp['perm_can_edit'])) {
                if($tmp['perm_can_edit']=='Yes') {
           ?>
		   <button style="background-color: #ed3d0a; color: #fff;" onclick="window.location.replace('<?php echo site_url('difficult/sufferer_form1');?>')" title="บันทึกข้อมูลผู้ประสบปัญหา สคส.01" type="button" class="btn btn-default" style="padding-left: 20px; padding-right:20px;margin-bottom:2px;"><span class="glyphicon glyphicon-plus"></span> บันทึกข้อมูลผู้ประสบปัญหา สคส.01
		   </button>
           <?php
                }
            }
           ?>		   
           <button style="background-color: #1277eb; color: #fff;" title="กรองข้อมูล" type="button" class="btn btn-info" style="padding-left: 20px; padding-right:20px;margin-bottom:2px;"><span class="glyphicon glyphicon-filter"></span>
		   </button>
	   </div>
   </div>


		<table id="example" class="display nowrap" cellspacing="0" width="99%" style="font-size:18px">
			<thead>
                <tr>
                    <th>#</th>
                    <th>บัตรประจำตัวประชาชน</th>
                    <th>ชื่อ-นามสกุล</th>
                    <th>อายุ(ปี)</th>
                    <th>ที่อยู่ปัจจุบัน</th>
                    <th>ตรวจเยี่ยม</th>
                    <th>ผลพิจารณา</th>
                    <th>เครื่องมือ</th>
                </tr>
			</thead>
			<tfoot>
                <tr>
                    <th>#</th>
                    <th>บัตรประจำตัวประชาชน</th>
                    <th>ชื่อ-นามสกุล</th>
                    <th>อายุ(ปี)</th>
                    <th>ที่อยู่ปัจจุบัน</th>
                    <th>ตรวจเยี่ยม</th>
                    <th>ผลพิจารณา</th>
                    <th>เครื่องมือ</th>
                </tr>
			</tfoot>
			
			<tbody>
			</tbody>
			
		</table>

<!-- Trigger the modal with a button -->
<!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button> -->

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">ลบข้อมูล</h4>
      </div>
      <div class="modal-body">
        <p>ระบบจะดำเนินการลบข้อมูลรายการ</p>
        <p>ยืนยันการลบ?</p>
      </div>
      <div class="modal-footer">
        <button id="btnYes" type="button" class="btn btn-danger">ตกลง</button>
        <button type="button" aria-hidden="true" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
      </div>
    </div>
  </div>
</div>

   <!-- Load JS for Datatable Reponsive -->
	<script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/rowreorder/1.2.0/js/dataTables.rowReorder.min.js"></script>
	<script src="https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js"></script>
	<!-- End JS for Datatable Reponsive -->

<script type="text/javascript">

$(document).ready(function() {
    var table = $('#example').DataTable( {
        "bPaginate": true,
        "bProcessing": true, 
        "aaData": [
            ["1", "1509901360611", "นายคมกฤช หมูคำปัน",'76 ปี','18 หมู่ 5 ต.แม่ยวบ อ.แม่สะเรียง จ.แม่ฮ่องสอน','<font color=green>ตรวจเยี่ยมแล้ว</font>','<font color=green>อนุมัติ</font>','<button onclick="window.location.replace(\'<?php echo site_url('difficult/sufferer_form2');?>\')" title="บันทึกข้อมูลผู้ประสบปัญหา สคส.02" type="button" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>&nbsp;<button onclick="window.location.replace(\'<?php echo site_url('difficult/approve');?>\')" title="บันทึกผลการพิจารณา" type="button" class="btn btn-default"><span class="glyphicon glyphicon-ok"></span></button>&nbsp;<button title="พิมพ์ใบเสร็จรับเงิน" type="button" class="btn btn-default"><span class="glyphicon glyphicon-file"></span></button>&nbsp;<button data-id=1 onclick="opn(this)" title="ลบ" type="button" class="btn btn-default"><span class="glyphicon glyphicon-trash"></span></button>'],
            ["2", "1509901360611", "นายคมกฤช หมูคำปัน",'76 ปี','18 หมู่ 5 ต.แม่ยวบ อ.แม่สะเรียง จ.แม่ฮ่องสอน','<font color=green>ตรวจเยี่ยมแล้ว</font>','<font color=green>อนุมัติ</font>','<button title="บันทึกข้อมูลผู้ประสบปัญหา สคส.02" type="button" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>&nbsp;<button title="บันทึกผลการพิจารณา" type="button" class="btn btn-default"><span class="glyphicon glyphicon-ok"></span></button>&nbsp;<button title="พิมพ์ใบเสร็จรับเงิน" type="button" class="btn btn-default"><span class="glyphicon glyphicon-file"></span></button>&nbsp;<button data-id=2 onclick="opn(this)" title="ลบ" type="button" class="btn btn-default"><span class="glyphicon glyphicon-trash"></span></button>'],
            ["3", "1509901360611", "นายคมกฤช หมูคำปัน",'76 ปี','18 หมู่ 5 ต.แม่ยวบ อ.แม่สะเรียง จ.แม่ฮ่องสอน','<font color=green>ตรวจเยี่ยมแล้ว</font>','<font color=green>อนุมัติ</font>','<button title="บันทึกข้อมูลผู้ประสบปัญหา สคส.02" type="button" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>&nbsp;<button title="บันทึกผลการพิจารณา" type="button" class="btn btn-default"><span class="glyphicon glyphicon-ok"></span></button>&nbsp;<button title="พิมพ์ใบเสร็จรับเงิน" type="button" class="btn btn-default"><span class="glyphicon glyphicon-file"></span></button>&nbsp;<button data-id=3 onclick="opn(this)" title="ลบ" type="button" class="btn btn-default"><span class="glyphicon glyphicon-trash"></span></button>'],            
            ["4", "1509901360611", "นายคมกฤช หมูคำปัน",'76 ปี','18 หมู่ 5 ต.แม่ยวบ อ.แม่สะเรียง จ.แม่ฮ่องสอน','<font color=green>ตรวจเยี่ยมแล้ว</font>','<font color=green>อนุมัติ</font>','<button title="บันทึกข้อมูลผู้ประสบปัญหา สคส.02" type="button" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>&nbsp;<button title="บันทึกผลการพิจารณา" type="button" class="btn btn-default"><span class="glyphicon glyphicon-ok"></span></button>&nbsp;<button title="พิมพ์ใบเสร็จรับเงิน" type="button" class="btn btn-default"><span class="glyphicon glyphicon-file"></span></button>&nbsp;<button data-id=4 onclick="opn(this)" title="ลบ" type="button" class="btn btn-default"><span class="glyphicon glyphicon-trash"></span></button>'],
            ["5", "1509901360611", "นายคมกฤช หมูคำปัน",'76 ปี','18 หมู่ 5 ต.แม่ยวบ อ.แม่สะเรียง จ.แม่ฮ่องสอน','<font color=green>ตรวจเยี่ยมแล้ว</font>','<font color=green>อนุมัติ</font>','<button title="บันทึกข้อมูลผู้ประสบปัญหา สคส.02" type="button" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>&nbsp;<button title="บันทึกผลการพิจารณา" type="button" class="btn btn-default"><span class="glyphicon glyphicon-ok"></span></button>&nbsp;<button title="พิมพ์ใบเสร็จรับเงิน" type="button" class="btn btn-default"><span class="glyphicon glyphicon-file"></span></button>&nbsp;<button data-id=5 onclick="opn(this)" title="ลบ" type="button" class="btn btn-default"><span class="glyphicon glyphicon-trash"></span></button>'],
            ["6", "1509901360611", "นายคมกฤช หมูคำปัน",'76 ปี','18 หมู่ 5 ต.แม่ยวบ อ.แม่สะเรียง จ.แม่ฮ่องสอน','<font color=green>ตรวจเยี่ยมแล้ว</font>','<font color=green>อนุมัติ</font>','<button title="บันทึกข้อมูลผู้ประสบปัญหา สคส.02" type="button" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>&nbsp;<button title="บันทึกผลการพิจารณา" type="button" class="btn btn-default"><span class="glyphicon glyphicon-ok"></span></button>&nbsp;<button title="พิมพ์ใบเสร็จรับเงิน" type="button" class="btn btn-default"><span class="glyphicon glyphicon-file"></span></button>&nbsp;<button data-id=6 onclick="opn(this)" title="ลบ" type="button" class="btn btn-default"><span class="glyphicon glyphicon-trash"></span></button>'],            
            ["7", "1509901360611", "นายคมกฤช หมูคำปัน",'76 ปี','18 หมู่ 5 ต.แม่ยวบ อ.แม่สะเรียง จ.แม่ฮ่องสอน','<font color=green>ตรวจเยี่ยมแล้ว</font>','<font color=green>อนุมัติ</font>','<button title="บันทึกข้อมูลผู้ประสบปัญหา สคส.02" type="button" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>&nbsp;<button title="บันทึกผลการพิจารณา" type="button" class="btn btn-default"><span class="glyphicon glyphicon-ok"></span></button>&nbsp;<button title="พิมพ์ใบเสร็จรับเงิน" type="button" class="btn btn-default"><span class="glyphicon glyphicon-file"></span></button>&nbsp;<button data-id=7 onclick="opn(this)" title="ลบ" type="button" class="btn btn-default"><span class="glyphicon glyphicon-trash"></span></button>'],
            ["8", "1509901360611", "นายคมกฤช หมูคำปัน",'76 ปี','18 หมู่ 5 ต.แม่ยวบ อ.แม่สะเรียง จ.แม่ฮ่องสอน','<font color=green>ตรวจเยี่ยมแล้ว</font>','<font color=green>อนุมัติ</font>','<button title="บันทึกข้อมูลผู้ประสบปัญหา สคส.02" type="button" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>&nbsp;<button title="บันทึกผลการพิจารณา" type="button" class="btn btn-default"><span class="glyphicon glyphicon-ok"></span></button>&nbsp;<button title="พิมพ์ใบเสร็จรับเงิน" type="button" class="btn btn-default"><span class="glyphicon glyphicon-file"></span></button>&nbsp;<button data-id=8 onclick="opn(this)" title="ลบ" type="button" class="btn btn-default"><span class="glyphicon glyphicon-trash"></span></button>'],
            ["9", "1509901360611", "นายคมกฤช หมูคำปัน",'76 ปี','18 หมู่ 5 ต.แม่ยวบ อ.แม่สะเรียง จ.แม่ฮ่องสอน','<font color=green>ตรวจเยี่ยมแล้ว</font>','<font color=green>อนุมัติ</font>','<button title="บันทึกข้อมูลผู้ประสบปัญหา สคส.02" type="button" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>&nbsp;<button title="บันทึกผลการพิจารณา" type="button" class="btn btn-default"><span class="glyphicon glyphicon-ok"></span></button>&nbsp;<button title="พิมพ์ใบเสร็จรับเงิน" type="button" class="btn btn-default"><span class="glyphicon glyphicon-file"></span></button>&nbsp;<button data-id=9 onclick="opn(this)" title="ลบ" type="button" class="btn btn-default"><span class="glyphicon glyphicon-trash"></span></button>'],            
            ["10", "1509901360611", "นายคมกฤช หมูคำปัน",'76 ปี','18 หมู่ 5 ต.แม่ยวบ อ.แม่สะเรียง จ.แม่ฮ่องสอน','<font color=green>ตรวจเยี่ยมแล้ว</font>','<font color=green>อนุมัติ</font>','<button title="บันทึกข้อมูลผู้ประสบปัญหา สคส.02" type="button" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>&nbsp;<button title="บันทึกผลการพิจารณา" type="button" class="btn btn-default"><span class="glyphicon glyphicon-ok"></span></button>&nbsp;<button title="พิมพ์ใบเสร็จรับเงิน" type="button" class="btn btn-default"><span class="glyphicon glyphicon-file"></span></button>&nbsp;<button data-id=10 onclick="opn(this)" title="ลบ" type="button" class="btn btn-default"><span class="glyphicon glyphicon-trash"></span></button>'],
            ["11", "1509901360611", "นายคมกฤช หมูคำปัน",'76 ปี','18 หมู่ 5 ต.แม่ยวบ อ.แม่สะเรียง จ.แม่ฮ่องสอน','<font color=green>ตรวจเยี่ยมแล้ว</font>','<font color=green>อนุมัติ</font>','<button title="บันทึกข้อมูลผู้ประสบปัญหา สคส.02" type="button" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>&nbsp;<button title="บันทึกผลการพิจารณา" type="button" class="btn btn-default"><span class="glyphicon glyphicon-ok"></span></button>&nbsp;<button title="พิมพ์ใบเสร็จรับเงิน" type="button" class="btn btn-default"><span class="glyphicon glyphicon-file"></span></button>&nbsp;<button data-id=11 onclick="opn(this)" title="ลบ" type="button" class="btn btn-default"><span class="glyphicon glyphicon-trash"></span></button>'],
            ["12", "1509901360611", "นายคมกฤช หมูคำปัน",'76 ปี','18 หมู่ 5 ต.แม่ยวบ อ.แม่สะเรียง จ.แม่ฮ่องสอน','<font color=green>ตรวจเยี่ยมแล้ว</font>','<font color=green>อนุมัติ</font>','<button title="บันทึกข้อมูลผู้ประสบปัญหา สคส.02" type="button" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>&nbsp;<button title="บันทึกผลการพิจารณา" type="button" class="btn btn-default"><span class="glyphicon glyphicon-ok"></span></button>&nbsp;<button title="พิมพ์ใบเสร็จรับเงิน" type="button" class="btn btn-default"><span class="glyphicon glyphicon-file"></span></button>&nbsp;<button data-id=12 onclick="opn(this)" title="ลบ" type="button" class="btn btn-default"><span class="glyphicon glyphicon-trash"></span></button>'],            
            ["13", "1509901360611", "นายคมกฤช หมูคำปัน",'76 ปี','18 หมู่ 5 ต.แม่ยวบ อ.แม่สะเรียง จ.แม่ฮ่องสอน','<font color=green>ตรวจเยี่ยมแล้ว</font>','<font color=green>อนุมัติ</font>','<button title="บันทึกข้อมูลผู้ประสบปัญหา สคส.02" type="button" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>&nbsp;<button title="บันทึกผลการพิจารณา" type="button" class="btn btn-default"><span class="glyphicon glyphicon-ok"></span></button>&nbsp;<button title="พิมพ์ใบเสร็จรับเงิน" type="button" class="btn btn-default"><span class="glyphicon glyphicon-file"></span></button>&nbsp;<button data-id=13 onclick="opn(this)" title="ลบ" type="button" class="btn btn-default"><span class="glyphicon glyphicon-trash"></span></button>'],
            ["14", "1509901360611", "นายคมกฤช หมูคำปัน",'76 ปี','18 หมู่ 5 ต.แม่ยวบ อ.แม่สะเรียง จ.แม่ฮ่องสอน','<font color=green>ตรวจเยี่ยมแล้ว</font>','<font color=green>อนุมัติ</font>','<button title="บันทึกข้อมูลผู้ประสบปัญหา สคส.02" type="button" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>&nbsp;<button title="บันทึกผลการพิจารณา" type="button" class="btn btn-default"><span class="glyphicon glyphicon-ok"></span></button>&nbsp;<button title="พิมพ์ใบเสร็จรับเงิน" type="button" class="btn btn-default"><span class="glyphicon glyphicon-file"></span></button>&nbsp;<button data-id=14 onclick="opn(this)" title="ลบ" type="button" class="btn btn-default"><span class="glyphicon glyphicon-trash"></span></button>'],
            ["15", "1509901360611", "นายคมกฤช หมูคำปัน",'76 ปี','18 หมู่ 5 ต.แม่ยวบ อ.แม่สะเรียง จ.แม่ฮ่องสอน','<font color=green>ตรวจเยี่ยมแล้ว</font>','<font color=green>อนุมัติ</font>','<button title="บันทึกข้อมูลผู้ประสบปัญหา สคส.02" type="button" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>&nbsp;<button title="บันทึกผลการพิจารณา" type="button" class="btn btn-default"><span class="glyphicon glyphicon-ok"></span></button>&nbsp;<button title="พิมพ์ใบเสร็จรับเงิน" type="button" class="btn btn-default"><span class="glyphicon glyphicon-file"></span></button>&nbsp;<button data-id=15 onclick="opn(this)" title="ลบ" type="button" class="btn btn-default"><span class="glyphicon glyphicon-trash"></span></button>']
        ],		
        rowReorder: {
            selector: 'td:nth-child(4)'
        },
        responsive: true
    } );
} );

$('#myModal').on('show', function() {var id = $(this).data('id'),removeBtn = $(this).find('.danger');});

$('.confirm-delete').on('click', function(e) {e.preventDefault();var id = $(this).data('id');$('#myModal').data('id', id).modal('show');});

$('#btnYes').click(function() {
    // handle deletion here
    var id = $('#myModal').data('id');
    $('[data-id='+id+']').remove();
    $('#myModal').modal('hide');
});

var opn = function(node) {
    var id = $(node).data('id');
    $('#myModal').data('id', id).modal('show');
}

</script>




