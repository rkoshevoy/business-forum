$(document).ready(function() {
	var menuButton = $('.header__menu-button');
	var menuNav = $('.menu');
	var menuItem = $('.menu__item');
	var menuPrice = $('.cost');
	var menuRegistration = $('.modal-registration');

	$(menuButton).click(function() {
		$(menuItem).addClass('zoomIn'),
		$(menuNav).addClass('fadeInDown'),
		$(menuNav).toggleClass('menu--hide'),
		$(menuPrice).addClass('hide'),
		$(menuRegistration).addClass('hide');
	})

	$(menuItem).click(function() {
		$(menuNav).addClass('menu--hide');
	})
});