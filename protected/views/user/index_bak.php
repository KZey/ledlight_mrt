<?php
$this->breadcrumbs=array(
	'My profile',
);

/* $this->menu=array(
	array('label'=>'regirest User', 'url'=>array('regirest')),
	array('label'=>'Manage User', 'url'=>array('admin')),
); */
?>

<div style="border:0px solid red;width:900px;">
	<div style="float: left;width:45%;border:0px solid red">
		<div style="width:150px;float:left;">
			<img src="<?php echo '/upload/user_logo/'.$model->logo?>" width=120 height=120 />
		</div>
		<div style="">
			<ul>
				<li>Name:<?php echo $model->first_name.' '.$model->last_name;;?></li>
				<li>Email:<?php echo $model->email;?></li>
				<li>Office:<?php echo $model->office;?></li>
				<li>Mobile:<?php echo $model->mobile;?></li>
				<li>Team:<?php echo $model->team;?></li>
				<li>state:<?php echo $model->state;?></li>
				<li>city:<?php echo $model->city;?></li>
			</ul>
			<div style="clear:both;"></div>
			<div style="margin-top:30px;">
				About me:<br/>
				<div style="border:1px solid #8A8A8A;padding:5px;width:400px;height:60px;"><?php echo $model->about;?></div>
			</div>
			<div style="height:65px;width:100%;border:0px solid #8A8A8A;">
				<ul>
					<li style="float:left;width:50%"><?php echo CHtml::link('Edit my basic info','/index.php/user/update/'.Yii::app()->user->id,array('class'=>'blue'))?></li>
					<li style="float:right"><?php echo CHtml::link('View my calendar','/index.php/calendar',array('class'=>'blue'))?></li>
					<li style="float:left;width:50%;margin-top:10px;"><?php echo CHtml::link('Send a email','/index.php/email/create',array('class'=>'blue'))?></li>
				</ul>
			</div>
		</div>
		
		<div style="clear:both;"></div>
		<div style="margin-top:30px;">
			<h5>Send message</h5>
			<div style="border:1px solid #8A8A8A;padding:5px;width:400px;">
				<?php echo $this->renderPartial('/inbox/_form', array('model'=>$modelInbox,'hidden_to_uid'=>$hidden_to_uid)); ?>
			</div>
		</div>
		
	</div>
	<div style="float: right;width:50%;border:0px solid red">
		
		<div style="">
			<h5>My messages</h5>
			<div style="border:1px solid #8A8A8A;padding:5px;height:275px;">
				<?php $this->widget('zii.widgets.CListView', array(
					'dataProvider'=>$dataProvider,
					'itemView'=>'/inbox/_view',
				)); 
				?>
			</div>
		</div>
		
		<div style="clear:both;"></div>
		<div style="margin-top:30px;">
			<h5>My Listings</h5>
			<div style="border:1px solid #8A8A8A;padding:5px;height:300px;">
				
			</div>
		</div>
		
	</div>
	
	
	
</div>