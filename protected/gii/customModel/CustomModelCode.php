<?php
Yii::import('system.gii.generators.model.ModelCode');

class CustomModelCode extends ModelCode
{
	public $modelPrefix = "base";
	public $logicPrefix = "logic";

	public function rules()
	{
		return array_merge(parent::rules(), array(
			array('tablePrefix, baseClass, tableName, modelClass, modelPath, modelPrefix', 'filter', 'filter'=>'trim'),
			array('tableName, modelPath, baseClass, modelPrefix', 'required'),
			array('tablePrefix, tableName, modelPath, modelPrefix', 'match', 'pattern'=>'/^(\w+[\w\.]*|\*?|\w+\.\*)$/', 'message'=>'{attribute} should only contain word characters, dots, and an optional ending asterisk.'),
			array('tableName', 'validateTableName', 'skipOnError'=>true),
			array('tablePrefix, modelClass, baseClass', 'match', 'pattern'=>'/^\w+$/', 'message'=>'{attribute} should only contain word characters.'),
			array('modelPath', 'validateModelPath', 'skipOnError'=>true),
			array('baseClass', 'validateBaseClass', 'skipOnError'=>true),
			array('tablePrefix, modelPath, baseClass, modelPrefix', 'sticky'),
		));
	}
	
	public function requiredTemplates()
	{
		return array(
			'basemodel.php',
		    'logicmodel.php',	
			'model.php',
		);
	}
	
	public function prepare()
	{
		$this->files=array();
		$templatePath=$this->templatePath;

		if(($pos=strrpos($this->tableName,'.'))!==false)
		{
			$schema=substr($this->tableName,0,$pos);
			$tableName=substr($this->tableName,$pos+1);
		}
		else
		{
			$schema='';
			$tableName=$this->tableName;
		}
		if($tableName[strlen($tableName)-1]==='*')
			$tables=Yii::app()->db->schema->getTables($schema);
		else
			$tables=array($this->getTableSchema($this->tableName));

		$relations=$this->generateRelations();

		foreach($tables as $table)
		{
			$tableName=$this->removePrefix($table->name);
			$className=$this->generateClassName($table->name);
			$modelPrefix = ucfirst($this->modelPrefix);
			$logicPrefix = ucfirst($this->logicPrefix);
			$params=array(
				'tableName'=>$schema==='' ? $tableName : $schema.'.'.$tableName,
				'modelClass'=>$className,
				'modelPath'=>$this->modelPath,
				'modelPrefix'=>$modelPrefix,
			    'logicPrefix'=>$logicPrefix,
				'columns'=>$table->columns,
				'labels'=>$this->generateLabels($table),
				'rules'=>$this->generateRules($table),
				'relations'=>isset($relations[$className]) ? $relations[$className] : array(),
			);
			$this->files[]=new CCodeFile(
				Yii::getPathOfAlias($this->modelPath).'/'.$modelPrefix.'/'.$modelPrefix.$className.'.php',
				$this->render($templatePath.'/basemodel.php', $params)
			);
			$this->files[]=new CCodeFile(
				Yii::getPathOfAlias($this->modelPath).'/'.$logicPrefix.'/'.$logicPrefix.$className.'.php',
				$this->render($templatePath.'/logicmodel.php', $params)
			);
			$this->files[]=new CCodeFile(
				Yii::getPathOfAlias($this->modelPath).'/'.$className.'.php',
				$this->render($templatePath.'/model.php', $params)
			);			
		}
	}

	
	
}