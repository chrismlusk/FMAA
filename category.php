   <?php get_header(); ?>

   <main id="grid" role="main">

      <!-- section -->
      <section id="default" class="flex-container">
         <div class="flex-item primary-slot">
            <div class="inner-wrap">

               <h1><?php _e( 'Categories for ', 'html5blank' ); single_cat_title(); ?></h1>

               <?php get_template_part('loop'); ?> 

               <?php get_template_part('pagination'); ?>

            </div>
         </div>
         <div class="flex-item sidebar-slot">
            <?php get_sidebar(); ?>
         </div>
      </section>

      <?php get_footer(); ?>
