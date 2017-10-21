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
						<div class="input-email">
							<input type="email" name="email" class="form-control form-control-lg subscribe-input w-100" placeholder="<?php echo $t_em['feedburner_button_placeholder'] ?>" required>
							<input type="hidden" value="<?php echo $t_em['feedburner_id']; ?>" name="uri"/>
							<input type="hidden" name="loc" value="en_US"/>
						</div>
						<div class="input-send">
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

/** Content ***************************************************************************************/
/**
 * Go to top
 */
function t_em_all_go_top(){
	echo '<div id="gototop" class="btn scroll-to" data-target="html"><i class="icomoon-chevron-thin-up"></i><span class="text-hide">'. __( 'Go to top', 't_em_all' ) .'</span></div>';
}
add_action( 'wp_footer', 't_em_all_go_top' );

/** IcoMoon Demo **********************************************************************************/
/**
 * IcoMoon Demo Page
 *
 * @since Twenty'em All 1.1
 */
function t_em_all_icomoon_demo(){
	global $t_em;
	if ( ! is_page( $t_em['page_icomoon_demo'] ) )
		return;

	$icomoon = array(
		'icomoon-500px' => 'e900',
		'icomoon-address' => 'e901',
		'icomoon-add-to-list' => 'e902',
		'icomoon-add-user' => 'e903',
		'icomoon-adjust' => 'e904',
		'icomoon-air' => 'e905',
		'icomoon-aircraft' => 'e906',
		'icomoon-aircraft-landing' => 'e907',
		'icomoon-aircraft-take-off' => 'e908',
		'icomoon-alarm' => 'e909',
		'icomoon-align-bottom' => 'e90a',
		'icomoon-align-horizontal-middle' => 'e90b',
		'icomoon-align-left' => 'e90c',
		'icomoon-align-right' => 'e90d',
		'icomoon-align-top' => 'e90e',
		'icomoon-align-vertical-middle' => 'e90f',
		'icomoon-ampersand' => 'e910',
		'icomoon-app-store' => 'e911',
		'icomoon-archive' => 'e912',
		'icomoon-area-graph' => 'e913',
		'icomoon-arrow-bold-down' => 'e914',
		'icomoon-arrow-bold-left' => 'e915',
		'icomoon-arrow-bold-right' => 'e916',
		'icomoon-arrow-bold-up' => 'e917',
		'icomoon-arrow-down' => 'e918',
		'icomoon-arrow-down2' => 'e919',
		'icomoon-arrow-down-left2' => 'e91a',
		'icomoon-arrow-down-right2' => 'e91b',
		'icomoon-arrow-left' => 'e91c',
		'icomoon-arrow-left2' => 'e91d',
		'icomoon-arrow-long-down' => 'e91e',
		'icomoon-arrow-long-left' => 'e91f',
		'icomoon-arrow-long-right' => 'e920',
		'icomoon-arrow-long-up' => 'e921',
		'icomoon-arrow-right' => 'e922',
		'icomoon-arrow-right2' => 'e923',
		'icomoon-arrow-up' => 'e924',
		'icomoon-arrow-up2' => 'e925',
		'icomoon-arrow-up-left2' => 'e926',
		'icomoon-arrow-up-right2' => 'e927',
		'icomoon-arrow-with-circle-down' => 'e928',
		'icomoon-arrow-with-circle-left' => 'e929',
		'icomoon-arrow-with-circle-right' => 'e92a',
		'icomoon-arrow-with-circle-up' => 'e92b',
		'icomoon-attachment' => 'e92c',
		'icomoon-awareness-ribbon' => 'e92d',
		'icomoon-back' => 'e92e',
		'icomoon-back-in-time' => 'e92f',
		'icomoon-baidu' => 'e930',
		'icomoon-bar-graph' => 'e931',
		'icomoon-basecamp' => 'e932',
		'icomoon-battery' => 'e933',
		'icomoon-beamed-note' => 'e934',
		'icomoon-behance' => 'e935',
		'icomoon-bell' => 'e936',
		'icomoon-binoculars' => 'e937',
		'icomoon-blackboard' => 'e938',
		'icomoon-block' => 'e939',
		'icomoon-book' => 'e93a',
		'icomoon-bookmark' => 'e93b',
		'icomoon-bookmarks' => 'e93c',
		'icomoon-bowl' => 'e93d',
		'icomoon-box' => 'e93e',
		'icomoon-briefcase' => 'e93f',
		'icomoon-browser' => 'e940',
		'icomoon-brush' => 'e941',
		'icomoon-bubble' => 'e942',
		'icomoon-bubble2' => 'e943',
		'icomoon-bubbles' => 'e944',
		'icomoon-bubbles2' => 'e945',
		'icomoon-bubbles3' => 'e946',
		'icomoon-bubbles4' => 'e947',
		'icomoon-bucket' => 'e948',
		'icomoon-bug' => 'e949',
		'icomoon-cake' => 'e94a',
		'icomoon-calculator' => 'e94b',
		'icomoon-calendar' => 'e94c',
		'icomoon-camera' => 'e94d',
		'icomoon-ccw' => 'e94e',
		'icomoon-chat' => 'e94f',
		'icomoon-check' => 'e950',
		'icomoon-chevron-down' => 'e951',
		'icomoon-chevron-left' => 'e952',
		'icomoon-chevron-right' => 'e953',
		'icomoon-chevron-small-down' => 'e954',
		'icomoon-chevron-small-left' => 'e955',
		'icomoon-chevron-small-right' => 'e956',
		'icomoon-chevron-small-up' => 'e957',
		'icomoon-chevron-thin-down' => 'e958',
		'icomoon-chevron-thin-left' => 'e959',
		'icomoon-chevron-thin-right' => 'e95a',
		'icomoon-chevron-thin-up' => 'e95b',
		'icomoon-chevron-up' => 'e95c',
		'icomoon-chevron-with-circle-down' => 'e95d',
		'icomoon-chevron-with-circle-left' => 'e95e',
		'icomoon-chevron-with-circle-right' => 'e95f',
		'icomoon-chevron-with-circle-up' => 'e960',
		'icomoon-chrome' => 'e961',
		'icomoon-circle' => 'e962',
		'icomoon-circle-with-cross' => 'e963',
		'icomoon-circle-with-minus' => 'e964',
		'icomoon-circle-with-plus' => 'e965',
		'icomoon-circular-graph' => 'e966',
		'icomoon-clapperboard' => 'e967',
		'icomoon-classic-computer' => 'e968',
		'icomoon-clipboard' => 'e969',
		'icomoon-clock' => 'e96a',
		'icomoon-cloud' => 'e96b',
		'icomoon-code' => 'e96c',
		'icomoon-codepen' => 'e96d',
		'icomoon-coffee-cup' => 'e96e',
		'icomoon-cog' => 'e96f',
		'icomoon-colours' => 'e970',
		'icomoon-compass' => 'e971',
		'icomoon-controller-fast-backward' => 'e972',
		'icomoon-controller-fast-forward' => 'e973',
		'icomoon-controller-jump-to-start' => 'e974',
		'icomoon-controller-next' => 'e975',
		'icomoon-controller-paus' => 'e976',
		'icomoon-controller-play' => 'e977',
		'icomoon-controller-record' => 'e978',
		'icomoon-controller-stop' => 'e979',
		'icomoon-controller-volume' => 'e97a',
		'icomoon-copy' => 'e97b',
		'icomoon-creative-cloud' => 'e97c',
		'icomoon-creative-commons' => 'e97d',
		'icomoon-creative-commons-attribution' => 'e97e',
		'icomoon-creative-commons-noderivs' => 'e97f',
		'icomoon-creative-commons-noncommercial-eu' => 'e980',
		'icomoon-creative-commons-noncommercial-us' => 'e981',
		'icomoon-creative-commons-public-domain' => 'e982',
		'icomoon-creative-commons-remix' => 'e983',
		'icomoon-creative-commons-share' => 'e984',
		'icomoon-creative-commons-sharealike' => 'e985',
		'icomoon-credit' => 'e986',
		'icomoon-credit-card' => 'e987',
		'icomoon-crop' => 'e988',
		'icomoon-cross' => 'e989',
		'icomoon-css3' => 'e98a',
		'icomoon-cup' => 'e98b',
		'icomoon-cw' => 'e98c',
		'icomoon-cycle' => 'e98d',
		'icomoon-database' => 'e98e',
		'icomoon-delicious' => 'e98f',
		'icomoon-deviantart' => 'e990',
		'icomoon-dial-pad' => 'e991',
		'icomoon-direction' => 'e992',
		'icomoon-document' => 'e993',
		'icomoon-document-landscape' => 'e994',
		'icomoon-documents' => 'e995',
		'icomoon-dot-single' => 'e996',
		'icomoon-dots-three-horizontal' => 'e997',
		'icomoon-dots-three-vertical' => 'e998',
		'icomoon-dots-two-horizontal' => 'e999',
		'icomoon-dots-two-vertical' => 'e99a',
		'icomoon-download' => 'e99b',
		'icomoon-dribbble' => 'e99c',
		'icomoon-dribbble-with-circle' => 'e99d',
		'icomoon-drink' => 'e99e',
		'icomoon-drive' => 'e99f',
		'icomoon-drop' => 'e9a0',
		'icomoon-dropbox' => 'e9a1',
		'icomoon-edge' => 'e9a2',
		'icomoon-edit' => 'e9a3',
		'icomoon-email' => 'e9a4',
		'icomoon-emoji-flirt' => 'e9a5',
		'icomoon-emoji-happy' => 'e9a6',
		'icomoon-emoji-neutral' => 'e9a7',
		'icomoon-emoji-sad' => 'e9a8',
		'icomoon-erase' => 'e9a9',
		'icomoon-eraser' => 'e9aa',
		'icomoon-evernote' => 'e9ab',
		'icomoon-export' => 'e9ac',
		'icomoon-eye' => 'e9ad',
		'icomoon-eye-with-line' => 'e9ae',
		'icomoon-facebook' => 'e9af',
		'icomoon-facebook-with-circle' => 'e9b0',
		'icomoon-feather' => 'e9b1',
		'icomoon-finder' => 'e9b2',
		'icomoon-fingerprint' => 'e9b3',
		'icomoon-firefox' => 'e9b4',
		'icomoon-flag' => 'e9b5',
		'icomoon-flash' => 'e9b6',
		'icomoon-flashlight' => 'e9b7',
		'icomoon-flat-brush' => 'e9b8',
		'icomoon-flattr' => 'e9b9',
		'icomoon-flickr' => 'e9ba',
		'icomoon-flickr-with-circle' => 'e9bb',
		'icomoon-flow-branch' => 'e9bc',
		'icomoon-flow-cascade' => 'e9bd',
		'icomoon-flower' => 'e9be',
		'icomoon-flow-line' => 'e9bf',
		'icomoon-flow-parallel' => 'e9c0',
		'icomoon-flow-tree' => 'e9c1',
		'icomoon-folder' => 'e9c2',
		'icomoon-folder-download' => 'e9c3',
		'icomoon-folder-images' => 'e9c4',
		'icomoon-folder-minus' => 'e9c5',
		'icomoon-folder-music' => 'e9c6',
		'icomoon-folder-open' => 'e9c7',
		'icomoon-folder-plus' => 'e9c8',
		'icomoon-folder-upload' => 'e9c9',
		'icomoon-folder-video' => 'e9ca',
		'icomoon-forward' => 'e9cb',
		'icomoon-foursquare' => 'e9cc',
		'icomoon-funnel' => 'e9cd',
		'icomoon-game-controller' => 'e9ce',
		'icomoon-gauge' => 'e9cf',
		'icomoon-github' => 'e9d0',
		'icomoon-github-with-circle' => 'e9d1',
		'icomoon-globe' => 'e9d2',
		'icomoon-google-drive' => 'e9d3',
		'icomoon-google-hangouts' => 'e9d4',
		'icomoon-google-play' => 'e9d5',
		'icomoon-google-plus' => 'e9d6',
		'icomoon-google-plus-with-circle' => 'e9d7',
		'icomoon-graduation-cap' => 'e9d8',
		'icomoon-grid' => 'e9d9',
		'icomoon-grid2' => 'e9da',
		'icomoon-grooveshark' => 'e9db',
		'icomoon-hair-cross' => 'e9dc',
		'icomoon-hand' => 'e9dd',
		'icomoon-heart' => 'e9de',
		'icomoon-heart-outlined' => 'e9df',
		'icomoon-help' => 'e9e0',
		'icomoon-help-with-circle' => 'e9e1',
		'icomoon-home' => 'e9e2',
		'icomoon-hour-glass' => 'e9e3',
		'icomoon-houzz' => 'e9e4',
		'icomoon-html-five' => 'e9e5',
		'icomoon-html-five2' => 'e9e6',
		'icomoon-icloud' => 'e9e7',
		'icomoon-IE' => 'e9e8',
		'icomoon-image' => 'e9e9',
		'icomoon-image-inverted' => 'e9ea',
		'icomoon-images' => 'e9eb',
		'icomoon-inbox' => 'e9ec',
		'icomoon-infinite' => 'e9ed',
		'icomoon-infinite-with-circle' => 'e9ee',
		'icomoon-info' => 'e9ef',
		'icomoon-info-with-circle' => 'e9f0',
		'icomoon-instagram' => 'e9f1',
		'icomoon-instagram-with-circle' => 'e9f2',
		'icomoon-install' => 'e9f3',
		'icomoon-key' => 'e9f4',
		'icomoon-keyboard' => 'e9f5',
		'icomoon-lab-flask' => 'e9f6',
		'icomoon-landline' => 'e9f7',
		'icomoon-language' => 'e9f8',
		'icomoon-laptop' => 'e9f9',
		'icomoon-lastfm' => 'e9fa',
		'icomoon-lastfm-with-circle' => 'e9fb',
		'icomoon-layers' => 'e9fc',
		'icomoon-leaf' => 'e9fd',
		'icomoon-level-down' => 'e9fe',
		'icomoon-level-up' => 'e9ff',
		'icomoon-lifebuoy' => 'ea00',
		'icomoon-light-bulb' => 'ea01',
		'icomoon-light-down' => 'ea02',
		'icomoon-light-up' => 'ea03',
		'icomoon-line-graph' => 'ea04',
		'icomoon-link' => 'ea05',
		'icomoon-linkedin' => 'ea06',
		'icomoon-linkedin-with-circle' => 'ea07',
		'icomoon-list' => 'ea08',
		'icomoon-list-ordered' => 'ea09',
		'icomoon-list-unordered' => 'ea0a',
		'icomoon-location' => 'ea0b',
		'icomoon-location-pin' => 'ea0c',
		'icomoon-lock' => 'ea0d',
		'icomoon-lock-open' => 'ea0e',
		'icomoon-login' => 'ea0f',
		'icomoon-log-out' => 'ea10',
		'icomoon-loop' => 'ea11',
		'icomoon-magnet' => 'ea12',
		'icomoon-magnifying-glass' => 'ea13',
		'icomoon-mail' => 'ea14',
		'icomoon-mail-with-circle' => 'ea15',
		'icomoon-man' => 'ea16',
		'icomoon-map' => 'ea17',
		'icomoon-mask' => 'ea18',
		'icomoon-medal' => 'ea19',
		'icomoon-medium' => 'ea1a',
		'icomoon-medium-with-circle' => 'ea1b',
		'icomoon-megaphone' => 'ea1c',
		'icomoon-menu' => 'ea1d',
		'icomoon-merge' => 'ea1e',
		'icomoon-message' => 'ea1f',
		'icomoon-mic' => 'ea20',
		'icomoon-minus' => 'ea21',
		'icomoon-mixi' => 'ea22',
		'icomoon-mobile' => 'ea23',
		'icomoon-modern-mic' => 'ea24',
		'icomoon-moon' => 'ea25',
		'icomoon-mouse' => 'ea26',
		'icomoon-mouse-pointer' => 'ea27',
		'icomoon-music' => 'ea28',
		'icomoon-network' => 'ea29',
		'icomoon-new' => 'ea2a',
		'icomoon-new-message' => 'ea2b',
		'icomoon-news' => 'ea2c',
		'icomoon-newsletter' => 'ea2d',
		'icomoon-new-tab' => 'ea2e',
		'icomoon-note' => 'ea2f',
		'icomoon-notification' => 'ea30',
		'icomoon-notifications-off' => 'ea31',
		'icomoon-old-mobile' => 'ea32',
		'icomoon-old-phone' => 'ea33',
		'icomoon-onedrive' => 'ea34',
		'icomoon-open-book' => 'ea35',
		'icomoon-opera' => 'ea36',
		'icomoon-palette' => 'ea37',
		'icomoon-paper-plane' => 'ea38',
		'icomoon-paypal' => 'ea39',
		'icomoon-pencil' => 'ea3a',
		'icomoon-phone' => 'ea3b',
		'icomoon-picasa' => 'ea3c',
		'icomoon-pie-chart' => 'ea3d',
		'icomoon-pin' => 'ea3e',
		'icomoon-pinterest' => 'ea3f',
		'icomoon-pinterest-with-circle' => 'ea40',
		'icomoon-plus' => 'ea41',
		'icomoon-popup' => 'ea42',
		'icomoon-power-plug' => 'ea43',
		'icomoon-price-ribbon' => 'ea44',
		'icomoon-price-tag' => 'ea45',
		'icomoon-price-tag2' => 'ea46',
		'icomoon-price-tags' => 'ea47',
		'icomoon-print' => 'ea48',
		'icomoon-progress-empty' => 'ea49',
		'icomoon-progress-full' => 'ea4a',
		'icomoon-progress-one' => 'ea4b',
		'icomoon-progress-two' => 'ea4c',
		'icomoon-publish' => 'ea4d',
		'icomoon-qq' => 'ea4e',
		'icomoon-qq-with-circle' => 'ea4f',
		'icomoon-quote' => 'ea50',
		'icomoon-radio' => 'ea51',
		'icomoon-raft' => 'ea52',
		'icomoon-raft-with-circle' => 'ea53',
		'icomoon-rainbow' => 'ea54',
		'icomoon-rdio' => 'ea55',
		'icomoon-rdio-with-circle' => 'ea56',
		'icomoon-reddit' => 'ea57',
		'icomoon-remove-user' => 'ea58',
		'icomoon-renren' => 'ea59',
		'icomoon-reply' => 'ea5a',
		'icomoon-reply-all' => 'ea5b',
		'icomoon-resize-100-percent' => 'ea5c',
		'icomoon-resize-full-screen' => 'ea5d',
		'icomoon-retweet' => 'ea5e',
		'icomoon-rocket' => 'ea5f',
		'icomoon-round-brush' => 'ea60',
		'icomoon-rss' => 'ea61',
		'icomoon-ruler' => 'ea62',
		'icomoon-safari' => 'ea63',
		'icomoon-save' => 'ea64',
		'icomoon-scissors' => 'ea65',
		'icomoon-scribd' => 'ea66',
		'icomoon-search' => 'ea67',
		'icomoon-select-arrows' => 'ea68',
		'icomoon-share' => 'ea69',
		'icomoon-shareable' => 'ea6a',
		'icomoon-share-alternative' => 'ea6b',
		'icomoon-shield' => 'ea6c',
		'icomoon-shop' => 'ea6d',
		'icomoon-shopping-bag' => 'ea6e',
		'icomoon-shopping-basket' => 'ea6f',
		'icomoon-shopping-cart' => 'ea70',
		'icomoon-shuffle' => 'ea71',
		'icomoon-signal' => 'ea72',
		'icomoon-sina-weibo' => 'ea73',
		'icomoon-skype' => 'ea74',
		'icomoon-skype-with-circle' => 'ea75',
		'icomoon-slideshare' => 'ea76',
		'icomoon-smashing' => 'ea77',
		'icomoon-sound' => 'ea78',
		'icomoon-soundcloud' => 'ea79',
		'icomoon-sound-mix' => 'ea7a',
		'icomoon-sound-mute' => 'ea7b',
		'icomoon-spinner' => 'ea7c',
		'icomoon-spinner2' => 'ea7d',
		'icomoon-sports-club' => 'ea7e',
		'icomoon-spotify' => 'ea7f',
		'icomoon-spotify-with-circle' => 'ea80',
		'icomoon-spreadsheet' => 'ea81',
		'icomoon-squared-cross' => 'ea82',
		'icomoon-squared-minus' => 'ea83',
		'icomoon-squared-plus' => 'ea84',
		'icomoon-stack' => 'ea85',
		'icomoon-stackoverflow' => 'ea86',
		'icomoon-star' => 'ea87',
		'icomoon-star-outlined' => 'ea88',
		'icomoon-steam' => 'ea89',
		'icomoon-steam2' => 'ea8a',
		'icomoon-stopwatch' => 'ea8b',
		'icomoon-stumbleupon' => 'ea8c',
		'icomoon-stumbleupon-with-circle' => 'ea8d',
		'icomoon-suitcase' => 'ea8e',
		'icomoon-swap' => 'ea8f',
		'icomoon-swarm' => 'ea90',
		'icomoon-sweden' => 'ea91',
		'icomoon-switch' => 'ea92',
		'icomoon-tablet' => 'ea93',
		'icomoon-tablet-mobile-combo' => 'ea94',
		'icomoon-tag' => 'ea95',
		'icomoon-text' => 'ea96',
		'icomoon-text-document' => 'ea97',
		'icomoon-text-document-inverted' => 'ea98',
		'icomoon-thermometer' => 'ea99',
		'icomoon-thumbs-down' => 'ea9a',
		'icomoon-thumbs-up' => 'ea9b',
		'icomoon-thunder-cloud' => 'ea9c',
		'icomoon-ticket' => 'ea9d',
		'icomoon-time-slot' => 'ea9e',
		'icomoon-tools' => 'ea9f',
		'icomoon-traffic-cone' => 'eaa0',
		'icomoon-trash' => 'eaa1',
		'icomoon-trashcan' => 'eaa2',
		'icomoon-tree' => 'eaa3',
		'icomoon-triangle-down' => 'eaa4',
		'icomoon-triangle-left' => 'eaa5',
		'icomoon-triangle-right' => 'eaa6',
		'icomoon-triangle-up' => 'eaa7',
		'icomoon-tripadvisor' => 'eaa8',
		'icomoon-trophy' => 'eaa9',
		'icomoon-truck' => 'eaaa',
		'icomoon-tumblr' => 'eaab',
		'icomoon-tumblr-with-circle' => 'eaac',
		'icomoon-tv' => 'eaad',
		'icomoon-twitter' => 'eaae',
		'icomoon-twitter-with-circle' => 'eaaf',
		'icomoon-typing' => 'eab0',
		'icomoon-uninstall' => 'eab1',
		'icomoon-unread' => 'eab2',
		'icomoon-untag' => 'eab3',
		'icomoon-upload' => 'eab4',
		'icomoon-upload-to-cloud' => 'eab5',
		'icomoon-user' => 'eab6',
		'icomoon-users' => 'eab7',
		'icomoon-v-card' => 'eab8',
		'icomoon-video' => 'eab9',
		'icomoon-video-camera' => 'eaba',
		'icomoon-vimeo' => 'eabb',
		'icomoon-vimeo-with-circle' => 'eabc',
		'icomoon-vine' => 'eabd',
		'icomoon-vine-with-circle' => 'eabe',
		'icomoon-vinyl' => 'eabf',
		'icomoon-vk' => 'eac0',
		'icomoon-vk-alternitive' => 'eac1',
		'icomoon-vk-with-circle' => 'eac2',
		'icomoon-voicemail' => 'eac3',
		'icomoon-volume-decrease' => 'eac4',
		'icomoon-volume-high' => 'eac5',
		'icomoon-volume-increase' => 'eac6',
		'icomoon-volume-low' => 'eac7',
		'icomoon-volume-medium' => 'eac8',
		'icomoon-volume-mute' => 'eac9',
		'icomoon-volume-mute2' => 'eaca',
		'icomoon-wallet' => 'eacb',
		'icomoon-warning' => 'eacc',
		'icomoon-water' => 'eacd',
		'icomoon-windows-store' => 'eace',
		'icomoon-wordpress' => 'eacf',
		'icomoon-xing' => 'ead0',
		'icomoon-xing-with-circle' => 'ead1',
		'icomoon-yahoo' => 'ead2',
		'icomoon-yahoo2' => 'ead3',
		'icomoon-yelp' => 'ead4',
		'icomoon-youko' => 'ead5',
		'icomoon-youko-with-circle' => 'ead6',
		'icomoon-youtube' => 'ead7',
		'icomoon-youtube-with-circle' => 'ead8',
	);
	$count = count( $icomoon );
?>
	<section id="icon-pack" class="clearfix">
		<div class="icon-filter form-group <?php echo t_em_grid( '7' ) ?>">
			<p class="lead"><?php printf( __( 'Browse in more than <strong>%s</strong> icons in the list below', 't_em_all' ), $count ) ?></p>
			<label for="icon-filter" class="sr-only"><?php _e( 'Search Icons', 't_em_all' ) ?></label>
			<input id="icon-filter" class="form-control form-control-lg" type="text" name="filter" placeholder="<?php _e( 'Search Icons...', 't_em_all' ) ?>">
		</div>
		<div class="icon-list">
<?php
	foreach ( $icomoon as $key => $value ) :
		$icon = str_replace( 'icomoon-', '', $key );
?>
			<div class="icon-wrapper" data-icon="<?php echo $icon ?>">
				<div class="icon">
					<p class="icon-brand"><span class="<?php echo $key ?>"></span></p>
					<label for="icon-key-<?php echo $key ?>"><?php _e( 'Class:', 't_em_all' ) ?></label>
					<input id="icon-key-<?php echo $key ?>" class="form-control form-control-sm" type="text" value="<?php echo $key ?>" readonly>
					<label for="icon-hex-<?php echo $value ?>"><?php _e( 'Hex:', 't_em_all' ) ?></label>
					<input id="icon-hex-<?php echo $value ?>" class="form-control form-control-sm" type="text" value="<?php echo $value ?>" readonly>
				</div>
			</div>
<?php
	endforeach;
?>
		</div>
	</section>
<?php
}
add_action( 't_em_action_post_content_after', 't_em_all_icomoon_demo' );
?>
