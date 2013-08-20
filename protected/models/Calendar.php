<?php
Yii::import('application.models.Base.BaseCalendar');

/**
 * This is the model class for table "calendar".
 */
class Calendar extends BaseCalendar
{
	/**
	 * The followings are the available columns in table 'calendar':
	 * @var integer $id
	 * @var integer $uid
	 * @var datetime $start_time
	 * @var datetime $end_time
	 * @var string $title
	 * @var string $content
	 * @var datetime $create_time
	 * @var string $invite_uid
	 */

	/**
	 * Returns the static model of the specified AR class.
	 * @return Calendar the static model class
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
			array('start_time, end_time,title,content', 'required'),
			array('start_time, end_time', 'date', 'format'=>'yyyy-MM-dd HH:mm:ss','message'=>'must be yyyy-MM-dd HH:mm:ss'),
			array('end_time', 'compare', 'compareAttribute'=>'start_time', 'operator'=>'>', 'message'=>'End date must great than start date'),
			array('title', 'length', 'max'=>60),
			array('content', 'length', 'max'=>200),
			array('content', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, uid, start_time, end_time, title, content, create_time,invite_uid', 'safe','on'=>'search'),
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
	public static function getInvite_user_name($invite_user_uid)
	{
		if(empty($invite_user_uid))return false;
		$invite_user_uid = trim($invite_user_uid);
		$q = "select * from user where uid in ({$invite_user_uid})";
		return Yii::app()->db->createCommand($q)->queryAll();
	}
	
}