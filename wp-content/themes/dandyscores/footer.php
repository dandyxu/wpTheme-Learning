<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Dandyscores
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
        <nav class="footer-social">
            <?php
                wp_nav_menu( array(
                    'theme_location' => 'menu-3',
                    'menu_id'        => 'footer',
                ) );
            ?>
        </nav><!-- End Footer Social -->
		<div class="site-info">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'dandyscores' ) ); ?>"><?php
				/* translators: %s: CMS name, i.e. WordPress. */
				printf( esc_html__( 'Proudly powered by %s', 'dandyscores' ), 'WordPress' );
			?></a>
			<span class="sep"> | </span>
			<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Theme: %1$s by %2$s.', 'dandyscores' ), 'dandyscores', '<a href="http://dandyxu.com">Dandy Xu</a>' );
			?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
