<?php
/**
 * This is the template for generating the model class of a specified table.
 * - $this: the ModelCode object
 * - $tableName: the table name for this class (prefix is already removed if necessary)
 * - $modelClass: the model class name
 * - $columns: list of table columns (name=>CDbColumnSchema)
 * - $labels: list of attribute labels (name=>label)
 * - $rules: list of validation rules
 * - $relations: list of relations (name=>relation declaration)
 */
?>
<?php 
echo "<?php\n"; 
echo "Yii::import('".$modelPath.".".$modelPrefix.$modelClass."');\n";
?>

/**
 * This is the model class for table "<?php echo $tableName; ?>".
 */
class <?php echo $modelClass; ?> extends <?php echo $modelPrefix.$modelClass."\n"; ?>
{
	/**
	 * The followings are the available columns in table '<?php echo $tableName; ?>':
<?php foreach($columns as $column): ?>
	 * @var <?php echo $column->type.' $'.$column->name."\n"; ?>
<?php endforeach; ?>
	 */

	/**
	 * Returns the static model of the specified AR class.
	 * @return <?php echo $modelClass; ?> the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
<?php foreach($labels as $name=>$label): ?>
			<?php echo "'$name' => '$label',\n"; ?>
<?php endforeach; ?>
		);
	}
	
}