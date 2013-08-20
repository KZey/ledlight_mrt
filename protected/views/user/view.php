<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	//$model->uid,
);

 $this->menu=array(
	//array('label'=>'List User', 'url'=>array('index')),
	//array('label'=>'regirest User', 'url'=>array('regirest')),
	//array('label'=>'Update User', 'url'=>array('update', 'id'=>$model->uid)),
	//array('label'=>'Delete User', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->uid),'confirm'=>'Are you sure you want to delete this item?')),
	//array('label'=>'Manage User', 'url'=>array('admin')),
);
?>


<div>
	<div style="width:30%;float:left;"><img src="<?php echo '/upload/'.$model->logo?>" width=120 height=120 /></div>
	<div style="">
		<ul>
			<li>email:<?php echo $model->email;?></li>
			<li>first_name:<?php echo $model->first_name;?></li>
			<li>last_name:<?php echo $model->last_name;?></li>
			<li>about:<?php echo $model->about;?></li>
		</ul>
	</div>
	<div>
		<?php echo CHtml::link('Update my basic info','/index.php/user/update/'.Yii::app()->user->id,array('class'=>'blue'))?>
	</div>
</div>
