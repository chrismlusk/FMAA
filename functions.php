<?php
/*
 *  Author: Todd Motto | @toddmotto
 *  URL: html5blank.com | @html5blank
 *  Custom functions, support, custom post types and more.
 */

/*------------------------------------*\
	External Modules/Files
\*------------------------------------*/

require_once('wp_bootstrap_navwalker.php');

/*------------------------------------*\
	Theme Support
\*------------------------------------*/

if (!isset($content_width))
{
    $content_width = 900;
}

if (function_exists('add_theme_support'))
{
    // Add Menu Support
    add_theme_support('menus');

    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');
    add_image_size('large', 700, '', true); // Large Thumbnail
    add_image_size('medium', 250, '', true); // Medium Thumbnail
    add_image_size('small', 120, '', true); // Small Thumbnail
    add_image_size('custom-size', 700, 200, true); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');

    // Enables post and comment RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Localisation Support
    load_theme_textdomain('html5blank', get_template_directory() . '/languages');
}

/*------------------------------------*\
	Functions
\*------------------------------------*/

// Override admin disabled input style
add_action('admin_head', 'override_disabled_input');
function override_disabled_input()
{
    echo '<style>
        input[type=checkbox].disabled, input[type=checkbox].disabled:checked:before, input[type=checkbox]:disabled, input[type=checkbox]:disabled:checked:before, input[type=radio].disabled, input[type=radio].disabled:checked:before, input[type=radio]:disabled, input[type=radio]:disabled:checked:before {
            opacity: .9;
        }
    </style>';
}

// Output bracket matchup (single game at a time)
function bracket_matchup( $region, $round, $top_seed=0, $btm_seed=0 )
{
    switch ( $round ) {
        case 'second':
            $rowspan = ' rowspan="2"';
            $round = 'second';
            break;
        case 'sweet-16':
            $rowspan = ' rowspan="4"';
            $round = 'sweet-16';
            break;
        case 'elite-8':
            $rowspan = ' rowspan="8"';
            $round = 'elite-8';
            break;
        case 'final-4':
            $rowspan = ' rowspan="8"';
            $round = 'final-4';
            $btm_seed = null;
            break;
        
        default:
            $rowspan = null;
            $round = 'first';
            break;
    }

    $status_1 = get_the_team_status( $region . '_' . $top_seed );
    $status_2 = get_the_team_status( $region . '_' . $btm_seed );

    $obj_1 = get_field( $region . '_' . $top_seed );
    $obj_2 = get_field( $region . '_' . $btm_seed );

    $team_round_1 = get_field('round', $obj_1->ID);
    $team_round_2 = get_field('round', $obj_2->ID);

    if ( $team_round_1 && !$status_1 ) {
        $style_1 = 'bold';
    }
    if ( $team_round_2 && !$status_2 ) {
        $style_2 = 'bold';
    }

    if ( $round == 'final-4' ) {
        // only output one team div
        echo '<td' . $rowspan . ' class="round ' . $round . '">';
            echo '<div class="matchup">';
                echo '<div class="team top">';
                    if ( $top_seed == 0 ) {
                        echo '<span class="inactive">TBD</span>';
                    }
                    else {
                        echo '<span class="rank">' . $top_seed . '</span>';
                        echo '<span class="name ' . $status_1 . ' ' . $style_1 . '">';
                            echo get_the_team_and_friend( $region . '_' . $top_seed );
                        echo '</span>';
                    }
                echo '</div>';
            echo '</div>';
        echo '</td>';
    }
    else {
        // output full matchup
        echo '<td' . $rowspan . ' class="round ' . $round . '">';
            echo '<div class="matchup">';
                echo '<div class="team top">';
                    if ( $top_seed == 0 ) {
                        echo '<span class="inactive">TBD</span>';
                    }
                    else {
                        echo '<span class="rank">' . $top_seed . '</span>';
                        echo '<span class="name ' . $status_1 . ' ' . $style_1 . '">';
                            echo get_the_team_and_friend( $region . '_' . $top_seed );
                        echo '</span>';
                    }
                echo '</div>';
                echo '<div class="team bottom">';
                    if ( $btm_seed == 0 ) {
                        echo '<span class="inactive">TBD</span>';
                    }
                    else {
                        echo '<span class="rank">' . $btm_seed . '</span>';
                        echo '<span class="name ' . $status_2 . ' ' . $style_2 . '">';
                            echo get_the_team_and_friend( $region . '_' . $btm_seed );
                        echo '</span>';
                    }
                echo '</div>';
            echo '</div>';
        echo '</td>';
    }
}

