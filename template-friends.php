<?php 

/* Template Name: Friends */ 

get_header();

$posts = get_posts( array(
   'post_type' => 'friends',
   'posts_per_page' => -1,
   'meta_key' => 'seed', // only posts with seed (excludes inactives)
   'orderby' => 'meta_value_num', // order by overall seed
   'order' => 'ASC'
)); ?>

   <main id="grid" role="main">

      <!-- section -->
      <section id="friends" class="flex-container">
         <div class="flex-item">

            <div class="inner-wrap">

               <h1><?php the_title(); ?></h1>
            
         <?php if (have_posts()): while (have_posts()) : the_post(); ?>

            </div><!-- /inner-wrap for page title -->

            <div class="flex-container">
               
               <?php foreach( $posts as $post ):

                  setup_postdata( $post );

                  $team_a_out = null;
                  $team_b_out = null;
                  $a_eliminated = get_field('team_a_eliminated');
                  $b_eliminated = get_field('team_b_eliminated');
                  if ( $a_eliminated ) {
                     $team_a_out = 'knocked-out';
                  }
                  if ( $b_eliminated ) {
                     $team_b_out = 'knocked-out';
                  }

                  $extra_class = null;
                  $eliminated = get_field('is_eliminated');
                  if ( $eliminated ) {
                     $extra_class = 'inactive';
                  }

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
                  }

                  $twitter = get_field('twitter');
                  $twitter_name = preg_replace('/^.*\/\s*/', '', $twitter);

                  $active = get_field('is_active');

                  if ( $active ):

                     ?>

                     <div class="flex-item friend-wrapper <?php echo $extra_class; ?>">
                        <div class="inner-wrap">
                           <a href="<?php the_permalink(); ?>">
                              <img src="<?php the_field('photo'); ?>" />
                              <div class="friend-info">
                                 <span class="name">
                                    <span class="rank">(<?php echo $bracket_seed; ?>)</span> <?php the_title(); ?>
                                 </span>
                              </div>
                           </a>

                           <span class="detail team <?php echo $team_a_out; ?>">
                              <?php the_field('team_a'); ?>
                           </span>
                           <span class="detail team <?php echo $team_b_out; ?>">
                              <?php the_field('team_b'); ?>
                           </span>

                           <span class="detail"><?php echo get_the_term_list( $post->ID, 'conference', 'Conference: ', ', ', '' ); ?></span>

                           <?php if ( $twitter ): ?>
                              <span class="detail">Twitter: <a href="<?php the_field('twitter'); ?>" target="_blank"><?php echo '@' . $twitter_name; ?></a></span>
                           <?php endif; ?>

                           <?php // if( get_field('title_history') ): ?>
                              <!-- <span class="detail">Best Friend in <?php the_field('title_year'); ?></span> -->
                           <?php // endif; ?>
                           


                        </div>
                     </div>

                  <?php endif; ?>

               <?php endforeach; ?>

               <?php wp_reset_postdata(); ?>
                  
            <?php endwhile; ?>

            <?php else: ?>

               <h2><?php _e( 'Sorry, no friends to display.', 'html5blank' ); ?></h2>

               <?php wp_reset_postdata(); ?>

            </div>

         <?php endif; ?>

         </div>
      </section>

      <?php get_footer(); ?>