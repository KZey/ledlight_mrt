<?php
$this->breadcrumbs=array(
	'Emails'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Email', 'url'=>array('index')),
);
?>

<h1>Send Email</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'hidden_to_uid'=>$hidden_to_uid)); ?>