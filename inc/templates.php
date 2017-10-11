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

/** Front Page ************************************************************************************/
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
		<div class="jumbo-content-inner">
			<div class="container">
				<div class="row">
<?php foreach ( $ads as $ad => $value ) :
		$data = $value['data'];
		$data = array_keys( $data );
?>
					<div class="col-lg-3 col-md-6 py-3">
						<i class="<?php echo $t_em[$data[1]] ?> h1"></i>
						<h3 class="h4"><?php echo $t_em[$data[0]] ?></h3>
						<?php echo t_em_wrap_paragraph( do_shortcode( $t_em[$data[2]] ) ) ?>
					</div>
<?php endforeach; ?>
				</div>
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

	$btn_one = ( $t_em['neon_button_one_label'] && $t_em['neon_button_one_link'] )
				? '<a href="'. $t_em['neon_button_one_link'] .'" class="btn">'. $t_em['neon_button_one_label'] .'</a>'
				: null;

	$btn_two = ( $t_em['neon_button_two_label'] && $t_em['neon_button_two_link'] )
				? '<a href="'. $t_em['neon_button_two_link'] .'" class="btn">'. $t_em['neon_button_two_label'] .'</a>'
				: null;
?>
	<section id="twenty-em-neon" class="jumbo-content">
		<div class="jumbo-content-inner">
			<div class="container">
				<h2 class="jumbo-header"><?php echo do_shortcode( $t_em['neon_headline'] ) ?></h2>
				<?php echo t_em_wrap_paragraph( do_shortcode( $t_em['neon_content'] ) ) ?>
				<footer class="actions">
					<?php echo $btn_one . ' ' . $btn_two ?>
				</footer>
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
	$items = ( $max_items > 0 ) ? $max_items : null;


	$btn_one = ( $t_em['github_button_one_label'] && $t_em['github_button_one_link'] )
				? '<a href="'. $t_em['github_button_one_link'] .'" class="btn">'. $t_em['github_button_one_label'] .'</a>'
				: null;

	$btn_two = ( $t_em['github_button_two_label'] && $t_em['github_button_two_link'] )
				? '<a href="'. $t_em['github_button_two_link'] .'" class="btn">'. $t_em['github_button_two_label'] .'</a>'
				: null;

	$cols = ( $items ) ? '6' : '12';
?>
	<section id="twenty-em-github" class="jumbo-content container-fluid">
		<div class="jumbo-content-inner row">
			<div id="github-left" class="<?php echo t_em_grid( $cols ) ?>">
					<h2 class="jumbo-header"><?php echo do_shortcode( $t_em['github_content_headline'] ) ?></h2>
					<?php echo t_em_wrap_paragraph( do_shortcode( $t_em['github_content'] ) ) ?>
					<footer class="actions">
						<?php echo $btn_one . ' ' . $btn_two ?>
					</footer>
			</div> <!-- #github-left -->
<?php if ( $items ) : ?>
			<div id="github-right" class="<?php echo t_em_grid( $cols ) ?>">
				<h2 class="jumbo-header"><?php echo do_shortcode( $t_em['github_commits_headline'] ) ?></h2>
				<dl id="commit-items" class="row">
<?php 	foreach ( $rss_items as $item ) : ?>
					<dt class="commit-date <?php echo t_em_grid( '3' ) ?> col-12"><?php echo $item->get_date( 'j F, Y' ) ?></dt>
					<dd class="commit-title <?php echo t_em_grid( '9' ) ?> col-12"><a href="<?php echo esc_url( $item->get_permalink() ); ?>">
						<?php echo esc_html( $item->get_title() ); ?></a></dd>
<?php 	endforeach; ?>
				</dl>
			</div><!-- #github-right -->
<?php endif; ?>
		</div>
	</section>
<?php
}
add_action( 't_em_action_main_after', 't_em_all_github_ad' );

/**
 * Lifetime of the feed cache
 *
 * @since Twenty'em All 1.1
 */
function t_em_all_feed_lifetime(){
	return 3600;
}
add_filter( 'wp_feed_cache_transient_lifetime', 't_em_all_feed_lifetime' );

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
		<div class="jumbo-content-inner">
<?php foreach ( $funs as $fun ) :
		$coding = $t_em['hours_of_coding'];
		$start_date = new DateTime( $coding );
		$end_date = new DateTime( date( 'Y-m-d' ) );
		$interval = $start_date->diff( $end_date );
		$value = ( $fun['value'] == 'hours_of_coding' ) ? $interval->days : $t_em[$fun['value']];
?>
			<div class="fun-fact">
				<div class="fun-fact-inner">
					<i class="fun-icon <?php echo $t_em[$fun['icon']] ?>"></i>
					<p class="fun-value"><?php echo $value ?></p>
					<p class="fun-label"><?php echo $fun['label'] ?></p>
				</div>
			</div>
