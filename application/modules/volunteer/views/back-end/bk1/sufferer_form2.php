
   <div class="row" style="margin: 5px;">
	   <div class="col-xs-12 col-sm-9 text-right">
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

            <div class="panel-heading">ข้อมูลการตรวจเยี่ยม</div>
            <div class="panel-body" style="padding: 20px;">
                <div class="form-group row">
                	<div class="col-xs-12 col-sm-3">
	                    <label for="example-text-input" class="col-2 col-form-label">วันที่ตรวจเยี่ยม</label>

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
	                    <label for="example-text-input" class="col-2 col-form-label">เจ้าหน้าที่ผู้ตรวจเยี่ยม</label>
	                    <div class="col-10">
							<input title="เจ้าหน้าที่ผู้ตรวจเยี่ยม" class="form-control" type="text"/>
	                	</div>
                	</div>

                	<div class="col-xs-12 col-sm-offset-6 col-sm-6">
	                    <label for="example-text-input" class="col-2 col-form-label">ชื่อตำแหน่ง (เจ้าหน้าที่ผู้ตรวจเยี่ยม)</label>
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

            <div class="panel-heading">ข้อมูลผลการตรวจเยี่ยม</div>
            <div class="panel-body" style="padding: 20px;">

                <div class="form-group row">

                	<div class="col-xs-12 col-sm-3 dropdown">
	                    <label for="example-text-input" class="col-2 col-form-label">สถานที่ตรวจเยี่ยม</label>
	                    <div class="col-10">
							<select title="เลือก" placeholder="เลือก" class="form-control" id="sel1">
							    <option>เลือก</option>
							    <option>ไทย</option>
							    <option>ไทย1</option>
							    <option>ไทย2</option>
							</select>
	                	</div>
                	</div>
                	<div class="col-xs-12 col-sm-9">
	                    <label for="example-text-input" class="col-2 col-form-label">&nbsp;</label>
	                    <div class="col-10">
							<input title="ระบุ" placeholder="ระบุ" class="form-control" type="text" />
	                	</div>
                	</div> 

                	<div class="col-xs-12 col-sm-12">
					  <label for="comment">ความคิดเห็นนักสังคมสงเคราะห์</label>
					  <textarea title="ความคิดเห็นนักสังคมสงเคราะห์" class="form-control" rows="5" id="comment"></textarea>
                	</div>

                	<div class="col-xs-12 col-sm-12">
					  <label for="comment">สภาพปัญหาความเดือดร้อน</label>
					  <textarea title="สภาพปัญหาความเดือดร้อน" class="form-control" rows="5" id="comment"></textarea>
                	</div>

                	<div class="col-xs-12 col-sm-12">
					  <label for="comment">ผลการให้ความช่วยเหลือ</label>
					  <textarea title="ผลการให้ความช่วยเหลือ" class="form-control" rows="5" id="comment"></textarea>
                	</div>

                	<div class="col-xs-12 col-sm-12">
					  <label for="comment">แนวทางการช่วยเหลือ</label>
					  <textarea title="แนวทางการช่วยเหลือ" class="form-control" rows="5" id="comment"></textarea>
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
           