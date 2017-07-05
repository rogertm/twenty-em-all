<?php
/**
 * Twenty'em All
 *
 * @package			WordPress
 * @subpackage		Twenty'em All: Admin
 * @author			RogerTM
 * @license			license.txt
 * @link			https://twenty-em.themingisprose.com
 * @since 			Twenty'em All 1.0
 */

/**
 * Small features ads options
 * @return array 	Array of options
 *
 * @since Twenty'em All 1.0
 */
function t_em_all_front_page_ads_features_options(){
	$ads = array(
		'ad_one'	=> array(
			'name'		=> 'ad_one',
			'label'		=> __( 'Ad One', 't_em_all' ),
			'data'		=> array(
				'ad_one_headline'	=> '',
				'ad_one_icofont'	=> '',
				'ad_one_content'	=> '',
			),
		),
		'ad_two'	=> array(
			'name'		=> 'ad_two',
			'label'		=> __( 'Ad Two', 't_em_all' ),
			'data'		=> array(
				'ad_two_headline'	=> '',
				'ad_two_icofont'	=> '',
				'ad_two_content'	=> '',
			),
		),
		'ad_three'	=> array(
			'name'		=> 'ad_three',
			'label'		=> __( 'Ad Three', 't_em_all' ),
			'data'		=> array(
				'ad_three_headline'	=> '',
				'ad_three_icofont'	=> '',
				'ad_three_content'	=> '',
			),
		),
		'ad_four'	=> array(
			'name'		=> 'ad_four',
			'label'		=> __( 'Ad Four', 't_em_all' ),
			'data'		=> array(
				'ad_four_headline'	=> '',
				'ad_four_icofont'	=> '',
				'ad_four_content'	=> '',
			),
		),
	);
	/**
	 * Filter the features ads in front page
	 * @param array $ads 	Array of ads
	 *
	 * @since Twenty'em All 1.0
	 */
	return apply_filters( 't_em_all_admin_filter_features_ads', $ads );
}

/**
 * Render the features ads in front page admin panel
 *
 * @since Twenty'em All 1.0
 */
function t_em_all_render_front_page_features_ads(){
	global $t_em;
	$ads = t_em_all_front_page_ads_features_options();
?>
	<div id="t-em-all-features-ads">
		<h3><?php _e( 'Features ads', 't_em_all' ) ?></h3>
<?php foreach ( $ads as $ad ) :
		$data = array_keys( $ad['data'] );
?>
		<div id="t-em-all-<?php echo $ad['name'] ?>" class="sub-extend option-group">
			<div class="layout text-option front-page">
				<header><?php echo $ad['label'] ?></header>
				<p>
					<label>
						<span><?php _e( 'Heading', 't_em_all' ) ?></span>
						<input type="text" class="regular-text headline" name="t_em_theme_options[<?php echo $data[0] ?>]" value="<?php echo $t_em[$data[0]] ?>">
					</label>
				</p>
				<p>
					<label>
						<span><?php _e( 'IcoFont', 't_em_all' ) ?></span>
						<input type="text" class="regular-text" name="t_em_theme_options[<?php echo $data[1] ?>]" value="<?php echo $t_em[$data[1]] ?>">
					</label>
				</p>
				<p>
					<label>
						<span><?php _e( 'Content', 't_em_all' ) ?></span>
						<textarea class="regular-text" name="t_em_theme_options[<?php echo $data[2] ?>]" rows="7"><?php echo $t_em[$data[2]] ?></textarea>
					</label>
				</p>
			</div>
		</div>
<?php endforeach; ?>
	</div>
<?php
}
add_action( 't_em_admin_action_from_page_option_widgets-front-page_before', 't_em_all_render_front_page_features_ads' );

/**
 * Render the neon ad in admin front page panel
 *
 * @since Twenty'em All 1.0
 */
