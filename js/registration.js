$(document).ready(function() {
	var regButton = $('.header__button');
	var regButton2 = $('.first__button');
	var regNav = $('.modal-registration');
	var regClose = $('.modal-registration__close');
	var regMenu = $('.menu');


	$(regButton).click(function() {
		$(regNav).toggleClass('hide'),
		$(regMenu).addClass('menu--hide'),
		$(regNav).addClass('fadeInDown');
	})

	$(regButton2).click(function() {
		$(regNav).toggleClass('hide'),
		$(regNav).addClass('fadeInDown');
	})

	$(regClose).click(function() {
		$(regNav).addClass('hide'),
		$(regNav).addClass('fadeInDown');
	})
}); 