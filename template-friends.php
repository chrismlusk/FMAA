<?php 

/* Template Name: Friends */ 

get_header(); ?>

<main id="grid-home" role="main">

<?php 

if ( have_posts() ) {
   while ( have_posts() ) {
      the_post();
   }
}

$friends = get_posts( array(
   'post_type' => 'friends',
   'posts_per_page' => -1,
   'orderby' => 'title',
));

// Back up global $post object
$post_backup = $post;

foreach( (array) $friends as $post ):
   setup_postdata( $post );

?>
   <div class="">
      <h3><?php the_title(); ?></h3>
      <p><?php echo the_field('twitter'); ?></p>
   </div>

<?php

 endforeach; 

 // Restore global $post object
 $post = $post_backup;

?>


</main>

<?php get_footer(); ?>
