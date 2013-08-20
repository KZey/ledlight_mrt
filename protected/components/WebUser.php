<?php

class WebUser extends CWebUser
{
	private $_model;
	
	// Return first name.
	// access it by Yii::app()->user->first_name
	function getFirst_Name(){
		if(!empty(Yii::app()->user->id))
		{
		$user = $this->loadUser(Yii::app()->user->id);
		return $user->first_name;
		}
	}
	function getLast_Name(){
		if(!empty(Yii::app()->user->id))
		{
		$user = $this->loadUser(Yii::app()->user->id);
		return $user->last_name;
		}
	}
	function getSignature(){
		if(!empty(Yii::app()->user->id))
		{
			$user = $this->loadUser(Yii::app()->user->id);
			return $user->signature;
		}
	}
	function getType(){
		if(!empty(Yii::app()->user->id))
		{
		$user = $this->loadUser(Yii::app()->user->id);
		return $user->type;
		}
	}
	function getPush_Id(){
		if(!empty(Yii::app()->user->id))
		{
			$user = $this->loadUser(Yii::app()->user->id);
			return $user->push_id;
		}
	}
	// Load user model.
	protected function loadUser($id=null)
	{
		if($this->_model===null)
		{
			if($id!==null)
				$this->_model=User::model()->findByPk($id);
		}
		return $this->_model;
	}
	
	
	
	public function __get($name) 
	{ 
		if ($this->hasState('__userInfo')) 
		{ 
			$user=$this->getState('__userInfo',array()); 
			if (isset($user[$name])) 
			{ 
				return $user[$name]; 
			} 
		} 
		return parent::__get($name); 
	} 
	public function login($identity, $duration=0) 
	{ 
		//echo 1111111;exit; 
	
		parent::login($identity, $duration); 
// 		$this->setState('__userInfo', $identity->getUser());
// 		if(!empty(Yii::app()->user->id))
// 			$this->setState('__userInfo', User::model()->findByPk(Yii::app()->user->id));
		
	}

	/**
	 * Return admin status.
	 * @return boolean
	 */	
    public function isAdmin() 
	{
		if($this->isGuest)
		{
			return false;
		}
		else 
		{
			if(User::model()->active()->findbyPk(Yii::app()->user->id))
				return true;
			else
				return false;
		}
	}
	
}