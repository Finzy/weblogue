<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WebLogue
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
            <ul id="allp">
            <?php
            $recent_posts = wp_get_recent_posts();
            foreach( $recent_posts as $recent ){
                echo '<li><a href="' . get_permalink($recent["ID"]) . '">' .   $recent["post_title"].'</a> </li> ';
             }
            ?>
            </ul>
		</main><!-- #main -->
	</div><!-- #primary -->
