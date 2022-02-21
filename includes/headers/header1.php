<?php
global $designr;
?>
<header id="headerwrap" class="header-1<?php if($designr['relative-header']==1){ echo ' relative-header';}?>">
<?php 
if ($designr['topbar-switch']==1){?>
    <div class="top-bar"><div class="container"><div class="top-bar-content"><?php echo wp_kses_post($designr['topbar-content']);?></div></div></div>
	<?php
}
	?>
    <nav id="mainNav" class="navbar-custom <?php if($designr['sticky-switch']){ echo 'navbar-fixed-top';} else { echo 'navbar-static-top';} ?>">
        <div class="container flex-center">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="logo-container col-md-2">
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

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="col-md-10 menucontainer rightmenu flex-center-right">
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
            <!-- /.navbar-collapse -->
			<ul class="mainmenu" id="TopMenu">
               <?php if(!has_nav_menu('primary')){ 
			   echo '<h6>';
			   echo __('Please Add Menu in Appearance->Menus','designr');
			   echo '</h6>';
			   }
			   else { designr_primary_nav_menu('primary');}?>		
            </ul>
			<div class="iconscontainer">
						 <!-- load icons if choosed -->  
			 <?php 
			 			 if($designr['hbutton-switch']==1){
				 ?>
				 <div class="designr-button">
				 <a href="<?php echo esc_attr($designr['hbuttonlink']);?>" class="btn-default"><?php echo esc_attr($designr['hbuttontxt']);?></a>
				 </div>
				 <?php
			 }
			 if(($designr['search-switch']==2)||($designr['search-switch']==4)){
				 ?>
             <div class="designr-search">
			 <i id="trigger-overlay" class="tmenu fa fa-search" aria-hidden="true"></i>
			 </div>	
             <?php } 
			 if($designr['woo-cart']==1){
				 if(DESIGNR_WOOCOMMERCE_ACTIVE){
				 ?>
			<?php
			$count = WC()->cart->cart_contents_count;
			if($count>0){
    ?>
	 <div class="designr-woo">
	<a class="cart-contents" href="<?php echo WC()->cart->get_cart_url(); ?>" title="<?php echo __( 'View your shopping cart', 'designr' ); ?>">
	<?php
    if ( $count > 0 ) {
		echo '<i class="fa fa-shopping-cart"></i>';
        ?>
        <span class="cart-contents-count"><?php echo sprintf ( _n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'designr' ), WC()->cart->get_cart_contents_count() ); ?></span>
        <?php
    }
        ?></a> </div>	
			<?php }
			else { 
				if($designr['woo-cart-show']==1){
					?>
					<div class="designr-woo">
	<a class="cart-contents" href="<?php echo WC()->cart->get_cart_url(); ?>" title="<?php echo __( 'View your shopping cart', 'designr' ); ?>">
	<?php
    echo '<i class="fa fa-shopping-cart"></i>';
	?>
	</a>
	</div>
	<?php
	}
			}
			?>
             <?php } }
			  if(($designr['search-switch']==1)||($designr['search-switch']==4)){
				 ?>
			 <div class="designr-menu">
			 <a href="javascript:;" id="trigger-overlay-menu" class="designr-modal-menu<?php if($designr['menuiconstyle']==2){ echo ' regicon';} if($designr['menuiconstyle']==3){ echo ' dots-menu';} if($designr['menu-style']==2){ echo ' roundy';} if($designr['menu-style']==3){ echo ' blocky';}?>">
			 <?php if($designr['menuiconstyle']!=3){ echo '<i></i>';}
			 else {
				 echo '<span></span><span></span><span></span>';
			 }
			 ?>
			 </a>
			 </div>
			 <?php
             }
			 ?>
			</div>			
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
	</header>