// Write lead paragraph for friend profile page
function write_friend_lead()
{
    $team_a = get_the_team('team_a');;
    $team_b = get_the_team('team_b');;
    $title_year = get_field('title_year');
    $mvp_year = get_field('mvp_year');
    $fmaa_history = get_field('fmaa_history');

    // begin paragraph with first name
    echo get_first_name() . ' is ';

    // put correct article before seed
    if ( get_the_tournament_seed() == 8 ) {
        echo 'an ';
    }
    else {
        echo 'a ';
    }

    // write seed, conference and teams
    echo get_the_tournament_seed() . '-seed from ' . the_friend_conference() . ' and is leading ' . $team_a . ' and ' . $team_b . ' in the tournament.';

    // check if friend has won title or MVP
    if ( get_field('title_history') || get_field('mvp_history') ) {
        echo ' This friend';

        if ( get_field('title_history') ) {
            echo ' won the FMAA title in ';

            // formatting for title count
            if ( count($title_year) > 1 ) {
                echo implode(' and ', $title_year);
            }
            else {
                echo $title_year[0];
            }

            // formatting for title and/or mvp
            if ( get_field('title_history') && get_field('mvp_history') ) {
                echo ' and ';
            }
            else {
                echo '.';
            }
        }

        if ( get_field('mvp_history') ) {
            echo 'was named MVP in ';

            // formatting for mvp count
            if ( count($mvp_year) > 1 ) {
                echo implode(' and ', $mvp_year);
            }
            else {
                echo $mvp_year[0];
            }

            echo '.';
        }
    }

    // count tournament appearances
    if ( $fmaa_history ) {
        echo ' ' . get_first_name() . ' is in the Friendship Madness field for the ' . convert_num_to_ordinal( $fmaa_history ) . ' time this year.';
    }
}

// Convert integers to ordinal numbers
function convert_num_to_ordinal( $input )
{
    $var = count($input);
    $ordinal_numbers = array(
        1 => 'first',
        2 => 'second',
        3 => 'third',
        4 => 'fourth',
        5 => 'fifth',
        6 => 'sixth',
        7 => 'seventh',
        8 => 'eighth',
        9 => 'ninth'
    );

    if ( $var == null ) {
        return '(Error! This value is empty.)';
    }
    elseif ( $var < 10 ) {
        foreach ( $ordinal_numbers as $key => $value ) {
            if ( $var == $key ) {
                $var_ordinal = $value;
                return $var_ordinal;
            }
        }
    }
    else {
        if ( !in_array(($var % 100), array(11,12,13)) ) {
            switch ( $var % 10 ) {
                // handle 1st, 2nd, 3rd
                case 1: return $var.'st';
                case 2: return $var.'nd';
                case 3: return $var.'rd';
            }
        }
        return $var.'th';
    }
}

// Display FMAA history in range
function fmaa_history_range()
{
    $history = get_field('fmaa_history');
    $first_year = $history[0];
    $last_year = end($history);

    if ( $first_year == $last_year ) {
        $years = $first_year;
    }
    elseif ( $last_year == $history[1] ) {
        $years = implode(', ', $history);
    }
    else {
        $years = $first_year . '-' . $last_year;
    }
    return $years;
}

// Format and output conference affilliation 
function the_friend_conference()
{
    $term = get_the_term_list( get_the_ID(), 'conference' );
    switch( true ) {
        case ( has_term('big-8', 'conference') ):
        case ( has_term('catholic-7', 'conference') ):
        case ( has_term('norman', 'conference') ):
        case ( has_term('pack-10', 'conference') ):
            $conference = 'the ' . $term . ' Conference';
            break;
        case ( has_term('cma', 'conference') ):
        case ( has_term('okc', 'conference') ):
            $conference = 'the ' . $term;
            break;
        case ( has_term('the-daily', 'conference') ):
            $conference = $term . ' Conference';
            break;
        case ( has_term('the-urb', 'conference') ):
            $conference = $term . ' League';
            break;
        default:
            $conference = $term;
            break;
    }
    // strip tags so not returned as a link
    return strip_tags($conference);
}

// Removes quick edit from Friends post type
function remove_quick_edit ( $actions )
{
    global $post;
    if ( $post->post_type == 'friends' ) {
        unset( $actions['inline hide-if-no-js'] );
    }
    return $actions;
}

