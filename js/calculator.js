$(document).ready(function() {
	function calculator() {
        var tickets = $("input[name='tickets']").val(),
        	calc = $(".modal-registration__result"),
	    	itemIndex,
        	result,
            dateNow = new Date(),
            currentDay = dateNow.getDate();

        if (currentDay < 20) itemIndex = 0;
        if (currentDay >= 20 ) itemIndex = 1;

        var one_day_price = parseInt($('#one_day_price li:eq(' + itemIndex + ') p').text());
        var two_days_price = parseInt($('#two_days_price li:eq(' + itemIndex + ') p').text());
        var one_day_price_with_coffee = parseInt($('#one_day_price_second li:eq(' + itemIndex + ') p').text());
        var two_days_price_with_coffee = parseInt($('#two_days_price_second li:eq(' + itemIndex + ') p').text());

        if ($('#one_ticket').is(":checked")) result = tickets * one_day_price; 
        if ($('#two_tickets').is(":checked")) result = tickets * two_days_price;
        if ($('#one_ticket_second').is(":checked")) result = tickets * one_day_price_with_coffee;
        if ($('#two_tickets_second').is(":checked")) result = tickets * two_days_price_with_coffee;

        if (tickets > 2) result *= 0.85;

        $(calc).text(result + " грн").val();
        $("input[name='summ']").val(result);
    };

    $('body').on('keyup', 'input[name="tickets"]', calculator);
    $('body').on('click', '#one_ticket, #two_tickets, #one_ticket_second, #two_tickets_second', calculator);
});