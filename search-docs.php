<?php
/**
 * Twenty'em All
 *
 * @package			WordPress
 * @subpackage		Twenty'em All: Docs search results
 * @author			RogerTM
 * @license			license.txt
 * @link			https://themingisprose.com/twenty-em
 * @since 			Twenty'em All 1.1
 */

get_header(); ?>

		<section id="main-content" <?php t_em_breakpoint( 'main-content' ); ?>>
			<section id="content" role="main" <?php t_em_breakpoint( 'content' ); ?>>
				<?php t_em_action_content_before(); ?>
				<?php
				// We exclude deprecated functions from search...
				$args = array(
					'post_type'			=> 'doc',
					's'					=> get_query_var( 's' ),
					'paged'				=> get_query_var( 'paged' ),
					'meta_query'		=> array(
						array(
							'key'		=> 'function_api_deprecated',
							'value'		=> 1,
							'compare'	=> 'NOT EXISTS',
						),
					),
				);
				$wp_query = new WP_Query( $args );
				?>
				<?php t_em_loop(); ?>
				<?php t_em_action_content_after(); ?>
			</section><!-- #content -->
			<?php get_sidebar( 'docs' ); ?>
			<?php get_sidebar( 'alt' ); ?>
		</section><!-- #main-content -->

<?php get_footer(); ?>
