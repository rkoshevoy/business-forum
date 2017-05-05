$(document).ready(function() {
	var regButton = $('.header__button');
	var regButton2 = $('.first__button');
	var regNav = $('.modal-registration');
	var regClose = $('.modal-registration__close');
	var regMenu = $('.menu');
	var regCost = $('.cost');


	$(regButton).click(function() {
		$(regNav).toggleClass('hide'),
		$(regMenu).addClass('menu--hide'),
		$(regNav).addClass('fadeInDown');
	})

	$(regButton2).click(function() {
		$(regNav).toggleClass('hide'),
		$(regNav).addClass('fadeInDown'),
		$(regCost).addClass('hide');
	})

	$(regClose).click(function() {
		$(regNav).addClass('hide'),
		$(regNav).addClass('fadeInDown');
	})
}); 