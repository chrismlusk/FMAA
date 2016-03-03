<?php 

/* Template Name: Friends */ 

get_header();

$posts = get_posts( array(
   'post_type' => 'friends',
   'posts_per_page' => -1,
   'meta_key' => 'seed',
   'orderby' => 'meta_value_num',
   'order' => 'ASC'
));

if( $posts ): ?>

<main id="grid" role="main">

   <!-- section -->
   <section id="friends" class="flex-container">
      <div class="flex-item">
         <div class="inner-wrap">

         <?php foreach( $posts as $post ):

            setup_postdata( $post ); ?>

               <div class="">

                  <h3><?php the_title(); ?></h3>

                  <?php if ( get_field('twitter') ): ?>
                     <p><a href="<?php the_field('twitter'); ?>" target="_blank">
                           <?php

                           $str = get_field('twitter');
                           $twitter_name = preg_replace('/^.*\/\s*/', '', $str);
                           echo '@' . $twitter_name;

                           ?>
                        </a></p>
                  <?php endif; ?>

                  <p>
                     <?php

                     $seed = get_field('seed');

                     if ( $seed > 28 ) {
                        $bracket_seed = 8;
                     }
                     elseif ( $seed < 29 && $seed > 24 ) {
                        $bracket_seed = 7;
                     }
                     elseif ( $seed < 25 && $seed > 20 ) {
                        $bracket_seed = 6;
                     }
                     elseif ( $seed < 21 && $seed > 16 ) {
                        $bracket_seed = 5;
                     }
                     elseif ( $seed < 17 && $seed > 12 ) {
                        $bracket_seed = 4;
                     }
                     elseif ( $seed < 13 && $seed > 8 ) {
                        $bracket_seed = 3;
                     }
                     elseif ( $seed < 9 && $seed > 4 ) {
                        $bracket_seed = 2;
                     }
                     else {
                        $bracket_seed = 1;
                     } ?>

                     Overall seed: <?php the_field('seed'); ?><br />Bracket seed: <?php echo $bracket_seed; ?>
                  </p>

                  <?php if( get_field('title_history') ): ?>
                     <p>Best Friend in <?php the_field('title_year'); ?></p>
                  <?php endif; ?>

                  <p><?php echo get_the_term_list( $post->ID, 'conference', 'Conference: ', ', ', '' ); ?></p>

               </div>

         <?php endforeach; ?>

         </div>
      </div>
   </section>

</main>

<?php wp_reset_postdata(); ?>

<?php endif; ?>

<?php get_footer(); ?>
