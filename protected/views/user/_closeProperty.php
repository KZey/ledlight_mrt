<script type="text/javascript" rel="stylesheet" src="<?php echo Yii::app()->request->baseUrl; ?>/js/datepicker/WdatePicker.js"></script>
<div class="form" style="width:100%;margin:0 auto;">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'property-form',
	'enableAjaxValidation'=>false,
)); ?>
	<?php echo $form->hiddenField($modelProperty,'property_id'); ?>
	<!–[if lte IE 7]> 
		<style type="text/css">.li_title{margin-left:20px;}</style> 
	<![else]–>
		<style type="text/css">.li_title{margin-left:10px;}</style> 
	<![endif]–>
	<div class="row">
		<ul class="close_property_row">
			<li class="close_property_row_li_1" style="margin-top:1px;"><?php echo $form->labelEx($modelProperty,'title'); ?></li>
			<li class="close_property_row_li_2 li_title"><?php echo $modelProperty->title;?></li>
		</ul>
	</div>
	<div class="row">
		<ul class="close_property_row">
			<li class="close_property_row_li_1" style="margin-top:1px;"><?php echo $form->labelEx($modelProperty,'date'); ?></li>
			<li class="close_property_row_li_2 li_title"><?php echo $modelProperty->date;?></li>
		</ul>
	</div>
	<div class="row">
		<ul class="close_property_row">
			<li class="close_property_row_li_1"><?php echo $form->labelEx($modelProperty,'selling_status'); ?></li>
			<li class="close_property_row_li_2 li_title"><?php echo $form->dropDownList($modelProperty,'selling_status',array(2=>'Sold',4=>'Expired'),array('style'=>'width:185px;')); ?></li>
		</ul>
	</div>
	<div class="row">
		<ul class="close_property_row">
			<li class="close_property_row_li_1"><?php echo $form->labelEx($modelProperty,'closed_date'); ?></li>
			<li class="close_property_row_li_2"><?php echo $form->textField($modelProperty,'closed_date',array('style'=>'width:185px;')); ?></li>
			<li style="clear:both;margin-left:150px;"><?php echo $form->error($modelProperty,'closed_date'); ?></li>
		</ul>
	</div>
	<div class="row">
		<ul class="close_property_row">
			<li class="close_property_row_li_1"><?php echo $form->labelEx($modelProperty,'transaction_price'); ?></li>
			<li class="close_property_row_li_2"><?php echo $form->textField($modelProperty,'transaction_price',array('style'=>'width:400px;')); ?></li>
			<li style="clear:both;margin-left:150px;"><?php echo $form->error($modelProperty,'transaction_price'); ?></li>
		</ul>
	</div>
	<hr/>
	<div style="font-weight:bold;font-size:16px;">Expense</div>
	<div class="row">
		<ul class="close_property_row">
			<li class="close_property_row_li_1"><?php echo $form->labelEx($modelProperty,'expense_gas'); ?></li>
			<li class="close_property_row_li_2"><?php echo $form->textField($modelProperty,'expense_gas',array('style'=>'width:400px;')); ?></li>
			<li style="clear:both;margin-left:150px;"><?php echo $form->error($modelProperty,'expense_gas'); ?></li>
		</ul>
	</div>
	<div class="row">
		<ul class="close_property_row">
			<li class="close_property_row_li_1"><?php echo $form->labelEx($modelProperty,'expense_meals'); ?></li>
			<li class="close_property_row_li_2"><?php echo $form->textField($modelProperty,'expense_meals',array('style'=>'width:400px;')); ?></li>
			<li style="clear:both;margin-left:150px;"><?php echo $form->error($modelProperty,'expense_meals'); ?></li>
		</ul>
	</div>
	<div class="row">
		<ul class="close_property_row">
			<li class="close_property_row_li_1"><?php echo $form->labelEx($modelProperty,'expense_advertising'); ?></li>
			<li class="close_property_row_li_2"><?php echo $form->textField($modelProperty,'expense_advertising',array('style'=>'width:400px;')); ?></li>
			<li style="clear:both;margin-left:150px;"><?php echo $form->error($modelProperty,'expense_advertising'); ?></li>
		</ul>
	</div>
	<div class="row">
		<ul class="close_property_row">
			<li class="close_property_row_li_1"><?php echo $form->labelEx($modelProperty,'expense_1'); ?></li>
			<li class="close_property_row_li_2"><?php echo $form->textField($modelProperty,'expense_1',array('style'=>'width:400px;')); ?></li>
			<li style="clear:both;margin-left:150px;"><?php echo $form->error($modelProperty,'expense_1'); ?></li>
		</ul>
	</div>
	<div class="row">
		<ul class="close_property_row">
			<li class="close_property_row_li_1">&nbsp;</li>
			<li class="close_property_row_li_2" id="button_save"><?php echo CHtml::imageButton('/images/save.png'); ?></li>
		</ul>
	</div>
<?php $this->endWidget(); ?>
</div>
<script>
$(function() {
	format_number('Property_transaction_price');
	$("#Property_transaction_price").mouseout(function(){format_number('Property_transaction_price');});

	format_number('Property_expense_gas');
	$("#Property_expense_gas").mouseout(function(){format_number('Property_expense_gas');});

	format_number('Property_expense_meals');
	$("#Property_expense_meals").mouseout(function(){format_number('Property_expense_meals');});

	format_number('Property_expense_advertising');
	$("#Property_expense_advertising").mouseout(function(){format_number('Property_expense_advertising');});

	format_number('Property_expense_1');
	$("#Property_expense_1").mouseout(function(){format_number('Property_expense_1');});

	$("#Property_closed_date" ).click(function(){WdatePicker({dateFmt: 'yyyy-MM-dd' });});
});
</script>