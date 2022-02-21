<?php
/**
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Designr
 */
 
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="<?php if(!DESIGNR_ADDONS_ACTIVE){ echo 'designr-addons-inactive';}?>">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
<meta content="telephone=no" name="format-detection">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php 
global $designr;
wp_head();?>
</head>
<body <?php body_class(); ?>>
<?php
    designr_getOverlay();
    designr_getHeader();
?>