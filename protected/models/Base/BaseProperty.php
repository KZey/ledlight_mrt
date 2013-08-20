<?php

/**
 * This is the model class for table "property".
 * @author Willie Wang <yyq129@gmail.com>
 * @link http://www.yyq129.com
 * @copyright Copyright &copy; 2009-2010 
 * @date time 2012-11-19 08:57:03 */
class BaseProperty extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'property':
	 * @var integer $property_id
	 * @var integer $ml_num
	 * @var string $title
	 * @var integer $price
	 * @var integer $property_type
	 * @var integer $selling_status
	 * @var integer $property_status
	 * @var integer $beds
	 * @var float $baths
	 * @var integer $house_size
	 * @var integer $lot_size
	 * @var integer $pool
	 * @var integer $levels
	 * @var string $address
	 * @var string $desc
	 * @var string $logo
	 * @var string $photos
	 * @var string $videos
	 * @var string $date
	 * @var string $update_date
	 * @var integer $uid
	 * @var integer $mrt_status
     *
	 * @var string $state
	 * @var string $city
	 * @var string $apt
	 * @var string $zip
	 * @var string $street
	 * 
	 * @var integer $price_sqft
	 * @var integer $year_built
	 * @var integer $garage
	 * @var string $stories
	 * 
	 * @var string $roofing
	 * @var integer $non_listing
	 * 
	 * @var integer $transaction_price
	 * @var float $expense_gas
	 * @var float $expense_meals
	 * @var float $expense_advertising
	 * @var float $expense_1
	 * @var float $expense_2
	 * @var float $expense_custom
	 * @var string $expense_custom_name
	 * @var string $close_note
	 */

	/**
	 * Returns the static model of the specified AR class.
	 * @return Property the static model class
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
		return 'property';
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'property_id' => Yii::t('models/Property','Property'),
			'ml_num' => Yii::t('models/Property','MLS Number'),
			'title' => Yii::t('models/Property','Title'),
			'price' => Yii::t('models/Property','Price'),
			'property_type' => Yii::t('models/Property','Property Type'),
			'selling_status' => Yii::t('models/Property','Selling Status'),
			'property_status' => Yii::t('models/Property','Property Status'),
			'beds' => Yii::t('models/Property','Beds'),
			'baths' => Yii::t('models/Property','Baths'),
			'house_size' => Yii::t('models/Property','House Size'),
			'lot_size' => Yii::t('models/Property','Lot Size'),
			'pool' => Yii::t('models/Property','Pool'),
			'levels' => Yii::t('models/Property','Levels'),
			'address' => Yii::t('models/Property','Address'),
			'desc' => Yii::t('models/Property','Description'),
			'logo' => Yii::t('models/Property','Logo'),
			'photos' => Yii::t('models/Property','Photos'),
			'videos' => Yii::t('models/Property','Videos'),
			'date' => Yii::t('models/Property','Date Listed'),
			'update_date' => Yii::t('models/Property','Last Updated'),
			'uid' => Yii::t('models/Property','Uid'),
			'mrt_status' => Yii::t('models/Property','Mrt Status'),
			'closed_date' => Yii::t('models/Property','Close Date'),
			
			'state' => Yii::t('models/Property','State'),
			'city' => Yii::t('models/Property','City'),
			'apt' => Yii::t('models/Property','APT/Unit#'),
			'zip' => Yii::t('models/Property','Zip'),
			'street' => Yii::t('models/Property','Street'),
			'price_sqft' => Yii::t('models/Property','Price Sqft'),
			'year_built' => Yii::t('models/Property','Year Built'),
			'garage' => Yii::t('models/Property','Garage'),
			'stories' => Yii::t('models/Property','Stories'),
			'non_listing' => Yii::t('models/Property','Non-Listing'),
			'roofing' => Yii::t('models/Property','Roofing'),
			'commission_rate' => Yii::t('models/Property','Commission Rate'),
				
			'transaction_price' => Yii::t('models/Property','Selling Price'),
			'expense_gas' => Yii::t('models/Property','Gas'),
			'expense_meals' => Yii::t('models/Property','Meals'),
			'expense_advertising' => Yii::t('models/Property','Advertising'),
			'expense_1' => Yii::t('models/Property','Others'),
			'expense_2' => Yii::t('models/Property','Expense 2'),
			'expense_custom' => Yii::t('models/Property','Expense Custom'),
			'expense_custom_name' => Yii::t('models/Property','Expense Custom Name'),
			'close_note' => Yii::t('models/Property','Close Note'),
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

		$criteria->compare('ml_num',$this->ml_num);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('price',$this->price,true);
		$criteria->compare('property_type',$this->property_type);
		$criteria->compare('selling_status',$this->selling_status);
		$criteria->compare('property_status',$this->property_status);
		$criteria->compare('beds',$this->beds);
		$criteria->compare('baths',$this->baths);
		$criteria->compare('house_size',$this->house_size);
		$criteria->compare('lot_size',$this->lot_size);
		$criteria->compare('pool',$this->pool);
		$criteria->compare('levels',$this->levels);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('desc',$this->desc,true);
		$criteria->compare('logo',$this->logo,true);
		$criteria->compare('photos',$this->photos,true);
		$criteria->compare('videos',$this->videos,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('uid',$this->uid);
		$criteria->compare('mrt_status',$this->mrt_status);
		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}