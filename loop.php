<?php if (have_posts()): while (have_posts()) : the_post(); ?>

   <!-- article -->
   <article id="post-<?php the_ID(); ?>" class="article">

      <?php if ( has_post_thumbnail() ): ?>
         <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
            <?php the_post_thumbnail(array(120,120)); // Declare pixel size you need inside the array ?>
         </a>
      <?php endif; ?>

      <h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>

      <div class="post-meta">
         <span class="hidden-xs">By <?php the_author(); ?></span>
         <span>Published on <?php the_time('F j, Y'); ?></span>
         <span><?php edit_post_link(); ?></span>
      </div>

      <?php html5wp_excerpt('html5wp_index'); // Build your custom callback length in functions.php ?>

   </article>

<?php endwhile; ?>

<?php else: ?>

   <h2><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h2>

<?php endif; ?>