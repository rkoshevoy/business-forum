$(document).ready(function() {
	var content = $('.content');
	var visible = $('.visible');
	var hidden = $('.hidden');
	$(content).viewportChecker({
		classToAdd: 'visible animated fadeInUp',
		offset: 100
	});
});