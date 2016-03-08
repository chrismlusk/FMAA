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

    // Add Support for Custom Backgrounds - Uncomment below if you're going to use
    /*add_theme_support('custom-background', array(
	'default-color' => 'FFF',
	'default-image' => get_template_directory_uri() . '/img/bg.jpg'
    ));*/

    // Add Support for Custom Header - Uncomment below if you're going to use
    /*add_theme_support('custom-header', array(
	'default-image'			=> get_template_directory_uri() . '/img/headers/default.jpg',
	'header-text'			=> false,
	'default-text-color'		=> '000',
	'width'				=> 1000,
	'height'			=> 198,
	'random-default'		=> false,
	'wp-head-callback'		=> $wphead_cb,
	'admin-head-callback'		=> $adminhead_cb,
	'admin-preview-callback'	=> $adminpreview_cb
    ));*/

    // Enables post and comment RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Localisation Support
    load_theme_textdomain('html5blank', get_template_directory() . '/languages');
}

/*------------------------------------*\
	Functions
\*------------------------------------*/

// Write lead paragraph for friend profile page
function write_friend_lead()
{
    $team_a = get_field('team_a');
    $team_b = get_field('team_b');
    $title_year = get_field('title_year');
    $mvp_year = get_field('mvp_year');
    $fmaa_history = get_field('fmaa_history');

    // begin paragraph with first name
    echo get_first_name() . ' is ';

    // put correct article before seed
    if ( tournament_seed() == 8 ) {
        echo 'an ';
    }
    else {
        echo 'a ';
    }

    // write seed, conference and teams
    echo tournament_seed() . '-seed from ' . the_friend_conference() . ' and is leading ' . $team_a . ' and ' . $team_b . ' in the tournament.';

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

// Check if friend's teams are eliminated
function check_team_status()
{
    return array(get_field('team_a_eliminated'), get_field('team_b_eliminated'));
}

// Cross out team if eliminated
function team_eliminated( $team )
{
    $team_status = check_team_status();
    $class = null;
    switch($team) {
        case 'team_a':
            if ( $team_status[0] ) {
                $class = 'knocked-out';
            }
            break;
        case 'team_b':
            if ( $team_status[1] ) {
                $class = 'knocked-out';
            }
            break;
    }
    return $class;
}

// Make friend inactive if eliminated is checked
function friend_inactive()
{
    $team_status = check_team_status();
    if ( $team_status[0] && $team_status[1] ) {
        $set_class = 'inactive';
    }
    else {
        $set_class = null;
    }
    return $set_class;
}

// Get tournament seed
function tournament_seed()
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
    wp_register_style('normalize', get_template_directory_uri() . '/normalize.css', array(), '1.0', 'all');
    wp_enqueue_style('normalize'); // Enqueue it!

    wp_register_style('bootstrapcss', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '1.0'); // bootstrap.min.css
    wp_enqueue_style('bootstrapcss'); // Enqueue it!

    wp_register_style('html5blank', get_template_directory_uri() . '/style.css', array(), '1.0', 'all');
    wp_enqueue_style('html5blank'); // Enqueue it!
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
	Actions + Filters + ShortCodes
\*------------------------------------*/

// Add Actions
add_action('init', 'html5blank_header_scripts'); // Add Custom Scripts to wp_head
add_action('wp_print_scripts', 'html5blank_conditional_scripts'); // Add Conditional Page Scripts
add_action('get_header', 'enable_threaded_comments'); // Enable Threaded Comments
add_action('wp_enqueue_scripts', 'html5blank_styles'); // Add Theme Stylesheet
add_action('init', 'register_html5_menu'); // Add HTML5 Blank Menu
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
	Custom Post Types
\*------------------------------------*/

// Create Friends custom post type
function friend_post_type()
{
    register_post_type('friends',
        array(
        'labels' => array(
            'name' => _x('Friends', 'friends'), // Rename these to suit
            'singular_name' => _x('Friend', 'friends'),
            'menu_name' => 'Friends',
            'add_new' => _x('Add New', 'friends'),
            'add_new_item' => __('Add New Friend', 'friends'),
            'edit_item' => __('Edit Friend', 'friends'),
            'new_item' => __('New Friend', 'friends'),
            'view_item' => __('View Friend', 'friends'),
            'search_items' => __('Search Friends', 'friends'),
            'not_found' => __('No Friends found', 'friends'),
            'not_found_in_trash' => __('No Friends found in Trash', 'friends'),
            'parent_item_colon' => ''
        ),
        'public' => true,
        'hierarchical' => false,
        'menu_position' => 20,
        'has_archive' => false,
        'rewrite' => array('slug' => 'friends'),
        'supports' => array(
            'title',
            'editor',
            'page-attributes'
        ),
        'can_export' => true,
        // 'taxonomies' => array(
        //     'post_tag',
        //     'category'
        // )
    ));
}

// Create 'conferences' taxonomy
function conference_taxonomy()
{
    register_taxonomy('conference', 'friends',
        array(
        'labels' => array(
            'name' => __('Conferences', 'conferences'),
            'singular_name' => __('Conference', 'conferences'),
            'search_items' => __('Search Conference', 'conferences'),
            'all_items' => __('All Conferences'),
            'parent_item' => __(''),
            'parent_item_colon' => __(''),
            'edit_item' => __('Edit Conference', 'conferences'),
            'update_item' => __('Update Conference', 'conferences'),
            'add_new_item' => __('Add New Conference', 'conferences'),
            'new_item_name' => __('New Conference Name')
        ),
        'public' => true,
        'show_ui' => true,
        'show_in_nav_menus' => true,
        'hierarchical' => true,
        'query_var' => true,
        'rewrite' => false
    ));
}

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
