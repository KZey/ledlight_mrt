<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" xmlns:fb="http://ogp.me/ns/fb#">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/login.css" />
    
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/zxxbox.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/powerFloat.css" />
    
	<script type="text/javascript" rel="stylesheet" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.js"></script>
	<script type="text/javascript" rel="stylesheet" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.cookie.js"></script>
	<script type="text/javascript" rel="stylesheet" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.zxxbox.3.0.js"></script>
	<script type="text/javascript" rel="stylesheet" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.powerFloat.min.js"></script>
	<script type="text/javascript" rel="stylesheet" src="<?php echo Yii::app()->request->baseUrl; ?>/js/customer/common.js"></script>
	<script type="text/javascript" rel="stylesheet" src="<?php echo Yii::app()->request->baseUrl; ?>/js/swfobject.js"></script>
	<script type="text/javascript" rel="stylesheet" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.hovercard.min.js"></script>
	<script type="text/javascript" rel="stylesheet" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.json-2.4.min.js"></script>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
<body  id="page">
<div class="container">
	<div style="height: 100%; width:100%;padding:0px; margin:0px;">
			<div id="header">
				<div id="logo" style="border:0px solid red;float:left;"><a href="/"><img src="/images/logo.png"/></a></div>
				<div style="float:right;border:0px solid red;">
					<?php if(!Yii::app()->user->isGuest){?>
						<div style="margin-top:55px">
							<a href="/user/broadcastlist"><img src="/images/broadcast.png" /></a> &nbsp;
							<a href="/inbox"><img src="/images/email_icon.png" /></a> &nbsp;
							<span style="color:#999999">Welcome,</span> <a href="/user" id="trigger" rel="targetBox" style="text-decoration:none;color:#0066cc">
							<?php echo Yii::app()->user->first_name.' '.Yii::app()->user->last_name;?>&nbsp;<img src="/images/jiantou.png" /></a>
							<div id="targetBox" style="margin-right:30px;border:1px solid gray;width:100px;display:none;background:#fff;border-radius: 5px;box-shadow:0 0 7px rgba(0,0,0,0.6);">
								<div style="padding:5px;border-bottom:1px dashed red;">
									<?php if(Yii::app()->user->type==1){?>
										<a href="/user" style="color:#000;">Profile</a>
									<?php }else{?>
										<a href="/user" style="color:#000;">Dashboard</a>
									<?php }?>
								</div>
								<div style="padding:5px;border-bottom:1px dashed red;"><a href="/user/changepwd" style="color:#000;">Change Password</a></div>
								<div style="padding:5px;"><a href="/user/logout" style="color:#000;">Logout</a></div>
							</div>
						</div>
					<?php }else{?>
							<div style="margin-top: 10px;">
								<?php
									$form = $this->beginWidget ( 'CActiveForm', array (
											'id' => 'login-form',
											'action'=>'/login/login',
											'enableAjaxValidation' => false 
									) );
								?>
								   <div style="float:left;overflow:hidden;color:#999999">
										<div id="username_frame" style="margin-top:3px;">
									        <?php echo CHtml::textField('email','',array('class'=>'login_input','placeholder'=>'Email:','tabindex'=>1,'style'=>'width:140px;height:25px;color:#A2A2A2;'))?>
									    </div>
										<div  style="float:left;margin-top:3px;">
									    	<?php echo CHtml::passwordField('password','',array('class'=>'login_input','placeholder'=>'Password:','tabindex'=>2,'style'=>'width:140px;height:25px;color:#A2A2A2;'))?>
									    </div>
									    <div class="clear"></div>
									    <div style="color:#999999;">
											<div style="float:left;"><?php echo CHtml::checkBox('rememberMe',false);?>&nbsp;Stay logged in</div>
											<div style="float:right;"><a href="/login/forgetpwd" style="color:#3578AC;text-decoration:underline;">Forgot password ?</a></div>
										</div>
									</div>
									<div style="float:right;margin-left:20px;">
										<input type="image" src="<?php echo Yii::app()->request->baseUrl; ?>/images/login_button.png" />  
									</div>  
									<?php $this->endWidget(); ?>
							</div>
							<?php if(Yii::app()->user->hasFlash('loginError'))echo '<script>alert("'.Yii::app()->user->getFlash('loginError').'");</script>'; ?>
					<?php }?>
				</div>
			</div>
			<div class="clear"></div>
			<div><?php echo $content; ?></div>
	</div>
	<div class="clear"></div>
	<div id="footer">
		<div class="footer_line"></div>
		<div style="padding-top: 10px;">Copyright 2012 - MyRealTour.com</div>
		<div class="footer_twitter">
    <a href="https://twitter.com/kz_coder" class="twitter-follow-button" data-show-count="true" data-lang="en" >Follow @MyRealTour</a>
	    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","tw	itter-wjs");</script>
		</div>
	</div>
      
	   <div class='footer_facebook'>
         <div class="fb-like" data-href="http://www.myrealtour.com" data-width="450" data-show-faces="false" data-send="false"></div>
       </div>

	</div>	
	<script type="text/javascript" rel="stylesheet" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.powerFloat.min.js"></script>
	<script>
	$(function() {
		$("#trigger").powerFloat({position:'3-2',offsets:{x:0, y:5}});
	});
	</script>
</body>

<div id="fb-root"></div>
 <script>
        (function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1&appId=403927466287238";
		fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
 </script>


</html>
