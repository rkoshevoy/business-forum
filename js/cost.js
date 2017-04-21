$(document).ready(function() {
	var cost = $('.cost');
	var costButton = $('.menu__item--modal');
	var costClose = $('.cost__close');
	var costBuy = $('.price__button');
	var costRegistration = $('.modal-registration');


	$(costButton).click(function() {
		$(cost).toggleClass('hide'),
		$(cost).addClass('fadeInDown');
	})

	$(costClose).click(function() {
		$(cost).addClass('hide');
	})

	$(costBuy).click(function() {
		$(cost).addClass('hide'),
		$(costRegistration).removeClass('hide'),
		$(costRegistration).addClass('fadeInDown');
	})
});