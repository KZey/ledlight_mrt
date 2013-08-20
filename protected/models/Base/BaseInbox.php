<?php

/**
 * This is the model class for table "inbox".
 * @author Willie Wang <yyq129@gmail.com>
 * @link http://www.yyq129.com
 * @copyright Copyright &copy; 2009-2010 
 * @date time 2012-10-08 02:29:33 */
class BaseInbox extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'inbox':
	 * @var integer $id
	 * @var integer $type
	 * @var integer $from_uid
	 * @var integer $to_uid
	 * @var string $title
	 * @var string $content
	 * @var string $date
	 */

	/**
	 * Returns the static model of the specified AR class.
	 * @return Inbox the static model class
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
		return 'inbox';
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('models/Inbox','ID'),
			'type' => Yii::t('models/Inbox','Type'),
			'from_uid' => Yii::t('models/Inbox','From Uid'),
			'to_uid' => Yii::t('models/Inbox','To Uid'),
			'title' => Yii::t('models/Inbox','Phone'),
			'content' => Yii::t('models/Inbox','Message'),
			'date' => Yii::t('models/Inbox','Date'),
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

		$criteria->compare('from_uid',$this->from_uid);
		$criteria->compare('to_uid',$this->to_uid);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('date',$this->date,true);
		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}