<?php 

/* Template Name: Homepage */ 

get_header(); ?>

   <main id="grid" role="main">


      <!-- Primary section -->
      <section id="home-primary" class="flex-container">

         <!-- announcements slot -->
         <div class="flex-item announcements-slot">
            <div class="flex-container">

               <!-- up next box -->
               <div class="flex-item nested">
                  <div class="inner-wrap">
                  <?php

                  query_posts(array(
                     'category_name' => 'Up Next'
                  ));

                  if( have_posts() ) : the_post(); ?>

                     <span class="kicker"><?php the_title(); ?></span>
                     <h4><?php the_field('event_name'); ?></h4>
                     <p><?php the_content(); ?></p>
                     <ul class="icon-list">
                        <li class="time">
                           <strong><?php echo event_countdown(get_field('event_date')); ?></strong>
                        </li>
                     </ul>

                  <?php else: ?>

                     <span class="kicker">Up next</span>
                     <h4>No upcoming events</h4>

                  <?php endif; ?>
                     
                  </div>
               </div>

               <!-- reminders box -->
               <div class="flex-item nested">
                  <div class="inner-wrap">
                     <span class="kicker">Don't forget</span>
                     <h4>The FMAA toolkit</h4>
                     <p>For the friendliest tourney experience, be sure to check out the following:</p>
                     <ul class="icon-list">
                        <li class="twitter">
                           We tweet at <a href="https://twitter.com/FriendMadness" target="_blank">@FriendMadness</a>, so follow and use the hashtag #FMAA16
                        </li>
                        <li class="trophy">
                           Fill out and submit an <a href="bracket">FMAA bracket</a> before the tournament tips off
                        </li>
                        <li class="plus">
                           Download our official <a href="https://chrome.google.com/webstore/detail/friendship-madness/ljeefnijldbmngpomnkdiklijedmkmck?hl=en-US" target="_blank">Chrome extension</a> and make the web friendlier
                        </li>
                     </ul>
                  </div>
               </div>

            </div>
         </div>
         <!-- /announcements slot -->

         <!-- lead slot -->
         <div class="flex-item lead-slot">
            <article class="inner-wrap">

            <?php

            query_posts(array(
               'category_name' => 'Featured'
            ));
            if (have_posts()): while (have_posts()) : the_post();
               $img_url = wp_get_attachment_url( get_post_thumbnail_id() );
               ?>

               <a href="<?php the_permalink(); ?>" class="lead-slot-link">
                  <div class="bg-image featured" 
                  style="background-image:url('<?php echo $img_url; ?>')"></div>
                  <h1><?php the_title(); ?></h1>
                  <button class="btn btn-default">
                     <span class="read-more">Read more <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span></span>
                  </button>
               </a>

            <?php endwhile; ?>

            <?php else: ?>

               <!--  WARNING: You need to put a fallback lead item here -->

            <?php 

            endif; 

            wp_reset_query(); ?>

            </article>
         </div>
         <!-- /lead slot -->

         <!-- twitter slot -->
         <div class="flex-item twitter-slot">
            <div class="inner-wrap">
               <span class="kicker">Tweets</span>
               <h4>Friendly dispatches</h4>
               <a class="twitter-timeline" 
               href="https://twitter.com/FriendMadness" 
               data-width="100%" 
               data-widget-id="699703972844740608" 
               data-chrome="transparent nofooter"
               >Tweets by @FriendMadness</a>
            </div>
         </div>
         <!-- /twitter slot -->

      </section>
      <!-- /primary -->


      <!-- Articles section -->
      <section id="home-articles" class="flex-container">
         <?php 
         $posts = get_posts( array(
            'category_name' => 'News',
            'posts_per_page' => 3,
            'orderby' => 'date',
            'order' => 'DESC'
         ));

         if( $posts ):
            foreach( $posts as $post ):
               setup_postdata( $post ); 
               $img_url = wp_get_attachment_url( get_post_thumbnail_id() ); ?>

               <div class="flex-item sponsored-article-slot">
                  <article class="inner-wrap clearfix">
                     <div class="sponsored">
                        <span>Sponsored by</span>
                        <div class="league-logo <?php echo sponsored_logo( get_field('sponsor') ); ?>"></div>
                     </div>
                     <a href="<?php the_permalink(); ?>" class="link-item">
                        <figure class="bg-image visible-xs" 
                        style="background-image:url('<?php echo $img_url; ?>')"></figure>
                        <h2><?php the_title(); ?></h2>
                        <?php if ( $img_url ) : ?>
                           <figure class="slot-image hidden-xs">
                              <div class="aspect-ratio"></div>
                              <div class="img-wrap">
                                 <img src="<?php echo $img_url; ?>" alt="<?php the_title(); ?>" />
                              </div>
                           </figure>
                        <?php endif; ?>
                     </a>
                     <p><?php the_field('summary'); ?></p>
                  </article>
               </div>

            <?php endforeach; ?>

         <?php else: ?>

            <h1>No articles to post</h1>

         <?php endif; ?>
      </section>
      <!-- /articles -->


      <!-- Friends section -->
      <section id="home-friends" class="flex-container">
         <div class="flex-item friends-slot">
            <div class="inner-wrap">

            <?php 
            $posts = get_posts( array(
               'post_type' => 'friends',
               'posts_per_page' => -1,
               'meta_key' => 'seed',
               // 'orderby' => 'meta_value_num', // to order by seed
               'orderby' => 'rand',
               'order' => 'ASC'
            ));

            if( $posts ): ?>

               <span class="kicker">Meet the friends</span>
               <div class="carousel-container">
                  <div class="carousel-pane">
                     <div class="carousel-slider">

                     <?php foreach( $posts as $post ):

                        setup_postdata( $post );

                        $active = get_field('is_active');
                        
                        if ( $active ): 

                           ?>

                           <a href="<?php the_permalink(); ?>" class="carousel-item">
                              <div class="friend-wrapper <?php echo friend_inactive(); ?>">
                                 <?php if ( get_field('photo') ) : ?>
                                    <img src="<?php the_field('photo'); ?>" />
                                 <?php else : ?>
                                    <img src="<?php echo get_template_directory_uri(); ?>/img/gravatar.jpg ?>" />
                                 <?php endif; ?>
                                 <div class="friend-info">
                                    <span class="name">
                                       <span class="rank">
                                          (<?php echo get_the_tournament_seed(); ?>)
                                       </span>
                                       <?php the_title(); ?>
                                    </span>
                                    <span class="detail team <?php echo get_the_team_status('team_a'); ?>">
                                       <?php echo get_the_team('team_a'); ?>
                                    </span>
                                    <span class="detail team <?php echo get_the_team_status('team_b'); ?>">
                                       <?php echo get_the_team('team_b'); ?>
                                    </span>
                                 </div>
                              </div>
                           </a>

                        <?php endif; ?>

                     <?php endforeach; ?>

                     </div>
                  </div>
               </div>
            
            <?php else: ?>

               <h2>No friends to display</h2>

            <?php endif; ?>

            </div>
         </div>
      </section>
      <!-- /friends -->

      <?php get_footer(); ?>
