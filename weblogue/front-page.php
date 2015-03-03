<?php get_header(); ?>
<main>
<ul id="recent">
<?php
    $args = array( 'numberposts' => '6' );
    $recent_posts = wp_get_recent_posts( $args );
    $gallery = get_post_gallery_images( $args );
    foreach( $recent_posts as $recent ){
        echo '<li><a href="' . get_permalink($recent["ID"]) . '">' .   $recent["post_title"].'</a> </li> ';
    }
?>
</ul>
</main>
