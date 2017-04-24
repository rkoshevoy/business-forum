$(document).ready(function() {  
	$("input[name='tickets_count']").on('input keyup', function() {

		var tickets = $(this).val(); 
		var calc = $(".modal-registration__result");
		var result;

		result = tickets * 4000; 

		$(calc).text(result + " грн").val();
	})

	$("input[name='tickets']").change(function(){
		var inputVal;
		var res;
		var myValue = $(this).val();

		if($("input[name='tickets']").val()){
			inputVal = $("input[name='tickets_count']").val();
			res = inputVal * myValue;
		}
		else {
			res = 0;
		}

		$(".modal-registration__result").text(res + " грн");
	})
});