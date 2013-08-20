<?php
$this->breadcrumbs=array(
	'Applies'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Apply', 'url'=>array('index')),
	array('label'=>'Manage Apply', 'url'=>array('admin')),
);
?>

<h1>Create Apply</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>