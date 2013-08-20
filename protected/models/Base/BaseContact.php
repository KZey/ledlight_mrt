<?php

/**
 * This is the model class for table "contact".
 * @author Cheng Gang <chenggang.china@gmail.com>
 * @link 
 * @copyright Copyright &copy; 2009-2010 
 * @date time 2012-08-29 02:54:43 */
class BaseContact extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'contact':
	 * @var integer $id
	 * @var integer $uid_parent
	 * @var integer $uid_child
	 * @var integer $subscribe
	 * @var integer $type
	 * @var integer $indicator
	 * @var integer $referral_type
	 * @var integer $finacning_type
	 * @var string $note
	 * @var string $update_date
	 */
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return Contact the static model class
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
		return 'contact';
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('models/Contact','ID'),
			'uid_parent' => Yii::t('models/Contact','Uid Parent'),
			'uid_child' => Yii::t('models/Contact','Uid Child'),
			'subscribe' => Yii::t('models/Contact','Subscribe'),
			'type' => Yii::t('models/Contact','Type'),
			'indicator' => Yii::t('models/ClientExpense','Indicator'),
			'referral_type' => Yii::t('models/ClientExpense','Referral Type'),
			'finacning_type' => Yii::t('models/ClientExpense','Financing Type'),
			'note' => Yii::t('models/ClientExpense','Note'),
			'update_date' => Yii::t('models/ClientExpense','Update Date'),
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

		$criteria->compare('uid_parent',$this->uid_parent);
		$criteria->compare('uid_child',$this->uid_child);
		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}