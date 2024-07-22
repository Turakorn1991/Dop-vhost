
   <div class="row" style="margin: 5px;">
	   <div class="col-xs-12 col-sm-12 text-right">
		   <button title="เอกสาร" type="button" class="btn btn-default" style="padding-left: 20px; padding-right:20px;margin-bottom:2px;"><span class="glyphicon glyphicon-print"></span>
		   </button>
		   <button title="บันทึก" type="button" class="btn btn-default" style="padding-left: 20px; padding-right:20px;margin-bottom:2px;"><span class="glyphicon glyphicon-floppy-disk"></span>
		   </button>
		   <button title="ย้อนกลับ" type="button" class="btn btn-default" style="padding-left: 20px; padding-right:20px;margin-bottom:2px;"><span class="glyphicon glyphicon-arrow-left"></span>
		   </button>
		   <button title="ลบ" type="button" class="btn btn-default" style="padding-left: 20px; padding-right:20px;margin-bottom:2px;"><span class="glyphicon glyphicon-trash"></span>
		   </button>
	   </div>
   </div>

    <div class="panel-group">
        <div class="panel panel-default">

            <div class="panel-heading">ข้อมูลการพิจารณา</div>
            <div class="panel-body" style="padding: 20px;">
                <div class="form-group row">
                	<div class="col-xs-12 col-sm-3">
	                    <label for="example-text-input" class="col-2 col-form-label">วันที่พิจารณาอนุมัติ</label>

						<div id="datetimepicker1" class="col-10 input-group date" data-date-format="dd-mm-yyyy">
						    <input title="เลือกวันที่" placeholder="เลือกวันที่" class="form-control" type="text"/>
						    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
						</div>	                	
					    <script type="text/javascript">
							$(function () {
								$("#datetimepicker1").datepicker({ 
								    autoclose: true, 
								    todayHighlight: true
								}).datepicker('update', new Date());;
							});
					    </script>

                	</div>
                	<div class="col-xs-12 col-sm-offset-3 col-sm-6">
	                    <label for="example-text-input" class="col-2 col-form-label">เจ้าหน้าที่ผู้พิจารณาอนุมัติ</label>
	                    <div class="col-10">
							<input title="เจ้าหน้าที่ผู้ตรวจเยี่ยม" class="form-control" type="text"/>
	                	</div>
                	</div>

                	<div class="col-xs-12 col-sm-offset-6 col-sm-6">
	                    <label for="example-text-input" class="col-2 col-form-label">ชื่อตำแหน่ง (เจ้าหน้าที่ผู้พิจารณาอนุมัติ)</label>
	                    <div class="col-10">
							<input title="ชื่อตำแหน่ง (เจ้าหน้าที่ผู้ตรวจเยี่ยม)" class="form-control" type="text"/>
	                	</div>
                	</div>
                </div>
            </div>  

            <div class="panel-heading">ข้อมูลผู้สูงอายุ</div>
            <div class="panel-body" style="padding: 20px;">

                <div class="form-group row">
                	<div class="col-xs-12 col-sm-3">
	                    <label for="example-text-input" class="col-2 col-form-label">เลขประจำตัวประชาชน</label>
	                    <div class="col-10 input-group">
							<h4>15099013601360611</h4>	
	                	</div>
                	</div>

                 	<div class="col-xs-12 col-sm-6">
	                    <label for="example-text-input" class="col-2 col-form-label">ชื่อ-สกุล</label>
	                    <div class="col-10 input-group">
							<h4>นายคมกฤช หมูคำปัน</h4>	
	                	</div>
                	</div>
                 	
                 	<div class="col-xs-12 col-sm-3">
	                    <label for="example-text-input" class="col-2 col-form-label">เพศ</label>
	                    <div class="col-10 input-group">
							<h4>ชาย</h4>	
	                	</div>
                	</div>

                 	<div class="col-xs-12 col-sm-3">
	                    <label for="example-text-input" class="col-2 col-form-label">วันเดือนปีเกิด</label>
	                    <div class="col-10 input-group">
							<h4>12 กพ. 2484</h4>	
	                	</div>
                	</div>
                 	<div class="col-xs-12 col-sm-3">
	                    <label for="example-text-input" class="col-2 col-form-label">วันที่เสียชีวิต</label>
	                    <div class="col-10 input-group">
							<h4>-</h4>	
	                	</div>
                	</div>
                 	<div class="col-xs-12 col-sm-3">
	                    <label for="example-text-input" class="col-2 col-form-label">อายุ</label>
	                    <div class="col-10 input-group">
							<h4>65 ปี 3 เดือน 45 วัน</h4>	
	                	</div>
                	</div>
                 	<div class="col-xs-12 col-sm-3">
	                    <label for="example-text-input" class="col-2 col-form-label">เบอร์โทรศัพท์ (มือถือ)</label>
	                    <div class="col-10 input-group">
							<h4>0963426620</h4>	
	                	</div>
                	</div>

                 	<div class="col-xs-12 col-sm-6">
	                    <label for="example-text-input" class="col-2 col-form-label">ที่อยู่ (ปัจจุบัน)</label>
	                    <div class="col-10 input-group">
							<h4>18 หมู่ 5 ต.แม่ยวม อ.แม่สะเรียง จ.แม่ฮ่องสอน</h4>	
	                	</div>
                	</div>
                 	<div class="col-xs-12 col-sm-3">
	                    <label for="example-text-input" class="col-2 col-form-label">อาชีพ (ปัจจุบัน)</label>
	                    <div class="col-10 input-group">
							<h4>รับจ้างทั่วไป</h4>	
	                	</div>
                	</div>
                 	<div class="col-xs-12 col-sm-3">
	                    <label for="example-text-input" class="col-2 col-form-label">รายได้เฉลี่ยต่อเดือน (บาท)</label>
	                    <div class="col-10 input-group">
							<h4>1,800</h4>	
	                	</div>
                	</div>

                </div>
            </div>

            <div class="panel-heading">รายละเอียดประกอบการพิจารณา</div>
            <div class="panel-body" style="padding: 20px;">

                <div class="form-group row">

                	<div class="col-xs-12 col-sm-9">
	                    <label for="example-text-input" class="col-2 col-form-label">ปัญหาความเดือดร้อน</label>
	                    <div class="col-10">
							<input style="border:0; border-bottom: 2px #333 dashed;" title="ปัญหาความเดือดร้อน" class="form-control" type="text" />
	                	</div>
                	</div> 
                	<div class="col-xs-12 hidden-xs col-sm-offset-3">
                	</div>
                	<div class="col-xs-12 col-sm-9">
	                    <label for="example-text-input" class="col-2 col-form-label">ความคิดเห็นักสังคมสงเคราะห์</label>
	                    <div class="col-10">
							<input style="border:0; border-bottom: 2px #333 dashed;" title="ความคิดเห็นักสังคมสงเคราะห์" class="form-control" type="text" />
	                	</div>
                	</div> 
                	<div class="col-xs-12 hidden-xs col-sm-offset-3">
                	</div>


  
              	</div>
            </div>

            <div class="panel-heading">ผลการพิจารณา</div>
            <div class="panel-body" style="padding: 20px;">

                <div class="form-group row">
                	<div class="col-xs-12 col-sm-3">
	                    <label for="example-text-input" class="col-2 col-form-label">ผลการพิจารณา</label>
	                    <div class="col-10">
							<h4><input title="อนุมัติ" type="radio" value="m" name="result_approve"> อนุมัติ 
							  <input title="ไม่อนุมัติ" type="radio" value="f" name="result_approve"> ไม่อนุมัติ 
							 </h4>
	                	</div>
                	</div>
              		<div class="col-xs-12 col-sm-9">
					  <label for="comment">หมายเหตุ</label>
					  <textarea title="หมายเหตุ" class="form-control" rows="5" id="comment"></textarea>
                	</div>
  
              	</div>
            </div>


            <div class="form-group row">
            	<div class="col-xs-12 text-center">
            		<button onclick="window.location.replace('<?php echo site_url('difficult/assistList');?>')" title="บันทึกข้อมูล" type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-saved"></i>&nbsp;บันทึกข้อมูล</button>
            	</div>
            </div>

	</div>
</div>
           