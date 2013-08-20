<?php

class StatlistingController extends Controller
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
				'actions'=>array('index','Rindex', 'GenerateReport', 'ClosedListingNumber', 'ClosedAvgPrice','ClosedAvgCommission', 'ClosedAvgDuration'),
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
			case 1:$url = '/statlisting/cindex';break;
			case 2:$url = '/statlisting/rindex';break;
			default:$url = '/statlisting/rindex';
				
		}
		Yii::app()->request->redirect(Yii::app()->baseurl.$url);
	}

	public function actionRindex()
	{	
		$sql = "select count(property_id) as num from property where uid=".Yii::app()->user->id.' and mrt_status=0 and non_listing=0';
		$num_active_listing = Yii::app()->db->createCommand($sql)->queryScalar();
		$this->render('r_index',array('num_active_listing'=>$num_active_listing));
	}
	
	public function actionGenerateReport()
	{	
		$model=$this->loadModel(Yii::app()->user->id);

		//init edit property page
		$modelProperty = new Property();
// 		if(isset($_GET['generate_report']))
// 		{
			$listing_report_close_date = $_GET['listing_report_close_date'];
			$listing_report_duration = $_GET['listing_report_duration'];
			$listing_report_price = isset($_GET['listing_report_price']) ? $_GET['listing_report_price'] : '';
			$listing_report_commission_1 = isset($_GET['listing_report_commission_1']) ? $_GET['listing_report_commission_1'] : '';
			$listing_report_commission_2 = isset($_GET['listing_report_commission_2']) ? $_GET['listing_report_commission_2'] : '';

			if(!empty($listing_report_commission_1) && !empty($listing_report_commission_2)){
				if(!is_numeric($listing_report_commission_1) || !is_numeric($listing_report_commission_2)) {
					echo '<script>alert("Please input an integer number");history.go(-1);</script>';
					exit;
				}
				if($listing_report_commission_1 < 0 || $listing_report_commission_2 < 0) {
					echo '<script>alert("Please input an integer number");history.go(-1);</script>';
					exit;
				}
				if($listing_report_commission_1 >= $listing_report_commission_2) {
					echo '<script>alert("The first commission rate must be less than the second commission rate");history.go(-1);</script>';
					exit;
				}
			}
			
			$condition_period ="";
			if($listing_report_close_date == 1) {
			    $condition_period = '  and datediff(now(), closed_date) <8 and datediff(now(), closed_date)>=0';
			}else  if($listing_report_close_date == 2) {
			    $condition_period = '  and datediff(now(), closed_date) <15 and datediff(now(), closed_date)>=0';
			}else  if($listing_report_close_date == 3) {
			    $condition_period = '  and datediff(now(), closed_date) <31 and datediff(now(), closed_date)>=0';
			}else  if($listing_report_close_date == 4) {
			    $condition_period = '  and datediff(now(), closed_date) <122 and datediff(now(), closed_date)>=0';
			}else  if($listing_report_close_date == 5) {
			    $condition_period = '  and datediff(now(), closed_date) <365 and datediff(now(), closed_date)>=0';
			}

   		        $condition_duration = '  and datediff(closed_date, date) < '. $listing_report_duration;

			$condition_price = '';
			if(!empty($listing_report_price))
			{
				foreach($listing_report_price as $price_range) {
				    if($price_range == 1) {
				       if($condition_price == '')
				           $condition_price = ' and (price < 100000';
				       else
				           $condition_price = $condition_price . ' or price < 100000';
				    }
				    if($price_range == 2) {
				       if($condition_price == '')
				           $condition_price = ' and ((price < 250000 and price > 101000)';
				       else
				           $condition_price = $condition_price . ' or (price < 101000 and price >250000)';
				    }
				    if($price_range == 3) {
				       if($condition_price == '')
				           $condition_price = ' and ((price < 400000 and price > 251000)';
				       else
				           $condition_price = $condition_price . ' or (price < 101000 and price > 250000)';
				    }
				    if($price_range == 4) {
				       if($condition_price == '')
				           $condition_price = ' and ((price < 600000 and price >401000)';
				       else
				           $condition_price = $condition_price . ' or (price < 101000 and price > 250000)';
				    }
				    if($price_range == 5) {
				       if($condition_price == '')
				           $condition_price = ' and ((price < 800000 and price >601000)';
				       else
				           $condition_price = $condition_price . ' or (price < 101000 and price > 250000)';
				    }
				}
				if($condition_price != '') {
				   $condition_price = $condition_price.')';
				}
			}

			$condition_commission ="";
			if($listing_report_commission_1 > 0 && $listing_report_commission_2 > 0) {
			    $condition_commission = '  and (commission_rate <= '.$listing_report_commission_2.'  and commission_rate >= '.$listing_report_commission_1.')';
			}

			$sql = "select *,property_id as id, datediff(closed_date, date) as duration, datediff(now(), closed_date) as closed, commission_rate, closed_date from property where mrt_status=1 and uid =".Yii::app()->user->id.$condition_period.$condition_duration.$condition_price.$condition_commission;
// 			echo $sql;exit;
			$rs = Yii::app()->db->createCommand($sql)->queryAll();

			$count=count($rs);
			$dataProvider=new CSqlDataProvider($sql, array(
					//'id'=>'user',
					'totalItemCount'=>$count,
					'sort'=>array('attributes'=>array('price','lot_size','pool','house_size')),
					'pagination'=>array('pageSize'=>10,),
			));
			
			$this->render('generate_report',array(
					'model'=>$model,'dataProvider'=>$dataProvider,
			));
// 		}
		

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

	public function actionClosedListingNumber()
	{
		$type  = $_POST['value'];
		if($type == 1) {
		    $condition_period = '  and datediff(now(), closed_date) <8 and datediff(now(), closed_date)>=0';
		}else  if($type == 2) {
		    $condition_period = '  and datediff(now(), closed_date) <15 and datediff(now(), closed_date)>=0';
		}else  if($type == 3) {
		    $condition_period = '  and datediff(now(), closed_date) <32 and datediff(now(), closed_date)>=0';
		}else  if($type == 4) {
		    $condition_period = '  and datediff(now(), closed_date) <184 and datediff(now(), closed_date)>=0';
		}else  if($type == 5) {
		    $condition_period = '  and datediff(now(), closed_date) <366 and datediff(now(), closed_date)>=0';
		}	
		$sql = "select count(property_id) as num from property where mrt_status = 1 and uid=".Yii::app()->user->id.$condition_period;
		$rs = Yii::app()->db->createCommand($sql)->queryRow();
		echo $rs['num'];
	}

	public function actionClosedAvgPrice()
	{
		$value  = $_POST['value'];
		if($value == 1) {
		    $condition_period = '  and datediff(now(), closed_date) <8 and datediff(now(), closed_date)>=0';
		}else  if($value == 2) {
		    $condition_period = '  and datediff(now(), closed_date) <15 and datediff(now(), closed_date)>=0';
		}else  if($value == 3) {
		    $condition_period = '  and datediff(now(), closed_date) <32 and datediff(now(), closed_date)>=0';
		}else  if($value == 4) {
		    $condition_period = '  and datediff(now(), closed_date) <184 and datediff(now(), closed_date)>=0';
		}else  if($value == 5) {
		    $condition_period = '  and datediff(now(), closed_date) <366 and datediff(now(), closed_date)>=0';
		}	
		$sql = "select round(avg(transaction_price),0) as num from property where mrt_status=1 and uid=".Yii::app()->user->id.$condition_period;
		$command = Yii::app()->db->createCommand($sql);
		$rs = $command->queryRow();
		echo $rs['num'];
	}
	public function actionClosedAvgCommission()
	{
		$value  = $_POST['value'];
		if($value == 1) {
		    $condition_period = '  and datediff(now(), closed_date) <8 and datediff(now(), closed_date)>=0';
		}else  if($value == 2) {
		    $condition_period = '  and datediff(now(), closed_date) <15 and datediff(now(), closed_date)>=0';
		}else  if($value == 3) {
		    $condition_period = '  and datediff(now(), closed_date) <32 and datediff(now(), closed_date)>=0';
		}else  if($value == 4) {
		    $condition_period = '  and datediff(now(), closed_date) <184 and datediff(now(), closed_date)>=0';
		}else  if($value == 5) {
		    $condition_period = '  and datediff(now(), closed_date) <366 and datediff(now(), closed_date)>=0';
		}	
		$sql = "select sum((transaction_price * commission_rate / 100)) as num from property where mrt_status=1 and uid=".Yii::app()->user->id.$condition_period;
		$rs_sum_commission = Yii::app()->db->createCommand($sql)->queryScalar();

		$sql = "select count(property_id) as num from property where mrt_status=1 and uid=".Yii::app()->user->id.$condition_period;
		$rs_sum_property = Yii::app()->db->createCommand($sql)->queryScalar();
		if($rs_sum_commission > 0 && $rs_sum_property > 0)echo round($rs_sum_commission / $rs_sum_property,0);
	}
	public function actionClosedAvgDuration()
	{
		$value  = $_POST['value'];
		if($value == 1) {
		    $condition_period = '  and datediff(now(), closed_date) <8 and datediff(now(), closed_date)>=0';
		}else  if($value == 2) {
		    $condition_period = '  and datediff(now(), closed_date) <15 and datediff(now(), closed_date)>=0';
		}else  if($value == 3) {
		    $condition_period = '  and datediff(now(), closed_date) <32 and datediff(now(), closed_date)>=0';
		}else  if($value == 4) {
		    $condition_period = '  and datediff(now(), closed_date) <184 and datediff(now(), closed_date)>=0';
		}else  if($value == 5) {
		    $condition_period = '  and datediff(now(), closed_date) <366 and datediff(now(), closed_date)>=0';
		}	
		$sql = "select round(avg(datediff(closed_date, date)),1) as num from property where mrt_status=1 and uid=".Yii::app()->user->id.$condition_period;
		$command = Yii::app()->db->createCommand($sql);
		$rs = $command->queryRow();
		echo $rs['num'];
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
