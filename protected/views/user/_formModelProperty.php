<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery.Jcrop.css" />
<script type="text/javascript" rel="stylesheet" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.Jcrop.js"></script>
<script type="text/javascript" rel="stylesheet" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.form.js"></script>
<script type="text/javascript" rel="stylesheet" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.scrollto.js"></script>
<div class="form" style="width:100%;margin:0 auto;">


<!-- Begin: main photo -->	
<div class="row" style="border:0px red solid;">

				<div style="font-weight:bold;">Main photo for property</div><br/>
                <div class="rel mb20">
                	<div style="float:left;width:60%;"><img id="xuwanting" src="<?php echo '/upload/property/'.$modelProperty->logo?>" /></div>
                    <div id="preview_box" style="width:150px; height:150px; overflow:hidden;margin-left:10px;">
                    	<img id="crop_preview" style="display:none;" src="<?php echo '/upload/property/'.$modelProperty->logo?>" />
                    </div>
                </div>
                    <input type="hidden" id="x" name="x" />
                    <input type="hidden" id="y" name="y" />
                    <input type="hidden" id="w" name="w" />
                    <input type="hidden" id="h" name="h" />
                    <input type="hidden" id="img_path" name="img_path" value="<?php echo '/upload/property/'.$modelProperty->logo?>" />
                    <div class="clear"></div><br/>

				<div style="border:0px red solid;">
						&nbsp;Select a photo from your computer to represent this property<br/>
						<form id="UpLoadForm" name="UpLoadForm" action='/user/uploadpropertylogo' method="post" enctype='multipart/form-data'>
							<div style="float:left;margin-top:10px;">
						<div class="" style="position: relative; overflow: hidden;float:left">
						<img src="/images/upload_main_photo_blue.png" />
						<input type="file" multiple="multiple"  id="Property_logo" name="Property_logo" 
						 	style="position: absolute; right: 0px; top: 0px; font-family: Arial;
								 font-size: 118px; margin: 0px; padding: 3px; cursor: pointer; opacity: 0;">
								<img src="/images/loading_1.gif"  style="display:none;margin:10px;" id="div_loading" />
						</div>
							</div>
						</form>
				</div>
				<div class="clear"></div>
				<div style="border:0px red solid;margin-top:20px;">
					&nbsp;Use the cropping tool in the image above.<br/>
					&nbsp;Click the finish button below to set the representative photo for this property.<br/>
					<input type="image" id="crop_submit" src="/images/submit_main_blue.png" />
				</div>
	
