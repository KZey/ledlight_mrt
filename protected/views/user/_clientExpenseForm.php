<?php if($check_repeat == 1){?>
	<div style="border:1px solid #ffcccc;width:205px;overflow:hidden;margin-top:10px;">
		<div style="border:1px solid #ffcccc;background:#3399cc;width:100%;height:25px;color:#fff;font-weight:bold;padding-top:10px;padding-left:5px;">Assign Type</div>
		<div style="padding-top:10px;padding-left:10px;">
			<div class="form">
			<?php $form=$this->beginWidget('CActiveForm', array('id'=>'contact-form','enableAjaxValidation'=>false,)); ?>
				<div class="row">
					<?php echo $form->labelEx($modelContact,'type'); ?>
					<?php echo $form->dropDownList($modelContact,'type',Contact::itemAlias('Type'),array('style'=>'width:180px;')); ?>
					<?php echo $form->error($modelContact,'type'); ?>
				</div>
				<div class="row">
					<?php echo $form->labelEx($modelContact,'indicator'); ?>
					<?php echo $form->dropDownList($modelContact,'indicator',Contact::itemAlias('indicator'),array('style'=>'width:180px;')); ?>
					<?php echo $form->error($modelContact,'indicator'); ?>
				</div>
				<div class="row">
					<?php echo $form->labelEx($modelContact,'referral_type'); ?>
					<?php echo $form->dropDownList($modelContact,'referral_type',Contact::itemAlias('referral_type'),array('style'=>'width:180px;')); ?>
					<?php echo $form->error($modelContact,'referral_type'); ?>
				</div>
				<div class="row">
					<?php echo $form->labelEx($modelContact,'finacning_type'); ?>
					<?php echo $form->dropDownList($modelContact,'finacning_type',Contact::itemAlias('finacning_type'),array('style'=>'width:180px;')); ?>
					<?php echo $form->error($modelContact,'finacning_type'); ?>
				</div>
				<div class="row buttons"><?php echo CHtml::imageButton('/images/save.png'); ?></div>
			<?php $this->endWidget(); ?>
		</div></div>
	</div>
	<div style="border:1px solid #ffcccc;width:205px;overflow:hidden;margin-top:10px;">
		<div style="border:1px solid #ffcccc;background:#3399cc;width:100%;height:25px;color:#fff;font-weight:bold;padding-top:10px;padding-left:5px;">Expenses</div>
		<div style="padding-top:10px;padding-left:10px;">
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array('id'=>'client-expense-form',)); ?>
	<?php echo $form->hiddenField($modelClientExpense,'realtor_uid'); ?>
	<?php echo $form->hiddenField($modelClientExpense,'client_uid'); ?>
	<?php echo $form->hiddenField($modelClientExpense,'total'); ?>
	<input id="ClientExpense_id" type="hidden" name="ClientExpense[id]">
	<div class="row">
		<?php echo $form->labelEx($modelClientExpense,'advertising'); ?>
		<?php echo $form->textField($modelClientExpense,'advertising',array('size'=>24,'maxlength'=>50)); ?>
		<?php echo $form->error($modelClientExpense,'advertising'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($modelClientExpense,'gas'); ?>
		<?php echo $form->textField($modelClientExpense,'gas',array('size'=>24,'maxlength'=>50)); ?>
		<?php echo $form->error($modelClientExpense,'gas'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($modelClientExpense,'meals'); ?>
		<?php echo $form->textField($modelClientExpense,'meals',array('size'=>24,'maxlength'=>50)); ?>
		<?php echo $form->error($modelClientExpense,'meals'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($modelClientExpense,'others'); ?>
		<?php echo $form->textField($modelClientExpense,'others',array('size'=>24,'maxlength'=>50)); ?>
		<?php echo $form->error($modelClientExpense,'others'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($modelClientExpense,'add_date'); ?>
		<?php echo $form->textField($modelClientExpense,'add_date',array('size'=>24,'maxlength'=>50)); ?>
		<?php echo $form->error($modelClientExpense,'add_date'); ?>
	</div>
	<div class="row">
		<div style="float: left;font-weight:bold;overflow:hidden;">Total</div>
		<div style="float: right;margin-right:18px;overflow:hidden;">$ <span id="div_total"><?php echo $expense_total;?></span></div>
	</div>
	<div class="clear"></div>
	<div class="row buttons" id="button_save"><?php echo CHtml::imageButton('/images/add_expense.png',array('id'=>'button_expense')); ?></div>
	<?php 
		if(Yii::app()->user->hasFlash('successClientExpense'))echo '<script>alert("'.Yii::app()->user->getFlash('successClientExpense').'");</script>';
		if(Yii::app()->user->hasFlash('error'))echo '<script>alert("'.Yii::app()->user->getFlash('error').'");</script>';
	?>
<?php $this->endWidget(); ?>
</div>
			</div>
		</div>
<?php }?>
<script>
	function checkNum(text_val)
	{
        var code;
        for (var i = 0; i < text_val.length; i++) {
            var code = text_val.charAt(i).charCodeAt(0);
            if (code < 48 || code > 57) return false;
        }
	}
$(function() {
	format_number_span("div_total");
	$("#ClientExpense_advertising").mouseout(function(){format_number('ClientExpense_advertising');});
	$("#ClientExpense_gas").change(function(){format_number('ClientExpense_gas');});
	$("#ClientExpense_meals").mouseout(function(){format_number('ClientExpense_meals');});
	$("#ClientExpense_others").change(function(){format_number('ClientExpense_others');});
	
	$("#ClientExpense_add_date" ).click(function(){WdatePicker({dateFmt: 'yyyy-MM-dd' });});
	$("#yw2").attr("style","width:180px;");
	var value_ClientExpense_advertising=value_ClientExpense_gas=value_ClientExpense_meals=0; 
	function getTotal()
	{
		value_ClientExpense_advertising = $("#ClientExpense_advertising").val();
		value_ClientExpense_gas = $("#ClientExpense_gas").val();
		value_ClientExpense_meals = $("#ClientExpense_meals").val();
		value_ClientExpense_others = $("#ClientExpense_others").val();
		//$("#div_total").html(0);
		var total = 0;
		
			if(isNaN(value_ClientExpense_advertising))
			{
				alert('<?php echo Yii::t("PageJs","advertising_is_num");?>');return false;
			}else{
				if(value_ClientExpense_advertising != '')
					total = total + parseInt(value_ClientExpense_advertising);
				
			}
			if(isNaN(value_ClientExpense_gas))
			{
				alert('<?php echo Yii::t("PageJs","gas_is_num");?>');return false;
			}else{
				if(value_ClientExpense_gas != '')
				total = total + parseInt(value_ClientExpense_gas);
			}
			if(isNaN(value_ClientExpense_meals))
			{
				alert('<?php echo Yii::t("PageJs","meals_is_num");?>');return false;
			}else{
				if(value_ClientExpense_meals != '')
				total = total + parseInt(value_ClientExpense_meals);
			}
			if(isNaN(value_ClientExpense_others))
			{
				alert('<?php echo Yii::t("PageJs","others_is_num");?>');return false;
			}else{
				alert(value_ClientExpense_others);
				if(value_ClientExpense_others != '')
				total = total + parseInt(value_ClientExpense_others);
			}
		
			//var total = parseInt(value_ClientExpense_advertising) + parseInt(value_ClientExpense_gas) + parseInt(value_ClientExpense_meals);
			//if(!isNaN(total))
				$("#div_total").html(total);
				$("#ClientExpense_total").val(total);
	}
	
	//getTotal();
	$("#ClientExpense_advertising").blur(function(){
		//getTotal();
	});
	$("#ClientExpense_gas").blur(function(){
		//getTotal();
	});
	$("#ClientExpense_meals").blur(function(){
		//getTotal();
	});
});
</script>