<?php endforeach; ?>
			<div class="fun-fact">
				<div class="fun-fact-inner">
					<i class="fun-icon icomoon-coffee-cup"></i>
					<p class="fun-value"><?php echo $coffee['cups'] ?></p>
					<p class="fun-label"><?php echo $coffee['label'] ?></p>
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
	$page_blog = ( $t_em['page_blog'] )
					? '<a href="'. get_permalink( $t_em['page_blog'] ) .'" class="btn">'. __( 'View more', 't_em_all' ) .'</a>'
					: null;
?>
<?php if ( $news ) : ?>
	<section id="twenty-em-posts" class="jumbo-content">
		<div class="jumbo-content-inner">
			<div class="container">
				<h2 class="jumbo-header"><?php _e( 'Blog Posts', 't_em_all' ) ?></h2>
				<div class="row">
					<div class="<?php echo t_em_grid( '8' ) ?> m-auto py-3 text-left">
<?php 	foreach ( $news as $new ) :
			$date = explode( ' ', get_the_date( 'd M Y', $new->ID ) );
?>
					<div <?php post_class( 'media mb-3', $new->ID ) ?>>
						<div class="d-flex mr-3">
							<time>
								<span class="day"><?php echo $date[0] ?></span>
								<span class="month"><?php echo $date[1] ?></span>
								<span class="year"><?php echo $date[2] ?></span>
							</time>
						</div>
						<div class="media-body">
							<h2 class="h4 mt-0"><a href="<?php echo get_permalink( $new->ID ) ?>"><?php echo $new->post_title ?></a></h2>
							<?php t_em_wrap_paragraph( t_em_all_get_post_resume( $new->ID ) ) ?>
						</div>
					</div>
<?php 	endforeach; ?>
					</div>
				</div>
				<footer class="actions">
					<?php echo $page_blog ?>
				</footer>
			</div>
		</div>
	</section>
<?php endif; ?>
<?php
}
add_action( 't_em_action_main_after', 't_em_all_latests_news_ad' );

/**
 * Donate ad
 *
 * @since Twenty'em All 1.0
 */
function t_em_all_donate_ad(){
	global $t_em, $template;
	if ( ! is_front_page() || basename( $template ) != 'custom-front-page.php' )
		return;
?>
	<section id="twenty-em-donate" class="jumbo-content">
		<div class="jumbo-content-inner">
			<div class="container">
				<h2 class="jumbo-header"><?php echo $t_em['donate_headline'] ?></h2>
				<?php echo t_em_wrap_paragraph( do_shortcode( $t_em['donate_content'] ) ) ?>
				<footer class="actions">
					<a href="<?php echo $t_em['donate_button_link'] ?>" class="btn"><?php echo $t_em['donate_button_label'] ?></a>
				</footer>
			</div>
		</div>
	</section>
<?php
}
add_action( 't_em_action_main_after', 't_em_all_donate_ad' );

/**
 * Subscribe
 *
 * @since Twenty'em All 1.0
 */
function t_em_all_subscribe_ad(){
	global $t_em, $template;
	if ( ! is_front_page() || basename( $template ) != 'custom-front-page.php' )
		return;

?>
	<section id="twenty-em-subscribe" class="jumbo-content">
		<div class="jumbo-content-inner">
			<div class="container">
				<h2 class="jumbo-header"><?php echo $t_em['feedburner_headline'] ?></h2>
				<?php echo t_em_wrap_paragraph( do_shortcode( $t_em['feedburner_content'] ) ) ?>
				<form action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=<?php echo $t_em['feedburner_id'] ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
					<div class="form-row">
						<div class="input-email <?php // echo t_em_grid( '6', 'xs' ) ?>">
							<input type="email" name="email" class="form-control form-control-lg subscribe-input w-100" placeholder="<?php echo $t_em['feedburner_button_placeholder'] ?>" required>
							<input type="hidden" value="<?php echo $t_em['feedburner_id']; ?>" name="uri"/>
							<input type="hidden" name="loc" value="en_US"/>
						</div>
						<div class="input-send <?php // echo t_em_grid( '6', 'xs' ) ?>">
							<button class="btn w-100" type="submit"><?php echo $t_em['feedburner_button_label'] ?></button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</section>
<?php
}
add_action( 't_em_action_main_after', 't_em_all_subscribe_ad' );

/** Single ****************************************************************************************/
/**
 * Add the custom excerpt in single posts
 *
 * @since Twenty'em All 1.0
 */
function t_em_all_single_custom_excerpt(){
	global $post;
	if ( is_singular( 'post' ) && $post->post_excerpt ) : ?>
	<div class="single-excerpt"><?php echo t_em_wrap_paragraph( do_shortcode( $post->post_excerpt ) ) ?></div>
<?php
	endif;
}
// add_action( 't_em_action_post_content_before', 't_em_all_single_custom_excerpt', 15 );

/** Content ***************************************************************************************/
/**
 * Go to top
 */
function t_em_all_go_top(){
	echo '<div id="gototop" class="btn scroll-to" data-target="html"><i class="icomoon-chevron-thin-up"></i><span class="text-hide">'. __( 'Go to top', 't_em_all' ) .'</span></div>';
}
add_action( 'wp_footer', 't_em_all_go_top' );
?>
