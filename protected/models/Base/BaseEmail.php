<?php

/**
 * This is the model class for table "email".
 * @author Willie Wang <yyq129@gmail.com>
 * @link http://www.yyq129.com
 * @copyright Copyright &copy; 2009-2010 
 * @date time 2012-10-15 07:32:24 */
class BaseEmail extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'email':
	 * @var integer $id
	 * @var integer $from_uid
	 * @var integer $to_uid
	 * @var string $title
	 * @var string $contents
	 * @var string $send_date
	 * @var string $attachments
	 * @var integer $property_id
	 * @var string $toemail
	 */
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return Email the static model class
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
		return 'email';
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('models/Email','ID'),
			'from_uid' => Yii::t('models/Email','From Uid'),
			'to_uid' => Yii::t('models/Email','To'),
			'title' => Yii::t('models/Email','Title'),
			'contents' => Yii::t('models/Email','Contents'),
			'send_date' => Yii::t('models/Email','Send Date'),
			'attachments' => Yii::t('models/Email','Attachments'),
			'property_id' => Yii::t('models/property_id','Property ID'),
			'toemail' => Yii::t('models/toemail','Email'),
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
		$criteria->compare('contents',$this->contents,true);
		$criteria->compare('send_date',$this->send_date,true);
		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}