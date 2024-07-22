<!-- search-->
<div class="collapse" id="collapseExample">
    <div class="well" style="background-color: rgb(255, 255, 255);">
        <div class="container-fluid">
            <form action="<?php echo site_url('/jobs/registered_list') ?>" method="post">
                <input type='hidden' name='<?=$csrf['name']?>' value='<?=$csrf['hash']?>' />

                <div class="form-group row">
                    <div class="col-xs-12 col-sm-12">
                        <h3><label>ค้นหา</label></h3>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-xs-12 col-sm-2">
                        <h3><label>เลขประจำตัวประชาชน (ผู้สูงอายุ):</label></h3>
                    </div>
                    <div class="col-xs-12 col-sm-3">
                        <input type="number" maxlength="13" class="input-sm form-control" name="pid" placeholder="เลขประจำตัวประชาชน (13หลัก)" />
                    </div>
                    <div class="col-xs-12 col-sm-3">
                        <input type="checkbox" class="disable_citizen_id" />
                        <label>ไม่ระบุเลขบัตรประจำตัวประชาชน</label>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-xs-12 col-sm-2">
                        <h3><label>ชื่อตัว-ชื่อสกุล:</label></h3>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <input type="text" class="input-sm form-control" name="name" placeholder="ชื่อตัว-ชื่อสกุล" />
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-xs-12 col-sm-2">
                        <h3><label>เพศ:</label></h3>
                    </div>
                    <div class="col-xs-12 col-sm-3">
                        <select class="form-control" name='gender_code'>
                            <option value="">ทั้งหมด</option>
                            <?php foreach($std_gender as $row): ?>
                            <option value="<?=$row['gender_code']?>"><?=$row['gender_name']?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-xs-12 col-sm-1">
                        <h3><label>อายุ:</label></h3>
                    </div>
                    <div class="col-xs-12 col-sm-3">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="number" min="0" max="140" class="input-sm form-control" name="age_GE" placeholder="ไม่ระบุ" />
                                <span class="input-group-addon">ถึง</span>
                                <input type="number" min="0" max="140" class="input-sm form-control" name="age_LE" placeholder="ไม่ระบุ" />
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-1">
                        <h3><label>ปี</label></h3>
                    </div>
                </div>

               <div class="form-group row">
                   <div class="col-xs-12 col-sm-2">
                       <h3><label>วันที่ขึ้นทะเบียน:</label></h3>
                   </div>
                   <div class="col-xs-12 col-sm-3">
                       <div class="form-group">
                           <div class="input-daterange input-group ">
                               <input type="text" class="input-sm form-control" placeholder="ขึ้นทะเบียนตั้งแต่วันที่" style="height: 34px;" />
                               <input type='hidden' name='date_of_register_GE' />
                               <span class="input-group-addon">ถึง</span>
                               <input type="text" class="input-sm form-control" placeholder="ลาออกก่อนวันที่" style="height: 34px;"/>
                               <input type='hidden' name='date_of_resign_LE' />
                           </div>
                       </div>
                   </div>
               </div>

               <div class="row">
                   <div class="col-xs-12 col-sm-8">&nbsp;</div>
                   <div class="col-xs-12 col-sm-4 right" style="padding-right: 3px;">
                       <button class="btn btn-primary btn-save" type="submit" title="ค้นหา" style=" background-color: #2f4050;border: 1px;">
                           <i class="fa fa-search" aria-hidden="true"></i>
                           ค้นหา
                       </button>
                       <button id="btnclear" class="btn btn-primary btn-cancel" type="button" title="ค้นหา" style=" background-color: #2f4050;border: 1px;">
                           <i class="fa fa-refresh" aria-hidden="true"></i>
                           ล้างค่า
                       </button>
                   </div>
               </div>

           </form>
       </div><!-- End class="container-fluid"-->
   </div><!-- Endclass="well" -->
</div><!-- End class="collapse"-->

<script>
    var formatDate = date => {
        var d = new Date(date),
            month = '' + (d.getMonth() + 1),
            day = '' + d.getDate(),
            year = d.getFullYear();
        if (month.length < 2) month = '0' + month;
        if (day.length < 2) day = '0' + day;
        return [year, month, day].join('-');
    };

    $(function () {

        $('.input-daterange').datepicker({
            keyboardNavigation: false,
            forceParse: false,
            autoclose: true,
            language: 'th',
            thaiyear: true,
            format: 'dd/mm/yyyy',
            todayBtn: true
        });

        $('.input-daterange input:first').change(function() {
            $("[name=date_of_register_GE]").val(formatDate($(this).datepicker('getDate')));
        });

        $('.disable_citizen_id').change(function() {
            $('[name=cid]')
                .val('')
                .attr('disabled', $(this).prop('checked'));
        });

        $('#btnclear').click(() => {
            $('select, input').val('');
            $('[type=checkbox]')
                .prop("checked", false)
                .change();
        });

    });
</script>
