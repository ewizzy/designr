<?php
/* 
Template Name: Fullwidth
*/
get_header(); ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
<div class="full-row">
<div class="leftside goodtags leftful">
<?php
	  while(have_posts()){ the_post();
?>
<div class="postwrap">
<div class="sdata">
<?php the_content();?>
</div>

</div>
<?php }
?>
</div>
</div>

		</main><!-- #main -->
	</div><!-- #primary -->
<?php get_footer(); ?>