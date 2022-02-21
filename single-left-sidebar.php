<?php
/*
 * Template Name: Left sidebar
 * Template Post Type: post
 */
get_header();?>
<!-- Header -->
<section class="defpages">
<div class="container">
<h1 class="designr-h1"><?php the_title();?></h1>
</div>
</section>	
<section id="single-blog-page" class="page-content">
<?php while(have_posts()):the_post();
global $designrID;
$designrID = $post->ID;
/* all variables are cleaned before */
$realauthor = get_the_author_meta('first_name');
$realauthorln = get_the_author_meta('last_name');
$realdesc = get_the_author_meta('description');
$author_id=$post->post_author;
$reallink = get_author_posts_url($author_id);
$realimg = get_avatar_url($author_id, array('size'=>'85'));
global $designr, $realauthor, $realdesc, $realauthorln, $reallink, $realimg;
$ownperma = get_permalink();
if(1>2){ $themechecker = get_the_tags(); }
?>
	<div class="container">
    	<div class="row">
					            <div class="col-sm-4 sidebar-padding">
						<div class="page-sidebar <?php if($designr['card-sid-switch']==1){ echo 'card';}?>">
<?php get_sidebar(); ?>
</div>
        </div>
        	<div class="col-sm-8 page-maincontent blog-wrap">
			<article <?php post_class(); ?>>
			 <figure>
  <?php the_post_thumbnail("blogsingle");?>
</figure>
 <div class="dateinfo">
 <?php echo __('Posted on','designr');?> <time><?php echo get_the_date();?></time><?php if($realauthor!=""){?> <?php echo __('by','designr');?> <a href="<?php echo esc_attr($reallink);?>" rel="author"><?php echo esc_attr($realauthor).' '.esc_attr($realauthorln);?></a> <?php } echo __(' in ','designr'); echo get_the_category_list(', ', '', get_the_ID()); ?>
</div>
<div class="maincontent">
<?php the_content();?>
</div>
<?php 
if($designr['tagssh-switch']==1){
$tags = wp_get_post_tags($post->ID);
  if ($tags) {
  echo '<div class="post-tags">
Tags <div class="bluetags">';
    foreach($tags as $tag) {
        echo '<a href="' . get_term_link( $tag, 'post_tag' ) . '" title="' . sprintf( __( "View all posts in %s", "designr" ), $tag->name ) . '" ' . '>' . $tag->name.'</a>';
    }
	echo '</div>
</div>';
  } }
 ?>
</article>
<?php
//for use in the loop, list 5 post titles related to first tag on current post
if($designr['relatedposts-switch']==1){
if ($tags) {
$first_tag = $tags[0]->term_id;
$args=array(
'tag__in' => array($first_tag),
'post__not_in' => array($post->ID),
'posts_per_page' => 2
);
global $bordy;
$bordy = false;
$my_query3 = new WP_Query($args);
if( $my_query3->have_posts() ) {
	$bordy = true;
echo '<div class="related-posts">
<div class="dateinfo">Related Posts</div>
<div class="rpboxes">';
while ($my_query3->have_posts()) : $my_query3->the_post(); ?>
<div class="rbox">
<a href="<?php the_permalink();?>"><?php the_post_thumbnail('designr_blog2');?></a>
<h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
<div class="datebox dateinfo"><?php echo __('Posted on','designr');?> <time><?php echo get_the_date();?></time></div>
</div>
<?php
endwhile;
echo '</div></div>';
}
//wp_reset_query();
} }?>

<?php 
if ( comments_open($designrID) ){
				comments_template();
				wp_list_comments( 
     array(
	'style'             => 'ul',
	'type'              => 'pings'
)); 
}
?>
<?php if($designr['relatedposts-switch2']==1){?>
<div class="posts-nav">
<?php 
if($ownperma!=get_permalink(get_adjacent_post(false,'',false))){?>
<a class="prevpost" href="<?php echo get_permalink(get_adjacent_post(false,'',false)); ?>"><?php echo __('PREVIOUS POST','designr');?></a>
<?php } 
if($ownperma!=get_permalink(get_adjacent_post(false,'',true))){?>
<a href=" <?php echo get_permalink(get_adjacent_post(false,'',true)); ?> " class="nextpost"><?php echo __('NEXT POST','designr');?></a>
<?php } ?>
</div>
<?php } ?>
           </div>
			<?php 
			endwhile;
			?>
    </div>
</section>
<?php get_footer();?>