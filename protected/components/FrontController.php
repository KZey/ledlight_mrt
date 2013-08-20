<?php
/**
 * Controller is the customized base controller class.
 * All front controller classes for this application should extend from this base class.
 */
class FrontController extends Controller
{	
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/main';
	protected $_patient;
	
	public function init()
	{
		parent::init();
	} 
	
	/**
	 * 加载患者信息
	 */
	public function loadPatient()
	{
	    $this->_patient = Yii::app()->user->patient;
	    if(empty($this->_patient))
	    {
	        Yii::app()->user->setFlash('Message',"请先在<患者信息>页面选择一个就诊的患者，再进行其他操作。");
		    $this->redirect(array('patient/index'));
	    }
		return $this->_patient;
	}
	
	//修改当前患者信息
    public function setPatient($patient)
	{
	    if($patient instanceof Patient)
	    {
	        Yii::app()->user->patient = $patient;
		    $this->_patient = Yii::app()->user->patient;
	    }
	    else
	    {
	        Yii::app()->user->setFlash('Message',"没有选择患者信息，请选择！");
		    $this->redirect(array('patient/index'));
	    }
	}

	/**
	 * 判断登录及权限验证
	 * @see CController::beforeAction()
	 */
/*     protected function beforeAction($action)
	{
		if(in_array($action->getId(),array('login', 'logout','captcha')) || in_array($this->getId(),array('login', 'logout','recovery', 'registration', 'ajax', 'activation', 'cmd')))
		{
			return true;
		}
		elseif(!Yii::app()->user->isAdmin())
		{
			$this->redirect('/site/logout');
		}
		
		//throw new CHttpException(400, '系统维护中,请2010-08-10 10:00以后访问。');
		//Yii::app()->end();

		return true;
	} */
}