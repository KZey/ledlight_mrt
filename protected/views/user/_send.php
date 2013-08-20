<div class="form" style="border:0px solid #ccccff;">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'inbox-form',
	'enableAjaxValidation'=>false,
)); ?>
	<?php echo CHtml::hiddenField('hidden_to_uid',$hidden_to_uid); ?>
	<div class="row">
		<?php echo $form->textArea($model,'content',array('rows'=>6, 'style'=>'width:450px')); ?>
		<?php echo $form->error($model,'content'); ?>
	</div>
	<div class="row buttons" style="float:left;">
		<?php echo CHtml::imageButton('/images/send.png'); ?>
	</div>
	<?php $this->endWidget(); ?>
	<?php if(Yii::app()->user->hasFlash('success')){
		echo '<script>alert("'.Yii::app()->user->getFlash('success').'");</script>';
	}?>
		<?php if(Yii::app()->user->hasFlash('error')){
		echo '<div class="info_error" style="color:red;padding-top:20px;">&nbsp;&nbsp;&nbsp;&nbsp;'.Yii::app()->user->getFlash('error').'</div>'; 
	}?>
</div>