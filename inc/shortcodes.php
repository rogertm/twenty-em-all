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
	if ( wp_script_is( 'quicktags' ) && t_em( 'shortcode_buttoms' ) ) :
?>
	<script type="text/javascript">
		QTags.addButton( 'sc_t_em_all_pre', 'pre', '<pre class="prettyprint linenums" title="code">', '</pre>', '', '', 105 );
		QTags.addButton( 'sc_t_em_all_t_em', 't_em', '[t_em]', '', '', '', 106 );
		QTags.addButton( 'sc_t_em_all_tip', 'tip', '[tip]', '', '', '', 107 );
		QTags.addButton( 'sc_callout', 'callout', '[callout style="primary" heading=""]', '[/callout]', '', '', 108 );
		QTags.addButton( 'sc_t_em_all_remove_shortcode', 'remove_shortcode', '[remove_shortcode]', '[/remove_shortcode]', '', '', 108 );
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

/**
 * Shortcode [callout]
 * Enclosing. Permits others shortcodes.
 * Behavior: [callout style="child-primary" heading="" close="false"][/callout]
 * Options:
 * 0. style. 		Optional. (but recommended). Default value child-"primary".
 * 1. heading. 		Optional. callout Heading
 * 2. close. 		Optional. Default value "false". Display a close button
 *
 * @see https://getbootstrap.com/docs/4.0/components/callouts/
 *
 * @since Twenty'em 1.0
 * @since Twenty'em 1.2		Added "heading" parameter
 */
function t_em_shortcode_callout( $atts, $content = null ){
	extract( shortcode_atts( array(
			'style' => 'primary',
			'heading' => '',
		), $atts ) );
	$style = ( esc_attr( $style ) != '' ) ? esc_attr( $style ) : 'primary';
	$heading = ( esc_attr( $heading ) != '' ) ? '<h4 class="child-callout-heading">'. esc_attr( $heading ).'</h4>' : null;
	return '<div class="child-callout child-callout-'. esc_attr( $style ) .'">' . $heading . '<p class="mb-0">' . do_shortcode( $content ) .'</p></div>';
}
add_shortcode( 'callout', 't_em_shortcode_callout' );

/**
 * Remove Shortcode
 *
 * @since Twenty'em All 1.0
 */
function t_em_all_shortcode_removed( $atts, $content = null ){
	return '<code class="removed-shortcode">'. $content .'</code>';
}
add_shortcode( 'remove_shortcode', 't_em_all_shortcode_removed' );
?>
