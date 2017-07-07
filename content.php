<?php
/**
 * Twenty'em All
 *
 * @package			WordPress
 * @subpackage		Twenty'em All: Templates
 * @author			RogerTM
 * @license			license.txt
 * @link			https://themingisprose.com/twenty-em
 * @since 			Twenty'em All 1.0
 */

/**
 * Override the default template for displaying content
 */
global $t_em;
?>
		<?php t_em_action_post_before(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class( t_em_archive_cols() ); ?>>
			<?php t_em_action_post_inside_before(); ?>
			<?php t_em_featured_post_thumbnail( $t_em['excerpt_thumbnail_width'], $t_em['excerpt_thumbnail_height'], true, 'featured-post-thumbnail' ); ?>
			<header class="entry-header">
				<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 't_em' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
				<span class="entry-meta">
					<?php t_em_posted_on(); ?>
				</span><!-- .entry-meta -->
			</header>
			<?php echo do_shortcode( get_the_excerpt() ) ; ?>
			<footer class="entry-utility">
				<?php t_em_posted_in(); ?>
				<?php t_em_comments_link(); ?>
				<?php t_em_edit_post_link(); ?>
			</footer><!-- .entry-utility -->
			<?php t_em_action_post_inside_after(); ?>
		</article><!-- #post-## -->
		<?php t_em_action_post_after(); ?>
