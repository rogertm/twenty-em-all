<?php
/**
 * Twenty'em All
 *
 * @package			WordPress
 * @subpackage		Twenty'em All: Admin
 * @author			RogerTM
 * @license			license.txt
 * @link			https://twenty-em.themingisprose.com
 * @since 			Twenty'em All 1.0
 */

/**
 * Remove unnecessary options
 */
add_filter( 't_em_admin_filter_header_options_no_header_image', '__return_false' );
add_filter( 't_em_admin_filter_header_options_header_image', '__return_false' );
add_filter( 't_em_admin_filter_header_options_slider', '__return_false' );
add_filter( 't_em_admin_filter_front_page_options_wp_front_page', '__return_false' );


/**
 * Enqueue styles and scripts
 */
function t_em_all_admin_enqueue(){
	$screen = get_current_screen();
	if ( $screen->id == 'toplevel_page_twenty-em-options' ):
		// Check the theme version right from the style sheet
		global $t_em_theme_data;
		wp_register_style( 'style-admin-t-em-all', T_EM_CHILD_THEME_DIR_URL.'/admin/css-js/admin-style.css', false, $t_em_theme_data['Version'], 'all' );
		wp_enqueue_style( 'style-admin-t-em-all' );
	endif;
}
add_action( 'admin_enqueue_scripts', 't_em_all_admin_enqueue' );

/**
 * Merge into default theme options
 * This function is attached to the "t_em_admin_filter_default_theme_options" filter hook
 * @return array 	Array of options
 *
 * @since Twenty'em All 1.0
 */
function t_em_all_default_theme_options( $default_theme_options ){
	$t_em_all_default_options = array(
		'neon_ad_headline'			=> '',
		'neon_ad_content'			=> '',
		'neon_ad_button_one_label'	=> '',
		'neon_ad_button_one_link'	=> '',
		'neon_ad_button_two_label'	=> '',
		'neon_ad_button_two_link'	=> '',
		'github_commits_headline'	=> '',
		'github_commits_rss'		=> '',
		'donate_ad_headline'		=> '',
		'donate_ad_content'			=> '',
		'donate_ad_button_label'	=> '',
		'donate_ad_button_link'		=> '',
		'lines_of_code'				=> '',
	);
	$ads = t_em_all_front_page_ads_features_options();
	foreach ( $ads as $ad => $value ) :
		$key = $value['data'];
		$t_em_all_default_options = array_merge( $t_em_all_default_options, $key );
	endforeach;

	$default_options = array_merge( $default_theme_options, $t_em_all_default_options );

	return $default_options;
}
add_filter( 't_em_admin_filter_default_theme_options', 't_em_all_default_theme_options' );

/**
 * Sanitize and validate the input.
 * This function is attached to the "t_em_admin_filter_theme_options_validate" filter hook
 * @param $input array  Array of options to validate
 * @return array
 *
 * @since Twenty'em All 1.0
 */
function t_em_all_theme_options_validate( $input ){
	if ( ! $input )
		return;

	global $t_em;

	// Text inputs
	foreach ( array(
		'neon_ad_headline',
		'neon_ad_content',
		'neon_ad_button_one_label',
		'neon_ad_button_two_label',
		'github_commits_headline',
		'donate_ad_headline',
		'donate_ad_content',
		'donate_ad_button_label',
		'lines_of_code',
	) as $text_field ) :
		$input[$text_field] = ( isset( $input[$text_field] ) ) ? trim( $input[$text_field] ) : '';
	endforeach;
	$ads_fields = array();
	$ads = t_em_all_front_page_ads_features_options();
	foreach ( $ads as $ad => $value ) :
		$key = $value['data'];
		$ads_fields = array_merge( $ads_fields, $key );
	endforeach;
	$ads_fields = array_keys( $ads_fields );
	foreach ( $ads_fields as $text_field ) :
		$input[$text_field] = ( isset( $input[$text_field] ) ) ? trim( $input[$text_field] ) : '';
	endforeach;

	// URLs
	foreach ( array(
		'neon_ad_button_one_link',
		'neon_ad_button_two_link',
		'github_commits_rss',
		'donate_ad_button_link',
	) as $url_field ) :
		$input[$url_field] = ( isset( $input[$url_field] ) ) ? esc_url_raw( $input[$url_field] ) : '';
	endforeach;

	return $input;
}
add_filter( 't_em_admin_filter_theme_options_validate', 't_em_all_theme_options_validate' );
?>
