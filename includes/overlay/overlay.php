<?php
global $designr;
?>
<div class="overlay2 overlay-scale">
<div class="modalwrap">
	<i class="fa fa-times-circle overlay-close" aria-hidden="true"></i>
	<div class="trans-pie">
			<nav>
		 <?php wp_nav_menu( array( 'theme_location' => 'transparent', 'menu_id' => 'transaprentmenu', 'menu_class' =>'' ) ); ?>
	</nav>
	</div>
		<div class="trans-pie">
			<nav>
		 <?php wp_nav_menu( array( 'theme_location' => 'transparent2', 'menu_id' => 'transaprentmenu2', 'menu_class' =>'' ) ); ?>
	</nav>
	</div>
		<div class="trans-pie">
			<nav>
		 <?php wp_nav_menu( array( 'theme_location' => 'transparent3', 'menu_id' => 'transaprentmenu3', 'menu_class' =>'' ) ); ?>
	</nav>
	</div>
	</div>
</div>

<div class="overlay overlay-scale">
	<i class="fa fa-times-circle overlay-close" aria-hidden="true"></i>
	<div class="modalwrap">
	<form method="GET" action="<?php echo esc_url( home_url( '/' ) );?>"><input type="text" class="bigsearchbox" value="" name="s" placeholder="Type and hit enter" /></form>
	</div>
</div>