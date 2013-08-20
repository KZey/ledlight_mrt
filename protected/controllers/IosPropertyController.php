<?php
class IosPropertyController extends Controller
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
				'actions'=>array(),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('Mypropertylist','Allpropertylist','Detail','Send','Delone','Uploadvideo','Search','Createproperty','Uploadphotos','Clientshareproperty'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array(),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	/**
	 * Function Name: Uploadphotos
	 * Description  : Uploadphotos
	 * Params       : property_id property_photos
	 * Method way   : POST
	 * Return       : 1:property_id is null   2: image type  3:errors 4:success and photos_name 5:upload failed
	 * Note         : must login
	 * API url      : http://mrt_test.synovainteractive.com/IosProperty/Uploadphotos
	 */
	public function actionUploadphotos()
	{
		$property_id = isset($_POST['property_id']) ? intval($_POST['property_id']) : 0;
		 if($property_id < 1)
		{
			echo json_encode(array('returnCode'=>1));exit;//property_id is null
		}
		if (in_array($_FILES["property_photos"]["type"],array('image/jpeg','image/png','image/gif')))
		{
			if ($_FILES["property_photos"]["error"] > 0)
			{
				echo json_encode(array('returnCode'=>3,'errors'=>$_FILES["property_photos"]["error"]));exit;//error
			}
			else
			{
				$img_name = $_FILES["property_photos"]["name"];
				$photos_name = md5(time()).'.'.strtolower(substr($img_name, strlen($img_name) - 4));
				move_uploaded_file($_FILES["property_photos"]["tmp_name"],dirname(Yii::app()->basePath)."/upload/property/" . $photos_name);
				
				$image = Yii::app()->image->load('upload/property/'.$photos_name);
				$new_width = $image->width < 1000 ? 1000 : (1000 / $image->width) * $image->width;
				$new_height = $image->height < 1000 ? 1000 : (1000 / $image->height) * $image->height;
				$image->resize($new_width, $new_height);
				$image->save();
				
				if(!empty($photos_name))
				{
					$time = date('Y-m-d H:i:s',time());
					$sql = "update property set update_date='{$time}', photos= concat_ws(',',photos,'{$photos_name}') where uid=".Yii::app()->user->id." and property_id={$property_id}";
					$rs = Yii::app()->db->createCommand($sql)->query();
					if($rs)
					{
						echo json_encode(array('returnCode'=>4,'photos_name'=>$photos_name));exit;//success
					}else{
						echo json_encode(array('returnCode'=>5));exit;//failed
					}
				}
			}
		}
		else
		{
			echo json_encode(array('returnCode'=>2));exit;//image type
		}
	}
	
	/**
	 * Function Name: Createproperty
	 * Description  : Createproperty
	 * Params       : street city state zip apt title
	 * Method way   : POST
	 * Return       : 1:success('returnCode'=>1,'property_id')   2: failed  3:no login
	 * Note         : must login
	 * API url      : http://mrt_test.synovainteractive.com/IosProperty/Createproperty
	 */
	public function actionCreateproperty()
	{
		if(Yii::app()->user->id != '')
		{
			$street = isset($_POST['street']) ? $_POST['street'] : '';
			$city = isset($_POST['city']) ? $_POST['city'] : '';
			$state = isset($_POST['state']) ? $_POST['state'] : '';
			$zip = isset($_POST['zip']) ? $_POST['zip'] : '';
			$apt = isset($_POST['apt']) ? $_POST['apt'] : '';
			
			$modelProperty = new Property();
			
			$modelProperty->uid = Yii::app()->user->id;
			$modelProperty->logo = 'default_property.png';
			$time = date('Y-m-d H:i:s',time());
			$modelProperty->date = $time;
			$modelProperty->update_date = $time;
			$modelProperty->non_listing = 1;
			
			$modelProperty->address = $street .' '. $city .' '. $state .' '. $zip;
			$modelProperty->street = $street;
			$modelProperty->city = $city;
			$modelProperty->state = $state;
			$modelProperty->zip = $zip;
			$modelProperty->apt = $apt;
			
			$modelProperty->title = isset($_POST['title']) ? $_POST['title'] : $modelProperty->address;
			
			if($modelProperty->save())
			{
				echo json_encode(array('returnCode'=>1,'property_id'=>Yii::app()->db->getLastInsertID()));exit;//success
			}else{
				echo json_encode(array('returnCode'=>2));exit;//failed
			}
		}else{
			echo json_encode(array('returnCode'=>3));exit;//no login
		}
	}
	/**
	 * Function Name: Uploadvideo
	 * Description  : Uploadvideo
	 * Params       : property_id  property_video
	 * Method way   : POST
	 * Note         : must login
	 * API url      : http://mrt_test.synovainteractive.com/IosProperty/Uploadvideo
	 */
	public function actionUploadvideo()
	{
		$property_id = isset($_POST['property_id']) ? intval($_POST['property_id']) : 0;
		if($property_id < 1)
		{
			 echo "Return Code: 1";exit;
		}
		if (($_FILES["property_video"]["type"] == "video/quicktime"))
		{
		  if ($_FILES["property_video"]["error"] > 0)
		  {
		    echo "Return Code: " . $_FILES["property_video"]["error"] . "<br />";
		  }
		  else
		  {
			    if (file_exists("/upload/video/" . $_FILES["property_video"]["name"]))
			    {
			      echo $_FILES["property_video"]["name"] . " already exists. ";
			    }
			    else
			    {
			      move_uploaded_file($_FILES["property_video"]["tmp_name"],
			      dirname(Yii::app()->basePath)."/upload/video/" . $_FILES["property_video"]["name"]);
			      $video_name = $_FILES["property_video"]["name"];
			      
			      if(!empty($_FILES["property_video"]["name"]))
			      {
			      	//check video is null
			      	$sql = "select videos from property  where uid=".Yii::app()->user->id." and property_id={$property_id}";
			      	$rs_1 = Yii::app()->db->createCommand($sql)->queryScalar();
			      	$new_videos = empty($rs_1) ? $video_name : $rs_1.','.$video_name;
			      
			      	//update
			      	$sql = "update property set videos= '{$new_videos}' where uid=".Yii::app()->user->id." and property_id={$property_id}";
			      	$rs = Yii::app()->db->createCommand($sql)->query();
			      	if($rs)echo "Upload video successful";else echo "Upload video falid";
			      }
			      echo $_FILES["property_video"]["name"];
			     }
		    }
		}
		else
		{
		  echo "Invalid file";
		}
	}
	
	/**
	 * Function Name: Allpropertylist
	 * Description  : all property list
	 * Params       : page
	 * Method way   : Get
	 * Note         : must login
	 * API url      : http://mrt_test.synovainteractive.com/IosProperty/Allpropertylist?page=1
	 */
	public function actionAllpropertylist()
	{
		if(!empty(Yii::app()->user->id))
		{
			$sql="select count(property_id) as num from property";
			$rs_num=Yii::app()->db->createCommand($sql)->queryScalar();
			$rs_1='';
			if($rs_num > 0)
			{
				$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
				$Page_size=10;
				$page_count = ceil($rs_num/$Page_size);
				
				$offset=$Page_size*($page-1);
				$sql="select * from property where mrt_status=0 and non_listing=0 order by date desc limit $offset,$Page_size"; 
				$rs_1=Yii::app()->db->createCommand($sql)->queryAll();
			}
			echo empty($rs_1) ? '' : json_encode($rs_1);
		}
	}
	/**
	 * Function Name: Mypropertylist
	 * Description  : My property list
	 * Params       : page non_listing(0: current  1:non_listing)
	 * Method way   : Get
	 * Note         : must login
	 * API url      : http://mrt_test.synovainteractive.com/IosProperty/Mypropertylist?page=1&non_listing=0
	 */
	public function actionMypropertylist()
	{
		if(!empty(Yii::app()->user->id))
		{
			$non_listing =  isset($_GET['non_listing']) ? intval($_GET['non_listing']) : 0;
			$sql="select count(property_id) as num from property where uid=".Yii::app()->user->id." and non_listing={$non_listing} order by date desc";
			$rs_num=Yii::app()->db->createCommand($sql)->queryScalar();
			$rs_1='';
			if($rs_num > 0)
			{
				
				$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
				$Page_size=10;
				$page_count = ceil($rs_num/$Page_size);
				
				$offset=$Page_size*($page-1);
				$sql="select * from property where uid=".Yii::app()->user->id." and non_listing={$non_listing} order by date desc limit $offset,$Page_size";
				$rs_1=Yii::app()->db->createCommand($sql)->queryAll();
			}
			echo empty($rs_1) ? '' : json_encode($rs_1);
		}
	}
	/**
	 * Function Name: Clientshareproperty
	 * Description  : Clientshareproperty for client
	 * Params       : page
	 * Method way   : Get
	 * Note         : must login
	 * API url      : http://mrt_test.synovainteractive.com/IosProperty/Clientshareproperty?page=1
	 */
	public function actionClientshareproperty()
	{
		if(!empty(Yii::app()->user->id))
		{
			$sql="select count(sid) as num from share_non_listing where uid=".Yii::app()->user->id;
			$rs_num=Yii::app()->db->createCommand($sql)->queryScalar();
			$rs_1='';
			if($rs_num > 0)
			{
				$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
				$Page_size=10;
				$page_count = ceil($rs_num/$Page_size);
					
				$offset=$Page_size*($page-1);
				$sql="select b.* from share_non_listing as a left join property as b on a.property_id=b.property_id where a.uid=".Yii::app()->user->id." and b.non_listing=1 order by b.update_date desc limit $offset,$Page_size";
				$rs_1=Yii::app()->db->createCommand($sql)->queryAll();
			}
			echo empty($rs_1) ? '' : json_encode($rs_1);
		}
	}

	/**
	 * Function Name: Detail
	 * Description  : property Detail
	 * Params       : property_id
	 * Method way   : Get
	 * Note         : must login
	 * API url      : http://mrt_test.synovainteractive.com/IosProperty/Detail?property_id=6
	 */
	public function actionDetail()
	{
		if(isset($_GET['property_id'])) $property_id=intval($_GET['property_id']);
		if(!empty(Yii::app()->user->id) && !empty($property_id))
		{
			$sql="select * from property where property_id={$property_id}";
			$rs_1=Yii::app()->db->createCommand($sql)->queryRow();
			echo empty($rs_1) ? '' : json_encode($rs_1);
		}
	}
	/*
	 * send msg
	 * Params: to_uid
	 *         content
	 * Return: 'returnCode'=>1 : success
	 *         'returnCode'=>2 : uid or to_uid or content is null 
	 *         'returnCode'=>3 : send faild
	 * Note  : must login
	 */
	public function actionSend()
	{
		if(!empty(Yii::app()->user->id) && !empty($_POST['to_uid']) && !empty($_POST['content']))
		{
			$model=new Inbox;
			$model->content=$_POST['content'];
			$model->date = date('y-m-d H:i:s');
			$model->to_uid = $_POST['to_uid'];
			$model->from_uid = Yii::app()->user->id;
			if($model->save())
			{
				$modelUser=User::model()->findByPk($_POST['to_uid']);
				if(!empty($modelUser['push_id']))
				{
					$apns = new Apns($modelUser['push_id'], 'The message from MRT',$_POST['content'],2,Yii::app()->user->id);
					$apns->doPush();
				}
				echo json_encode(array('returnCode'=>1));
			}else{
				echo json_encode(array('returnCode'=>3));//send faild
			}
		}else{
			echo json_encode(array('returnCode'=>2));//uid or to_uid or content is null  
		}
	}
	/*
	 * del one contact list
	 * Params: to_uid: the list about me and one uid
     * Return: success: 'returnCode'=>1 
     *         error  : 'returnCode'=>0
	 * Note  : must login
	 */
	public function actionDelone()
	{
		if(!empty(Yii::app()->user->id) && !empty($_POST['to_uid']))
		{
			$from_uid = $_POST['to_uid'];
			$sql = "delete from inbox where (from_uid=".$from_uid." and to_uid=".Yii::app()->user->id.") or (from_uid=".Yii::app()->user->id." and to_uid=".$from_uid.")";
			if(Yii::app()->db->createCommand($sql)->query())
				echo json_encode(array('returnCode'=>1));
			else 
				echo json_encode(array('returnCode'=>0));
		}
	}
	/**
	 * Function Name: Search
	 * Description  : Search property 
	 * Params       : property items and page
	 * 					page=1&property_type=1&selling_status=1&property_status=1&beds=1&baths=1&street=&city=&state=&zip=
	 * 					&price_from=&price_to=&lot_size_from=&lot_size_to=&house_size_from=&house_size_to=
	 * Method way   : get
	 * Note         : 
	 * API url      : /IosProperty/Search
	 */
	public function actionSearch()
	{
 		$property_type = self::getPost('property_type');
		$selling_status = self::getPost('selling_status');
		$property_status = self::getPost('property_status');
		$beds = self::getPost('beds');
		$baths = self::getPost('baths');
// 		$address = self::getPost('address');
		
		$street = self::getPost('street');
		$city = self::getPost('city');
		$state = self::getPost('state');
		$zip = self::getPost('zip');
		
		$price_from = self::getPost('price_from');
		$price_to = self::getPost('price_to');
		$lot_size_from = self::getPost('lot_size_from');
		$lot_size_to = self::getPost('lot_size_to');
		$house_size_from = self::getPost('house_size_from');
		$house_size_to = self::getPost('house_size_to');
		
		$sql = '';
		$sql.= empty($property_type) ? "" : " and property_type=".$property_type;
		$sql.= empty($selling_status) ? "" : " and selling_status=".$selling_status;
		$sql.= empty($property_status) ? "" : " and property_status=".$property_status;
		
		$sql.= empty($beds) ? "" : " and beds=".$beds;
		$sql.= empty($baths) ? "" : " and baths=".$baths;
		
// 		if(!empty($address))$sql.= " and address like '%".$address."%' ";
		if(!empty($street))$sql.= " and street like '%".$street."%' ";
		if(!empty($city))$sql.= " and city like '%".$city."%' ";
		if(!empty($state))$sql.= " and state like '%".$state."%' ";
		if(!empty($zip))$sql.= " and zip like '%".$zip."%' ";
		
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
		
		$sql_list="select *,property_id as id from property where non_listing=0 ".$sql;
		$sql_count="select  count(property_id) as num from property where non_listing=0 ".$sql;
		$rs_num=Yii::app()->db->createCommand($sql_count)->queryScalar();
		$rs_1='';
		if($rs_num > 0)
		{
			$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
			$Page_size=10;
			$page_count = ceil($rs_num/$Page_size);
			
			$offset=$Page_size*($page-1);
			$sql="select all_list.* from ($sql_list) as all_list limit $offset,$Page_size";
			$rs_1=Yii::app()->db->createCommand($sql)->queryAll();
		}
		echo empty($rs_1) ? '' : json_encode(array($rs_num,$rs_1));
	}
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Contact::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
}