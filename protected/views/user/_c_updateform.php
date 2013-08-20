<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery.Jcrop.css" />
<script type="text/javascript" rel="stylesheet" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.Jcrop.js"></script>
<script type="text/javascript" rel="stylesheet" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.form.js"></script>
<script type="text/javascript" rel="stylesheet" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.scrollto.js"></script>
<div style="float: left;border:0px solid red;overflow:hidden;padding:15px;width:50%;">
				<!-- edit profile form -->	
				<div class="form">
				
					
							<?php 
								if(Yii::app()->user->hasFlash('success'))
									echo '<div class="info" style="color:red">'.Yii::app()->user->getFlash('success').'</div>';
							 	if(Yii::app()->user->hasFlash('error'))
								echo '<div class="info_error" style="color:red">'.Yii::app()->user->getFlash('error').'</div>'; 
							?>
				</div>
					<div style="width:100%;font-weight:bold;padding-top:10px;padding-left:5px;text-align:center;">
						Personal Information
					</div>
					<div style="border:0px solid red;overflow:hidden;padding:10px;width:100%;">
						<div style="float: left;border:0px solid red;width:100%;overflow:hidden;">
							
							<div style="float: left;margin-left:80px;">
								
				<div style="font-weight:bold;">Buyer/Seller profile pic</div><br/>
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
					'enableAjaxValidation'=>false,
					'htmlOptions'=>array('enctype'=>'multipart/form-data',)
				)); ?>
					<?php echo CHtml::hiddenField('hidden_logo',$model->logo); ?>
					<?php echo CHtml::hiddenField('type',$model->type); ?>
					<div style="border:0px solid red;overflow:hidden;padding:10px;width:100%;">
						<div style="float: left;border:0px solid red;width:100%;overflow:hidden;">
							<div style="margin-left:20px;border:0px solid red;overflow:hidden;">
								<div class="form">
								
	<div class="row">
		<ul class="regirest_form_row">
			<li class="regirest_form_row_li_1"><?php echo $form->labelEx($model,'first_name',array('style'=>'height:25px;padding-top:3px;top:1px;font-size:15px;font-weight:bold;')); ?></li>
			<li class="regirest_form_row_li_2"><?php echo $form->textField($model,'first_name',array('size'=>30,'maxlength'=>255,'class'=>'regirest_text')); ?></li>
			<li class="regirest_form_row_li_3"><?php echo $form->error($model,'first_name'); ?></li>
		</ul>
	</div>
<div class="clear"></div>
	<div class="row">
		<ul class="regirest_form_row">
			<li class="regirest_form_row_li_1"><?php echo $form->labelEx($model,'last_name',array('style'=>'height:25px;padding-top:3px;top:1px;font-size:15px;font-weight:bold;')); ?></li>
			<li class="regirest_form_row_li_2"><?php echo $form->textField($model,'last_name',array('size'=>30,'maxlength'=>255,'class'=>'regirest_text')); ?></li>
			<li class="regirest_form_row_li_3"><?php echo $form->error($model,'last_name'); ?></li>
		</ul>
	</div>
	<div class="clear"></div>
	<div class="row">
		<ul class="regirest_form_row">
			<li class="regirest_form_row_li_1"><?php echo $form->labelEx($model,'email',array('style'=>'height:25px;padding-top:3px;top:1px;font-size:15px;font-weight:bold;')); ?></li>
			<li class="regirest_form_row_li_2"><?php echo $form->textField($model,'email',array('size'=>30,'maxlength'=>255,'class'=>'regirest_text')); ?></li>
			<li class="regirest_form_row_li_3"><?php echo $form->error($model,'email'); ?>
			<?php if(Yii::app()->user->hasFlash('error_email_exists')){echo '<div class="errorMessage">'.Yii::app()->user->getFlash('error_email_exists').'</div>'; }?>
			</li>
		</ul>
	</div>
	<div class="clear"></div>
	<div class="row">
		<ul class="regirest_form_row">
			<li class="regirest_form_row_li_1"><?php echo $form->labelEx($model,'mobile',array('style'=>'height:25px;padding-top:3px;top:1px;font-size:15px;font-weight:bold;')); ?></li>
			<li class="regirest_form_row_li_2"><?php echo $form->textField($model,'mobile',array('size'=>30,'maxlength'=>255,'class'=>'regirest_text')); ?></li>
			<li class="regirest_form_row_li_3"><?php echo $form->error($model,'mobile'); ?></li>
		</ul>
	</div>
	<div class="clear"></div>
	<div class="row">
		<ul class="regirest_form_row">	
			<li class="regirest_form_row_li_1"><?php echo $form->labelEx($model,'state',array('style'=>'height:25px;padding-top:3px;top:1px;font-size:15px;font-weight:bold;')); ?></li>
			<li class="regirest_form_row_li_2"><?php echo $form->dropDownList($model,'state',User::itemAlias('state'),array('style'=>'width:222px;')); ?></li>
			<li class="regirest_form_row_li_3"><?php echo $form->error($model,'state'); ?></li>
		</ul>
	</div>
	<div class="clear"></div>
	<div class="row">
		<ul class="regirest_form_row">
			<li class="regirest_form_row_li_1"><?php echo $form->labelEx($model,'city',array('style'=>'height:25px;padding-top:-3px;font-size:15px;font-weight:bold;')); ?></li>
			<li class="regirest_form_row_li_2"><?php echo $form->textField($model,'city',array('size'=>30,'maxlength'=>255,'class'=>'regirest_text')); ?></li>
			<li class="regirest_form_row_li_3"><?php echo $form->error($model,'city'); ?></li>
		</ul>
	</div>
								</div>
							</div>
						</div>
						
					</div>
	
	
	</div>
			<div style="float: left;border:0px solid red;width:45%;overflow:hidden;margin-left:5px;padding-top:10px;">
				<div style="border:0px solid #ffcccc;width:100%;overflow:hidden;">
					<div style="width:100%;font-weight:bold;padding-top:10px;padding-left:5px;text-align:center;">
						I want to
					</div>
					<div style="padding-top:10px;padding-left:10px;">