</div>
<!-- End: main photo -->
<div class="clear"></div>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'property-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype'=>'multipart/form-data',)
)); ?>
	<?php echo $form->hiddenField($modelProperty,'property_id'); ?>
	<?php echo CHtml::hiddenField('hidden_logo',$modelProperty->logo); ?>
	<div class="row" style="float:left;">
		<?php echo $form->labelEx($modelProperty,'title'); ?>
		<?php echo $form->textField($modelProperty,'title',array('style'=>'width:628px','maxlength'=>255)); ?>
		<?php echo $form->error($modelProperty,'title'); ?>
	</div>
	
	<div class="clear"></div>
	<div class="row" style="float:left;width:240px;">
		<div style="float:left"><?php echo $form->labelEx($modelProperty,'street'); ?></div>
		<div>&nbsp;</div>
		<?php echo $form->textField($modelProperty,'street'); ?>
		<?php echo $form->error($modelProperty,'street'); ?>
	</div>
	<div class="row" style="float:left;width:237px;">
		<div style="float:left"><?php echo $form->labelEx($modelProperty,'apt'); ?></div>
		<div>&nbsp;</div>
		<?php echo $form->textField($modelProperty,'apt'); ?>
		<?php echo $form->error($modelProperty,'apt'); ?>
	</div>
	<div class="row" style="float:left;">
		<?php echo $form->labelEx($modelProperty,'city'); ?>
		<?php echo $form->textField($modelProperty,'city'); ?>
		<?php echo $form->error($modelProperty,'city'); ?>
	</div>
	
	<div class="clear"></div>
	<div class="row" style="float:left;width:240px;">
		<div style="float:left"><?php echo $form->labelEx($modelProperty,'state'); ?></div>
		<div>&nbsp;</div>
		<?php echo $form->dropDownList($modelProperty,'state',User::itemAlias('state'),array('style'=>'width:150px;')); ?>
		<?php echo $form->error($modelProperty,'state'); ?>
	</div>
	<div class="row" style="float:left;width:237px;">
		<div style="float:left"><?php echo $form->labelEx($modelProperty,'zip'); ?></div>
		<div>&nbsp;</div>
		<?php echo $form->textField($modelProperty,'zip'); ?>
		<?php echo $form->error($modelProperty,'zip'); ?>
	</div>
	
	
	<div class="clear"></div>
	<div class="row" style="float:left;width:240px;">
		<?php echo $form->labelEx($modelProperty,'ml_num'); ?>
		<?php echo $form->textField($modelProperty,'ml_num'); ?>
		<?php echo $form->error($modelProperty,'ml_num'); ?>
	</div>
	<div class="row" style="float:left;width:237px;">
		<div style="float:left"><?php echo $form->labelEx($modelProperty,'year_built'); ?></div>
		<div>&nbsp;</div>
		<?php echo $form->textField($modelProperty,'year_built'); ?>
		<?php echo $form->error($modelProperty,'year_built'); ?>
	</div>
	<div class="row" style="float:left;">
		<div style="float:left"><?php echo $form->labelEx($modelProperty,'price'); ?></div>
		<div>&nbsp;</div>
		<?php echo $form->textField($modelProperty,'price'); ?>
		<?php echo $form->error($modelProperty,'price'); ?>
	</div>
	
	<div class="clear"></div>
	<div class="row" style="float:left;width:240px;">
		<div style="float:left"><?php echo $form->labelEx($modelProperty,'house_size'); ?></div>
		<div>&nbsp;(sq ft)</div>
		<?php echo $form->textField($modelProperty,'house_size'); ?>
		<?php echo $form->error($modelProperty,'house_size'); ?>
	</div>
	<div class="row" style="float:left;width:237px;">
		<div style="float:left"><?php echo $form->labelEx($modelProperty,'lot_size'); ?></div>
		<div>&nbsp;(sq ft)</div>
		<?php echo $form->textField($modelProperty,'lot_size'); ?>
		<?php echo $form->error($modelProperty,'lot_size'); ?>
	</div>

	<div class="clear"></div>
	<div class="row" style="float:left;width:240px;">
		<?php echo $form->labelEx($modelProperty,'property_type'); ?>
		<?php echo $form->dropDownList($modelProperty,'property_type',array(1=>'SFH',2=>'Condominium',3=>'Townhouse',4=>'Multi-dwelling',5=>'High-rise'),array('style'=>'width:150px;')); ?>
		<?php echo $form->error($modelProperty,'property_type'); ?>
	</div>

	<div class="row" style="float:left;width:237px;">
		<?php echo $form->labelEx($modelProperty,'selling_status'); ?>
		<?php echo $form->dropDownList($modelProperty,'selling_status',array(1=>'Available',3=>'Pending Sale'),array('style'=>'width:150px;')); ?>
		<?php echo $form->error($modelProperty,'selling_status'); ?>
	</div>
	<div class="row" style="float:left;">
		<?php echo $form->labelEx($modelProperty,'property_status'); ?>
		<?php echo $form->dropDownList($modelProperty,'property_status',array(1=>'Bank Owned',2=>'Short Sale',3=>'New Construction',4=>'Recently Sold',5=>'Rental',6=>'Resale'),array('style'=>'width:150px;')); ?>
		<?php echo $form->error($modelProperty,'property_status'); ?>
	</div>

	<div class="clear"></div>
	<div class="row" style="float:left;width:240px;">
		<?php echo $form->labelEx($modelProperty,'beds'); ?>
		<?php //echo $form->dropDownList($modelProperty,'beds',array(1=>1,2=>2,3=>3,4=>4,5=>5,6=>6,7=>7,8=>8,9=>9,10=>10,11=>11,12=>12,13=>13,14=>14,15=>15),array('style'=>'width:150px;')); 
?>
		<?php echo $form->textField($modelProperty,'beds'); ?>
		<?php echo $form->error($modelProperty,'beds'); ?>
	</div>
	<div class="row" style="float:left;width:237px;">
		<?php echo $form->labelEx($modelProperty,'baths'); ?>
		<?php echo $form->textField($modelProperty,'baths'); ?>
		<!-- 
		<select id="Property_baths" name="Property[baths]" style="width:150px;">
