<?php
/**
 * Content wrappers
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/wrapper-start.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
if(is_shop()||is_product_category()||is_product_tag()||is_product()||is_account_page()||is_wc_endpoint_url()){
	$wrapclass = "col-sm-8";
}
else {
	$wrapclass = "col-sm-12";
}
?>
<section class="defpages">
<div class="container">
<h1 class="designr-h1"><?php the_title(); ?></h1>
</div>
</section>
	<div class="container">
    	<div class="row">
        	<div class="<?php echo esc_html($wrapclass);?> page-maincontent">