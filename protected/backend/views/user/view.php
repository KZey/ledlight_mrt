<?php
$this->breadcrumbs=array(
	'User List'=>array('index'),
	$model->uid,
);

$this->menu=array(
	array('label'=>'List User', 'url'=>array('index')),
	array('label'=>'Create User', 'url'=>array('create')),
	array('label'=>'Update User', 'url'=>array('update', 'uid'=>$model->uid)),
//	array('label'=>'Delete User', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->uid),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage User', 'url'=>array('admin')),
);
?>

<h1>View User #<?php echo $model->uid; ?></h1>

<?php 
    $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'uid',
		'email',
		'first_name',
		'last_name',
		'office',
		'mobile',
		'broker',
		'team',
		'logo',
		'city',
		'state',
		'phone',
		'about',
		'last_time',
	 ),
    )); 
?>
