<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery.Jcrop.css" />
<script type="text/javascript" rel="stylesheet" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.Jcrop.js"></script>
<script type="text/javascript" rel="stylesheet" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.form.js"></script>
<script type="text/javascript" rel="stylesheet" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.scrollto.js"></script>
<div style="border:0px solid red;width:950px;overflow:hidden;">

	<div class="menu_div">
		<div id="menu_dashboard" style="float:left;" class="menu_li_selected"><img src="/images/menu_dashboard.png" /></div>
		<div id="menu_property" style="float:left;" class="menu_li_default"><img src="/images/menu_property.png" /></div>
		<div id="menu_realtor" style="float:left;" class="menu_li_default"><img src="/images/menu_realtor.png" /></div>
	</div>
	<div style="border:0px solid red;width:100%;overflow:hidden;margin:0 auto;margin-top:3px;z-index:1;">
		<?php echo $this->renderPartial('_Rleft', array('model'=>$model,'modelEmail'=>$modelEmail,'hidden_to_uid'=>$hidden_to_uid)); ?>
		<div style="float: right;border:1px solid #C2C2C2;width:75%;overflow:hidden;">
			
			<div style="padding:8px 0 8px 20px;width:100%;background:#E0E0E0;">
				<img src="/images/rupdate_title.png" />
			</div>
			<div style="float: right;border:0px solid red;overflow:hidden;padding:15px;width:96%;background:#F7F7F7;">
			Please email <a href='mailto:support@myrealtour.com'>support@myrealtour.com</a>
			</div>
		</div>
		
	</div>
</div>
<script>
$(function() {
	
	$("#crop_submit").click(function(){
		var ajaxData = {};
		ajaxData['x'] = $("#x").val();
		ajaxData['y'] = $("#y").val();
		ajaxData['w'] = $("#w").val();
		ajaxData['h'] = $("#h").val();
		ajaxData['img_path'] = $("#img_path").val();
		
		$.ajax({
			type: "post",
			url: '/user/ajaxcrop',
			data: ajaxData,
			success: function(msg) {
				if (msg != 2) {
					$('#xuwanting').attr('src', msg);
					alert("Please press Save to confirm your new avatar");
					$("#button_save").ScrollTo(800);
				}
			}
		});
	});
	
	var jcrop_api;
	//记得放在jQuery(window).load(...)内调用，否则Jcrop无法正确初始化
	$("#xuwanting").Jcrop({
		aspectRatio:1,
		onChange:showCoords,
		onSelect:showCoords
	},function(){
		jcrop_api=this;
	});	
	//简单的事件处理程序，响应自onChange,onSelect事件，按照上面的Jcrop调用
	function showCoords(obj){
		$("#x").val(obj.x);
		$("#y").val(obj.y);
		$("#w").val(obj.w);
		$("#h").val(obj.h);
		if(parseInt(obj.w) > 0){
			//计算预览区域图片缩放的比例，通过计算显示区域的宽度(与高度)与剪裁的宽度(与高度)之比得到
			var rx = $("#preview_box").width() / obj.w; 
			var ry = $("#preview_box").height() / obj.h;
			//通过比例值控制图片的样式与显示
			$("#crop_preview").css({
				width:Math.round(rx * $("#xuwanting").width()) + "px",	//预览图片宽度为计算比例值与原图片宽度的乘积
				height:Math.round(rx * $("#xuwanting").height()) + "px",	//预览图片高度为计算比例值与原图片高度的乘积
				marginLeft:"-" + Math.round(rx * obj.x) + "px",
				marginTop:"-" + Math.round(ry * obj.y) + "px"
			});
		}
	}
	$("#crop_submit").click(function(){
		if(parseInt($("#x").val())){
			$("#crop_form").submit();
			var aa = $("#img_path").val();	
			jcrop_api.setImage(aa);
		}else{
			//alert("要先在图片上划一个选区再单击确认剪裁的按钮哦！");	
		}
	});

	//*************User Logo  Start*************//
	$("#User_logo").change(function(){
		$("#div_loading").show();
		$('#UpLoadForm').ajaxSubmit({
            success: function (html, status) {
            	$("#div_loading").hide();
                var rs = "/upload/user_logo/" + html;
                $("#xuwanting").attr("src",rs);
                $("#crop_preview").attr("src",rs);
                $("#img_path").val(rs);
                $("#hidden_logo").val(html);
                jcrop_api.setImage(rs);
                jcrop_api.setSelect([10,10,100,100]);
            }
        });
		
	});
	//*************User Logo  End*************//
	
});
</script>
