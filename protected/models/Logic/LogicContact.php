<?php
Yii::import('application.models.Contact');

/**
 * This is the model class for table "contact".
 * @author Cheng Gang <chenggang.china@gmail.com>
 * @link 
 * @copyright Copyright &copy; 2009-2010 
 * @date time 2012-08-29 02:54:43 */
class LogicContact extends Contact
{
	/**
	 * The followings are the available columns in table 'contact':
	 * @var integer $id
	 * @var integer $uid_parent
	 * @var integer $uid_child
	 * @var integer $subscribe
	 * @var integer $type
	 * @var integer $indicator
	 * @var integer $referral_type
	 * @var integer $finacning_type
	 * @var string $note
	 * @var string $update_date
	 */

	/**
	 * Returns the static model of the specified AR class.
	 * @return Contact the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}