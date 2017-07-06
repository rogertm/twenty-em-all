<?php
/**
 * Twenty'em All
 *
 * @package			WordPress
 * @subpackage		Twenty'em All: Shortcodes
 * @author			RogerTM
 * @license			license.txt
 * @link			https://themingisprose.com/twenty-em
 * @since 			Twenty'em All 1.0
 */

/**
 * ad a class .branding to Twenty'em
 */
function t_em_all_shortcode_t_em( $atts, $content = null ){
	return '<span class="branding">'. T_EM_FRAMEWORK_NAME .'</span>';
}
add_shortcode( 't_em', 't_em_all_shortcode_t_em' );
?>
