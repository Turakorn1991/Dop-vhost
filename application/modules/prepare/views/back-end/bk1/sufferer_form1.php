<link href="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
<script src="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>

<!-- Trigger the modal with a button -->
<!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#DltModel">Open Modal</button> -->

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
        <p>ระบบจะดำเนินการลบรายการข้อมูล</p>
        <p>ยืนยันการลบ?</p>
      </div>
      <div class="modal-footer">
        <button id="dltbtnYes" type="button" class="btn btn-danger">ตกลง</button>
        <button type="button" aria-hidden="true" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div id="calModel" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">ยกเลิก</h4>
      </div>
      <div class="modal-body">
        <p>ระบบจะดำเนินการยกเลิกรายการข้อมูล</p>
        <p>ยืนยันการยกเลิก?</p>
      </div>
      <div class="modal-footer">
        <button id="calbtnYes" type="button" class="btn btn-warning">ตกลง</button>
        <button type="button" aria-hidden="true" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div id="savModel" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">บันทึกข้อมูล</h4>
      </div>
      <div class="modal-body">
        <p>ระบบจะดำเนินการบันทึกรายการข้อมูล</p>
        <p>ยืนยันการบันทึก?</p>
      </div>
      <div class="modal-footer">
        <button id="savbtnYes" type="button" class="btn btn-success">ตกลง</button>
        <button type="button" aria-hidden="true" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
      </div>
    </div>
  </div>
