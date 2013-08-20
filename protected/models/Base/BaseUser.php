<?php

/**
 * This is the model class for table "user".
 * @author Cheng Gang <chenggang.china@gmail.com>
 * @link 
 * @copyright Copyright &copy; 2009-2010 
 * @date time 2012-08-24 08:20:12 */
class BaseUser extends CActiveRecord
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
	 * 
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
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'uid' => Yii::t('models/User','Uid'),
			'type' => Yii::t('models/User','Type'),
			'email' => Yii::t('models/User','Email'),
			'pwd' => Yii::t('models/User','Password'),
			'repwd' => Yii::t('models/User','Re-enter  Password'),
			'first_name' => Yii::t('models/User','First Name'),
			'last_name' => Yii::t('models/User','Last Name'),
			'office' => Yii::t('models/User','Office'),
			'mobile' => Yii::t('models/User','Mobile'),
			'fax' => Yii::t('models/User','Fax'),
			'broker' => Yii::t('models/User','Brokerage'),
			'team' => Yii::t('models/User','Team'),
			'about' => Yii::t('models/User','About Me'),
			'state' => Yii::t('models/User','State'),
			'city' => Yii::t('models/User','City'),
			'logo' => Yii::t('models/User','Logo'),
			'twitter_uname' => Yii::t('models/User','Twitter Uname'),
			'twitter_pwd' => Yii::t('models/User','Twitter Pwd'),
			'facebook_uname' => Yii::t('models/User','Facebook Uname'),
			'facebook_pwd' => Yii::t('models/User','Facebook Pwd'),
			'state_license' => Yii::t('models/User','State License'),
			'last_time' => Yii::t('models/User','Last Time'),
			'last_ip' => Yii::t('models/User','Last Ip'),
			'this_time' => Yii::t('models/User','This Time'),
			'this_ip' => Yii::t('models/User','This Ip'),
			'push_id' => Yii::t('models/User','push_id'),
			'forgetpwd' => Yii::t('models/User','forgetpwd'),
				
				'buyorsell' => Yii::t('models/User',''),
				'property_type' => Yii::t('models/User','Property Type'),
				'price_from' => Yii::t('models/User','Price From'),
				'price_to' => Yii::t('models/User','Price To'),
				'sqft_from' => Yii::t('models/User','Sqft From'),
				
				'sqft_to' => Yii::t('models/User','Sqft To'),
				'beds' => Yii::t('models/User','Beds'),
				'baths' => Yii::t('models/User','Baths'),
				'pool' => Yii::t('models/User','Pool'),
				'levels' => Yii::t('models/User','Levels'),
				
				'basement' => Yii::t('models/User','Basement'),
				'sell_status' => Yii::t('models/User','Sell Status'),
				'property_status' => Yii::t('models/User','Property Status'),
				'note' => Yii::t('models/User','Note'),
				'register_status' => Yii::t('models/User','Register Status'),
				'signature' => Yii::t('models/User','Signature'),
				'buyorsell_date' => Yii::t('models/User','Buy or Sell Date'),
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

		$criteria->compare('type',$this->type);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('pwd',$this->pwd,true);
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('office',$this->office,true);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('fax',$this->fax,true);
		$criteria->compare('broker',$this->broker,true);
		$criteria->compare('team',$this->team,true);
		$criteria->compare('about',$this->about,true);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('logo',$this->logo,true);
		$criteria->compare('twitter_uname',$this->twitter_uname,true);
		$criteria->compare('twitter_pwd',$this->twitter_pwd,true);
		$criteria->compare('facebook_uname',$this->facebook_uname,true);
		$criteria->compare('facebook_pwd',$this->facebook_pwd,true);
		$criteria->compare('state_license',$this->state_license,true);
		$criteria->compare('last_time',$this->last_time,true);
		$criteria->compare('last_ip',$this->last_ip,true);
		$criteria->compare('this_time',$this->this_time,true);
		$criteria->compare('this_ip',$this->this_ip,true);
		$criteria->compare('buyorsell',$this->buyorsell,true);
		$criteria->compare('property_type',$this->property_type,true);
		$criteria->compare('price_from',$this->price_from,true);
		$criteria->compare('price_to',$this->price_to,true);
		$criteria->compare('sqft_from',$this->sqft_from,true);
		$criteria->compare('sqft_to',$this->sqft_to,true);
		$criteria->compare('beds',$this->beds,true);
		$criteria->compare('baths',$this->baths,true);
		$criteria->compare('pool',$this->pool,true);
		$criteria->compare('levels',$this->levels,true);
		$criteria->compare('basement',$this->basement,true);
		$criteria->compare('sell_status',$this->sell_status,true);
		$criteria->compare('property_status',$this->property_status,true);
		$criteria->compare('note',$this->note,true);
		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}