<option value="0.5" <?php if($modelProperty->baths == 0.5)echo 'selected';?> >0.5</option>
<option value="1" <?php if($modelProperty->baths == 1)echo 'selected';?> >1</option>
<option value="1.5" <?php if($modelProperty->baths == 1.5)echo 'selected';?> >1.5</option>
<option value="2" <?php if($modelProperty->baths == 2)echo 'selected';?> >2</option>
<option value="2.5" <?php if($modelProperty->baths == 2.5)echo 'selected';?> >2.5</option>
<option value="3" <?php if($modelProperty->baths == 3)echo 'selected';?> >3</option>
<option value="3.5" <?php if($modelProperty->baths == 3.5)echo 'selected';?> >3.5</option>
<option value="4" <?php if($modelProperty->baths == 4)echo 'selected';?> >4</option>
<option value="4.5" <?php if($modelProperty->baths == 4.5)echo 'selected';?> >4.5</option>
<option value="5" <?php if($modelProperty->baths == 5)echo 'selected';?> >5</option>
<option value="5.5" <?php if($modelProperty->baths == 5.5)echo 'selected';?> >5.5</option>
<option value="6" <?php if($modelProperty->baths == 6)echo 'selected';?> >6</option>
<option value="6.5" <?php if($modelProperty->baths == 6.5)echo 'selected';?> >6.5</option>
<option value="7" <?php if($modelProperty->baths == 7)echo 'selected';?> >7</option>
<option value="7.5" <?php if($modelProperty->baths == 7.5)echo 'selected';?> >7.5</option>
<option value="8" <?php if($modelProperty->baths == 8)echo 'selected';?> >8</option>
<option value="8.5" <?php if($modelProperty->baths == 8.5)echo 'selected';?> >8.5</option>
<option value="9" <?php if($modelProperty->baths == 9)echo 'selected';?> >9</option>
<option value="9.5" <?php if($modelProperty->baths == 9.5)echo 'selected';?> >9.5</option>
<option value="10" <?php if($modelProperty->baths == 10)echo 'selected';?> >10</option>
</select>
 -->
		<?php //echo $form->dropDownList($modelProperty,'baths',array(0.5=>1,1.5=>1.5,2=>2,2=>2.5,3=>3,3=>3.5,4=>4,4=>4.5,5=>5,5=>5.5,6=>6,6=>6.5,7=>7,7=>7.5,8=>8,8=>8.5,9=>9,9.5=>9.5),array('style'=>'width:150px;')); ?>
		<?php echo $form->error($modelProperty,'baths'); ?>
	</div>
	<div class="row" style="float:left;">
		<?php echo $form->labelEx($modelProperty,'pool'); ?>
		<?php echo $form->dropDownList($modelProperty,'pool',array(1=>'YES',2=>'NO'),array('style'=>'width:150px;')); ?>
		<?php echo $form->error($modelProperty,'pool'); ?>
	</div>

	<div class="clear"></div>
	<div class="row" style="float:left;width:240px;">
		<?php echo $form->labelEx($modelProperty,'stories'); ?>
		<?php //echo $form->dropDownList($modelProperty,'stories',array(1=>1,2=>2,3=>3,4=>4,5=>5,6=>6,7=>7,8=>8,9=>9),array('style'=>'width:150px;')); 
?>
		<?php echo $form->textField($modelProperty,'stories'); ?>
		<?php echo $form->error($modelProperty,'stories'); ?>
	</div>
	<div class="row" style="float:left;">
		<?php echo $form->labelEx($modelProperty,'garage'); ?>
		<?php //echo $form->dropDownList($modelProperty,'garage',array(0=>0,1=>1,2=>2,3=>3,4=>4,5=>5),array('style'=>'width:150px;')); 
?>
		<?php echo $form->textField($modelProperty,'garage'); ?>
		<?php echo $form->error($modelProperty,'garage'); ?>
	</div>
	

	
	
	<div class="clear"></div>
	<div class="row">
		<?php echo $form->labelEx($modelProperty,'desc'); ?>
		<?php echo $form->textArea($modelProperty,'desc',array('rows'=>3, 'style'=>'width:695px;')); ?>
		<?php echo $form->error($modelProperty,'desc'); ?> 
	</div>
	<div class="clear"></div>
	
	<div class="row" style="float:left;">
		<?php echo $form->labelEx($modelProperty,'commission_rate'); ?>
		<?php echo $form->textField($modelProperty,'commission_rate'); ?> % 
		<br/>(The commission rate is only for your information and will not be displayed on the listing for this property.)
		<?php echo $form->error($modelProperty,'commission_rate'); ?>
	</div>
	<div class="clear"></div>

