<?php

/**
 * This is the model class for table "apply".
 * @author Willie Wang <yyq129@gmail.com>
 * @link http://www.yyq129.com
 * @copyright Copyright &copy; 2009-2010 
 * @date time 2013-03-14 16:05:21 */
class BaseApply extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'apply':
	 * @var integer $id
	 * @var string $email
	 * @var string $first_name
	 * @var string $last_name
	 * @var string $office
	 * @var string $mobile
	 * @var string $broker
	 * @var string $team
	 * @var string $about
	 * @var string $state
	 * @var string $city
	 * @var string $state_license
	 * @var string $forgetpwd
	 * @var string $add_date
	 * @var integer $status
	 */
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return Apply the static model class
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
		return 'apply';
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('models/Apply','ID'),
			'email' => Yii::t('models/Apply','Email'),
			'first_name' => Yii::t('models/Apply','First Name'),
			'last_name' => Yii::t('models/Apply','Last Name'),
			'office' => Yii::t('models/Apply','Office'),
			'mobile' => Yii::t('models/Apply','Mobile'),
			'broker' => Yii::t('models/Apply','Broker'),
			'team' => Yii::t('models/Apply','Team'),
			'about' => Yii::t('models/Apply','About'),
			'state' => Yii::t('models/Apply','State'),
			'city' => Yii::t('models/Apply','City'),
			'state_license' => Yii::t('models/Apply','State License'),
			'forgetpwd' => Yii::t('models/Apply','Forgetpwd'),
			'add_date' => Yii::t('models/Apply','Add Date'),
			'status' => Yii::t('models/Apply','status'),
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
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('office',$this->office,true);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('broker',$this->broker,true);
		$criteria->compare('team',$this->team,true);
		$criteria->compare('about',$this->about,true);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('state_license',$this->state_license,true);
		$criteria->compare('forgetpwd',$this->forgetpwd,true);
		$criteria->compare('add_date',$this->add_date,true);
		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}