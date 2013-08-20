<?php
Yii::import('application.models.ClientExpense');

/**
 * This is the model class for table "client_expense".
 * @author Willie Wang <yyq129@gmail.com>
 * @link http://www.yyq129.com
 * @copyright Copyright &copy; 2009-2010 
 * @date time 2012-11-06 14:26:49 */
class LogicClientExpense extends ClientExpense
{
	/**
	 * The followings are the available columns in table 'client_expense':
	 * @var integer $id
	 * @var integer $realtor_uid
	 * @var integer $client_uid
	 * @var string $advertising
	 * @var string $gas
	 * @var string $meals
	 * @var integer $total
	 * @var string $add_date
	 * @var string $others
	 * @var string $note1
	 * @var string $note2
	 */

	/**
	 * Returns the static model of the specified AR class.
	 * @return ClientExpense the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}