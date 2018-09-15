jQuery(document).ready(function(){
wp.customize( 'css_editor-header', function( value ) {
  value.bind( function( newval ) {
    jQuery( '#css_editor-header' ).text(newval );
  } );
} );
wp.customize( 'css_editor-body', function( value ) {
  value.bind( function( newval ) {
    jQuery( '#css_editor-body' ).text(newval );
  } );
} );
wp.customize( 'css_editor-footer', function( value ) {
  value.bind( function( newval ) {
    jQuery( '#css_editor-footer' ).text(newval );
  } );
} );
wp.customize( 'css_editor-general', function( value ) {
  value.bind( function( newval ) {
    jQuery( '#css_editor-general' ).text(newval );
  } );
} );
wp.customize( 'css_editor-mobile', function( value ) {
  value.bind( function( newval ) {
    jQuery( '#css_editor-mobile' ).text(newval );
  } );
} );
wp.customize( 'css_editor-loop', function( value ) {
  value.bind( function( newval ) {
    jQuery( '#css_editor-loop' ).text(newval );
  } );
} );
wp.customize( 'css_editor-single', function( value ) {
  value.bind( function( newval ) {
    jQuery( '#css_editor-single' ).text(newval );
  } );
} );
wp.customize( 'css_editor-sidebarcats', function( value ) {
  value.bind( function( newval ) {
    jQuery( '#css_editor-sidebarcats' ).text(newval );
  } );
} );
});
