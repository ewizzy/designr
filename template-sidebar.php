<?php
/* Template Name: Page With Sidebar */
get_header();
	while(have_posts()){
		the_post();
	?>
	<section class="defpages">
<div class="container">
<h1 class="designr-h1"><?php the_title();?></h1>
</div>
</section>
	<div class="container">
    	<div class="row">
        	<div class="col-sm-8 page-maincontent">
            <?php the_content();?>
            </div>
	<?php } ?>
			            <div class="col-sm-4 sidebar-padding">
						<div class="page-sidebar <?php if($designr['card-sid-switch']==1){ echo 'card';}?>">
<?php get_sidebar(); ?>
</div>
        </div>
        </div>
    </div>
<?php
get_footer();?>