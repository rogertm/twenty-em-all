<?php
/**
 * Twenty'em All
 *
 * @package			WordPress
 * @subpackage		Twenty'em All: Admin > General Options
 * @author			RogerTM
 * @license			license.txt
 * @link			https://themingisprose.com/twenty-em
 * @since 			Twenty'em All 1.1
 */

/**
 * Add custom general options
 *
 * @since Twenty'em All 1.1
 */
function t_em_all_custom_general_options(){
	// Get JSON file to read the Icon Pack from GitHub
?>
	<div class="sub-layout text-option general">
		<label class="description single-option">
			<p><?php _e( 'JSON file for Icon Pack', 't_em_all' ); ?></p>
			<p class="description"><?php _e( 'URL address of JSON file to read the Icon Pack', 't_em_all' ); ?></p>
			<input type="text" class="regular-text" name="t_em_theme_options[icon_pack_json]" value="<?php echo t_em( 'icon_pack_json' ) ?>" />
		</label>
	</div>
<?php
}
add_action( 't_em_admin_action_general_options_after', 't_em_all_custom_general_options', 15 );
?>
