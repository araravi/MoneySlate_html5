//reset type=date inputs to text
$( document ).bind( "mobileinit", function(){
	$.mobile.page.prototype.options.degradeInputs.date = 'text';
});