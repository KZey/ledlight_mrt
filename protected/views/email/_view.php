<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('from_uid')); ?>:</b>
	<?php echo CHtml::encode($data->from_uid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('to_uid')); ?>:</b>
	<?php echo CHtml::encode($data->to_uid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('contents')); ?>:</b>
	<?php echo CHtml::encode($data->contents); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('send_date')); ?>:</b>
	<?php echo CHtml::encode($data->send_date); ?>
	<br />


</div>