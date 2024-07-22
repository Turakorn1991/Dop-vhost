<style>
#portfolio thead tr th,
#portfolio tbody tr.active td {
	background: #2F4050;
	color: white;
	font-weight: 400;
}
#portfolio tbody tr.active td i {
	color: white;
}
</style>

<div class="row">
	<div class="col-lg-12">
		<div class="tabs-container tabs-container-border" id="tab-3">
			<div class="panel-group">
        <div class="panel panel-default" style=" border: none; ">
          <br>
        
          <div class="panel-heading">
            <h4>
              ผลการดำเนินงาน
            </h4>
          </div>
  				<div class="panel-body" style="border:none;">
  					
  						<div class="row text-right">
  			                <div id="newPortfolioEntry" class="btn btn-primary btn-add">
  			                  <i style="font-size:14px;" class="fa fa-plus-circle" aria-hidden="true"></i>
  			                  เพิ่มรายการ
  			                </div>
  			            </div>
  			            <div class="row">
  			            	<table id="portfolio" class="table table-striped table-bordered table-hover dataTables-example" style="margin-top: 0px !important;" >
  			                  	<thead style="font-size: 15px;">
  				                    <tr>
  				                      <th class="text-center">วัน เดือน ปี ที่ให้การดูแลผู้สูงอายุ</th>
  				                      <th class="text-center">ชื่อ – สกุล ผู้สูงอายุ</th>
  				                      <th class="text-center">จำนวนกิจกรรมที่ให้การดูแลและช่วยเหลือ</th>
  				                      <th class="text-center" style="width:120px;">เครื่องมือ</th>
  				                      
  				                    </tr>
  			            		</thead>
  			                  	<tbody></tbody>
  			            	</table>
  			            </div>

  						 <div id="editEntryModal" style="display:none;">
  						 	<div class="content-panel">
  						 		<form>
  						 			<div class="form-group row">
  						 				<div class="col-xs-12 col-sm-3">
  										    <label class="col-form-label">ชื่อ – สกุล ผู้สูงอายุ</label>
  										    <select class="form-control" name="care_prog_pers_id">
  										      <option disabled>เลือกชื่อผู้สูงอายุ</option>
  										      <?php foreach ($volt_info_elderly_care as $elder) {
  										      echo "<option value='".$elder['pers_id']."'>".$elder['pers_firstname_th'].' '.$elder['pers_lastname_th']."</option>";
  										      } ?>
  										    </select>
  										</div>

  										<div class="col-xs-12 col-sm-3">
  											<label class="col-form-label">วันเดือนปี ที่ให้การดูแลผู้สูงอายุ</label>
  											<div id="entry_date_wrapper" class="col-10 input-group date" data-date-format="dd-mm-yyyy">
  					                          <input id="entry_date" title="วันเดือนปี ที่ให้การดูแลผู้สูงอายุ" placeholder="เลือกวันที่" class="form-control" type="text">
  					                          <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
  					                        </div>
                          					<input type="hidden" name="volt_info[entry_date]" value="<?php echo $volt_info["entry_date"]?>" />

  										</div>
  						 			</div>

  						 			 <div class="h3">กิจกรรมการดูแลช่วยเหลือและคุ้มครองพิทักษ์สิทธิผู้สูงอายุ <small>(เลือกได้มากกว่า 1 ข้อ)</small></div>
  						 			 <div class="form-group row">
  						 			 	<?php foreach ($care_activities as $activity) { ?>
  					                      <div class="col-xs-12 col-sm-3">
  					                        <div class="checkbox-inline i-checks">
  					                          <label>
  					                            <!-- <div class="icheckbox_square-green"> -->
  					                              <input type="checkbox" name="care_prog_acti_id_set[]" value="<?php echo $activity['care_acti_id'];?>">
  					                              <!-- <ins class="iCheck-helper"></ins> -->
  					                            <!-- </div> -->
  					                            <?php echo $activity['care_acti_title'];?>
  					                          </label>
  					                        </div>
  					                      </div>
  					                    <?php } ?>
  					                    <div class="col-xs-12 col-sm-3">
  					                        <div class="checkbox-inline i-checks">
  					                          <label>
  					                            <!-- <div class="icheckbox_square-green"> -->
  					                              <input type="checkbox" name="care_prog_acti_id_set[]" value="etc">
  					                              <!-- <ins class="iCheck-helper"></ins> -->
  					                            <!-- </div> -->
  					                            อื่นๆ
  					                          </label>
  					                          &nbsp;
  					                          <input class="form-control" type="text" name="care_prog_specify" value="<?php echo $activity["care_prog_specify"];?>" style="width:auto;display:inline-block;margin-top:-8px;position:relative;top:4px;" placeholder="โปรดระบุ" />
  					                        </div>
  					                    </div>
  						 			 </div>

  						 			 <hr>

  						 			<div class="row">
  										<div class="col-xs-12 col-sm-8"></div>
  										<div class="col-xs-12 col-sm-2">
  											<div id="save_volt_progress" class="btn btn-primary btn-save" style="width:100%!important">
  										  		<i class="fa fa-floppy-o" aria-hidden="true"></i> บันทึก
  											</div>
  										</div>
  										<div class="col-xs-12 col-sm-2">
  											<div class="btn btn-primary btn-cancel" style="width:100%!important">
  										  		<i class="fa fa-caret-left" aria-hidden="true"></i> ย้อนกลับ
  											</div>
  										</div>
  							    </div>
  						 			
  						 		</form>

  						 	</div>
               </div>

              <div class="row section-btn-nav">
                <div class="col-xs-12 col-sm-8"></div>
                <div class="col-xs-12 col-sm-2">
                  <a href="<?php echo site_url('volunteer/volunteer_list');?>" class="btn btn-primary btn-save" style="width:100%!important">
                      <i class="fa fa-floppy-o" aria-hidden="true"></i> บันทึก
                  </a>
                </div>
                <div class="col-xs-12 col-sm-2">
                  <a href="<?php echo site_url('volunteer/elderly_care/edit/'.$volt_info['volt_id']);?>" class="btn btn-primary btn-cancel" style="width:100%!important">
                      <i class="fa fa-caret-left" aria-hidden="true"></i> ย้อนกลับ
                  </a>
                </div>
              </div>

  					</div>
  				</div>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">
  $(function() {
    $("#entry_date_wrapper").datepicker({
      autoclose: true,
      todayHighlight: true,
      format: 'dd/mm/yyyy',
      todayBtn: true,
      language: 'th',
      thaiyear: true
    });

    $('.i-checks').iCheck({
		checkboxClass: 'icheckbox_square-green',
		radioClass: 'iradio_square-green',
		increaseArea: '20%'
	});

	$('#entry_date').change(function() {
	   	var val = $(this).val().split('/');
	    $('[name="volt_info[entry_date]"]').val((val[2] - 543) + '-' + val[1] + '-' + val[0]);
	});

  });

