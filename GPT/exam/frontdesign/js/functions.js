// SCROLL TO TOP ===============================================================================
$(function() {
	$(window).scroll(function() {
		if($(this).scrollTop() != 0) {
			$('#toTop').fadeIn();	
		} else {
			$('#toTop').fadeOut();
		}
	});
 
	$('#toTop').click(function() {
		$('body,html').animate({scrollTop:0},500);
	});	
	
});
<!-- Megamenu -->
$(document).ready(function($){
	$('.megamenu').megaMenuReloaded({
		menu_speed_show : 300, // Time (in milliseconds) to show a drop down
		menu_speed_hide : 200, // Time (in milliseconds) to hide a drop down
		menu_speed_delay : 200, // Time (in milliseconds) before showing a drop down
		menu_effect : 'open_close_slide', // Drop down effect, choose between 'hover_fade', 'hover_slide', 'click_fade', 'click_slide', 'open_close_fade', 'open_close_slide'
		menu_easing : 'easeInElastic', // Easing Effect : 'easeInQuad', 'easeInElastic', etc.
		menu_click_outside : 0, // Clicks outside the drop down close it (1 = true, 0 = false)
		menu_show_onload : 0, // Drop down to show on page load (type the number of the drop down, 0 for none)
		menubar_trigger : 1, // Show the menu trigger (button to show / hide the menu bar), only for the fixed version of the menu (1 = show, 0 = hide)
        menubar_hide : 0, // Hides the menu bar on load (1 = hide, 0 = show)
        menu_responsive : 1, // Enables mobile-specific script
        menu_carousel : 0, // Enable / disable carousel
        menu_carousel_groups : 0 // Number of groups of elements in the carousel
	});
});


<!-- Toggle -->			
	$('.togglehandle').click(function()
	{
		$(this).toggleClass('active')
		$(this).next('.toggledata').slideToggle()
	});

// alert close 
	$('.clostalert').click(function()
	{
	$(this).parent('.alert').fadeOut ()
	});	
	
// Dropdowns
	$('.dropdown').hover(
		function(){$(this).addClass('open')			
		},
		function(){			
			$(this).removeClass('open')
		}
		);
<!-- Tooltip -->	
$('.tooltip-test').tooltip();


<!-- Accrodian -->	
	var $acdata = $('.accrodian-data'),
		$acclick = $('.accrodian-trigger');

	$acdata.hide();
	$acclick.first().addClass('active').next().show();	
	
	$acclick.on('click', function(e) {
		if( $(this).next().is(':hidden') ) {
			$acclick.removeClass('active').next().slideUp(300);
			$(this).toggleClass('active').next().slideDown(300);
		}
		e.preventDefault();
	});
				

<!-- News stip clickable-->				   
$(".news-strip ul li").click(function(){
    window.location=$(this).find("a").attr("href");return false;
});
 

	
	