function t_em_all_render_front_page_neon_ad(){
	global $t_em;
?>
	<div id="neon-setting" class="sub-extend option-group text-option">
		<h3><?php _e( 'Neon ad', 't_em_all' ) ?></h3>
		<p>
			<label>
				<span><?php _e( 'Headline', 't_em_all' ) ?></span>
				<input class="regular-text headline" type="text" name="t_em_theme_options[neon_headline]" value="<?php echo $t_em['neon_headline'] ?>">
			</label>
		</p>
		<p>
			<label>
				<span><?php _e( 'Content', 't_em_all' ) ?></span>
				<textarea class="large-text" name="t_em_theme_options[neon_content]" rows="7"><?php echo $t_em['neon_content'] ?></textarea>
			</label>
		</p>
		<p>
			<label>
				<span><?php _e( 'First Button Label', 't_em_all' ) ?></span>
				<input class="regular-text" type="text" name="t_em_theme_options[neon_button_one_label]" value="<?php echo $t_em['neon_button_one_label'] ?>">
			</label>
		</p>
		<p>
			<label>
				<span><?php _e( 'First Button Link', 't_em_all' ) ?></span>
				<input class="regular-text" type="url" name="t_em_theme_options[neon_button_one_link]" value="<?php echo $t_em['neon_button_one_link'] ?>">
			</label>
		</p>
		<p>
			<label>
				<span><?php _e( 'Second Button Label', 't_em_all' ) ?></span>
				<input class="regular-text" type="text" name="t_em_theme_options[neon_button_two_label]" value="<?php echo $t_em['neon_button_two_label'] ?>">
			</label>
		</p>
		<p>
			<label>
				<span><?php _e( 'Second Button Link', 't_em_all' ) ?></span>
				<input class="regular-text" type="url" name="t_em_theme_options[neon_button_two_link]" value="<?php echo $t_em['neon_button_two_link'] ?>">
			</label>
		</p>
	</div>
<?php
}
add_action( 't_em_admin_action_from_page_option_widgets-front-page_after', 't_em_all_render_front_page_neon_ad' );

/**
 * Render the GitHub commint's rss in admin front page panel
 *
 * @since Twenty'em All 1.0
 */
function t_em_all_render_front_page_github_commints(){
	global $t_em;
?>
	<div id="github-setting" class="sub-extend option-group text-option">
		<h3><?php _e( 'GitHub commit\'s RSS', 't_em_all' ) ?></h3>
		<p>
			<label>
				<span><?php _e( 'Headline', 't_em_all' ) ?></span>
				<input class="regular-text headline" type="text" name="t_em_theme_options[github_commits_headline]" value="<?php echo $t_em['github_commits_headline'] ?>">
			</label>
		</p>
		<p>
			<label>
				<span><?php _e( 'RSS', 't_em_all' ) ?></span>
				<input class="regular-text" type="url" name="t_em_theme_options[github_commits_rss]" value="<?php echo $t_em['github_commits_rss'] ?>">
			</label>
		</p>
	</div>
<?php
}
add_action( 't_em_admin_action_from_page_option_widgets-front-page_after', 't_em_all_render_front_page_github_commints' );

/**
 * Fun facts options
 * @return array  	Array of options
 *
 * @since Twenty'em All 1.0
 */
function t_em_all_fun_facts_options(){
	$funs = array(
		'lines_of_code'	=> array(
			'value'		=> 'lines_of_code',
			'label'		=> __( 'Lines of Code', 't_em_all' ),
			'description'	=> __( '<code>$ find . -name "*.php" | xargs wc -l</code>', 't_em_all' ),
			'icon' 		=> 'lines_of_code_icofont',
		),
		'kilobytes'	=> array(
			'value'		=> 'kilobytes',
			'label'		=> __( 'Kilobytes', 't_em_all' ),
			'description'	=> __( 'Kilobytes of this project', 't_em_all' ),
			'icon' 		=> 'kilobytes_icofont',
		),
		'files'	=> array(
			'value'		=> 'files',
			'label'		=> __( 'Files', 't_em_all' ),
			'description'	=> __( 'Amount of files of this project', 't_em_all' ),
			'icon' 		=> 'files_icofont',
		),
		'hours_of_coding'	=> array(
			'value'		=> 'hours_of_coding',
			'label'		=> __( 'Hours of Coding', 't_em_all' ),
			'description'	=> __( 'First commit date, in format <code>YYYY-MM-DD</code>', 't_em_all' ),
			'icon' 		=> 'hours_of_coding_icofont',
		),
	);
	/**
	 * Filter the fun facts in front page
	 * @param array $funs 	Array of fun facts
	 *
	 * @since Twenty'em All 1.0
	 */
	return apply_filters( 't_em_all_admin_filter_fun_facts', $funs );
}

/**
 * Add fun fact "lines of code" to general options admin panel
 *
 * @since Twenty'em All 1.0
 */
