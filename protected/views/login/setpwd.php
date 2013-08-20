<div class="form" style="border:1px solid gray;width:600px;height:360px; overflow:hidden;margin:0 auto;margin-top:50px;">
	<div style="border-bottom:1px solid gray;background:#C7D5DF;width:100%;height:30px; overflow:hidden;padding-top:10px;padding-left:10px;">
		Create a password
	</div>
	<div style="border:0px solid gray;width:100%;height:200px;margin:0 auto;">
		<div style="border:0px solid gray;width:70%;margin:0 auto;margin-top:60px;text-align:center;">
			<?php if($returnCode == 0){?>
				<?php $form=$this->beginWidget('CActiveForm', array(
					'id'=>'user-form',
					'enableAjaxValidation'=>false,
					'htmlOptions'=>array('enctype'=>'multipart/form-data',)
				)); ?>
				
					<div class="row">
						<ul class="regirest_form_row">	
							<li class="regirest_form_row_li_1"><?php echo $form->labelEx($modelUser,'Password'); ?></li>
							<li class="regirest_form_row_li_2"><?php echo $form->passwordField($modelUser,'pwd',array('size'=>30,'maxlength'=>255)); ?></li>
							<li class="regirest_form_row_li_3"><?php echo $form->error($modelUser,'pwd',array('value'=>'')); ?></li>
						</ul>
					</div>
					<div class="clear"></div>
					<div class="row">
						<ul class="regirest_form_row">
							<li class="regirest_form_row_li_1"><?php echo $form->labelEx($modelUser,'RE-enter Password'); ?></li>
							<li class="regirest_form_row_li_2"><?php echo $form->passwordField($modelUser,'repwd',array('size'=>30,'maxlength'=>255)); ?></li>
							<li class="regirest_form_row_li_3"><?php echo $form->error($modelUser,'repwd'); ?></li>
						</ul>
					</div>
					<div class="clear"></div>
					<div class="row buttons" style="height:30px;width:61%;text-align:right;">
						<?php echo CHtml::imageButton('/images/save.png'); ?>
					</div>
				<?php $this->endWidget(); ?>
			<?php }?>
		</div>
		<div style="border:0px solid gray;width:70%;margin:0 auto;margin-top:60px;text-align:center;">
			<?php if(Yii::app()->user->hasFlash('success')){
				echo '<div class="info" style="color:red">'.Yii::app()->user->getFlash('success').'</div>'; 
				//echo '<script>alert("'.Yii::app()->user->getFlash('success').'");</script>';
			}?>
				<?php if(Yii::app()->user->hasFlash('error')){
				echo '<div class="info_error" style="color:red">'.Yii::app()->user->getFlash('error').'</div>'; 
			}?>
			
		</div>
	</div>
	<div class="clear"></div>
	<div style="width:100%;border:0px solid gray;float:right;">
		<div class="bt_green_outer_113" style="float:right;margin:15px;"><a href="/"><div class="bt_green_inner_113">Back to Home</div></a></div>
	</div>
</div>