<?php
/**
 * Twenty'em All
 *
 * @package			WordPress
 * @subpackage		Twenty'em All: Meta boxes for "doc" post type
 * @author			RogerTM
 * @license			license.txt
 * @link			https://themingisprose.com/twenty-em
 * @since 			Twenty'em All 1.1
 */

/**
 * Register meta boxes for doc post type
 *
 * @since Twenty'em All 1.1
 */
function t_em_all_doc_meta(){
	add_meta_box( 't-em-all-doc-top-page', __( 'Doc Top Page', 't_em_all' ), 't_em_all_doc_top_page_callback', 'doc', 'side', 'high' );
	add_meta_box( 't-em-all-doc-api-change-log', __( 'Change Log Data for API elements', 't_em_all' ), 't_em_all_api_change_log_callback', 'doc', 'advanced', 'high' );
}
add_action( 'add_meta_boxes', 't_em_all_doc_meta' );

/**
 * Add "Doc Top Page" meta box
 *
 * @since Twenty'em All 1.1
 */
function t_em_all_doc_top_page_callback( $post ){
	wp_nonce_field( 'doc_top_page_attr', 'doc_top_page_field' );
	$doc_top_page = get_post_meta( $post->ID, 't_em_all_doc_top_page', true );
	$checked = checked( $doc_top_page, 1, false );
?>
	<p><strong><?php _e( 'Check this option for top Documentation Pages', 't_em_all' ); ?></strong></p>
	<label class="screen-reader-text" for="doc-top-page">
		<?php _e( 'Doc Top Page', 't_em_all' ) ?>
	</label>
	<input type="checkbox" id="doc-top-page" name="doc-top-page" value="1" <?php echo $checked; ?>>
<?php
}

/**
 * Save "Doc Top Page" data
 *
 * @since Twenty'em All 1.1
 */
function t_em_all_save_doc_top_page( $post_id ){
	// Check if the current user is authorized to do this action.
	if ( ! current_user_can( 'edit_posts' ) )
		return;
	// Check if the user intended to change this value.
	if ( ! isset ( $_POST['doc_top_page_field'] ) || ! wp_verify_nonce( $_POST['doc_top_page_field'], 'doc_top_page_attr' ) )
		return;
	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
		return;
	// Save the value to the DB
	if ( $_POST['doc-top-page'] ) :
		$data = sanitize_text_field( $_POST['doc-top-page'] );
		update_post_meta( $post_id, 't_em_all_doc_top_page', $data );
	else :
		delete_post_meta( $post_id, 't_em_all_doc_top_page' );
	endif;
}
add_action( 'save_post', 't_em_all_save_doc_top_page' );

/**
 * Change Log Data for API elements
 *
 * @since Twenty'em All 1.1
 */
function t_em_all_api_change_log_callback( $post ){
	wp_nonce_field( 'doc_api_data_attr', 'doc_api_data_field' );

	$api_args = array(
		'post_type'			=> 'doc',
		'child_of'			=> t_em( 'page_api' ),
		'parent'			=> -1,
		'post_status'		=> array( 'publish' ),
		'sort_column'		=> 'menu_order',
		'numberposts'		=> -1,
		'exclude'			=> $post->ID,
	);
	$api_function = get_pages( $api_args );

	$deprecated 		= ( get_post_meta( $post->ID, 'function_api_deprecated', true ) ) ? get_post_meta( $post->ID, 'function_api_deprecated', true ) : null;
	$deprecated_since 	= ( get_post_meta( $post->ID, 'function_api_deprecated_since', true ) ) ? get_post_meta( $post->ID, 'function_api_deprecated_since', true ) : null;
	$use_instead 		= ( get_post_meta( $post->ID, 'function_api_use_instead', true ) ) ? get_post_meta( $post->ID, 'function_api_use_instead', true ) : null;

	$checked 			= checked( $deprecated, 1, false );
?>
	<h4><?php _e( 'Deprecated', 't_em_all' ) ?></h4>
	<label>
		<input type="checkbox" name="deprecated" value="1" <?php echo $checked ?>>
		<?php _e( 'Check this options if this element is deprecated', 't_em_all' ) ?>
	</label>
	<h4><?php _e( 'Deprecated Since', 't_em_all' ) ?></h4>
	<label>
		<?php _e( 'If deprecated, insert the version here', 't_em_all' ) ?><br>
		<input type="text" name="deprecated-since" value="<?php echo $deprecated_since ?>">
	</label>
	<h4><?php _e( 'Use Instead', 't_em_all' ) ?></h4>
	<label>
		<?php _e( 'If deprecated, select another option to use instead', 't_em_all' ) ?><br>
		<select name="use-instead">
			<option value=""><?php _e( '&mdash; Select &mdash;', 't_em_all' ) ?></option>
<?php 	foreach ( $api_function as $function ) :
			// Exclude obsoleted functions...
			if ( ! get_post_meta( $function->ID, 'function_api_deprecated', true ) ) :
				$selected = selected( $use_instead, $function->ID, false );
				$function_ancestor = get_post_ancestors( $function->ID );
				$function_label = ( $function_ancestor[0] == t_em( 'page_api' ) ) ? sprintf( '&mdash;&mdash; %s &mdash;&mdash;', get_the_title( $function->ID ) ) : get_the_title( $function->ID );
				$option_tag = ( $function_ancestor[0] == t_em( 'page_api' ) ) ? 'optgroup' : 'option';
?>
			<<?php echo $option_tag ?> label="<?php echo $function_label ?>" value="<?php echo $function->ID ?>" <?php echo $selected; ?>><?php echo $function_label ?></<?php echo $option_tag ?>>
<?php
			endif;
		endforeach;
?>
		</select>
	</label>
<?php
}

/**
 * Save "Change Log API" data
 *
 * @since Twenty'em All 1.1
 */
function t_em_all_save_api_change_log_data( $post_id ){
	// Check if the current user is authorized to do this action.
	if ( ! current_user_can( 'edit_posts' ) )
		return;
	// Check if the user intended to change this value.
	if ( ! isset ( $_POST['doc_api_data_field'] ) || ! wp_verify_nonce( $_POST['doc_api_data_field'], 'doc_api_data_attr' ) )
		return;
	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
		return;

	// Save the data
	if ( isset( $_POST['deprecated'] ) ) :
		$data = sanitize_text_field( $_POST['deprecated'] );
		update_post_meta( $post_id, 'function_api_deprecated', $data );
	else :
		delete_post_meta( $post_id, 'function_api_deprecated' );
	endif;
	if ( isset( $_POST['deprecated-since'] ) ) :
		$data = sanitize_text_field( $_POST['deprecated-since'] );
		update_post_meta( $post_id, 'function_api_deprecated_since', $data );
	else :
		delete_post_meta( $post_id, 'function_api_deprecated_since' );
	endif;
	if ( isset( $_POST['use-instead'] ) ) :
		$data = sanitize_text_field( $_POST['use-instead'] );
		update_post_meta( $post_id, 'function_api_use_instead', $data );
	else :
		delete_post_meta( $post_id, 'function_api_use_instead' );
	endif;
	// Delete all deprecated stuff if necessary
	if ( ! $_POST['deprecated'] ) :
		delete_post_meta( $post_id, 'function_api_deprecated_since' );
		delete_post_meta( $post_id, 'function_api_use_instead' );
	endif;
}
add_action( 'save_post', 't_em_all_save_api_change_log_data' );
?>
