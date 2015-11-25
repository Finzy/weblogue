## Into

Dit is een Wordpress project voor school.
Het is vooral gefocust op Front-end, want dit is waar het om draaide.

## Voorbeeld

Dit is een stukje van een wordpress post waar hij de most recent 6 posts pakt.

  <?php get_header(); ?>
  <main>
  <ul id="recent">
  <?php
      $args = array( 'numberposts' => '6' );
      
      $recent_posts = wp_get_recent_posts( $args );
      foreach( $recent_posts as $recent ){
              echo '<li><a href="' . get_permalink($recent["ID"]) . '">' .   $recent["post_title"].'</a> </li> ';
   }
    ?>
    
    </ul>
    </main>

## Installatie

Het volledige .zip bestand uploaden bij het tabje thema's in wordpress, dit is het enige wat er gedaan moet worden voor de rest regelt wordpress het allemaal zelf.
