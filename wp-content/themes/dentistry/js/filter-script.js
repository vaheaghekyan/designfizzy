// JavaScript Document
  var $ = jQuery.noConflict();
  $(document).ready(function(){
	"use strict";						 
    var $container = $('.portfolioContainer');
	$container.isotope({
        filter: '*',
		layoutMode: 'fitRows',
    });
 
    $('.portfolioFilter a').click(function(){
        $('.portfolioFilter .current').removeClass('current');
        $(this).addClass('current');
 
        var selector = $(this).attr('data-filter');
        $container.isotope({
            filter: selector,
            animationOptions: {
                duration: 750,
                easing: 'linear',
                queue: false
            }
         });
         return false;
    }); 
});
        
		