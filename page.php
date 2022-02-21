<?php
global $designr;
get_header();
	while(have_posts()){
		the_post();
		$designrID = $post->ID;
	?>
	<section class="defpages">
<div class="container">
<h1 class="designr-h1"><?php the_title();?></h1>
</div>
</section>
	<div class="container">
    	<div class="row">
        	<div class="col-sm-12 page-maincontent">
            <?php the_content(); 
			$pageargs = array(
			'before' => '<div class="linkpages"><p>' . __( 'Pages:', 'designr' ),
			'after' => '</p></div>'
			);
			wp_link_pages($pageargs);?>
				<?php }
				if ( comments_open($designrID) ){
				comments_template();
				wp_list_comments( 
     array(
	'style'             => 'ul',
	'type'              => 'pings'
)); 
}
				?>
				
            </div>
        </div>
    </div>
<?php
get_footer();?>