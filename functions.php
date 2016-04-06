<?php
/**
 * Author: Ole Fredrik Lie
 * URL: http://olefredrik.com
 *
 * FoundationPress functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

/** Various clean up functions */
require_once( 'library/cleanup.php' );

/** Required for Foundation to work properly */
require_once( 'library/foundation.php' );

/** Register all navigation menus */
require_once( 'library/navigation.php' );

/** Add menu walkers for top-bar and off-canvas */
require_once( 'library/menu-walkers.php' );

/** Create widget areas in sidebar and footer */
require_once( 'library/widget-areas.php' );

/** Return entry meta information for posts */
require_once( 'library/entry-meta.php' );

/** Enqueue scripts */
require_once( 'library/enqueue-scripts.php' );

/** Add theme support */
require_once( 'library/theme-support.php' );

/** Add Nav Options to Customer */
require_once( 'library/custom-nav.php' );

/** Change WP's sticky post class */
require_once( 'library/sticky-posts.php' );

/** If your site requires protocol relative url's for theme assets, uncomment the line below */
// require_once( 'library/protocol-relative-theme-assets.php' );


/** Our custom post types */
require_once( 'library/custom-post-types.php' );


function neorizons_mystyles() {
	wp_enqueue_style( 'neo_fix', get_stylesheet_uri() );
}
add_action('wp_enqueue_scripts', 'neorizons_mystyles');


// WP Customize
add_action( 'customize_register', 'neorizons_customize_register' );
function neorizons_customize_register($wp_customize) {
    $wp_customize->add_section('infos_pratiques', array(
        'title' => 'Onepage options',
        'description' => '',
        'priority' => 20
    ));
	$wp_customize->add_setting( 'img-front' );
	$wp_customize->add_setting( 'logo-front' );
	$wp_customize->add_control(
	    new WP_Customize_Image_Control(
	        $wp_customize,
	        'img-front',
	        array(
	            'label' => 'Image sur la page d\'accueil principale',
	            'section' => 'infos_pratiques',
	            
	        )
	    )
	);
	$wp_customize->add_control(
	    new WP_Customize_Image_Control(
	        $wp_customize,
	        'logo-front',
	        array(
	            'label' => 'Logo sur la page d\'accueil principale',
	            'section' => 'infos_pratiques',
	            
	        )
	    )
	);
}

// fallback function for main menu
function neorizons_get_default_menu() {
	
	$args = array(
					"child_of" => 14,
					"sort_column" => "menu_order",
					"exclude" => array(50),
				);
	$subpages = get_pages( $args );
	$output = "<ul class=\"dropdown menu show-for-medium\" data-dropdown-menu>";
	foreach ($subpages as $page) {
		$link = is_front_page() ? "#{$page->post_name}":"/#{$page->post_name}";
		$output .= "<li class=\"menu-item-{$page->ID}\"><a href=\"$link\">{$page->post_title}</a></li>";
	}
	$output .= "</ul>";
	echo $output;
}
// fallback function for mobile menu
function neorizons_get_mobile_menu() {
	$args = array(
					"child_of" => 14,
					"sort_column" => "menu_order",
				);
	$subpages = get_pages( $args );
	$output = "<ul class=\"vertical nested menu show-for-medium-down\" data-accordion-menu>";
	foreach ($subpages as $page) {
		$output .= "<li class=\"menu-item-{$page->ID}\"><a href=\"{$page->post_name}\">{$page->post_title}</a></li>";
	}
	$output .= "</ul>";
	echo $output;
}

