<?php

/**
 * This is the model class for table "manager".
 * @author Willie Wang <yyq129@gmail.com>
 * @link http://www.yyq129.com
 * @copyright Copyright &copy; 2009-2010 
 * @date time 2013-03-14 17:54:10 */
class BaseManager extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'manager':
	 * @var integer $uid
	 * @var string $email
	 * @var string $pwd
	 * @var string $nickname
	 * @var string $first_name
	 * @var string $last_name
	 * @var string $logo
	 * @var integer $sex
	 * @var string $office
	 * @var string $mobile
	 * @var string $fax
	 * @var string $about
	 * @var string $state
	 * @var string $city
	 * @var string $last_time
	 * @var string $this_time
	 * @var string $service_email
	 * @var string $add_time
	 */

	/**
	 * Returns the static model of the specified AR class.
	 * @return Manager the static model class
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
		return 'manager';
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'uid' => Yii::t('models/Manager','Uid'),
			'email' => Yii::t('models/Manager','Email'),
			'pwd' => Yii::t('models/Manager','Pwd'),
			'nickname' => Yii::t('models/Manager','Nickname'),
			'first_name' => Yii::t('models/Manager','First Name'),
			'last_name' => Yii::t('models/Manager','Last Name'),
			'logo' => Yii::t('models/Manager','Logo'),
			'sex' => Yii::t('models/Manager','Sex'),
			'office' => Yii::t('models/Manager','Office'),
			'mobile' => Yii::t('models/Manager','Mobile'),
			'fax' => Yii::t('models/Manager','Fax'),
			'about' => Yii::t('models/Manager','About'),
			'state' => Yii::t('models/Manager','State'),
			'city' => Yii::t('models/Manager','City'),
			'last_time' => Yii::t('models/Manager','Last Time'),
			'this_time' => Yii::t('models/Manager','This Time'),
			'service_email' => Yii::t('models/Manager','Service Email'),
			'add_time' => Yii::t('models/Manager','Add Time'),
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

		$criteria->compare('email',$this->email,true);
		$criteria->compare('pwd',$this->pwd,true);
		$criteria->compare('nickname',$this->nickname,true);
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('logo',$this->logo,true);
		$criteria->compare('sex',$this->sex);
		$criteria->compare('office',$this->office,true);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('fax',$this->fax,true);
		$criteria->compare('about',$this->about,true);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('last_time',$this->last_time,true);
		$criteria->compare('this_time',$this->this_time,true);
		$criteria->compare('service_email',$this->service_email,true);
		$criteria->compare('add_time',$this->add_time,true);
		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}