<!-- Begin: photo(s) -->
<div style="border:0px red solid;">
	<?php
		 $this->widget('ext.EAjaxUpload.EAjaxUpload',
		array(
		        'id'=>'uploadFile',
		        'config'=>array(
		               'action'=>Yii::app()->createUrl('user/upload'),
		               'allowedExtensions'=>array("jpg","jpeg","gif","png"),
		               'sizeLimit'=>1000*1024*1024,
		               'minSizeLimit'=>1,
						'template'=>'<div class="qq-uploader">
						<div class="qq-upload-drop-area"><span>Drop files here to upload</span></div>
						<div class="qq-upload-button" style="background:#F7F7F7;border:0; width:100%; height:100%"><img src="/images/upload_photos.png" /></div>
						<ul class="qq-upload-list"></ul>
						</div>',
		               'auto'=>true,
		               'multiple' => true,
		               'onComplete'=>"js:function(id, fileName, responseJSON){doPhotos(responseJSON);}",
		               'messages'=>array(
		                                'typeError'=>"{file} has invalid extension. Only {extensions} are allowed.",
		                                'sizeError'=>"{file} is too large, maximum file size is {sizeLimit}.",
		                                'minSizeError'=>"{file} is too small, minimum file size is {minSizeLimit}.",
		                                'emptyError'=>"{file} is empty, please select files again without it.",
		                                'onLeave'=>"The files are being uploaded, if you leave now the upload will be cancelled."
		                               ),
		               'showMessage'=>"js:function(message){ alert(message); }"
		               )
		 
		               ));
		?>
	<div id="show_pic"></div>
	<?php echo $form->hiddenField($modelProperty,'photos',array('style'=>"width:600px;")); ?>
</div>
<!-- End: photo(s) -->

	<div class="clear"></div>
	<div class="row buttons" id="button_save"><?php echo CHtml::imageButton('/images/save.png'); ?></div>
<?php $this->endWidget(); ?>

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
					alert("Please press Save to confirm new main photo");
					$("#button_save").ScrollTo(800);
				}
			}
		});
	});
	
	var jcrop_api;
	//记得放在jQuery(window).load(...)内调用，否则Jcrop无法正确初始化
	$("#xuwanting").Jcrop({
		aspectRatio:4/3,
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
	$("#Property_logo").change(function(){
		$("#div_loading").show();
		$('#UpLoadForm').ajaxSubmit({
            success: function (html, status) {
            	$("#div_loading").hide();
                var rs = "/upload/property/" + html;
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




	
	var old_pic = '';
	<?php if(!empty($modelProperty->photos)){?>
			<?php 
				$array_photos = explode(",", $modelProperty->photos);
				if(count($array_photos)>0)
				{
					for($i=0;$i<count($array_photos);$i++)
					{
						if(!empty($array_photos[$i])){
						?>
						old_pic = old_pic + '<div style="float:left;padding:10px;" id="<?php echo $array_photos[$i];?>_div">';
						old_pic = old_pic + '<img src="/upload/property/<?php echo $array_photos[$i];?>" style="width:100px;height:100px;border:1px solid gray;padding:2px;" />';
						old_pic = old_pic + '<br/><span style="cursor:pointer;" onclick="removefile(\'<?php echo $array_photos[$i];?>\')">Delete</span>';
						old_pic = old_pic + '</div>';
						<?php
					}}
				}
			?>
	<?php }?>
	if(old_pic != '')
	{
		$("#show_pic").append(old_pic);
	}

	format_number('Property_price');
	$("#Property_price").mouseout(function(){format_number('Property_price');});

	format_number('Property_house_size');
	$("#Property_house_size").mouseout(function(){format_number('Property_house_size');});

	format_number('Property_lot_size');
	$("#Property_lot_size").mouseout(function(){format_number('Property_lot_size');});
	
});
function doPhotos(jsonObj)
{
	$('.qq-upload-list').hide();
	var picname = jsonObj.filename;
	var imgHtml = '<div style="float:left;padding:10px;" id="'+picname+'_div">';
	imgHtml = imgHtml + '<img src="/upload/property/'+picname+'" style="width:100px;height:100px;border:1px solid gray;padding:2px;" />';
	imgHtml = imgHtml + '<br/><span style="cursor:pointer;" onclick="removefile(\''+picname+'\')">Delete</span>';
	imgHtml = imgHtml + '</div>';
	$("#show_pic").append(imgHtml);
	var old_pic = $("#Property_photos").val();
	var new_pic = '';
	if(old_pic != '')
	{
		new_pic = old_pic + ","+picname;
	}else{
		new_pic = picname;
	}
	$("#Property_photos").val(new_pic);
}

function removefile(fileIndex){
	var div_pic = document.getElementById(fileIndex+"_div");
	var div_uploadFile = document.getElementById("show_pic");
	div_uploadFile.removeChild(div_pic);

	var ids = document.getElementById("Property_photos").value;
	if(ids != '' && fileIndex != '')
	{
		var new_ids = ids.replace(fileIndex,"");
		document.getElementById("Property_photos").value = new_ids;
	}
}

</script>