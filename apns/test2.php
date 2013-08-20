    <?php
  
$pass = 'synova';
$ssl_url = "ssl://gateway.sandbox.push.apple.com:2195";
    
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $ssl_url);
curl_setopt($curl, CURLOPT_POST, 1);
 
// curl_setopt($curl, CURLOPT_SSLCERT, 'certificates.p12');
curl_setopt($curl, CURLOPT_SSLKEY, 'ck.pem');
curl_setopt($curl, CURLOPT_SSLCERTPASSWD, $pass);
curl_setopt($curl, CURLOPT_SSLKEYPASSWD, $pass);
 
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST,2);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($curl, CURLOPTL_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($curl, CURLOPT_POSTFIELDS, 'ssssss');//$msg为payload的json格式字符串
$data = curl_exec($curl);
echo "error: ".curl_error($curl)."
";
echo "errno: ".curl_errno($curl);
curl_close($curl);
//var_dump($data);
echo "return curl data: ".$data;
    ?>