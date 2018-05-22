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
	// Add version to every download button
	$('body.home .actions .btn, body.home .actions .btn span').each(function(){
		var button 	= $(this),
			str 	= $(button).text();
		if ( str == 'Descargar' ){
			$(button).html( str + ' v' + t_em_all_l10n_app_utils.app_version );
		}
	});

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

	// Hide header on scroll down, show on scroll up
	// http://jsfiddle.net/mariusc23/s6mLJ/31/
	function t_em_all_menu_scroll( target, height ){
		// Hide Header on on scroll down
		var didScroll;
		var lastScrollTop = 0;
		var delta = 5;
		var targetHeight = height;

		$(window).scroll(function(event){
		    didScroll = true;
		});

		setInterval(function() {
		    if (didScroll) {
		        hasScrolled();
		        didScroll = false;
		    }
		}, 250);

		function hasScrolled() {
		    var st = $(this).scrollTop();

		    // Make sure they scroll more than delta
		    if(Math.abs(lastScrollTop - st) <= delta)
		        return;

		    // If they scrolled down and are past the target. Do stuff.
		    // This is necessary so you never see what is "behind" the target.
		    if (st > lastScrollTop && st > targetHeight){
		        // Scroll Down
		        $(target).fadeOut();
		    } else {
		        // Scroll Up
		        if(st + $(window).height() < $(document).height()) {
		            $(target).fadeIn();
		        }
		    }

		    lastScrollTop = st;
		}
	}
	t_em_all_menu_scroll( $('#top-menu'), $('#header').outerHeight() );

	/** Go to top */
	var gotoTop = $('#gototop');
	$(window).scroll(function(){
		if ($('body,html').scrollTop() > Number(450)){
			$(gotoTop).fadeIn();
		}else{
			$(gotoTop).fadeOut();
		}
	});

	/** ScrollTo */
	$('.scroll-to').click(function(e){
		e.preventDefault();
		var element = $(this),
			target = element.attr('data-target');
		$(window).scrollTo(target,{
			duration: 500,
		});
	});

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

	// Add id attr in single entries and anchor'em
	$(function(){
		$('article .entry-content > h1, article .entry-content > h2, article .entry-content > h3, article .entry-content > h4, article .entry-content > h5, article .entry-content > h6').each(function(index){
			var $id = $(this).text().split(' ').join('-').split('"').join('').toLowerCase();
			$(this).attr({
				'id':$id,
				'class':'h-anchor'
			});
			$(this).prepend('<a href="#'+$id+'" class="anchor scroll-to" data-target="#'+$id+'" data-anchorjs-icon="#"></a>').wrapInner('<div></div>');
		});
	});

	// Get some <a> elements
	$('article.doc a').click(function(e){
		var	item	= $(this);
		if ( item.attr('href') == '#' ){
			e.preventDefault();
		}
	});

	// 404 || 403
	$('#post-0.error404 #searchform .input-group').addClass('input-group-lg');

	// Icon Filter
	var $rows = jQuery('.icon-list .icon-wrapper');
	jQuery('#icon-filter').keyup(function() {

	    var val = jQuery.trim(jQuery(this).val()).replace(/ +/g, ' ').toLowerCase();

	    $rows.show().filter(function() {
	        var text = jQuery(this).attr('data-icon').replace(/\s+/g, ' ').toLowerCase();
	        return !~text.indexOf(val);
	    }).hide();
	});

	$('input#icon-filter').focus();

	$(window).resize(function(){
		t_em_all_github_panel();
		t_em_all_menu_scroll( $('#top-menu'), $('#header').outerHeight() );
	});
});
