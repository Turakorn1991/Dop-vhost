<link rel="stylesheet" href="<?php echo base_url("assets/plugins/Static_Full_Version/css/plugins/ionRangeSlider/ion.rangeSlider.css") ?>" type="text/css"  />
<link rel="stylesheet" href="<?php echo base_url("assets/plugins/Static_Full_Version/css/plugins/ionRangeSlider/ion.rangeSlider.css") ?>" type="text/css"  />
<link rel="stylesheet" href="<?php echo base_url("assets/plugins/Static_Full_Version/css/plugins/ionRangeSlider/ion.rangeSlider.skinFlat.css") ?>" type="text/css"  />

<!-- search-->
  <div class="collapse" id="collapseExample">
  <div class="well" style="background-color: rgb(255, 255, 255);">
     <div class="container-fluid">

        <form class='school-list-filter-form' action="<?=base_url('school/school_list')?>" method='post'>

          <input type="hidden" name='<?=$csrf['name']?>' value='<?=$csrf['hash']?>'>

          <div class="form-group row">
            <div class="col-xs-12 col-sm-12"><h3><label>ค้นหา</label></h3></div>
          </div>

          <div class="form-group row">
            <div class="col-xs-12 col-sm-3">
              <h3><label for="col1_filter">ชื่อโรงเรียน:</label></h3>
            </div>
            <div class="col-xs-12 col-sm-6">
              <!-- filter name -->
              <input
                data-column="1"
                type="text"
                class="form-control column_filter"
                id="col1_filter"
                placeholder="ชื่อหน่วยงาน ศพอส."
                name='schl_name'
              >
            </div>
          </div>

          <div class="form-group row">
            <div class="col-xs-12 col-sm-3" style="padding-top: 12px;" >
              <h3><label for="col3_filter">จังหวัด:</label></h3>
            </div>
            <div class="col-xs-12 col-sm-3" style="padding-top: 12px;">
              <!-- filter province -->
              <select
                title="จังหวัด"
                placeholder="เลือกจังหวัด"
                class="form-control column_filter"
                id="Province"
                name="addr_province"
                onchange="optionGen(this,'Amphur',<?php echo @$center_info['addr_district']; ?>);"
              >
                <option value="">เลือกจังหวัด</option>
                <?php $temp = $this->personal_model->getAll_Province();foreach ($temp as $key => $row): ?>
                  <option value="<?=$row['area_code']?>"> <?=$row['area_name_th']?></option>
                <?php endforeach;?>
              </select>
            </div>

            <div class="col-xs-12 col-sm-2" style="padding-top: 12px;">
              <h3><label for="col5_filter">ปีที่จัดตั้ง:</label></h3>
            </div>
            <div class="col-xs-12 col-sm-4" style="padding-top: 12px;">
              <!-- filter established year from -->
              <select
                class='column_filter'
                style="width: 30%; padding: 4px 12px;"
                title="ปีงบ"
                placeholder="เลือกปี"
                id="SponsorYear"
                name="year_of_established_from"
              >
                <option value="" selected>ปี</option>
                <?php for ($year = date("Y") - 100; $year <= date("Y"); $year++): ?>
                  <option value="<?=$year?>"><?=$year + 543?></option>
                <?php endfor;?>
              </select>

              <span class="">&nbsp;&nbsp;&nbsp;</span><span class="">ถึง</span><span class="">&nbsp;&nbsp;&nbsp;</span>

              <!-- filter established year to -->
              <select
                class='column_filter'
                style="width: 30%; padding: 4px 12px;"
                title="ปีงบ"
                placeholder="เลือกปี"
                id="SponsorYear2"
                name="year_of_established_to"
              >
                <option value="" selected>ปี</option>
                <?php for ($year = date("Y") - 100; $year <= date("Y"); $year++): ?>
                  <option value="<?=$year?>"><?=$year + 543?></option>
                <?php endfor;?>
              </select>
            </div>
          </div>

          <div class="form-group row">
            <div class="col-xs-12 col-sm-3" style="padding-top: 12px;" >
              <h3><label for="col7_filter">เกรดของการประเมินปีล่าสุด (ประจำปี <?=date("Y") + 543;?>):</label></h3>
            </div>
            <div class="col-xs-12 col-sm-3" style="padding-top: 12px;">
              <!-- filter school grade -->
              <select
                title="เกรดปีล่าสุด"
                placeholder="เลือกเกรด"
                class="form-control column_filter"
                id="LatestGrade"
                name="models_count"
              >
                <option value="">เลือกเกรด</option>
                <option value="15,20">A (4 ดาว)</option>
                <option value="12,15">B (3 ดาว)</option>
                <option value="9,12">C (2 ดาว)</option>
                <option value="0,9">D (1 ดาว)</option>
              </select>
            </div>

            <div class="col-xs-12 col-sm-2" style="padding-top: 12px;">
              <h3><label for="col8_filter">สถานะของโรงเรียน:</label></h3>
            </div>
            <div class="col-xs-12 col-sm-3" style="padding-top: 12px;">
              <!-- filter status -->
              <select
                title="เรียงลำดับข้อมูล"
                placeholder="เลือกหัวข้อ"
                class="form-control column_filter"
                id="obf"
                name="schl_status"
              >
                <option value="">เลือกสถานะ</option>
                <option value="Active">ดำเนินการ (Active)</option>
                <option value="Inactive">ไม่ดำเนินการ (Inactive)</option>
              </select>
            </div>
          </div>

          <div class="row">
            <div class="col-xs-12 col-sm-8">&nbsp;</div>
            <div class="col-xs-12 col-sm-4 right" style="padding-right: 3px;">
              <button
                class="btn btn-primary btn-save"
                type="submit"
                title="ค้นหา"
                style=" background-color: #2f4050;border: 1px;"
                name='filter_schools'
              >
                <i class="fa fa-search" aria-hidden="true"></i>
                ค้นหา
              </button>

              <a
                href="<?php echo base_url('' . uri_seg(1) . '/' . uri_seg(2)); ?>"
                class="btn btn-primary  btn-cancel"
                type="button"
                title="ล้างค่า"
                style=" background-color: #2f4050;border: 1px;"
              >
                <i class="fa fa-refresh" aria-hidden="true"></i>
                ล้างค่า
              </a>
            </div>
          </div>
        </form>

     </div><!-- End class="container-fluid"-->
  </div><!-- Endclass="well" -->
