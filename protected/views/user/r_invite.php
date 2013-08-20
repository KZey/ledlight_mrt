<div style="border:0px solid red;width:950px;overflow:hidden;">
	<div class="menu_div">
		<div id="menu_dashboard" style="float:left;" class="menu_li_selected"><img src="/images/menu_dashboard.png" /></div>
		<div id="menu_property" style="float:left;" class="menu_li_default"><img src="/images/menu_property.png" /></div>
		<div id="menu_realtor" style="float:left;" class="menu_li_default"><img src="/images/menu_realtor.png" /></div>
	</div>
	<div style="border:0px solid red;width:100%;overflow:hidden;margin:0 auto;margin-top:3px;z-index:1;">
		<?php echo $this->renderPartial('_Rleft', array('model'=>$model,'modelEmail'=>$modelEmail,'hidden_to_uid'=>$hidden_to_uid
				)); ?>
		<div style="float: right;border:1px solid #C2C2C2;width:75%;overflow:hidden;">
			<div style="padding:5px 0 7px 10px;width:100%;border-bottom:1px solid #C2C2C2;background-image:url(/images/createproperty_title_bg.png);">
				<img src="/images/enroll_a_client.png" />
			</div>
			<div style="float: right;border:0px solid red;overflow:hidden;padding:15px;width:96%;background:#F7F7F7;">
			
	
			<div id="r_index_content" style="width:100%;margin:0 auto;">
					<br/>

	<div style='padding:10px;width:80%;border:0px solid red;margin:0 auto;'>
		Enter as much information as you can (required fields are noted by an
		asterisk) for your client. An email will be sent with a link to MRT to 
		complete the registration process and create a user profile.
		<br/>
<?php if(Yii::app()->user->hasFlash('successEnroll')){echo '<script>alert("'.Yii::app()->user->getFlash('successEnroll').'");</script>';}?>
<?php if(Yii::app()->user->hasFlash('errorEnroll')){echo '<script>alert("'.Yii::app()->user->getFlash('errorEnroll').'");</script>'; }?>
		
		<div class="clear" style="height:20px;"></div>
		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'user-form',
			'enableAjaxValidation'=>false,
		)); ?>
			<div class="row">
				<ul class="regirest_form_row">
					<li class="regirest_form_row_li_1"><?php echo $form->labelEx($modelInviteclient,'buyorsell',array('style'=>'height:25px;padding-top:3px;top:1px;font-size:12px;')); ?></li>
					<li class="regirest_form_row_li_2"><?php echo $form->radioButtonList($modelInviteclient,'buyorsell',array('1'=>'Buyer','2'=>'Seller'),array('separator'=>'&nbsp','labelOptions'=>array('class'=>'labelForRadio'))); ?></li>
					<li class="invite_form_row_li_3" style='padding-left:50px;width:260px;'><?php echo $form->error($modelInviteclient,'buyorsell'); ?></li>
				</ul>
			</div>
			<div class="clear" style="height:20px;"></div>
			<div class="row">
				<ul class="regirest_form_row">
					<li class="regirest_form_row_li_1"><?php echo $form->labelEx($modelInviteclient,'first_name',array('style'=>'height:25px;padding-top:3px;top:1px;font-size:12px;')); ?></li>
					<li class="regirest_form_row_li_2"><?php echo $form->textField($modelInviteclient,'first_name',array('size'=>30,'maxlength'=>255,'class'=>'regirest_text')); ?></li>
					<li class="invite_form_row_li_3" style='padding-left:50px;width:260px;'><?php echo $form->error($modelInviteclient,'first_name'); ?></li>
				</ul>
			</div>
			<div class="clear" style="height:20px;"></div>
			<div class="row">
				<ul class="regirest_form_row">
					<li class="regirest_form_row_li_1"><?php echo $form->labelEx($modelInviteclient,'last_name',array('style'=>'height:25px;padding-top:3px;top:1px;font-size:12px;')); ?></li>
					<li class="regirest_form_row_li_2"><?php echo $form->textField($modelInviteclient,'last_name',array('size'=>30,'maxlength'=>255,'class'=>'regirest_text')); ?></li>
					<li class="invite_form_row_li_3" style='padding-left:50px;width:260px;'><?php echo $form->error($modelInviteclient,'last_name'); ?></li>
				</ul>
			</div>
			<div class="clear" style="height:20px;"></div>
			<div class="row">
				<ul class="regirest_form_row">
					<li class="regirest_form_row_li_1"><?php echo $form->labelEx($modelInviteclient,'email',array('style'=>'height:25px;padding-top:3px;top:1px;font-size:12px;')); ?></li>
					<li class="regirest_form_row_li_2"><?php echo $form->textField($modelInviteclient,'email',array('size'=>30,'maxlength'=>255,'class'=>'regirest_text')); ?></li>
					<li class="invite_form_row_li_3" style='padding-left:50px;width:260px;'><?php echo $form->error($modelInviteclient,'email'); ?>
					<?php if(Yii::app()->user->hasFlash('error_email_exists')){echo '<div class="errorMessage">'.Yii::app()->user->getFlash('error_email_exists').'</div>'; }?>
					</li>
				</ul>
			</div>
			<div class="clear" style="height:20px;"></div>
			<?php echo $form->hiddenField($modelInviteclient,'pwd'); ?>
			<?php echo $form->hiddenField($modelInviteclient,'repwd'); ?>
			<div class="row">
				<ul class="regirest_form_row">
					<li class="regirest_form_row_li_1"><?php echo $form->labelEx($modelInviteclient,'state',array('style'=>'height:25px;padding-top:3px;top:1px;font-size:12px;')); ?></li>
					<li class="regirest_form_row_li_2"><?php echo $form->dropDownList($modelInviteclient,'state',User::itemAlias('state'),array('style'=>'width:222px;')); ?></li>
					<li class="invite_form_row_li_3" style='padding-left:50px;width:260px;'><?php echo $form->error($modelInviteclient,'state'); ?></li>
				</ul>
			</div>
			<div class="clear" style="height:20px;"></div>
			<div class="row">
				<ul class="regirest_form_row">	
					<li class="regirest_form_row_li_1"><?php echo $form->labelEx($modelInviteclient,'city',array('style'=>'height:25px;padding-top:3px;top:1px;font-size:12px;')); ?></li>
					<li class="regirest_form_row_li_2"><?php echo $form->textField($modelInviteclient,'city',array('size'=>30,'maxlength'=>255,'class'=>'regirest_text')); ?></li>
					<li class="invite_form_row_li_3"><?php echo $form->error($modelInviteclient,'city'); ?></li>
				</ul>
			</div>
			<div class="clear" style="height:20px;"></div>
			<div class="row">
				<ul class="regirest_form_row">
					<li class="regirest_form_row_li_1"><?php echo $form->labelEx($modelInviteclient,'phone',array('style'=>'height:25px;padding-top:-3px;font-size:12px;')); ?></li>
					<li class="regirest_form_row_li_2"><?php echo $form->textField($modelInviteclient,'phone',array('size'=>30,'maxlength'=>255,'class'=>'regirest_text')); ?></li>
					<li class="invite_form_row_li_3"><?php echo $form->error($modelInviteclient,'phone'); ?></li>
				</ul>
			</div>
			<div class="clear" style="height:20px;"></div>
			<div class="row buttons" style="width:100%;height:30px;margin-top:10px;">
				<div class="row buttons" style="width:100%;text-align:center;">
					<?php echo CHtml::imageButton('/images/send_invitation.png');?>
				</div>
			</div>
		<?php $this->endWidget(); ?>

	</div>
			</div>
		</div>
	</div>
	
</div>
