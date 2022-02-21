<?php
global $designr;
$addclass = "";
if($designr['f-widgets-align']==1){
	$addclass = "center-widgets";
        }	
?>
 <footer id="footerwrap" class="<?php echo esc_attr($addclass);?>">
 <?php designr_getFooter();
    if($designr['footerbar-switch']){
		if($designr['footerbarswitch']==1){
		echo '<div class="footer-bar scheme2bg">';
		}
		else {
			echo '<div class="footer-bar" style="background-color:'.esc_attr($designr['footer-bar-bg']['color']).'">';
		}
		?>
		<div class="container">
		<?php 
		echo wp_kses_post($designr['footerbar-editor']);?>
		</div>
		</div>
		<?php
    }		
  ?>
	</footer>
	<?php 
	wp_footer();
	designr_getPreloader();
	?>
</body>
</html>