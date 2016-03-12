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

            <div class="inner-wrap article no-btm-pad">

               <h1><?php _e( 'Friendly faces', 'html5blank' ); ?></h1>
            
         <?php if (have_posts()): while (have_posts()) : the_post(); ?>

            </div><!-- /inner-wrap for page title -->

            <div class="flex-container article">
               
               <?php foreach( $posts as $post ):

                  setup_postdata( $post );

                  if ( get_field('is_active') ):

                     ?>

                     <div class="flex-item friend-wrapper <?php echo friend_inactive(); ?>">
                        <div class="inner-wrap">
                           <a href="<?php the_permalink(); ?>">
                              <?php if ( get_field('photo') ) : ?>
                                 <img src="<?php the_field('photo'); ?>" />
                              <?php else : ?>
                                 <img src="<?php echo get_template_directory_uri(); ?>/img/gravatar.jpg ?>" />
                              <?php endif; ?>
                              <div class="friend-info">
                                 <span class="name">
                                    <span class="rank">(<?php echo get_the_tournament_seed(); ?>)</span> <?php the_title(); ?>
                                 </span>
                              </div>
                           </a>

                           <span class="detail team <?php echo get_the_team_status('team_a'); ?>">
                              <?php echo get_the_team('team_a'); ?>
                           </span>
                           <span class="detail team <?php echo get_the_team_status('team_b'); ?>">
                              <?php echo get_the_team('team_b'); ?>
                           </span>

                           <?php if ( get_field('twitter') ): ?>
                              <span class="detail"><?php echo link_to_twitter_username(); ?></span>
                           <?php endif; ?>
                           
                        </div>
                     </div>

                  <?php endif; // if friend is active ?>

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