function t_em_all_general_options_fun_facts(){
	global $t_em;
	$funs = t_em_all_fun_facts_options();
?>
	<div id="t-em-all-funs-ads">
		<h3><?php _e( 'Features ads', 't_em_all' ) ?></h3>
<?php
	foreach ( $funs as $fun ) :
?>
	<div class="sub-extend option-group">
		<div class="layou text-option front-page">
			<header><?php echo $fun['label']; ?></header>
			<p>
			<label class="description single-option">
				<p class="description"><?php echo $fun['description']; ?></p>
				<input type="text" class="regular-text" name="t_em_theme_options[<?php echo $fun['value'] ?>]" value="<?php echo $t_em[$fun['value']] ?>">
			</label>
			</p>
			<p>
			<label class="description single-option">
				<p><?php _e( 'IcoFont', 't_em_all' ) ?></p>
				<input type="text" class="regular-text" name="t_em_theme_options[<?php echo $fun['icon'] ?>]" value="<?php echo $t_em[$fun['icon']] ?>">
			</label>
			</p>
		</div>
	</div>
<?php
	endforeach;
?>
	</div>
<?php
}
add_action( 't_em_admin_action_from_page_option_widgets-front-page_after', 't_em_all_general_options_fun_facts' );

/**
 * Render the donate ad in admin front page panel
 *
 * @since Twenty'em All 1.0
 */
function t_em_all_render_front_page_donate_ad(){
	global $t_em;
?>
	<div id="donate-setting" class="sub-extend option-group text-option">
		<h3><?php _e( 'Donate ad', 't_em_all' ) ?></h3>
		<p>
			<label>
				<span><?php _e( 'Headline', 't_em_all' ) ?></span>
				<input class="regular-text headline" type="text" name="t_em_theme_options[donate_headline]" value="<?php echo $t_em['donate_headline'] ?>">
			</label>
		</p>
		<p>
			<label>
				<span><?php _e( 'Content', 't_em_all' ) ?></span>
				<textarea class="large-text" name="t_em_theme_options[donate_content]" cols="50" rows="7"><?php echo $t_em['donate_content'] ?></textarea>
			</label>
		</p>
		<p>
			<label>
				<span><?php _e( 'Button Label', 't_em_all' ) ?></span>
				<input class="regular-text" type="text" name="t_em_theme_options[donate_button_label]" value="<?php echo $t_em['donate_button_label'] ?>">
			</label>
		</p>
		<p>
			<label>
				<span><?php _e( 'Button Link', 't_em_all' ) ?></span>
				<input class="regular-text" type="url" name="t_em_theme_options[donate_button_link]" value="<?php echo $t_em['donate_button_link'] ?>">
			</label>
		</p>
	</div>
<?php
}
add_action( 't_em_admin_action_from_page_option_widgets-front-page_after', 't_em_all_render_front_page_donate_ad' );

/**
 * Render the feedburner ad in admin front page panel
 *
 * @since Twenty'em All 1.0
 */
function t_em_all_render_front_page_feedburner_ad(){
	global $t_em;
?>
	<div id="feedburner-setting" class="sub-extend option-group text-option">
		<h3><?php _e( 'FeedBurner ad', 't_em_all' ) ?></h3>
		<p>
			<label>
				<span><?php _e( 'Headline', 't_em_all' ) ?></span>
				<input class="regular-text headline" type="text" name="t_em_theme_options[feedburner_headline]" value="<?php echo $t_em['feedburner_headline'] ?>">
			</label>
		</p>
		<p>
			<label>
				<span><?php _e( 'Content', 't_em_all' ) ?></span>
				<textarea class="large-text" name="t_em_theme_options[feedburner_content]" cols="50" rows="7"><?php echo $t_em['feedburner_content'] ?></textarea>
			</label>
		</p>
		<p>
			<label>
				<span><?php _e( 'Button Label', 't_em_all' ) ?></span>
				<input class="regular-text" type="text" name="t_em_theme_options[feedburner_button_label]" value="<?php echo $t_em['feedburner_button_label'] ?>">
			</label>
		</p>
		<p>
			<label>
				<span><?php _e( 'Button Placeholder', 't_em_all' ) ?></span>
				<input class="regular-text" type="text" name="t_em_theme_options[feedburner_button_placeholder]" value="<?php echo $t_em['feedburner_button_placeholder'] ?>">
			</label>
		</p>
		<p>
			<label>
				<span><?php _e( 'FeedBurner ID', 't_em_all' ) ?></span>
				<input class="regular-text" type="text" name="t_em_theme_options[feedburner_id]" value="<?php echo $t_em['feedburner_id'] ?>">
			</label>
		</p>
	</div>
<?php
}
add_action( 't_em_admin_action_from_page_option_widgets-front-page_after', 't_em_all_render_front_page_feedburner_ad' );
?>
