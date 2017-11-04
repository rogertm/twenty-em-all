<?php
/**
 * Twenty'em All
 *
 * @package			WordPress
 * @subpackage		Twenty'em All: Admin
 * @author			RogerTM
 * @license			license.txt
 * @link			https://themingisprose.com/twenty-em
 * @since 			Twenty'em All 1.0
 */

/**
 * Register Setting
 * @link http://codex.wordpress.org/Settings_API
 *
 * @since Twenty'em All 1.0
 */
function t_em_all_register_setting_init(){
	add_settings_field( 't_em_all_custom_pages', __( 'Custom Pages', 't_em_all' ), 't_em_all_setting_fields_custom_pages', 'twenty-em-options', 'twenty-em-section' );
}
add_action( 't_em_admin_action_add_settings_field', 't_em_all_register_setting_init' );

/**
 * Remove unnecessary options
 */
add_filter( 't_em_admin_filter_header_options_no_header_image', '__return_false' );
add_filter( 't_em_admin_filter_header_options_header_image', '__return_false' );
add_filter( 't_em_admin_filter_header_options_slider', '__return_false' );
add_filter( 't_em_admin_filter_front_page_options_wp_front_page', '__return_false' );
add_filter( 't_em_admin_filter_archive_options_the_content', '__return_false' );


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
		// Neon call to action
		'neon_headline'						=> '',
		'neon_content'						=> '',
		'neon_button_one_label'				=> '',
		'neon_button_one_link'				=> '',
		'neon_button_two_label'				=> '',
		'neon_button_two_link'				=> '',
		// GitHub Stuff
		'github_commits_headline'			=> '',
		'github_commits_rss'				=> '',
		'github_content_headline'			=> '',
		'github_content'					=> '',
		'github_button_one_label'			=> '',
		'github_button_one_link'			=> '',
		'github_button_two_label'			=> '',
		'github_button_two_link'			=> '',
		// Donate Stuff
		'donate_headline'					=> '',
		'donate_content'					=> '',
		'donate_button_label'				=> '',
		'donate_button_link'				=> '',
		// Funny Stuff
		'lines_of_code'						=> '',
		'kilobytes'							=> '',
		'files'								=> '',
		'hours_of_coding'					=> '2012-09-10', // First Commit Date
		// FeedBurner Stuff
		'feedburner_headline'				=> '',
		'feedburner_content'				=> '',
		'feedburner_button_label'			=> '',
		'feedburner_button_placeholder'		=> '',
		'feedburner_id'						=> '',
		// Icon Pack Stuff
		'icon_pack_json'					=> '',
	);
	$ads = t_em_all_front_page_ads_features_options();
	foreach ( $ads as $ad => $value ) :
		$key = $value['data'];
		$t_em_all_default_options = array_merge( $t_em_all_default_options, $key );
	endforeach;

	$funs = t_em_all_fun_facts_options();
	foreach ( $funs as $fun => $value ) :
		$key = array( $value['value'] => '' );
		$t_em_all_default_options = array_merge( $t_em_all_default_options, array_slice( $key, -1 ) );
	endforeach;

	// Get custom pages from the original function
	foreach ( t_em_all_custom_pages() as $pages => $value ) :
		$key = array( $value['value'] => '' );
		$t_em_all_default_options = array_merge( $t_em_all_default_options, array_slice( $key, -1 ) );
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
		'neon_headline',
		'neon_content',
		'neon_button_one_label',
		'neon_button_two_label',
		'github_commits_headline',
		'github_content_headline',
		'github_content',
		'github_button_one_label',
		'github_button_two_label',
		'donate_headline',
		'donate_content',
		'donate_button_label',
		'lines_of_code',
		'kilobytes',
		'files',
		'hours_of_coding',
		'feedburner_headline',
		'feedburner_content',
		'feedburner_button_label',
		'feedburner_button_placeholder',
		'feedburner_id',
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

	$fun_fields = array();
	$funs = t_em_all_fun_facts_options();
	foreach ( $funs as $fun => $value ) :
		$key = array( $value['value'] => '' );
		$fun_fields = array_merge( $fun_fields, array_slice( $key, -1 ) );
	endforeach;
	$fun_fields = array_keys( $fun_fields );
	foreach ( $fun_fields as $text_field ) :
		$input[$text_field] = ( isset( $input[$text_field] ) ) ? trim( $input[$text_field] ) : '';
	endforeach;

	$fun_icons = array();
	$funs = t_em_all_fun_facts_options();
	foreach ( $funs as $fun => $value ) :
		$key = array( $value['icon'] => '' );
		$fun_icons = array_merge( $fun_icons, array_slice( $key, -1 ) );
	endforeach;
	$fun_icons = array_keys( $fun_icons );
	foreach ( $fun_icons as $text_field ) :
		$input[$text_field] = ( isset( $input[$text_field] ) ) ? trim( $input[$text_field] ) : '';
	endforeach;

	// URLs
	foreach ( array(
		'neon_button_one_link',
		'neon_button_two_link',
		'github_commits_rss',
		'github_button_one_link',
		'github_button_two_link',
		'donate_button_link',
		'icon_pack_json',
	) as $url_field ) :
		$input[$url_field] = ( isset( $input[$url_field] ) ) ? esc_url_raw( $input[$url_field] ) : '';
	endforeach;

	// Let's go for pages
	$pages = t_em_all_custom_pages();
	foreach ( $pages as $key => $value ) :
		if ( array_key_exists( $input[$key['value']], $pages ) ) :
			$input[$key] = $input[$key['value']];
		endif;
	endforeach;

	return $input;
}
add_filter( 't_em_admin_filter_theme_options_validate', 't_em_all_theme_options_validate' );
?>
