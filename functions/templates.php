<?php
/**
 * Twenty'em All
 *
 * @package			WordPress
 * @subpackage		Twenty'em All: Templates
 * @author			RogerTM
 * @license			license.txt
 * @link			https://twenty-em.themingisprose.com
 * @since 			Twenty'em All 1.0
 */

/** Front Page ************************************************************************************/
/**
 * Override the Front Page Widgets function
 *
 * @since Twenty'em All 1.0
 */
function t_em_front_page_widgets(){
	global $t_em;
	if ( 'widgets-front-page' == $t_em['front_page_set'] ) : ?>
		<section id="featured-widget-area" class="row">
			<?php t_em_action_custom_front_page_inside_before(); ?>
<?php
	foreach ( t_em_front_page_widgets_options() as $widget ) :
		if ( ! empty( $t_em['headline_'.$widget['name'].''] ) || ! empty( $t_em['content_'.$widget['name'].''] ) ) :
		$widget_icon_class	= ( $t_em['headline_icon_class_'.$widget['name'].''] ) ?
			'<span class="'. $t_em['headline_icon_class_'.$widget['name'].''] .' icomoon"></span>' : null;

		$widget_thumbnail_url	= ( $t_em['thumbnail_src_'.$widget['name'].''] ) ?
			'<img src="'. $t_em['thumbnail_src_'.$widget['name'].''] .'" alt="'. sanitize_text_field( $t_em['headline_'.$widget['name']] ) .'" class="hidden-xs"/>' : null;

		$widget_thumbnail_url_xs	= ( $t_em['thumbnail_src_'.$widget['name'].''] ) ?
			'<img src="'. $t_em['thumbnail_src_'.$widget['name'].''] .'" alt="'. sanitize_text_field( $t_em['headline_'.$widget['name']] ) .'" class="visible-xs-block" />' : null;

		$widget_headline	= ( $t_em['headline_'.$widget['name'].''] ) ?
			'<header><h2>'. $widget_icon_class . $t_em['headline_'.$widget['name'].''] .'</h2></header>' : null;

		$widget_content		= ( $t_em['content_'.$widget['name'].''] ) ?
			'<div class="front-page-widget-content">'. t_em_wrap_paragraph( do_shortcode( $t_em['content_'.$widget['name']] ) ) .'</div>' : null;

		$primary_link_text			= ( $t_em['primary_button_text_'.$widget['name']] ) ? $t_em['primary_button_text_'.$widget['name']] : null;
		$primary_link_icon_class	= ( $t_em['primary_button_icon_class_'.$widget['name']] ) ? $t_em['primary_button_icon_class_'.$widget['name']] : null;
		$primary_button_link 		= ( $t_em['primary_button_link_'.$widget['name']] ) ? $t_em['primary_button_link_'.$widget['name']] : null;
		$secondary_link_text		= ( $t_em['secondary_button_text_'.$widget['name']] ) ? $t_em['secondary_button_text_'.$widget['name']] : null;
		$secondary_link_icon_class	= ( $t_em['secondary_button_icon_class_'.$widget['name']] ) ? $t_em['secondary_button_icon_class_'.$widget['name']] : null;
		$secondary_button_link 		= ( $t_em['secondary_button_link_'.$widget['name']] ) ? $t_em['secondary_button_link_'.$widget['name']] : null;

		if ( ( $primary_button_link && $primary_link_text ) || ( $secondary_button_link && $secondary_link_text ) ) :
				$primary_button_link_url = ( $primary_button_link && $primary_link_text ) ?
					'<a href="'. $primary_button_link .'" class="btn primary-button">
					<span class="'.$primary_link_icon_class.' icomoon"></span> <span class="button-text">'. $primary_link_text .'</span></a>' : null;

				$secondary_button_link_url = ( $secondary_button_link && $secondary_link_text ) ?
					'<a href="'. $secondary_button_link .'" class="btn secondary-button">
					<span class="'.$secondary_link_icon_class.' icomoon"></span> <span class="button-text">'. $secondary_link_text .'</span></a>' : null;

			$widget_footer = '<footer>'. $primary_button_link_url . ' ' . $secondary_button_link_url .'</footer>';
		else :
			$widget_footer = null;
		endif;
?>
		<div id="t-em-all-front-page-widget-<?php echo str_replace( 'text_widget_', '', $widget['name'] ) ?>" class="front-page-widget">
			<div class="widget-thumbnail col-sm-5"><?php echo $widget_thumbnail_url; ?></div>
			<div class="front-page-widget-caption col-sm-7">
			<?php	echo $widget_headline;
					echo $widget_thumbnail_url_xs;
					echo $widget_content;
					echo $widget_footer; ?>
			</div>
		</div>
<?php
		endif;
	endforeach;
?>
			<?php t_em_action_custom_front_page_inside_after(); ?>
		</section><!-- #featured-widget-area -->
<?php
	endif;
}

/**
 * Small features add
 */
function t_em_all_features_add(){
?>
	<div class="wrapper container text-center">
		<h3><?php _e( 'Features small adds: easy to config; powerful for end users, free, extensive docs', 't_em_all' ) ?></h3>
	</div>
<?php
}
add_action( 't_em_action_main_before', 't_em_all_features_add' );

/**
 * Big neon add
 */
function t_em_all_neon_add(){
?>
	<div class="wrapper container text-center">
		<h3><?php _e( 'Big neon add block, Twenty\'em is awesome... So download it', 't_em_all' ) ?></h3>
	</div>
<?php
}
add_action( 't_em_action_main_after', 't_em_all_neon_add' );

/**
 * GitHub add
 */
function t_em_all_github_add(){
?>
	<div class="wrapper container text-center">
		<h3><?php _e( 'GitHub commit rss', 't_em_all' ) ?></h3>
	</div>
<?php
}
add_action( 't_em_action_main_after', 't_em_all_github_add' );

/**
 * Fun facts add
 */
function t_em_all_fun_add(){
?>
	<div class="wrapper container text-center">
		<h3><?php _e( 'Fun facts, lines of code, coffee, nights, etc...', 't_em_all' ) ?></h3>
	</div>
<?php
}
add_action( 't_em_action_main_after', 't_em_all_fun_add' );

/**
 * Latest news add
 */
function t_em_all_latests_news_add(){
?>
	<div class="wrapper container text-center">
		<h3><?php _e( 'Latests news from parent site, if any', 't_em_all' ) ?></h3>
	</div>
<?php
}
add_action( 't_em_action_main_after', 't_em_all_latests_news_add' );

/**
 * Donate add
 */
function t_em_all_donate_add(){
?>
	<div class="wrapper container text-center">
		<h3><?php _e( 'I\'am just a WordPress theme/framework, please give some money...', 't_em_all' ) ?></h3>
	</div>
<?php
}
add_action( 't_em_action_main_after', 't_em_all_donate_add' );
?>
