$(document).ready(function() {
	var regButton = $('.header__button');
	var regNav = $('.modal-registration');
	var regClose = $('.modal-registration__close');


	$(regButton).click(function() {
		$(regNav).toggleClass('hide');
	})

	$(regClose).click(function() {
		$(regNav).addClass('hide');
	})
});