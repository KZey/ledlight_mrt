<?php
$this->breadcrumbs=array(
	'Client Expenses'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ClientExpense', 'url'=>array('index')),
	array('label'=>'Create ClientExpense', 'url'=>array('create')),
	array('label'=>'View ClientExpense', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ClientExpense', 'url'=>array('admin')),
);
?>

<h1>Update ClientExpense <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>