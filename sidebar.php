<!-- sidebar -->
<aside class="flex-container" role="complementary">
   <div class="flex-item nested announcements-slot">
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
               <?php echo event_countdown(get_field('event_date')); ?>
            </ul>

         <?php else: ?>

            <span class="kicker">Up next</span>
            <h4>No upcoming events</h4>

         <?php endif; ?>

      </div>
   </div>
   <div class="flex-item nested twitter-slot">
      <div class="inner-wrap">
         <span class="kicker">Tweets</span>
         <h4>Friendly dispatches</h4>
         <a class="twitter-timeline" 
            href="https://twitter.com/FriendMadness" 
            data-width="100%" 
            data-widget-id="705587133126451201" 
            data-chrome="transparent nofooter"
            >Tweets by @FriendMadness</a>
      </div>
   </div>
   <div class="flex-item nested announcements-slot">
      <div class="inner-wrap">
         <span class="kicker">Tourney history</span>
         <h4>Best Friends</h4>
         <ul class="default-list">
            <li><strong>2011:</strong> Curtis Gambill</li>
            <li><strong>2012:</strong> Max Calanni</li>
            <li><strong>2013:</strong> Chris Lusk</li>
            <li><strong>2014:</strong> Shelby Lollis</li>
            <li><strong>2015:</strong> Chris Lusk</li>
         </ul>
         <h4>Social Media MVP</h4>
         <ul class="default-list">
            <li><strong>2013:</strong> Jake Lovett &amp; Chris Lusk</li>
            <li><strong>2014:</strong> Jeremiah Davis</li>
            <li><strong>2015:</strong> Jessie Opoien</li>
         </ul>
      </div>
   </div>
</aside>
<!-- /sidebar -->