// Replace conference taxonomy checkboxes with radio buttons
function wpse_139269_term_radio_checklist( $args ) {
    if ( ! empty( $args['taxonomy'] ) && $args['taxonomy'] === 'conference' ) {
        if ( empty( $args['walker'] ) || is_a( $args['walker'], 'Walker' ) ) { // Don't override 3rd party walkers
            if ( ! class_exists( 'WPSE_139269_Walker_Category_Radio_Checklist' ) ) {
                /**
                 * Custom walker for switching checkbox inputs to radio.
                 *
                 * @see Walker_Category_Checklist
                 */
                class WPSE_139269_Walker_Category_Radio_Checklist extends Walker_Category_Checklist {
                    function walk( $elements, $max_depth, $args = array() ) {
                        $output = parent::walk( $elements, $max_depth, $args );
                        $output = str_replace(
                            array( 'type="checkbox"', "type='checkbox'" ),
                            array( 'type="radio"', "type='radio'" ),
                            $output
                        );
                        return $output;
                    }
                }
            }
            $args['walker'] = new WPSE_139269_Walker_Category_Radio_Checklist;
        }
    }
    return $args;
}

// Get friend's first name from Friends post type
function get_first_name()
{
    $first_name = preg_split( '/\s/', get_the_title() );
    return $first_name[0];
}

// Format the team and friend together
function get_the_team_and_friend( $var )
{
    $team = get_the_team_short_name( $var );
    $friend = get_the_friend ( $var );
    return $friend . ' (' . $team . ')';
}

// Get the name of the friend who is assigned to the team
function get_the_friend( $var )
{
    $var = get_field($var);
    $friend = get_field( 'friend', $var->ID );
    return get_the_title( $friend->ID );
}

// Get team's short name from Friend profile page
function get_the_team_short_name( $var )
{
    $var = get_field($var);
    $short_name = get_field('short_name', $var->ID );

    if ( $short_name ) {
        return $short_name;
    }
    else {
        return get_the_title( $var->ID );
    }
}

// Get team name from Friend profile page
function get_the_team( $var )
{
    $var = get_field($var);
    return get_the_title( $var->ID );
}

// Find out if team has advanced, and if so, to what round
function get_the_team_round( $var )
{
    $status = get_the_team_status($var);
    $obj = get_field($var);
    $round = get_field('round', $obj->ID);
    switch ( end($round) ) {
        case 'second':
            $round_name = 'Second Round';
            break;
        case 'sweet-16':
            $round_name = 'Sweet 16';
            break;
        case 'elite-8':
            $round_name = 'Elite 8';
            break;
        case 'final-4':
            $round_name = 'Friendly Four';
            break;
        case 'champ':
            $round_name = 'FMAA Championship';
            break;
        default:
            $round_name = 'First Round';
            break;
    }

    if ( $round && !$status ) {
        //echo 'Advanced to the ' . $round_name . '!';
    }
    elseif ( $status == 'knocked-out' ) {
        //echo 'Eliminated in the ' . $round_name . '.';
    }
    else {
        //echo 'Sorry, results have not been updated.';
    }

    return $round_name;
}

// Cross out friend's team if eliminated
function get_the_team_status( $var )
{
    $var = get_field($var);
    $status = get_field('is_eliminated', $var->ID);
    $class = null;
    if ( $status ) {
        $class = 'knocked-out';
    }
    return $class;
}

// Make friend inactive if eliminated is checked
function friend_inactive()
{
    $team_a = get_field('team_a');
    $team_b = get_field('team_b');
    $status_a = get_field('is_eliminated', $team_a->ID);
    $status_b = get_field('is_eliminated', $team_b->ID);
    if ( $status_a && $status_b ) {
        $class = 'inactive';
    }
    else {
        $class = null;
    }
    return $class;
}

// Get tournament seed
function get_the_tournament_seed()
{
    $seed = get_field('seed');
    if ( $seed > 28 ) {
        $bracket_seed = 8;
    }
    elseif ( $seed < 29 && $seed > 24 ) {
        $bracket_seed = 7;
    }
    elseif ( $seed < 25 && $seed > 20 ) {
        $bracket_seed = 6;
    }
    elseif ( $seed < 21 && $seed > 16 ) {
        $bracket_seed = 5;
    }
    elseif ( $seed < 17 && $seed > 12 ) {
        $bracket_seed = 4;
    }
    elseif ( $seed < 13 && $seed > 8 ) {
        $bracket_seed = 3;
    }
    elseif ( $seed < 9 && $seed > 4 ) {
        $bracket_seed = 2;
    }
    else {
        $bracket_seed = 1;
    }
    return $bracket_seed;
}

// Link to Twitter username
function link_to_twitter_username(  )
{
    $twitter = get_field('twitter');
    $twitter_name = '@' . preg_replace('/^.*\/\s*/', '', $twitter);
    $twitter_link = $twitter;
    return '<a href="' . $twitter_link . '" target="_blank">' . $twitter_name . '</a>';
}

