<?php

/**
 * This is the model class for table "client_expense".
 * @author Willie Wang <yyq129@gmail.com>
 * @link http://www.yyq129.com
 * @copyright Copyright &copy; 2009-2010 
 * @date time 2012-11-06 14:26:49 */
class BaseClientExpense extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'client_expense':
	 * @var integer $id
	 * @var integer $realtor_uid
	 * @var integer $client_uid
	 * @var string $advertising
	 * @var string $gas
	 * @var string $meals
	 * @var integer $total
	 * @var string $add_date
	 * @var string $others
	 * @var string $note1
	 * @var string $note2
	 */
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return ClientExpense the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'client_expense';
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('models/ClientExpense','ID'),
			'realtor_uid' => Yii::t('models/ClientExpense','Realtor Uid'),
			'client_uid' => Yii::t('models/ClientExpense','Client Uid'),
			'advertising' => Yii::t('models/ClientExpense','Advertising'),
			'gas' => Yii::t('models/ClientExpense','Gas'),
			'meals' => Yii::t('models/ClientExpense','Meals'),
			'total' => Yii::t('models/ClientExpense','Total'),
			'add_date' => Yii::t('models/ClientExpense','Date of expense'),
			'others' => Yii::t('models/ClientExpense','Others'),
			'note1' => Yii::t('models/ClientExpense','Note 1'),
			'note2' => Yii::t('models/ClientExpense','Note 2'),
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('realtor_uid',$this->realtor_uid);
		$criteria->compare('client_uid',$this->client_uid);
		$criteria->compare('advertising',$this->advertising,true);
		$criteria->compare('gas',$this->gas,true);
		$criteria->compare('meals',$this->meals,true);
		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}