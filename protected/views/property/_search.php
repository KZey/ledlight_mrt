<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'property_id'); ?>
		<?php echo $form->textField($model,'property_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ml_num'); ?>
		<?php echo $form->textField($model,'ml_num'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'price'); ?>
		<?php echo $form->textField($model,'price',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'property_type'); ?>
		<?php echo $form->textField($model,'property_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'selling_status'); ?>
		<?php echo $form->textField($model,'selling_status'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'property_status'); ?>
		<?php echo $form->textField($model,'property_status'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'beds'); ?>
		<?php echo $form->textField($model,'beds'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'baths'); ?>
		<?php echo $form->textField($model,'baths'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'house_size'); ?>
		<?php echo $form->textField($model,'house_size'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'lot_size'); ?>
		<?php echo $form->textField($model,'lot_size'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pool'); ?>
		<?php echo $form->textField($model,'pool'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'levels'); ?>
		<?php echo $form->textField($model,'levels'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'basement'); ?>
		<?php echo $form->textField($model,'basement'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'address'); ?>
		<?php echo $form->textField($model,'address',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'desc'); ?>
		<?php echo $form->textArea($model,'desc',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'logo'); ?>
		<?php echo $form->textField($model,'logo',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'photos'); ?>
		<?php echo $form->textArea($model,'photos',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'videos'); ?>
		<?php echo $form->textArea($model,'videos',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date'); ?>
		<?php echo $form->textField($model,'date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'uid'); ?>
		<?php echo $form->textField($model,'uid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mrt_status'); ?>
		<?php echo $form->textField($model,'mrt_status'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->