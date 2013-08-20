<?php

class CrontabController extends Controller
{
	public $layout='column1';

	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}

	public function actionDeletetokboxsession()
	{
		$sql = "select id from tokbox_session where timestampdiff(hour, create_time,now()) > 24";
		$rs = Yii::app()->db->createCommand($sql)->queryAll();
		
		if(!empty($rs))
		{
			$num = count($rs);
			for($i=0;$i<$num;$i++)
			{
				$sql="delete from tokbox_session where id=".$rs[$i]['id'];
				Yii::app()->db->createCommand($sql)->query();
			}
		}
	}
	
	
}