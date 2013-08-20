<?php

/**
 * This is the model class for table "prospects".
 * @author Willie Wang <yyq129@gmail.com>
 * @link http://www.yyq129.com
 * @copyright Copyright &copy; 2009-2010 
 * @date time 2013-02-22 17:03:30 */
class BaseProspects extends CActiveRecord
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
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'prospects';
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'uid' => Yii::t('models/Prospects','Uid'),
			'uid_parent' => Yii::t('models/Prospects','Uid Parent'),
			'type' => Yii::t('models/Prospects','Type'),
			'title' => Yii::t('models/Prospects','Title'),
			'first_name' => Yii::t('models/Prospects','First Name'),
			'middle_name' => Yii::t('models/Prospects','Middle Name'),
			'last_name' => Yii::t('models/Prospects','Last Name'),
			'suffix' => Yii::t('models/Prospects','Suffix'),
			'email_1' => Yii::t('models/Prospects','Email Address'),
			'email_2' => Yii::t('models/Prospects','2nd Email Address'),
			'email_3' => Yii::t('models/Prospects','3nd Email Address'),
			'mobile' => Yii::t('models/Prospects','Mobile'),
			'notes' => Yii::t('models/Prospects','Notes'),
			'profession' => Yii::t('models/Prospects','Profession'),
			'referred_buy' => Yii::t('models/Prospects','Referred By'),
			'birthday' => Yii::t('models/Prospects','Birthday'),
			'spouse' => Yii::t('models/Prospects','Spouse'),
			'gender' => Yii::t('models/Prospects','Gender'),
			'home_street_1' => Yii::t('models/Prospects','Address'),
			'home_street_2' => Yii::t('models/Prospects','2nd Address'),
			'home_street_3' => Yii::t('models/Prospects','3nd Address'),
			'home_address_po_box' => Yii::t('models/Prospects','PO Box'),
			'home_city' => Yii::t('models/Prospects','City'),
			'home_state' => Yii::t('models/Prospects','State'),
			'home_postal_code' => Yii::t('models/Prospects','Zip'),
			'home_country_region' => Yii::t('models/Prospects','Country'),
			'home_phone_1' => Yii::t('models/Prospects','Phone'),
			'home_phone_2' => Yii::t('models/Prospects','2nd Phone'),
			'home_fax' => Yii::t('models/Prospects','Fax'),
			'company' => Yii::t('models/Prospects','Company'),
			'department' => Yii::t('models/Prospects','Department'),
			'job_title' => Yii::t('models/Prospects','Job Title'),
			'business_street_1' => Yii::t('models/Prospects','Address'),
			'business_street_2' => Yii::t('models/Prospects','2nd Address'),
			'business_street_3' => Yii::t('models/Prospects','3nd Address'),
			'business_address_po_box' => Yii::t('models/Prospects','PO Box'),
			'business_city' => Yii::t('models/Prospects','City'),
			'business_state' => Yii::t('models/Prospects','State'),
			'business_postal_code' => Yii::t('models/Prospects','Zip'),
			'business_country_region' => Yii::t('models/Prospects','Country'),
			'company_main_phone' => Yii::t('models/Prospects','Company Main Phone'),
			'business_phone_1' => Yii::t('models/Prospects','Phone'),
			'business_phone_2' => Yii::t('models/Prospects','2nd Phone'),
			'business_fax' => Yii::t('models/Prospects','Fax'),
			'web_page' => Yii::t('models/Prospects','Web Page'),
			'assistants_name' => Yii::t('models/Prospects','Assistants'),
			'assistants_phone' => Yii::t('models/Prospects','Assistants Phone'),
			'managers_name' => Yii::t('models/Prospects','Managers'),
			'other_street_1' => Yii::t('models/Prospects','Address'),
			'other_street_2' => Yii::t('models/Prospects','2nd Address'),
			'other_street_3' => Yii::t('models/Prospects','3nd Address'),
			'other_address_po_box' => Yii::t('models/Prospects','PO Box'),
			'other_city' => Yii::t('models/Prospects','City'),
			'other_state' => Yii::t('models/Prospects','State'),
			'other_postal_code' => Yii::t('models/Prospects','Zip'),
			'other_country_region' => Yii::t('models/Prospects','Country'),
			'other_phone' => Yii::t('models/Prospects','Phone'),
			'other_fax' => Yii::t('models/Prospects','Fax'),
			'isdn' => Yii::t('models/Prospects','Isdn'),
			'account' => Yii::t('models/Prospects','Account'),
			'anniversary' => Yii::t('models/Prospects','Anniversary'),
			'billing_information' => Yii::t('models/Prospects','Billing Information'),
			'callback' => Yii::t('models/Prospects','Callback'),
			'car_phone' => Yii::t('models/Prospects','Car Phone'),
			'categories' => Yii::t('models/Prospects','Categories'),
			'children' => Yii::t('models/Prospects','Children'),
			'directory_server' => Yii::t('models/Prospects','Directory Server'),
			'email_2_display_name' => Yii::t('models/Prospects','Email 2 Display Name'),
			'email_2_type' => Yii::t('models/Prospects','Email 2 Type'),
			'email_3_display_name' => Yii::t('models/Prospects','Email 3 Display Name'),
			'email_3_type' => Yii::t('models/Prospects','Email 3 Type'),
			'email_display_name' => Yii::t('models/Prospects','Email Display Name'),
			'email_type' => Yii::t('models/Prospects','Email Type'),
			'government_id_number' => Yii::t('models/Prospects','Government Id Number'),
			'hobby' => Yii::t('models/Prospects','Hobby'),
			'pager' => Yii::t('models/Prospects','Pager'),
			'primary_phone' => Yii::t('models/Prospects','Primary Phone'),
			'radio_phone' => Yii::t('models/Prospects','Radio Phone'),
			'telex' => Yii::t('models/Prospects','Telex'),
			'tty_tdd_phone' => Yii::t('models/Prospects','Tty Tdd Phone'),
			'initials' => Yii::t('models/Prospects','Initials'),
			'internet_free_busy' => Yii::t('models/Prospects','Internet Free Busy'),
			'keywords' => Yii::t('models/Prospects','Keywords'),
			'language' => Yii::t('models/Prospects','Language'),
			'location' => Yii::t('models/Prospects','Location'),
			'mileage' => Yii::t('models/Prospects','Mileage'),
			'office_location' => Yii::t('models/Prospects','Office Location'),
			'orgainization_id_number' => Yii::t('models/Prospects','Orgainization Id Number'),
			'priority' => Yii::t('models/Prospects','Priority'),
			'private' => Yii::t('models/Prospects','Private'),
			'sensitivity' => Yii::t('models/Prospects','Sensitivity'),
			'user_1' => Yii::t('models/Prospects','User 1'),
			'user_2' => Yii::t('models/Prospects','User 2'),
			'user_3' => Yii::t('models/Prospects','User 3'),
			'user_4' => Yii::t('models/Prospects','User 4'),
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

		$criteria->compare('uid_parent',$this->uid_parent);
		$criteria->compare('type',$this->type);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('middle_name',$this->middle_name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('suffix',$this->suffix,true);
		$criteria->compare('email_1',$this->email_1,true);
		$criteria->compare('email_2',$this->email_2,true);
		$criteria->compare('email_3',$this->email_3,true);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('notes',$this->notes,true);
		$criteria->compare('profession',$this->profession,true);
		$criteria->compare('referred_buy',$this->referred_buy,true);
		$criteria->compare('birthday',$this->birthday,true);
		$criteria->compare('spouse',$this->spouse,true);
		$criteria->compare('gender',$this->gender,true);
		$criteria->compare('home_street_1',$this->home_street_1,true);
		$criteria->compare('home_street_2',$this->home_street_2,true);
		$criteria->compare('home_street_3',$this->home_street_3,true);
		$criteria->compare('home_address_po_box',$this->home_address_po_box,true);
		$criteria->compare('home_city',$this->home_city,true);
		$criteria->compare('home_state',$this->home_state,true);
		$criteria->compare('home_postal_code',$this->home_postal_code,true);
		$criteria->compare('home_country_region',$this->home_country_region,true);
		$criteria->compare('home_phone_1',$this->home_phone_1,true);
		$criteria->compare('home_phone_2',$this->home_phone_2,true);
		$criteria->compare('home_fax',$this->home_fax,true);
		$criteria->compare('company',$this->company,true);
		$criteria->compare('department',$this->department,true);
		$criteria->compare('job_title',$this->job_title,true);
		$criteria->compare('business_street_1',$this->business_street_1,true);
		$criteria->compare('business_street_2',$this->business_street_2,true);
		$criteria->compare('business_street_3',$this->business_street_3,true);
		$criteria->compare('business_address_po_box',$this->business_address_po_box,true);
		$criteria->compare('business_city',$this->business_city,true);
		$criteria->compare('business_state',$this->business_state,true);
		$criteria->compare('business_postal_code',$this->business_postal_code,true);
		$criteria->compare('business_country_region',$this->business_country_region,true);
		$criteria->compare('company_main_phone',$this->company_main_phone,true);
		$criteria->compare('business_phone_1',$this->business_phone_1,true);
		$criteria->compare('business_phone_2',$this->business_phone_2,true);
		$criteria->compare('business_fax',$this->business_fax,true);
		$criteria->compare('web_page',$this->web_page,true);
		$criteria->compare('assistants_name',$this->assistants_name,true);
		$criteria->compare('assistants_phone',$this->assistants_phone,true);
		$criteria->compare('managers_name',$this->managers_name,true);
		$criteria->compare('other_street_1',$this->other_street_1,true);
		$criteria->compare('other_street_2',$this->other_street_2,true);
		$criteria->compare('other_street_3',$this->other_street_3,true);
		$criteria->compare('other_address_po_box',$this->other_address_po_box,true);
		$criteria->compare('other_city',$this->other_city,true);
		$criteria->compare('other_state',$this->other_state,true);
		$criteria->compare('other_postal_code',$this->other_postal_code,true);
		$criteria->compare('other_country_region',$this->other_country_region,true);
		$criteria->compare('other_phone',$this->other_phone,true);
		$criteria->compare('other_fax',$this->other_fax,true);
		$criteria->compare('isdn',$this->isdn,true);
		$criteria->compare('account',$this->account,true);
		$criteria->compare('anniversary',$this->anniversary,true);
		$criteria->compare('billing_information',$this->billing_information,true);
		$criteria->compare('callback',$this->callback,true);
		$criteria->compare('car_phone',$this->car_phone,true);
		$criteria->compare('categories',$this->categories,true);
		$criteria->compare('children',$this->children,true);
		$criteria->compare('directory_server',$this->directory_server,true);
		$criteria->compare('email_2_display_name',$this->email_2_display_name,true);
		$criteria->compare('email_2_type',$this->email_2_type,true);
		$criteria->compare('email_3_display_name',$this->email_3_display_name,true);
		$criteria->compare('email_3_type',$this->email_3_type,true);
		$criteria->compare('email_display_name',$this->email_display_name,true);
		$criteria->compare('email_type',$this->email_type,true);
		$criteria->compare('government_id_number',$this->government_id_number,true);
		$criteria->compare('hobby',$this->hobby,true);
		$criteria->compare('pager',$this->pager,true);
		$criteria->compare('primary_phone',$this->primary_phone,true);
		$criteria->compare('radio_phone',$this->radio_phone,true);
		$criteria->compare('telex',$this->telex,true);
		$criteria->compare('tty_tdd_phone',$this->tty_tdd_phone,true);
		$criteria->compare('initials',$this->initials,true);
		$criteria->compare('internet_free_busy',$this->internet_free_busy,true);
		$criteria->compare('keywords',$this->keywords,true);
		$criteria->compare('language',$this->language,true);
		$criteria->compare('location',$this->location,true);
		$criteria->compare('mileage',$this->mileage,true);
		$criteria->compare('office_location',$this->office_location,true);
		$criteria->compare('orgainization_id_number',$this->orgainization_id_number,true);
		$criteria->compare('priority',$this->priority,true);
		$criteria->compare('private',$this->private,true);
		$criteria->compare('sensitivity',$this->sensitivity,true);
		$criteria->compare('user_1',$this->user_1,true);
		$criteria->compare('user_2',$this->user_2,true);
		$criteria->compare('user_3',$this->user_3,true);
		$criteria->compare('user_4',$this->user_4,true);
		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}