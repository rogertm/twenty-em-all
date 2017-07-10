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

	wp_register_script( 'app-utils', t_em_all_get_js( 'app.utils' ), array( 'jquery' ), $t_em_theme_data['Version'], true );
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
?>
