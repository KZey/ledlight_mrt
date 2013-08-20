<?php
	require_once 'API_Config.php';
	require_once 'OpenTokSDK.php';
	
	class OpenTok
	{
		public static function getApiObj()
		{
			return new OpenTokSDK(API_Config::API_KEY, API_Config::API_SECRET);
		}
		
		public static function getApiKey()
		{
			return API_Config::API_KEY;
		}
		
		public static function getSessionId()
		{
			$apiObj = self::getApiObj();
			if(!empty($apiObj))
			{
				$session = $apiObj->createSession($_SERVER["REMOTE_ADDR"]);
			}
			if(!empty($session))
			{ 
				return $session->getSessionId();
			}
		}
		
		public static function getToken($sessionId,$role=3)
		{
			if(!empty($sessionId))
			{
				$apiObj = self::getApiObj();
				$roleValue = '';
				switch($role)
				{
					case 1:$roleValue = RoleConstants::SUBSCRIBER;break;
					case 2:$roleValue = RoleConstants::PUBLISHER;break;
					case 3:$roleValue = RoleConstants::MODERATOR;break;
				}
				if(!empty($apiObj))return $apiObj->generateToken($sessionId, $roleValue);
				
			}else{
				echo 'sessionid is null';
			}
		}
		
	}
?>
