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
	// Save the value to the DB
	if ( $_POST['doc-top-page'] ) :
		$data = sanitize_text_field( $_POST['doc-top-page'] );
		update_post_meta( $post_id, 't_em_all_doc_top_page', $data );
	else :
		delete_post_meta( $post_id, 't_em_all_doc_top_page' );
	endif;
}
add_action( 'save_post', 't_em_all_save_doc_top_page' );
?>
