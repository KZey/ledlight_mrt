<?php
$this->breadcrumbs=array(
	'Prospects'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Prospects', 'url'=>array('index')),
	array('label'=>'Manage Prospects', 'url'=>array('admin')),
);
?>

<h1>Create Prospects</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>