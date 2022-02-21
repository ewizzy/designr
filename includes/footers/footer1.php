<?php
global $designr;
$aligns = $designr['f-widgets-align'];
?>
 <section id="footer">
   <div class="container<?php if($aligns==1){ echo ' footer-flex-center';}?>">
    <?php 
	if ( is_active_sidebar('footer-widgets') ) {
	dynamic_sidebar('footer-widgets');
	}
	else {
		echo '<p>';
		echo __('There are no widgets added to Footer Sidebar. Please add footer widgets by going to Appearance -> Widgets, or choose layout without widgets in Theme Options -> Footer Creator</p>','designr');
	}
	?>
   </div>
   </section>