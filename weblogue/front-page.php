<?php get_header(); ?>
<main>
<ul id="recent">
<?php
    $args = array( 'numberposts' => '6' );
    $recent_posts = wp_get_recent_posts( $args );
    $gallery = get_post_gallery_images( $args );
    $thumb = the_post_thumbnail($args);

    foreach( $recent_posts as $recent ){
        if ( has_post_thumbnail() ) {
            echo '<li><a href="' . get_permalink($recent["ID"]) . '">' .   $recent["post_title"]. $thumb.'</a> </li> ';
        }
 }
?>

</ul>
</main>