</div><!-- End class="collapse"-->
<!-- End search -->

<script>
  // var gender = 'false';

    $(function () {

   /*$("#range").ionRangeSlider({
          type: "double",
          min: 1,
          max: 100,
          from: 60,
          to: 80,
          prefix: "",
          postfix: " ปี",
          decorate_both: false,
          values_separator: " to ",
          grid: true,

          onChange:function(data){
            $('#col4_filter').val($('#range').val());
          }
        });*/ // do new filter : ซ่อน function

    //เช็คกรณีไม่ระบุเลขบัตรประจำตัวประชาชน
    /*$('#disablepid').on('change',function(){
        if($(this).prop('checked')){
          $('#col1_filter').prop('disabled','disabled');
        }else{
          $('#col1_filter').prop('disabled','');
        }
    });*/ // do new filter : ซ่อน function

    //กดล้างค่า
    $('#btnclear').click(function(){

       /*$('.column_filter').each(function(){
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
       $('input[name=end]').val('');*/ // do new filter : comment

    });

    /*=== do new filter : start code ===*/
    //เลือกภาค
    $('#FourRegions').change(function(){
      FourRegions = $(this).val();
          console.log('111',FourRegions);
          $('#col2_filter').val($(this).val());
    });
    //เลือกจังหวัด
    $('#Province').change(function(){
      Province = $(this).val();
          console.log('111',Province);
          $('#col3_filter').val(Province);
    });
    //เลือกอำเภอ
    $('#Amphur').change(function(){
      Amphur = $(this).val();
          console.log('111',Amphur);
      Amphur2 = Amphur.substring(0,4)+"%";
          console.log('111',Amphur2);
          //$('#col4_filter').val($(this).val());
          $('#col4_filter').val(Amphur2);
    });
    //เลือกปี
    $('#SponsorYear').change(function(){
      Year = $(this).val().trim();
          console.log('111',Year);
          //$('#col4_filter').val($(this).val());
          $('#col5_filter').val(Year);
    });
    //เลือกปี2
    $('#SponsorYear2').change(function(){
      Year2 = $(this).val().trim();
          console.log('111',Year2);
          //$('#col4_filter').val($(this).val());
          $('#col6_filter').val(Year2);
    });
    //เลือกเกรดปีล่าสุด
    $('#LatestGrade').change(function(){
      LatestGrade = $(this).val();
          console.log('111',LatestGrade);
          //$('#col4_filter').val($(this).val());
          $('#col7_filter').val(LatestGrade);
    });
    //เลือกหัวข้อในการเรียงลำดับข้อมูล
    $('#obf').change(function(){
      obf = $(this).val();
          console.log('111',obf);
          //$('#col4_filter').val($(this).val());
          $('#col8_filter').val(obf);
    });

    //เลือกเงื่อนไขในการเรียงลำดับข้อมูล
    /*$('#oba').change(function(){
      oba = $(this).val();
          console.log('111',oba);
          //$('#col4_filter').val($(this).val());
          $('#col9_filter').val(oba);
    });*/


    /*=== do new filter : start code ===*/



    //เลือกเพศ
    /*$('#gender').change(function(){
         // gender = $(this).val();
         // console.log(gender);
          $(this).prev().val($(this).val());
    });*/ // do new filter : ซ่อน function

    //เลือกถึงวันที่
    /*$('#datepicker').change(function(){
        var statusoper  = $('#statusoper').val();
        var composedate = $('input[name=start]').val()+'_'+$('input[name=end]').val();
         if(statusoper == 'date_of_reg'){
           $('#col5_filter').val(composedate);
         }else if(statusoper == 'date_of_visit'){
           $('#col6_filter').val(composedate);
         }else if(statusoper == 'date_of_pay'){
           $('#col7_filter').val(composedate);
         }
    });*/ // do new filter : ซ่อน function



    });
