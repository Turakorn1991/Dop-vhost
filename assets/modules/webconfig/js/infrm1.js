$(document).ready(function(){	
	$(document).on("click", ".show-image", function(event){
		var src = $(this).attr("src");
		var id = $(this).attr("id");
		var href = $(this).attr("data-href");
		$("#image-preview").attr("src", src);
		$("#deleteImage").attr('href',href);
		$('#myModal').modal('show');
	});

    $('#gallery-photo-add').on('change', function() {
		$("div.gallery img.preview").remove();
        imagesPreview(this, 'div.gallery');
    });
	
	$("button[type=reset]").on("click", function(){
		$("div.gallery img.preview").remove();
	});
	
	$("#menu_topright").html(
	'<a class="navbar-minimalize minimalize-styl-2 btn btn-primary" style="margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 20px 2px 20px;" href="'+base_url+'webconfig/webconfig_news"><i class="fa fa-caret-left" aria-hidden="true"></i> </a>'
	);
	
	$(".datepicker").datepicker({
		dateFormat: "dd/mm/yy"
	});
});

