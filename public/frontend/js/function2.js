$(document).ready(function() {
	var wd_width = $(window).width(),
		wd_height = $(window).height();

	//Hiển thị form đăng ký tư vấn
	// if(wd_width > 1220) {
		// var timeout = setTimeout(function(){
        	// $(".fixed-form").addClass("active");        
    	// },5000);		
	// }

	$('.fixed-form .close-form').click(function(e) {
		$(".fixed-form").removeClass("active"); 
		$(".open-fixedform").addClass("active"); 
		e.preventDefault();
	});

	$('.open-fixedform').click(function(e) {
		$(this).removeClass('active');
		$(".fixed-form").addClass("active"); 
		e.preventDefault();
	});

	//Hiển thị/ẩn box dự án nổi bật
	$('#open-featured').click(function(e) {
    	$('html').addClass('state-featured');
    	e.preventDefault();
	});
	$('#close-fetured').click(function(e) {
    	$('html').removeClass('state-featured');
    	e.preventDefault();
  	});
  	$('.page-overlay').click(function() {
    	$('html').removeClass();
  	})

  	$('.prd-detail .navtab > li > a').click(function(event) {
		var section = $(this).attr('href');
		$('html, body').animate({scrollTop: $(section).offset().top - 50},500);
		event.preventDefault();
	});

  	if(wd_width < 960) {
  		$('.mobile-featured-project .panel-body').height(wd_height);
  	}
});