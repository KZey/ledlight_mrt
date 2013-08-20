<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/backendmain.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/backendform.css" />
	<script type="text/javascript" rel="stylesheet" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.js"></script>
	<script type="text/javascript" rel="stylesheet" src="<?php echo Yii::app()->request->baseUrl; ?>/js/customer/common.js"></script>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
<body id="page">
	<div style="height: 100%; width:100%;">
		<div >
			<?php if(!Yii::app()->user->isGuest){?>
			<div style="width:100%;margin: 0 atuo;border-bottom: 1px solid gray;">
				<div id="header" >
					
						<div style="float:left;border:0px solid red;margin-top:8px;margin-right:10px;">
								<a href="/<?php echo BACKEND_ENTRY_NAME;?>/apply/admin">Agent Application Listing</a>
						</div>
						<div style="float:right;border:0px solid red;margin-top:8px;margin-right:10px;">
								Welcome, <?php echo Yii::app()->user->name;?>&nbsp;&nbsp;
								<a href="/<?php echo BACKEND_ENTRY_NAME;?>/manager/changepwd">Change Password</a> | 
								<a href="/<?php echo BACKEND_ENTRY_NAME;?>/login/logout">Logout</a>
						</div>
					
				</div>
			</div>
			<?php }?>
			<div class="clear"></div>
			<div class="container">
				<div style="margin:10px 0;">
					<?php echo $content; ?>
				</div>
			</div>
			<div class="clear"></div>
			<?php if(!Yii::app()->user->isGuest){?>
			<div style="width:100%;margin: 0 atuo;border-top: 1px solid gray;">
				<div id="footer">
					<div style="">Copyright</div>
				</div>
			</div>	
			<?php }?>
		</div>
	</div>
	
	
	<script type="text/javascript" rel="stylesheet" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.powerFloat.min.js"></script>
	<script>
	$(function() {
		$("#trigger").powerFloat({position:'3-2',offsets:{x:0, y:5}});
	});
	</script>
</body>
</html>