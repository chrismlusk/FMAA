<?php 

/* Template Name: Homepage Template */ 

get_header(); ?>

<main id="grid" role="main">


   <!-- First section -->
   <section id="" class="flex-container">

      <!-- announcements slot -->
      <div class="flex-item announcements-slot">
         <div class="flex-container">

            <!-- up next -->
            <div class="flex-item nested one">
               <div class="inner-wrap">
               <?php

               query_posts(array(
                  'category_name' => 'Up Next'
               ));

               if( have_posts() ) :
                  the_post();

                  $date = strtotime(get_field('event_date'));
                  //date_default_timezone_set('America/Chicago');
                  $remaining = $date - time() + 18000;
                  $days_remaining = floor($remaining / 86400);
                  $hours_remaining = floor(($remaining % 86400) / 3600);

                  if( $days_remaining % 2 == 0 ) {
                     $days = $days_remaining . ' days';
                  }
                  else {
                     $days = $days_remaining . ' day';
                  }
                  if( $hours_remaining % 2 == 0 ) {
                     $hours = $hours_remaining . ' hours';
                  }
                  else {
                     $hours = $hours_remaining . ' hour';
                  }
                  
                  ?>
                  <span class="kicker"><?php the_title(); ?></span>
                  <h4><?php the_field('event_name'); ?></h4>
                  <p><?php the_content(); ?></p>
                  <ul class="icon-list">
                     <li class="time">
                     <?php

                     if( $days == 0 ): ?>
                        <strong><?php echo $hours; ?> left</strong>
                     <?php elseif( $hours == 0 ): ?>
                        <strong><?php echo $days; ?> left</strong>
                     <?php else: ?>
                        <strong><?php echo $days; ?>, <?php echo $hours; ?> left</strong>
                     <?php endif; ?>
                     </li>
                  </ul>

               <?php else: ?>
                  <span class="kicker">Up next</span>
                  <h4>No upcoming events</h4>
               <?php endif; ?>
                  
               </div>
            </div>

            <!-- reminders -->
            <div class="flex-item nested two">
               <div class="inner-wrap">
                  <span class="kicker">Don't forget</span>
                  <h4>The FMAA toolkit</h4>
                  <p>For the friendliest tourney experience, be sure to check out the following:</p>
                  <ul class="icon-list">
                     <li class="twitter">
                        We tweet at <a href="https://twitter.com/FriendMadness" target="_blank">@FriendMadness</a>, so follow and use the hashtag #FMAA16
                     </li>
                     <li class="trophy">
                        Fill out and submit an <a href="#" target="_blank">FMAA bracket</a> before the tournament tips off
                     </li>
                     <li class="plus">
                        Download our official <a href="#" target="_blank">Chrome extension</a> and make the web friendlier
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
            $img_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
            ?>

            <a href="<?php the_permalink(); ?>" class="lead-slot-link">
               <div class="bg-image featured" 
               style="background-image:url('<?php echo $img_url[0] ?>')"></div>
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
   <!-- /section -->


   <!-- Second section -->
   <section id="" class="flex-container">
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
            $img_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' ); ?>

            <div class="flex-item article-slot">
               <article class="inner-wrap clearfix">

                  <?php 

                  $sponsored = get_field('sponsor');

                  // set logos for sponsored banner
                  $big8 = 'big-8';
                  $catholic7 = 'catholic-7';
                  $cma = 'cma';
                  $the_daily = 'the-daily';
                  $fmaa = 'fmaa';
                  $norman = 'norman';
                  $okc = 'okc';
                  $pack_10 = 'pack-10';
                  $the_urb = 'the-urb';

                  if( $sponsored == $big8 ) {
                     $logo = $big8;
                  }
                  elseif( $sponsored == $catholic7 ) {
                     $logo = $catholic7;
                  }
                  elseif( $sponsored == $cma ) {
                     $logo = $cma;
                  }
                  elseif( $sponsored == $the_daily ) {
                     $logo = $the_daily;
                  }
                  elseif( $sponsored == $fmaa ) {
                     $logo = $fmaa;
                  }
                  elseif( $sponsored == $norman ) {
                     $logo = $norman;
                  }
                  elseif( $sponsored == $okc ) {
                     $logo = $okc;
                  }
                  elseif( $sponsored == $pack_10 ) {
                     $logo = $pack_10;
                  }
                  else {
                     $logo = $the_urb;
                  }

                  if( $sponsored ): 

                     ?>
                     <div class="sponsored">
                        <span>Sponsored by</span>
                        <div class="league-logo <?php echo $logo; ?>"></div>
                     </div>

                  <?php endif; ?>

                  <a href="<?php the_permalink(); ?>" class="link-item">
                     <div class="bg-image visible-xs" 
                     style="background-image:url('<?php echo $img_url[0] ?>')"></div>
                     <h2><?php the_title(); ?></h2>
                     <div class="slot-image hidden-xs">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/test.jpg" />
                     </div>
                  </a>
                  <p><?php the_field('summary'); ?></p>
               </article>
            </div>

         <?php endforeach; ?>

      <?php else: ?>

         <h1>No articles to post</h1>

      <?php endif; ?>

   </section>
   <!-- /section -->


   <!-- meet the friends -->
   <?php 
   $posts = get_posts( array(
      'post_type' => 'friends',
      'posts_per_page' => -1,
      // 'meta_key' => 'seed',
      // 'orderby' => 'meta_value_num', // use this to order by seed/ranking
      'orderby' => 'rand',
      'order' => 'ASC'
   ));

   if( $posts ): ?>

      <section id="" class="flex-container">
         <div class="flex-item friends-slot">
            <div class="inner-wrap">
               <span class="kicker">Meet the friends</span>
               <div class="carousel-container">
                  <div class="carousel-pane">
                     <div class="carousel-slider">

                     <?php foreach( $posts as $post ):

                     setup_postdata( $post ); ?>

                        <a href="<?php the_permalink(); ?>" class="carousel-item">
                           <img src="<?php the_field('photo'); ?>" />
                           <span class="name">
                              <span class="rank">
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
                                 (<?php echo $bracket_seed; ?>)
                              </span>
                              <?php the_title(); ?>
                           </span>
                           <span class="teams">
                           <?php the_field('team_a'); ?><br />
                           <?php the_field('team_b'); ?>
                           </span>
                        </a>

                     <?php endforeach; ?>

                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>

   <?php else: ?>

      <h2>No friends to display</h2>

   <?php endif; ?>
   <!-- /meet the friends -->

</main>

<?php get_footer(); ?>