<div class="row">
	<ul class="regirest_form_row">
		<li class="regirest_form_row_li_1"><?php echo $form->labelEx($model,'buyorsell',array('style'=>'height:25px;padding-top:3px;top:1px;font-size:15px;font-weight:bold;')); ?></li>
		<li class="regirest_form_row_li_2"><?php echo $form->radioButtonList($model,'buyorsell',array('1'=>'Buy','2'=>'Sell'),array('separator'=>'&nbsp','labelOptions'=>array('class'=>'labelForRadio'))); ?></li>
		<li class="regirest_form_row_li_3"><?php echo $form->error($model,'buyorsell'); ?></li>
	</ul>
</div>

<div class="row">
	<ul class="regirest_form_row">
		<li class="regirest_form_row_li_1"><?php echo $form->labelEx($model,'property_type',array('style'=>'height:25px;padding-top:3px;top:1px;font-size:15px;font-weight:bold;')); ?></li>
		<li class="regirest_form_row_li_2"><?php echo $form->radioButtonList($model,'property_type',array('1'=>'Single Family Home ','2'=>'Townhome','3'=>'Condominium','4'=>'Multi-Dwelling','5'=>'High Rise')); ?></li>
		<li class="regirest_form_row_li_3"><?php echo $form->error($model,'property_type'); ?></li>
	</ul>
</div>
<div style="height:20px;clear:both;"></div>

<div class="row">
	<ul class="regirest_form_row">
		<li class="regirest_form_row_li_1" style='height:25px;padding-top:3px;top:1px;font-size:15px;font-weight:bold;'>Price Range</li>
		<li class="regirest_form_row_li_2" >
			<?php echo $form->textField($model,'price_from',array('size'=>10,'maxlength'=>55,'class'=>'regirest_text')); ?> - 
			<?php echo $form->textField($model,'price_to',array('size'=>10,'maxlength'=>55,'class'=>'regirest_text')); ?>
		</li>
		<li class="regirest_form_row_li_3" style='width:90%;margin-left:160px;'><?php echo $form->error($model,'price_from'); ?></li>
	</ul>
</div>
<div class="clear"></div>
<div class="row">
	<ul class="regirest_form_row">
		<li class="regirest_form_row_li_1" style='height:25px;padding-top:3px;top:1px;font-size:15px;font-weight:bold;'>Sqft Range</li>
		<li class="regirest_form_row_li_2">
			<?php echo $form->textField($model,'sqft_from',array('size'=>10,'maxlength'=>55,'class'=>'regirest_text')); ?> - 
			<?php echo $form->textField($model,'sqft_to',array('size'=>10,'maxlength'=>55,'class'=>'regirest_text')); ?>
		</li>
		<li class="regirest_form_row_li_3" style='width:90%;margin-left:160px;'><?php echo $form->error($model,'sqft_from'); ?><?php echo $form->error($model,'sqft_to'); ?></li>
	</ul>
