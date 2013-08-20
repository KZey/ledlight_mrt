<?php
Yii::import('application.models.Base.BaseProspects');

/**
 * This is the model class for table "prospects".
 */
class Prospects extends BaseProspects
{
	/**
	 * The followings are the available columns in table 'prospects':
	 * @var integer $uid
	 * @var integer $uid_parent
	 * @var integer $type
	 * @var string $title
	 * @var string $first_name
	 * @var string $middle_name
	 * @var string $last_name
	 * @var string $suffix
	 * @var string $email_1
	 * @var string $email_2
	 * @var string $email_3
	 * @var string $mobile
	 * @var string $notes
	 * @var string $profession
	 * @var string $referred_buy
	 * @var string $birthday
	 * @var string $spouse
	 * @var string $gender
	 * @var string $home_street_1
	 * @var string $home_street_2
	 * @var string $home_street_3
	 * @var string $home_address_po_box
	 * @var string $home_city
	 * @var string $home_state
	 * @var string $home_postal_code
	 * @var string $home_country_region
	 * @var string $home_phone_1
	 * @var string $home_phone_2
	 * @var string $home_fax
	 * @var string $company
	 * @var string $department
	 * @var string $job_title
	 * @var string $business_street_1
	 * @var string $business_street_2
	 * @var string $business_street_3
	 * @var string $business_address_po_box
	 * @var string $business_city
	 * @var string $business_state
	 * @var string $business_postal_code
	 * @var string $business_country_region
	 * @var string $company_main_phone
	 * @var string $business_phone_1
	 * @var string $business_phone_2
	 * @var string $business_fax
	 * @var string $web_page
	 * @var string $assistants_name
	 * @var string $assistants_phone
	 * @var string $managers_name
	 * @var string $other_street_1
	 * @var string $other_street_2
	 * @var string $other_street_3
	 * @var string $other_address_po_box
	 * @var string $other_city
	 * @var string $other_state
	 * @var string $other_postal_code
	 * @var string $other_country_region
	 * @var string $other_phone
	 * @var string $other_fax
	 * @var string $isdn
	 * @var string $account
	 * @var string $anniversary
	 * @var string $billing_information
	 * @var string $callback
	 * @var string $car_phone
	 * @var string $categories
	 * @var string $children
	 * @var string $directory_server
	 * @var string $email_2_display_name
	 * @var string $email_2_type
	 * @var string $email_3_display_name
	 * @var string $email_3_type
	 * @var string $email_display_name
	 * @var string $email_type
	 * @var string $government_id_number
	 * @var string $hobby
	 * @var string $pager
	 * @var string $primary_phone
	 * @var string $radio_phone
	 * @var string $telex
	 * @var string $tty_tdd_phone
	 * @var string $initials
	 * @var string $internet_free_busy
	 * @var string $keywords
	 * @var string $language
	 * @var string $location
	 * @var string $mileage
	 * @var string $office_location
	 * @var string $orgainization_id_number
	 * @var string $priority
	 * @var string $private
	 * @var string $sensitivity
	 * @var string $user_1
	 * @var string $user_2
	 * @var string $user_3
	 * @var string $user_4
	 */

	/**
	 * Returns the static model of the specified AR class.
	 * @return Prospects the static model class
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
			array('uid_parent, type', 'numerical', 'integerOnly'=>true),
			array('email_1', 'required'),
			array('email_1, email_2, email_3', 'email'),
			array('title, first_name, middle_name, last_name, suffix, email_1, email_2, email_3, mobile, profession, referred_buy, birthday, spouse, home_street_1, home_street_2, home_street_3, home_address_po_box, home_city, home_state, home_postal_code, home_country_region, home_phone_1, home_phone_2, home_fax, company, department, job_title, business_street_1, business_street_2, business_street_3, business_address_po_box, business_city, business_state, business_postal_code, business_country_region, company_main_phone, business_phone_1, business_phone_2, business_fax, web_page, assistants_name, assistants_phone, managers_name, other_street_1, other_street_2, other_street_3, other_address_po_box, other_city, other_state, other_postal_code, other_country_region, other_phone, other_fax, isdn, account, anniversary, callback, car_phone, categories, children, directory_server, email_2_display_name, email_2_type, email_3_display_name, email_3_type, email_display_name, email_type, government_id_number, hobby, pager, primary_phone, radio_phone, telex, tty_tdd_phone, initials, internet_free_busy, language, mileage, orgainization_id_number, priority, private, user_1, user_2, user_3, user_4', 'length', 'max'=>255),
			array('notes, gender, billing_information, keywords, location, office_location, sensitivity', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('uid, uid_parent, type, title, first_name, middle_name, last_name, suffix, email_1, email_2, email_3, mobile, notes, profession, referred_buy, birthday, spouse, gender, home_street_1, home_street_2, home_street_3, home_address_po_box, home_city, home_state, home_postal_code, home_country_region, home_phone_1, home_phone_2, home_fax, company, department, job_title, business_street_1, business_street_2, business_street_3, business_address_po_box, business_city, business_state, business_postal_code, business_country_region, company_main_phone, business_phone_1, business_phone_2, business_fax, web_page, assistants_name, assistants_phone, managers_name, other_street_1, other_street_2, other_street_3, other_address_po_box, other_city, other_state, other_postal_code, other_country_region, other_phone, other_fax, isdn, account, anniversary, billing_information, callback, car_phone, categories, children, directory_server, email_2_display_name, email_2_type, email_3_display_name, email_3_type, email_display_name, email_type, government_id_number, hobby, pager, primary_phone, radio_phone, telex, tty_tdd_phone, initials, internet_free_busy, keywords, language, location, mileage, office_location, orgainization_id_number, priority, private, sensitivity, user_1, user_2, user_3, user_4', 'safe', 'on'=>'search'),
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
		);
	
		if (isset($code))
			return isset($_items[$type][$code]) ? $_items[$type][$code] : false;
		else
			return isset($_items[$type]) ? $_items[$type] : false;
	}
}