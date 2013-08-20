<?php
$this->breadcrumbs=array(
	'Client Expenses'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ClientExpense', 'url'=>array('index')),
	array('label'=>'Manage ClientExpense', 'url'=>array('admin')),
);
?>

<h1>Create ClientExpense</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>