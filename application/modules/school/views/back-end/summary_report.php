 	<!-- Load CSS Theme for Datatable Reponsive -->
   <link href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css" rel="stylesheet">
   <link href="https://cdn.datatables.net/rowreorder/1.2.0/css/rowReorder.dataTables.min.css" rel="stylesheet">
   <link href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.dataTables.min.css" rel="stylesheet">
   <!-- End Load CSS Theme for Datatable Reponsive -->

<!-- Alert Notifications -->
<?php
$state_form= $this->session->flashdata('state_form');
$msg_form= $this->session->flashdata('msg_form');
if($state_form =='2') {
?>
  <div class="alert alert-success alert-dismissable fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>เสร็จสิ้น!</strong> <?php echo $msg_form;?>
  </div>
  <script>
    window.setTimeout(function() { $(".alert-success").alert('close'); }, 2000);
  </script>
<?php
}else if($state_form =='-1') {
?>
  <div class="alert alert-danger alert-dismissable fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>ล้มเหลว!</strong> <?php echo $msg_form;?>
  </div>
<?php
}
?>
<!-- End Alert Notifications -->

   <div class="row" style="margin: 5px;">
	   <div class="col-xs-12 col-sm-12 text-right">

           <?php
            $tmp = $this->admin_model->chkOnce_usrmPermiss(25,$user_id); //Check User Permission
            if(isset($tmp['perm_can_edit'])) {
                if($tmp['perm_can_edit']=='Yes') {
           ?>
          <a style="background-color: #81d00d; color: #fff;" href="<?php echo site_url('difficult/summary_report/Edit/pdf');?>" title="Export PDF <?php echo $tmp['app_name'];?>" class="btn btn-default">
            <span class="fa fa-file-pdf-o"></span> Export PDF <?php echo $tmp['app_name'];?>
          </a>
           <?php
                }
            }
           ?> 

           <a style="background-color: #1277eb; color: #fff;" title="กรองข้อมูล" class="btn btn-info">
            <span class="glyphicon glyphicon-filter"></span>
		      </a>
	   </div>
   </div>


		<table id="example" class="display nowrap" cellspacing="0" width="99%" style="font-size:18px">
			<thead>
                <tr>
                    <th>#</th>
                    <th>ชื่อ-นามสกุล  ผู้ขอรับบริการ</th>
                    <th>บัตรประจำตัวประชาชน</th>
                    <th>วันที่แจ้ง</th>
                    <th>วันที่ลงเยี่ยมบ้าน</th>
                    <th>สภาพปัญหาความเดือดร้อน</th>
                    <th>ผลการให้ความช่วยเหลือ</th>
                </tr>
			</thead>
			<tfoot>
                <tr>
                    <th>#</th>
                    <th>ชื่อ-นามสกุล  ผู้ขอรับบริการ</th>
                    <th>บัตรประจำตัวประชาชน</th>
                    <th>วันที่แจ้ง</th>
                    <th>วันที่ลงเยี่ยมบ้าน</th>
                    <th>สภาพปัญหาความเดือดร้อน</th>
                    <th>ผลการให้ความช่วยเหลือ</th>
                </tr>
			</tfoot>
			
			<tbody>
      <?php
      $number = 1;
      foreach ($diff_info as $key => $value) {
      ?>
                <tr>
                    <td><?php echo $number;?></td>
                    <td><?php echo $value['req_name'];?></td>
                    <td><?php echo $value['pers_id'];?></td>
                    <td><?php echo formatDateThai1($value['date_of_req'])?></td>
                    <td><?php echo formatDateThai1($value['date_of_visit'])?></td>
                    <td><?php echo nameTitle($value['visit_alm_trouble'],100);?></td>
                    <td><?php echo nameTitle($value['visit_alm_help'],100);?></td>
                </tr>
      <?php
        $number++;
      }
      ?>
			</tbody>
			
		</table>

<!-- Trigger the modal with a button -->
<!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button> -->

<!-- Modal -->
<div id="dltModel" class="modal fade" role="dialog">
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
        rowReorder: {
            selector: 'td:nth-child(4)'
        },
        responsive: true
    } );
} );

$('#dltModel').on('show', function() {var id = $(this).data('id'),removeBtn = $(this).find('.danger');});

//$('.confirm-delete').on('click', function(e) {e.preventDefault();var id = $(this).data('id');$('#myModal').data('id', id).modal('show');});

$('#btnYes').click(function() {
    window.location.replace('<?php echo site_url('difficult/sufferer_preform1');?>'+'/Delete/'+$('#dltModel').data('id'));
});

var opn = function(node) {
    var id = $(node).data('id');
    $('#dltModel').data('id', id).modal('show');
}

</script>




