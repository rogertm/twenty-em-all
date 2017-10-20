<?php
/**
 * Twenty'em All
 *
 * @package			WordPress
 * @subpackage		Twenty'em All: Post Types
 * @author			RogerTM
 * @license			license.txt
 * @link			https://themingisprose.com/twenty-em
 * @since 			Twenty'em All 1.1
 */

/**
 * Register custom post types
 *
 * @since Twenty'em All 1.1
 */
function t_em_all_register_post_types(){
	$post_types = array(
		'doc'	=> array( 'post-type' => 'doc',
						  'singular' => _x( 'Document', 'post type singular name', 't_em_all' ),
						  'plural' => _x( 'Documents', 'post type general name', 't_em_all' ),
						  'singular-item' => _x( 'Topic', 'singular document item', 't_em_all' ),
						  'plural-items' => _x( 'Topics', 'plural document item', 't_em_all' ),
						  'hierarchical' => true,
						  'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt', 'trackbacks', 'page-attributes', 'revisions', 'shortlinks' ),
					),
	);

	foreach ( $post_types as $post_type => $pt ) :
		$labels = array(
			'name'					=> $pt['plural'],
			'singular_name'			=> $pt['singular-item'],
			'manu_name'				=> $pt['plural'],
			'all_items'				=> sprintf( __( 'All %s', 't_em_all' ), $pt['plural-items'] ),
			'add_new'				=> __( 'Add new', 't_em_all' ),
			'add_new_item'			=> sprintf( __( 'Add new %s', 't_em_all' ), $pt['singular-item'] ),
			'edit_item'				=> sprintf( __( 'Edit %s', 't_em_all' ), $pt['singular-item'] ),
			'new_item'				=> sprintf( __( 'New %s', 't_em_all' ), $pt['singular-item'] ),
			'view_item'				=> sprintf( __( 'View %s', 't_em_all' ), $pt['singular-item'] ),
			'search_items'			=> sprintf( __( 'Search %s', 't_em_all' ), $pt['plural-items'] ),
			'not_found'				=> sprintf( __( 'No %s found', 't_em_all' ), $pt['singular-item'] ),
			'not_found_in_trash'	=> sprintf( __( 'No %s found in trash', 't_em_all' ), $pt['singular-item'] ),
			'parent_item_colon'		=> sprintf( __( 'Parent %s', 't_em_all' ), $pt['singular-item'] ),
		);

		$args = array(
			'labels'				=> $labels,
			'public'				=> true,
			'exclude_from_search'	=> false,
			'publicly_queryable'	=> true,
			'show_ui'				=> true,
			'show_in_nav_menus'		=> true,
			'show_in_menu'			=> true,
			'show_in_admin_bar'		=> true,
			'capability_type'		=> 'post',
			'hierarchical'			=> $pt['hierarchical'],
			'supports'				=> $pt['supports'],
			'has_archive'			=> true,
			'query_var'				=> true,
			'can_export'			=> true,
		);

		register_post_type( $pt['post-type'], $args );
	endforeach;
}
add_action( 'init', 't_em_all_register_post_types' );

/**
 * Rewrite rules to get permalinks works when theme will be activated
 *
 * @since Twenty'em All 1.1
 */
function t_em_all_rewrite_flush(){
	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 't_em_all_rewrite_flush' );
?>
