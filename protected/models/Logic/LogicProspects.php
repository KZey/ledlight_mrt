<?php
Yii::import('application.models.Prospects');

/**
 * This is the model class for table "prospects".
 * @author Willie Wang <yyq129@gmail.com>
 * @link http://www.yyq129.com
 * @copyright Copyright &copy; 2009-2010 
 * @date time 2013-02-22 17:03:30 */
class LogicProspects extends Prospects
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
}