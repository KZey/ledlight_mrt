<?php
$this->breadcrumbs=array(
	'Prospects',
);

$this->menu=array(
	array('label'=>'Create Prospects', 'url'=>array('create')),
	array('label'=>'Manage Prospects', 'url'=>array('admin')),
);
?>

<h1>Prospects</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
