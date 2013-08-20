<?php
Yii::import('application.models.Base.BaseProperty');

/**
 * This is the model class for table "property".
 */
class Property extends BaseProperty
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
	 * @var float $commission_rate
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
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('ml_num,title,price,state,city,zip,street,year_built,house_size, lot_size', 'required','on'=>'current_property'),
		    array('price, house_size', 'numerical', 'integerOnly'=>true,'min'=>1),
			array('lot_size', 'numerical', 'integerOnly'=>true,'min'=>0),
			array('garage,transaction_price,expense_gas,expense_meals,expense_advertising,beds,garage,stories', 'numerical', 'integerOnly'=>true,'min'=>0),
			array('baths', 'numerical', 'min'=>0),
			array('year_built', 'numerical', 'integerOnly'=>true),
			
			array('closed_date,transaction_price,expense_gas,expense_meals,expense_advertising', 'required','on'=>'cloesd_property'),
			array('closed_date', 'compare', 'compareAttribute'=>'date','operator'=>'>=','message'=>'Close Date must be greater than or equal to Date Listed.', 'on'=>'cloesd_property'),
			
			array('year_built', 'compare', 'compareValue'=>date('Y',time()), 'operator'=>'<=','message'=>'Year built cannot be a future year.'),
			array('year_built', 'compare', 'compareValue'=>1001, 'operator'=>'>=','message'=>'Invalid Year.','on'=>'current_property'),
			
			array('commission_rate,transaction_price,expense_gas,expense_meals,expense_advertising,expense_1,expense_2,expense_custom,baths', 'type', 'type'=>'float'),
			array('commission_rate,transaction_price,expense_gas,expense_meals,expense_advertising,expense_1,expense_2,expense_custom', 'numerical', 'min'=>0),
			array('title, address, logo', 'length', 'max'=>255),
			array('desc, photos, videos, date,pool, levels,beds,baths,state,city,apt,zip,street,property_type, selling_status, property_status,closed_date,price_sqft,year_built,garage,style,stories,roofing,non_listing,commission_rate,update_date,transaction_price,expense_gas,expense_meals,expense_advertising,expense_1,expense_2,expense_custom,expense_custom_name,close_note', 'safe'),
			array('property_id, ml_num, title, price, property_type, selling_status, property_status, beds, baths, house_size, lot_size, pool, levels, address, desc, logo, photos, videos, date, uid, mrt_status', 'safe', 'on'=>'search'),
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
		);
	}
	
}
