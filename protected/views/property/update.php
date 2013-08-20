<?php
$this->breadcrumbs=array(
	'Properties'=>array('index'),
	$model->title=>array('view','id'=>$model->property_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Property', 'url'=>array('index')),
	array('label'=>'Create Property', 'url'=>array('create')),
	array('label'=>'View Property', 'url'=>array('view', 'id'=>$model->property_id)),
	array('label'=>'Manage Property', 'url'=>array('admin')),
);
?>

<h1>Update Property <?php echo $model->property_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>