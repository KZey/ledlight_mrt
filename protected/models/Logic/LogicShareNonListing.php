<?php
Yii::import('application.models.ShareNonListing');

/**
 * This is the model class for table "share_non_listing".
 * @author Willie Wang <yyq129@gmail.com>
 * @link http://www.yyq129.com
 * @copyright Copyright &copy; 2009-2010 
 * @date time 2013-01-31 15:34:41 */
class LogicShareNonListing extends ShareNonListing
{
	/**
	 * The followings are the available columns in table 'share_non_listing':
	 * @var integer $sid
	 * @var integer $uid
	 * @var integer $property_id
	 */

	/**
	 * Returns the static model of the specified AR class.
	 * @return ShareNonListing the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}