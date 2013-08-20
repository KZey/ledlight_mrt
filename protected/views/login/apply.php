<div id="login_cont" style="border:0px solid red;overflow:hidden;width:100%;">
	<div style="float:right;width:100%;border:0px solid red;margin-top: 20px;">
		<div class="index_regirest_title_agents"></div>
		
		<div style="border:1px solid #cccccc;background:#EDEDED;padding-top:10px;">
			<div style="height:480px;;border:0px solid #cccccc;width:55%;margin:0 auto;">
				
			
			
<?php 
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/jquery.js');
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/customer/index.js');
?>
			<div class="form" style="width:100%;border:0px solid blue;height:100%;over-flow:hidden;">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'apply-form',
	'enableAjaxValidation'=>false,
)); ?>
	
	<div  style="clear:both;"></div>
	<div class="row">
		<ul class="regirest_form_row">
			<li class="regirest_form_row_li_1"><?php echo $form->labelEx($modelApply,'first_name',array('style'=>'height:25px;padding-top:3px;top:1px;font-size:15px;font-weight:normal;')); ?></li>
			<li class="regirest_form_row_li_2"><?php echo $form->textField($modelApply,'first_name',array('size'=>30,'maxlength'=>255,'class'=>'regirest_text')); ?></li>
			<li class="regirest_form_row_li_3"><?php echo $form->error($modelApply,'first_name'); ?></li>
		</ul>
	</div>
	<div  style="clear:both;"></div>
	<div class="row">
		<ul class="regirest_form_row">
			<li class="regirest_form_row_li_1"><?php echo $form->labelEx($modelApply,'last_name',array('style'=>'height:25px;padding-top:3px;top:1px;font-size:15px;font-weight:normal;')); ?></li>
			<li class="regirest_form_row_li_2"><?php echo $form->textField($modelApply,'last_name',array('size'=>30,'maxlength'=>255,'class'=>'regirest_text')); ?></li>
			<li class="regirest_form_row_li_3"><?php echo $form->error($modelApply,'last_name'); ?></li>
		</ul>
	</div>
	<div  style="clear:both;"></div>
	<div class="row">
		<ul class="regirest_form_row">
			<li class="regirest_form_row_li_1"><?php echo $form->labelEx($modelApply,'email',array('style'=>'height:25px;padding-top:3px;top:1px;font-size:15px;font-weight:normal;')); ?></li>
			<li class="regirest_form_row_li_2"><?php echo $form->textField($modelApply,'email',array('size'=>30,'maxlength'=>255,'class'=>'regirest_text')); ?></li>
			<li class="regirest_form_row_li_3" id="div_email_error"><?php echo $form->error($modelApply,'email'); ?></li>
		</ul>
	</div>
	<div  style="clear:both;"></div>
	<div class="row">
		<ul class="regirest_form_row">
			<li class="regirest_form_row_li_1"><?php echo $form->labelEx($modelApply,'state',array('style'=>'height:25px;padding-top:3px;top:1px;font-size:15px;font-weight:normal;')); ?></li>
			<li class="regirest_form_row_li_2"><?php echo $form->dropDownList($modelApply,'state',User::itemAlias('state'),array('style'=>'width:222px;')); ?></li>
			<li class="regirest_form_row_li_3"><?php echo $form->error($modelApply,'state'); ?></li>
		</ul>
	</div>
	<div  style="clear:both;"></div>
	
	<div class="row" id="div_state_license">
		<ul class="regirest_form_row">
			<li class="regirest_form_row_li_1"><?php echo $form->labelEx($modelApply,'state_license',array('style'=>'height:25px;padding-top:3px;top:1px;font-size:15px;font-weight:normal;')); ?></li>
			<li class="regirest_form_row_li_2"><?php echo $form->textField($modelApply,'state_license',array('size'=>30,'maxlength'=>255,'class'=>'regirest_text')); ?></li>
			<li class="regirest_form_row_li_3"><?php echo $form->error($modelApply,'state_license'); ?></li>
		</ul>
	</div>
	
	<div class="row" id="div_state_license">
	     <ul class="regirest_form_row">
	      <li> Fields with an asterisk denote a required field.</li>
         </ul>
	</div>


	<div  style="clear:both;"></div>
	<div class="row buttons" style="width:100%;height:30px;">
		<div class="row buttons" style="width:188px;margin:0 auto;">
		<?php echo CHtml::submitButton('',array('class'=>'submitButton','id'=>'button_save')); ?>
		<img src="/images/loading_1.gif"  style="display:none;margin:10px;" id="div_loading" />
		</div>
	</div>

<?php $this->endWidget(); ?>
</div>
<!-- form -->


			
			<?php if(Yii::app()->user->hasFlash('error_email_exists'))echo '<script>$("#div_email_error").append("<div class=\"errorMessage\">'.Yii::app()->user->getFlash('error_email_exists').'</div>");</script>'; ?>
				<?php if(Yii::app()->user->hasFlash('error'))echo '<script>alert("'.Yii::app()->user->getFlash('error').'");</script>'; ?>
			</div>
		</div>
	</div>
</div>
<script>
$(function() {
	$("#button_save").click(function(){
		$("#button_save").hide();
		$("#div_loading").show();
	});
});
</script>
