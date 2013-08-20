<?php

class StatemailController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}	
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','Rindex','TotalNewsletter', 'GetPropertyById', 'GenerateReport', 'CallTotalEmailAmount','View','Unscribecontactdel','UnscribeProspectsdel'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionUnscribecontactdel()
	{
		if (Yii::app()->request->isPostRequest)
		{
			$criteria= new CDbCriteria;
			$criteria->addInCondition('id', $_POST['selectdelcontact']);
			Contact::model()->updateAll(array('subscribe'=>2),$criteria);
	
			if(isset(Yii::app()->request->isAjaxRequest)) {
				echo 1;
			} else{
				echo 2;
			}
		}
	}
	public function actionUnscribeProspectsdel()
	{
		if (Yii::app()->request->isPostRequest)
		{
			$criteria= new CDbCriteria;
			$criteria->addInCondition('uid', $_POST['selectdelProspects']);
			Prospects::model()->updateAll(array('subscribe'=>2),$criteria);
	
			if(isset(Yii::app()->request->isAjaxRequest)) {
				echo 1;
			} else{
				echo 2;
			}
		}
	}
	public function actionRlist()
	{
		$dataProvider=new CActiveDataProvider('User',array(
				'criteria'=>array(
						'condition'=>'type=2',
				),
				
				'pagination'=>array(
						'pageSize'=>20
				),
		));
		$model=$this->loadModel(Yii::app()->user->id);
		$this->render('r_list',array(
				'dataProvider'=>$dataProvider,'model'=>$model,
		));
		
	}


	public function actionIndex()
	{
		$model=$this->loadModel(Yii::app()->user->id);
		$url = '';
		switch ($model->type)
		{
			case 1:$url = '/statemail/cindex';break;
			case 2:$url = '/statemail/rindex';break;
			default:$url = '/statemail/rindex';
				
		}
		Yii::app()->request->redirect(Yii::app()->baseurl.$url);
	}

	public function actionRindex()
	{	
		$newsletter_number = $this->actionTotalNewsletter(Yii::app()->user->id);
		$prorperty_list = array();		
		$prorperty_list = $this->actionGetPropertyById(Yii::app()->user->id);
		
		//contact unsubscribed list
		$dataProviderContact=null;
		if(!empty(Yii::app()->user->id))
		{
			$sql = "select a.*,b.first_name,b.last_name,b.email from contact as a left join user as b on a.uid_child = b.uid where a.subscribe = 0 and a.uid_parent=".Yii::app()->user->id;
			$rs_1=Yii::app()->db->createCommand($sql)->queryAll();
			$count=count($rs_1);
			$dataProviderContact=new CSqlDataProvider($sql, array(
					'totalItemCount'=>$count,
					'pagination'=>array('pageSize'=>10,),
			));
// 			CVarDumper::dump($dataProviderContact,10,true);
			$dataProviderProspects=new CActiveDataProvider('Prospects',array(
					'criteria'=>array('condition'=>' subscribe = 0 and uid_parent='.Yii::app()->user->id),
					'pagination'=>array('pageSize'=>25),
			));
// 			CVarDumper::dump($dataProviderProspects,10,true);exit;
		}
		
		$this->render('r_index',array('newsletter_number'=>$newsletter_number, 'prorperty_list'=>$prorperty_list,'dataProviderContact'=>$dataProviderContact,'dataProviderProspects'=>$dataProviderProspects));
	}
	
	public function actionGenerateReport()
	{	
		$model=$this->loadModel(Yii::app()->user->id);

		if(isset($_GET['generate_report']))
		{
			$email_report_period = $_GET['email_report_period'];
			$email_report_who = $_GET['email_report_who'];
			$email_report_property = $_GET['email_report_property'];
			$condition_property = $email_report_property != 0 ? ' and property_id ='.$email_report_property : '';

			$condition_who = '';
			if(!empty($email_report_who))
			{
				$str = implode(',', $email_report_who);
				$condition_who = " and type in ($str)";
			}
			
			if($email_report_period == 1) {
			    $conditon_period = '  and datediff(now(), send_date) <8';
			}else  if($email_report_period == 2) {
			    $conditon_period = '  and datediff(now(), send_date) <15 and datediff(now(), send_date)>=0';
			}else  if($email_report_period == 3) {
			    $conditon_period = '  and datediff(now(), send_date) <31 and datediff(now(), send_date)>=0';
			}else  if($email_report_period == 4) {
			    $conditon_period = '  and datediff(now(), send_date) <122 and datediff(now(), send_date)>=0';
			}else  if($email_report_period == 5) {
			    $conditon_period = '  and datediff(now(), send_date) <365 and datediff(now(), send_date)>=0';
			}

			$sql = "select d.first_name as from_first_name,e.first_name as to_first_name,c.* from 
					(
						(select a.* from email as a inner join contact as b on (a.from_uid=b.uid_parent and a.to_uid=b.uid_child)
							 where (a.from_uid =".Yii::app()->user->id." or  a.to_uid=".Yii::app()->user->id.") ".$condition_who.")
						union all 						 		
						(select a.* from email as a inner join prospects as b on (a.from_uid=b.uid_parent and a.to_uid=b.uid)
							 where (a.from_uid =".Yii::app()->user->id." or  a.to_uid=".Yii::app()->user->id.") ".$condition_who.")
					) as c inner join user as d on (c.from_uid=d.uid) inner join user as e on (c.to_uid=e.uid)
			";
			$rs = Yii::app()->db->createCommand($sql)->queryAll();

			$count=count($rs);
			$dataProvider=new CSqlDataProvider($sql, array(
					//'id'=>'user',
					'totalItemCount'=>$count,
// 					'sort'=>array('attributes'=>array('price','lot_size','pool','house_size')),
					'pagination'=>array('pageSize'=>10,),
			));
			$this->render('generate_report',array(
					'model'=>$model,'dataProvider'=>$dataProvider,
			));
		}
	}
	public function actionView()
	{
		if(empty(Yii::app()->user->id))$this->redirect('/');
		$model=$this->loadModel(Yii::app()->user->id);
		
		if(isset($_GET['id']) && $_GET['id'] > 0)
		{
			$id = $_GET['id'];
			$sql = "select d.first_name as from_first_name,d.email as from_first_email,
					e.first_name as to_first_name,e.email as to_first_email,
					c.* from
					(
						select * from email where id={$id} and (from_uid =".Yii::app()->user->id." or  to_uid=".Yii::app()->user->id.")
					) as c inner join user as d on (c.from_uid=d.uid) inner join user as e on (c.to_uid=e.uid)
			";
			$rs = Yii::app()->db->createCommand($sql)->queryRow();
			$this->render('_view',array('model'=>$model,'rs'=>$rs));
		}
	}
    private function actionGetPropertyById($id)
	{	
		$sql = "select property_id, title from property where uid=".$id;
		$command = Yii::app()->db->createCommand($sql);
		$rs = $command->queryAll();
		return $rs;
	}

	private function actionTotalNewsletter($id)
	{	
		$sql = "select count(id) as num from contact where subscribe=1 and uid_parent=".$id." union all 
				select count(uid) as num from prospects where subscribe=1 and uid_parent=".$id
				;
		$rs = Yii::app()->db->createCommand($sql)->queryAll();
		
		return intval($rs[0]['num']) + intval($rs[1]['num']);
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=User::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionCallTotalEmailAmount()
	{
		$type = $_POST['type'];
		$id = $_POST['id'];
		if($type == 1) {
		    $conditon_period = '  and datediff(now(), send_date) <8 and datediff(now(), send_date)>=0';
		}else  if($type == 2) {
		    $conditon_period = '  and datediff(now(), send_date) <15 and datediff(now(), send_date)>=0';
		}else  if($type == 3) {
		    $conditon_period = '  and datediff(now(), send_date) <31 and datediff(now(), send_date)>=0';
		}else  if($type == 4) {
		    $conditon_period = '  and datediff(now(), send_date) <122 and datediff(now(), send_date)>=0';
		}else  if($type == 5) {
		    $conditon_period = '  and datediff(now(), send_date) <365 and datediff(now(), send_date)>=0';
		}	
		$sql = "select count(*) as num from email where from_uid=".Yii::app()->user->id. $conditon_period;
		echo Yii::app()->db->createCommand($sql)->queryScalar();
	}

	public static function getUserInfo($id)
	{
		if(!empty($id) && is_numeric($id))
		{
			return $this->loadModel($id);
		}
	}
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}
