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
				
				<!-- edit profile form -->
	<?php if(Yii::app()->user->hasFlash('Rupdate_success'))echo '<script>alert("'.Yii::app()->user->getFlash('Rupdate_success').'");</script>'; ?>
					
					<div style="border:0px solid red;overflow:hidden;padding:10px;width:100%;">
						<div style="float: left;border:0px solid red;width:90%;overflow:hidden;">
							<p style="font-weight:bold;">Agent avatar</p>
							<div style="margin-top:10px;">
							

			
                <div class="rel mb20">
                	<div style="float:left;width:60%;"><img id="xuwanting" src="<?php echo '/upload/user_logo/'.$model->logo?>" /></div>
                    <div id="preview_box" style="width:150px; height:150px; overflow:hidden;margin-left:10px;">
                    	<img id="crop_preview" style="display:none;" src="<?php echo '/upload/user_logo/'.$model->logo?>" />
                    </div>
                </div>
                    <input type="hidden" id="x" name="x" />
                    <input type="hidden" id="y" name="y" />
                    <input type="hidden" id="w" name="w" />
                    <input type="hidden" id="h" name="h" />
                    <input type="hidden" id="img_path" name="img_path" value="<?php echo '/upload/user_logo/'.$model->logo?>" />
                    <div class="clear"></div>
           
           
		           <div style="border:0px red solid;">
							&nbsp;Select a photo from your computer to use as your avatar.<br/>
							<form id="UpLoadForm" name="UpLoadForm" action='/user/uploadavatar' method="post" enctype='multipart/form-data'>
								<div style="float:left;margin-top:10px;">
										<div class="" style="position: relative; overflow: hidden;float:left">
										<img src="/images/upload_main_photo_blue.png" />
										<input type="file" multiple="multiple"  id="User_logo" name="User_logo" 
										 	style="position: absolute; right: 0px; top: 0px; font-family: Arial;
												 font-size: 118px; margin: 0px; padding: 3px; cursor: pointer; opacity: 0;">
												<img src="/images/loading_1.gif"  style="display:none;margin:10px;" id="div_loading" />
										</div>
								</div>
							</form>
					</div>
					<div class="clear"></div>
					<div style="border:0px red solid;margin-top:20px;">
						&nbsp;Use the cropping tool in the image above. <br/>
						&nbsp;Click the finish button below to set your avatar.<br/>
						<input type="image" id="crop_submit" src="/images/submit_main_blue.png" />
					</div>
				
						
							
							
							</div>
						</div>
					</div>
				<?php $form=$this->beginWidget('CActiveForm', array(
					'id'=>'user-form',
						'action'=>'/user/rupdate',
					'enableAjaxValidation'=>false,
					'htmlOptions'=>array('enctype'=>'multipart/form-data',)
				)); ?>
					<?php echo CHtml::hiddenField('hidden_logo',$model->logo); ?>
					<?php echo CHtml::hiddenField('type',$model->type); ?>
					<div style="border:0px solid red;overflow:hidden;padding:10px;width:100%;">
						<div style="float: left;border:0px solid red;overflow:hidden;">
							<p style="font-weight:bold;"><?php echo $form->labelEx($model,'about'); ?></p>
							<div style="">
								<?php echo $form->textArea($model,'about',array('rows'=>6, 'cols'=>80)); ?>
								<?php echo $form->error($model,'about'); ?>
							</div>
						</div>
					</div>	
					<div style="border:0px solid red;overflow:hidden;padding:10px;width:100%;">
						<div style="float: left;border:0px solid red;width:100%;overflow:hidden;">
							<p style="font-weight:bold;">Personal Information</p>
							<div style="border:0px solid red;overflow:hidden;color:#000;margin-top:10px;">
								
								<div style="float: left;border:0px solid red;width:100%;">
									<div style="float:left;width:45%;">
										<div style="width:25%;float: left;">First Name</div>
										<div>
											<?php echo $form->textField($model,'first_name',array('size'=>25,'maxlength'=>255)); ?>
											<?php echo $form->error($model,'first_name'); ?>
										</div>
									</div>
									<div style="float:left;width:45%;">
										<div style="width:25%;float: left;">Office Phone</div>
										<div>
											<?php echo $form->textField($model,'office',array('size'=>25,'maxlength'=>255)); ?>
											<?php echo $form->error($model,'office'); ?>
										</div>
									</div>
								</div>
								<div style="clear:both;height:10px;"></div>
								<div style="float: left;border:0px solid red;width:100%;">
									<div style="float:left;width:45%;">
										<div style="width:25%;float: left;">Last Name</div>
										<div>
											<?php echo $form->textField($model,'last_name',array('size'=>25,'maxlength'=>255)); ?>
											<?php echo $form->error($model,'last_name'); ?>
										</div>
									</div>
									<div style="float:left;width:45%;">
										<div style="width:25%;float: left;">Mobile Phone</div>
										<div>
											<?php echo $form->textField($model,'mobile',array('size'=>25,'maxlength'=>255)); ?>
											<?php echo $form->error($model,'mobile'); ?>
										</div>
									</div>
								</div>
								<div style="clear:both;height:10px;"></div>
								<div style="float: left;border:0px solid red;width:100%;">
									<div style="float:left;width:45%;">
										<div style="width:25%;float: left;">Email</div>
										<div>
											<?php echo $form->textField($model,'email',array('size'=>25,'maxlength'=>255)); ?>
											<?php echo $form->error($model,'email'); ?>
										</div>
									</div>
									<div style="float:left;width:45%;">
										<div style="width:25%;float: left;">Fax</div>
										<div>
											<?php echo $form->textField($model,'fax',array('size'=>25,'maxlength'=>255)); ?>
											<?php echo $form->error($model,'fax'); ?>
										</div>
									</div>
								</div>
								<div style="clear:both;height:10px;"></div>
								<div style="float: left;border:0px solid red;width:100%;">
									<div style="float:left;width:45%;">
										<div style="width:25%;float: left;">Brokerage</div>
										<div>
											<?php echo $form->textField($model,'broker',array('size'=>25,'maxlength'=>255)); ?>
											<?php echo $form->error($model,'broker'); ?>
										</div>
									</div>
									<div style="float:left;width:45%;">
										<div style="width:25%;float: left;">State</div>
										<div>
											<?php echo $form->dropDownList($model,'state',User::itemAlias('state'),array('style'=>'width:187px;')); ?>
											<?php echo $form->error($model,'state'); ?>
										</div>
									</div>
								</div>
								<div style="clear:both;height:10px;"></div>
								<div style="float: left;border:0px solid red;width:100%;">
									<div style="float:left;width:45%;">
										<div style="width:25%;float: left;">Team</div>
										<div>
											<?php echo $form->textField($model,'team',array('size'=>25,'maxlength'=>255)); ?>
											<?php echo $form->error($model,'team'); ?>
										</div>
									</div>
									<div style="float:left;width:45%;">
										<div style="width:25%;float: left;">City</div>
										<div>
											<?php echo $form->textField($model,'city',array('size'=>25,'maxlength'=>255)); ?>
											<?php echo $form->error($model,'city'); ?>
										</div>
									</div>
								</div>
								<div style="clear:both;height:10px;"></div>
								<div style="float: left;border:0px solid red;width:100%;">
										Facebook UserName&nbsp;
										<?php echo $form->textField($model,'facebook_uname',array('size'=>25,'maxlength'=>255,'style'=>'width:425px;')); ?>
										<?php echo $form->error($model,'facebook_uname'); ?>
								</div>
								<div style="clear:both;height:10px;"></div>
								<div style="float: left;border:0px solid red;width:100%;">
										Twitter UserName&nbsp;&nbsp;&nbsp;&nbsp;
										<?php echo $form->textField($model,'twitter_uname',array('size'=>25,'maxlength'=>255,'style'=>'width:425px;')); ?>
										<?php echo $form->error($model,'twitter_uname'); ?>
								</div>
								<div style="clear:both;height:10px;"></div>
								<div style="float: left;border:0px solid red;width:100%;">
									<div style="float: left;">
										<?php echo $form->labelEx($model,'Email Signature',array('style'=>'font-weight:normal;')); ?>
									</div>
									<div style="float: left;margin-left:12px;">
										<?php echo $form->textArea($model,'signature',array('rows'=>6, 'style'=>'width:492px;')); ?>
									</div>
									<?php echo $form->error($model,'signature'); ?>
								</div>
							</div>
						</div>
						<div class="row buttons" style="float:left;margin-top:10px;" id="button_save">
							<?php echo CHtml::imageButton('/images/save.png'); ?> 
						</div>

						<div style="clear:both;height:10px;"></div>
                        <div style="float: left;border:0px solid red;width:100%;">
                        <a href="/user/delprofiler"    >Delete Profile</a></div>


					</div>
					
					
				<?php $this->endWidget(); ?>
			
				<!-- edit profile form -->
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
