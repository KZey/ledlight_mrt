<?php
Yii::import('application.models.Base.BaseFavorite');

/**
 * This is the model class for table "favorite".
 */
class Favorite extends BaseFavorite
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
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('uid, property_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, uid, property_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
				'property_info'=>array(self::BELONGS_TO, 'Property', 'property_id'),
		);
	}
	
}