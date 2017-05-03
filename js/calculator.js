$(document).ready(function() {  
	var calculator = function() {
		var tickets = $("input[name='tickets']").val();
		var calc = $(".modal-registration__result");
		var result;

		var one_day_price = parseInt($('#one_day_price li:eq(4) p').text());
		var two_days_price = parseInt($('#two_days_price li:eq(4) p').text());
		if($('#one_ticket').is(":checked")){
			result = tickets * one_day_price;
		} else if ($('#two_tickets').is(":checked")){
			result = tickets * two_days_price;
		}
		$(calc).text(result + " грн").val();
		$("input[name='summ']").val(result);

	};

	$("input[name='tickets']")
		.keyup(calculator)
		.click(calculator);
	$('#one_ticket').click(calculator);
	$('#two_tickets').click(calculator);
});