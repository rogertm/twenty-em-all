<?php
/**
 * Twenty'em All
 *
 * @package			WordPress
 * @subpackage		Twenty'em All: Admin > Custom Pages
 * @author			RogerTM
 * @license			license.txt
 * @link			https://themingisprose.com/twenty-em
 * @since 			Twenty'em All 1.0
 */

/**
 * Array of pages object
 *
 * @since Twenty'em All 1.0
 */
function t_em_all_list_pages( $type ){
	$page_args = array(
		'post_type'			=> $type,
		'posts_per_page'	=> -1,
		'orderby'			=> 'title',
		'post_status'		=> array( 'publish', 'private' ),
		'order'				=> 'ASC',
	);

	$doc_args = array(
		'post_type'			=> 'doc',
		'posts_per_page'	=> -1,
		'orderby'			=> 'menu_order',
		'post_status'		=> array( 'publish', 'private' ),
		'order'				=> 'ASC',
		'meta_query'		=> array(
				array(
					'key'	=> 't_em_all_doc_top_page',
					'value'	=> '1'
				),
			),
	);

	if ( $type == 'page' ) :
		$args = $page_args;
	elseif ( $type == 'doc' ) :
		$args = $doc_args;
	endif;

	$sort = get_posts( $args );
	sort( $sort );
	return apply_filters( 't_em_all_admin_filter_list_pages', get_posts( $args ) );
}

/**
 * Custom Pages
 *
 * @since Twenty'em All 1.0
 */
function t_em_all_custom_pages( $custom_pages = '' ){
	$custom_pages = array(
		'page_blog'	=> array(
			'value'			=> 'page_blog',
			'label'			=> __( 'Page Blog', 't_em_all' ),
			'public_label'	=> __( 'Blog', 't_em_all' ),
			'user_menu'		=> '',
			'type'			=> 'page',
		),
		'page_icomoon_demo'	=> array(
			'value'			=> 'page_icomoon_demo',
			'label'			=> __( 'Page IcoMoon Demo', 't_em_all' ),
			'public_label'	=> __( 'IcoMoon Demo', 't_em_all' ),
			'user_menu'		=> '',
			'type'			=> 'page',
		),
		'page_docs'	=> array(
			'value'			=> 'page_docs',
			'label'			=> __( 'Page Docs', 't_em_all' ),
			'public_label'	=> __( 'Documentation', 't_em_all' ),
			'user_menu'		=> '',
			'type'			=> 'page',
		),
		'page_license'	=> array(
			'value'			=> 'page_license',
			'label'			=> __( 'Page License', 't_em_all' ),
			'public_label'	=> __( 'License', 't_em_all' ),
			'user_menu'		=> '',
			'type'			=> 'page',
		),
		'page_api'	=> array(
			'value'		=> 'page_api',
			'label'		=> __( 'Developers API Page', 't_em_all' ),
			'type'		=> 'doc'
		),
	);
	return apply_filters( 't_em_all_admin_filter_custom_pages', $custom_pages );
}

/**
 * Render Custom Pages panel
 *
 * @since Twenty'em All 1.0
 */
function t_em_all_setting_fields_custom_pages(){
	foreach ( t_em_all_custom_pages() as $page ) :
?>
	<div class="text-option custom-pages">
		<label class="">
			<span><?php echo $page['label']; ?></span>
			<select name="t_em_theme_options[<?php echo $page['value'] ?>]">
				<option value="0"><?php _e( '&mdash; Select &mdash;', 't_em_all' ); ?></option>
				<?php foreach ( t_em_all_list_pages( $page['type'] ) as $list ) :
				?>
					<?php $selected = selected( t_em( $page['value'] ), $list->ID, false ); ?>
					<option value="<?php echo $list->ID ?>" <?php echo $selected; ?>><?php echo $list->post_title ?></option>
				<?php endforeach; ?>
			</select>
		</label>
		<?php if ( t_em( $page['value'] ) ) : ?>
			<div class="row-action">
				<span class="edit"><a href="<?php echo get_edit_post_link( t_em( $page['value'] ) ) ?>"><?php _e( 'Edit', 't_em_all' ) ?></a> | </span>
				<span class="view"><a href="<?php echo get_permalink( t_em( $page['value'] ) ) ?>"><?php _e( 'View', 't_em_all' ) ?></a></span>
			</div>
		<?php endif; ?>
	</div>
<?php
	endforeach;
}
?>
