 <link rel="stylesheet" href="<?php echo base_url("assets/plugins/Static_Full_Version/css/plugins/ionRangeSlider/ion.rangeSlider.css")?>" type="text/css"  />
 <link rel="stylesheet" href="<?php echo base_url("assets/plugins/Static_Full_Version/css/plugins/ionRangeSlider/ion.rangeSlider.css")?>" type="text/css"  />
 <link rel="stylesheet" href="<?php echo base_url("assets/plugins/Static_Full_Version/css/plugins/ionRangeSlider/ion.rangeSlider.skinFlat.css")?>" type="text/css"  />

<!-- search-->
  <div class="collapse" id="collapseExample">
  <div class="well" style="background-color: rgb(255, 255, 255);">
     <div id='voltFilterBox' class="container-fluid">

        <div class="form-group row">
          <div class="col-xs-12 col-sm-12"><h3><label>ค้นหา</label></h3></div>
        </div>

        <div class="form-group row ">
          <div class="col-xs-12 col-sm-2">
            <h3><label for="col1_filter">เลขประจำตัวประชาชน:</label></h3>
          </div>
          <div class="col-xs-12 col-sm-3">
            <input data-column="1" type="text" class="form-control column_filter input_idcard" id="col1_filter" placeholder="เลขประจำตัวประชาชน (13 หลัก)" name='pid'>
          </div>
        </div>

        <div class="form-group row">
          <div class="col-xs-12 col-sm-2">
            <h3><label for="col2_filter_firstname">ชื่อ:</label></h3>
          </div>
          <div class="col-xs-12 col-sm-3">
            <input type="text" class="form-control column_filter" id="col2_filter_firstname" placeholder="ชื่อ" name='pers_firstname_th'>
          </div>
          <div class="col-xs-12 col-sm-1">
            <h3><label for="col2_filter_lastname">นามสกุล:</label></h3>
          </div>
          <div class="col-xs-12 col-sm-3">
            <input type="text" class="form-control column_filter" id="col2_filter_lastname" placeholder="นามสกุล" name='pers_lastname_th'>
          </div>
        </div>

        <div class="form-group row">
          <div class="col-xs-12 col-sm-2" style="padding-top: 12px;" >
            <h3><label for="col4_filter">เพศ:</label></h3>
          </div>
          <div class="col-xs-12 col-sm-3" style="padding-top: 12px;">
          <select  class="form-control" id="gender" name='gender_code'>
            <option value="" disabled selected>ระบุเพศ</option>
            <?php
            $gender = $this->common_model->custom_query('SELECT * FROM std_gender');
            foreach ($gender as $key_gen => $value_gen) {
            ?>
            <option value="<?=$value_gen['gender_code']?>">
              <?=$value_gen['gender_name']?>
            </option>
            <?php } ?>
          </select>
          </div>
          <div class="col-xs-12 col-sm-1" style="padding-top: 12px;">
                 <h3><label>อายุ :</label></h3>
          </div>
          <div class="col-xs-12 col-sm-3" style="padding-top: 12px;">
            <div class="form-group">
              <div class="input-daterange input-group">
                <input type="number" min="0" max="140" class="input-sm form-control" name="date_of_birth_LE" placeholder="ไม่ระบุ" />
                <span class="input-group-addon">ถึง</span>
                <input type="number" min="0" max="140" class="input-sm form-control" name="date_of_birth_GE" placeholder="ไม่ระบุ" />
              </div>
            </div>
          </div>
          <div class="col-xs-12 col-sm-1" style="padding-top: 12px;">
            <h3><label>ปี</label></h3>
          </div>
        </div>

        <div class="form-group row">
          <div class="col-xs-12 col-sm-2">
            <h3><label for="col5_filter">สถานะดำเนินการ:</label></h3>
          </div>
          <div class="col-xs-12 col-sm-3">
            <select class="form-control" name='date_of_resign'>
              <option value="" disabled selected>ทุกสถานะ</option>
              <option value='is null' >Active</option>
              <option value='is not null'>Inactive</option>
            </select>
            <!-- <select class="form-control" name='date_of_reg'>
              <option value="!= 0000-00-00" disabled selected>วันที่ขึ้นทะเบียน</option>
            </select> -->
          </div>
          <div class="col-xs-12 col-sm-4">
            <div class="form-group" id="data_5" data-date-format="dd-mm-yyyy">
              <div class="input-daterange input-group ">
                <input type="text" class="input-sm form-control" name="date_of_reg_GE" placeholder="ขึ้นทะเบียนตั้งแต่วันที่" style="height: 34px;" />
                <span class="input-group-addon">ถึง</span>
                <input type="text" class="input-sm form-control" name="date_of_resign_LE" placeholder="ลาออกก่อนวันที่" style="height: 34px;"/>
              </div>
            </div>

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
          <div class="col-xs-12 col-sm-2">
            <h3><label for="col6_filter">หน่วยงาน (ผู้บันทึกข้อมูล):</label></h3>
          </div>
          <div class="col-xs-12 col-sm-6">
            <?php $usrm = $this->common_model->custom_query("SELECT * FROM usrm_org"); ?>
            <select class="form-control" name='insert_org_id'>
              <option value="" disabled selected>ระบุหน่วยงาน</option>
              <?php foreach($usrm as $key=>$value) {?>
              <option value="<?=$value['org_id']?>"><?=$value['org_title']?></option>
              <?php } ?>
            </select>
          </div>
        </div>

        <div class="row">
           <div class="col-xs-12 col-sm-8">&nbsp;</div>
           <div class="col-xs-12 col-sm-4 right" style="padding-right: 3px;">
               <button id='voltFilterSearch' class="btn btn-primary btn-save" type="button" href="" title="ค้นหา" style=" background-color: #2f4050;border: 1px;"><i class="fa fa-search" aria-hidden="true"></i> ค้นหา</button>
               <button id='voltFilterCancel' class="btn btn-primary  btn-cancel" type="button" href="" title="ล้างค่า" style=" background-color: #2f4050;border: 1px;"><i class="fa fa-refresh" aria-hidden="true"></i> ล้างค่า</button>
           </div>
        </div>

     </div><!-- End class="container-fluid"-->
  </div><!-- Endclass="well" -->
