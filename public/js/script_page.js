$(document).ready(function(){
	$('#user-sp_company_id').change(function() {
	  	var company_id = $(this).val();
	  	var access_token= $("meta[name='csrf-token']").attr("content");
		var request = $.ajax({
		  url: "/backend/user/get-company-permision",
		  method: "POST",
		  data: { 
		  	"company_id" : company_id,
		  	"access-token" : access_token
		  },
		  dataType: "json"
		});
		 
		request.done(function( msg ) {
			$html = '';
		  if(msg.success){
		  	if(msg.permision == 1){
			  	$html = '<select id="user-downloadcsv" class="form-control" name="User[companydownloadcsv]"><option value="1" selected="">Yes</option><option value="0">No</option></select>';
			  }else{
			  	$html = '<select id="user-downloadcsv" class="form-control" name="User[companydownloadcsv]"><option value="1">Yes</option><option value="0" selected="">No</option></select>';
		  	}
		  	$("#user-downloadcsv").html($html);
		  }
		});
		 
		request.fail(function( jqXHR, textStatus ) {
		  alert( "Request failed: " + textStatus );
		});
	});

});