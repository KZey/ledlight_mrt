<?php
	require_once 'API_Config.php';
	require_once 'OpenTokSDK.php';
	
	class OpenTok
	{
		public static function getApiKey()
		{
			return API_Config::API_KEY;
		}
		public static function getRS()
		{
			$apiObj = new OpenTokSDK(API_Config::API_KEY, API_Config::API_SECRET);
			$session = $apiObj->createSession($_SERVER["REMOTE_ADDR"]);
			$sessionId = $session->getSessionId();
			$token = $apiObj->generateToken($sessionId, RoleConstants::MODERATOR);
			return array($sessionId,$token);
		}
		public static function getToken($sessionId,$role=3)
		{
			if(!empty($sessionId))
			{
				$apiObj = new OpenTokSDK(API_Config::API_KEY, API_Config::API_SECRET);
				$roleValue = '';
				switch($role)
				{
					case 1:$roleValue = RoleConstants::SUBSCRIBER;break;
					case 2:$roleValue = RoleConstants::PUBLISHER;break;
					case 3:$roleValue = RoleConstants::MODERATOR;break;
				}
				if(!empty($apiObj))return $apiObj->generateToken($sessionId, RoleConstants::MODERATOR);
				
			}else{
				echo 'sessionid is null';
			}
		}
	}
?>
