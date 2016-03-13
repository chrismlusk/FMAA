   <?php get_header(); ?>

   <main id="grid" role="main">

      <?php if (have_posts()): while (have_posts()) : the_post(); ?>

         <!-- section -->
         <section id="friend-profile" class="flex-container">

            <div class="flex-item friend-wrapper">
               <div class="inner-wrap">
                  <header class="friend-header article clearfix">
                     <?php if ( get_field('photo') ) : ?>
                        <img src="<?php the_field('photo'); ?>" />
                     <?php else : ?>
                        <img src="<?php echo get_template_directory_uri(); ?>/img/gravatar.jpg" />
                     <?php endif; ?>
                     <div class="header-text">
                        <h1>
                           <span class="rank">(<?php echo get_the_tournament_seed(); ?>)</span>
                           <?php the_title(); ?>
                           <span class="detail team">
                              <span class="<?php echo get_the_team_status('team_a'); ?>">
                                 <?php 
                                    if ( get_the_team('team_a') ) {
                                    echo get_the_team('team_a'); 
                                    }
                                    else {
                                       echo '(Team N/A)';
                                    }
                                 ?>
                              </span>, 
                              <span class="<?php echo get_the_team_status('team_b'); ?>">
                                 <?php 
                                    if ( get_the_team('team_b') ) {
                                    echo get_the_team('team_b'); 
                                    }
                                    else {
                                       echo '(Team N/A)';
                                    }
                                 ?>
                              </span>
                           </span>
                        </h1>
                        <ul class="icon-list">
                           <?php if ( get_field('twitter') ) : ?>
                              <li class="twitter"><?php echo link_to_twitter_username(); ?></li>
                           <?php endif; ?>
                           <li class="tag">
                              <?php echo strip_tags(get_the_term_list( get_the_ID(), 'conference', 'Conference: ', ',' )); ?>
                           </li>
                           <?php if ( get_field('fmaa_history') ) : ?>
                              <li class="basketball">
                                 History: <?php echo fmaa_history_range(); ?>
                              </li>
                           <?php endif; ?>
                           <?php if ( get_field('title_history') ) : ?>
                              <li class="trophy">
                                 Best Friend: <?php the_field('title_year'); ?>
                              </li>
                           <?php endif; ?>
                           <?php if ( get_field('mvp_history') ) : ?>
                              <li class="star">
                                 MVP: <?php the_field('mvp_year'); ?>
                              </li>
                           <?php endif; ?>
                        </ul>
                     </div>
                  </header>
               </div>
            </div>

         </section>

         <!-- post layout  -->
         <section id="" class="flex-container">

            <div class="flex-item primary-slot">
               <div class="inner-wrap">

                  <!-- article -->
                  <article id="post-<?php the_ID(); ?>" class="article clearfix">

                     <p class="lead"><?php write_friend_lead(); ?></p>

                     <?php if ( get_the_content() ) : ?>

                        <h4>Message from the commissioner</h4>

                        <?php the_content(); ?>

                        <div class="signature"></div>

                     <?php endif; ?>

                     <?php edit_post_link(); ?>

                  </article>
                  <!-- /article -->

               </div>
            </div>

      <?php endwhile; ?>

      <?php else: ?>

         <section id="default" class="flex-container">
            <div class="flex-item primary-slot">
               <div class="inner-wrap">
                  <h1><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h1>
               </div>
            </div>

      <?php endif; ?>

         <div class="flex-item sidebar-slot">
            <?php get_sidebar(); ?>
         </div>

      </section>
      <!-- /post layout -->

      <?php get_footer(); ?>
