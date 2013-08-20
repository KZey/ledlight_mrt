<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'client-expense-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'realtor_uid'); ?>
		<?php echo $form->textField($model,'realtor_uid'); ?>
		<?php echo $form->error($model,'realtor_uid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'client_uid'); ?>
		<?php echo $form->textField($model,'client_uid'); ?>
		<?php echo $form->error($model,'client_uid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'indicator'); ?>
		<?php echo $form->dropDownList($model,'indicator',array(1=>'indicator_1',2=>'indicator_2',3=>'indicator_3')); ?>
		<?php echo $form->error($model,'indicator'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'referral_type'); ?>
		<?php echo $form->dropDownList($model,'referral_type',array(1=>'referral_type_1',2=>'referral_type_2',3=>'referral_type_3')); ?>
		<?php echo $form->error($model,'referral_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'finacning_type'); ?>
		<?php echo $form->dropDownList($model,'finacning_type',array(1=>'finacning_type_1',2=>'finacning_type_2',3=>'finacning_type_3')); ?>
		<?php echo $form->error($model,'finacning_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'expense_type'); ?>
		<?php echo $form->textField($model,'expense_type',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'expense_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'expense_amount'); ?>
		<?php echo $form->textField($model,'expense_amount',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'expense_amount'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'advertising'); ?>
		<?php echo $form->textField($model,'advertising',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'advertising'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'gas'); ?>
		<?php echo $form->textField($model,'gas',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'gas'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'meals'); ?>
		<?php echo $form->textField($model,'meals',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'meals'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'note'); ?>
		<?php echo $form->textArea($model,'note',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'note'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->