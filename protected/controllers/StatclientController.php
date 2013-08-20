<?php
ini_set("display_errors", 1);
error_reporting(E_ALL);
class StatclientController extends Controller
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
				'actions'=>array('index','Rindex','GenerateReport', 'ExpenseTotal', 'ReferralClientNum','getexpense'),
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
			case 1:$url = '/statclient/cindex';break;
			case 2:$url = '/statclient/rindex';break;
			default:$url = '/statclient/rindex';
				
		}
		Yii::app()->request->redirect(Yii::app()->baseurl.$url);
	}

	public function actionRindex()
	{	
		$this->render('r_index',array());
	}
	
	public function actionGenerateReport()
	{	
		$model=$this->loadModel(Yii::app()->user->id);

// 		if(isset($_GET['generate_report']))
// 		{
			$client_report_finance = isset($_GET['client_report_finance']) ? $_GET['client_report_finance'] : 0;
			$client_report_expense = isset($_GET['client_report_expense']) ? $_GET['client_report_expense'] : 0;
			$client_report_referral = isset($_GET['client_report_referral']) ? $_GET['client_report_referral'] : 0;
			
			//finacning_type
			$condition_finance = '';			
			if($client_report_finance != 0)$condition_finance = ' and c.finacning_type ='.$client_report_finance;

			//expense
			$condition_expense = '';
			if(!empty($client_report_expense))
			{
				foreach($client_report_expense as $expense_type) 
				{
					if($expense_type == 1)$condition_expense .= " and b.gas > 0";
					if($expense_type == 2)$condition_expense .= " and b.meals > 0";
					if($expense_type == 3)$condition_expense .= " and b.advertising > 0";
					if($expense_type == 4)$condition_expense .= " and b.others > 0";
				}
			}
			
			//referral_type
			$condition_referral = '';
			if(!empty($client_report_referral))
			{
				$str_referral = implode(",", $client_report_referral);
				$condition_referral = " and c.referral_type in (".$str_referral.")";
			}
			
			$sql = "select d.id,d.uid,d.logo,d.email,d.first_name,d.last_name,d.referral_type,d.finacning_type,
						sum(d.advertising) as advertising, sum(d.gas) as gas, sum(d.meals) as meals, sum(d.others) as others from 
					(select a.uid as id,a.uid,a.logo,a.email,a.first_name,a.last_name, c.referral_type, c.finacning_type, b.advertising, b.gas, b.meals, b.others 
					from user as a inner join client_expense as b on (a.uid=b.client_uid) inner join contact as c on (a.uid=c.uid_child) 
					where b.realtor_uid = ".Yii::app()->user->id.$condition_expense." and c.uid_parent = ".Yii::app()->user->id.$condition_referral.$condition_finance
					.") as d group by d.uid";
			$rs = Yii::app()->db->createCommand($sql)->queryAll();
			$dataProvider=new CArrayDataProvider($rs, array(
					//'id'=>'user',
					'sort'=>array('attributes'=>array('referral_type','finacning_type','first_name','last_name')),
					'pagination'=>array('pageSize'=>10,),
			));
			$this->render('generate_report',array(
					'model'=>$model,'dataProvider'=>$dataProvider,
			)); 
// 		}
	}
 
	public function actionReferralClientNum()
	{	
	    $referral_type = explode('|', $_POST['items']);

	    $condition_referral = '';
	    if(!empty($referral_type))
	    {
	    	$str_referral = implode(",", $referral_type);
	    	$condition_referral = " and referral_type in (".$str_referral.")";
	    }
	    
	    $sql = "select count(id) as num from contact where uid_parent = ".Yii::app()->user->id.$condition_referral;
	    $rs = Yii::app()->db->createCommand($sql)->queryRow();	
	    echo $rs['num']; 	    
	}
	public function actionGetexpense()
	{
		$value  = $_POST['value'];
		$type  = $_POST['type'];
		if($type > 0 && $value > 0)
		{
			switch ($value)
			{
				case 1:$condition_period = '  and datediff(now(), add_date) <8 and datediff(now(), add_date)>=0';break;
				case 2:$condition_period = '  and datediff(now(), add_date) <15 and datediff(now(), add_date)>=0';break;
				case 3:$condition_period = '  and datediff(now(), add_date) <32 and datediff(now(), add_date)>=0';break;
				case 4:$condition_period = '  and datediff(now(), add_date) <184 and datediff(now(), add_date)>=0';break;
				case 5:$condition_period = '  and datediff(now(), add_date) <366 and datediff(now(), add_date)>=0';break;
			}
			switch ($type)
			{
				case 1:$condition_colum = 'advertising';break;
				case 2:$condition_colum = 'gas';break;
				case 3:$condition_colum = 'meals';break;
				case 4:$condition_colum = 'others';break;
			}
			$sql = "select round(sum($condition_colum),0) as num from client_expense where realtor_uid=".Yii::app()->user->id.$condition_period;
			$rs_num = Yii::app()->db->createCommand($sql)->queryScalar();
			echo $rs_num > 0 ? $rs_num : 0;
		}else {
			echo 0;
		}
	}
	public function actionExpenseTotal()
	{
	    $value = explode('-', $_POST['items']);	
	    $client_expense_period_array = explode('|', $value[0]);
	    $client_report_expense = explode('|', $value[1]);

	    $client_expense_period = $client_expense_period_array[0];
	    $conditon_period = '';
		if($client_expense_period == 1) {
		    $conditon_period = '  and datediff(now(), add_date) <8 and datediff(now(), add_date)>0';
		}else  if($client_expense_period == 2) {
		    $conditon_period = '  and datediff(now(), add_date) <15 and datediff(now(), add_date)>0';
		}else  if($client_expense_period == 3) {
		    $conditon_period = '  and datediff(now(), add_date) <31 and datediff(now(), add_date)>0';
		}else  if($client_expense_period == 4) {
		    $conditon_period = '  and datediff(now(), add_date) <122 and datediff(now(), add_date)>0';
		}else  if($client_expense_period == 5) {
		    $conditon_period = '  and datediff(now(), add_date) <365 and datediff(now(), add_date)>0';
		}

		
		//expense
		$condition_expense = '';
		if(!empty($client_report_expense))
		{
			foreach($client_report_expense as $expense_type)
			{
				if($expense_type == 1)$condition_expense .= empty($condition_expense) ? " sum(gas) as gas_num " : ", sum(gas) as gas_num ";
				if($expense_type == 2)$condition_expense .= empty($condition_expense) ? " sum(meals) as meals_num " : ", sum(meals) as meals_num ";
				if($expense_type == 3)$condition_expense .= empty($condition_expense) ? " sum(advertising) as advertising_num " : ", sum(advertising)  as advertising_num ";
				if($expense_type == 4)$condition_expense .= empty($condition_expense) ? " sum(others) as others_num " : ", sum(others)  as others_num ";
			}
		}

	    if(!empty($condition_expense))
	    {
	    	$sql = "select  $condition_expense from client_expense where realtor_uid = ".Yii::app()->user->id.$conditon_period;
	    	$rs = Yii::app()->db->createCommand($sql)->queryRow();

	    	$gas_num = isset($rs['gas_num']) ? intval($rs['gas_num']) : 0;
	    	$meals_num = isset($rs['meals_num']) ? intval($rs['meals_num']) : 0;
	    	$advertising_num = isset($rs['advertising_num']) ? intval($rs['advertising_num']) : 0;
	    	$others_num = isset($rs['others_num']) ? intval($rs['others_num']) : 0;
	    	
	    	echo intval($gas_num) + intval($meals_num) + intval($advertising_num) + intval($others_num);
	    }
	}

	public function  actionGenerateReport11()
	{
			$client_report_finance = $_POST['client_report_finance'];
			$client_report_expense = $_POST['client_report_expense'];
			$client_report_referral = $_POST['client_report_referral'];
			

			$condition_finance = '';			
			if($client_report_finance != 0)
			   $condition_finance = '  and finacning_type ='.$client_report_finance;

			$condition_expense = '';
			foreach($client_report_expense as $expense_type) {

			       if($condition_expense == '')
			           $condition_expense = ' and (expense_type='.$expense_type;
			       else
			           $condition_expense = $condition_expense . ' or expense_type='.$expense_type;
			}
			if($condition_expense != '') {
			   $condition_expense = $condition_expense.')';
			}


			$condition_referral = '';
			foreach($client_report_referral as $referral) {

			       if($condition_referral == '')
			           $condition_referral = ' and (referral_type='.$referral;
			       else
			           $condition_referral = $condition_referral . ' or referral_type='.$referral;
			}
			if($condition_referral != '') {
			   $condition_referral = $condition_referral.')';
			}



			$sql = "select distinct(email), referral_type, finacning_type, expense_type, expense_amount from user, client_expense 

				where realtor_uid = ".Yii::app()->user->id."  and client_uid = uid ".$condition_finance.$condition_expense.$condition_referral;


			$rs_1=Yii::app()->db->createCommand($sql)->queryAll();
			$count=count($rs_1);
			$dataProvider=new CSqlDataProvider($sql, array(
					//'id'=>'user',
					'totalItemCount'=>$count,
					'pagination'=>array(
						'pageSize'=>10,
					),
			));

		$this->render('generate_report',array(
				'dataProvider'=>$dataProvider));
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

	protected function ajaxCallTotalEmailAmount($id, $type)
	{
		if($type = 1) {
		    $conditon_period = '  and datediff(now(), send_date) <8 and datediff(now(), send_date)>0';
		}else  if($type = 2) {
		    $conditon_period = '  and datediff(now(), send_date) <15 and datediff(now(), send_date)>0';
		}else  if($type = 3) {
		    $conditon_period = '  and datediff(now(), send_date) <31 and datediff(now(), send_date)>0';
		}else  if($type = 4) {
		    $conditon_period = '  and datediff(now(), send_date) <122 and datediff(now(), send_date)>0';
		}else  if($type = 5) {
		    $conditon_period = '  and datediff(now(), send_date) <365 and datediff(now(), send_date)>0';
		}	
		$sql = "select id, title from user where uid=".Yii::app()->user->id;
		$command = Yii::app()->db->createCommand($sql);
		$rs = $command->queryAll();
		echo json_encode($rs);
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
