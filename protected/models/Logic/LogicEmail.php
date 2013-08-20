<?php
Yii::import('application.models.Email');

/**
 * This is the model class for table "email".
 * @author Willie Wang <yyq129@gmail.com>
 * @link http://www.yyq129.com
 * @copyright Copyright &copy; 2009-2010 
 * @date time 2012-10-15 07:32:24 */
class LogicEmail extends Email
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
}