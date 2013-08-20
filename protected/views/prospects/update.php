<?php
$this->breadcrumbs=array(
	'Prospects'=>array('index'),
	$model->title=>array('view','id'=>$model->uid),
	'Update',
);

$this->menu=array(
	array('label'=>'List Prospects', 'url'=>array('index')),
	array('label'=>'Create Prospects', 'url'=>array('create')),
	array('label'=>'View Prospects', 'url'=>array('view', 'id'=>$model->uid)),
	array('label'=>'Manage Prospects', 'url'=>array('admin')),
);
?>

<h1>Update Prospects <?php echo $model->uid; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>