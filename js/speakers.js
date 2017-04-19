$(document).ready(function() {
	var speaker = $('.speaker');
	var speakerDetails = $('.speaker-details');
	var speakerClose = $('.speaker-details__close');

	$(speaker).click(function() {
		$(speakerDetails).removeClass('hide'),
		$(speakerDetails).addClass('zoomIn');
	})

	$(speakerClose).click(function() {
		$(speakerDetails).addClass('hide');
	})
});