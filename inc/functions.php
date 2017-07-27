<?php
/**
 * Twenty'em All
 *
 * @package			WordPress
 * @subpackage		Twenty'em All: Setup
 * @author			RogerTM
 * @license			license.txt
 * @link			https://themingisprose.com/twenty-em
 * @since 			Twenty'em All 1.0
 */

/**
 * Twenty'em All Setup
 *
 * @since Twenty'em All 1.0
 */
function t_em_all_setup(){
	// Make Twenty'em All available for translation.
	load_child_theme_textdomain( 't_em_all', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 't_em_all_setup' );

/**
 * Enqueue and register all css and js
 *
 * @since Twenty'em All 1.0
 */
function t_em_all_enqueue(){
	global $t_em_theme_data;

	wp_register_style( 'google-fonts', t_em_all_embed_google_fonts(), array(), $t_em_theme_data['Version'], 'all' );
	wp_enqueue_style( 'google-fonts' );

	$less_files = array( T_EM_CHILD_THEME_DIR_PATH . '/css/style-theme.less' => T_EM_CHILD_THEME_DIR_URL . '/css' );
	$options = array( 'compress' => true );
	wp_enqueue_style( 'child-style-less', t_em_lessphp_compiler( $less_files, $options ), '', $t_em_theme_data['Version'], 'all' );

	wp_register_style( 'icofont', t_em_all_get_css('icofont'), array(), $t_em_theme_data['Version'], $media = 'all' );
	wp_enqueue_style( 'icofont' );

	wp_register_script( 'jquery.scrollto', t_em_all_get_js( 'jquery.scrollto' ), array( 'jquery' ), $t_em_theme_data['Version'], true );
	wp_enqueue_script( 'jquery.scrollto' );

	wp_register_script( 'prettify', t_em_all_get_js( 'prettify' ), array( 'jquery' ), $t_em_theme_data['Version'], true );
	wp_enqueue_script( 'prettify' );

	wp_register_script( 'app-utils', t_em_all_get_js( 'app.utils' ), array( 'jquery' ), $t_em_theme_data['Version'], true );
	// l10n for app.utils.js
	$translation = array(
		'app_version'	=> T_EM_FRAMEWORK_VERSION,
	);
	wp_localize_script( 'app-utils', 't_em_all_l10n_app_utils', $translation );
	wp_enqueue_script( 'app-utils' );

}
add_action( 'wp_enqueue_scripts', 't_em_all_enqueue' );

/**
 * Google Fonts
 *
 * @since Twenty'em All 1.0
 */
function t_em_all_embed_google_fonts(){
	echo '<link href="https://fonts.googleapis.com/css?family=Lato|Roboto+Condensed" rel="stylesheet">';
}

/**
 * Get cups of coffee consumed as a fun facts :P
 * This function does not make any important stuff, just output some funny facts depending on the
 * amount of lines of codes, kilobytes and files in Twnety'em
 *
 * @since Twenty'em All 1.0
 */
function t_em_all_coffee(){
	global $t_em;
	$lines = $t_em['lines_of_code'];
	$kilos = $t_em['kilobytes'];
	$files = $t_em['files'];
	$coding = $t_em['hours_of_coding'];
	$start_date = new DateTime( $coding );
	$end_date = new DateTime( date( 'Y-m-d' ) );
	$interval = $start_date->diff( $end_date );

	$coffee = array(
		'cups' 	=> round( ( $lines + $kilos + $files + $interval->days ) / 10 ),
		'label'		=> __( 'Cups of Coffee', 't_em_all' ),
	);
	return $coffee;
}
add_action( 't_em_action_custom_front_page_before', 't_em_all_coffee' );

/**
 * Formating Twenty’em and Twenty&#8217;em into Twenty\'em
 * Clone of capital_P_dangit() WordPress function
 *
 * @since Twenty'em All 1.0
 */
function t_em_all_twenty_em_formating( $twenty_em ) {
	return str_replace( array( 'Twenty’em', 'Twenty&#8217;em', 'Twenty&#039;em' ), 'Twenty\'em', $twenty_em );
}
add_filter( 'the_content', 't_em_all_twenty_em_formating' );
add_filter( 'the_title', 't_em_all_twenty_em_formating' );
add_filter( 'wp_title', 't_em_all_twenty_em_formating' );
add_filter( 'the_excerpt', 't_em_all_twenty_em_formating' );
add_filter( 'comment_text', 't_em_all_twenty_em_formating' );

/**
 * Keep an eye on revisions 8)
 *
 * @since Twenty'em All 1.0
 */
function t_em_all_revisions_number( $num, $post ){
	return 1;
}
add_filter( 'wp_revisions_to_keep', 't_em_all_revisions_number', 10, 2 );

/**
 * Get the resume of every post
 * @param int $post_id 	Post ID
 * @param int $trim 	Amount of words to show. Default 55.
 * @param bool $echo 	Return the value or print it on screen. Default to 'true'
 * @return string 		The 'post_excerpt' field or the first $trim words of the 'post_content' fields
 * 						if 'post_excerpt' is empty
 *
 * @since Twenty'em All 1.0
 */
function t_em_all_get_post_resume( $post_id, $trim = 55, $echo = true ){
	$excerpt = get_post_field( 'post_excerpt', $post_id );
	$content = get_post_field( 'post_content', $post_id );

	$resume = ( ! empty( $excerpt ) ) ? $excerpt : wp_trim_words( $content, $trim );

	if ( $echo ) :
		echo do_shortcode ( $resume );
	else :
		return do_shortcode ( $resume );
	endif;
}

/**
 * Add default avatar
 *
 * @since Twenty'em All 1.0
 */
function t_em_all_default_avatar( $avatar_defaults ){
	$avatar = T_EM_CHILD_THEME_DIR_URL . '/images/twenty-em-avatar.png';
	$avatar_defaults[$avatar] = sprintf( __( '%s Avatar', 't_em_all' ), T_EM_FRAMEWORK_NAME );
	return $avatar_defaults;
}
add_filter( 'avatar_defaults', 't_em_all_default_avatar' );

/**
 * Make some redirects
 *
 * @since Twenty'em All 1.0
 */
function t_em_all_redirect(){
	global $post;
	if ( is_attachment() ) :
		$attachment_id = $post->ID;
		$parent_id = get_post_field( 'post_parent', $attachment_id );
		$go = ( $parent_id == 0 ) ? home_url() : get_permalink( $parent_id );
		$redirect = wp_safe_redirect( $go );
	endif;
}
add_action( 'template_redirect', 't_em_all_redirect' );


/**
 * Remove Jetpack Share buttons from default location
 *
 * @since Twenty'em All 1.0
 */
function t_em_all_remove_jp_sharing(){
	remove_filter( 'the_content', 'sharing_display', 19 );
	remove_filter( 'the_excerpt', 'sharing_display', 19 );
	if ( class_exists( 'Jetpack_likes' ) ) :
		remove_filter( 'the_content', array( Jetpack_likes::init(), 'post_likes' ), 30, 1 );
	endif;
}
add_action( 'loop_start', 't_em_all_remove_jp_sharing' );

/**
 * New location for Jetpack Share buttons
 *
 * @since Twenty'em ALl 1.0
 */
function t_em_all_jp_sharing(){
	global $post;
	$sharing = get_option( 'sharing-options' );
	$post_type = get_post_type( $post->ID );
	if ( ! in_array( $post_type, $sharing['global']['show'] ) )
		return;

	$text = sprintf( __( '<h4>Share: <small>%s</small></h4>', 't_em_all' ), $post->post_title );
	if ( function_exists( 'sharing_display' ) ) :
		sharing_display( $text, true );
	endif;

	if ( class_exists( 'Jetpack_Likes' ) ) :
		$custom_likes = new Jetpack_Likes;
		echo $custom_likes->post_likes( '' );
	endif;
}
add_action( 't_em_action_post_content_after', 't_em_all_jp_sharing' );
?>