</script>

<script type="text/javascript">



                  <?php if ($process_action == 'Edited') {?>
                  setTimeout(function(){$("#Province").val('<?php echo @$center_info['addr_province']; ?>').trigger('change');},200);
                  //setTimeout(function(){$("#Amphur").val('<?php echo @$addr_info['district_code']; ?>').trigger('change');},300);
                  // setTimeot(function(){$("#Tambon").val('<?php echo @$addr_info['sub_district_code']; ?>').trigger('change');},400);

                <?php }?>
                function set_enable(elem,target='') {
                  if(elem.prop('checked') == true) {
                    $(target).prop('disabled', false ).focus();
                  }else{
                    $(target).val('');
                    $(target).prop('disabled', true );
                  }
                }
                function optionGen(code,target,opSelect) {
                  // alert(code.value);
                  // alert(target);
                  $.ajax({
                    url: base_url+'personals/get_Area_option',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                      'code': code.value,
                      'type': target,
                      <?php echo $csrf['name']; ?>: '<?php echo $csrf['hash']; ?>'
                    },
                  })
                  .done(function(ret) {
                    console.log("success");
                    console.dir(ret);
                    $('#'+target).empty();
                    $('#'+target).prop('disabled', false);
                    if(target == 'Amphur'){
                      str = "เลือกอำเภอ";
                    }else if(target == 'Tambon'){
                      str = "เลือกตำบล";
                    }
                    $('#'+target).append($('<option>', {
                      value: '',
                      text : str
                    }));
                    for (var i = 0; i < ret.length ; i++) {
                      // if(ret[i].area_code == opSelect){
                        $('#'+target).append($('<option>', {
                          value: ret[i].area_code,
                          text : ret[i].area_name_th
                        }));
                      // }else{
                      //   $('#'+target).append($('<option>', {
                      //     value: ret[i].area_code,
                      //     text : ret[i].area_name_th
                      //   }));
                      // }
                    }
                    $('#'+target).val(opSelect).trigger('change');
                  })
                  .fail(function() {
                    console.log("error");
                  });
                }

            </script> <!-- do new filter : ซ่อน function -->

<script>
  const POSTED = <?=$posted ? json_encode($posted) : 'null'?>;
  if (POSTED) {
    for (let key in POSTED) {
      if (POSTED[key]) $('[name='+key+']').val(POSTED[key]);
    }
  }
</script>