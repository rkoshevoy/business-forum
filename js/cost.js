$(document).ready(function() {
	var cost = $('.cost');
	var costButton = $('.menu__item--modal');
	var costClose = $('.cost__close');
	var costBuy1 = $('#price-button1');
	var costBuy2 = $('#price-button2');
	var costBuy3 = $('#price-button3');
	var costBuy4 = $('#price-button4');
	var oneTicket = $('#one_ticket');
	var twoTickets = $('#two_tickets');
	var oneTicketSecond = $('#one_ticket_second');
	var twoTicketsSecond = $('#two_tickets_second');
	var costRegistration = $('.modal-registration');


	$(costButton).click(function() {
		$(cost).toggleClass('hide'),
		$(cost).addClass('fadeInDown'),
		$(costRegistration).addClass('hide');
	})

	$(costClose).click(function() {
		$(cost).addClass('hide');
	})

	$(costBuy1).click(function() {
		$(cost).addClass('hide'),
		$(costRegistration).removeClass('hide'),
		$(costRegistration).addClass('fadeInDown'),
		$(twoTicketsSecond).attr("checked", false),
		$(twoTickets).attr("checked", false),
		$(oneTicketSecond).attr("checked", false),
		$(oneTicket).attr("checked", true);
	})

	$(costBuy2).click(function() {
		$(cost).addClass('hide'),
		$(costRegistration).removeClass('hide'),
		$(costRegistration).addClass('fadeInDown'),
		$(twoTicketsSecond).attr("checked", false),
		$(oneTicket).attr("checked", false),
		$(oneTicketSecond).attr("checked", false),
		$(twoTickets).attr("checked", true);
	})

	$(costBuy3).click(function() {
		$(cost).addClass('hide'),
		$(costRegistration).removeClass('hide'),
		$(costRegistration).addClass('fadeInDown'),
		$(oneTicket).attr("checked", false),
		$(twoTickets).attr("checked", false),
		$(twoTicketsSecond).attr("checked", false),
		$(oneTicketSecond).attr("checked", true);
	})

	$(costBuy4).click(function() {
		$(cost).addClass('hide'),
		$(costRegistration).removeClass('hide'),
		$(costRegistration).addClass('fadeInDown'),
		$(oneTicket).attr("checked", false),
		$(twoTickets).attr("checked", false),
		$(oneTicketSecond).attr("checked", false),
		$(twoTicketsSecond).attr("checked", true);
	})
});