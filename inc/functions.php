<?php
/**
 * Twenty'em All
 *
 * @package			WordPress
 * @subpackage		Twenty'em All: Setup
 * @author			RogerTM
 * @license			license.txt
 * @link			https://twenty-em.themingisprose.com
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

}
add_action( 'wp_enqueue_scripts', 't_em_all_enqueue' );

/**
 * Google Fonts
 *
 * @since Twenty'em All 1.0
 */
function t_em_all_embed_google_fonts(){
	echo '<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Titillium+Web|Lato">';
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
?>