</div><!-- End class="collapse"-->
<!-- End search -->

<script>

$(function () {

  var clearCookie = function() {
    $('#voltFilterBox').find('[name], select').each(function() {
      document.cookie = $(this).attr('name') + '=;expires=Thu, 01 Jan 1970 00:00:01 GMT;path=/';
    });
  };
  var setCookie = function(name, value, hr) {
    var expires = "";
    if (hr) {
        var date = new Date();
        date.setTime(date.getTime() + (hr * 60 * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "")  + expires + "; path=/";
  }

  $('#voltFilterCancel').click(function() {
    $('input, select').val('');
    clearCookie();
  });

  var defaultValues = document.cookie.split('; ');
  for (var i = 0, ii = defaultValues.length; i < ii; i++) {
    var value = defaultValues[i].split('=');
    $('#voltFilterBox [name='+value[0]+']').val(value[1]);
  }

  $('#voltFilterBox').on('generate_filterOptions', function() {
    var data = {};
    var cookie = [];
    $(this).find('[name], select').each(function() {
      if ($(this).val()) {
        data[$(this).attr('name')] = $(this).val();
        setCookie($(this).attr('name'), $(this).val(), 2);
      }
    });

    var today = new Date();
    var thisMonth = (+today.getMonth() + 1 < 10 ? '0' : '') + (+today.getMonth() + 1);
    var thisDate = (today.getDate() < 10 ? '0' : '') + today.getDate();
    if (data.date_of_birth_LE)
      data.date_of_birth_LE = today.getFullYear() - data.date_of_birth_LE + '-' + thisMonth + '-' + thisDate;
    if (data.date_of_birth_GE)
      data.date_of_birth_GE = today.getFullYear() - data.date_of_birth_GE - 1 + '-' + thisMonth + '-' + thisDate;

    if (data.date_of_reg_GE) {
      data.date_of_reg_GE = data.date_of_reg_GE.split('/').reverse();
      data.date_of_reg_GE[0] -= 543;
      data.date_of_reg_GE = data.date_of_reg_GE.join('-');
    }
    if (data.date_of_resign_LE) {
      data.date_of_resign_LE = data.date_of_resign_LE.split('/').reverse();
      data.date_of_resign_LE[0] -= 543;
      data.date_of_resign_LE = data.date_of_resign_LE.join('-');
    }

    data.<?=$csrf['name']?> = "<?=$csrf['hash']?>";
    $(this).data('filter_options', data);
  });

  $('#voltFilterSearch').click(function() {
    var data = $('#voltFilterBox').trigger('generate_filterOptions').data('filter_options');
    var form = $('<form method="post" action="<?php echo site_url('volunteer/volunteer_list');?>"></form>');
    for (var key in data)
      form.append($('<input/>').attr({
        type : 'hidden',
        name : key,
        value : data[key]
      }));
    form.appendTo('body').submit();
  });

});

</script>
