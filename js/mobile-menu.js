$(document).ready(function() {
	var menuButton = $('.header__menu-button');
	var menuNav = $('.menu');


	$(menuButton).click(function() {
		$(menuNav).toggleClass('menu--hide');
	})
});