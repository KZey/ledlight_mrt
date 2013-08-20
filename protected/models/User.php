<?php
Yii::import('application.models.Base.BaseUser');

/**
 * This is the model class for table "user".
 */
class User extends BaseUser
{
	/**
	 * The followings are the available columns in table 'user':
	 * @var integer $uid
	 * @var integer $type
	 * @var string $email
	 * @var string $pwd
	 * @var string $repwd 
	 * @var string $first_name
	 * @var string $last_name
	 * @var string $office
	 * @var string $mobile
	 * @var string $fax
	 * @var string $broker
	 * @var string $team
	 * @var string $about
	 * @var string $state
	 * @var string $city
	 * @var string $phone
	 * @var string $logo
	 * @var string $twitter_uname
	 * @var string $twitter_pwd
	 * @var string $facebook_uname
	 * @var string $facebook_pwd
	 * @var string $state_license
	 * @var string $last_time
	 * @var string $last_ip
	 * @var string $this_time
	 * @var string $this_ip
	 * @var string $push_id
	 * @var string $forgetpwd
	 * @var string $buyorsell
	 * @var string $property_type
	 * @var string $price_from
	 * @var string $price_to
	 * @var string $sqft_from
	 * @var string $sqft_to
	 * @var string $beds
	 * @var string $baths
	 * @var string $pool
	 * @var string $levels
	 * @var string $basement
	 * @var string $sell_status
	 * @var string $property_status
	 * @var string $note
	 * @var integer $register_status
	 * @var string $signature
	 * @var string $buyorsell_date
	 * @var string $status
	 */
	public $repwd;
	/**
	 * Returns the static model of the specified AR class.
	 * @return User the static model class
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
			array('type', 'numerical', 'integerOnly'=>true),
			
			array('email, first_name, last_name,pwd,repwd,state,phone, city', 'required'),
// 			array('first_name', 'match', 'pattern' => '/^[0-9\-\s,]+$/u','message' => Yii::t('models/table',"Incorrect symbol's. (0-9-)")),
			
			array('email, first_name, last_name, office, mobile, fax, broker, team, state, city,phone, logo, twitter_uname, twitter_pwd, facebook_uname, facebook_pwd, state_license, last_ip, this_time, push_id', 'length', 'max'=>255),
			array('email','email'),
			array('email','unique','message'=>Yii::t('User','email_registered')),
			array('price_from', 'compare', 'compareAttribute'=>'price_to', 'operator'=>'<=','message'=>'Invalid Price Range.'),
			array('sqft_from', 'compare', 'compareAttribute'=>'sqft_to', 'operator'=>'<=','message'=>'Invalid Sqft Range.'),
			
			array('about, last_time, this_ip,buyorsell,property_type,price_from,price_to,sqft_from,sqft_to,beds,baths,pool,levels,basement,sell_status,property_status,note,signature,buyorsell_date, status', 'safe'),
			array('pwd', 'compare', 'compareAttribute'=>'repwd', 'message' => 'Re-enter Password is incorrect'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('uid, type, email, pwd, first_name, last_name, office,forgetpwd, mobile, fax, broker, team, about, state, city,phone, logo, twitter_uname, twitter_pwd, facebook_uname, facebook_pwd, state_license, last_time, last_ip, this_time, this_ip,
					buyorsell,property_type,price_from,price_to,sqft_from,sqft_to,beds,baths,pool,levels,basement,sell_status,property_status,note', 'safe', 'on'=>'search'),
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
				'state' => array(
						'AL ' => 'AL',
						'AK ' => 'AK',
						'AZ ' => 'AZ',
						'AR ' => 'AR',
						'CA ' => 'CA',
						'CO ' => 'CO',
						'CT ' => 'CT',
						'DE ' => 'DE',
						'FL ' => 'FL',
						'GA ' => 'GA',
						'HI ' => 'HI',
						'ID ' => 'ID',
						'IL ' => 'IL',
						'IN ' => 'IN',
						'IA ' => 'IA',
						'KS ' => 'KS',
						'KY ' => 'KY',
						'LA ' => 'LA',
						'ME ' => 'ME',
						'MD ' => 'MD',
						'MA ' => 'MA',
						'MI ' => 'MI',
						'MN ' => 'MN',
						'MS ' => 'MS',
						'MO ' => 'MO',
						'MT ' => 'MT',
						'NE ' => 'NE',
						'NV ' => 'NV',
						'NH ' => 'NH',
						'NJ ' => 'NJ',
						'NM ' => 'NM',
						'NY ' => 'NY',
						'NC ' => 'NC',
						'ND ' => 'ND',
						'OH ' => 'OH',
						'OK ' => 'OK',
						'OR ' => 'OR',
						'PA ' => 'PA',
						'RI ' => 'RI',
						'SC ' => 'SC',
						'SD ' => 'SD',
						'TN ' => 'TN',
						'TX ' => 'TX',
						'UT ' => 'UT',
						'VT ' => 'VT',
						'VA ' => 'VA',
						'WA ' => 'WA',
						'WV ' => 'WV',
						'WI ' => 'WI',
						'WY ' => 'WY',
				),
		);
	
		if (isset($code))
			return isset($_items[$type][$code]) ? $_items[$type][$code] : false;
		else
			return isset($_items[$type]) ? $_items[$type] : false;
	}
	
}
