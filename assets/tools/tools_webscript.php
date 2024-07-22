<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<?php if ($this->uri->segment(1) == '' OR $this->uri->segment(1) == 'main' AND $this->uri->segment(2) == '') { ?>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<?php } ?>
<script src="<?php echo site_url('assets/js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo site_url('assets/plugins/owlcarousel/owl.carousel.min.js'); ?>"></script>

<?php if ($this->uri->segment(1) == 'main' AND $this->uri->segment(2) == 'school') { ?>
<script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js">
</script>
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD24kGM987Vne24q-T779KnseNXjpBysYw&callback=initMap">
</script>
<script>

      function initMap() {

        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 6,
          center: {lat: 13.7245601, lng: 100.4930264}
        });

        // Create an array of alphabetical characters used to label the markers.
        var labels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		var nameMaker = <?=$name?>;
        // Add some markers to the map.
        // Note: The code uses the JavaScript Array.prototype.map() method to
        // create an array of markers based on a given "locations" array.
        // The map() method here has nothing to do with the Google Maps API.
        var markers = locations.map(function(location, i) {
          return new google.maps.Marker({
            position: location,
            label: labels[i % labels.length],
            title: nameMaker[i]
          });
        });

        // Add a marker clusterer to manage the markers.
        var markerCluster = new MarkerClusterer(map, markers,
            {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
      }
      var locations = <?=$gps?>
	  
    </script>


<?php } ?>


<script>
	$(document).ready(function(){
		$( "#datepicker" ).datepicker({
			autoSize: true,
			dateFormat: "yy-mm-dd",
			onSelect: function (date) {
				list_event(date);
			}
		});
		
		var owl = $('#slider2');
		owl.owlCarousel({
			autoplay:true,
			autoplayTimeout:5000,
			margin:50,
			autoplayHoverPause:true,
			margin: 3,
			nav:true,
			loop: true,
			smartSpeed: 2000,
			responsive: {
			  0: {
				items: 1
			  },
			  600: {
				items: 3
			  },
			  1000: {
				items: 3
			  }
			}
		});
		
		$('#viewImage').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) // Button that triggered the modal
		  var image = button.data('image') // Extract info from data-* attributes
		  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
		  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
		  //alert(image);
		  var modal = $(this);
		  modal.find('.modal-body img').attr('src',image);
		});
		
		$('#article').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget);
		  var id = button.data('id');
		  var modal = $(this);
		  $.ajax({
			  url		: base_url+'main/get_article',
			  type		: "GET",
			  data		: { id : id },
			  dataType  : "JSON",
			  success   : function(response){
				  modal.find('.modal-title').text(response.data.dkm_title);
				  modal.find('.modal-body').html(response.data.dkm_describe);
			  }
		  });
		});
		
		$('#school').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget);
		  var id = button.data('id');
		  var modal = $(this);
		  $.ajax({
			  url		: base_url+'main/get_school',
			  type		: "GET",
			  data		: { id : id },
			  dataType  : "JSON",
			  success   : function(response){
				  modal.find('.modal-title').text(response.data.schl_name);
				  modal.find('.modal-body').html(response.data.addr_home_no);
			  }
		  });
		});
		
		$(".page").on('change', function(){
			var page = $(this).val();
			
			window.location.assign(base_url+"main/school/"+(page*15));
		});
		
		<?php if ($this->uri->segment(1) == '' OR $this->uri->segment(1) == 'main' AND $this->uri->segment(2) == '') { ?>
		// Build the chart
		Highcharts.chart('container', {
			chart: {
				plotBackgroundColor: null,
				plotBorderWidth: null,
				plotShadow: false,
				type: 'pie'
			},
			title: {
				text: 'จำนวนปริมาณผู้สูงอายุ'
			},
			tooltip: {
				pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
			},
			plotOptions: {
				pie: {
					allowPointSelect: true,
					cursor: 'pointer',
					dataLabels: {
						enabled: false
					},
					showInLegend: true
				}
			},
			series: [{
				name: 'ปริมาณ',
				colorByPoint: true,
				data: <?php echo $pers; ?>
			}]
		});
		
		Highcharts.chart('container2', {
			chart: {
				type: 'column'
			},
			title: {
				text: 'ปริมาณผู้สูงอายุที่ได้รับสวัสดิการฯ'
			},
			subtitle: {
				text: 'ประจำปีงบประมาณ 2560'
			},
			xAxis: {
				categories: [
					'การจัดการสวัสดิการ',
					'ผู้สูงอายุในภาวะยากลำบาก',
					'การจัดการศพผู้สูงอายุ',
					'ข้อมูลกลางทะเบียนประวัติ',
					'โรงเรียนผู้สูงอายุ',
					'อาสาสมัครดูแลผู้สูงอายุ',
					'คลังปัญญาผู้สูงอายุ',
					'ข้อมูลปฐมภูมิ',
					'ข้อมูลปฐมภูมิ',
				],
				crosshair: true
			},
			yAxis: {
				min: 0,
				title: {
					text: 'จำนวนผู้สูงอายุ (ราย)'
				}
			},
			tooltip: {
				headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
				pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
					'<td style="padding:0"><b>{point.y:.f} ราย</b></td></tr>',
				footerFormat: '</table>',
				shared: true,
				useHTML: true
			},
			plotOptions: {
				column: {
					pointPadding: 0.2,
					borderWidth: 0
				}
			},
			series: [{
				name: 'ประเภทสวัสดิการ',
				data: [<?=$adm_info?>,<?=$diff_info?>,<?=$fnrl_info?>,<?=$pers_info?>,<?=$schl_info?>,<?=$volt_info?>,<?=$wisd_info?>,<?=$tmp_pers_info?>,<?=$tmp_wisd_info?>]

			}]
		});
		<?php } ?>
		
		
		function list_event(date){
			$.ajax({
				url 	: base_url+'main/get_event',
				type	: "GET",
				data	: { date : date },
				dataType: "JSON",
				success : function(response){
					$("#list_event").html("");
					$.each(response.data, function(index, item){
						$("#list_event").append(
							'<div class="title-event '+item.class+'">'+
								'<ul class="title-event">'+
									'<li class="font20 fontbold" style="color:#000;">'+item.name+'</li>'+
									'<li class="font18" style="color:#909090;">'+
										'<i class="fa fa-clock-o" aria-hidden="true"></i> '+
										item.day+
									'</li>'+
									'<li class="font20 fontbold" style="color:#000;">'+item.place+'</li>'+
								'</ul>'+
							'</div>'
						);
					});
				}
			});
		}
	});
	
</script>