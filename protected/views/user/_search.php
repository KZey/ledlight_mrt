<div id="login_cont" style="border:0px solid red;overflow:hidden;width:100%;">
	<div class="clear"></div>
	<div style="width:100%;border:0px solid #cccccc;margin:0 auto;">
	
	<div class="browse_agents_title"></div>
	<div style="border:1px solid #cccccc;background:#EDEDED;padding-top:10px;margin:0 auto;">
	
	

<div class="wide form" style="margin:0 auto;width:40%;">
<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
	<div class="row">
		<?php echo $form->label($model,'first_name'); ?>
		<?php echo $form->textField($model,'first_name',array('size'=>60,'maxlength'=>255,'style'=>'width:222px;')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'last_name'); ?>
		<?php echo $form->textField($model,'last_name',array('size'=>60,'maxlength'=>255,'style'=>'width:222px;')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'broker'); ?>
		<?php echo $form->textField($model,'broker',array('size'=>60,'maxlength'=>255,'style'=>'width:222px;')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'team'); ?>
		<?php echo $form->textField($model,'team',array('size'=>60,'maxlength'=>255,'style'=>'width:222px;')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'state'); ?>
		<?php echo $form->dropDownList($model,'state',User::itemAlias('state'),array('style'=>'width:222px;','empty'=>'Please Select')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'city'); ?>
		<?php echo $form->textField($model,'city',array('size'=>60,'maxlength'=>255,'style'=>'width:222px;')); ?>
	</div>
	<div class="row buttons">
	<?php echo CHtml::imageButton('/images/button_blue_search.png',array('id'=>'browse_listing')); ?>
	</div>
<?php $this->endWidget(); ?>
</div><!-- search-form -->

		</div>
	</div>
</div>