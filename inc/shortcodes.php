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
 * Include additional buttons in the Text (HTML) mode of the WordPress editor
 *
 * @since Twenty'em All 1.0
 */
function t_em_all_quicktags_buttons(){
	global $t_em;
	if ( wp_script_is( 'quicktags' ) && $t_em['shortcode_buttoms'] ) :
?>
	<script type="text/javascript">
		QTags.addButton( 'sc_t_em_all_pre', 'pre', '<pre class="prettyprint linenums" title="code">', '</pre>', '', '', 105 );
		QTags.addButton( 'sc_t_em_all_t_em', 't_em', '[t_em]', '', '', '', 106 );
		QTags.addButton( 'sc_t_em_all_tip', 'tip', '[tip]', '', '', '', 107 );
	</script>
<?php
	endif;
}
add_action( 'admin_print_footer_scripts', 't_em_all_quicktags_buttons' );

/**
 * ad a class .branding to Twenty'em
 *
 * @since Twenty'em All 1.0
 */
function t_em_all_shortcode_t_em( $atts, $content = null ){
	return '<span class="branding">'. T_EM_FRAMEWORK_NAME .'</span>';
}
add_shortcode( 't_em', 't_em_all_shortcode_t_em' );

/**
 * ad a class .branding to Theming is Prose
 *
 * @since Twenty'em All 1.0
 */
function t_em_all_shortcode_tip( $atts, $content = null ){
	return '<span class="branding">'. __( 'Theming is Prose', 't_em_all' ) .'</span>';
}
add_shortcode( 'tip', 't_em_all_shortcode_tip' );
?>
