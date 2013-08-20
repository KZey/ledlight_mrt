<?php
Yii::import('application.models.Property');

/**
 * This is the model class for table "property".
 * @author Willie Wang <yyq129@gmail.com>
 * @link http://www.yyq129.com
 * @copyright Copyright &copy; 2009-2010 
 * @date time 2012-11-19 08:57:03 */
class LogicProperty extends Property
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
}