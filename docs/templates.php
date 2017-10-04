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
 * The Docx!
 * Display the documentation index
 *
 * @since Twenty'em All 1.1
 */
function t_em_all_the_doc(){
	global $t_em;
	if ( is_page( $t_em['page_docs'] ) ) :
?>
	<div id="docs-main-page">
	<?php
	// Get parents docs pages
	$args = array(
		'post_type'			=> 'doc',
		'posts_per_page'	=> -1,
		'post_parent'		=> 0,
		'meta_key'			=> 't_em_all_doc_top_page',
		'meta_value_num'	=> '1',
		'orderby'			=> 'menu_order',
		'order'				=> 'ASC',
	);
	$docs_parent_pages = get_posts( $args );

	$columns = 2;
	$cols = 12 / $columns;
	?>
		<div class="row">
	<?php
	$i = 0;
	foreach ( $docs_parent_pages as $docs ) :
		if ( 0 == $i % $columns ) :
			echo '</div>';
			echo '<div class="row">';
		endif;
		if ( get_children( array( 'post_parent' => $docs->ID ) ) ) :
			$alt_title = ( get_post_meta( $docs->ID, 't_em_all_featured_excerpt', true ) ) ? 'title="'. get_post_meta( $docs->ID, 't_em_all_featured_excerpt', true ) .'"' : null;
	?>
		<div class="<?php echo t_em_grid( $cols ) ?>">
			<div id="<?php echo get_post_field( 'post_name', $docs->ID ) ?>" class="card card-doc">
				<div class="card-header"><a href="<?php echo get_permalink( $docs->ID ) ?>" <?php echo $alt_title ?>><?php echo $docs->post_title; ?></a></div>
		<?php 	if ( $docs->post_content ) : ?>
				<div class="card-body"><?php echo t_em_wrap_paragraph( do_shortcode( get_post_field( 'post_content', $docs->ID ) ) ); ?></div>
		<?php 	endif; ?>
				<ul class="list-unstyled">
		<?php	// Get inner docs pages
				$args = array(
					'post_type'			=> 'doc',
					'post_parent'		=> $docs->ID,
					'orderby'			=> 'menu_order',
					'order'				=> 'ASC',
					'posts_per_page'	=> -1,
				);
				$docs_inner_pages = get_posts( $args );
				foreach ( $docs_inner_pages as $doc ) : ?>
					<li class="h5"><a href="<?php echo get_permalink( $doc->ID ) ?>"><?php echo $doc->post_title; ?></a></li>
		<?php	endforeach; ?>
				</ul>
			</div><!-- .card -->
		</div><!-- .t_em_grid() -->
	<?php
		endif;
		$i++;
	endforeach;
?>
		</div><!-- .row -->
	</div><!-- #docs-## -->
<?php
	endif;
}
add_action( 't_em_action_post_inside_after', 't_em_all_the_doc' );

/**
 * Display the search form in documentation main page
 *
 * @since Twenty'em All 1.1
 */
function t_em_all_search_docs_form(){
	global $t_em;
	if ( is_page( $t_em['page_docs'] ) ) :
?>
<section id="search-in-docs" class="row">
	<div class="col-lg-10 mx-auto">
		<?php get_template_part( 'searchform', 'docs' ); ?>
	</div>
</section>
<?php
	endif;
}
add_action( 't_em_action_post_content_after', 't_em_all_search_docs_form' );
?>