</div>
<div class="clear"></div>
<div class="row">
	<ul class="regirest_form_row">
		<li class="regirest_form_row_li_1"><?php echo $form->labelEx($model,'beds',array('style'=>'height:25px;padding-top:3px;top:1px;font-size:15px;font-weight:bold;')); ?></li>
		<li class="regirest_form_row_li_2"><?php echo $form->dropDownList($model,'beds',array(1=>1,2=>2,3=>3,4=>4,5=>5,6=>6,7=>7,8=>8,9=>9,10=>10,11=>11,12=>12,13=>13,14=>14,15=>15),array('style'=>'width:180px;')); ?></li>
		<li class="regirest_form_row_li_3"><?php echo $form->error($model,'beds'); ?></li>
	</ul>
</div>
<div class="clear"></div>
<div class="row">
	<ul class="regirest_form_row">
		<li class="regirest_form_row_li_1"><?php echo $form->labelEx($model,'baths',array('style'=>'height:25px;padding-top:3px;top:1px;font-size:15px;font-weight:bold;')); ?></li>
		<li class="regirest_form_row_li_2">
		<select id="User_baths" name="User[baths]" style="width:180px;">
<option value="0.5" <?php if($model->baths == 0.5)echo 'selected';?> >0.5</option>
<option value="1" <?php if($model->baths == 1)echo 'selected';?> >1</option>
<option value="1.5" <?php if($model->baths == 1.5)echo 'selected';?> >1.5</option>
<option value="2" <?php if($model->baths == 2)echo 'selected';?> >2</option>
<option value="2.5" <?php if($model->baths == 2.5)echo 'selected';?> >2.5</option>
<option value="3" <?php if($model->baths == 3)echo 'selected';?> >3</option>
<option value="3.5" <?php if($model->baths == 3.5)echo 'selected';?> >3.5</option>
<option value="4" <?php if($model->baths == 4)echo 'selected';?> >4</option>
<option value="4.5" <?php if($model->baths == 4.5)echo 'selected';?> >4.5</option>
<option value="5" <?php if($model->baths == 5)echo 'selected';?> >5</option>
<option value="5.5" <?php if($model->baths == 5.5)echo 'selected';?> >5.5</option>
<option value="6" <?php if($model->baths == 6)echo 'selected';?> >6</option>
<option value="6.5" <?php if($model->baths == 6.5)echo 'selected';?> >6.5</option>
<option value="7" <?php if($model->baths == 7)echo 'selected';?> >7</option>
<option value="7.5" <?php if($model->baths == 7.5)echo 'selected';?> >7.5</option>
<option value="8" <?php if($model->baths == 8)echo 'selected';?> >8</option>
<option value="8.5" <?php if($model->baths == 8.5)echo 'selected';?> >8.5</option>
<option value="9" <?php if($model->baths == 9)echo 'selected';?> >9</option>
<option value="9.5" <?php if($model->baths == 9.5)echo 'selected';?> >9.5</option>
<option value="10" <?php if($model->baths == 10)echo 'selected';?> >10</option>
</select>
		<li class="regirest_form_row_li_3"><?php echo $form->error($model,'baths'); ?></li>
	</ul>
</div>
<div class="clear"></div>
<div class="row">
	<ul class="regirest_form_row">
		<li class="regirest_form_row_li_1"><?php echo $form->labelEx($model,'levels',array('style'=>'height:25px;padding-top:3px;top:1px;font-size:15px;font-weight:bold;')); ?></li>
		<li class="regirest_form_row_li_2"><?php echo $form->dropDownList($model,'levels',array('1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9'),array('style'=>'width:180px;')); ?></li>
		<li class="regirest_form_row_li_3"><?php echo $form->error($model,'levels'); ?></li>
	</ul>
</div>
<div class="clear"></div>
<div class="row">
	<ul class="regirest_form_row">
		<li class="regirest_form_row_li_1"><?php echo $form->labelEx($model,'pool',array('style'=>'height:25px;padding-top:3px;top:1px;font-size:15px;font-weight:bold;')); ?></li>
		<li class="regirest_form_row_li_2"><?php echo $form->dropDownList($model,'pool',array('1'=>'YES','2'=>'NO'),array('style'=>'width:180px;')); ?></li>
		<li class="regirest_form_row_li_3"><?php echo $form->error($model,'pool'); ?></li>
	</ul>
</div>

					</div>
				</div>
			</div><div style="clear:both;"></div>

            <div class="row">
			  <ul class="regirest_form_row">
			   <li class="regirest_form_row_li_1"><a href="/user/delprofile">Delete Profile</a></li>
			  </ul>

			</div>


			<div class="row buttons" style="float:right;margin:10px;margin-right:45px;" id="button_save">
							<?php echo CHtml::imageButton('/images/save.png'); ?>
						</div>
				<?php $this->endWidget(); ?>
				<!-- edit profile form -->
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
			
