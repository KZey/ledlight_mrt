<?php
class MrtApns
{
	private $deviceToken;
	private $message;
	private $badge=2;
	private $sound="received5.caf";
	const CK_PEM = 'ck.pem';
	const CK_PASS = 'synova';
	const APPLE_PUSH_URL = "ssl://gateway.sandbox.push.apple.com:2195";
	
	//http://www.hitsns.com/apns/apns.php?message=hello%20Vincent%20from%20hitsns&badge=2&sound=received5.caf
	public function __construct($deviceToken,$message)
	{
		$this->deviceToken = $deviceToken;
		$this->message = $message;
	}
	
	public function doPush()
	{
		$body = array();
		$body['aps'] = array('alert' => $this->message);
		if ($this->badge)
			$body['aps']['badge'] = $this->badge;
		if ($this->sound)
			$body['aps']['sound'] = $this->sound;
		
		//echo '<pre>';var_dump($body);echo '</pre>';exit;

		$ctx = stream_context_create();
		stream_context_set_option($ctx, 'ssl', 'local_cert', dirname(__FILE__) . '/' . self::CK_PEM);
		stream_context_set_option($ctx, 'ssl', 'passphrase', self::CK_PASS);
		
		$fp = stream_socket_client(self::APPLE_PUSH_URL, $err, $errstr, 60, STREAM_CLIENT_CONNECT, $ctx);
		if (!$fp) {
			print "Failed to connect $err $errstr\n";
			return;
		}
		else {
			print "Connection OK\n<br/>";
		}
		
		$payload = json_encode($body);
		$msg = chr(0) . pack("n",32) . pack('H*', str_replace(' ', '', $this->deviceToken)) . pack("n",strlen($payload)) . $payload;
		print "Sending message :" . $payload . "\n";
		fwrite($fp, $msg);
		echo 'tttttt';
		print_r($err);
		print_r($errstr);
		
		//socket_close($fp);
		fclose($fp);
	}
}
// Get the parameters from http get or from command line
// $message = $_GET['message'] or $message = $argv[1] or $message = 'A test message from worldcup';
// $badge = (int)$_GET['badge'] or $badge = (int)$argv[2];
// $sound = $_GET['sound'] or $sound = $argv[3];
?>