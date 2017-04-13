$(document).ready(function() {
	var regButton = $('.header__button');
	var regNav = $('.modal-registration');
	var regClose = $('.modal-registration');


	$(regButton).click(function() {
		$(regNav).removeClass('hide');
	})

	$(regClose).click(function() {
		$(regNav).addClass('hide');
	})
});