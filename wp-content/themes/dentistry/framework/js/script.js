// JavaScript Document
( function( $ ) {
	"use strict";
    $( function() {
        $.fn.ease = function() {

    $(document).ready(function () {
        var checkbox = $('.btn'); 
        var dependent = $('.btn_name');
        var dependent_1 = $('.btn_link');
        
        if (checkbox.attr('checked') !== undefined){
           dependent.show();
           dependent_1.show();
        } else {
            dependent.hide();
            dependent_1.hide();
        }
        
        checkbox.change(function(e){
           dependent.toggle('slow','linear'); 
           dependent_1.toggle('slow','linear'); 
        });
    }); 
        }
        $( '.btn' ).ease(); // Use as default option.




    } );
} ( jQuery ) );
