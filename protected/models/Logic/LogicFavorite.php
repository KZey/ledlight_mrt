<?php
Yii::import('application.models.Favorite');

/**
 * This is the model class for table "favorite".
 * @author Willie Wang <yyq129@gmail.com>
 * @link http://www.yyq129.com
 * @copyright Copyright &copy; 2009-2010 
 * @date time 2012-11-27 02:06:48 */
class LogicFavorite extends Favorite
{
	/**
	 * The followings are the available columns in table 'favorite':
	 * @var integer $id
	 * @var integer $uid
	 * @var integer $property_id
	 */

	/**
	 * Returns the static model of the specified AR class.
	 * @return Favorite the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}