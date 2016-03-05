   <?php get_header(); ?>

   <main id="grid" role="main">

      <?php if (have_posts()): while (have_posts()) : the_post(); ?>

         <!-- section -->
         <section id="" class="flex-container">

            <div class="flex-item full-width-headline-slot">
               <div class="inner-wrap">

                  <!-- article header -->
                  <header class="article">
                     <div class="sponsored">
                        <span>Sponsored by</span>
                        <div class="league-logo <?php echo sponsored_logo( get_field('sponsor') ); ?>"></div>
                     </div>
                     <h1><?php the_title(); ?></h1>
                     <h3><?php the_field('subhead'); ?></h3>
                     <div class="post-meta">
                        <span class="hidden-xs">By <?php the_author(); ?></span>
                        <span>Published on <?php the_time('F j, Y'); ?></span>
                        <span class="hidden-xs"><?php echo reading_time(); ?> min read</span>
                        <span><?php edit_post_link(); ?></span>
                     </div>
                  </header>

               </div>
            </div>

         </section>

         <!-- post layout  -->
         <section id="post-layout" class="flex-container">

            <div class="flex-item primary-slot">
               <div class="inner-wrap">

                  <!-- article -->
                  <article id="post-<?php the_ID(); ?>" class="article">

                     <!-- post thumbnail -->
                     <?php if ( has_post_thumbnail() ):
                        $img_url = wp_get_attachment_url( get_post_thumbnail_id() ); ?>

                        <figure class="lead-image">
                           <img src="<?php echo $img_url; ?>" alt="<?php the_title(); ?>" />
                        </figure>

                     <?php endif; ?>
                     <!-- /post thumbnail -->

                     <?php the_content(); ?>

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
