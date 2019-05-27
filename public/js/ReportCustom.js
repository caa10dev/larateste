

$('#addTypeCondition').change(function(){
	var tpcond = $(this).val();
	drawImputCondition(tpcond);
});

function drawImputCondition(tpcond){
	var inputDraw = new Array();
	var campos =  $('.selctHidden').text();

	var order = '<div class="row linecond">';
	order +='<div class="col-xs-3">'+campos+'</div>';
	order +='<div class="col-xs-3"><input type="radio" name="orderField[1]" value="0"  checked> Ascendente</div>';
	order +='<div class="col-xs-3"><input type="radio" name="orderField[1]" value="1" > Descendente</div>';
	order +='</div>';
	inputDraw['ORDER'] = order;

	var equal ='<div class="row linecond">';
	equal += '<div class="col-xs-4">'+campos+'</div>';
	equal += '<div class="col-xs-1">=</div>';
	equal += '<div class="col-xs-7"><input type="text" name="equalField[]" class="form-control"></div>';
	equal +='</div>';
	inputDraw['='] = equal;

	$('.listConditions').append( inputDraw[tpcond] );
	console.log(tpcond);
	console.log(inputDraw[tpcond]);
}