$(document).ready(function() {  
    var calculator = function() {
        var tickets = $("input[name='tickets']").val();
        var calc = $(".modal-registration__result");

	    var dateNow = new Date();
	    var currentMonth = dateNow.getMonth() + 1;
	    var currentDay = dateNow.getDate();
	    var itemIndex;
	    
        var result;

        switch(currentMonth){
	        case 4:
		        itemIndex = 1;
		        break;
	        case 5:
		        itemIndex = 2;
		        break;
	    	case 6:
		    	if (currentDay < 20) {
		    		itemIndex = 3;
		    	}
		    	if (currentDay >= 20 ) {
		    		itemIndex = 4;
		    	}
		        break;
		    default:
		    	itemIndex = 0;
		    	break;
        }

        var one_day_price = parseInt($('#one_day_price li:eq(' + itemIndex + ') p').text());
        var two_days_price = parseInt($('#two_days_price li:eq(' + itemIndex + ') p').text());

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