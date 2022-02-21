<?php
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
$realauthor = get_the_author_meta('first_name');
$realauthorln = get_the_author_meta('last_name');
$realdesc = get_the_author_meta('description');
$author_id=$post->post_author;
$reallink = get_author_posts_url($author_id);
$realimg = get_avatar_url($author_id, array('size'=>'85'));
global $designr, $realauthor, $realdesc, $realauthorln, $reallink, $realimg;
$ownperma = get_permalink();
?>
	<div class="container">
    	<div class="row">
        	<div class="col-sm-8 page-maincontent blog-wrap">
			<article>
			 <figure>
  <?php the_post_thumbnail("blogsingle");?>
</figure>
<div class="maincontent">
<?php the_content();?>
</div>
</article>
           </div>
			<?php 
			endwhile;
			?>
			            <div class="col-sm-4 sidebar-padding">
						<div class="page-sidebar <?php if($designr['card-sid-switch']==1){ echo 'card';}?>">
<?php get_sidebar(); ?>
</div>
        </div>
    </div>
</section>
<?php get_footer();?>