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

	$less_files = array( T_EM_CHILD_THEME_DIR_PATH . '/css/style-theme.less' => T_EM_CHILD_THEME_DIR_URL . '/css' );
	$options = array( 'compress' => true );
	wp_enqueue_style( 'child-style-less', t_em_lessphp_compiler( $less_files, $options ), '', $t_em_theme_data['Version'], 'all' );
}
add_action( 'wp_enqueue_scripts', 't_em_all_enqueue' );

function foo(){
?>
	<h3><?php _e( 'Features small adds: easy to config; powerful for end users, free, extensive docs', 't_em_all' ) ?></h3>
	<h3><?php _e( 'Default text widget from t_em', 't_em_all' ) ?></h3>
	<h3><?php _e( 'Big neon add block, Twenty\'em is awesome... So download it', 't_em_all' ) ?></h3>
	<h3><?php _e( 'GitHub commit rss', 't_em_all' ) ?></h3>
	<h3><?php _e( 'Fun facts, lines of code, coffee, nights, etc...', 't_em_all' ) ?></h3>
	<h3><?php _e( 'Latests news from parent site, if any', 't_em_all' ) ?></h3>
	<h3><?php _e( 'I\'am just a WordPress theme/framework, please give some money...', 't_em_all' ) ?></h3>
<?php
}
// add_action( 't_em_admin_action_from_page_option_widgets-front-page_before', 'foo' );
add_action( 't_em_admin_action_from_page_option_widgets-front-page_after', 'foo' );
?>
