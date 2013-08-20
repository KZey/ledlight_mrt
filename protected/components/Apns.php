<?php
class Apns
{
	private $deviceToken;
	private $message;
	private $badge=2;
	private $sound="bird.wav";
	private $ck_pem;
	private $msg;
	private $type;
	private $from_uid;
	const CK_PEM = 'ck.pem';
	const CK_PASS = 'synova';
	const APPLE_PUSH_URL = "ssl://gateway.sandbox.push.apple.com:2195";
	
	public function __construct($deviceToken,$message,$msg='',$type='',$from_uid='',$property_id='',$sound="bird.wav")
	{
		$this->deviceToken = $deviceToken;
		$this->message = $message;
		$this->msg = $msg;
		$this->type = $type;
		$this->from_uid = $from_uid;
		$this->sound = $sound;
		$this->property_id = $property_id;
	}
	
	public function doPush()
	{
		//echo Yii::app()->basePath.'\controllers\ck.pem';
		$body = array();
		$body['aps'] = array('alert' => $this->message);
		if ($this->badge)
			$body['aps']['badge'] = $this->badge;
		if ($this->sound)
			$body['aps']['sound'] = $this->sound;
		
		$body['aps']['msg'] =$this->msg;
		$body['aps']['type'] =$this->type;
		$body['aps']['from_uid'] =$this->from_uid;
		$body['aps']['property_id'] =$this->property_id;
		$ctx = stream_context_create();
// 		stream_context_set_option($ctx, 'ssl', 'local_cert', $this->ck_pem);
// 		stream_context_set_option($ctx, 'ssl', 'passphrase', self::CK_PASS);
		
		stream_context_set_option($ctx, 'ssl', 'local_cert', dirname(__FILE__) . '/' . self::CK_PEM);
		stream_context_set_option($ctx, 'ssl', 'passphrase', self::CK_PASS);
		
		$fp = stream_socket_client(self::APPLE_PUSH_URL, $err, $errstr, 60, STREAM_CLIENT_CONNECT, $ctx);
		if (!$fp) {
			print "Failed to connect $err $errstr\n";
			return;
		}
		else {
			//print "Connection OK\n<br/>";
		}
		
		$payload = json_encode($body);
		$msg = chr(0) . pack("n",32) . pack('H*', str_replace(' ', '', $this->deviceToken)) . pack("n",strlen($payload)) . $payload;
		///print "Sending message :" . $payload . "\n";
		fwrite($fp, $msg);
		//print_r($err);
		//print_r($errstr);
		//socket_close($fp);
		fclose($fp);
	}
}
?>