<?php
$this->breadcrumbs=array(
	'Client Expenses'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ClientExpense', 'url'=>array('index')),
	array('label'=>'Create ClientExpense', 'url'=>array('create')),
	array('label'=>'Update ClientExpense', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ClientExpense', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ClientExpense', 'url'=>array('admin')),
);
?>

<h1>View ClientExpense #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'realtor_uid',
		'client_uid',
		'indicator',
		'referral_type',
		'finacning_type',
		'expense_type',
		'expense_amount',
		'advertising',
		'gas',
		'meals',
		'note',
	),
)); ?>
