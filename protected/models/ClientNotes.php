<?php
Yii::import('application.models.Base.BaseClientNotes');

/**
 * This is the model class for table "client_notes".
 */
class ClientNotes extends BaseClientNotes
{
	/**
	 * The followings are the available columns in table 'client_notes':
	 * @var integer $id
	 * @var integer $realtor_uid
	 * @var integer $client_uid
	 * @var string $note
	 * @var string $add_date
	 * @var string $note1
	 * @var string $note2
	 */

	/**
	 * Returns the static model of the specified AR class.
	 * @return ClientNotes the static model class
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
			array('realtor_uid, client_uid', 'numerical', 'integerOnly'=>true),
			array('note1, note2', 'length', 'max'=>255),
			array('note, add_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, realtor_uid, client_uid, note, add_date, note1, note2', 'safe', 'on'=>'search'),
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