<?php
Yii::import('application.models.Inbox');

/**
 * This is the model class for table "inbox".
 * @author Willie Wang <yyq129@gmail.com>
 * @link http://www.yyq129.com
 * @copyright Copyright &copy; 2009-2010 
 * @date time 2012-10-08 02:29:33 */
class LogicInbox extends Inbox
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
}