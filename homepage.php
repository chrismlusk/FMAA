<?php /* Template Name: Homepage Template */ get_header(); ?>

<main id="grid-home" role="main">

   <!-- First section -->
   <section id="" class="flex-container">

      <!-- announcements slot -->
      <div class="flex-item announcements-slot">
         <div class="flex-container">
            <div class="flex-item nested one">
               <div class="inner-wrap">
                  <span class="kicker">Up next</span>
                  <h4>Selection Monday</h4>
                  <p>The FMAA committee will announce which teams each friend will lead this year.</p>
                  <ul class="icon-list">
                     <li class="time">
                        <strong>34 days, 7 hours left</strong>
                     </li>
                  </ul>
               </div>
            </div>
            <div class="flex-item nested two">
               <div class="inner-wrap">
                  <span class="kicker">Don't forget</span>
                  <h4>The FMAA toolkit</h4>
                  <p>For the friendliest tourney experience, be sure to check out the following:</p>
                  <ul class="icon-list">
                     <li class="twitter">
                        We tweet at <a href="#" target="_blank">@FriendMadness</a>, so follow and use the hashtag #FMAA16
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
            <a href="#" class="lead-slot-link">
               <div class="bg-image featured" 
               style="background-image:url('<?php echo get_template_directory_uri(); ?>/img/test.jpg')"></div>
               <h1>Friendship favorites Lusk, Henry are on course for an epic friendly finale</h1>
               <button class="btn btn-default">
                  <span class="read-more">Read more <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span></span>
               </button>
            </a>
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
      <div class="flex-item article-slot">
         <article class="inner-wrap clearfix">
            <div class="sponsored">
               <span>Sponsored by</span>
               <div class="league-logo cma"></div>
            </div>
            <a href="#" class="link-item">
               <div class="bg-image visible-xs" 
               style="background-image:url('<?php echo get_template_directory_uri(); ?>/img/test.jpg')"></div>
               <h2>For one conference, giant expectations are the norm</h2>
               <div class="slot-image hidden-xs">
                  <img src="<?php echo get_template_directory_uri(); ?>/img/test.jpg" />
               </div>
            </a>
            <p>Does anybody really think multiple CMA teams won’t make deep runs into the 2016 tournament? (Not to mention one of them winning it all.) If so they’re betting against history, those dummies.</p>
         </article>
      </div>
      <div class="flex-item article-slot">
         <article class="inner-wrap clearfix">
            <div class="sponsored">
               <span>Sponsored by</span>
               <div class="league-logo daily"></div>
            </div>
            <a href="#" class="link-item">
               <div class="bg-image visible-xs" 
               style="background-image:url('<?php echo get_template_directory_uri(); ?>/img/test.jpg')"></div>
               <h2>For one conference, giant expectations are the norm</h2>
               <div class="slot-image hidden-xs">
                  <img src="<?php echo get_template_directory_uri(); ?>/img/test.jpg" />
               </div>
            </a>
            <p>Does anybody really think multiple CMA teams won’t make deep runs into the 2016 tournament? (Not to mention one of them winning it all.) If so they’re betting against history, those dummies.</p>
         </article>
      </div>
      <div class="flex-item article-slot">
         <article class="inner-wrap clearfix">
            <div class="sponsored">
               <span>Sponsored by</span>
               <div class="league-logo urb"></div>
            </div>
            <a href="#" class="link-item">
               <div class="bg-image visible-xs" 
               style="background-image:url('<?php echo get_template_directory_uri(); ?>/img/test.jpg')"></div>
               <h2>For one conference, giant expectations are the norm</h2>
               <div class="slot-image hidden-xs">
                  <img src="<?php echo get_template_directory_uri(); ?>/img/test.jpg" />
               </div>
            </a>
            <p>Does anybody really think multiple CMA teams won’t make deep runs into the 2016 tournament? (Not to mention one of them winning it all.) If so they’re betting against history, those dummies.</p>
         </article>
      </div>
   </section>
   <!-- /section -->

</main>

<?php get_footer(); ?>
