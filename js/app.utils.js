/**
 * Twenty'em All
 *
 * @package			WordPress
 * @subpackage		Twenty'em All: Javascript
 * @author			RogerTM
 * @license			license.txt
 * @link			https://themingisprose.com/twenty-em
 * @since 			Twenty'em All 1.0
 */

jQuery(document).ready(function($) {
	// Make GitHub panels same hight
	function t_em_all_github_panel(){
		var l_h = $('#github-left').css('height')
			r_h = $('#github-right').css('height')
			w 	= $(window).width()
			h	= ( l_h > r_h ) ? l_h : r_h
			z	= 992;
		if ( h && w >= z ){
			$('#github-left, #github-right').css('height',h);
		}
	}
	t_em_all_github_panel();

	$(window).resize(function(){
		t_em_all_github_panel();
	});
});
