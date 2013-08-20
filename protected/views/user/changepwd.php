
<div style="border:0px solid red;width:950px;overflow:hidden;">
	<div class="menu_div">
		<div id="menu_dashboard" style="float:left;" class="menu_li_selected"><?php if(Yii::app()->user->type==1){?><img src="/images/menu_profile.png" /><?php }else{?><img src="/images/menu_dashboard.png" /><?php }?></div>
		<div id="menu_property" style="float:left;" class="menu_li_default"><img src="/images/menu_property.png" /></div>
		<?php
		    if($userType == 2) {
		?>
			   <div id="menu_realtor" style="float:left;" class="menu_li_default"><img src="/images/menu_realtor.png" /></div>
	    <?php
		  }
		?>

	</div>
	<div style="border:0px solid red;width:100%;overflow:hidden;margin:0 auto;margin-top:3px;z-index:1;">
		
		<div style="width:100%;overflow:hidden;margin:0 auto;"><br/><br/><br/>
			<div style="border:1px solid #C2C2C2;width:75%;overflow:hidden;margin:0 auto;">
				<div style="padding:5px 0 7px 10px;width:100%;border-bottom:1px solid #C2C2C2;background-image:url(/images/createproperty_title_bg.png);">
					<img src="/images/change_password.png" />
				</div>
				<div style="float: right;border:0px solid red;overflow:hidden;padding:15px;width:96%;background:#F7F7F7;">
				
					
			
				<!-- edit profile form -->	
				<div class="form">
				<?php $form=$this->beginWidget('CActiveForm', array(
					'id'=>'user-form',
					'enableAjaxValidation'=>false,
				)); ?>
					
					<?php echo CHtml::hiddenField('type',$model->type); ?>
					
							<?php 
								if(Yii::app()->user->hasFlash('success'))
									echo '<div class="info" style="color:red">'.Yii::app()->user->getFlash('success').'</div>';
							 	if(Yii::app()->user->hasFlash('error'))
								echo '<div class="info_error" style="color:red">'.Yii::app()->user->getFlash('error').'</div>'; 
							?>
				</div>
					
					<div style="border:0px solid red;overflow:hidden;padding:10px;width:100%;">
						<div style="float: left;border:0px solid red;width:100%;overflow:hidden;">
							<div style="margin-left:20px;border:0px solid red;overflow:hidden;">
								
								<div style="float: left;border:0px solid red;width:100%;">
									<div style="float:left;text-align:right;width:60%;">
										<div class="row">
											New <?php echo $form->labelEx($model,'pwd'); ?>
											<?php echo $form->passwordField($model,'pwd',array('value'=>'')); ?>
											<?php echo $form->error($model,'pwd'); ?>
											<?php if(Yii::app()->user->hasFlash('Password'))
								echo '<div class="info_error" style="color:red">'.Yii::app()->user->getFlash('Password').'</div>'; 
							?>
										</div>
									</div>
								</div><br/><br/>
								<div style="float: left;border:0px solid red;width:100%;margin-top:20px;">
									<div style="float:left;text-align:right;width:60%;">
										<div class="row">
											<?php echo $form->labelEx($model,'repwd'); ?>
											<?php echo $form->passwordField($model,'repwd',array('value'=>'')); ?>
											<?php echo $form->error($model,'repwd'); ?>
										</div>
									</div>
								</div>
								
							</div>
						</div>
						<div class="clear"></div><br/><br/>
						<div class="row buttons" style="height:30px;width:52%;text-align:right;">
							<?php echo CHtml::imageButton('/images/save.png'); ?>
						</div>
					</div>
					
					
				<?php $this->endWidget(); ?>
			<br/><br/><br/><br/><br/>
				<!-- edit profile form -->
			</div>
			</div>
		</div>
		
	</div>
</div>
