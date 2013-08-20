<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<?php
echo "<?php\n";
$label=$this->pluralize($this->class2name($this->modelClass));
echo "\$this->breadcrumbs=array(
	'$label',
);\n";
?>

$this->menu=array(
	array('label'=>Yii::t('models/table','Add').' <?php echo $this->modelClass; ?>', 'url'=>array('create')),
	array('label'=>Yii::t('models/table','Manage').'<?php echo $this->modelClass; ?>', 'url'=>array('admin')),
);
?>

<?php echo "<?php";?> if(Yii::app()->user->hasFlash('Message')): ?>
<script type="text/javascript" language="javascript">   
	Z.Alert('<?php echo "<?php";?> echo Yii::app()->user->getFlash('Message'); ?>');
</script>
<?php echo "<?php";?> endif; ?>

<h1><?php echo $label; ?></h1>

<?php echo "<?php\n"; ?>
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('news-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php echo "<?php echo CHtml::link(Yii::t('models/table','Advanced Search'),'#',array('class'=>'search-button')); ?>"; ?>

<div class="search-form" style="display:none">
<?php echo "<?php"; ?> $this->renderPartial('_search'); ?>
</div><!-- search-form -->

<?php echo "<?php"; ?> $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
	'id'=>'news-grid',
	'columns'=>array(
<?php 
foreach($this->tableSchema->columns as $column)
{
		echo "\t\t'".$column->name."',\n";
}
?>
		array(
			'class'=>'CButtonColumn',
			'htmlOptions' =>array("width"=>80),
			),
		),
)); ?>
