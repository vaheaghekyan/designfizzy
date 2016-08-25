// JavaScript Document

//--------------------------------------------------//
//Menu Dwopdown Script for Open
//--------------------------------------------------//
(function($){
	"use strict";
	$(document).ready(function(){
		$('ul.dropdown-menu [data-toggle=dropdown]').on('click', function(event) {
			event.preventDefault(); 
			event.stopPropagation(); 
			$(this).parent().siblings().removeClass('open');
			$(this).parent().toggleClass('open');
		});
	});
})(jQuery);

jQuery(document).ready(function($){

	//--------------------------------------------------//
	// Back To Top Scritp
	//--------------------------------------------------//	
	// browser window scroll (in pixels) after which the "back to top" link is shown
	"use strict";
	var offset = 300,
		//browser window scroll (in pixels) after which the "back to top" link opacity is reduced
		offset_opacity = 1200,
		//duration of the top scrolling animation (in ms)
		scroll_top_duration = 700,
		//grab the "back to top" link
		$back_to_top = $('.cd-top');

	//hide or show the "back to top" link
	$(window).scroll(function(){
		( $(this).scrollTop() > offset ) ? $back_to_top.addClass('cd-is-visible') : $back_to_top.removeClass('cd-is-visible cd-fade-out');
		if( $(this).scrollTop() > offset_opacity ) { 
			$back_to_top.addClass('cd-fade-out');
		}
	});

	//smooth scroll to top
	$back_to_top.on('click', function(event){
		event.preventDefault();
		$('body,html').animate({
			scrollTop: 0 ,
		 	}, scroll_top_duration
		);
	});
	
	//--------------------------------------------------//
	// Sticky Header Script
	//--------------------------------------------------//	
	var doc_width=$( document ).width();
	if(doc_width>767) /* Above this width the menu will display in dropdown on mouse over - default display for big screen*/
	{	
		$('#nav').affix({
			offset: {
			top: $('header').height()
			}
		});
		$('#nav').on('affix-top.bs.affix', function () {
		  $('#nav + .container').css('margin-top', 0);
		});
	}
	//--------------------------------------------------//
	// Back to TOP Script
	//--------------------------------------------------//	

	// browser window scroll (in pixels) after which the "back to top" link is shown
	var offset = 300,
		//browser window scroll (in pixels) after which the "back to top" link opacity is reduced
		offset_opacity = 1200,
		//duration of the top scrolling animation (in ms)
		scroll_top_duration = 700,
		//grab the "back to top" link
		$back_to_top = $('.cd-top');

	//hide or show the "back to top" link
	$(window).scroll(function(){
		( $(this).scrollTop() > offset ) ? $back_to_top.addClass('cd-is-visible') : $back_to_top.removeClass('cd-is-visible cd-fade-out');
		if( $(this).scrollTop() > offset_opacity ) { 
			$back_to_top.addClass('cd-fade-out');
		}
	});

	//smooth scroll to top
	$back_to_top.on('click', function(event){
		event.preventDefault();
		$('body,html').animate({
			scrollTop: 0 ,
		 	}, scroll_top_duration
		);
	});
	
	if($( ".tp-accordion" ).hasClass( "check-accordion" ))
	{
		var $active = $('.tp-accordion .panel-collapse.in').prev().addClass('active');
		$active.find('a').prepend('<i class="glyphicon glyphicon-minus sign"></i>');
		$('.tp-accordion .panel-heading').not($active).find('a').prepend('<i class="glyphicon glyphicon-plus sign"></i>');
		$('.tp-accordion').on('show.bs.collapse', function (e) {
			$('.tp-accordion .panel-heading.active').removeClass('active').find('.glyphicon').toggleClass('glyphicon-plus glyphicon-minus');
			$(e.target).prev().addClass('active').find('.glyphicon').toggleClass('glyphicon-plus glyphicon-minus');
		})
	}

	if($( ".post" ).hasClass( "format-gallery" ))
	{
		jQuery("#owl-gallery").owlCarousel({
		  rtl : true,
		  autoplay:true,
		  autoPlay: 3000, //Set AutoPlay to 3 seconds
		  items : 1,
		  loop:true,
		  responsive:{
				0:{
					items:1
				},
				600:{
					items:1
				},
				1000:{
					items:1
				}
			},
		});		
	}	

	if($('.owl-controls').hasClass('tp-gallery-box'))
	{
		jQuery(".tp-gallery-box").owlCarousel({
			rtl:true,	
			nav : true, // Show next and prev buttons
			slideSpeed : 300,
			paginationSpeed : 400,
			autoHeight : true,
			navText : ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
			items : 1,
			dots:false,
			loop:true, 
			autoplay:true,
		});		
	}
	

	if($('.owl-carousel').hasClass('tp-testimonial-box'))
	{	
		"use strict";	
		jQuery(".tp-testimonial-box").owlCarousel({
			rtl : true,
			nav : false, // Show next and prev buttons
			slideSpeed : 900,
			paginationSpeed : 400,
			items:1,
			autoHeight : true,
			navText : ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
			autoPlay:4000,
			autoplay:true,
			loop:true,
			responsive:{
				0:{
					items:1
				},
				600:{
					items:1
				},
				1000:{
					items:1
				}
			},
		});
	}

	if(jQuery('.owl-carousel').hasClass('tab-treatment'))
	{	
		"use strict"
		jQuery(".tab-treatment").owlCarousel({
		  rtl:true,	
		  nav : false, // Show next and prev buttons
		  slideSpeed : 300,
		  items:1,
		  autoplay:true,
		}); 	

	}

	
	
	//Call Full width for patten bg
	call_fullwidth();

	jQuery( ".tabs-left li a" ).on( "click", function() {
	  
		var target = $( this ).attr("href");
		
		jQuery(".tab-pane").hide();
		jQuery(target).show();
	
		var carousel = $(target+ ' .tab-treatment').data('owlCarousel');
		carousel._width = $(target+ ' .tab-treatment').width();
		carousel.invalidate('width');
		carousel.refresh();		
	
	});	
	
});
///////// set full width of screen
function call_fullwidth()
{
	if($("div").hasClass('pattern1'))
	{
		var side_padding=(($(document).width()-$(".pattern1").width())/2);
		
		$(".pattern1").css( { paddingLeft : side_padding+"px", paddingRight : side_padding+"px" } );
		$(".pattern1").css( { marginLeft : "-"+side_padding+"px", marginRight : "-"+side_padding+"px" } );		
	}
}

jQuery( window ).resize(function() {
  call_fullwidth();
});