// Countdown to event
function event_countdown( $var )
{
    $remaining = strtotime($var) - time() + 18000;
    $days = floor($remaining / 86400);
    $hours = floor(($remaining % 86400) / 3600);

    // check if word should be singular
    if ( $days == 1 ) {
        $days = $days . ' day';
    }
    else {
        $days = $days . ' days';
    }
    if ( $hours == 1 ) {
        $hours = $hours . ' hour';
    }
    else {
        $hours = $hours . ' hours';
    }

    // don't print days or hours if 0
    if ( $days == 0 ) {
        $countdown = $hours . ' left';
    }
    elseif ( $hours == 0 ) {
        $countdown = $days . ' left';
    }
    else {
        $countdown = $days . ', ' . $hours . ' left';
    }
    return $countdown;
}

// Sponsored article logos
function sponsored_logo( $sponsored )
{
    $big8 = 'big-8';
    $catholic7 = 'catholic-7';
    $cma = 'cma';
    $the_daily = 'the-daily';
    $fmaa = 'fmaa';
    $norman = 'norman';
    $okc = 'okc';
    $pack_10 = 'pack-10';
    $the_urb = 'the-urb';

    if( $sponsored == $big8 ) {
        $logo = $big8 . ' compact';
    }
    elseif( $sponsored == $catholic7 ) {
        $logo = $catholic7;
    }
    elseif( $sponsored == $cma ) {
        $logo = $cma;
    }
    elseif( $sponsored == $the_daily ) {
        $logo = $the_daily . ' compact';
    }
    elseif( $sponsored == $norman ) {
        $logo = $norman;
    }
    elseif( $sponsored == $okc ) {
        $logo = $okc . ' compact';
    }
    elseif( $sponsored == $pack_10 ) {
        $logo = $pack_10 . ' compact';
    }
    elseif( $sponsored == $the_urb ) {
        $logo = $the_urb . ' compact';
    }
    else {
        $logo = $fmaa . ' compact';
    }
    
    return $logo;
}

// Get Reading Time
function reading_time() 
{
    $content = get_post_field( 'post_content', $post->ID );
    $word_count = str_word_count( strip_tags( $content ) );
    return round($word_count / 225);
}

// HTML5 Blank navigation
function html5blank_nav()
{
    wp_nav_menu(
    array(
        'theme_location'  => 'header-menu',
        'menu'            => '',
        'container'       => '',
        'container_class' => '',
        'container_id'    => '',
        'fallback_cb'     => 'wp_bootstrap_navwalker::fallback',
        'menu_class'      => 'nav navbar-nav',
        'menu_id'         => '',
        'echo'            => true,
        'before'          => '',
        'after'           => '',
        'link_before'     => '',
        'link_after'      => '',
        'items_wrap'      => '<ul class="%2$s">%3$s</ul>',
        'depth'           => 2,
        'walker'          => new wp_bootstrap_navwalker()
        )
    );
}

