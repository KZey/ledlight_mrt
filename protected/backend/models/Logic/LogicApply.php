<?php
Yii::import('application.models.Apply');

/**
 * This is the model class for table "apply".
 * @author Willie Wang <yyq129@gmail.com>
 * @link http://www.yyq129.com
 * @copyright Copyright &copy; 2009-2010 
 * @date time 2013-03-14 16:05:21 */
class LogicApply extends Apply
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
}