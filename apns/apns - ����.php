<?php
$deviceToken = '3a56bd4c 4c07b2ed d73bd374 57dbf8e1 cf4b6772 60f4a2a3 349d5044 81de2b41';
$pass = ' synova';   // Passphrase for the private key (ck.pem file)
 
// Get the parameters from http get or from command line
$message = $_GET['message'] or $message = $argv[1] or $message = 'A test message from worldcup';
$badge = (int)$_GET['badge'] or $badge = (int)$argv[2];
$sound = $_GET['sound'] or $sound = $argv[3];
 
// Construct the notification payload
$body = array();
$body['aps'] = array('alert' => $message);
if ($badge)
  $body['aps']['badge'] = $badge;
if ($sound)
  $body['aps']['sound'] = $sound;
 
// echo '<pre>';var_dump($body);echo '</pre>';exit;

/* End of Configurable Items */
$ctx = stream_context_create();
stream_context_set_option($ctx, 'ssl', 'local_cert', 'ck.pem');  
// assume the private key passphase was removed.
stream_context_set_option($ctx, 'ssl', 'passphrase', $pass);
 
// connect to apns
$fp = stream_socket_client('ssl://gateway.sandbox.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT, $ctx);
if (!$fp) {
    print "Failed to connect $err $errstr\n";
    return;
}
else {
   print "Connection OK\n<br/>";
}
 
// send message
$payload = json_encode($body);
$msg = chr(0) . pack("n",32) . pack('H*', str_replace(' ', '', $deviceToken)) . pack("n",strlen($payload)) . $payload;
print "Sending message :" . $payload . "\n";  
fwrite($fp, $msg);
fclose($fp);
?>