</div>

   <div class="row" style="margin: 5px;">

   	   <div class="col-sm-3 text-left hidden-xs text-muted">
   	   		<!-- <h3><?php echo $title;?></h3> -->
   	   </div>

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

            <div class="panel-heading"><h4>ข้อมูลคำขอรับบริการ</h4></div>
            <div class="panel-body" style="padding: 20px;">
                <div class="form-group row">
                	<div class="col-xs-12 col-sm-6">
	                    <label for="example-text-input" class="col-2 col-form-label">วันที่แจ้งเรื่อง</label>

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
                	<div class="col-xs-12 col-sm-6">
	                    <label for="example-text-input" class="col-2 col-form-label">ผู้เพิ่มรายการ</label>
	                    <div class="col-10">
            <?php
              $user = get_session('user_firstname').' '.get_session('user_lastname');
            ?>  	                    
	                    	<?php echo $user;?> (<?php echo dtParse(getDatetime());?>)
	                	</div>
                	</div>
                </div>
                <div class="form-group row">
                	<div class="col-xs-12 col-sm-6">
	                    <label for="example-text-input" class="col-2 col-form-label">ผู้แก้ไขรายการล่าสุด</label>
	                    <div class="col-10">
	                    	-
	                	</div>
                	</div>
                	<div class="col-xs-12 col-sm-6">
	                    <label for="example-text-input" class="col-2 col-form-label">ผู้ลบรายการ</label>
	                    <div class="col-10">
	                    	-
	                	</div>
                	</div>
                </div>
            </div>  

            <div class="panel-heading"><h4>ข้อมูลผู้สูงอายุ</h4></div>
            <div class="panel-body" style="padding: 20px;">

                <div class="form-group row">
                	<div class="col-xs-12 col-sm-3">
	                    <label for="example-text-input" class="col-2 col-form-label"></label>
	                    <div class="col-10">
							<div class="radio">
							  <label><input title="มีบัตรประจำตัวประชาชน" type="radio" name="optradio">มีบัตรประจำตัวประชาชน</label>
							</div>
	                	</div>
                	</div>
                	<div class="col-xs-12 col-sm-3">
	                    <label for="example-text-input" class="col-2 col-form-label">เลขประจำตัวประชาชน</label>
	                    <div class="col-10 input-group">
							<input title="13 หลัก" placeholder="13 หลัก" class="form-control" type="text" />
							<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>	
	                	</div>
                	</div>
                	<div class="col-xs-12 hidden-xs col-sm-offset-6">

                	</div>

                	<div class="col-xs-12 col-sm-offset-3 col-sm-3">
	                    <label for="example-text-input" class="col-2 col-form-label">วันที่ออกบัตร</label>
						<div id="datetimepicker2" class="col-10 input-group date" data-date-format="dd-mm-yyyy">
						    <input title="เลือกวันที่" placeholder="เลือกวันที่" class="form-control" type="text"/>
						    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
						</div>	                	
					    <script type="text/javascript">
							$(function () {
								$("#datetimepicker2").datepicker({ 
								    autoclose: true, 
								    todayHighlight: true
								}).datepicker('update', new Date());;
							});
					    </script>
                	</div>   
                	<div class="col-xs-12 col-sm-3">
	                    <label for="example-text-input" class="col-2 col-form-label">วันที่บัตรหมดอายุ</label>
						<div id="datetimepicker3" class="col-10 input-group date" data-date-format="dd-mm-yyyy">
						    <input title="เลือกวันที่" placeholder="เลือกวันที่" class="form-control" type="text"/>
						    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
						</div>	                	
					    <script type="text/javascript">
							$(function () {
								$("#datetimepicker3").datepicker({ 
								    autoclose: true, 
								    todayHighlight: true
								}).datepicker('update', new Date());;
							});
					    </script>
                	</div>
                	<div class="col-xs-12 col-sm-3">
	                    <label for="example-text-input" class="col-2 col-form-label">สถานที่ออกบัตร</label>
	                    <div class="col-10">
							<input title="สถานที่ออกบัตร" class="form-control" type="text"/>
	                	</div>
                	</div>                	
                </div>

                <div class="form-group row">

                	<div class="col-xs-12 col-sm-3">
	                    <label for="example-text-input" class="col-2 col-form-label"></label>
	                    <div class="col-10">
							<div class="radio">
							  <label><input title="ไม่มีบัตร/ไม่สามารถระบุได้" type="radio" name="optradio">ไม่มีบัตร/ไม่สามารถระบุได้</label>
							</div>
	                	</div>
                	</div>
                	<div class="col-xs-12 col-sm-9">
	                    <label for="example-text-input" class="col-2 col-form-label">เนื่องจาก</label>
	                    <div class="col-10">
							<input title="เนื่องจาก" class="form-control" type="text" />
	                	</div>
                	</div>  

                	<div class="col-xs-12 hidden-xs">

                	</div>                	

                	<div class="col-xs-12 col-sm-3">
	                    <label for="example-text-input" class="col-2 col-form-label">คำนำหน้านาม</label>
	                    <div class="col-10">
							<input title="คำนำหน้านาม" class="form-control" type="text" />
	                	</div>
                	</div>
                	<div class="col-xs-12 col-sm-3">
	                    <label for="example-text-input" class="col-2 col-form-label">ชื่อตัว <input title="ชื่อตัว" checked type="checkbox" name=""></label>
	                    <div class="col-10">
							<input title="ชื่อตัว" class="form-control" type="text" />
	                	</div>
                	</div>  
                	<div class="col-xs-12 col-sm-3">
	                    <label for="example-text-input" class="col-2 col-form-label">ชื่อสกุล</label>
	                    <div class="col-10">
							<input title="ชื่อสกุล" class="form-control" type="text" />
	                	</div>
                	</div>  
                	<div class="col-xs-12 hidden-xs col-sm-offset-3">

                	</div> 

                	<div class="col-xs-12 col-sm-3">
	                    <label for="example-text-input" class="col-2 col-form-label">วัน-เดือน-ปีเกิด</label>
						<div id="datetimepicker4" class="col-10 input-group date" data-date-format="dd-mm-yyyy">
						    <input title="เลือกวันที่" placeholder="เลือกวันที่" class="form-control" type="text"/>
						    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
						</div>	                	
					    <script type="text/javascript">
							$(function () {
								$("#datetimepicker4").datepicker({ 
								    autoclose: true, 
								    todayHighlight: true
								}).datepicker('update', new Date());;
							});
					    </script>
                	</div>  
                	<div class="col-xs-12 col-sm-3">
	                    <label for="example-text-input" class="col-2 col-form-label">อายุ</label>
	                    <div class="col-10">
							<h5>65 ปี 3 เดือน 20 วัน</h5>
	                	</div>
                	</div>
                	<div class="col-xs-12 hidden-xs col-sm-offset-6">

                	</div>

                	<div class="col-xs-12 col-sm-3">
	                    <label for="example-text-input" class="col-2 col-form-label">วันที่เสียชีวิต</label>
						<div id="datetimepicker5" class="col-10 input-group date" data-date-format="dd-mm-yyyy">
						    <input title="เลือกวันที่" placeholder="เลือกวันที่" class="form-control" type="text"/>
						    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
						</div>	                	
					    <script type="text/javascript">
							$(function () {
								$("#datetimepicker5").datepicker({ 
								    autoclose: true, 
								    todayHighlight: true
								}).datepicker('update', new Date());;
							});
					    </script>
                	</div>
                	<div class="col-xs-12 col-sm-9">
	                    <label for="example-text-input" class="col-2 col-form-label">สาเหตุการเสียชีวิต</label>
	                    <div class="col-10">
							<input title="ระบุ" placeholder="ระบุ" class="form-control" type="text" />
	                	</div>
                	</div>  


                	<div class="col-xs-12 col-sm-3">
	                    <label for="example-text-input" class="col-2 col-form-label">เลขที่ใบมรณบัตร</label>
	                    <div class="col-10">
							<input title="เลขที่ใบมรณบัตร" class="form-control" type="text" />
	                	</div>
                	</div>
                	<div class="col-xs-12 col-sm-6">
	                    <label for="example-text-input" class="col-2 col-form-label">หน่วยงานที่ออกใบมรณบัตร</label>
	                    <div class="col-10">
							<input title="ชื่อหน่วยงาน" placeholder="ชื่อหน่วยงาน" class="form-control" type="text" />
	                	</div>
                	</div>  
                	<div class="col-xs-12 col-sm-3">
	                    <label for="example-text-input" class="col-2 col-form-label">วันที่ออกใบมรณบัตร</label>
						<div id="datetimepicker6" class="col-10 input-group date" data-date-format="dd-mm-yyyy">
						    <input title="เลือกวันที่" placeholder="เลือกวันที่" class="form-control" type="text"/>
						    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
						</div>	                	
					    <script type="text/javascript">
							$(function () {
								$("#datetimepicker6").datepicker({ 
								    autoclose: true, 
								    todayHighlight: true
								}).datepicker('update', new Date());;
							});
					    </script>
                	</div>


                	<div class="col-xs-12 col-sm-3">
	                    <label for="example-text-input" class="col-2 col-form-label">เพศ</label>
	                    <div class="col-10">
							<h5><input title="ชาย" type="radio" value="m" name="sex"> ชาย 
							  <input title="หญิง" type="radio" value="f" name="sex"> หญิง 
							 </h5>
	                	</div>
                	</div>
                	<div class="col-xs-12 col-sm-3">
	                    <label for="example-text-input" class="col-2 col-form-label">เชื้อชาติ</label>
	                    <div class="col-10">
							<input title="ระบุ" placeholder="ระบุ" class="form-control" type="text" />
	                	</div>
                	</div> 
                	<div class="col-xs-12 col-sm-3 dropdown">
	                    <label for="example-text-input" class="col-2 col-form-label">สัญชาติ</label>
	                    <div class="col-10">
							<select title="เลือก" placeholder="เลือก" class="form-control" id="sel1">
							    <option>เลือก</option>
							    <option>ไทย</option>
							    <option>ไทย1</option>
							    <option>ไทย2</option>
							</select>
	                	</div>
                	</div>
                	<div class="col-xs-12 col-sm-3 dropdown">
	                    <label for="example-text-input" class="col-2 col-form-label">ศาสนา</label>
	                    <div class="col-10">
							<select title="เลือก" placeholder="เลือก" class="form-control" id="sel1">
							    <option>เลือก</option>
							    <option>ไทย</option>
							    <option>ไทย1</option>
							    <option>ไทย2</option>
							</select>
	                	</div>
                	</div>

                	<div class="col-xs-12">
                		<h4><b>ที่อยู่ (ตามทะเบียนบ้าน)</b> <input checked title="ที่อยู่ (ตามทะเบียนบ้าน)" type="checkbox" name=""></h4>
                	</div>

                	<div class="col-xs-12">
                		<h4><b>สถานะการพักอาศัย</b></h4>
                	</div>
                	<div class="col-xs-12 col-sm-3">
	                    <div class="col-10">
							<input title="บ้านตนเอง" type="radio" value="m" name="addr">&nbsp;บ้านตนเอง
	                	</div>
                	</div>
                	<div class="col-xs-12 col-sm-3">
	                    <div class="col-10">
							<input title="อาศัยผู้อื่นอยู่" type="radio" value="m" name="addr">&nbsp;อาศัยผู้อื่นอยู่
	                	</div>
                	</div>
                	<div class="col-xs-12 col-sm-3">
	                    <div class="col-10">
							<input title="บ้านเช่า" type="radio" value="m" name="addr">&nbsp;บ้านเช่า
	                	</div>
                	</div>
                	<div class="col-xs-12 col-sm-3">
	                    <div class="col-10">
							<input title="อยู่กับผู้จ้าง" type="radio" value="m" name="addr">&nbsp;อยู่กับผู้จ้าง
	                	</div>
                	</div>
                	<div class="col-xs-12 col-sm-3">
	                    <div class="col-10">
							<input title="ไม่มีที่อยู่เป็นหลักแหล่ง" type="radio" value="m" name="addr">&nbsp;ไม่มีที่อยู่เป็นหลักแหล่ง
	                	</div>
                	</div>                	                	
                	<div class="col-xs-12 hidden-xs col-sm-offset-9">
                			&nbsp;
                	</div>

                	<div class="col-xs-12">
                		<h4><b>ลักษณะการครอบครองที่ดิน</b></h4>
                	</div>
                	<div class="col-xs-12 col-sm-3">
	                    <div class="col-10">
							<input title="ที่ดินตนเอง" type="radio" value="m" name="occupy">&nbsp;ที่ดินตนเอง
	                	</div>
                	</div>
                	<div class="col-xs-12 col-sm-3">
	                    <div class="col-10">
							<input title="ที่ดินเช่า" type="radio" value="m" name="occupy">&nbsp;ที่ดินเช่า
	                	</div>
                	</div>               	                	
                	<div class="col-xs-12 hidden-xs col-sm-offset-6">
                			&nbsp;
                	</div>

	                <div class="col-xs-12 col-sm-3">
		                <label for="example-text-input" class="col-2 col-form-label">เลขรหัสประจำบ้าน</label>
		                <div class="col-10 input-group">
							<input title="13 หลัก" placeholder="13 หลัก" class="form-control" type="text" />
							<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>	
		                </div>
	                </div>
	                <div class="col-xs-12 col-sm-6">
		                <label for="example-text-input" class="col-2 col-form-label">ชื่อสำนักทะเบียน</label>
		                <div class="col-10">
							<input title="ระบุ" class="form-control" placeholder="ระบุ" type="text" />
		                </div>
	                </div>
	                <div class="col-xs-12 col-sm-3">
		                <label for="example-text-input" class="col-2 col-form-label">บ้านเลขที่</label>
		                <div class="col-10">
							<input title="บ้านเลขที่" class="form-control" type="text" />
		                </div>
	                </div>

	                <div class="col-xs-12 col-sm-3">
		                <label for="example-text-input" class="col-2 col-form-label">หมู่ที่</label>
		                <div class="col-10">
							<input title="หมู่ที่" class="form-control" type="text" />
		                </div>
	                </div>
	                <div class="col-xs-12 col-sm-3">
		                <label for="example-text-input" class="col-2 col-form-label">ตรอก</label>
		                <div class="col-10">
							<input title="ตรอก" class="form-control" type="text" />
		                </div>
	                </div>
	                <div class="col-xs-12 col-sm-3">
		                <label for="example-text-input" class="col-2 col-form-label">ซอย</label>
		                <div class="col-10">
							<input title="ซอย" class="form-control" type="text" />
		                </div>
	                </div>
	                <div class="col-xs-12 col-sm-3">
		                <label for="example-text-input" class="col-2 col-form-label">ถนน</label>
		                <div class="col-10">
							<input title="ถนน" class="form-control" type="text" />
		                </div>
	                </div>

 	                <div class="col-xs-12 col-sm-3">
		                <label for="example-text-input" class="col-2 col-form-label">จังหวัด</label>
	                    <div class="col-10">
							<select title="เลือก" placeholder="เลือก" class="form-control" id="sel1">
							    <option>เลือก</option>
							    <option>2</option>
							    <option>3</option>
							    <option>4</option>
							</select>
	                	</div>
	                </div>
	                <div class="col-xs-12 col-sm-3">
		                <label for="example-text-input" class="col-2 col-form-label">อำเภอ</label>
	                    <div class="col-10">
							<select title="เลือก" placeholder="เลือก" class="form-control" id="sel1">
							    <option>เลือก</option>
							    <option>2</option>
							    <option>3</option>
							    <option>4</option>
							</select>
	                	</div>
	                </div>
	                <div class="col-xs-12 col-sm-3">
		                <label for="example-text-input" class="col-2 col-form-label">ตำบล</label>
	                    <div class="col-10">
							<select title="เลือก" placeholder="เลือก" class="form-control" id="sel1">
							    <option>เลือก</option>
							    <option>2</option>
							    <option>3</option>
							    <option>4</option>
							</select>
	                	</div>
	                </div>
	                <div class="col-xs-12 col-sm-3">
		                <label for="example-text-input" class="col-2 col-form-label">รหัสไปรษณีย์</label>
		                <div class="col-10">
							<input title="5 หลัก" placeholder="5 หลัก" class="form-control" type="text" />
		                </div>
	                </div>               

                	<div class="col-xs-12">
                		<h6>ที่อยู่ (ปัจจุบัน) <input title="ที่อยู่ (ปัจจุบัน)" checked type="checkbox" name="">&nbsp;&nbsp;&nbsp;(<input title="ที่อยู่ (ปัจจุบัน)" type="checkbox" name=""> ตรงกับที่อยู่ตามทะเบียนบ้าน)</h6>
                	</div>
	                <div class="col-xs-12 col-sm-3">
		                <label for="example-text-input" class="col-2 col-form-label">เลขรหัสประจำบ้าน</label>
		                <div class="col-10 input-group">
							<input title="13 หลัก" placeholder="13 หลัก" class="form-control" type="text" />
							<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>	
		                </div>
	                </div>
	                <div class="col-xs-12 col-sm-6">
		                <label for="example-text-input" class="col-2 col-form-label">ชื่อสำนักทะเบียน</label>
		                <div class="col-10">
							<input title="ระบุ" class="form-control" placeholder="ระบุ" type="text" />
		                </div>
	                </div>
	                <div class="col-xs-12 col-sm-3">
		                <label for="example-text-input" class="col-2 col-form-label">บ้านเลขที่</label>
		                <div class="col-10">
							<input title="บ้านเลขที่" class="form-control" type="text" />
		                </div>
	                </div>

	                <div class="col-xs-12 col-sm-3">
		                <label for="example-text-input" class="col-2 col-form-label">หมู่ที่</label>
		                <div class="col-10">
							<input title="หมู่ที่" class="form-control" type="text" />
		                </div>
	                </div>
	                <div class="col-xs-12 col-sm-3">
		                <label for="example-text-input" class="col-2 col-form-label">ตรอก</label>
		                <div class="col-10">
							<input title="ตรอก" class="form-control" type="text" />
		                </div>
	                </div>
	                <div class="col-xs-12 col-sm-3">
		                <label for="example-text-input" class="col-2 col-form-label">ซอย</label>
		                <div class="col-10">
							<input title="ซอย" class="form-control" type="text" />
		                </div>
	                </div>
	                <div class="col-xs-12 col-sm-3">
		                <label for="example-text-input" class="col-2 col-form-label">ถนน</label>
		                <div class="col-10">
							<input title="ถนน" class="form-control" type="text" />
		                </div>
	                </div>

 	                <div class="col-xs-12 col-sm-3">
		                <label for="example-text-input" class="col-2 col-form-label">จังหวัด</label>
	                    <div class="col-10">
							<select title="เลือก" placeholder="เลือก" class="form-control" id="sel1">
							    <option>เลือก</option>
							    <option>2</option>
							    <option>3</option>
							    <option>4</option>
							</select>
	                	</div>
	                </div>
	                <div class="col-xs-12 col-sm-3">
		                <label for="example-text-input" class="col-2 col-form-label">อำเภอ</label>
	                    <div class="col-10">
							<select title="เลือก" placeholder="เลือก" class="form-control" id="sel1">
							    <option>เลือก</option>
							    <option>2</option>
							    <option>3</option>
							    <option>4</option>
							</select>
	                	</div>
	                </div>
	                <div class="col-xs-12 col-sm-3">
		                <label for="example-text-input" class="col-2 col-form-label">ตำบล</label>
	                    <div class="col-10">
							<select title="เลือก" placeholder="เลือก" class="form-control" id="sel1">
							    <option>เลือก</option>
							    <option>2</option>
							    <option>3</option>
							    <option>4</option>
							</select>
	                	</div>
	                </div>
	                <div class="col-xs-12 col-sm-3">
		                <label for="example-text-input" class="col-2 col-form-label">รหัสไปรษณีย์</label>
		                <div class="col-10">
							<input title="5 หลัก" placeholder="5 หลัก" class="form-control" type="text" />
		                </div>
	                </div> 

                	<div class="col-xs-12 col-sm-3">
	                    <label for="example-text-input" class="col-2 col-form-label">ตำแหน่งพิกัดภูมิศาสตร์</label>
	                    <div class="col-10 input-group">
							<input title="ระบุพิกัด" placeholder="ระบุพิกัด" class="form-control" type="text" />
							<span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>	
	                	</div>
                	</div>
	                <div class="col-xs-12 col-sm-3">
		                <label for="example-text-input" class="col-2 col-form-label">เบอร์โทรศัพท์ (บ้าน)</label>
		                <div class="col-10">
							<input title="เบอร์โทรศัพท์ (บ้าน)" class="form-control" type="text" />
		                </div>
	                </div>
                	<div class="col-xs-12 col-sm-3">
	                    <label for="example-text-input" class="col-2 col-form-label">เบอร์โทรศัพท์ (มือถือ)</label>
	                    <div class="col-10">
							<input title="เบอร์โทรศัพท์ (มือถือ)" class="form-control" type="text" />	
	                	</div>
                	</div>
	                <div class="col-xs-12 col-sm-3">
		                <label for="example-text-input" class="col-2 col-form-label">เบอร์โทรศัพท์ (แฟกซ์)</label>
		                <div class="col-10">
							<input title="เบอร์โทรศัพท์ (แฟกซ์)" class="form-control" type="text" />
		                </div>
	                </div>

                	<div class="col-xs-12 col-sm-6">
		                <label for="example-text-input" class="col-2 col-form-label">ที่อยู่อีเมล</label>
		                <div class="col-10">
							<input title="ระบุ" placeholder="ระบุ" class="form-control" type="text" />
		                </div>
                	</div>               	                	
                	<div class="col-xs-12 hidden-xs col-sm-offset-6">
                			&nbsp;
                	</div>

	                <div class="col-xs-12 col-sm-3">
		                <label for="example-text-input" class="col-2 col-form-label">สถานะการสมรส</label>
	                    <div class="col-10">
							<select title="เลือก" placeholder="เลือก" class="form-control" id="sel1">
							    <option>เลือก</option>
							    <option>2</option>
							    <option>3</option>
							    <option>4</option>
							</select>
	                	</div>
	                </div>
	                <div class="col-xs-12 col-sm-3">
		                <label for="example-text-input" class="col-2 col-form-label">ระดับการศึกษา</label>
	                    <div class="col-10">
							<select title="เลือก" placeholder="เลือก" class="form-control" id="sel1">
							    <option>เลือก</option>
							    <option>2</option>
							    <option>3</option>
							    <option>4</option>
							</select>
	                	</div>
	                </div>
                	<div class="col-xs-12 col-sm-6">
                		<label for="example-text-input" class="col-2 col-form-label">&nbsp;</label>
		                <div class="col-10">
							<input title="ระบุ" placeholder="ระบุ" class="form-control" type="text" />
		                </div>
                	</div> 	                

                	<div class="col-xs-12 col-sm-6">
                		<label for="example-text-input" class="col-2 col-form-label">อาชีพ (ปัจจุบัน) <input title="อาชีพ (ปัจจุบัน)" checked type="checkbox" name=""></label>
		                <div class="col-10">
							<input title="อาชีพ (ปัจจุบัน)" class="form-control" type="text" />
		                </div>
                	</div> 	
                	<div class="col-xs-12 col-sm-6">
                		<label for="example-text-input" class="col-2 col-form-label">อาชีพ (เดิม)</label>
		                <div class="col-10">
							<input title="อาชีพ (เดิม)" class="form-control" type="text" />
		                </div>
                	</div> 		

                	<div class="col-xs-12 col-sm-3">
                		<label for="example-text-input" class="col-2 col-form-label">รายได้เฉลี่ยต่อเดือน (บาท)</label>
		                <div class="col-10">
							<input title="รายได้เฉลี่ยต่อเดือน (บาท)" class="form-control" type="text" />
		                </div>
                	</div> 	
	                <div class="col-xs-12 col-sm-3">
		                <label for="example-text-input" class="col-2 col-form-label">ที่มาของรายได้</label>
	                    <div class="col-10">
							<select title="เลือก" placeholder="เลือก" class="form-control" id="sel1">
							    <option>เลือก</option>
							    <option>2</option>
							    <option>3</option>
							    <option>4</option>
							</select>
	                	</div>
	                </div>
                	<div class="col-xs-12 col-sm-6">
                		<label for="example-text-input" class="col-2 col-form-label">&nbsp;</label>
		                <div class="col-10">
							<input title="ระบุ" placeholder="ระบุ" class="form-control" type="text" />
		                </div>
                	</div> 	

                	<div class="col-xs-12 col-sm-3">
	                    <label for="example-text-input" class="col-2 col-form-label">เลขประจำตัวประชาชน (บิดา)</label>
	                    <div class="col-10 input-group">
							<input title="13 หลัก" placeholder="13 หลัก" class="form-control" type="text" />
							<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>	
	                	</div>
                	</div>
                	<div class="col-xs-12 col-sm-3">
	                    <label for="example-text-input" class="col-2 col-form-label">คำนำหน้านาม (บิดา)</label>
	                    <div class="col-10">
							<input title="คำนำหน้านาม (บิดา)" class="form-control" type="text" />
	                	</div>
                	</div>
                	<div class="col-xs-12 col-sm-3">
	                    <label for="example-text-input" class="col-2 col-form-label">ชื่อตัว (บิดา)</label>
	                    <div class="col-10">
							<input title="ชื่อตัว (บิดา)" class="form-control" type="text" />
	                	</div>
                	</div>
                	<div class="col-xs-12 col-sm-3">
	                    <label for="example-text-input" class="col-2 col-form-label">ชื่อสกุล (บิดา)</label>
	                    <div class="col-10">
							<input title="ชื่อสกุล (บิดา)" class="form-control" type="text" />
	                	</div>
                	</div>                	

                	<div class="col-xs-12 col-sm-3">
	                    <label for="example-text-input" class="col-2 col-form-label">เลขประจำตัวประชาชน (มารดา)</label>
	                    <div class="col-10 input-group">
							<input title="13 หลัก" placeholder="13 หลัก" class="form-control" type="text" />
							<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>	
	                	</div>
                	</div>
                	<div class="col-xs-12 col-sm-3">
	                    <label for="example-text-input" class="col-2 col-form-label">คำนำหน้านาม (มารดา)</label>
	                    <div class="col-10">
							<input title="คำนำหน้านาม (มารดา)" class="form-control" type="text" />
	                	</div>
                	</div>
                	<div class="col-xs-12 col-sm-3">
	                    <label for="example-text-input" class="col-2 col-form-label">ชื่อตัว (มารดา)</label>
	                    <div class="col-10">
							<input title="ชื่อตัว (มารดา)" class="form-control" type="text" />
	                	</div>
                	</div>
                	<div class="col-xs-12 col-sm-3">
	                    <label for="example-text-input" class="col-2 col-form-label">ชื่อสกุล (มารดา)</label>
	                    <div class="col-10">
							<input title="ชื่อสกุล (มารดา)" class="form-control" type="text" />
	                	</div>
                	</div>  

                </div>

            </div>

            <div class="panel-heading"><h4>ข้อมูลผู้ยื่นคำขอ (ผู้แจ้งเรื่อง)</h4></div>
            <div class="panel-body" style="padding: 20px;">

               <div class="form-group row">
                	<div class="col-xs-12 col-sm-3">
	                    <label for="example-text-input" class="col-2 col-form-label"></label>
	                    <div class="col-10">
							<div class="radio">
							  <label><input title="มีบัตรประจำตัวประชาชน" type="radio" name="optradio">มีบัตรประจำตัวประชาชน</label>
							</div>
	                	</div>
                	</div>
                	<div class="col-xs-12 col-sm-3">
	                    <label for="example-text-input" class="col-2 col-form-label">เลขประจำตัวประชาชน</label>
	                    <div class="col-10 input-group">
							<input title="13 หลัก" placeholder="13 หลัก" class="form-control" type="text" />
							<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>	
	                	</div>
                	</div>
                	<div class="col-xs-12 hidden-xs col-sm-offset-6">

                	</div>

                	<div class="col-xs-12 col-sm-offset-3 col-sm-3">
	                    <label for="example-text-input" class="col-2 col-form-label">วันที่ออกบัตร</label>
						<div id="datetimepicker7" class="col-10 input-group date" data-date-format="dd-mm-yyyy">
						    <input title="เลือกวันที่" placeholder="เลือกวันที่" class="form-control" type="text"/>
						    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
						</div>	                	
					    <script type="text/javascript">
							$(function () {
								$("#datetimepicker7").datepicker({ 
								    autoclose: true, 
								    todayHighlight: true
								}).datepicker('update', new Date());;
							});
					    </script>
                	</div>   
                	<div class="col-xs-12 col-sm-3">
	                    <label for="example-text-input" class="col-2 col-form-label">วันที่บัตรหมดอายุ</label>
						<div id="datetimepicker8" class="col-10 input-group date" data-date-format="dd-mm-yyyy">
						    <input title="เลือกวันที่" placeholder="เลือกวันที่" class="form-control" type="text"/>
						    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
						</div>	                	
					    <script type="text/javascript">
							$(function () {
								$("#datetimepicker8").datepicker({ 
								    autoclose: true, 
								    todayHighlight: true
								}).datepicker('update', new Date());;
							});
					    </script>
                	</div>
                	<div class="col-xs-12 col-sm-3">
	                    <label for="example-text-input" class="col-2 col-form-label">สถานที่ออกบัตร</label>
	                    <div class="col-10">
							<input title="สถานที่ออกบัตร" class="form-control" type="text"/>
	                	</div>
                	</div>                	
                </div>

                <div class="form-group row">

                	<div class="col-xs-12 col-sm-3">
	                    <label for="example-text-input" class="col-2 col-form-label"></label>
	                    <div class="col-10">
							<div class="radio">
							  <label><input title="ไม่มีบัตร/ไม่สามารถระบุได้" type="radio" name="optradio">ไม่มีบัตร/ไม่สามารถระบุได้</label>
							</div>
	                	</div>
                	</div>
                	<div class="col-xs-12 col-sm-9">
	                    <label for="example-text-input" class="col-2 col-form-label">เนื่องจาก</label>
	                    <div class="col-10">
							<input title="เนื่องจาก" class="form-control" type="text" />
	                	</div>
                	</div>                	

                	<div class="col-xs-12 col-sm-3">
	                    <label for="example-text-input" class="col-2 col-form-label">คำนำหน้านาม</label>
	                    <div class="col-10">
							<input title="คำนำหน้านาม" class="form-control" type="text" />
	                	</div>
                	</div>
                	<div class="col-xs-12 col-sm-3">
	                    <label for="example-text-input" class="col-2 col-form-label">ชื่อตัว <input title="ชื่อตัว" checked type="checkbox" name=""></label>
	                    <div class="col-10">
							<input title="ชื่อตัว" class="form-control" type="text" />
	                	</div>
                	</div>  
                	<div class="col-xs-12 col-sm-3">
	                    <label for="example-text-input" class="col-2 col-form-label">ชื่อสกุล</label>
	                    <div class="col-10">
							<input title="ชื่อสกุล" class="form-control" type="text" />
	                	</div>
                	</div>  
                	<div class="col-xs-12 hidden-xs col-sm-offset-3">
                	&nbsp;
                	</div> 

                	<div class="col-xs-12 col-sm-3">
	                    <label for="example-text-input" class="col-2 col-form-label">วัน-เดือน-ปีเกิด</label>
						<div id="datetimepicker9" class="col-10 input-group date" data-date-format="dd-mm-yyyy">
						    <input title="เลือกวันที่" placeholder="เลือกวันที่" class="form-control" type="text"/>
						    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
						</div>	                	
					    <script type="text/javascript">
							$(function () {
								$("#datetimepicker9").datepicker({ 
								    autoclose: true, 
								    todayHighlight: true
								}).datepicker('update', new Date());;
							});
					    </script>
                	</div>
                	<div class="col-xs-12 col-sm-3">
	                    <label for="example-text-input" class="col-2 col-form-label">อายุ</label>
	                    <div class="col-10">
							<h5>65 ปี 3 เดือน 20 วัน</h5>
	                	</div>
                	</div>
                	<div class="col-xs-12 col-sm-6">
	                    <label for="example-text-input" class="col-2 col-form-label">เพศ</label>
	                    <div class="col-10">
							<h5><input title="ชาย" type="radio" value="m" name="sex1"> ชาย 
							  <input title="หญิง" type="radio" value="f" name="sex1"> หญิง 
							 </h5>
	                	</div>
                	</div>

                	<div class="col-xs-12 col-sm-6">
	                    <label for="example-text-input" class="col-2 col-form-label">ตำแหน่ง</label>
	                    <div class="col-10">
							<input title="ตำแหน่ง" class="form-control" type="text" />
	                	</div>
                	</div>
                	<div class="col-xs-12 col-sm-6">
	                    <label for="example-text-input" class="col-2 col-form-label">หน่วยงาน</label>
	                    <div class="col-10">
							<input title="หน่วยงาน" class="form-control" type="text" />
	                	</div>
                	</div>

                	<div class="col-xs-12">
                		<h4><b>ที่อยู่ (ปัจจุบัน)</b></h4>
                	</div>
	                <div class="col-xs-12 col-sm-3">
		                <label for="example-text-input" class="col-2 col-form-label">เลขรหัสประจำบ้าน</label>
		                <div class="col-10 input-group">
							<input title="13 หลัก" placeholder="13 หลัก" class="form-control" type="text" />
							<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>	
		                </div>
	                </div>
	                <div class="col-xs-12 col-sm-6">
		                <label for="example-text-input" class="col-2 col-form-label">ชื่อสำนักทะเบียน</label>
		                <div class="col-10">
							<input title="ระบุ" class="form-control" placeholder="ระบุ" type="text" />
		                </div>
	                </div>
	                <div class="col-xs-12 col-sm-3">
		                <label for="example-text-input" class="col-2 col-form-label">บ้านเลขที่</label>
		                <div class="col-10">
							<input title="บ้านเลขที่" class="form-control" type="text" />
		                </div>
	                </div>

	                <div class="col-xs-12 col-sm-3">
		                <label for="example-text-input" class="col-2 col-form-label">หมู่ที่</label>
		                <div class="col-10">
							<input title="หมู่ที่" class="form-control" type="text" />
		                </div>
	                </div>
	                <div class="col-xs-12 col-sm-3">
		                <label for="example-text-input" class="col-2 col-form-label">ตรอก</label>
		                <div class="col-10">
							<input title="ตรอก" class="form-control" type="text" />
		                </div>
	                </div>
	                <div class="col-xs-12 col-sm-3">
		                <label for="example-text-input" class="col-2 col-form-label">ซอย</label>
		                <div class="col-10">
							<input title="ซอย" class="form-control" type="text" />
		                </div>
	                </div>
	                <div class="col-xs-12 col-sm-3">
		                <label for="example-text-input" class="col-2 col-form-label">ถนน</label>
		                <div class="col-10">
							<input title="ถนน" class="form-control" type="text" />
		                </div>
	                </div>

 	                <div class="col-xs-12 col-sm-3">
		                <label for="example-text-input" class="col-2 col-form-label">จังหวัด</label>
	                    <div class="col-10">
							<select title="เลือก" placeholder="เลือก" class="form-control" id="sel1">
							    <option>เลือก</option>
							    <option>2</option>
							    <option>3</option>
							    <option>4</option>
							</select>
	                	</div>
	                </div>
	                <div class="col-xs-12 col-sm-3">
		                <label for="example-text-input" class="col-2 col-form-label">อำเภอ</label>
	                    <div class="col-10">
							<select title="เลือก" placeholder="เลือก" class="form-control" id="sel1">
							    <option>เลือก</option>
							    <option>2</option>
							    <option>3</option>
							    <option>4</option>
							</select>
	                	</div>
	                </div>
	                <div class="col-xs-12 col-sm-3">
		                <label for="example-text-input" class="col-2 col-form-label">ตำบล</label>
	                    <div class="col-10">
							<select title="เลือก" placeholder="เลือก" class="form-control" id="sel1">
							    <option>เลือก</option>
							    <option>2</option>
							    <option>3</option>
							    <option>4</option>
							</select>
	                	</div>
	                </div>
	                <div class="col-xs-12 col-sm-3">
		                <label for="example-text-input" class="col-2 col-form-label">รหัสไปรษณีย์</label>
		                <div class="col-10">
							<input title="5 หลัก" placeholder="5 หลัก" class="form-control" type="text" />
		                </div>
	                </div> 

	                <div class="col-xs-12 col-sm-3">
		                <label for="example-text-input" class="col-2 col-form-label">เบอร์โทรศัพท์ (บ้าน)</label>
		                <div class="col-10">
							<input title="เบอร์โทรศัพท์ (บ้าน)" class="form-control" type="text" />
		                </div>
	                </div>
                	<div class="col-xs-12 col-sm-3">
	                    <label for="example-text-input" class="col-2 col-form-label">เบอร์โทรศัพท์ (มือถือ)</label>
	                    <div class="col-10">
							<input title="เบอร์โทรศัพท์ (มือถือ)" class="form-control" type="text" />	
	                	</div>
                	</div>
	                <div class="col-xs-12 col-sm-3">
		                <label for="example-text-input" class="col-2 col-form-label">เบอร์โทรศัพท์ (แฟกซ์)</label>
		                <div class="col-10">
							<input title="เบอร์โทรศัพท์ (แฟกซ์)" class="form-control" type="text" />
		                </div>
	                </div>
                	<div class="col-xs-12 hidden-xs col-sm-offset-3">
                	&nbsp;
                	</div> 
                </div>
            </div>

			<div class="panel-heading"><h4>ข้อมูลเบื้องต้น</h4></div>
            <div class="panel-body" style="padding: 20px;">

               <div class="form-group row">
                	<div class="col-xs-12 col-sm-12">
					  <label for="comment">ปัญหาความเดือดร้อน</label>
					  <textarea title="ปัญหาความเดือดร้อน" class="form-control" rows="5" id="comment"></textarea>
                	</div>
                	<div class="col-xs-12 col-sm-12">
					  <label for="comment">ความต้องการช่วยเหลือ</label>
					  <textarea title="ความต้องการช่วยเหลือ" class="form-control" rows="5" id="comment"></textarea>
                	</div>
               </div>
            </div>


            <div class="form-group row">
            	<div class="col-xs-12 text-center">
					<input type='hidden' name='state' value=''>

            		<button onclick="$('input[name=state]').val(1); $('#savModel').modal('show'); return false;" title="บันทึกข้อมูล" class="btn btn-primary"><i class="fa fa-floppy-o"></i>&nbsp;บันทึกข้อมูล</button>
            	
            		<button onclick="$('input[name=state]').val(2); $('#savModel').modal('show'); return false;" title="บันทึกข้อมูลแล้วกลับไปหน้าหลัก" class="btn btn-info"><i class="glyphicon glyphicon-saved"></i>&nbsp;บันทึกข้อมูลแล้วกลับไปหน้าหลัก</button>

                	<button onclick="$('#calModel').modal('show');" title="ยกเลิก" class="btn btn-default inputBT"><i class="fa fa-ban"></i>&nbsp;ยกเลิก</button>
            	</div>
            </div>

        </div>
    </div>

    <?php
    echo form_close();
    ?>

<script>

$('#savbtnYes').click(function() {
	//Modified for Demo
	if($("input[name='state']").val()==1)
		window.location.replace('<?php echo site_url('difficult/sufferer_preform1/success');?>');
	else
		window.location.replace('<?php echo site_url('difficult/assistList');?>');
});

$('#calbtnYes').click(function() {
    window.location.replace('<?php echo site_url('difficult/assistList');?>');
});

$('#dltbtnYes').click(function() {
    window.location.replace('<?php echo site_url('difficult/assistList');?>');
});

$("button.inputBT").click(function(){
	return false;
});


</script>