// Load HTML5 Blank scripts (header.php)
function html5blank_header_scripts()
{
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {

    	wp_register_script('conditionizr', get_template_directory_uri() . '/js/lib/conditionizr-4.3.0.min.js', array(), '4.3.0'); // Conditionizr
        wp_enqueue_script('conditionizr'); // Enqueue it!

        wp_register_script('modernizr', get_template_directory_uri() . '/js/lib/modernizr-2.7.1.min.js', array(), '2.7.1'); // Modernizr
        wp_enqueue_script('modernizr'); // Enqueue it!

        wp_register_script('bootstrapjs', get_template_directory_uri() . '/js/lib/bootstrap.min.js', array(), '3.3.5', true); // bootstrap.js
        wp_enqueue_script('bootstrapjs'); // Enqueue it!

        wp_register_script('html5blankscripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '1.0.0'); // Custom scripts
        wp_enqueue_script('html5blankscripts'); // Enqueue it!

        wp_register_script('mainscripts', get_template_directory_uri() . '/js/main.js', array('jquery'), '1.0.0', true); // Custom scripts
        wp_enqueue_script('mainscripts'); // Enqueue it!
    }
}

// Load HTML5 Blank conditional scripts
function html5blank_conditional_scripts()
{
    if (is_page('pagenamehere')) {
        wp_register_script('scriptname', get_template_directory_uri() . '/js/scriptname.js', array('jquery'), '1.0.0'); // Conditional script(s)
        wp_enqueue_script('scriptname'); // Enqueue it!
    }
}

// Load HTML5 Blank styles
function html5blank_styles()
{
    wp_register_style('normalize', get_template_directory_uri() . '/normalize.css');
    wp_enqueue_style('normalize'); // Enqueue it!

    wp_register_style('bootstrapcss', get_template_directory_uri() . '/css/bootstrap.min.css'); // bootstrap.min.css
    wp_enqueue_style('bootstrapcss'); // Enqueue it!

    wp_register_style('fmaa', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('fmaa'); // Enqueue it!
}

// Register HTML5 Blank Navigation
function register_html5_menu()
{
    register_nav_menus(array( // Using array to specify more menus if needed
        'header-menu' => __('Header Menu', 'html5blank'), // Main Navigation
        'sidebar-menu' => __('Sidebar Menu', 'html5blank'), // Sidebar Navigation
        'extra-menu' => __('Extra Menu', 'html5blank') // Extra Navigation
    ));
}

// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args($args = '')
{
    $args['container'] = false;
    return $args;
}

// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function my_css_attributes_filter($var)
{
    return is_array($var) ? array() : '';
}

// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list($thelist)
{
    return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}

// Add page slug to body class, love this - Credit: Starkers Wordpress Theme
function add_slug_to_body_class($classes)
{
    global $post;
    if (is_home()) {
        $key = array_search('blog', $classes);
        if ($key > -1) {
            unset($classes[$key]);
        }
    } elseif (is_page()) {
        $classes[] = sanitize_html_class($post->post_name);
    } elseif (is_singular()) {
        $classes[] = sanitize_html_class($post->post_name);
    }

    return $classes;
}

// If Dynamic Sidebar Exists
if (function_exists('register_sidebar'))
{
    // Define Sidebar Widget Area 1
    register_sidebar(array(
        'name' => __('Widget Area 1', 'html5blank'),
        'description' => __('Description for this widget-area...', 'html5blank'),
        'id' => 'widget-area-1',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));

    // Define Sidebar Widget Area 2
    register_sidebar(array(
        'name' => __('Widget Area 2', 'html5blank'),
        'description' => __('Description for this widget-area...', 'html5blank'),
        'id' => 'widget-area-2',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
}

// Remove wp_head() injected Recent Comment styles
function my_remove_recent_comments_style()
{
    global $wp_widget_factory;
    remove_action('wp_head', array(
        $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
        'recent_comments_style'
    ));
}

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function html5wp_pagination()
{
    global $wp_query;
    $big = 999999999;
    echo paginate_links(array(
        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages
    ));
}

// Custom Excerpts
function html5wp_index($length) // Create 20 Word Callback for Index page Excerpts, call using html5wp_excerpt('html5wp_index');
{
    return 20;
}

// Create 40 Word Callback for Custom Post Excerpts, call using html5wp_excerpt('html5wp_custom_post');
function html5wp_custom_post($length)
{
    return 40;
}

// Create the Custom Excerpts callback
function html5wp_excerpt($length_callback = '', $more_callback = '')
{
    global $post;
    if (function_exists($length_callback)) {
        add_filter('excerpt_length', $length_callback);
    }
    if (function_exists($more_callback)) {
        add_filter('excerpt_more', $more_callback);
    }
    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    $output = '<p>' . $output . '</p>';
    echo $output;
}

// Custom View Article link to Post
function html5_blank_view_article($more)
{
    global $post;
    return '...';
}

// Remove Admin bar
function remove_admin_bar()
{
    return false;
}

// Remove 'text/css' from our enqueued stylesheet
function html5_style_remove($tag)
{
    return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}

// Remove thumbnail width & height that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions( $html )
{
    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    return $html;
}

// Custom Gravatar in Settings > Discussion
function html5blankgravatar ($avatar_defaults)
{
    $myavatar = get_template_directory_uri() . '/img/gravatar.jpg';
    $avatar_defaults[$myavatar] = "Custom Gravatar";
    return $avatar_defaults;
}

// Threaded Comments
function enable_threaded_comments()
{
    if (!is_admin()) {
        if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
            wp_enqueue_script('comment-reply');
        }
    }
}

// Custom Comments Callback
function html5blankcomments($comment, $args, $depth)
{
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);

	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
    ?>
    <!-- heads up: starting < for the html tag (li or div) in the next line: -->
    <<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
	<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php endif; ?>
	<div class="comment-author vcard">
	<?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, $args['180'] ); ?>
	<?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
	</div>
    <?php if ($comment->comment_approved == '0') : ?>
	<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.') ?></em>
	<br />
    <?php endif; ?>

	<div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
		<?php
			printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','' );
		?>
	</div>

	<?php comment_text() ?>

	<div class="reply">
	<?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
	</div>
	<?php if ( 'div' != $args['style'] ) : ?>
	</div>
	<?php endif; ?>
    <?php 
}

/*------------------------------------*\
    Custom Post Types and Admin Columns
\*------------------------------------*/

/* TEAMS -----------------------------*/

// Create Teams custom post type
function team_post_type()
{
    $labels = array(
        'name' => __('Teams', 'FMAA'),
        'singular_name' => __('Team', 'FMAA'),
        'add_new' => __('Add New', 'FMAA'),
        'add_new_item' => __('Add New Team', 'FMAA'),
        'edit_item' => __('Edit Team', 'FMAA'),
        'new_item' => __('New Team', 'FMAA'),
        'all_items' => __('All Teams','FMAA'),
        'view_item' => __('View Team', 'FMAA'),
        'search_items' => __('Search Teams', 'FMAA'),
        'not_found' => __('No teams found', 'FMAA'),
        'not_found_in_trash' => __('No teams found in Trash', 'FMAA'),
        'menu_name' => __('Teams', 'FMAA'),
        'parent_item_colon' => '',
    );

    $supports = array(
        'title',
        //'editor',
        'page-attributes'
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => false,
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => 21,
        'menu_icon' => 'dashicons-plus-alt',
        'can_export' => true,
        'supports' => $supports,
    );

    register_post_type('teams', $args);
}

// Create new columns for 'Teams' admin table
add_filter('manage_teams_posts_columns', 'teams_table_head');
function teams_table_head( $defaults )
{
    unset($defaults['date']);
    $defaults['friend'] = 'Friend';
    $defaults['is_active'] = 'Active';
    $defaults['is_eliminated'] = 'Eliminated';
    return $defaults;
}

// Fill 'Teams' columns with content
add_action('manage_teams_posts_custom_column', 'teams_table_content', 10, 2);
function teams_table_content( $column_name, $post_id )
{
    $friend = get_field('friend');
    $active = get_field('is_active');
    $eliminated = get_field('is_eliminated');

    if ( $column_name == 'friend' ) {
        if ( $friend ) {
            echo get_the_title( $friend->ID );
        }
        else {
            echo '<span style="color:#aaa;">(none)</span>';
        }
    }
    if ( $column_name == 'is_active' ) {
        if ( $active == 1 ) {
            echo '<input type="checkbox" checked disabled>';
            echo ' Yes';
        }
        else {
            echo '<input type="checkbox" disabled>';
            echo ' No';
        }
    }
    if ( $column_name == 'is_eliminated' ) {
        if ( $active == 1 ) {
            if ( $eliminated == 1 ) {
                echo '<input type="checkbox" checked disabled>';
                echo ' Yes';
            }
            else {
                echo '<input type="checkbox" disabled>';
                echo ' No';
            }
        }
        else {
            echo '<span style="color:#aaa;">(N/A)</span>';
        }
    }
}

// Make 'Teams' columns sortable
add_filter('manage_edit-teams_sortable_columns', 'teams_table_sorting');
function teams_table_sorting( $columns )
{
    $columns['friend'] = 'friend';
    $columns['is_active'] = 'is_active';
    $columns['is_eliminated'] = 'is_eliminated';
    return $columns;
}

// Modify 'Teams' query when 'friend' column is sorted
add_filter('request', 'teams_table_friend_column_orderby');
function teams_table_friend_column_orderby( $vars )
{
    if ( isset( $vars['orderby'] ) && 'friend' == $vars['orderby'] ) {
        $vars = array_merge( $vars, array(
            'meta_key' => 'friend',
            'orderby' => 'meta_value'
        ));
    }
    return $vars;
}

// Modify 'Teams' query when 'active' column is sorted
add_filter('request', 'teams_table_active_column_orderby');
function teams_table_active_column_orderby( $vars )
{
    if ( isset( $vars['orderby'] ) && 'is_active' == $vars['orderby'] ) {
        $vars = array_merge( $vars, array(
            'meta_key' => 'is_active',
            'orderby' => 'meta_value'
        ));
    }
    return $vars;
}

// Modify 'Teams' query when 'eliminated' column is sorted
add_filter('request', 'teams_table_eliminated_column_orderby');
function teams_table_eliminated_column_orderby( $vars )
{
    if ( isset( $vars['orderby'] ) && 'is_eliminated' == $vars['orderby'] ) {
        $vars = array_merge( $vars, array(
            'meta_key' => 'is_eliminated',
            'orderby' => 'meta_value'
        ));
    }
    return $vars;
}

/* FRIENDS ---------------------------*/

// Create 'Friends' custom post type
function friend_post_type()
{
    $labels = array(
        'name' => __('Friends', 'FMAA'),
        'singular_name' => __('Friend', 'FMAA'),
        'add_new' => __('Add New', 'FMAA'),
        'add_new_item' => __('Add New Friend', 'FMAA'),
        'edit_item' => __('Edit Friend', 'FMAA'),
        'new_item' => __('New Friend', 'FMAA'),
        'all_items' => __('All Friends','FMAA'),
        'view_item' => __('View Friend', 'FMAA'),
        'search_items' => __('Search Friends', 'FMAA'),
        'not_found' => __('No friends found', 'FMAA'),
        'not_found_in_trash' => __('No friends found in Trash', 'FMAA'),
        'menu_name' => 'Friends',
    );

    $supports = array(
        'title',
        'editor',
        'page-attributes'
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => 20,
        'menu_icon' => 'dashicons-id-alt',
        'can_export' => true,
        'supports' => $supports,
    );

    register_post_type('friends', $args);
}

// Create new columns for 'Friends' admin table
add_filter('manage_friends_posts_columns', 'friends_table_head');
function friends_table_head( $defaults )
{
    unset($defaults['date']);
    $defaults['is_active'] = 'Active';
    $defaults['seed'] = 'Overall Seed';
    $defaults['team_a'] = 'Team A';
    $defaults['team_b'] = 'Team B';
    return $defaults;
}

// Fill 'Friends' columns with content
add_action('manage_friends_posts_custom_column', 'friends_table_content', 10, 2);
function friends_table_content( $column_name, $post_id )
{
    $active = get_field('is_active');
    $seed = get_field('seed');
    $team_a = get_field('team_a');
    $team_b = get_field('team_b');

    if ( $column_name == 'is_active' ) {
        if ( $active == 1 ) {
            echo '<input type="checkbox" checked disabled>';
            echo ' Yes';
        }
        else {
            echo '<input type="checkbox" disabled>';
            echo ' No';
        }
    }
    if ( $column_name == 'seed' ) {
        if ( $active == 1 ) {
            echo $seed;
        }
        else {
            echo '<span style="color:#aaa;">(N/A)</span>';
        }
    }
    if ( $column_name == 'team_a' ) {
        if ( $team_a ) {
            echo get_the_title( $team_a->ID );
        }
        else {
            echo '<span style="color:#aaa;">(none)</span>';
        }
    }
    if ( $column_name == 'team_b' ) {
        if ( $team_b ) {
            echo get_the_title( $team_b->ID );
        }
        else {
            echo '<span style="color:#aaa;">(none)</span>';
        }
    }
}

// Make 'Friends' columns sortable
add_filter('manage_edit-friends_sortable_columns', 'friends_table_sorting');
function friends_table_sorting( $columns )
{
    $columns['is_active'] = 'is_active';
    $columns['seed'] = 'seed';
    $columns['team_a'] = 'team_a';
    $columns['team_b'] = 'team_b';
    return $columns;
}

// Modify 'Friends' query when 'active' column is sorted
add_filter('request', 'friends_table_active_column_orderby');
function friends_table_active_column_orderby( $vars )
{
    if ( isset( $vars['orderby'] ) && 'is_active' == $vars['orderby'] ) {
        $vars = array_merge( $vars, array(
            'meta_key' => 'is_active',
            'orderby' => 'meta_value'
        ));
    }
    return $vars;
}

// Modify 'Friends' query when 'seed' column is sorted
add_filter('request', 'friends_table_seed_column_orderby');
function friends_table_seed_column_orderby( $vars )
{
    if ( isset( $vars['orderby'] ) && 'seed' == $vars['orderby'] ) {
        $vars = array_merge( $vars, array(
            'meta_key' => 'seed',
            'orderby' => 'meta_value_num'
        ));
    }
    return $vars;
}

// Modify 'Friends' query when 'team a' column is sorted
add_filter('request', 'friends_table_team_a_column_orderby');
function friends_table_team_a_column_orderby( $vars )
{
    if ( isset( $vars['orderby'] ) && 'team_a' == $vars['orderby'] ) {
        $vars = array_merge( $vars, array(
            'meta_key' => 'team_a',
            'orderby' => 'meta_value'
        ));
    }
    return $vars;
}

// Modify 'Friends' query when 'team b' column is sorted
add_filter('request', 'friends_table_team_b_column_orderby');
function friends_table_team_b_column_orderby( $vars )
{
    if ( isset( $vars['orderby'] ) && 'team_b' == $vars['orderby'] ) {
        $vars = array_merge( $vars, array(
            'meta_key' => 'team_b',
            'orderby' => 'meta_value'
        ));
    }
    return $vars;
}

/* CONFERENCES -----------------------*/

// Create 'Conferences' taxonomy for 'Friends' post type
function conference_taxonomy()
{
    $labels = array(
        'name' => __('Conferences', 'FMAA'),
        'singular_name' => __('Conference', 'FMAA'),
        'search_items' => __('Search Conference', 'FMAA'),
        'all_items' => __('All Conferences', 'FMAA'),
        'parent_item' => __('', 'FMAA'),
        'parent_item_colon' => __('', 'FMAA'),
        'edit_item' => __('Edit Conference', 'FMAA'),
        'update_item' => __('Update Conference', 'FMAA'),
        'add_new_item' => __('Add New Conference', 'FMAA'),
        'new_item_name' => __('New Conference Name', 'FMAA'),
        'not_found' => __('No conferences found', 'FMAA'),
        'no_terms' => __('No conference', 'FMAA'),
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'show_ui' => true,
        'show_in_nav_menus' => true,
        'hierarchical' => true,
        'query_var' => true,
        'rewrite' => false,
    );

    register_taxonomy('conference', 'friends', $args);
}

// Disable 'months' filter for 'Teams' and 'Friends' post types
add_filter('disable_months_dropdown', 'teams_table_disable_months', 10, 2);
function teams_table_disable_months( $false, $post_type )
{
    $disable_months_dropdown = $false;
    
    $disable_post_types = array( 'teams', 'friends' );
    
    if( in_array( $post_type , $disable_post_types ) ) {
        
        $disable_months_dropdown = true;
        
    }
    
    return $disable_months_dropdown;
}

/*------------------------------------*\
	Actions + Filters + ShortCodes
\*------------------------------------*/

// Add Actions
add_action('init', 'html5blank_header_scripts'); // Add Custom Scripts to wp_head
add_action('wp_print_scripts', 'html5blank_conditional_scripts'); // Add Conditional Page Scripts
add_action('get_header', 'enable_threaded_comments'); // Enable Threaded Comments
add_action('wp_enqueue_scripts', 'html5blank_styles'); // Add Theme Stylesheet
add_action('init', 'register_html5_menu'); // Add HTML5 Blank Menu
add_action('init', 'team_post_type'); // Add Team Post Type
add_action('init', 'friend_post_type'); // Add Friend Post Type
add_action('init', 'conference_taxonomy', 0); // Add Conference taxonomy
add_action('widgets_init', 'my_remove_recent_comments_style'); // Remove inline Recent Comment Styles from wp_head()
add_action('init', 'html5wp_pagination'); // Add our HTML5 Pagination
if ( is_admin() ) {
    add_filter('post_row_actions', 'remove_quick_edit', 10, 2);
}

// Remove Actions
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'index_rel_link'); // Index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

