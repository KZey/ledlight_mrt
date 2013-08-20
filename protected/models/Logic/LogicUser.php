<?php
Yii::import('application.models.User');

/**
 * This is the model class for table "user".
 * @author Cheng Gang <chenggang.china@gmail.com>
 * @link 
 * @copyright Copyright &copy; 2009-2010 
 * @date time 2012-08-24 08:20:12 */
class LogicUser extends User
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
	 */
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}