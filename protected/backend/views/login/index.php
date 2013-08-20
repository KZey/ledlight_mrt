<link href="css/style_index.css" type="text/css" rel="stylesheet" />
<body>
<div style="margin: 0 auto;width:100%;border:0px solid red;">
   
   	<?php if(!Yii::app()->user->isGuest){?>
		Welcome, <?php echo Yii::app()->user->first_name.' '.Yii::app()->user->last_name;?>
	<?php }else{?>
			<div style="margin: 0 auto;width:200px;border:0px solid red;">
				<?php
					$form = $this->beginWidget ( 'CActiveForm', array (
							'id' => 'login-form',
							'action'=>'/admin.php/login/login',
							'enableAjaxValidation' => false 
					) );
				?>
				   <div style="overflow:hidden;color:#999999">
						<div id="username_frame" style="margin-top:3px;">
					        <?php echo CHtml::textField('email','',array('class'=>'login_input','placeholder'=>'UserName','tabindex'=>1,'style'=>'width:140px;height:25px;color:#A2A2A2;'))?>
					    </div>
						<div  style="margin-top:3px;">
					    	<?php echo CHtml::passwordField('password','',array('class'=>'login_input','placeholder'=>'Password','tabindex'=>2,'style'=>'width:140px;height:25px;color:#A2A2A2;'))?>
					    </div>
					    <div class="clear"></div>
					    <div style="color:#999999;">
							<a href="/<?php echo BACKEND_ENTRY_NAME;?>/login/forgetpwd">Forgot password ?</a>
							<br/>
							<input type="submit" value="Login" />  
						</div>
					</div>
					
					<?php $this->endWidget(); ?>
			</div>
			<?php if(Yii::app()->user->hasFlash('loginError'))echo '<script>alert("'.Yii::app()->user->getFlash('loginError').'");</script>'; ?>
	<?php }?>
			
</div>
</body>