<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype'=>'multipart/form-data',)
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	<?php echo CHtml::hiddenField('type',$model->type); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'pwd'); ?>
		<?php echo $form->passwordField($model,'pwd',array('value'=>'')); ?>
		<?php echo $form->error($model,'pwd',array('value'=>'')); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'repwd'); ?>
		<?php echo $form->passwordField($model,'repwd',array('value'=>'')); ?>
		<?php echo $form->error($model,'repwd'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'first_name'); ?>
		<?php echo $form->textField($model,'first_name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'first_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'last_name'); ?>
		<?php echo $form->textField($model,'last_name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'last_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'logo'); ?>
		<?php echo $form->fileField($model,'logo',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'logo'); ?>
	</div>
	
	<?php if($model->type==2){?>
		<div class="row">
			<?php echo $form->labelEx($model,'state_license'); ?>
			<?php echo $form->textField($model,'state_license',array('size'=>60,'maxlength'=>255)); ?>
			<?php echo $form->error($model,'state_license'); ?>
		</div>
		<div class="row">
			<?php echo $form->labelEx($model,'broker'); ?>
			<?php echo $form->textField($model,'broker',array('size'=>60,'maxlength'=>255)); ?>
			<?php echo $form->error($model,'broker'); ?>
		</div>
		<div class="row">
			<?php echo $form->labelEx($model,'team'); ?>
			<?php echo $form->textField($model,'team',array('size'=>60,'maxlength'=>255)); ?>
			<?php echo $form->error($model,'team'); ?>
		</div>
	<?php }?>
	<div class="row">
		<?php echo $form->labelEx($model,'office'); ?>
		<?php echo $form->textField($model,'office',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'office'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mobile'); ?>
		<?php echo $form->textField($model,'mobile',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'mobile'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fax'); ?>
		<?php echo $form->textField($model,'fax',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'fax'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'about'); ?>
		<?php echo $form->textArea($model,'about',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'about'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'state'); ?>
		<?php echo $form->textField($model,'state',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'state'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'city'); ?>
		<?php echo $form->textField($model,'city',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'city'); ?>
	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'twitter_uname'); ?>
		<?php echo $form->textField($model,'twitter_uname',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'twitter_uname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'twitter_pwd'); ?>
		<?php echo $form->textField($model,'twitter_pwd',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'twitter_pwd'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'facebook_uname'); ?>
		<?php echo $form->textField($model,'facebook_uname',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'facebook_uname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'facebook_pwd'); ?>
		<?php echo $form->textField($model,'facebook_pwd',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'facebook_pwd'); ?>
	</div>

	<div class="row buttons" style="float:left;height:30px;">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>
	<div class="row buttons" style="float:left;height:30px;">
		&nbsp;&nbsp;&nbsp;&nbsp;<?php echo CHtml::button('Cancel',array('onclick'=>'history.go(-1)')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->