<?php
/**
 * Twenty'em All
 *
 * @package			WordPress
 * @subpackage		Twenty'em All: Documentation
 * @author			RogerTM
 * @license			license.txt
 * @link			https://themingisprose.com/twenty-em
 * @since 			Twenty'em All 1.1
 */

/**
 * Load Search in Docs template
 *
 * @since Twenty'em All 1.1
 */
function t_em_all_load_search_docs_template( $search_template = '' ){
	if ( isset( $_GET['s'] ) && isset( $_GET['pt'] ) && $_GET['pt'] == 'doc' ) :
		$search_template = locate_template( 'search-docs.php' );
	endif;
	return $search_template;
}
add_filter( 'search_template', 't_em_all_load_search_docs_template' );

/**
 * Redirect from doc archive to Documentation Main Page
 *
 * @since Twenty'em All 1.1
 */
function t_em_all_doc_redirect(){
	if ( is_post_type_archive( 'doc' ) ) :
		$location = get_permalink( t_em( 'page_docs' ) );
		wp_safe_redirect( $location );
		exit();
	endif;
}
add_action( 'template_redirect', 't_em_all_doc_redirect' );

/**
 * Template for post type doc
 *
 * @since Twenty'em All 1.1
 */
function t_em_all_doc_editor_content( $content ){
	global $post;
	$screen = get_current_screen();
	if ( $screen->id == 'doc' ) :
		if ( get_post_type( $post->ID ) == 'doc' && empty( get_post_field( 'post_content', $post->ID ) ) ) :
			$content = __( '<h2>Description</h2>', 't_em_all' );
			$content .= __( '<h2>Usage</h2>', 't_em_all' );
			$content .= __( '<h2>Parameters</h2>', 't_em_all' );
			$content .= __( '<h2>Returned Values</h2>', 't_em_all' );
			$content .= __( '<h2>Examples</h2>', 't_em_all' );
			$content .= __( '<h2>Notes</h2>', 't_em_all' );
			$content .= __( '<h2>Resources</h2>', 't_em_all' );
		else :
			$content = $content;
		endif;
	endif;
	return $content;
}
add_filter( 'the_editor_content', 't_em_all_doc_editor_content' );
?>
