   <?php get_header(); ?>

   <main id="grid" role="main">

      <!-- section -->
      <section id="post-layout" class="flex-container">
         <div class="flex-item primary-slot">
            <div class="inner-wrap">

               <?php if (have_posts()): while (have_posts()) : the_post(); ?>

                  <!-- article -->
                  <article id="post-<?php the_ID(); ?>" class="article">

                  <h1><?php the_title(); ?></h1>

                  <?php the_content(); ?>

                  <?php edit_post_link(); ?>

                  </article>

               <?php endwhile; ?>

               <?php else: ?>

                  <h2><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h2>

               <?php endif; ?>

            </div>
         </div>
         <div class="flex-item sidebar-slot">
            <?php get_sidebar(); ?>
         </div>
      </section>

      <?php get_footer(); ?>
