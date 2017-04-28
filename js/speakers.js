$(document).ready(function() {
	var speaker1 = $('#speaker1');
	var speaker2 = $('#speaker2');
	var speakerDetails1 = $('#speaker-modal1');
	var speakerDetails2 = $('#speaker-modal2');
	var speakerClose = $('.speaker-details__close');

	$(speaker1).click(function() {
		$(speakerDetails1).removeClass('hide'),
		$(speakerDetails1).addClass('zoomIn');
	})

	$(speaker2).click(function() {
		$(speakerDetails2).removeClass('hide'),
		$(speakerDetails2).addClass('zoomIn');
	})

	$(speakerClose).click(function() {
		$(speakerDetails1).addClass('hide'),
		$(speakerDetails2).addClass('hide');
	})
});