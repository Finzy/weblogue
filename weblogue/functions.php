<?php
/**
 * WebLogue functions and definitions
 *
 * @package WebLogue
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'weblogue_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function weblogue_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on WebLogue, use a find and replace
	 * to change 'weblogue' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'weblogue', get_template_directory() . '/languages' );

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
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	//add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'weblogue' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'weblogue_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // weblogue_setup
add_action( 'after_setup_theme', 'weblogue_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function weblogue_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'weblogue' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'weblogue_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function weblogue_scripts() {
	wp_enqueue_style( 'weblogue-style', get_stylesheet_uri() );

	wp_enqueue_script( 'weblogue-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'weblogue-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'weblogue_scripts' );

function remove_admin_bar()
{
    return false;
}
add_filter('show_admin_bar', 'remove_admin_bar');

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

 function pw_show_gallery_image_urls( $content ) {

 	global $post;

 	// Only do this on singular items
 	if( ! is_singular() )
 		return $content;

 	// Make sure the post has a gallery in it
 	if( ! has_shortcode( $post->post_content, 'gallery' ) )
 		return $content;

 	// Retrieve the first gallery in the post
 	$gallery = get_post_gallery_images( $post );

	$image_list = '<ul>';

	// Loop through each image in each gallery
	foreach( $gallery as $image_url ) {

		$image_list .= '<li>' . '<img src="' . $image_url . '">' . '</li>';

	}

	$image_list .= '</ul>';

	// Append our image list to the content of our post
	$content .= $image_list;

 	return $content;

 }
 add_filter( 'the_content', 'pw_show_gallery_image_urls' );