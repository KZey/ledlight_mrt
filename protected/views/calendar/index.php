<?php
$this->breadcrumbs=array(
	'Calendars',
);

$this->menu=array(
	array('label'=>'Create Calendar', 'url'=>array('create')),
);

$this->menu=array(
	array('label'=>'List Calendar', 'url'=>array('index')),
	array('label'=>'Create Calendar', 'url'=>array('create')),
);

?>

<h1>Calendars</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
