<?php
Yii::import('application.models.Manager');

/**
 * This is the model class for table "manager".
 * @author Willie Wang <yyq129@gmail.com>
 * @link http://www.yyq129.com
 * @copyright Copyright &copy; 2009-2010 
 * @date time 2013-03-14 17:54:10 */
class LogicManager extends Manager
{
	/**
	 * The followings are the available columns in table 'manager':
	 * @var integer $uid
	 * @var string $email
	 * @var string $pwd
	 * @var string $nickname
	 * @var string $first_name
	 * @var string $last_name
	 * @var string $logo
	 * @var integer $sex
	 * @var string $office
	 * @var string $mobile
	 * @var string $fax
	 * @var string $about
	 * @var string $state
	 * @var string $city
	 * @var string $last_time
	 * @var string $this_time
	 * @var string $service_email
	 * @var string $add_time
	 */

	/**
	 * Returns the static model of the specified AR class.
	 * @return Manager the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}