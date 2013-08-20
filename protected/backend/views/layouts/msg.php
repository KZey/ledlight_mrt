<div style="border:0px solid red;width:950px;overflow:hidden;">
	<div style="border:0px solid red;width:100%;overflow:hidden;margin:0 auto;margin-top:3px;z-index:1;">
		<div style="width:100%;overflow:hidden;margin:0 auto;"><br/><br/><br/>
			<div style="border:1px solid #C2C2C2;width:75%;overflow:hidden;margin:0 auto;">
				<div style="padding:5px 0 7px 10px;width:100%;border-bottom:1px solid #C2C2C2;background-image:url(/images/createproperty_title_bg.png);">
					Prompt Information
				</div>
				<div style="float: right;border:0px solid red;overflow:hidden;padding:15px;width:96%;background:#F7F7F7;">
					<div style="height:200px;text-align:center">
						<br/><br/><br/><br/><?php echo $msg;?><br/><br/>
						This page will redirect '<?php echo $page_name;?>' after <span id="span_time">10</span> seconds.
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
$(function() {
	setInterval("changeSecond()",1000);
});
function changeSecond()
{
	var last_num = $("#span_time").html();
	if(last_num > 0)
	{
		var num = last_num - 1;
		for(var i=num+1;i>0;i--)
		{
			$("#span_time").html(num);
		}
	}else{
		location.href="<?php echo $to_url;?>";
	}
}
</script>