
<div class="form" style="width:85%;border:0px solid #ccccff;margin:0 auto;">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'inbox-form',
	'enableAjaxValidation'=>true,
)); ?>

	<?php echo CHtml::hiddenField('hidden_to_uid',$hidden_to_uid); ?>
	
	<div class="row">
		<?php echo $form->textArea($model,'content',array('rows'=>3, 'style'=>'width:685px')); ?>
		<?php echo $form->error($model,'content'); ?>
	</div>
	<div class="row buttons" style="float:right;margin-right:39px;">
		<?php echo CHtml::imageButton('/images/send.png'); ?>
	</div>
	<?php $this->endWidget(); ?>


	<?php if(Yii::app()->user->hasFlash('success')){
// 		echo '<div class="info" style="color:red">'.Yii::app()->user->getFlash('success').'</div>'; 
		echo '<script>alert("'.Yii::app()->user->getFlash('success').'");</script>';
	}?>
		<?php if(Yii::app()->user->hasFlash('error')){
		echo '<div class="info_error" style="color:red">'.Yii::app()->user->getFlash('error').'</div>'; 
	}?>

</div>