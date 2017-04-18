$(document).ready(function() {
	var faq1 = $('#faq1');
	var faq2 = $('#faq2');
	var faq3 = $('#faq3');
	var faq4 = $('#faq4');
	var faq5 = $('#faq5');
	var faq6 = $('#faq6');
	var faq7 = $('#faq7');
	var faq8 = $('#faq8');
	var faq9 = $('#faq9');
	var faqAnswer1 = $('#faq-answer1');
	var faqAnswer2 = $('#faq-answer2');
	var faqAnswer3 = $('#faq-answer3');
	var faqAnswer4 = $('#faq-answer4');
	var faqAnswer5 = $('#faq-answer5');
	var faqAnswer6 = $('#faq-answer6');
	var faqAnswer7 = $('#faq-answer7');
	var faqAnswer8 = $('#faq-answer8');
	var faqAnswer9 = $('#faq-answer9');
	var faqItem = $('.faq__item');
	var faqAnswer = $('.faq__answer');


	$(faq1).click(function() {
		$(faqItem).removeClass('faq__item--active'),
		$(faq1).addClass('faq__item--active'),
		$(faqAnswer).removeClass('faq__answer-show'),
		$(faqAnswer1).addClass('faq__answer-show'),
		$(faqAnswer1).addClass('fadeIn');		
	})

	$(faq2).click(function() {
		$(faqItem).removeClass('faq__item--active'),
		$(faq2).addClass('faq__item--active'),
		$(faqAnswer).removeClass('faq__answer-show'),
		$(faqAnswer2).addClass('faq__answer-show'),
		$(faqAnswer2).addClass('fadeIn');		
	})

	$(faq3).click(function() {
		$(faqItem).removeClass('faq__item--active'),
		$(faq3).addClass('faq__item--active'),
		$(faqAnswer).removeClass('faq__answer-show'),
		$(faqAnswer3).addClass('faq__answer-show'),
		$(faqAnswer3).addClass('fadeIn');		
	})

	$(faq4).click(function() {
		$(faqItem).removeClass('faq__item--active'),
		$(faq4).addClass('faq__item--active'),
		$(faqAnswer).removeClass('faq__answer-show'),
		$(faqAnswer4).addClass('faq__answer-show'),
		$(faqAnswer4).addClass('fadeIn');		
	})

	$(faq5).click(function() {
		$(faqItem).removeClass('faq__item--active'),
		$(faq5).addClass('faq__item--active'),
		$(faqAnswer).removeClass('faq__answer-show'),
		$(faqAnswer5).addClass('faq__answer-show'),
		$(faqAnswer5).addClass('fadeIn');		
	})

	$(faq6).click(function() {
		$(faqItem).removeClass('faq__item--active'),
		$(faq6).addClass('faq__item--active'),
		$(faqAnswer).removeClass('faq__answer-show'),
		$(faqAnswer6).addClass('faq__answer-show'),
		$(faqAnswer6).addClass('fadeIn');		
	})

	$(faq7).click(function() {
		$(faqItem).removeClass('faq__item--active'),
		$(faq7).addClass('faq__item--active'),
		$(faqAnswer).removeClass('faq__answer-show'),
		$(faqAnswer7).addClass('faq__answer-show'),
		$(faqAnswer7).addClass('fadeIn');		
	})

	$(faq8).click(function() {
		$(faqItem).removeClass('faq__item--active'),
		$(faq8).addClass('faq__item--active'),
		$(faqAnswer).removeClass('faq__answer-show'),
		$(faqAnswer8).addClass('faq__answer-show'),
		$(faqAnswer8).addClass('fadeIn');		
	})

	$(faq9).click(function() {
		$(faqItem).removeClass('faq__item--active'),
		$(faq9).addClass('faq__item--active'),
		$(faqAnswer).removeClass('faq__answer-show'),
		$(faqAnswer9).addClass('faq__answer-show'),
		$(faqAnswer9).addClass('fadeIn');		
	})
});