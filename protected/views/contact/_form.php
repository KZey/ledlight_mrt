<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'contact-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
		<?php echo $form->error($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'uid_parent'); ?>
		<?php echo $form->textField($model,'uid_parent'); ?>
		<?php echo $form->error($model,'uid_parent'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'uid_child'); ?>
		<?php echo $form->textField($model,'uid_child'); ?>
		<?php echo $form->error($model,'uid_child'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->