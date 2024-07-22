<link rel="stylesheet" href="<?php echo base_url("assets/plugins/Static_Full_Version/css/plugins/ionRangeSlider/ion.rangeSlider.css")?>" type="text/css"  />
<link rel="stylesheet" href="<?php echo base_url("assets/plugins/Static_Full_Version/css/plugins/ionRangeSlider/ion.rangeSlider.css")?>" type="text/css"  />
<link rel="stylesheet" href="<?php echo base_url("assets/plugins/Static_Full_Version/css/plugins/ionRangeSlider/ion.rangeSlider.skinFlat.css")?>" type="text/css"  />

<!-- search-->
 <div class="collapse" id="collapseExample">
 <div class="well" style="background-color: rgb(255, 255, 255);">
    <div class="container-fluid">

       <div class="form-group row">
         <div class="col-xs-12 col-sm-12"><h3><label>ค้นหา</label></h3></div>
       </div>

       <div class="form-group row">
         <div class="col-xs-12 col-sm-3">
           <h3><label for="col1_filter">ชื่อสถานที่จัดกิจกรรมของผู้สูงอายุ:</label></h3>
         </div>
         <div class="col-xs-12 col-sm-6">
           <input data-column="1" type="text" class="form-control column_filter" id="col1_filter" placeholder="ชื่อสถานที่จัดกิจกรรมของผู้สูงอายุ">
         </div>
       </div>

       <div class="form-group row">
         <div class="col-xs-12 col-sm-3">
           <h3><label for="col5_filter">สถานะดำเนินการ:</label></h3>
         </div>
         <div class="col-xs-12 col-sm-4">

           <div class="form-group" id="data_5" data-date-format="dd-mm-yyyy">
             <div class="input-daterange input-group " id="datepicker">
               <input type="text" class="input-sm form-control" name="start" value="" placeholder="เลือกตั้งแต่วันที่" style="height: 34px;" />
               <span class="input-group-addon">ถึง</span>
               <input type="text" class="input-sm form-control" name="end" value="" placeholder="เลือกถึงวันที่" style="height: 34px;"/>
             </div>
           </div>
           <input type="hidden" data-column="3" class="column_filter" id="col3_filter">
           <input type="hidden" data-column="4" class="column_filter" id="col4_filter">
           <input type="hidden" data-column="5" class="column_filter" id="col5_filter">
           <input type="hidden" data-column="6" class="column_filter" id="col6_filter">
           <input type="hidden" data-column="7" class="column_filter" id="col7_filter">
           <input type="hidden" data-column="10" class="column_filter" id="col10_filter">
           <script type="text/javascript">

            $('#data_5 .input-daterange').datepicker({
             keyboardNavigation: false,
             forceParse: false,
             autoclose: true,
             language: 'th',
             thaiyear: true,
             format: 'dd/mm/yyyy',
             todayBtn: true
           });

         </script>
       </div>
       </div>

       <div class="row">
         <div class="col-xs-12 col-sm-3">
           <h3><label for="col6_filter">หน่วยงาน (ผู้บันทึกข้อมูล):</label></h3>
         </div>
         <div class="col-xs-12 col-sm-6">
           <?php $usrm = $this->common_model->custom_query("SELECT * FROM usrm_org"); ?>
           <select class="form-control">
             <?php foreach($usrm as $key=>$value) {?>
              <option><?php echo $value['org_title']; ?></option>
              <?php } ?>
           </select>
         </div>
       </div>

       <div class="row">
          <div class="col-xs-12 col-sm-8">&nbsp;</div>
          <div class="col-xs-12 col-sm-4 right" style="padding-right: 3px;">
              <button id="filtersearch" class="btn btn-primary btn-save" type="button"  title="ค้นหา" style=" background-color: #2f4050;border: 1px;"><i class="fa fa-search" aria-hidden="true"></i> ค้นหา</button>
              <a href="<?php echo base_url(''.uri_seg(1).'/'.uri_seg(2)); ?>"    class="btn btn-primary  btn-cancel" type="button" title="ค้นหา" style=" background-color: #2f4050;border: 1px;"><i class="fa fa-refresh" aria-hidden="true"></i> ล้างค่า</a>
          </div>
       </div>

    </div><!-- End class="container-fluid"-->
 </div><!-- Endclass="well" -->
</div><!-- End class="collapse"-->
<!-- End search -->

<script>

   $(function () {
     //เช็คกรณีไม่ระบุเลขบัตรประจำตัวประชาชน
     $('#disablepid').on('change',function(){
         if($(this).prop('checked')){
           $('#col1_filter').prop('disabled','disabled');
         }else{
           $('#col1_filter').prop('disabled','');
         }
     });

     //กดล้างค่า
     $('#btnclear').click(function(){

        $('.column_filter').each(function(){
            $(this).val('');
        });

        $('#gender').each(function(){
           if($(this).val()==0){
             $(this).prop('selected','selected');
           }
        });

        $('#statusoper').each(function(){
           if($(this).val()=='All'){
             $(this).prop('selected','selected');
           }
        });

        $('input[name=start]').val('');
        $('input[name=end]').val('');


     });

     //เลือกเพศ
     $('#gender').change(function(){
          // gender = $(this).val();
          // console.log(gender);
           $('#col3_filter').val($(this).val());
     });

     //เลือกถึงวันที่
     $('#datepicker').change(function(){
         var composedate = $('input[name=start]').val()+'_'+$('input[name=end]').val();
         $('#col4_filter').val(composedate);

     });


     $('#usrm_org').change(function(){
         $('#col10_filter').val($(this).val());
     });
   });
</script>
