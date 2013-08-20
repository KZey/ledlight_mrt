<?php
class PropertyController extends Controller
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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','Search','view','Propertysearch'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','RepairUpload','Addfavorite','deletefile','Closeproperty','deleteproperty'),
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
	public function actionCloseproperty()
	{
		$property_id = isset($_GET['property_id']) ? intval($_GET['property_id']) : 0;
		if($property_id > 0)
		{
			$sql = "select * from property where uid=".Yii::app()->user->id." and property_id={$property_id}";
			$rs = Yii::app()->db->createCommand($sql)->queryAll();
			if(empty($rs))
			{
				echo "The property is exists.";exit;
			}else{
				$sql = "update property set mrt_status=1 where uid=".Yii::app()->user->id." and property_id={$property_id}";
				$rs = Yii::app()->db->createCommand($sql)->query();
				if($rs)echo Yii::t('Property','Closed_property_ok');else echo Yii::t('Property','Closed_property_err');
			}
		}
	}
	public function actionDeleteproperty()
	{
		$property_id = isset($_GET['property_id']) ? intval($_GET['property_id']) : 0;
		if($property_id > 0)
		{
			$sql = "select * from property where uid=".Yii::app()->user->id." and property_id={$property_id}";
			$rs = Yii::app()->db->createCommand($sql)->queryAll();
			if(empty($rs))
			{
				echo Yii::t('Property','property_exists');exit;
			}else{
				$sql = "delete from property where uid=".Yii::app()->user->id." and property_id={$property_id}";
				$rs = Yii::app()->db->createCommand($sql)->query();
				if($rs)echo Yii::t('Property','del_property_ok');else echo Yii::t('Property','del_property_err');
			}
		}
	}
	public function actionAddfavorite()
	{
		$property_id = isset($_GET['property_id']) ? intval($_GET['property_id']) : 0;
		if($property_id > 0)
		{
			$sql = "select * from favorite where uid=".Yii::app()->user->id." and property_id={$property_id}";
			$rs = Yii::app()->db->createCommand($sql)->queryAll();
			if(!empty($rs))
			{
				echo "You have been added it.";exit;
			}else{
				$modelFavorite=new Favorite;
				$modelFavorite->property_id=$property_id;
				$modelFavorite->uid=Yii::app()->user->id;
				if($modelFavorite->save())echo Yii::t('Property','add_favorites_ok');else echo Yii::t('Property','add_favorites_err');
			}
		}
	}
	public function actionDeletefile()
	{
		$property_id = isset($_GET['property_id']) ? intval($_GET['property_id']) : 0;
		$photo_name = isset($_GET['photo_name']) ? $_GET['photo_name'] : '';
		if($property_id > 0 && !empty($photo_name))
		{
			$sql = "select property_id,photos from property where uid=".Yii::app()->user->id." and property_id={$property_id} and photos like '%{$photo_name}%'";
			$rs = Property::model()->findBySql($sql);
			if(empty($rs))
			{
				echo Yii::t('Property','photo_exists');exit;
			}else{
				$old_photos = $rs->photos;
				$new_photos = str_replace(','.$photo_name,"",$old_photos);
				$new_photos = str_replace($photo_name.',',"",$new_photos);
				$new_photos = str_replace($photo_name,"",$new_photos);
				$rs->photos = $new_photos;
// 				echo '<pre>';print_r($rs);echo '</pre>'; exit;
				$u_sql = "update property set photos='{$new_photos}'  where uid=".Yii::app()->user->id." and property_id={$property_id}";
				$check = Yii::app()->db->createCommand($u_sql)->query();
				if($check)echo Yii::t('Property','del_favorites_ok');else echo Yii::t('Property','del_favorites_err');
			}
		}
	}
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$uid = Yii::app()->user->id;
		
		if(empty($uid)){
			$this->redirectMsg('/','Login or Register page',$msg='Please Login or Create a account to view it.');exit;
		}
		$model=$this->loadModel($id);
		$modelUser=User::model()->findByPk($model->uid);
		var_dump($modelUser->uid);
		echo "<br/>";


		$email = self::sendemailHelper(array('/property/'.$id));
		
		/*****inbox start***/
		$modelInbox=new Inbox;
