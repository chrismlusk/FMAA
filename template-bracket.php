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

               <!-- FRIENDLY FOUR BRACKET -->
               <article class="article hidden-xs" style="margin-bottom: 60px;">
                  <div class="bracket-wrap">
                  <table width="100%">
                     <tr>
                     <td>

                     <!-- 1. South vs. West matchup -->
                     <table class="table">
                        <tbody>
                           <tr><!-- ff-1 -->
                           <td class="round ff-1">
                              <div class="matchup">
                                 <div class="team top">
                                    <span class="rank">2</span><span class="name  " data-toggle="tooltip" data-placement="right" title="" data-original-title="Villanova">Katie Rutledge</span>
                                 </div>
                                 <div class="team bottom">
                                    <span class="rank">2</span><span class="name  " data-toggle="tooltip" data-placement="right" title="" data-original-title="Oklahoma">Max Calanni</span>
                                 </div>
                              </div>
                           </td>
                           </tr>
                        </tbody>
                     </table>

                     <!-- 2. South vs. West winner -->
                     <table class="table">
                        <tbody>
                           <tr><!-- ff-2 -->
                           <td class="round ff-2">
                              <div class="matchup">
                                 <div class="team top">
                                    <span class="inactive">TBD</span>
                                 </div>
                              </div>
                           </td>
                           </tr>
                        </tbody>
                     </table>

                     <!-- 3. Best Friend! -->
                     <table class="table">
                        <tbody>
                           <tr><!-- ff-3 -->
                           <td class="round ff-3">
                              <div class="matchup">
                                 <div class="team top">
                                    <!-- <span class="" data-toggle="tooltip" data-placement="right" title="" data-original-title="Oklahoma">Max Calanni</span> -->
                                    <span class="inactive">&nbsp;</span>
                                 </div>
                              </div>
                           </td>
                           </tr>
                        </tbody>
                     </table>

                     <!-- 4. East vs. Midwest winner -->
                     <table class="table">
                        <tbody>
                           <tr><!-- ff-4 -->
                           <td class="round ff-4">
                              <div class="matchup">
                                 <div class="team top">
                                    <span class="inactive">TBD</span>
                                 </div>
                              </div>
                           </td>
                           </tr>
                        </tbody>
                     </table>

                     <!-- 5. East vs. Midwest matchup -->
                     <table class="table">
                        <tbody>
                           <tr><!-- ff-5 -->
                           <td class="round ff-5">
                              <div class="matchup">
                                 <div class="team top">
                                    <span class="rank">1</span><span class="name  " data-toggle="tooltip" data-placement="right" title="" data-original-title="North Carolina">Chris Lusk</span>
                                 </div>
                                 <div class="team bottom">
                                    <span class="rank">10</span><span class="name  " data-toggle="tooltip" data-placement="right" title="" data-original-title="Syracuse">Keifer Truett</span>
                                 </div>
                              </div>
                           </td>
                           </tr>
                        </tbody>
                     </table>

                     </td>
                     </tr>
                  </table>
                  </div>
               </article>
               <!-- /friendly four bracket -->

               <!-- article -->
               <article class="article">

                  <?php if ( get_the_content() ) : ?>
                     <div class="hidden-xs" style="font-size:90%;">
                        <span class="fa fa-file-pdf-o" style="margin-right: 4px;"></span>
                        <?php echo get_the_content(); ?>
                        <br /><br />
                     </div>
                  <?php endif; ?>

                  <div class="bracket-wrap">
                  <table width="100%">
                     <tr>
                     <td>

                     <!-- FIRST ROUND TABLE -->
                     <?php $round = 'first'; ?>
                     <table id="first-round" class="table">
                        <thead>
                           <tr>
                              <th><span class="label">First Round</span></th>
                           </tr>
                        </thead>

                        <!-- 1. south region -->
                        <?php $region = 'south'; ?>
                        <tbody>
                           <tr class="region">
                              <td><?php echo $region; ?></td>
                           </tr>
                           <tr>
                              <?php 
                                 bracket_matchup( $region, $round, 1, 16 );
                              ?>
                           </tr>
                           <tr>
                              <?php 
                                 bracket_matchup( $region, $round, 8, 9 );
                              ?>
                           </tr>
                           <tr>
                              <?php 
                                 bracket_matchup( $region, $round, 5, 12 );
                              ?>
                           </tr>
                           <tr>
                              <?php 
                                 bracket_matchup( $region, $round, 4, 13 );
                              ?>
                           </tr>
                           <tr>
                              <?php 
                                 bracket_matchup( $region, $round, 6, 11 );
                              ?>
                           </tr>
                           <tr>
                              <?php 
                                 bracket_matchup( $region, $round, 3, 14 );
                              ?>
                           </tr>
                           <tr>
                              <?php 
                                 bracket_matchup( $region, $round, 7, 10 );
                              ?>
                           </tr>
                           <tr>
                              <?php 
                                 bracket_matchup( $region, $round, 2, 15 );
                              ?>
                           </tr>
                        </tbody>

                        <!-- 2. west region -->
                        <?php $region = 'west'; ?>
                        <tbody>
                           <tr class="region">
                              <td><?php echo $region; ?></td>
                           </tr>
                           <tr>
                              <?php 
                                 bracket_matchup( $region, $round, 1, 16 );
                              ?>
                           </tr>
                           <tr>
                              <?php 
                                 bracket_matchup( $region, $round, 8, 9 );
                              ?>
                           </tr>
                           <tr>
                              <?php 
                                 bracket_matchup( $region, $round, 5, 12 );
                              ?>
                           </tr>
                           <tr>
                              <?php 
                                 bracket_matchup( $region, $round, 4, 13 );
                              ?>
                           </tr>
                           <tr>
                              <?php 
                                 bracket_matchup( $region, $round, 6, 11 );
                              ?>
                           </tr>
                           <tr>
                              <?php 
                                 bracket_matchup( $region, $round, 3, 14 );
                              ?>
                           </tr>
                           <tr>
                              <?php 
                                 bracket_matchup( $region, $round, 7, 10 );
                              ?>
                           </tr>
                           <tr>
                              <?php 
                                 bracket_matchup( $region, $round, 2, 15 );
                              ?>
                           </tr>
                        </tbody>

                        <!-- 3. east region -->
                        <?php $region = 'east'; ?>
                        <tbody>
                           <tr class="region">
                              <td><?php echo $region; ?></td>
                           </tr>
                           <tr>
                              <?php 
                                 bracket_matchup( $region, $round, 1, 16 );
                              ?>
                           </tr>
                           <tr>
                              <?php 
                                 bracket_matchup( $region, $round, 8, 9 );
                              ?>
                           </tr>
                           <tr>
                              <?php 
                                 bracket_matchup( $region, $round, 5, 12 );
                              ?>
                           </tr>
                           <tr>
                              <?php 
                                 bracket_matchup( $region, $round, 4, 13 );
                              ?>
                           </tr>
                           <tr>
                              <?php 
                                 bracket_matchup( $region, $round, 6, 11 );
                              ?>
                           </tr>
                           <tr>
                              <?php 
                                 bracket_matchup( $region, $round, 3, 14 );
                              ?>
                           </tr>
                           <tr>
                              <?php 
                                 bracket_matchup( $region, $round, 7, 10 );
                              ?>
                           </tr>
                           <tr>
                              <?php 
                                 bracket_matchup( $region, $round, 2, 15 );
                              ?>
                           </tr>
                        </tbody>

                        <!-- 4. midwest region -->
                        <?php $region = 'midwest'; ?>
                        <tbody>
                           <tr class="region">
                              <td><?php echo $region; ?></td>
                           </tr>
                           <tr>
                              <?php 
                                 bracket_matchup( $region, $round, 1, 16 );
                              ?>
                           </tr>
                           <tr>
                              <?php 
                                 bracket_matchup( $region, $round, 8, 9 );
                              ?>
                           </tr>
                           <tr>
                              <?php 
                                 bracket_matchup( $region, $round, 5, 12 );
                              ?>
                           </tr>
                           <tr>
                              <?php 
                                 bracket_matchup( $region, $round, 4, 13 );
                              ?>
                           </tr>
                           <tr>
                              <?php 
                                 bracket_matchup( $region, $round, 6, 11 );
                              ?>
                           </tr>
                           <tr>
                              <?php 
                                 bracket_matchup( $region, $round, 3, 14 );
                              ?>
                           </tr>
                           <tr>
                              <?php 
                                 bracket_matchup( $region, $round, 7, 10 );
                              ?>
                           </tr>
                           <tr>
                              <?php 
                                 bracket_matchup( $region, $round, 2, 15 );
                              ?>
                           </tr>
                        </tbody>
                     </table>

                     <!-- SECOND ROUND TABLE -->
                     <?php $round = 'second'; ?>
                     <table id="second-round" class="table">
                        <thead>
                           <tr>
                              <th><span class="label">Second Round</span></th>
                           </tr>
                        </thead>

                        <!-- 1. south region -->
                        <?php $region = 'south'; ?>
                        <tbody>
                           <tr class="region">
                              <td><?php echo $region; ?></td>
                           </tr>
                           <tr><!-- 1/16 vs 8/9 -->
                              <?php                                  bracket_matchup( $region, $round, 1, 9 );
                              ?>
                           </tr>
                           <tr><!-- 5/12 vs 4/13 -->
                              <?php 
                                 bracket_matchup( $region, $round, 5, 13 );
                              ?>
                           </tr>
                           <tr><!-- 6/11 vs 3/14 -->
                              <?php 
                                 bracket_matchup( $region, $round, 11, 3 );
                              ?>
                           </tr>
                           <tr><!-- 7/10 vs 2/15 -->
                              <?php 
                                 bracket_matchup( $region, $round, 7, 2 );
                              ?>
                           </tr>
                        </tbody>

                        <!-- 2. west region -->
                        <?php $region = 'west'; ?>
                        <tbody>
                           <tr class="region">
                              <td><?php echo $region; ?></td>
                           </tr>
                           <tr><!-- 1/16 vs 8/9 -->
                              <?php 
                                 bracket_matchup( $region, $round, 1, 8 );
                              ?>
                           </tr>
                           <tr><!-- 5/12 vs 4/13 -->
                              <?php 
                                 bracket_matchup( $region, $round, 12, 4 );
                              ?>
                           </tr>
                           <tr><!-- 6/11 vs 3/14 -->
                              <?php 
                                 bracket_matchup( $region, $round, 11, 3 );
                              ?>
                           </tr>
                           <tr><!-- 7/10 vs 2/15 -->
                              <?php 
                                 bracket_matchup( $region, $round, 10, 2 );
                              ?>
                           </tr>
                        </tbody>

                        <!-- 3. east region -->
                        <?php $region = 'east'; ?>
                        <tbody>
                           <tr class="region">
                              <td><?php echo $region; ?></td>
                           </tr>
                           <tr><!-- 1/16 vs 8/9 -->
                              <?php 
                                 bracket_matchup( $region, $round, 1, 9 );
                              ?>
                           </tr>
                           <tr><!-- 5/12 vs 4/13 -->
                              <?php 
                                 bracket_matchup( $region, $round, 5, 4 );
                              ?>
                           </tr>
                           <tr><!-- 6/11 vs 3/14 -->
                              <?php 
                                 bracket_matchup( $region, $round, 6, 14 );
                              ?>
                           </tr>
                           <tr><!-- 7/10 vs 2/15 -->
                              <?php 
                                 bracket_matchup( $region, $round, 7, 2 );
                              ?>
                           </tr>
                        </tbody>

                        <!-- 4. midwest region -->
                        <?php $region = 'midwest'; ?>
                        <tbody>
                           <tr class="region">
                              <td><?php echo $region; ?></td>
                           </tr>
                           <tr><!-- 1/16 vs 8/9 -->
                              <?php 
                                 bracket_matchup( $region, $round, 1, 9 );
                              ?>
                           </tr>
                           <tr><!-- 5/12 vs 4/13 -->
                              <?php 
                                 bracket_matchup( $region, $round, 12, 4 );
                              ?>
                           </tr>
                           <tr><!-- 6/11 vs 3/14 -->
                              <?php 
                                 bracket_matchup( $region, $round, 11, 3 );
                              ?>
                           </tr>
                           <tr><!-- 7/10 vs 2/15 -->
                              <?php 
                                 bracket_matchup( $region, $round, 10, 15 );
                              ?>
                           </tr>
                        </tbody>
                     </table>

                     <!-- SWEET 16 TABLE -->
                     <?php $round = 'sweet-16'; ?>
                     <table id="sweet-16" class="table">
                        <thead>
                           <tr>
                              <th><span class="label">Sweet 16</span></th>
                           </tr>
                        </thead>

                        <!-- 1. south region -->
                        <?php $region = 'south'; ?>
                        <tbody>
                           <tr class="region">
                              <td><?php echo $region; ?></td>
                           </tr>
                           <tr><!-- 1/16/8/9 vs 5/12/4/13 -->
                              <?php 
                                 bracket_matchup( $region, $round, 1, 5 );
                              ?>
                           </tr>
                           <tr><!-- 6/11/3/14 vs 7/10/2/15 -->
                              <?php 
                                 bracket_matchup( $region, $round, 3, 2 );
                              ?>
                           </tr>
                        </tbody>

                        <!-- 2. west region -->
                        <?php $region = 'west'; ?>
                        <tbody>
                           <tr class="region">
                              <td><?php echo $region; ?></td>
                           </tr>
                           <tr><!-- 1/16/8/9 vs 5/12/4/13 -->
                              <?php 
                                 bracket_matchup( $region, $round, 1, 4 );
                              ?>
                           </tr>
                           <tr><!-- 6/11/3/14 vs 7/10/2/15 -->
                              <?php 
                                 bracket_matchup( $region, $round, 3, 2 );
                              ?>
                           </tr>
                        </tbody>

                        <!-- 3. east region -->
                        <?php $region = 'east'; ?>
                        <tbody>
                           <tr class="region">
                              <td><?php echo $region; ?></td>
                           </tr>
                           <tr><!-- 1/16/8/9 vs 5/12/4/13 -->
                              <?php 
                                 bracket_matchup( $region, $round, 1, 5 );
                              ?>
                           </tr>
                           <tr><!-- 6/11/3/14 vs 7/10/2/15 -->
                              <?php 
                                 bracket_matchup( $region, $round, 6, 7 );
                              ?>
                           </tr>
                        </tbody>

                        <!-- 4. midwest region -->
                        <?php $region = 'midwest'; ?>
                        <tbody>
                           <tr class="region">
                              <td><?php echo $region; ?></td>
                           </tr>
                           <tr><!-- 1/16/8/9 vs 5/12/4/13 -->
                              <?php 
                                 bracket_matchup( $region, $round, 1, 4 );
                              ?>
                           </tr>
                           <tr><!-- 6/11/3/14 vs 7/10/2/15 -->
                              <?php 
                                 bracket_matchup( $region, $round, 11, 10 );
                              ?>
                           </tr>
                        </tbody>
                     </table>

                     <!-- ELITE 8 TABLE -->
                     <?php $round = 'elite-8'; ?>
                     <table id="elite-8" class="table">
                        <thead>
                           <tr>
                              <th><span class="label">Elite 8</span></th>
                           </tr>
                        </thead>

                        <!-- 1. south region -->
                        <?php $region = 'south'; ?>
                        <tbody>
                           <tr class="region">
                              <td><?php echo $region; ?></td>
                           </tr>
                           <tr><!-- final two seeds -->
                              <?php 
                                 bracket_matchup( $region, $round, 1, 2 );
                              ?>
                           </tr>
                        </tbody>

                        <!-- 2. west region -->
                        <?php $region = 'west'; ?>
                        <tbody>
                           <tr class="region">
                              <td><?php echo $region; ?></td>
                           </tr>
                           <tr><!-- final two seeds -->
                              <?php 
                                 bracket_matchup( $region, $round, 1, 2 );
                              ?>
                           </tr>
                        </tbody>

                        <!-- 3. east region -->
                        <?php $region = 'east'; ?>
                        <tbody>
                           <tr class="region">
                              <td><?php echo $region; ?></td>
                           </tr>
                           <tr><!-- final two seeds -->
                              <?php 
                                 bracket_matchup( $region, $round, 1, 6 );
                              ?>
                           </tr>
                        </tbody>

                        <!-- 4. midwest region -->
                        <?php $region = 'midwest'; ?>
                        <tbody>
                           <tr class="region">
                              <td><?php echo $region; ?></td>
                           </tr>
                           <tr><!-- final two seeds -->
                              <?php 
                                 bracket_matchup( $region, $round, 1, 10 );
                              ?>
                           </tr>
                        </tbody>
                     </table>

                     <!-- FRIENDLY FOUR TABLE -->
                     <?php $round='final-4'; ?>
                     <table id="final-4" class="table">
                        <thead>
                           <tr>
                              <th><span class="label">Friendly Four</span></th>
                           </tr>
                        </thead>

                        <!-- 1. south region -->
                        <?php $region = 'south'; ?>
                        <tbody>
                           <tr class="region">
                              <td><?php echo $region; ?></td>
                           </tr>
                           <tr><!-- region winner -->
                              <?php 
                                 bracket_matchup( $region, $round, 2, 0 );
                              ?>
                           </tr>
                        </tbody>

                        <!-- 2. west region -->
                        <?php $region = 'west'; ?>
                        <tbody>
                           <tr class="region">
                              <td><?php echo $region; ?></td>
                           </tr>
                           <tr><!-- region winner -->
                              <?php 
                                 bracket_matchup( $region, $round, 2, 0 );
                              ?>
                           </tr>
                        </tbody>

                        <!-- 3. east region -->
                        <?php $region = 'east'; ?>
                        <tbody>
                           <tr class="region">
                              <td><?php echo $region; ?></td>
                           </tr>
                           <tr><!-- region winner -->
                              <?php 
                                 bracket_matchup( $region, $round, 1, 0 );
                              ?>
                           </tr>
                        </tbody>

                        <!-- 4. midwest region -->
                        <?php $region = 'midwest'; ?>
                        <tbody>
                           <tr class="region">
                              <td><?php echo $region; ?></td>
                           </tr>
                           <tr><!-- region winner -->
                              <?php 
                                 bracket_matchup( $region, $round, 10, 0 );
                              ?>
                           </tr>
                        </tbody>
                     </table>

                     </td>
                     </tr>
                  </table>
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