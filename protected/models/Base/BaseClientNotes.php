<?php

/**
 * This is the model class for table "client_notes".
 * @author Willie Wang <yyq129@gmail.com>
 * @link http://www.yyq129.com
 * @copyright Copyright &copy; 2009-2010 
 * @date time 2013-03-11 15:30:42 */
class BaseClientNotes extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'client_notes':
	 * @var integer $id
	 * @var integer $realtor_uid
	 * @var integer $client_uid
	 * @var string $note
	 * @var string $add_date
	 * @var string $note1
	 * @var string $note2
	 */

	/**
	 * Returns the static model of the specified AR class.
	 * @return ClientNotes the static model class
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
		return 'client_notes';
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('models/ClientNotes','ID'),
			'realtor_uid' => Yii::t('models/ClientNotes','Realtor Uid'),
			'client_uid' => Yii::t('models/ClientNotes','Client Uid'),
			'note' => Yii::t('models/ClientNotes','Note'),
			'add_date' => Yii::t('models/ClientNotes','Add Date'),
			'note1' => Yii::t('models/ClientNotes','Note1'),
			'note2' => Yii::t('models/ClientNotes','Note2'),
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
		$criteria->compare('note',$this->note,true);
		$criteria->compare('add_date',$this->add_date,true);
		$criteria->compare('note1',$this->note1,true);
		$criteria->compare('note2',$this->note2,true);
		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}