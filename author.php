   <?php get_header(); ?>

   <main id="grid" role="main">

      <!-- section -->
      <section id="default" class="flex-container">
         <div class="flex-item primary-slot">
            <div class="inner-wrap">

      		<?php if (have_posts()): the_post(); ?>

      			<h1><?php _e( 'Author Archives for ', 'html5blank' ); echo get_the_author(); ?></h1>

      		<?php if ( get_the_author_meta('description')) : ?>

      		<?php echo get_avatar(get_the_author_meta('user_email')); ?>

      			<h2><?php _e( 'About ', 'html5blank' ); echo get_the_author() ; ?></h2>

      			<?php echo wpautop( get_the_author_meta('description') ); ?>

      		<?php endif; ?>

      		<?php rewind_posts(); while (have_posts()) : the_post(); ?>

      			<!-- article -->
      			<article id="post-<?php the_ID(); ?>" class="article">

      				<!-- post thumbnail -->
      				<?php if ( has_post_thumbnail() ): ?>
      					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
      						<?php the_post_thumbnail(array(120,120)); // Declare pixel size you need inside the array ?>
      					</a>
      				<?php endif; ?>
      				<!-- /post thumbnail -->

      				<!-- post title -->
      				<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
      				<!-- /Post title -->

      				<!-- post details -->
                  <div class="post-meta">
                     <span class="hidden-xs">By <?php the_author(); ?></span>
                     <span>Published on <?php the_time('F j, Y'); ?></span>
                     <span><?php edit_post_link(); ?></span>
                  </div>
      				<!-- /post details -->

      				<?php html5wp_excerpt('html5wp_index'); // Build your custom callback length in functions.php ?>

      			</article>
      			<!-- /article -->

      		<?php endwhile; ?>

      		<?php else: ?>

      			<!-- article -->
      			<article class="article">

      				<h2><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h2>

      			</article>
      			<!-- /article -->

      		<?php endif; ?>

      			<?php get_template_part('pagination'); ?>
               
            </div>
         </div>
		</section>
		<!-- /section -->
	</main>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
