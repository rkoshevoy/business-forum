$(document).ready(function () {
	var businessMore = $('.business-missions__more');
	var businessLess = $('.business-missions__less');
	var businessShowTablet = $('.business-missions__tablet');
	var businessShowDesktop = $('.business-missions__desktop');
	var businessShowAll = $('.question--hidden');

	$(businessMore).click(function () {
		$(businessShowTablet).slideDown().css('display', 'inline-block'),
		$(businessShowDesktop).slideDown().css('display', 'inline-block'),
		$(businessShowAll).slideDown().css('display', 'inline-block').removeClass('hide'),
		$(businessMore).css('display', 'none'),
		$(businessLess).css('display', 'block');
	})

	$(businessLess).click(function () {
		$(businessShowTablet).slideUp().css('display', 'none'),
		$(businessShowDesktop).slideUp().css('display', 'none'),
		$(businessShowAll).slideUp().addClass('hide'),
		$(businessLess).css('display', 'none'),
		$(businessMore).css('display', 'block');
	});
}); 