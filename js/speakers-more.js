$(document).ready(function () {
	var speakersMore = $('.speakers__more');
	var speakersLess = $('.speakers__less');
	var speakersShowAll = $('.speaker--hidden');

	$(speakersMore).click(function () {
		$(speakersShowAll).slideDown().css('display', 'inline-block'),
		$(speakersMore).css('display', 'none'),
		$(speakersLess).css('display', 'block');
	})

	$(speakersLess).click(function () {
		$(speakersShowAll).slideUp().addClass('hide'),
		$(speakersLess).css('display', 'none'),
		$(speakersMore).css('display', 'block');
	});
}); 