// get subpage on home page
function neorizons_get_subpage($slug, $has_orbit=false, $bullets=false) {
	if ($slug) :
		
		// Orbit additionnal output 
		$orbit_enabled = $has_orbit ? "data-orbit":"";
		$oC = $has_orbit ? "orbit":"";
		$ocC = $has_orbit ? "orbit-container":"";
		$oC .= $bullets ? "-bullets":"";
		$oN = '<button class="orbit-previous"><span class="show-for-sr">Previous Slide</span>&#9664;&#xFE0E;</button><button class="orbit-next"><span class="show-for-sr">Next Slide</span>&#9654;&#xFE0E;</button>';
		
		if ( $subpage = get_page_by_path($slug) ) {
			$output = '';
			$content = do_shortcode(apply_filters('the_content', $subpage->post_content));
			$title = apply_filters('the_title', $subpage->post_title);
			$bgcolor = get_field('strip_bgcolor', $subpage->ID);
			$txtcolor = get_field('strip_txtcolor', $subpage->ID);
			$stylebg = $bgcolor ? "style=\"background-color:$bgcolor;\"" : null;
			$styletxt = $txtcolor ? "style=\"color:$txtcolor;\"" : null;
			
			$output .= "<section id=\"{$subpage->post_name}\" class=\"stripe\" data-magellan-target=\"{$subpage->post_name}\" $stylebg >";
				$output .= "<div class=\"subpage-content $oC\" role=\"region\" $orbit_enabled >";
					$output .= "<h2>$title</h2>";
					$output .= "<div class=\"row content $ocC\" $styletxt >";
					$output .= "$content";
					$output .= $has_orbit ? "$oN" : "";
					$output .= "</div>";
					if ($slug == 'accueil/nos-actualites')
						$output .= '<div class="row column "><p><a href="/actualites" class="button icon search"><i class="fa fa-search"></i>Toutes nos actualités</a></p></div>';
				$output .= "</div>";
			$output .= "</section>";
			
			
			do_action( 'foundationpress_page_before_entry_content' );
			print $output;
		}
	endif;
		
}

// CPT archives
function neorizons_get_cpt_archives($post_type=null, $orderby='menu_order', $limit=-1, $echo=false) {
	global $post, $cue, $tot, $items;
	
	$args = array(	'orderby'		=> 'date',
					'order'			=> 'ASC',
					'post_type'		=> $post_type,
					'numberposts'	=> $limit,
				);
	if (!$post_type) $args['order'] = 'DESC';
	$posts = get_posts($args);
	
	if ($posts) :
		// all post types
		$tot = count($posts);
		$items = array_map(create_function('$o', 'return $o->ID;'), $posts);
		$cue = 0;
		
		if ($post_type != 'intervention') : 
			ob_start();
			foreach ($posts as $post) {
				setup_postdata($post);
				$post_type ? get_template_part("parts/homearchive", $post_type) :  get_template_part("parts/homearchive", 'actualite');
				$cue ++;
			} 
			wp_reset_postdata(); 
			$output = ob_get_clean();
			if (!$echo) 
				return $output;
			else
				print $output;

		// only interventions
		else :
			$container_op = '<div class="home-cptarchive home-intervention toggle">';
			$container_cl = '</div>';
			$menu = '<ul class="menu expanded">';
			$content = '';
			foreach ($posts as $post) {
				setup_postdata($post);
				$menu .=	'<li><a data-open="subcontent-'.get_the_ID().'" rel="subcontent-'.get_the_ID().'"><i class="fa fa-'.get_field('icone').' fa-2x"></i> <span>'.get_the_title().'</span></a></li>';
				$content .=	'<div id="subcontent-'.get_the_ID().'" class="large reveal callout content-intervention" data-reveal data-close-on-click="true" data-animation-in="fade-in" data-animation-out="fade-out">';
				$content .= '<button class="close-button" data-close aria-label="Close modal" type="button"><span aria-hidden="true">&times;</span></button>';
				$content .=	'<i class="fa fa-'.get_field('icone').' fa-2x"></i> <h2>'.get_the_title().'</h2>';
				$content .=	get_the_content();
				$content .= neorizons_get_reveal_nav($cue, $tot, $items);
				$content .=	'</div>';
				$cue ++;	
			}
			$menu .= '</ul>';
			wp_reset_postdata(); 
			if (!$echo) 
				return $container_op.$menu.$content.$container_cl;
			else
				print $container_op.$menu.$content.$container_cl;
				
		
		endif;
	endif;
}
function neorizons_get_reveal_nav($cue, $tot, $items) {
	$prev = $cue == 0 ? $tot-1 : $cue -1;
	$next = $cue == $tot-1 ? 1 : $cue +1;

	$nav = '<nav class="cpt-nav clearfix">';
	$nav .= '<a data-open="subcontent-'.$items[$prev].'" rel="subcontent-'.$items[$prev].'" class="left"><i class="fa fa-icon fa-chevron-left"></i></a>';
	$nav .= '<a data-open="subcontent-'.$items[$next].'" rel="subcontent-'.$items[$next].'" class="right"><i class="fa fa-icon fa-chevron-right"></i></a>';
	$nav .= '</nav>';
	return $nav;
}

