<?php
get_header();
?>
<section class="defpages">
<div class="container">
<?php if ( is_home() && ! is_front_page() ) : ?>
			<h1 class="designr-h1"><?php single_post_title(); ?></h1>
	<?php else : ?>
		<h1 class="designr-h1"><?php _e( 'Posts', 'designr' ); ?></h1>
	<?php endif; ?>
</div>
</section>
<section class="page-content">
	<div class="container">
    	<div class="row">
        	<div class="col-sm-8 page-maincontent blog-wrap">
			<?php
            $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
	global $wp_query;
	  $wp_query = new WP_Query("post_type=post&paged=".$paged);
	  if(!$wp_query->have_posts()){ 
	  echo '<h2>';
	  echo __('No posts found.','designr');
	  echo '</h2>';}
	  while($wp_query->have_posts()){ 
	  $wp_query->the_post();
	  $rauthor = get_the_author_meta('first_name');
$rauthorln = get_the_author_meta('last_name');?>
			<div <?php post_class("blogpost");?>>
			<a href="<?php the_permalink();?>"><?php the_post_thumbnail('designr_blog2');?></a>
			<div class="posted"><?php echo __('Posted on ','designr');echo get_the_date();?></div>
			<h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
			<?php 
			if(strstr($post->post_content,'<!--more-->')) {
				?>
				<p>
				<?php
				echo get_the_excerpt();?> <a href="<?php the_permalink();?>"><?php echo __('Read More','designr');?></a></p>
				<?php
			}
			else {
				the_excerpt();
			}
			?>
			</div>
			<?php } ?>
			<div class="site-pagination">
			<?php designr_paginate_links();?>
			</div>
		
			
            </div>
			            <div class="col-sm-4 sidebar-padding">
						<div class="page-sidebar <?php if($designr['card-sid-switch']==1){ echo 'card';}?>">
<?php if ( !is_active_sidebar('sidebarblog') ) { ?>
<p>
<?php echo __('Please add widgets to "Blog Sidebar" or choose template without sidebar.','designr');?>
<?php
 } 
else { dynamic_sidebar( 'sidebarblog' );} ?>
</div>
        </div>
        </div>
    </div>
</section>
<?php get_footer();?>