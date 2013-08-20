<?php
Yii::import('application.models.Base.BaseManager');

/**
 * This is the model class for table "manager".
 */
class Manager extends BaseManager
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
	 * @var string $forgetpwd
	 */
	public $repwd;
	/**
	 * Returns the static model of the specified AR class.
	 * @return Manager the static model class
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
			array('sex', 'numerical', 'integerOnly'=>true),
			array('email, pwd,repwd', 'required'),
			array('email, nickname, first_name, last_name, logo, office, mobile, fax, state, city, service_email', 'length', 'max'=>255),
			array('pwd', 'length', 'max'=>32),
			array('email','email'),
			array('pwd', 'compare', 'compareAttribute'=>'repwd', 'message' => 'Re-enter Password is incorrect'),
			array('about, last_time, this_time, add_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('uid, email, pwd, nickname, first_name, last_name, logo, forgetpwd,sex, office, mobile, fax, about, state, city, last_time, this_time, service_email, add_time', 'safe', 'on'=>'search'),
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
	
}