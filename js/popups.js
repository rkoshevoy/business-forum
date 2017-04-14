$(document).ready(function() {
	var popupButton1 = $('.contact__button--first');
	var popupButton2 = $('.contact__button--second');
	var popupButton3 = $('.contact__button--third');
	var popupInfo1 = $('.contact__info--first');
	var popupInfo2 = $('.contact__info--second');
	var popupInfo3 = $('.contact__info--third');
	var popupHide1 = $('.contact__hide--first');
	var popupHide2 = $('.contact__hide--second');
	var popupHide3 = $('.contact__hide--third');
	var popupHide = $('.hide');


	$(popupButton1).click(function() {
		$(popupInfo1).toggleClass('hide');
	})

	$(popupHide1).click(function() {
		$(popupInfo1).addClass('hide');
	})

	$(popupButton2).click(function() {
		$(popupInfo2).toggleClass('hide');
	})

	$(popupHide2).click(function() {
		$(popupInfo2).addClass('hide');
	})

	$(popupButton3).click(function() {
		$(popupInfo3).toggleClass('hide');
	})

	$(popupHide3).click(function() {
		$(popupInfo3).addClass('hide');
	})
}); 