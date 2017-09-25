<?php
/**
 * Dandyscores functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Dandyscores
 */

if ( ! function_exists( 'dandyscores_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function dandyscores_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Dandyscores, use a find and replace
		 * to change 'dandyscores' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'dandyscores', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'dandyscores' ),
			'menu-2' => esc_html__( 'Secondary', 'dandyscores' ),
			'menu-3' => esc_html__( 'Social Media Menu', 'dandyscores' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'dandyscores_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for Custom Logo
		add_theme_support( 'custom-logo', array(
			'width' => 90,
			'height' => 90,
			'flex-width' => true,
		));

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'dandyscores_setup' );

/**
 * Register custom fonts.
 */
function dandyscores_fonts_url() {
	$fonts_url = '';

	/*
	 * Translators: If there are characters in your language that are not
	 * supported by Source Sans Pro and PT Serif, translate this to 'off'. Do not translate
	 * into your own language.
	 */

	$source_sans_pro = _x( 'on', 'Source Sans Pro font: on or off', 'dandyscores');

	$pt_serif = _x( 'on', 'PT Serif font: on or off', 'dandyscores');

	$font_families = array();

	 $libre_franklin = _x( 'on', 'Libre Franklin font: on or off', 'dandyscores' );

	$font_families = array();

	if ( 'off' !== $source_sans_pro ) {

		$font_families[] = 'Source Sans Pro: 400, 400i, 700, 900';
	};

	if ( 'off' != $pt_serif ) {

		$font_families[] = 'PT Serif: 400, 400i, 700, 700i';

	};

	if ( in_array( 'on', array($source_sans_pro, $pt_serif) )) {

		// $font_families[] = 'Libre Franklin:300,300i,400,400i,600,600i,800,800i';

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}

/**
 * Add preconnect for Google Fonts.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function dandyscores_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'dandyscores-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'dandyscores_resource_hints', 10, 2 );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function dandyscores_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'dandyscores_content_width', 640 );
}
add_action( 'after_setup_theme', 'dandyscores_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function dandyscores_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'dandyscores' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'dandyscores' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'dandyscores_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function dandyscores_scripts() {
	// Enqueue Google Fonts: Source Sans Pro and PT Serif
	wp_enqueue_style( 'dandyscores-font', dandyscores_fonts_url());

	wp_enqueue_style( 'dandyscores-style', get_stylesheet_uri() );

	wp_enqueue_script( 'dandyscores-navigation', get_template_directory_uri() . '/js/navigation.js', array('jquery'), '20151215', true );

	// Define dandyscoresScreenreaderText variable in navigation.js for DropDown Menu
	wp_localize_script( 'dandyscores-navigation', 'dandyscoresScreenReaderText', array(
		'expand' => __( 'Expand child menu', 'dandyscores'),
		'collapse' => __( 'Collapse child menu', 'dandyscores'),
	));

	wp_enqueue_script( 'dandyscores-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'dandyscores_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

