$(document).ready(function() {  
	$("input[name='tickets']").on('input keyup', function() {

		var tickets = $(this).val(); 
		var calc = $(".modal-registration__result");
		var result;

		result = tickets * 4000; 

		$(calc).text(result + " грн").val();
	});

	$("input[name='price']").change(function(){
		var inputVal;
		var res;
		var myValue = $(this).val();

		if($("input[name='price']").val()){
			inputVal = $("input[name='tickets']").val();
			res = inputVal * myValue;
		}
		else {
			res = 0;
		}

		$(".modal-registration__result").text(res + " грн");
	})
});