</script>


<script>

$("#guide-book").click(function(){
	window.open('/assets/modules/volunteer/guide/Vol_Manual.pdf', '_blank');
});

var portfolio = <?php echo json_encode($volt_info_care_progress);?>.map(row => {
	var history = eval(row.care_prog_acti_id_set);
	row.care_prog_acti_id_set = Array.isArray(history) ? history : [];
	return row;
});
console.log('care_progresses', portfolio);
var elders = <?php echo json_encode($volt_info_elderly_care);?>;
console.log('elders in charge', elders);
var saveMethod, entryId;
$(function() {
  var tab3 = $('#tab-3');
  $.fn.hilightTab3Tr = function(index) {
    tab3.find('#portfolio tr').removeClass('active');
    if (index)
      tab3.find('#portfolio tr[index='+index+']').addClass('active');
    return this;
  };
  $.fn.showTab3Form = function() {
    tab3.find('#editEntryModal').show();
    return this;
  };
  $.fn.clearTab3Form = function() {
    tab3.find('#editEntryModal [type=checkbox]')
      .prop('checked', false)
      .parent().removeClass('checked');
    tab3.find("#entry_date_wrapper").datepicker('update', 'now');
    tab3.find('#editEntryModal [name=care_prog_specify]').val('');
    return this;
  };
  $.fn.fillTab3Form = function(entry) {
    var tasks = entry.care_prog_acti_id_set;
    for (var i = 0, ii = tasks.length; i < ii; i++)
      tab3.find('#editEntryModal [type=checkbox][value='+tasks[i]+']')
        .prop('checked', true)
        .parent().addClass('checked');
    tab3.find('[name=care_prog_pers_id]').val(entry.care_prog_pers_id);
    tab3.find("#entry_date_wrapper").datepicker('update', entry.care_prog_care_date.split('-').reverse().join('-'));
    tab3.find('#editEntryModal [name=care_prog_specify]').val(entry.care_prog_specify);
    return this;
  };
  var editEntry = function(careProgId, set) {
    if (careProgId) {
      for (var i = 0, ii = portfolio.length; i < ii; i++)
        if (portfolio[i].care_prog_id == careProgId)
          $.extend(portfolio[i], set);
    } else
      portfolio.push(set);
  };
  var renderTab3 = function() {
    var entryBody = tab3.find('#portfolio tbody').html('');
    portfolio.sort(function(a, b) {
      return a.care_prog_care_date < b.care_prog_care_date ? -1 : a.care_prog_care_date > b.care_prog_care_date ? 1 : 0;
    });
    for (var i = 0, ii = portfolio.length; i < ii; i++) {
      if (portfolio[i].care_prog_status == 'Inactive')
        continue;
      var tr = $('<tr>', { index : i });
      var date = portfolio[i].care_prog_care_date.split('-');
      tr.append($('<td>', { class : 'text-center', text : date[2] + '/' + date[1] + '/' + (+date[0] + 543) }));
      var elder = elders.filter(e => e.pers_id==portfolio[i].pers_id)[0];
      tr.append($('<td>', { text : elder.pers_firstname_th + ' ' + elder.pers_lastname_th }));
	  tr.append($('<td>', { class : 'text-center', text : portfolio[i].care_prog_acti_id_set.length }));
      tr.append($('<td>', { class : 'text-center' }).append(
        $('<i>', { class : 'fa fa-pencil btn editEntry', "entry-index" : i, "entry-id" : portfolio[i].care_prog_id }),
        $('<i>', { class : 'fa fa-trash btn deleteEntry', "entry-index" : i, "entry-id" : portfolio[i].care_prog_id })
      ));
      entryBody.append(tr);
    }
    tab3.find('#editEntryModal').hide();
  };
  renderTab3();

  tab3.find('#newPortfolioEntry').click(function() {
    $('.section-btn-nav').addClass('hide');

    tab3.find('#portfolio tr').removeClass('active');
    tab3
      .hilightTab3Tr()
      .showTab3Form()
      .clearTab3Form();
    saveMethod = 'ajax_insert';
    entryId = null;
  });
  tab3.find('#portfolio').on('click', '.editEntry', function() {
    $('.section-btn-nav').addClass('hide');

    var index = $(this).attr('entry-index');
    tab3
      .hilightTab3Tr(index)
      .showTab3Form()
      .clearTab3Form()
      .fillTab3Form(portfolio[index]);
    saveMethod = 'ajax_update';
    entryId = $(this).attr('entry-id');
  });
  tab3.find('#portfolio').on('click', '.deleteEntry', function() {
    entryId = $(this).attr('entry-id');
    if (confirm('sure?')) {
      $.ajax({
        url: base_url + 'volunteer/care_progress/ajax_delete',
        type: 'POST',
        dataType: 'json',
        data: {
          care_prog_id : entryId,
          care_prog_status : 'Inactive'
          <?php echo ','.$csrf['name'].':"'.$csrf['hash'].'"';?>}
      }).done(function(ret) {
        editEntry(entryId, { care_prog_status : 'Inactive' });
        renderTab3();
      }).fail(function(e) { console.log("error", e); });
    }
  });

  tab3.find('#save_volt_progress').click(function() {
    var data = {};
    data.care_prog_volt_id = <?php echo $volt_info['volt_id'];?>;
    data.care_prog_pers_id = tab3.find('[name="care_prog_pers_id"]').val();
    var d = tab3.find("#entry_date_wrapper").datepicker('getDate');
    data.care_prog_care_date =
      d.getFullYear() + "-" +
      ("0" + (d.getMonth() + 1)).slice(-2) + "-" +
      ("0" + d.getDate()).slice(-2);
    data.care_prog_specify = tab3.find('[name="care_prog_specify"]').val();
    data.care_prog_acti_id_set = [];
    tab3.find('[name="care_prog_acti_id_set[]"]:checked').each(function() {
      data.care_prog_acti_id_set.push($(this).val());
    });
    data.care_prog_status = 'Active';
    if (entryId)
      data.care_prog_id = entryId;
    data['<?php echo $csrf['name'];?>'] = '<?php echo $csrf['hash'];?>';

    $.ajax({
      url: base_url + 'volunteer/care_progress/'+saveMethod,
      type: 'POST',
      dataType: 'json',
      data: data
    }).done(function(ret) {
      if (saveMethod == 'ajax_insert')
        editEntry(null, $.extend(data, { pers_id : data.care_prog_pers_id, care_prog_id : ret.care_prog_id }));
      if (saveMethod == 'ajax_update')
        editEntry(entryId, $.extend(data, { pers_id : data.care_prog_pers_id }));
      renderTab3();
      
      $('.section-btn-nav').removeClass('hide');

    }).fail(function(e) { console.log("error", e); });
  });
});
</script>


