<?php 
/* Template Name: Blog Masonry Random */
get_header();
$masonryclass = "masonry-4-random";
$marginright = get_post_meta( get_the_ID(), 'designr_margin-right', true );
$marginbottom = get_post_meta( get_the_ID(), 'designr_margin-bottom', true );
$pagewidth = get_post_meta( get_the_ID(), 'designr_pagewidth', true );
$showtitles = get_post_meta( get_the_ID(), 'designr_show_titles', true );
$showexcerpts = get_post_meta( get_the_ID(), 'designr_show_excerpts', true );
$showimages = get_post_meta( get_the_ID(), 'designr_show_featured_images', true );
$showcards = get_post_meta( get_the_ID(), 'designr_stickies', true );
$excerptlength = get_post_meta( get_the_ID(), 'designr_excerpt_length', true );
$masonrycss = "padding:".esc_html($marginbottom)." ".esc_html($marginright);
?>
<section class="defpages">
<div class="container">
<h1 class="designr-h1"><?php the_title();?></h1>
</div>
</section>
<section class="page-content">

        	<div class="page-maincontent designr-flex-grid" style="max-width:<?php echo esc_html($pagewidth);?>">
			<div id="masonry-list" class="masonry-list <?php echo esc_html($masonryclass);?>" >
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
			<article <?php post_class("blogpost");?>>
			<div class="article-wrap <?php if($showcards&&is_sticky()){ echo 'card';}?>" style="<?php echo esc_html($masonrycss);?>">
			<?php
			if($showimages==="show"){?><a href="<?php the_permalink();?>"><?php the_post_thumbnail('designr_blog2');?></a><?php } 
	  if($showtitles==="show"){?>
			<h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
	  <?php } 
	        if($showexcerpts==="show"){
				if(is_numeric($excerptlength)){
					echo '<p>'.wp_trim_words(get_the_excerpt(), $excerptlength).'</p>';
				}
				else {
				the_excerpt();
				}
            }
			?>
			</div>
			</article>
			<?php } ?>
			</div>
			<div class="site-pagination grid-pagination">
			<?php designr_paginate_links();?>
			</div>
			</div>
</section>
<?php get_footer();?>