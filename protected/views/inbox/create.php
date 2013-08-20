<?php
$this->breadcrumbs=array(
	'Inboxes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Inbox', 'url'=>array('index')),
	array('label'=>'Manage Inbox', 'url'=>array('admin')),
);
?>

<h1>Send A Message To A Client on mrt</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'hidden_to_uid'=>$hidden_to_uid)); ?>