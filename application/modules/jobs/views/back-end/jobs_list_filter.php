<!-- search-->
<div class="collapse" id="collapseExample">
    <div class="well" style="background-color: rgb(255, 255, 255);">
        <div class="container-fluid">
            <form action="<?php echo site_url('/jobs/jobs_list') ?>" method="post">
                <input type='hidden' name='<?=$csrf['name']?>' value='<?=$csrf['hash']?>' />

                <div class="form-group row">
                    <div class="col-xs-12 col-sm-12">
                        <h3><label>ค้นหา</label></h3>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-xs-12 col-sm-2">
                        <h3><label>ประเภทงาน:</label></h3>
                    </div>
                    <div class="col-xs-12 col-sm-3">
                        <select class="form-control" name='posi_type_code'>
                            <option value="">ทั้งหมด</option>
                            <?php foreach($std_position_type as $row): ?>
                            <option value="<?=$row['posi_type_code']?>"><?=$row['posi_type_title']?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-xs-12 col-sm-2">
                        <h3><label>สาขาความเชี่ยวชาญ:</label></h3>
                    </div>
                    <div class="col-xs-12 col-sm-3">
                        <select class="form-control" name="exp_code">
                            <option value="">ทั้งหมด</option>
                            <?php foreach($std_expert as $row): ?>
                            <option value="<?=$row['exp_code']?>"><?=$row['exp_name']?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

               <div class="form-group row">
                   <div class="col-xs-12 col-sm-2">
                       <h3><label>ประสบการณ์ :</label></h3>
                   </div>
                   <div class="col-xs-12 col-sm-3">
                       <div class="form-group">
                           <div class="input-daterange input-group">
                               <input type="number" min="0" max="10" class="input-sm form-control" name="posi_experience_GE" placeholder="0" />
                               <span class="input-group-addon">ถึง</span>
                               <input type="number" min="0" max="10" class="input-sm form-control" name="posi_experience_LE" placeholder="10" />
                           </div>
                       </div>
                   </div>
                   <div class="col-xs-12 col-sm-1">
                       <h3><label>ปี</label></h3>
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
    $(function () {
        $('#btnclear').click(() => $('select, input').val(''));
    });
</script>
