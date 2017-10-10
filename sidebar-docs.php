<?php
/**
 * Twenty'em All
 *
 * @package			WordPress
 * @subpackage		Twenty'em All: Docs sidebar
 * @author			RogerTM
 * @license			license.txt
 * @link			https://themingisprose.com/twenty-em
 * @since 			Twenty'em All 1.1
 */

/**
 * Sidebar containing Table of Content and documentation links
 *
 * @package WordPress
 * @subpackage Twenty'em All
 * @since Twenty'em All 1.0
 */

global $t_em;
?>
		<section id="sidebar-docs" role="complementary" <?php t_em_breakpoint( 'sidebar' ); ?>>
			<?php t_em_action_sidebar_before(); ?>
			<div class="widget-container"><?php get_template_part( 'searchform', 'docs' ); ?></div>
			<?php
			if ( is_singular( 'doc' ) ) :
				// Table of Content
				$args = array(
					'post_type'			=> 'doc',
					'post_parent'		=> $post->ID,
					'orderby'			=> 'menu_order',
					'order'				=> 'ASC',
					'posts_per_page'	=> -1,
					'meta_key'			=> 'function_api_deprecated',
					'meta_value_num'	=> '1',
					'meta_compare'		=> 'NOT EXISTS',
				);
				$doc_topics = get_posts( $args );
				if ( count( $doc_topics ) > 0 ) :
			?>
			<aside id="table-of-content-<?php the_ID() ?>" class="widget-container">
				<h3 class="widget-title"><?php _e( 'Table of Content', 't_em_all' ); ?></h3>
				<ul class="doc-topics-list">
					<li class="doc-topic-<?php echo $post->ID ?> <?php echo ( $post->ID == get_the_ID() ) ? 'current-topic' : null; ?>"><a href="<?php echo get_permalink( $post->ID ) ?>"><?php echo get_the_title( $post->ID ); ?></a></li>
			<?php 	foreach ( $doc_topics as $topic ) :
						$active = ( $topic->ID == get_the_ID() ) ? 'current-topic' : null;
			?>
						<li class="doc-topic-<?php echo $topic->ID ?> <?php echo $active ?>"><a href="<?php echo get_permalink( $topic->ID ) ?>"><?php echo get_the_title( $topic->ID ); ?></a></li>
			<?php 	endforeach; ?>
				</ul>
			</aside>
			<?php
				else :
					$ancestor = ( get_ancestors( get_the_ID(), 'doc' ) ) ? get_ancestors( get_the_ID(), 'doc' ) : null;
					// Table of Content
					$args = array(
						'post_type'			=> 'doc',
						'post_parent'		=> $ancestor[0],
						'orderby'			=> 'menu_order',
						'order'				=> 'ASC',
						'posts_per_page'	=> -1,
						'meta_key'			=> 'function_api_deprecated',
						'meta_value_num'	=> '1',
						'meta_compare'		=> 'NOT EXISTS',
					);
					$doc_topics = get_posts( $args );
					if ( count( $doc_topics ) > 0 ) :
			?>
				<aside id="table-of-content-<?php the_ID() ?>" class="widget-container">
					<h3 class="widget-title"><?php _e( 'Table of Content', 't_em_all' ); ?></h3>
					<ul>
					<li class="doc-topic-<?php echo $ancestor[0] ?> <?php echo ( $ancestor[0] == get_the_ID() ) ? 'current-topic' : null; ?>"><a href="<?php echo get_permalink( $ancestor[0] ) ?>"><?php echo get_the_title( $ancestor[0] ); ?></a></li>
			<?php 		foreach ( $doc_topics as $topic ) :
							$active = ( $topic->ID == get_the_ID() ) ? 'current-topic' : null;
							$deprecated = ( get_post_meta( $topic->ID, 'function_api_deprecated', true ) ) ? 'topic-deprecated' : null;
			?>
							<li class="doc-topic-<?php echo $topic->ID ?> <?php echo $active ?> <?php echo $deprecated ?>"><a href="<?php echo get_permalink( $topic->ID ) ?>"><?php echo get_the_title( $topic->ID ); ?></a></li>
			<?php 		endforeach; ?>
					</ul>
				</aside>
				<?php
					endif;
				endif;
			endif;
			?>
			<aside id="aside-documentation" class="widget-container">
				<h3 class="widget-title"><?php echo get_the_title( $t_em['page_docs'] ) ?></h3>
				<ul>
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
				?>
					<li><a href="<?php echo get_permalink( $t_em['page_docs'] ) ?>"><?php _e( 'Main Page', 't_em_all' ) ?></a></li>
				<?php foreach ( $docs_parent_pages as $docs ) :
						$active = ( $docs->ID == get_the_ID() ) ? 'current-topic' : null;
				?>
					<li class="doc-topic-<?php echo $docs->ID ?> <?php echo $active ?>"><a href="<?php echo get_permalink( $docs->ID ) ?>"><?php echo get_the_title( $docs->ID ) ?></a></li>
				<?php endforeach; ?>
				</ul>
			</aside>

			<?php
				if ( is_active_sidebar( 'sidebar-documentation' ) ) :
					dynamic_sidebar( 'sidebar-documentation' );
				endif;
			?>

			<?php t_em_action_sidebar_after(); ?>
		</section>
