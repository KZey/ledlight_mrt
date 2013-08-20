<?php

/**
 * This is the model class for table "calendar".
 * @author Willie Wang <yyq129@gmail.com>
 * @link http://www.yyq129.com
 * @copyright Copyright &copy; 2009-2010 
 * @date time 2012-09-24 05:18:22 */
class BaseCalendar extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'calendar':
	 * @var integer $id
	 * @var integer $uid
	 * @var datetime $start_time
	 * @var datetime $end_time
	 * @var string $title
	 * @var string $content
	 * @var datetime $create_time
	 * @var string $invite_uid
	 */
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return Calendar the static model class
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
		return 'calendar';
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('models/Calendar','ID'),
			'uid' => Yii::t('models/Calendar','Uid'),
			'start_time' => Yii::t('models/Calendar','From'),
			'end_time' => Yii::t('models/Calendar','To'),
			'title' => Yii::t('models/Calendar','Subject'),
			'content' => Yii::t('models/Calendar','Description'),
			'create_time' => Yii::t('models/Calendar','Create Time'),
			'invite_uid' => Yii::t('models/Calendar','Invite My Contact'),
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

		$criteria->compare('uid',$this->uid);
		$criteria->compare('start_time',$this->start_time);
		$criteria->compare('end_time',$this->end_time);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('invite_uid',$this->invite_uid,true);
		$criteria->compare('create_time',$this->create_time);
		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}