
<div style="border:0px solid red;width:950px;overflow:hidden;">

	<div style="border:0px solid red;width:100%;height:40px;overflow:hidden;background:#067db9;color:#fff;font-weight:bold;">
		<div id="menu_dashboard" style="margin-left:10px;" class="menu_li_default"><?php if($modelUser->type==1)echo 'Profile';else echo 'Dashboard';?></div>
		<div id="menu_property" class="menu_li_default">Property</div>
		<div id="menu_realtor" class="menu_li_default">Realtor</div>
	</div>
	<div style="border:0px solid red;width:100%;overflow:hidden;padding:10px;margin:0 auto;">
		
		<div style="float: left;border:0px solid red;overflow:hidden;">
			<div style="float: left;border:0px solid red;overflow:hidden;">
				<img src="/images/realtor-Profile-other-view.jpg" width="700" height="607" alt="">
			</div>
			<div style="float: left;border:0px solid red;width:210px;overflow:hidden;margin-left:15px;padding-top:10px;">
				<div style="border:1px solid #ffcccc;background:#faf5f5;width:205px;height:150px;overflow:hidden;padding:1px;">
					
				</div>
			</div>
			
		</div>
	</div>
</div>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('property_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->property_id), array('view', 'id'=>$data->property_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ml_num')); ?>:</b>
	<?php echo CHtml::encode($data->ml_num); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('price')); ?>:</b>
	<?php echo CHtml::encode($data->price); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('property_type')); ?>:</b>
	<?php echo CHtml::encode($data->property_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('selling_status')); ?>:</b>
	<?php echo CHtml::encode($data->selling_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('property_status')); ?>:</b>
	<?php echo CHtml::encode($data->property_status); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('beds')); ?>:</b>
	<?php echo CHtml::encode($data->beds); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('baths')); ?>:</b>
	<?php echo CHtml::encode($data->baths); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('house_size')); ?>:</b>
	<?php echo CHtml::encode($data->house_size); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lot_size')); ?>:</b>
	<?php echo CHtml::encode($data->lot_size); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pool')); ?>:</b>
	<?php echo CHtml::encode($data->pool); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('levels')); ?>:</b>
	<?php echo CHtml::encode($data->levels); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('basement')); ?>:</b>
	<?php echo CHtml::encode($data->basement); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('address')); ?>:</b>
	<?php echo CHtml::encode($data->address); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('desc')); ?>:</b>
	<?php echo CHtml::encode($data->desc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('logo')); ?>:</b>
	<?php echo CHtml::encode($data->logo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('photos')); ?>:</b>
	<?php echo CHtml::encode($data->photos); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('videos')); ?>:</b>
	<?php echo CHtml::encode($data->videos); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date')); ?>:</b>
	<?php echo CHtml::encode($data->date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('uid')); ?>:</b>
	<?php echo CHtml::encode($data->uid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mrt_status')); ?>:</b>
	<?php echo CHtml::encode($data->mrt_status); ?>
	<br />

	*/ ?>

</div>