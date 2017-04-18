$(document).ready(function() {
	var speaker = $('.speaker');
	var speakerDetails = $('.speaker-details');
	var speakerClose = $('.speaker-details__close');

	$(speaker).click(function() {
		$(speakerDetails).toggleClass('hide'),
		$(speakerDetails).toggleClass('zoomIn');
	})
});