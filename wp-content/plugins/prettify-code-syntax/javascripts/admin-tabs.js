jQuery(function($) {
	var tabs = $('.plugin-tabs');
	var panels = $('.content-tab', tabs);
	panels.not('.content-tab-active').hide();
	var links = $('.nav-tab', tabs);
	links.click(function (e) {
		e.preventDefault();
		links.removeClass('nav-tab-active'); 
		$(this).addClass('nav-tab-active');
		panels.removeClass('content-tab-active').hide();
		$($(this).attr('href')).addClass('content-tab-active').show();
	});
});