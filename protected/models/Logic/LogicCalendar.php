<?php
Yii::import('application.models.Calendar');

/**
 * This is the model class for table "calendar".
 * @author Willie Wang <yyq129@gmail.com>
 * @link http://www.yyq129.com
 * @copyright Copyright &copy; 2009-2010 
 * @date time 2012-09-24 05:18:22 */
class LogicCalendar extends Calendar
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
}