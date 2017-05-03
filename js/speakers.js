$(document).ready(function() {
	var speaker1 = $('#speaker1');
	var speaker2 = $('#speaker2');
	var speaker3 = $('#speaker3');
	var speaker4 = $('#speaker4');
	var speaker5 = $('#speaker5');
	var speaker6 = $('#speaker6');
	var speaker7 = $('#speaker7');
	var speaker8 = $('#speaker8');
	var speaker9 = $('#speaker9');
	var speaker10 = $('#speaker10');
	var speaker11 = $('#speaker11');
	var speakerDetails1 = $('#speaker-modal1');
	var speakerDetails2 = $('#speaker-modal2');
	var speakerDetails3 = $('#speaker-modal3');
	var speakerDetails4 = $('#speaker-modal4');
	var speakerDetails5 = $('#speaker-modal5');
	var speakerDetails6 = $('#speaker-modal6');
	var speakerDetails7 = $('#speaker-modal7');
	var speakerDetails8 = $('#speaker-modal8');
	var speakerDetails9 = $('#speaker-modal9');
	var speakerDetails10 = $('#speaker-modal10');
	var speakerDetails11 = $('#speaker-modal11');
	var speakerClose = $('.speaker-details__close');

	$(speaker1).click(function() {
		$(speakerDetails1).removeClass('hide');
		$(speakerDetails1).addClass('zoomIn');
	})

	$(speaker2).click(function() {
		$(speakerDetails2).removeClass('hide');
		$(speakerDetails2).addClass('zoomIn');
	})

	$(speaker3).click(function() {
		$(speakerDetails3).removeClass('hide');
		$(speakerDetails3).addClass('zoomIn');
	})

	$(speaker4).click(function() {
		$(speakerDetails4).removeClass('hide');
		$(speakerDetails4).addClass('zoomIn');
	})

	$(speaker5).click(function() {
		$(speakerDetails5).removeClass('hide');
		$(speakerDetails5).addClass('zoomIn');
	})

	$(speaker6).click(function() {
		$(speakerDetails6).removeClass('hide');
		$(speakerDetails6).addClass('zoomIn');
	})

	$(speaker7).click(function() {
		$(speakerDetails7).removeClass('hide');
		$(speakerDetails7).addClass('zoomIn');
	})

	$(speaker8).click(function() {
		$(speakerDetails8).removeClass('hide');
		$(speakerDetails8).addClass('zoomIn');
	})

	$(speaker9).click(function() {
		$(speakerDetails9).removeClass('hide');
		$(speakerDetails9).addClass('zoomIn');
	})

	$(speaker10).click(function() {
		$(speakerDetails10).removeClass('hide');
		$(speakerDetails10).addClass('zoomIn');
	})

	$(speaker11).click(function() {
		$(speakerDetails11).removeClass('hide');
		$(speakerDetails11).addClass('zoomIn');
	})

	$(speakerClose).click(function() {
		$(speakerDetails1).addClass('hide');
		$(speakerDetails2).addClass('hide');
		$(speakerDetails3).addClass('hide');
		$(speakerDetails4).addClass('hide');
		$(speakerDetails5).addClass('hide');
		$(speakerDetails6).addClass('hide');
		$(speakerDetails7).addClass('hide');
		$(speakerDetails8).addClass('hide');
		$(speakerDetails9).addClass('hide');
		$(speakerDetails10).addClass('hide');
		$(speakerDetails11).addClass('hide');
	})
});