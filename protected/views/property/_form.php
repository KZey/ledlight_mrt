<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'property-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype'=>'multipart/form-data',)
)); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'ml_num'); ?>
		<?php echo $form->textField($model,'ml_num'); ?>
		<?php echo $form->error($model,'ml_num'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'price'); ?>
		<?php echo $form->textField($model,'price',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'price'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'house_size'); ?>
		<?php echo $form->textField($model,'house_size'); ?>
		<?php echo $form->error($model,'house_size'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lot_size'); ?>
		<?php echo $form->textField($model,'lot_size'); ?>
		<?php echo $form->error($model,'lot_size'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'property_type'); ?>
		<?php echo $form->dropDownList($model,'property_type',array(1=>'SFH',2=>'Condominium',3=>'Townhouse',4=>'Mulit-dwelling',5=>'High-rise'),array('style'=>'width:305px;')); ?>
		<?php echo $form->error($model,'property_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'selling_status'); ?>
		<?php echo $form->dropDownList($model,'selling_status',array(1=>'Exclusive Rights,aka available for sale',2=>'Sold',3=>'Pending Sale'),array('style'=>'width:305px;')); ?>
		<?php echo $form->error($model,'selling_status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'property_status'); ?>
		<?php echo $form->dropDownList($model,'property_status',array(1=>'Bank Owned',2=>'Short Sale',3=>'New Construction',4=>'Recently Sold',5=>'Rental'),array('style'=>'width:305px;')); ?>
		<?php echo $form->error($model,'property_status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'beds'); ?>
		<?php echo $form->dropDownList($model,'beds',array(1=>1,2=>2,3=>3,4=>4,5=>5,6=>6,7=>7,8=>8,9=>9),array('style'=>'width:180px;')); ?>
		<?php echo $form->error($model,'beds'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'baths'); ?>
		<?php echo $form->dropDownList($model,'baths',array(1=>1,2=>2,3=>3,4=>4,5=>5,6=>6,7=>7,8=>8,9=>9),array('style'=>'width:180px;')); ?>
		<?php echo $form->error($model,'baths'); ?>
	</div>

	
	<div class="row">
		<?php echo $form->labelEx($model,'pool'); ?>
		<?php echo $form->dropDownList($model,'pool',array(1=>'YES',2=>'NO'),array('style'=>'width:180px;')); ?>
		<?php echo $form->error($model,'pool'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'levels'); ?>
		<?php echo $form->dropDownList($model,'property_type',array(1=>1,2=>2,3=>3,4=>4,5=>5,6=>6,7=>7,8=>8,9=>9),array('style'=>'width:180px;')); ?>
		<?php echo $form->error($model,'levels'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'basement'); ?>
		<?php echo $form->dropDownList($model,'basement',array(1=>'YES',2=>'NO'),array('style'=>'width:180px;')); ?>
		<?php echo $form->error($model,'basement'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'address'); ?>
		<?php echo $form->textField($model,'address',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'address'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'desc'); ?>
		<?php echo $form->textArea($model,'desc',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'desc'); ?> 
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'logo'); ?>
		<?php echo $form->fileField($model,'logo',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'logo'); ?> 
	</div>
	
	<div class="row">
		<a href="javascript:void(0);" id="add_photo_link">Add Photos</a>
		<?php echo $form->hiddenField($model,'photos',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'photos'); ?>
	</div>
	
	

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<div id="upForms_div" style="display:none;height:500px;padding:10px;">
	<div id="upForms">
		<form id="fileitemdiv1" action="/property/repairUpload" method="post" enctype="multipart/form-data" target="upload_target">
			<input type="file" name="repair_attached_file1" />
			&nbsp;<input type="submit" name="submitBtn" value='Upload' />
			<span id="upload_repairinfo_success1" style="color:red;"></span>
			<input type="hidden" name="selectedIndex" value="1" />
			<input type="hidden" name="upload_save_to_db_id" id="upload_save_to_db_id1" value="0" />
		</form>
		<iframe id="upload_target" name="upload_target" src="#" style="width:0;height:0;border:0px solid #fff;"></iframe>
	</div>
	<div><a href="javascript:void(0);" onclick="addfile();">Add</a></div>
</div>
	
<script>
$(function() {
	$("#add_photo_link").click(function(){
		$("#upForms_div").zxxbox({title:'Add Photos',drag:true,width:500});
	});
});
var filecount=1;
function addfile(){
	var filediv = document.getElementById("upForms");
	var fileitemdiv = document.createElement("form");
	filecount++;
	var content = "<input type=file name=repair_attached_file"+
	filecount + ">&nbsp;&nbsp;<input type=submit name=submitBtn value='Upload' />&nbsp;&nbsp;<a href='javascript:removefile("+
	filecount + ");'>Delete</a>&nbsp;&nbsp;<span id=upload_repairinfo_success"+
	filecount + " style='color:red;'></span><input type=hidden value="+
	filecount + " name=selectedIndex /> <input type=hidden name=upload_save_to_db_id id=upload_save_to_db_id"+
	filecount + " value=0 />";

	fileitemdiv.id       = "fileitemdiv"+filecount;
	fileitemdiv.method   = "post";
	fileitemdiv.enctype  = "multipart/form-data";
	fileitemdiv.target   = "upload_target";
	fileitemdiv.action   = "/property/repairUpload";
	fileitemdiv.innerHTML = content;
	filediv.appendChild(fileitemdiv);
}

function removefile(fileIndex){
	var id = document.getElementById("upload_save_to_db_id"+fileIndex).value;
	var ids = document.getElementById("Property_photos").value;
	alert(id);
	alert(ids);
	if(ids != '' && id != '')
	{
		ids.replace(id,"");
		alert(ids);
	}
	
	document.getElementById("Property_photos").value = ids;
	
	var filediv = document.getElementById("upForms");
	var fileitemdiv = document.getElementById("fileitemdiv"+fileIndex);
	filediv.removeChild(fileitemdiv);
}

function successUpload(responseText,id,fileIndex){
	var ids = document.getElementById("Property_photos").value;
	if(ids == '')
		document.getElementById("Property_photos").value = id;
	else
		document.getElementById("Property_photos").value = ids+','+id;

	document.getElementById("upload_save_to_db_id"+fileIndex).value = id;

	var spanObj = document.getElementById("upload_repairinfo_success"+fileIndex);
	spanObj.innerHTML = responseText;
}

function stopUpload(responseText,fileIndex){
	var spanObj = document.getElementById("upload_repairinfo_success"+fileIndex);
	spanObj.innerHTML = responseText;
}
</script>