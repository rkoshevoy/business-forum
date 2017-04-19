$(document).ready(function () {
	var speakersMore = $('.speakers__more');
	var speakersLess = $('.speakers__less');
	var speakersShowTablet = $('.speakers__tablet');
	var speakersShowDesktop = $('.speakers__desktop');
	var speakersShowAll = $('.speakers--hidden');

	$(speakersMore).click(function () {
		$(speakersShowTablet).slideDown().css('display', 'inline-block'),
		$(speakersShowDesktop).slideDown().css('display', 'inline-block'),
		$(speakersShowAll).slideDown().css('display', 'inline-block').removeClass('hide'),
		$(speakersMore).css('display', 'none');
		$(speakersLess).css('display', 'block');
	})

	$(speakerLess).click(function () {
		$(businessShowTablet).slideUp().css('display', 'none'),
		$(businessShowDesktop).slideUp().css('display', 'none'),
		$(businessShowAll).slideUp().addClass('hide'),
		$(businessArrow).removeClass('business-missions__more--less');
	});
});