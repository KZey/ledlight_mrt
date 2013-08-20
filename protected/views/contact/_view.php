<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('uid_parent')); ?>:</b>
	<?php echo CHtml::encode($data->uid_parent); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('uid_child')); ?>:</b>
	<?php echo CHtml::encode($data->uid_child); ?>
	<br />


</div>