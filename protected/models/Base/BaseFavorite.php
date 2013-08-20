<?php

/**
 * This is the model class for table "favorite".
 * @author Willie Wang <yyq129@gmail.com>
 * @link http://www.yyq129.com
 * @copyright Copyright &copy; 2009-2010 
 * @date time 2012-11-27 02:06:48 */
class BaseFavorite extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'favorite':
	 * @var integer $id
	 * @var integer $uid
	 * @var integer $property_id
	 */

	/**
	 * Returns the static model of the specified AR class.
	 * @return Favorite the static model class
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
		return 'favorite';
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('models/Favorite','ID'),
			'uid' => Yii::t('models/Favorite','Uid'),
			'property_id' => Yii::t('models/Favorite','Property'),
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