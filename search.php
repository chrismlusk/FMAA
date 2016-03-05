   <?php get_header(); ?>

   <main id="grid" role="main">

      <!-- section -->
      <section id="default" class="flex-container">
         <div class="flex-item primary-slot">
            <div class="inner-wrap">

               <div class="article no-btm-pad">
                  <h1><?php echo sprintf( __( '%s Search Results for ', 'html5blank' ), $wp_query->found_posts ); echo get_search_query(); ?></h1>
               </div>

               <?php get_template_part('loop'); ?> 

               <?php get_template_part('pagination'); ?>

            </div>
         </div>
         <div class="flex-item sidebar-slot">
            <?php get_sidebar(); ?>
         </div>
      </section>

      <?php get_footer(); ?>
