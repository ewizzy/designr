<?php 
$currentsid = apply_filters( 'designr_sidebar', 'sidebardefault' );
if ( is_active_sidebar($currentsid) ) {
if ( get_option( 'designr_sidebars' ) != array() ) :
dynamic_sidebar( apply_filters( 'designr_sidebar', 'sidebardefault' ) ); 

	else :
	  dynamic_sidebar( 'sidebardefault' ); 
	  endif; 
}
else { ?>
<p>
<?php echo __('Sidebar is empty. Please add widgets to sidebar in Appearance -> Widgets, or choose fullwidth page.','designr');?>
 </p>
<?php } ?>