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
 * Small features ad
 *
 * @since Twenty'em All 1.0
 */
function t_em_all_features_ad(){
	global $t_em, $template;
	if ( ! is_front_page() && basename( $template != 'custom-front-page.php' ) )
		return;

	global $t_em;
	$ads = t_em_all_front_page_ads_features_options();
?>
	<section id="twenty-em-features" class="jumbo-content">
		<div class="wrapper container text-center">
			<div class="row">
<?php foreach ( $ads as $ad => $value ) :
		$data = $value['data'];
		$data = array_keys( $data );
?>
				<div class="col-sm-3">
					<i class="<?php echo $t_em[$data[1]] ?> h1"></i>
					<h3 class="h4"><?php echo $t_em[$data[0]] ?></h3>
					<?php echo t_em_wrap_paragraph( do_shortcode( $t_em[$data[2]] ) ) ?>
				</div>
<?php endforeach; ?>
			</div>
		</div>
	</section>
<?php
}
add_action( 't_em_action_main_before', 't_em_all_features_ad' );

/**
 * Big neon ad
 *
 * @since Twenty'em All 1.0
 */
function t_em_all_neon_ad(){
	global $t_em, $template;
	if ( ! is_front_page() || basename( $template ) != 'custom-front-page.php' )
		return;

	$btn_one = ( $t_em['neon_ad_button_one_label'] && $t_em['neon_ad_button_one_link'] )
				? '<a href="'. $t_em['neon_ad_button_one_link'] .'" class="btn btn-default">'. $t_em['neon_ad_button_one_label'] .'</a>'
				: null;

	$btn_two = ( $t_em['neon_ad_button_two_label'] && $t_em['neon_ad_button_two_link'] )
				? '<a href="'. $t_em['neon_ad_button_two_link'] .'" class="btn btn-default">'. $t_em['neon_ad_button_two_label'] .'</a>'
				: null;
?>
	<section id="twenty-em-neon" class="jumbo-content">
		<div class="wrapper container text-center">
			<h3><?php echo do_shortcode( $t_em['neon_ad_headline'] ) ?></h3>
			<?php echo t_em_wrap_paragraph( $t_em['neon_ad_content'] ) ?>
			<div class="actions">
			<?php echo $btn_one . ' ' . $btn_two ?>
			</div>
		</div>
	</section>
<?php
}
add_action( 't_em_action_main_after', 't_em_all_neon_ad' );

/**
 * GitHub ad
 *
 * @since Twenty'em All 1.0
 */
function t_em_all_github_ad(){
	global $t_em, $template;
	if ( ! is_front_page() || basename( $template ) != 'custom-front-page.php' || ! $t_em['github_commits_rss'] )
		return;

	include_once( ABSPATH . WPINC . '/feed.php' );
	$rss = fetch_feed( $t_em['github_commits_rss'] );
	if ( ! is_wp_error( $rss ) ) :
		$max_items = $rss->get_item_quantity( 5 );
		$rss_items = $rss->get_items( 0, $max_items );
	else :
		$max_items = null;
	endif;
?>
	<section id="twenty-em-github" class="jumbo-content">
		<div class="wrapper container text-center">
			<div class="row">
			<h3><?php echo $t_em['github_commits_headline'] ?></h3>
<?php if ( $max_items == 0 ) : ?>
			<p class="lead"><?php _e( 'No updates so far...', 't_em_all' ) ?></p>
<?php else : ?>
			<div class="col-sm-8 col-sm-offset-2">
				<dl class="dl-horizontal text-left lead">
<?php 	foreach ( $rss_items as $item ) : ?>
					<dt class="text-muted small"><?php echo $item->get_date( 'j F Y' ) ?></dt>
					<dd><a href="<?php echo esc_url( $item->get_permalink() ); ?>">
						<?php echo esc_html( $item->get_title() ); ?></a></dd>
<?php 	endforeach; ?>
				</dl>
			</div>
<?php endif; ?>
			</div>
		</div>
	</section>
<?php
}
add_action( 't_em_action_main_after', 't_em_all_github_ad' );

/**
 * Fun facts ad
 *
 * @since Twenty'em All 1.0
 */
function t_em_all_fun_ad(){
	global $t_em, $template;
	if ( ! is_front_page() || basename( $template ) != 'custom-front-page.php' )
		return;

	$funs = t_em_all_fun_facts_options();
	$coffee = t_em_all_coffee();
?>
	<section id="twenty-em-fun" class="jumbo-content">
		<div class="text-center">
<?php foreach ( $funs as $fun ) :
		$coding = $t_em['hours_of_coding'];
		$start_date = new DateTime( $coding );
		$end_date = new DateTime( date( 'Y-m-d' ) );
		$interval = $start_date->diff( $end_date );
		$value = ( $fun['value'] == 'hours_of_coding' ) ? $interval->days : $t_em[$fun['value']];
?>
			<div class="fun-fact">
				<div class="fun-fact-inner">
					<i class="<?php echo $t_em[$fun['icon']] ?> h1"></i>
					<p class="h1"><?php echo $value ?></p>
					<p class="lead"><?php echo $fun['label'] ?></p>
				</div>
				</div>
<?php endforeach; ?>
			<div class="fun-fact">
				<div class="fun-fact-inner">
					<i class="icofont icofont-coffee-mug h1"></i>
					<p class="h1"><?php echo $coffee['cups'] ?></p>
					<p class="lead"><?php echo $coffee['label'] ?></p>
				</div>
			</div>
		</div>
	</section>
<?php
}
add_action( 't_em_action_main_after', 't_em_all_fun_ad' );

/**
 * Latest news ad
 *
 * @since Twenty'em All 1.0
 */
function t_em_all_latests_news_ad(){
	global $t_em, $template;
	if ( ! is_front_page() || basename( $template ) != 'custom-front-page.php' )
		return;

	$args = array(
		'posts_per_page'	=> 4,
	);
	$news = get_posts( $args );
?>
	<section id="twenty-em-posts" class="jumbo-content">
		<div class="wrapper container">
			<div class="row">
			<h3 class="text-center"><?php _e( 'News', 't_em_all' ) ?></h3>
<?php if ( $news ) : ?>
			<div class="col-sm-8 col-sm-offset-2">
<?php 	foreach ( $news as $new ) : ?>
			<div class="media">
				<div class="media-left"><?php t_em_featured_post_thumbnail( 100, 100, true, 'media-object', $new->ID ) ?></div>
				<div class="media-body">
					<h4 class="media-heading"><a href="<?php echo get_permalink( $new->ID ) ?>"><?php echo $new->post_title ?></a></h4>
					<?php echo t_em_wrap_paragraph( $new->post_excerpt ) ?>
				</div>
			</div>
<?php 	endforeach; ?>
			</div>
<?php endif; ?>
			</div>
		</div>
	</section>
<?php
}
add_action( 't_em_action_main_after', 't_em_all_latests_news_ad' );

/**
 * Donate ad
 *
 * @since Twenty'em All 1.0
 */
function t_em_all_donate_ad(){
	global $t_em;
?>
	<section id="twenty-em-donate" class="jumbo-content">
		<div class="wrapper container text-center">
			<h3><?php echo $t_em['donate_ad_headline'] ?></h3>
			<?php echo t_em_wrap_paragraph( $t_em['donate_ad_content'] ) ?>
			<div class="actions">
				<a href="<?php echo $t_em['donate_ad_button_link'] ?>" class="btn btn-default"><?php echo $t_em['donate_ad_button_label'] ?></a>
			</div>
		</div>
	</section>
<?php
}
add_action( 't_em_action_main_after', 't_em_all_donate_ad' );
?>