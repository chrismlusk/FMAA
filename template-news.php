<?php 

/* Template Name: News */ 

get_header();

$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
$args = array(
   'post_type' => 'post',
   'category_name' => 'News',
   'posts_per_page' => 5,
   'paged' => $paged
);
$the_query = new WP_Query( $args ); 

// pagination fix
$temp_query = $wp_query;
$wp_query = null;
$wp_query = $the_query;

?>

   <main id="grid" role="main">

      <!-- section -->
      <section id="default" class="flex-container">
         <div class="flex-item primary-slot">
            <div class="inner-wrap">

               <div class="article no-btm-pad">
                  <h1><?php _e( 'Recent stories', 'html5blank' ); ?></h1>
               </div>

               <?php if ( $the_query->have_posts() ) : ?>

                  <!-- the loop -->
                  <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

                     <article class="article list">
                        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="clearfix">

                           <h2><?php the_title(); ?></h2>

                           <?php if ( has_post_thumbnail() ): 
                              $img_url = wp_get_attachment_url( get_post_thumbnail_id() ); ?>
                              <figure class="list-img">
                                 <img src="<?php echo $img_url; ?>" />
                              </figure>
                           <?php endif; ?>

                           <div class="list-contents hidden-xs">
                              <?php html5wp_excerpt('html5wp_index'); ?>
                              <div class="sponsored">
                              <span>Brought to you by</span>
                                 <div class="league-logo <?php echo sponsored_logo( get_field('sponsor') ); ?>"></div>
                              </div>
                           </div>

                        </a>
                     </article>

                  <?php endwhile; ?>
                  <!-- end loop -->

               <?php else: ?>

                  <h2 class="article"><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h2>

               <?php endif; ?>

               <?php wp_reset_postdata(); ?>

               <!-- pagination -->
               <?php if ( $the_query->max_num_pages > 1 ) : ?>
                  <nav class="article" style="margin-top: 0;">
                     <ul class="pager">
                        <li class="previous"><?php
                     previous_posts_link( '<span aria-hidden="true">&larr;</span> Newer Stories' ); ?></li>
                        <li class="next"><?php next_posts_link( 'Older Stories <span aria-hidden="true">&rarr;</span>', $the_query->max_num_pages ); ?></li>
                     </ul>
                  </nav>
               <?php endif; ?>

               <?php
                  // reset main query object
                  $wp_query = null;
                  $wp_query = $temp_query; ?>

            </div>
         </div>
         <div class="flex-item sidebar-slot">
            <?php get_sidebar(); ?>
         </div>
      </section>

      <?php get_footer(); ?>
