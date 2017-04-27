$(document).ready(function() {
	var cost = $('.cost');
	var costButton = $('.menu__item--modal');
	var costClose = $('.cost__close');
	var costBuy1 = $('#price-button1');
	var costBuy2 = $('#price-button2');
	var oneTicket = $('#one_ticket');
	var twoTickets = $('#two_tickets');
	var costRegistration = $('.modal-registration');


	$(costButton).click(function() {
		$(cost).toggleClass('hide'),
		$(cost).addClass('fadeInDown');
	})

	$(costClose).click(function() {
		$(cost).addClass('hide');
	})

	$(costBuy1).click(function() {
		$(cost).addClass('hide'),
		$(costRegistration).removeClass('hide'),
		$(costRegistration).addClass('fadeInDown'),
		$(oneTicket).attr("checked", true);
	})

	$(costBuy2).click(function() {
		$(cost).addClass('hide'),
		$(costRegistration).removeClass('hide'),
		$(costRegistration).addClass('fadeInDown'),
		$(twoTickets).attr("checked", true);
	})
});