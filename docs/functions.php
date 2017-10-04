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
	global $t_em;
	if ( is_post_type_archive( 'doc' ) ) :
		$location = get_permalink( $t_em['page_docs'] );
		wp_safe_redirect( $location );
		exit();
	endif;
}
add_action( 'template_redirect', 't_em_all_doc_redirect' );
?>