// 		$this->performAjaxValidation($modelInbox);
		if(isset($_POST['Inbox']))
		{
			$modelInbox->attributes=$_POST['Inbox'];
			$modelInbox->date = date('y-m-d H:i:s');
			$modelInbox->from_uid = $uid;
			if(!empty($_POST['hidden_to_uid']))
			{
				/****start add favorite****/
				$check_have = 0;
				if($_POST['hidden_property_id']==1)
				{
					$sql = "select * from favorite where uid={$uid}  and property_id=".$_POST['property_id'];
					$rs = Yii::app()->db->createCommand($sql)->queryAll();
					if(!empty($rs))
					{
						$check_have = 1;
					}else{
						$modelFavorite=new Favorite;
						$modelFavorite->property_id=$_POST['property_id'];
						$modelFavorite->uid=$uid;
						$modelFavorite->save();
					}
				}
				/****end add favorite****/
				
				/****start: to realtor****/
				$modelInbox->setAttribute('to_uid', $_POST['hidden_to_uid']);
				if($modelInbox->from_uid == $modelInbox->to_uid)
				{
					Yii::app()->user->setFlash('error',Yii::t('Property','send_msg_yourselves'));
					$this->refresh();
				}
				$uname = isset($_POST['uname']) ? 'My name is '.$_POST['uname'] : '';
				$modelInbox->title = $uname.', and my phone number is '.$modelInbox->title;
				
				$rs_contact = Contact::model()->findByAttributes(array("uid_parent"=>$modelInbox->from_uid));
				if(empty($rs_contact))
				{
					$modelInbox->type = 1;
// 					$accept = '<input type=button id="button_yes" name="button_yes" value="Yes" onclick="invite_yes('.$modelInbox->from_uid.')" />';
// 					$msg_invite = '<br/><br/><p style="color:gray">MyRealTour Tips: Would you like to invite this client to make connection with you? '.$accept;
// 					$modelInbox->content .= $msg_invite;
				}
// 				CVarDumper::dump($rs_contact,10,true);
// 				CVarDumper::dump($modelInbox->attributes,10,true);exit;
				if($modelInbox->save())
				{
					/****start: set parent_id****/
					$sql = "select parent_id from inbox
							where (to_uid=".$modelInbox->to_uid." and from_uid=".$modelInbox->from_uid.")
									or (to_uid=".$modelInbox->from_uid." and from_uid=".$modelInbox->to_uid.") limit 1";
					$parent_id = Yii::app()->db->createCommand($sql)->queryScalar();
					
					$id = Yii::app()->db->getLastInsertID();
					$new_parent_id = empty($parent_id) ? $id : $parent_id;
					$sql = "update inbox set parent_id={$new_parent_id} where id={$id}";
					Yii::app()->db->createCommand($sql)->execute();
					/****end: set parent_id****/
					
					if(!empty($rs_contact))
					{
						$modelUser=User::model()->findByPk($_POST['hidden_to_uid']);
						         var_dump($modelUser->uid);
								          echo "<hr/>";
						if(!empty($modelUser['push_id']))
						{
							$apns = new Apns($modelUser['push_id'], 'The message from MRT',$modelInbox->content,2);
							$apns->doPush();
						}
					}
					
					$msg = Yii::t('Property','send_msg_ok');
					if($check_have == 1)$msg .= "<br/>".Yii::t('Property','added_favitor_err');
					Yii::app()->user->setFlash('success',$msg);
					$this->refresh();
				}
				/****end: to realtor****/
			}
		}
		/*****inbox end***/

		exit();
		
		$this->render('view',array(
			'model'=>$model,'modelUser'=>$modelUser,'modelEmail'=>$email[0],'hidden_to_uid'=>$email[1],
			'modelInbox'=>$modelInbox,
		));
	}
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Property;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_POST['Property']))
		{
			$model->attributes=$_POST['Property'];
			$model->uid = Yii::app()->user->id;
			$model->logo = 'default_property.png';
			$attach = CUploadedFile::getInstance($model, 'logo');
			if(!empty($attach))
			{
				if(!in_array(strtolower($attach->extensionName), array('jpg','gif','png'))){
					Yii::app()->user->setFlash('errorUpload',Yii::t('Property','file_type'));
					$this->refresh();
				}else if($attach->size > 2000000){
					Yii::app()->user->setFlash('errorUpload',Yii::t('Property','file_size')); 
					$this->refresh();
				}else if(!empty($attach->name)){
					$name = md5(time()).'.'.strtolower($attach->extensionName);
					if($attach->saveAs(dirname(Yii::app()->basePath).'/upload/property/'.$name,true))$model->logo = $name;
				}
			}
			if($model->save())
				$this->redirect(array('view','id'=>$model->property_id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
	public function actionRepairUpload(){
		$index  = $_POST["selectedIndex"];
		$pre_id = $_POST["upload_save_to_db_id"];
		
		$inputFileName = "repair_attached_file".$index;
		$attach = CUploadedFile::getInstanceByName($inputFileName);
 		//echo "<script type='text/javascript'>window.top.window.stopUpload('{$attach}',$index)</script>";exit;
		$retValue = "";
		if($attach == null){
			$retValue = "File is blank";
		}else if($attach->size > 100000000){
			$retValue = "The file size must less than 10M.";
		}else if(!in_array(strtolower($attach->extensionName), array('jpg','gif','png'))){
				$retValue = Yii::t('Property','file_type');
		}else if(!empty($attach->name)){
				$retValue = Yii::t('Property','upload_ok');
				$name = md5(time()).'.'.strtolower($attach->extensionName);
				if($attach->saveAs(dirname(Yii::app()->basePath).'/upload/property/'.$name,true))
				{
					$model->logo = $name;
					if(!empty($name))
					{
						$image = Yii::app()->image->load('upload/property/'.$name);
						$new_width = $image->width > 1000 ? 1000 : $image->width;
						$new_height = $image->height > 1000 ? 1000 : $image->height;
						$image->resize($new_width, $new_height);
						$image->save();
					}
					echo "<script type='text/javascript'>window.top.window.successUpload('{$retValue}','$name',$index)</script>";exit();
				}else{
					echo "<script type='text/javascript'>window.top.window.successUpload('Upload failed','$name',$index)</script>";exit();
				}
				
		}
		echo "<script type='text/javascript'>window.top.window.stopUpload('{$retValue}',$index)</script>";
	}
	
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Property']))
		{
			$model->attributes=$_POST['Property'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->property_id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
	    $userType = Yii::app()->user->type;
		$dataProvider=new CActiveDataProvider('Property', array(
							'criteria'=>array(
									'condition'=>' mrt_status=0 and non_listing=0',
							),
								'sort'=>array('defaultOrder'=>'update_date desc'),    
							));
		$this->render('index',array(
			'dataProvider'=> $dataProvider,
			'userType'    => $userType
		));
	}
	public function actionPropertysearch()
	{
		$this->render('propertysearch');
	}
	public function actionSearch()
	{
 		$property_type = self::getPost('property_type');
		$selling_status = self::getPost('selling_status');
		$property_status = self::getPost('property_status');
		$beds = self::getPost('beds');
		$baths = self::getPost('baths');
		$address = self::getPost('address');
		$price_from = self::getPost('price_from');
		$price_to = self::getPost('price_to');
		$lot_size_from = self::getPost('lot_size_from');
		$lot_size_to = self::getPost('lot_size_to');
		$house_size_from = self::getPost('house_size_from');
		$house_size_to = self::getPost('house_size_to');
		
		$dataProvider=null;
		$sql="select *,property_id as id from property where non_listing=0 ";
		$sql.= empty($property_type) ? "" : " and property_type=".$property_type;
		$sql.= empty($selling_status) ? "" : " and selling_status=".$selling_status;
		$sql.= empty($property_status) ? "" : " and property_status=".$property_status;
		
		$sql.= empty($beds) ? "" : " and beds='".$beds."'";
		$sql.= empty($baths) ? "" : " and baths='".$baths."'";
		if(!empty($address))$sql.= " and address like '%".$address."%' ";
		
		if(!empty($price_to))
			$sql.= " and (price > ".intval($price_from)." and price < ".intval($price_to).") ";
		else
			$sql.= " and price >= ".intval($price_from);
		
		if(!empty($lot_size_to))
			$sql.= " and (lot_size between ".intval($lot_size_from)." and ".intval($lot_size_to).") ";
		else
			$sql.= " and lot_size >=".intval($lot_size_from);
		
		if(!empty($house_size_to))
			$sql.= " and (house_size between ".intval($house_size_from)." and ".intval($house_size_to).") ";
		else
			$sql.= " and house_size >= ".intval($house_size_from);
 		//echo $sql;exit;
		$rs_1=Yii::app()->db->createCommand($sql)->queryAll();
		$count=count($rs_1);
		$dataProvider=new CSqlDataProvider($sql, array(
				//'id'=>'contact',
				'totalItemCount'=>$count,
				'sort'=>array(
						'attributes'=>array(
								'price'=>'Price','lot_size'=>'Lot Size','pool'=>'Pool','house_size'=>'House Size'
						),
				),
				'pagination'=>array(
						'pageSize'=>10,
				),
		));
		$this->render('search',array('dataProvider'=>$dataProvider));
	}
	
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Property('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Property']))
			$model->attributes=$_GET['Property'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Property::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='property-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
