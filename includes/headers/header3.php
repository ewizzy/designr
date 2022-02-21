<?php
global $designr;
?>
<header id="headerwrap" class="header-3<?php if($designr['relative-header']==1){ echo ' relative-header';}?>">
<?php 
if ($designr['topbar-switch']==1){?>
    <div class="top-bar"><div class="container"><div class="top-bar-content"><?php echo wp_kses_post($designr['topbar-content']);?></div></div></div>
	<?php
}
	?>
    <nav id="mainNav" class="navbar-custom <?php if($designr['sticky-switch']){ echo 'navbar-fixed-top';} else { echo 'navbar-static-top';} ?>">
        <div class="container flex-center">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="menu-container col-md-5 flex-justify-right">
            <ul class="mainmenu" id="TopMenu">
               <?php designr_primary_nav_menu('primary');?>		
            </ul>	   
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="col-md-2 logo-container centermenu">	
 <a class="navbar-brand page-scroll" href="<?php echo site_url(); ?>">
				<?php if($designr['logo1']['url']!=""){?>
				<img class="logo1" src="<?php echo esc_attr($designr['logo1']['url']);?>" alt="logo" />
				<?php }
				else { ?>
				<h2 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="white" rel="home"><?php bloginfo( 'name' ); ?></a></h2>
				<?php }
				if($designr['sticky-switch']){ ?>
				<img class="logo2" src="<?php echo esc_attr($designr['logo2']['url']);?>" alt="logo 2" />
				<?php } ?>
				</a>			
            </div>
            <!-- /.navbar-collapse -->
			<div class="col-md-4 flex-justify-left resmenu">
<ul class="mainmenu" id="TopMenu">
               <?php designr_primary_nav_menu('primary2');?>		
            </ul>
			<div id="designr-navbar">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
                                <?php
					if($designr['mobile-menu-design']==1){?>
					<span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-sort-desc"></i>
					<?php }
					else { ?>
					<i class="fa fa-bars" aria-hidden="true"></i>
					<?php } ?>
            </button>
			<!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse mobile-nav" id="bs-example-navbar-collapse-2">
               
               <?php 
                    if( has_nav_menu( 'mobile_menu' ) )
                        wp_nav_menu( array( 'theme_location' => 'mobile_menu', 'menu_class' =>'TopMenu nav navbar-nav navbar-right'  ) );
                ?>
              
            </div>
			</div>
			</div>
			<div class="col-md-1 flex-center-right">
			<?php			 			 if($designr['woo-cart']==1){
				 if(DESIGNR_WOOCOMMERCE_ACTIVE){
				 ?>
			<?php
			$count = WC()->cart->cart_contents_count;
			if($count>0){
    ?>
	 <div class="designr-woo">
	<a class="cart-contents" href="<?php echo WC()->cart->get_cart_url(); ?>" title="<?php echo __( 'View your shopping cart', 'designr' ); ?>">
<i class="fa fa-shopping-cart"></i>
        <span class="cart-contents-count"><?php echo sprintf ( _n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'designr' ), WC()->cart->get_cart_contents_count() ); ?></span>
</a> </div>	
			<?php }
			else { 
				if($designr['woo-cart-show']==1){
					?>
					<div class="designr-woo">
	<a class="cart-contents" href="<?php echo WC()->cart->get_cart_url(); ?>" title="<?php echo __( 'View your shopping cart', 'designr' ); ?>">
	<i class="fa fa-shopping-cart"></i>
	<span class="cart-contents-count"><?php echo __('0 Items','designr');?></span>
	</a>
	</div>
	<?php
	}
			}
			} }
			?>
			</div>
        </div>
        <!-- /.container-fluid -->
    </nav>
	</header>