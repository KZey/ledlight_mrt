<?php
$this->breadcrumbs=array(
	'Client Expenses',
);

$this->menu=array(
	array('label'=>'Create ClientExpense', 'url'=>array('create')),
	array('label'=>'Manage ClientExpense', 'url'=>array('admin')),
);
?>

<h1>Client Expenses</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
