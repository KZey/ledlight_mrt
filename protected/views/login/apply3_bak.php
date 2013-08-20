<div id="login_cont" style="border:0px solid red;overflow:hidden;width:100%;">
	<div style="float:right;width:100%;border:0px solid red;margin-top: 20px;">
		<div class="index_regirest_title_agents"></div>
		
		<div style="border:1px solid #cccccc;background:#EDEDED;padding-top:10px;">
			<div style="height:480px;;border:0px solid #cccccc;width:55%;margin:0 auto;">

<br />
		Enter your billing information		
			

		<?php
            //require_once '/lib/anet_php_sdk/AuthorizeNet.php'; // The SDK
            $url = "192.168.110.132:8805/direct_post.php";
            $api_login_id = '3GN8smrLd3V'; //'YOUR_API_LOGIN_ID';
            $transaction_key = '2ky4838jHEYS9ypZ';
            $md5_setting = 'zhaopeng2013'; // Your MD5 Setting
            $amount = "5.99";
            AuthorizeNetDPM::directPostDemo($url, $api_login_id, $transaction_key, $amount, $md5_setting);
        ?>



			</div>
		</div>
	</div>
</div>
