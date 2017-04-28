$(document).ready(function() {
	var missionMore = $('.question__more-button');
	var missionDetails = $('.mission-details');
	var missionClose = $('.mission-details__close');

	$(missionMore).click(function() {
		$(missionDetails).removeClass('hide'),
		$(missionDetails).addClass('zoomIn');
	})

	$(missionClose).click(function() {
		$(missionDetails).addClass('hide');
	})
});