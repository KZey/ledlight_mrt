<?php

/**
 * This is the model class for table "share_non_listing".
 * @author Willie Wang <yyq129@gmail.com>
 * @link http://www.yyq129.com
 * @copyright Copyright &copy; 2009-2010 
 * @date time 2013-01-31 15:34:41 */
class BaseShareNonListing extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'share_non_listing':
	 * @var integer $sid
	 * @var integer $uid
	 * @var integer $property_id
	 */

	/**
	 * Returns the static model of the specified AR class.
	 * @return ShareNonListing the static model class
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
		return 'share_non_listing';
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'sid' => Yii::t('models/ShareNonListing','Sid'),
			'uid' => Yii::t('models/ShareNonListing','Uid'),
			'property_id' => Yii::t('models/ShareNonListing','Property'),
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
		$criteria->compare('property_id',$this->property_id);
		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}