<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<div class="wide form">
<?php echo "<?php ";?>$model=new <?php echo $this->modelClass;?>();?>
<?php echo "<?php \$form=\$this->beginWidget('application.extensions.custom.ActiveForm', array(
	'action'=>Yii::app()->createUrl(\$this->route),
	'method'=>'get',
)); ?>\n"; ?>

<table class="dataSearch" >
	<tr>
<?php foreach($this->tableSchema->columns as $column): ?>
<?php
	$field=$this->generateInputField($this->modelClass,$column);
	if(strpos($field,'password')!==false || $column->isPrimaryKey)
		continue;
?>
		<td><?php echo "<?php echo \$form->label(\$model,'{$column->name}'); ?>"; ?></td>
		<td><?php echo "<?php echo ".$this->generateActiveField($this->modelClass,$column)."; ?>"; ?></td>
		
<?php endforeach; ?>
		<td><?php echo "<?php echo CHtml::submitButton(Yii::t('models/table','Search')); ?>"; ?></td>
	</tr>	
</table>

<?php echo "<?php \$this->endWidget(); ?>\n"; ?>

</div><!-- search-form -->