// Add Filters
add_filter('avatar_defaults', 'html5blankgravatar'); // Custom Gravatar in Settings > Discussion
add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
// add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation
// add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected classes (Commented out by default)
// add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected ID (Commented out by default)
// add_filter('page_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> Page ID's (Commented out by default)
add_filter('the_category', 'remove_category_rel_from_category_list'); // Remove invalid rel attribute
add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter('the_excerpt', 'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
add_filter('excerpt_more', 'html5_blank_view_article'); // Add 'View Article' button instead of [...] for Excerpts
add_filter('show_admin_bar', 'remove_admin_bar'); // Remove Admin bar
add_filter('style_loader_tag', 'html5_style_remove'); // Remove 'text/css' from enqueued stylesheet
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to post images
add_filter( 'wp_terms_checklist_args', 'wpse_139269_term_radio_checklist' ); // Changes conference taxonomy checkboxes to radio buttons for Friends posts
// Remove Filters
remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether

// Shortcodes
add_shortcode('html5_shortcode_demo', 'html5_shortcode_demo'); // You can place [html5_shortcode_demo] in Pages, Posts now.
add_shortcode('html5_shortcode_demo_2', 'html5_shortcode_demo_2'); // Place [html5_shortcode_demo_2] in Pages, Posts now.

// Shortcodes above would be nested like this -
// [html5_shortcode_demo] [html5_shortcode_demo_2] Here's the page title! [/html5_shortcode_demo_2] [/html5_shortcode_demo]

/*------------------------------------*\
	ShortCode Functions
\*------------------------------------*/

// Shortcode Demo with Nested Capability
function html5_shortcode_demo($atts, $content = null)
{
    return '<div class="shortcode-demo">' . do_shortcode($content) . '</div>'; // do_shortcode allows for nested Shortcodes
}

// Shortcode Demo with simple <h2> tag
function html5_shortcode_demo_2($atts, $content = null) // Demo Heading H2 shortcode, allows for nesting within above element. Fully expandable.
{
    return '<h2>' . $content . '</h2>';
}

?>
