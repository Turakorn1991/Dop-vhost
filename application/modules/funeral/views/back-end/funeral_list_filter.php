<!-- search-->
<div class="collapse" id="collapseExample">
  <div class="well" style="background-color: rgb(255, 255, 255);">
    <div class="container-fluid">

      <div class="form-group row">
        <div class="col-xs-12 col-sm-12">
          <h3><label>ค้นหา</label></h3>
        </div>
      </div>

      <div class="form-group row ">
        <div class="col-xs-12 col-sm-3">
          <h3><label for="col1_filter">เลขประจำตัวประชาชน (ผู้สูงอายุ):</label></h3>
        </div>
        <div class="col-xs-12 col-sm-3">
          <input data-column="1" type="text" class="form-control numberonly column_filter filter-pid" id="col1_filter" placeholder="เลขประจำตัวประชาชน (13 หลัก)" maxlength="13">
        </div>
        <div class="col-xs-12 col-sm-6">
          <div class="form-check">
            <h3>
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input filter-disablepid" id="disablepid">
                ไม่ระบุเลขบัตรประจำตัวประชาชน
              </label>
            </h3>
          </div>

        </div>
      </div>

      <div class="form-group row">
        <div class="col-xs-12 col-sm-3">
          <h3><label for="col2_filter">ชื่อตัว-ชื่อสกุล:</label></h3>
        </div>
        <div class="col-xs-12 col-sm-6">
          <input data-column="2" type="text" class="form-control column_filter filter-fullname" id="col2_filter" placeholder="ชื่อตัว-ชื่อสกุล">
        </div>
      </div>

      <div class="form-group row">
        <div class="col-xs-12 col-sm-3" style="padding-top: 12px;">
          <h3><label for="col3_filter">เพศ:</label></h3>
        </div>
        <div class="col-xs-12 col-sm-4" style="padding-top: 12px;">
          <select class="form-control filter-gender" id="gender">
            <option value="">ทั้งหมด</option>
            <option value="1">ชาย (Male)</option>
            <option value="2">หญิง (Female)</option>
            <option value="0">ไม่ทราบ</option>
            <option value="ไม่ระบุ">ไม่ระบุ</option>
          </select>
        </div>
      </div>

      <div class="form-group row">
        <div class="col-xs-12 col-sm-3" style="padding-top: 12px;">
          <h3><label for="col3_filter">สถานะดำเนินการ:</label></h3>
        </div>
        <div class="col-xs-12 col-sm-4" style="padding-top: 12px;">
          <select class="form-control filter-status">
            <option value="">ทั้งหมด</option>
            <option value="1">รอการช่วยเหลือ</option>
            <option value="2">ได้รับการสงเคราะห์แล้ว</option>
            <option value="3" selected>รอการช่วยเหลือและได้รับการสงเคราะห์แล้ว</option>
            <option value="4">ปฎิเสธ</option>
          </select>
        </div>
      </div>


      <div class="form-group row">
        <div class="col-xs-12 col-sm-3">
          <h3><label for="col5_filter">วันที่ยื่นคำขอ:</label></h3>
        </div>
        <div class="col-xs-12 col-sm-4">

          <div class="form-group" id="data_5" data-date-format="dd-mm-yyyy">
            <div class="input-daterange input-group" id="datepicker">
              <input type="text" class="input-sm form-control  filter-req-start" name="start" value="" placeholder="เลือกตั้งแต่วันที่" style="height: 34px;" />
              <span class="input-group-addon">ถึง</span>
              <input type="text" class="input-sm form-control filter-req-end" name="end" value="" placeholder="เลือกถึงวันที่" style="height: 34px;" />
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

      <div class="form-group row">
        <div class="col-xs-12 col-sm-3">
          <h3><label>วันที่ได้รับการสงเคราะห์<span class="span-required-filter-pay" style="font-weight: bold; color: red;"><span>:</label></h3>
        </div>
        <div class="col-xs-12 col-sm-4">
          <?php
            $currentDate = date('Y-m-d');
            $date = new DateTime($currentDate);
            $currentMonth = (int) $date->format('m');
            $currentYear = (int) $date->format('Y');
            if ($currentMonth >= 10) {
                $startYear = $currentYear;
                $endYear = $currentYear + 1;
            } else {
                $startYear = $currentYear - 1;
                $endYear = $currentYear;
            }
            $startDateStr = "01/10/".($startYear+543);
            $endDateStr = "30/09/".($endYear+543);
          ?>
          <div class="form-group" id="data_6" data-date-format="dd-mm-yyyy">
            <div class="input-daterange input-group " id="datepicker2">
              <input type="text" class="input-sm form-control filter-pay-start" name="start2" value="<?php echo $startDateStr;?>" placeholder="เลือกตั้งแต่วันที่" style="height: 34px;" />
              <span class="input-group-addon">ถึง</span>
              <input type="text" class="input-sm form-control filter-pay-end" name="end2" value="<?php echo $endDateStr;?>" placeholder="เลือกถึงวันที่" style="height: 34px;" />
            </div>
          </div>
          <script type="text/javascript">
            $('#data_6 .input-daterange').datepicker({
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
          <h3><label for="col10_filter">หน่วยงาน (ผู้บันทึกข้อมูล):</label></h3>
        </div>
        <div class="col-xs-12 col-sm-6">
          <?php
          $user_id = get_session('user_id');
          $app_id = 2;
          $session_org_id = get_session('org_id');
          $usrpm = $this->admin_model->chkOnce_usrmPermiss($app_id, $user_id);
          ?>
          <?php $usrm = $this->common_model->custom_query("SELECT * FROM usrm_org"); ?>
          <select class="form-control filter-usrm-org" id="usrm_org">
            <?php
              if($usrpm['perm_view'] == 'All'){ ?>
                  <option value="" selected>ทั้งหมด</option>
                  <?php foreach ($usrm as $key => $value) { ?>
                    <option value="<?php echo $value['org_id']; ?>"><?php echo $value['org_title']; ?></option>
                  <?php }?>      
            <?php }else{ ?>
                  <?php foreach ($usrm as $key => $value) { ?>
                    <option value="<?php echo $value['org_id']; ?>" <?php if($session_org_id != $value['org_id']){echo "disabled"; }else{echo "selected";} ?> ><?php echo $value['org_title']; ?></option>
                  <?php }?> 
            <?php } ?>
          </select>
        </div>
      </div>

      <div class="row">
        <div class="col-xs-12 col-sm-8">&nbsp;</div>
        <div class="col-xs-12 col-sm-4 right" style="padding-right: 3px;">
          <button id="filtersearch" class="btn btn-primary btn-save" type="button" title="ค้นหา" style=" background-color: #2f4050;border: 1px;"><i class="fa fa-search" aria-hidden="true"></i> ค้นหา</button>
          <a href="<?php echo base_url('' . uri_seg(1) . '/' . uri_seg(2)); ?>" class="btn btn-primary  btn-cancel" type="button" title="ค้นหา" style=" background-color: #2f4050;border: 1px;"><i class="fa fa-refresh" aria-hidden="true"></i> ล้างค่า</a>
        </div>
      </div>

    </div><!-- End class="container-fluid"-->
  </div><!-- Endclass="well" -->
</div><!-- End class="collapse"-->
<!-- End search -->

<script>
  $(function() {

    //เช็คกรณีไม่ระบุเลขบัตรประจำตัวประชาชน
    $('.filter-disablepid').on('change', function() {
      if ($(this).prop('checked')) {
        $('#col1_filter').prop('disabled', 'disabled');
      } else {
        $('.filter-pid').prop('disabled', '');
      }
    });

    $('.filter-status').on('change', function() {
      if(initRequiredFilterPay()){
        $(".span-required-filter-pay").text("*");
      }else{
        $(".span-required-filter-pay").text("");
      }
    });
    $('.filter-status').change();
  });

  function initRequiredFilterPay(){
    let valRequiredFilterPay = $('.filter-status').val();
    if(valRequiredFilterPay == "2" || valRequiredFilterPay == "3")
      return true;
    else
      return false;
  }
</script>