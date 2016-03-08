   <?php get_header(); ?>

   <main id="grid" role="main">

      <?php if (have_posts()): while (have_posts()) : the_post(); ?>

         <!-- section -->
         <section id="friend-profile" class="flex-container">

            <div class="flex-item friend-wrapper">
               <div class="inner-wrap">
                  <header class="friend-header article clearfix">
                     <img src="<?php the_field('photo'); ?>" />
                     <div class="header-text">
                        <h1>
                           <span class="rank">(<?php echo tournament_seed(); ?>)</span>
                           <?php the_title(); ?>
                           <span class="detail team">Team A, Team B</span>
                        </h1>
                        <!-- <span class="detail team">Team A, Team B</span> -->
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
