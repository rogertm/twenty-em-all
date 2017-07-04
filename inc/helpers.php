<?php
/**
 * Twenty'em All
 *
 * @package			WordPress
 * @subpackage		Twenty'em All: Helpers
 * @author			RogerTM
 * @license			license.txt
 * @link			https:/twenty-em.themingisprose.com
 * @since 			Twenty'em All 1.0
 */

/**
 * Get javascript files
 * This functions loads minify scripts if the site is running online, otherwise (WP_DEBUG == true),
 * loads the beautify script.
 * @param string $handle 	Script handle. If the file is named my.script.min.js, $handle = 'my.script'
 * 							Both files should exists: my.script.min.js and my.script.js
 * @return string  			File URL
 *
 * @since Twenty'em All 1.0
 */
function t_em_all_get_js( $handle ){
	if ( WP_DEBUG ) :
		$file = ( file_exists( T_EM_CHILD_THEME_DIR_PATH .'/js/'. $handle .'.js' ) ) ? $handle .'.js' : $handle .'.min.js';
	else :
		$file = ( file_exists( T_EM_CHILD_THEME_DIR_PATH .'/js/'. $handle .'.min.js' ) ) ? $handle .'.min.js' : $handle .'.js';
	endif;
	if ( file_exists( T_EM_CHILD_THEME_DIR_PATH .'/js/'. $file ) ) :
		$file_url = T_EM_CHILD_THEME_DIR_URL .'/js/'. $file;
		return $file_url;
	endif;
	return false;
}

/**
 * Get css files
 * This functions loads minify css files if the site is running online, otherwise (WP_DEBUG == true),
 * loads the beautify css.
 * @param string $handle 	Script handle. If the file is named my.style.min.css, $handle = 'my.style'
 * 							Both files should exists: my.style.min.css and my.style.css
 * @return string  			File URL
 *
 * @since Twenty'em All 1.0
 */
function t_em_all_get_css( $handle ){
	if ( WP_DEBUG ) :
		$file = ( file_exists( T_EM_CHILD_THEME_DIR_PATH .'/css/'. $handle .'.css' ) ) ? $handle .'.css' : $handle .'.min.css';
	else :
		$file = ( file_exists( T_EM_CHILD_THEME_DIR_PATH .'/css/'. $handle .'.min.css' ) ) ? $handle .'.min.css' : $handle .'.css';
	endif;
	if ( file_exists( T_EM_CHILD_THEME_DIR_PATH .'/css/'. $file ) ) :
		$file_url = T_EM_CHILD_THEME_DIR_URL .'/css/'. $file;
		return $file_url;
	endif;
	return false;
}
?>
