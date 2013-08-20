function show_div_invite(){
	$("#div_addevents").zxxbox({title:'Calendar: Add An Event',drag:true,width:450});
}
function show_powerFloat(id,key){
	$("#event_"+id).powerFloat({width: 250, reverseSharp: true,target: $("#event_detail_"+key) });
}

$(function() {
	//$(".phpc-add").click(function(){
	//	show_div_invite();
	//});
	
});