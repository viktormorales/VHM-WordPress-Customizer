/**
 * This file adds some LIVE to the Theme Customizer live preview. To leverage
 * this, set your custom settings to 'postMessage' and then add your handling
 * here. Your javascript should grab settings from customizer controls, and 
 * then make any necessary changes to the page using jQuery.
 */
( function( $ ) {

	// SITE TITLE
	wp.customize( 'blogname', function( value ) {
		value.bind( function( newval ) {
			$( '#site-title' ).html( newval );
		} );
	} );
	
	// BLOG DESCRIPTION
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( newval ) {
			$( '#site-description' ).html( newval );
		} );
	} );

	// SITE TITLE COLOR
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( newval ) {
			$('#primary').css('color', newval );
		} );
	} );
	
	// BACKGROUND COLOR
	wp.customize( 'background_color', function( value ) {
		value.bind( function( newval ) {
			$('body').css('background-color', newval );
		} );
	} );
	
	// HOME BACKGROUND COLOR
	wp.customize( 'home_background_color', function( value ) {
		value.bind( function( newval ) {
			$('body.home').css('background-color', newval + ' !important');
		} );
	} );
	
	// LINK TEXT COLOR
	wp.customize( 'link_textcolor', function( value ) {
		value.bind( function( newval ) {
			$('a').css('color', newval );
		} );
	} );
	
	// LIVE PREVIEW FOR EACH PANEL
	$.each(customizer_var.panels, function(k, v){
		wp.customize( k + '_main_title', function( value ) {
			value.bind( function( newval ) {
				$('section#' + k + ' #' + k + '-title').html(newval );
			} );
		} );
		wp.customize( k + '_background_color', function( value ) {
			value.bind( function( newval ) {
				$('section#' + k + '').css('background-color', newval );
			} );
		} );
		wp.customize( k + '_text_color', function( value ) {
			value.bind( function( newval ) {
				$('section#' + k + '').css('color', newval );
			} );
		} );
		wp.customize( k + '_template', function( value ) {
			value.bind( function( newval ) {
				$('section#' + k + ' #' + k + '-template').html(newval);
			} );
		} );
	});
} )( jQuery );