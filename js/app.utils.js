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

	// make code pretty
	$(function(){
		var $window = $(window)
		window.prettyPrint && prettyPrint()
	});
	$('.prettyprint').addClass('linenums');
	$('.prettyprint.nolinenums').removeClass('linenums');


	// Move title attr to rel attr
	$(function(){
		$('pre').each(function(index){
			var $pre	= $(this);
			var $title	= ( $pre.prop('title') ) ? $pre.prop('title') : 'code';
			$pre.attr({
				'rel':$title
			});
			$pre.removeAttr('title');
		});
	});

	$('.comment-body pre').wrapInner('<code></code>');

	$(window).resize(function(){
		t_em_all_github_panel();
	});
});
