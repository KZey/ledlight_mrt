<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('realtor_uid')); ?>:</b>
	<?php echo CHtml::encode($data->realtor_uid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('client_uid')); ?>:</b>
	<?php echo CHtml::encode($data->client_uid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('indicator')); ?>:</b>
	<?php echo CHtml::encode($data->indicator); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('referral_type')); ?>:</b>
	<?php echo CHtml::encode($data->referral_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('finacning_type')); ?>:</b>
	<?php echo CHtml::encode($data->finacning_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('expense_type')); ?>:</b>
	<?php echo CHtml::encode($data->expense_type); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('expense_amount')); ?>:</b>
	<?php echo CHtml::encode($data->expense_amount); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('advertising')); ?>:</b>
	<?php echo CHtml::encode($data->advertising); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gas')); ?>:</b>
	<?php echo CHtml::encode($data->gas); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('meals')); ?>:</b>
	<?php echo CHtml::encode($data->meals); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('note')); ?>:</b>
	<?php echo CHtml::encode($data->note); ?>
	<br />

	*/ ?>

</div>