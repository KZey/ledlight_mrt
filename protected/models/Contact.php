<?php
Yii::import('application.models.Base.BaseContact');

/**
 * This is the model class for table "contact".
 */
class Contact extends BaseContact
{
	/**
	 * The followings are the available columns in table 'contact':
	 * @var integer $id
	 * @var integer $uid_parent
	 * @var integer $uid_child
	 * @var integer $subscribe
	 * @var integer $type
	 * @var integer $indicator
	 * @var integer $referral_type
	 * @var integer $finacning_type
	 * @var string $note
	 * @var string $update_date
	 */
	/**
	 * Returns the static model of the specified AR class.
	 * @return Contact the static model class
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
			array('id, uid_parent, uid_child,subscribe, indicator, referral_type, finacning_type', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('type,subscribe,note,update_date', 'safe'),
			array('id, uid_parent, uid_child,subscribe', 'safe', 'on'=>'search'),
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
	public static function itemAlias($type,$code=NULL)
	{
		$_items = array(
				'Type' => array(
						1 => 'Buyer',
						2 => 'Seller',
						3 => 'Title company',
						4 => 'Inspector',
						5 => 'Professional services',
						6 => 'Lender',
						7 => 'Agent',
						8 => 'Renter',
				),
				'referral_type' => array(1=>'Associate/co-worker',2=>'Agent',3=>'Previous client',4=>'MRT',5=>'Sign Call',6=>'Friends'),
				'finacning_type' => array(1=>'Cash',2=>'FHA',3=>'Conventional',4=>'VA'),
				'indicator' => array(1=>'Hot',2=>'Cold',3=>'Warm'),
		);
	
		if (isset($code))
			return isset($_items[$type][$code]) ? $_items[$type][$code] : false;
		else
			return isset($_items[$type]) ? $_items[$type] : false;
	}
	
}