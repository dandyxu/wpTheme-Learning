<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Dandyscores
 */

if ( ! is_active_sidebar( 'sidebar-footer' ) ) {
	return;
}
?>

<aside id="footer-widget" class="widget-area footer-widget" role="complementary">
	<?php dynamic_sidebar( 'sidebar-footer' ); ?>
</aside><!-- #secondary -->
