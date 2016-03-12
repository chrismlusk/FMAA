<?php 

/* Template Name: Bracket */ 

get_header();

$posts = get_posts( array(
   'post_type' => 'post',
   'category_name' => 'Bracket',
   'posts_per_page' => 1
)); ?>

   <main id="grid" role="main">

      <!-- section -->
      <section id="bracket" class="flex-container">
         <div class="flex-item">
            <div class="inner-wrap">

               <div class="article no-btm-pad">
                  <h1><?php _e( 'Bracket', 'html5blank' ); ?></h1>
               </div>

            <?php if (have_posts()): while (have_posts()) : the_post(); ?>

               <!-- article -->
               <article class="article">

                  <div class="">
                     <div class="bracket-wrap">
                        <table class="table">
                           <thead>
                              <tr>
                                 <th><span class="label">First Round</span></th>
                                 <th><span class="label">Second Round</span></th>
                                 <th><span class="label">Sweet 16</span></th>
                                 <th><span class="label">Elite 8</span></th>
                                 <th><span class="label">Friendly Four</span></th>
                              </tr>
                           </thead>
                           <!-- MIDWEST REGION -->
                           <tbody>
                              <?php $region = 'midwest'; ?>

                              <tr class="region">
                                 <td><?php echo $region; ?> Region</td>
                              </tr>

                              <tr>
                                 <!-- 1st round: 1 vs 16 -->
                                 <?php 
                                    $round = 'first';
                                    bracket_matchup( $region, $round, 1, 16 );
                                 ?>

                                 <!-- 2nd round: 1/16 vs 8/9 -->
                                 <?php 
                                    $round = 'second';
                                    bracket_matchup( $region, $round, 0, 0 );
                                 ?>

                                 <!-- sweet 16: 1/16/8/9 vs 5/12/4/13 -->
                                 <?php
                                    $round = 'sweet-16';
                                    bracket_matchup( $region, $round, 0, 0 );
                                 ?>

                                 <!-- elite 8: final two seeds -->
                                 <?php 
                                    $round = 'elite-8';
                                    bracket_matchup( $region, $round, 0, 0 );
                                 ?>

                                 <!-- final 4: region winner -->
                                 <?php 
                                    $round = 'final-4';
                                    bracket_matchup( $region, $round, 0 );
                                 ?>
                              </tr>
                              <tr>
                                 <!-- 1st round: 8 vs 9 -->
                                 <?php 
                                    $round = 'first';
                                    bracket_matchup( $region, $round, 8, 9 );
                                 ?>
                              </tr>
                              <tr>
                                 <!-- 1st round: 5 vs 12 -->
                                 <?php 
                                    $round = 'first';
                                    bracket_matchup( $region, $round, 5, 12 );
                                 ?>

                                 <!-- 2nd round: 4/13 vs 5/12 -->
                                 <?php 
                                    $round = 'second';
                                    bracket_matchup( $region, $round, 0, 0 );
                                 ?>
                              </tr>
                              <tr>
                                 <!-- 1st round: 4 vs 13 -->
                                 <?php 
                                    $round = 'first';
                                    bracket_matchup( $region, $round, 4, 13 );
                                 ?>
                              </tr>
                              <tr>
                                 <!-- 1st round: 6 vs 11 -->
                                 <?php 
                                    $round = 'first';
                                    bracket_matchup( $region, $round, 6, 11 );
                                 ?>

                                 <!-- 2nd round: 6/11 vs 3/14 -->
                                 <?php 
                                    $round = 'second';
                                    bracket_matchup( $region, $round, 0, 0 );
                                 ?>

                                 <!-- sweet 16: 6/11/3/14 vs 7/10/2/15 -->
                                 <?php 
                                    $round = 'sweet-16';
                                    bracket_matchup( $region, $round, 0, 0 );
                                 ?>
                              </tr>
                              <tr>
                                 <!-- 1st round: 3 vs 14 -->
                                 <?php 
                                    $round = 'first';
                                    bracket_matchup( $region, $round, 3, 14 );
                                 ?>
                              </tr>
                              <tr>
                                 <!-- 1st round: 7 vs 10 -->
                                 <?php 
                                    $round = 'first';
                                    bracket_matchup( $region, $round, 7, 10 );
                                 ?>

                                 <!-- 2nd round: 7/10 vs 2/15 -->
                                 <?php 
                                    $round = 'second';
                                    bracket_matchup( $region, $round, 0, 0 );
                                 ?>
                              </tr>

                              <tr>
                                 <!-- 1st round: 2 vs 15 -->
                                 <?php 
                                    $round = 'first';
                                    bracket_matchup( $region, $round, 2, 15 );
                                 ?>
                              </tr>
                           </tbody> <!-- /region -->

                           <!-- WEST REGION -->
                           <tbody>
                              <?php $region = 'west'; ?>

                              <tr class="region">
                                 <td><?php echo $region; ?> Region</td>
                              </tr>

                              <tr>
                                 <!-- 1st round: 1 vs 16 -->
                                 <?php 
                                    $round = 'first';
                                    bracket_matchup( $region, $round, 1, 16 );
                                 ?>

                                 <!-- 2nd round: 1/16 vs 8/9 -->
                                 <?php 
                                    $round = 'second';
                                    bracket_matchup( $region, $round, 0, 0 );
                                 ?>

                                 <!-- sweet 16: 1/16/8/9 vs 5/12/4/13 -->
                                 <?php
                                    $round = 'sweet-16';
                                    bracket_matchup( $region, $round, 0, 0 );
                                 ?>

                                 <!-- elite 8: final two seeds -->
                                 <?php 
                                    $round = 'elite-8';
                                    bracket_matchup( $region, $round, 0, 0 );
                                 ?>

                                 <!-- final 4: region winner -->
                                 <?php 
                                    $round = 'final-4';
                                    bracket_matchup( $region, $round, 0 );
                                 ?>
                              </tr>
                              <tr>
                                 <!-- 1st round: 8 vs 9 -->
                                 <?php 
                                    $round = 'first';
                                    bracket_matchup( $region, $round, 8, 9 );
                                 ?>
                              </tr>
                              <tr>
                                 <!-- 1st round: 5 vs 12 -->
                                 <?php 
                                    $round = 'first';
                                    bracket_matchup( $region, $round, 5, 12 );
                                 ?>

                                 <!-- 2nd round: 4/13 vs 5/12 -->
                                 <?php 
                                    $round = 'second';
                                    bracket_matchup( $region, $round, 0, 0 );
                                 ?>
                              </tr>
                              <tr>
                                 <!-- 1st round: 4 vs 13 -->
                                 <?php 
                                    $round = 'first';
                                    bracket_matchup( $region, $round, 4, 13 );
                                 ?>
                              </tr>
                              <tr>
                                 <!-- 1st round: 6 vs 11 -->
                                 <?php 
                                    $round = 'first';
                                    bracket_matchup( $region, $round, 6, 11 );
                                 ?>

                                 <!-- 2nd round: 6/11 vs 3/14 -->
                                 <?php 
                                    $round = 'second';
                                    bracket_matchup( $region, $round, 0, 0 );
                                 ?>

                                 <!-- sweet 16: 6/11/3/14 vs 7/10/2/15 -->
                                 <?php 
                                    $round = 'sweet-16';
                                    bracket_matchup( $region, $round, 0, 0 );
                                 ?>
                              </tr>
                              <tr>
                                 <!-- 1st round: 3 vs 14 -->
                                 <?php 
                                    $round = 'first';
                                    bracket_matchup( $region, $round, 3, 14 );
                                 ?>
                              </tr>
                              <tr>
                                 <!-- 1st round: 7 vs 10 -->
                                 <?php 
                                    $round = 'first';
                                    bracket_matchup( $region, $round, 7, 10 );
                                 ?>

                                 <!-- 2nd round: 7/10 vs 2/15 -->
                                 <?php 
                                    $round = 'second';
                                    bracket_matchup( $region, $round, 0, 0 );
                                 ?>
                              </tr>

                              <tr>
                                 <!-- 1st round: 2 vs 15 -->
                                 <?php 
                                    $round = 'first';
                                    bracket_matchup( $region, $round, 2, 15 );
                                 ?>
                              </tr>
                           </tbody> <!-- /region -->

                           <!-- SOUTH REGION -->
                           <tbody>
                              <?php $region = 'south'; ?>

                              <tr class="region">
                                 <td><?php echo $region; ?> Region</td>
                              </tr>

                              <tr>
                                 <!-- 1st round: 1 vs 16 -->
                                 <?php 
                                    $round = 'first';
                                    bracket_matchup( $region, $round, 1, 16 );
                                 ?>

                                 <!-- 2nd round: 1/16 vs 8/9 -->
                                 <?php 
                                    $round = 'second';
                                    bracket_matchup( $region, $round, 0, 0 );
                                 ?>

                                 <!-- sweet 16: 1/16/8/9 vs 5/12/4/13 -->
                                 <?php
                                    $round = 'sweet-16';
                                    bracket_matchup( $region, $round, 0, 0 );
                                 ?>

                                 <!-- elite 8: final two seeds -->
                                 <?php 
                                    $round = 'elite-8';
                                    bracket_matchup( $region, $round, 0, 0 );
                                 ?>

                                 <!-- final 4: region winner -->
                                 <?php 
                                    $round = 'final-4';
                                    bracket_matchup( $region, $round, 0 );
                                 ?>
                              </tr>
                              <tr>
                                 <!-- 1st round: 8 vs 9 -->
                                 <?php 
                                    $round = 'first';
                                    bracket_matchup( $region, $round, 8, 9 );
                                 ?>
                              </tr>
                              <tr>
                                 <!-- 1st round: 5 vs 12 -->
                                 <?php 
                                    $round = 'first';
                                    bracket_matchup( $region, $round, 5, 12 );
                                 ?>

                                 <!-- 2nd round: 4/13 vs 5/12 -->
                                 <?php 
                                    $round = 'second';
                                    bracket_matchup( $region, $round, 0, 0 );
                                 ?>
                              </tr>
                              <tr>
                                 <!-- 1st round: 4 vs 13 -->
                                 <?php 
                                    $round = 'first';
                                    bracket_matchup( $region, $round, 4, 13 );
                                 ?>
                              </tr>
                              <tr>
                                 <!-- 1st round: 6 vs 11 -->
                                 <?php 
                                    $round = 'first';
                                    bracket_matchup( $region, $round, 6, 11 );
                                 ?>

                                 <!-- 2nd round: 6/11 vs 3/14 -->
                                 <?php 
                                    $round = 'second';
                                    bracket_matchup( $region, $round, 0, 0 );
                                 ?>

                                 <!-- sweet 16: 6/11/3/14 vs 7/10/2/15 -->
                                 <?php 
                                    $round = 'sweet-16';
                                    bracket_matchup( $region, $round, 0, 0 );
                                 ?>
                              </tr>
                              <tr>
                                 <!-- 1st round: 3 vs 14 -->
                                 <?php 
                                    $round = 'first';
                                    bracket_matchup( $region, $round, 3, 14 );
                                 ?>
                              </tr>
                              <tr>
                                 <!-- 1st round: 7 vs 10 -->
                                 <?php 
                                    $round = 'first';
                                    bracket_matchup( $region, $round, 7, 10 );
                                 ?>

                                 <!-- 2nd round: 7/10 vs 2/15 -->
                                 <?php 
                                    $round = 'second';
                                    bracket_matchup( $region, $round, 0, 0 );
                                 ?>
                              </tr>

                              <tr>
                                 <!-- 1st round: 2 vs 15 -->
                                 <?php 
                                    $round = 'first';
                                    bracket_matchup( $region, $round, 2, 15 );
                                 ?>
                              </tr>
                           </tbody> <!-- /region -->

                           <!-- EAST REGION -->
                           <tbody>
                              <?php $region = 'east'; ?>

                              <tr class="region">
                                 <td><?php echo $region; ?> Region</td>
                              </tr>

                              <tr>
                                 <!-- 1st round: 1 vs 16 -->
                                 <?php 
                                    $round = 'first';
                                    bracket_matchup( $region, $round, 1, 16 );
                                 ?>

                                 <!-- 2nd round: 1/16 vs 8/9 -->
                                 <?php 
                                    $round = 'second';
                                    bracket_matchup( $region, $round, 0, 0 );
                                 ?>

                                 <!-- sweet 16: 1/16/8/9 vs 5/12/4/13 -->
                                 <?php
                                    $round = 'sweet-16';
                                    bracket_matchup( $region, $round, 0, 0 );
                                 ?>

                                 <!-- elite 8: final two seeds -->
                                 <?php 
                                    $round = 'elite-8';
                                    bracket_matchup( $region, $round, 0, 0 );
                                 ?>

                                 <!-- final 4: region winner -->
                                 <?php 
                                    $round = 'final-4';
                                    bracket_matchup( $region, $round, 0 );
                                 ?>
                              </tr>
                              <tr>
                                 <!-- 1st round: 8 vs 9 -->
                                 <?php 
                                    $round = 'first';
                                    bracket_matchup( $region, $round, 8, 9 );
                                 ?>
                              </tr>
                              <tr>
                                 <!-- 1st round: 5 vs 12 -->
                                 <?php 
                                    $round = 'first';
                                    bracket_matchup( $region, $round, 5, 12 );
                                 ?>

                                 <!-- 2nd round: 4/13 vs 5/12 -->
                                 <?php 
                                    $round = 'second';
                                    bracket_matchup( $region, $round, 0, 0 );
                                 ?>
                              </tr>
                              <tr>
                                 <!-- 1st round: 4 vs 13 -->
                                 <?php 
                                    $round = 'first';
                                    bracket_matchup( $region, $round, 4, 13 );
                                 ?>
                              </tr>
                              <tr>
                                 <!-- 1st round: 6 vs 11 -->
                                 <?php 
                                    $round = 'first';
                                    bracket_matchup( $region, $round, 6, 11 );
                                 ?>

                                 <!-- 2nd round: 6/11 vs 3/14 -->
                                 <?php 
                                    $round = 'second';
                                    bracket_matchup( $region, $round, 0, 0 );
                                 ?>

                                 <!-- sweet 16: 6/11/3/14 vs 7/10/2/15 -->
                                 <?php 
                                    $round = 'sweet-16';
                                    bracket_matchup( $region, $round, 0, 0 );
                                 ?>
                              </tr>
                              <tr>
                                 <!-- 1st round: 3 vs 14 -->
                                 <?php 
                                    $round = 'first';
                                    bracket_matchup( $region, $round, 3, 14 );
                                 ?>
                              </tr>
                              <tr>
                                 <!-- 1st round: 7 vs 10 -->
                                 <?php 
                                    $round = 'first';
                                    bracket_matchup( $region, $round, 7, 10 );
                                 ?>

                                 <!-- 2nd round: 7/10 vs 2/15 -->
                                 <?php 
                                    $round = 'second';
                                    bracket_matchup( $region, $round, 0, 0 );
                                 ?>
                              </tr>

                              <tr>
                                 <!-- 1st round: 2 vs 15 -->
                                 <?php 
                                    $round = 'first';
                                    bracket_matchup( $region, $round, 2, 15 );
                                 ?>
                              </tr>
                           </tbody> <!-- /region -->
                        </table>
                     </div>
                  </div>

               <br />

               <?php edit_post_link(); ?>

               </article>

            <?php endwhile; ?>

            <?php else: ?>

               <h2><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h2>

            <?php endif; ?>

            </div>
         </div>
      </section>

      <?php get_footer(); ?>
