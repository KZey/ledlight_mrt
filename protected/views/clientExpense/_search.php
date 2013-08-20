<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'realtor_uid'); ?>
		<?php echo $form->textField($model,'realtor_uid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'client_uid'); ?>
		<?php echo $form->textField($model,'client_uid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'indicator'); ?>
		<?php echo $form->textField($model,'indicator'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'referral_type'); ?>
		<?php echo $form->textField($model,'referral_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'finacning_type'); ?>
		<?php echo $form->textField($model,'finacning_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'expense_type'); ?>
		<?php echo $form->textField($model,'expense_type',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'expense_amount'); ?>
		<?php echo $form->textField($model,'expense_amount',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'advertising'); ?>
		<?php echo $form->textField($model,'advertising',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'gas'); ?>
		<?php echo $form->textField($model,'gas',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'meals'); ?>
		<?php echo $form->textField($model,'meals',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'note'); ?>
		<?php echo $form->textArea($model,'note',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->