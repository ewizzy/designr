<?php
get_header();
?>
<section class="defpages">
<div class="container">
<h1 class="designr-h1">Category: <?php echo single_cat_title( '', false );?></h1>
</div>
</section>
<section class="page-content">
	<div class="container">
    	<div class="row">
        	<div class="col-sm-8 page-maincontent blog-wrap">
			<?php
            $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
			if(!have_posts()){ 
			echo '<h2>';
			echo __('No posts found.','designr');
			echo '</h2>';
			}
	  while(have_posts()){ 
	  the_post();
	  $rauthor = get_the_author_meta('first_name');
$rauthorln = get_the_author_meta('last_name');?>
			<div <?php post_class("blogpost");?>>
			<a href="<?php the_permalink();?>"><?php the_post_thumbnail('designr_blog2');?></a>
			<div class="posted"><?php echo __('Posted on','designr');?> <?php echo get_the_date();?></div>
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
<?php dynamic_sidebar( 'sidebarblog' ); ?>
</div>
        </div>
        </div>
    </div>
</section>
<?php get_footer();?>