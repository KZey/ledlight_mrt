<?php
Yii::import('application.models.Base.BaseApply');

/**
 * This is the model class for table "apply".
 */
class Apply extends BaseApply
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
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('email, first_name, last_name,state,state_license', 'required'),
			array('email, first_name, last_name, office, mobile, broker, team, about, state, city, state_license, forgetpwd', 'length', 'max'=>255),
			array('add_date,status', 'safe'),
			array('email','email'),
			array('email','unique','message'=>Yii::t('User','email_registered')),
			
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, email, first_name, last_name, office, mobile, broker, team, about, state, city, state_license, forgetpwd, add_date', 'safe', 'on'=>'search'),
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
				'status' => array('0' => 'No verification','1' => 'Reject','2' => 'Agreed',),
		);
	
		if (isset($code))
			return isset($_items[$type][$code]) ? $_items[$type][$code] : false;
		else
			return isset($_items[$type]) ? $_items[$type] : false;
	}
	
}