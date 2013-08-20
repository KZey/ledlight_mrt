$(function() {
		$("#header_1").click(function(){
			location.href="/login/register?type=2";
			/*$("#header_1").attr('class','regirest_form_header_1');
			$("#header_2").attr('class','regirest_form_header_2');
			$("#div_state_license").hide();*/
		});
		$("#header_2").click(function(){
			location.href="/login/register?type=1";
			/*$("#header_1").attr('class','regirest_form_header_2');
			$("#header_2").attr('class','regirest_form_header_1');
			$("#div_state_license").show();*/
		});
		$("#User_buyorsell_0").attr('checked','checked');
});