<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<div class="form">

<?php echo "<?php \$form=\$this->beginWidget('application.extensions.custom.ActiveForm', array(
	'id'=>'".$this->class2id($this->modelClass)."-form',
	'enableAjaxValidation'=>false,
)); ?>\n"; ?>

	<?php echo "<?php echo \$form->errorSummary(\$model); ?>\n"; ?>

	<table width="98%" border="1" align="center" bgcolor="#e4f0f6" style="text-indent: 2px; margin-bottom:15px;">
<?php
foreach($this->tableSchema->columns as $column)
{
	if($column->isPrimaryKey)	continue;
	elseif($column->name=='status') break;//默认status以后的内容不添加不更改
?>
	<tr>
		<th><?php echo "<?php echo ".$this->generateActiveLabel($this->modelClass,$column)."; ?>"; ?></th>
		<td><?php echo "<?php echo ".$this->generateActiveField($this->modelClass,$column)."; ?>"; ?></td>
		<td><?php echo "<?php echo \$form->error(\$model,'{$column->name}'); ?>"; ?></td>
	</tr>

<?php
}
?>
	</table>
	<table width="99%" border="0" cellspacing="0" cellpadding="0" style="margin-bottom:10px">
      <tr>
        <td width="83%">&nbsp;</td>
        <td width="17%">
          <label><input type="submit" name="Submit" value="确认提交"></label>
        </td>
      </tr>
    </table>
<?php echo "<?php \$this->endWidget(); ?>\n"; ?>

</div><!-- form -->