// Filters

/**
 * Filter the except length to 20 characters.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function neorizons_custom_excerpt_length( $length ) {
    return 20;
}
//add_filter( 'excerpt_length', 'neorizons_custom_excerpt_length', 999 );

// Shortcodes
add_shortcode( 'cptarchive', 'neorizons_cpt_archive' );
function neorizons_cpt_archive( $atts ) {
    $a = shortcode_atts( array(
        'post' => null,
        'order' => 'menu_order',
		'limit' => -1
    ), $atts );
	
    return neorizons_get_cpt_archives($a['post'], $a['order'], $a['limit']);
}

add_shortcode( 'bloc', 'neorizons_sc_bloc' );
function neorizons_sc_bloc ($atts, $content=null) {
	return '<div class="large-6 columns">' . $content . '</div>';
}

add_shortcode( 'clearbloc', 'neorizons_sc_clearbloc' );
function neorizons_sc_clearbloc ($atts, $content=null) {
	return '<div class="clearfix"></div>';
}

add_shortcode( 'chiffresAnim', 'neorizons_numbers' );
function neorizons_numbers($atts) {
	global $number_numbers;
	
	if (!isset($number_numbers)) $number_numbers = 1;
	else $number_numbers ++;
		$shapeId = "circle_$number_numbers";
	$numbers = shortcode_atts( array(
		'number' => 75,
		'color' => '#FCB03C',
		'strokeWidth' => 3,
		'trailWidth' => 4,
		'fill' => '#fff',
		'trailColor' => '#ccc',
		'label' => 'Hello world!',
		'icon' => 'fa-slideshare'
	), $atts, 'chiffresAnim' );
	
	ob_start();
	?>
	<div class="numbers-shape" id="<?php echo $shapeId ?>"><i class="fa <?php echo $numbers['icon'] ?> fa-3x"></i><div class="cue" style="background-color:<?php echo $numbers['color'] ?>;"><?php echo $numbers['number'] ?>%</div></div>
	<script language="javascript">
		jQuery(function($) {
		var <?php echo $shapeId ?> = new ProgressBar.Circle('#<?php echo $shapeId ?>', {
			color: '<?php echo $numbers['color'] ?>',
			strokeWidth: <?php echo $numbers['strokeWidth'] ?>,
			fill: '<?php echo $numbers['fill'] ?>',
			trailColor: '<?php echo $numbers['trailColor'] ?>',
			trailWidth: <?php echo $numbers['trailWidth'] ?>,
			text: {
				value: '<?php echo $numbers['label'] ?>'
			}
		});
		
		<?php echo $shapeId ?>.animate(0.<?php echo $numbers['number'] ?>,
		{
			duration: 2400
		},
		function() {
			//circle.animate(0);
		});
		});
	</script>
	<?php
	return ob_get_clean();
}
function your_function() {
    echo '<p>This is inserted at the bottom</p>';
}
//add_action( 'wp_footer', 'your_function', 30 );

// Utilities
function foundationpress_entry_meta() {
	echo '<i class="fa fa-file-text"></i> ';
	the_time('l j F Y');
}


function neorizons_excerpt($content) {
	
	$excerpt_length =8;
	$words = explode(' ', $content, $excerpt_length + 1);
	
    if(count($words) > $excerpt_length) :
        array_pop($words);
        $content = implode(' ', $words). "&hellip;";
    endif;
	$content = '<p>' . $content . '</p>';

    # Make sure to return the content
    return $content;
}

//add_action('wp_head', 'add_header_styles');
function add_header_styles() {
	if ( is_admin_bar_showing() ) {?>
		<style>
		.contain-to-grid{margin-top: 32px; } // or .top-bar
		@media screen and (max-width: 600px){ // or wherever the layout breaks
		.contain-to-grid{margin-top: 46px; } // again or .top-bar
		#wpadminbar {position: fixed !important; }
		}
		</style><?php
	}
}
?>