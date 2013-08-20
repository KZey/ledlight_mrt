<?php
Yii::import('application.models.Base.BaseEmail');

/**
 * This is the model class for table "email".
 */
class Email extends BaseEmail
{
	/**
	 * The followings are the available columns in table 'email':
	 * @var integer $id
	 * @var integer $from_uid
	 * @var integer $to_uid
	 * @var string $title
	 * @var string $contents
	 * @var string $send_date
	 * @var string $attachments
	 * @var integer $property_id
	 * @var string $toemail
	 */

	/**
	 * Returns the static model of the specified AR class.
	 * @return Email the static model class
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
			array('from_uid', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>255),
			array('toemail','email'),
			array('toemail','required','on'=>'email_listing'),
			array('to_uid, title, contents', 'required'),
// 			array('attachments','file','types'=>'jpg,gif,png'),
			array('contents, send_date,attachments,property_id,toemail', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, from_uid, to_uid, title, contents, send_date', 'safe', 'on'=>'search'),
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