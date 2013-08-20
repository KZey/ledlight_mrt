function show_div_invite(){
	$("#div_invite_button").zxxbox({title:'Enroll a client',drag:true,width:400});
}
function show_send_email(){
	$("#div_send_email").zxxbox({title:'New Email Message',drag:true,width:500});
}

function getTitle()
{
	kdocTitle = document.title;
	if(kdocTitle == null){ 
	    var t_titles = document.getElementByTagName("title") 
	    if(t_titles && t_titles.length >0) 
	    { 
	       kdocTitle = t_titles[0]; 
	    }else{ 
	       kdocTitle = ""; 
	    } 
	} 	
	return kdocTitle;
}
$(function() {
	$("input[type=text]").attr('autocomplete','off');
	$("#menu_dashboard").click(function(){
		location.href="/user";
	});
	$("#menu_property").click(function(){
		location.href="/property";
	});
	$("#menu_realtor").click(function(){
		location.href="/user/rlist";
	});
	//*************Property Logo  Start*************//
	$("#upload_photo").click(function(){
		$('#Property_logo').click();
	});
	$("#Property_logo").change(function(){
		$("#upload_photo").after('&nbsp;&nbsp;' + $('#Property_logo').val());
	});
	//*************Property Logo  End*************//
	
	$("#a_sendmsg").click(function(){
		$.webox({
			height:280,
			width:600,
			bgvisibel:true,
			title:'Send a Message',
			html:$("#div_sendmsg").html()
		});
	});
	
	//*************r_index invite_email  Start*************//
	$("#invite_email").focus(function(){
		var value_invite_email = $("#invite_email").val();
		if(value_invite_email == '' || value_invite_email == 'Enter email address')
		{
			$("#invite_email").val('');
		}
	});
	$("#invite_email").blur(function(){
		var value_invite_email = $("#invite_email").val();
		if(value_invite_email == '')
		{
			$("#invite_email").val('Enter email address');
		}
	});
	$("#invite_button").click(function(){
		/*var value_invite_email = $("#invite_email").val();
		if(value_invite_email == '' || value_invite_email == 'Enter email address')
		{
			alert('The email address is blank.');
			return false;
		}*/
		///$("#hidden_invite").val(1);
		//$.cookie('sssssssss',1, { path: '/user/', expires: 1 });
		//location.href="/user/rindex";
		show_div_invite();
//		$("#div_invite_button").zxxbox({title:'Enroll a client',drag:true,width:400});
	});
	//*************r_index invite_email  End*************//
	
	//*************r_index send_email  Start*************//
	$("#send_email_button").click(function(){
		$("#div_send_email").zxxbox({title:'New Email Message',drag:true,width:500});
	});
	//*************r_index send_email  End*************//
	
});
function initInput(id,initText,oldClass)
{
	classColor_cccccc = (oldClass == '') ? 'color_cccccc' : oldClass+' color_cccccc';
	classColor_000000 = (oldClass == '') ? 'color_cccccc' : oldClass+' color_000000';
	var objID = $("#"+id);
	objID.val(initText);
	objID.attr('class',classColor_cccccc);
	objID.focus(function(){
		if(objID.val() == initText)
		{
			objID.val('');
			objID.attr('class',classColor_000000);
		}
	});
	objID.blur(function(){
		if(objID.val() == '')
		{
			objID.val(initText);
			objID.attr('class',classColor_cccccc);
		}
	});
}
function checkInputInitText(id,initText)
{
	var objID = $("#"+id);
	if(objID.val() == initText)objID.val('');
}
function isInteger(strArg) {
    return (strArg.match(/[^0-9]/g));
}
function trim(w) {
    while (w.length > 0 
           && (w.substr(0,1) == ' ' || w.substr(0,1) == '　')) {
          w = w.substr(1);
    }
    while (w.length>0 
           && (w.substr(w.length-1) == ' ' || w.substr(w.length-1) == '　')) {
        w = w.substr(0, w.length-1);
    }
    return(w);
}
function isBlankTrimed(field) {
    strTrimmed = trim(field);
    if (strTrimmed.length > 0) {
        return false;
    }
    return true;
}

function getNumberWithCommas(_number ) {
    var val = _number + '';
    var x = val.split('.'),
        x1 = x[0],
        x2 = x.length > 1 ? '.' + x[1] : '',
        rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return x1 + x2;
}
function format_number(input_id)
{
	var number = $("#"+input_id).val()
	if(number != '')
	{
		new_price = getNumberWithCommas(stripNonNumeric(number));
		$("#"+input_id).val(new_price);
	}
}
function format_number_span(span_id)
{
	var number = $("#"+span_id).html()
	if(number != '')
	{
		new_price = getNumberWithCommas(stripNonNumeric(number));
		$("#"+span_id).html(new_price);
	}
}
function stripNonNumeric( str )
{
  str += '';
  var rgx = /^d|.|-$/;
  var out = '';
  for( var i = 0; i < str.length; i++ )
  {
    if( rgx.test( str.charAt(i) ) ){
      if( !( ( str.charAt(i) == ',') ) ){
        out += str.charAt(i);
      }
    }
  }
  return out;
}
function invite_yes(uid)
{
	$.get("/inbox/sendjoin", {action:"get",uid:uid}, 
			function (data, textStatus){
			alert(data);
			window.location.reload();
		});
}
function invite_accept(uid)
{
	$.get("/inbox/inviteaccept", {action:"get",uid:uid}, 
			function (data, textStatus){
			alert(data);
		});
}