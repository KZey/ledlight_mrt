<?php
Yii::import('application.models.Base.BaseInbox');

/**
 * This is the model class for table "inbox".
 */
class Inbox extends BaseInbox
{
	/**
	 * The followings are the available columns in table 'inbox':
	 * @var integer $id
	 * @var integer $type
	 * @var integer $from_uid
	 * @var integer $to_uid
	 * @var string $title
	 * @var string $content
	 * @var string $date
	 */

	/**
	 * Returns the static model of the specified AR class.
	 * @return Inbox the static model class
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
			array('title', 'length', 'max'=>255),
			array('to_uid,content','required'),
			array('content, date,type', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, from_uid, to_uid, title, content, date', 'safe', 'on'=>'search'),
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