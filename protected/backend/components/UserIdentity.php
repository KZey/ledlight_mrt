<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	private $_id;
	const ERROR_NONE = 0;
	const ERROR_EMAIL_INVALID=3;
	const ERROR_STATUS_NOTACTIVE=4;
	const ERROR_STATUS_BANNED=5;
	const ERROR_USERNAME_INVALID = 6;
	const ERROR_PASSWORD_INVALID = 7;
	const ERROR_ACCOUNT_NOT_ALLOW = 8;
	const ERROR_OTHER = 10;
	public $user;
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */	
	public function authenticate()
    {        
        $user=Manager::model()->findByAttributes(array('email'=>$this->username));
//         CVarDumper::dump($user,10,true);exit;
		if($user===null)
		{
// 			if (strpos($this->username,"@")) {
// 				$this->errorCode=self::ERROR_EMAIL_INVALID;
// 			} else {
				$this->errorCode=self::ERROR_USERNAME_INVALID;
// 			}
		}
		else if(md5($this->password)!==$user->pwd)
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
// 		else if($user->status==0)
// 			$this->errorCode=self::ERROR_STATUS_BANNED;
		else {
			$this->_id=$user->uid;
			$this->username=$user->email;
			/* $userInfo = array(
					'type'=>$user->type,
					'first_name'=>$user->first_name,
					'last_name'=>$user->last_name,
					'office'=>$user->office,
					'mobile'=>$user->mobile,
					'logo'=>$user->logo,
					'state'=>$user->state,
					'city'=>$user->city,
					'twitter_uname'=>$user->twitter_uname,
					'twitter_pwd'=>$user->twitter_pwd,
					'facebook_uname'=>$user->facebook_uname,
					'facebook_pwd'=>$user->facebook_pwd,
					); */
			//$this->setUser($user);
			//$this->setState('first_name', $user->first_name);
			//$this->setUserState($userInfo);
			$this->errorCode=self::ERROR_NONE;
		}
		//unset($user);
		return !$this->errorCode;
    }
    public function getUser()
    {
    	return $this->user;
    }
    
    public function setUser(CActiveRecord $user)
    {
    	$this->user=$user->attributes;
    }
    public function getId()
    {
        return $this->_id;
    }
    public function setUserState($user)
	{
			foreach($user AS $key=>$val)
			{
				
				$this->setState($key, $val);
			}
		
	}
}