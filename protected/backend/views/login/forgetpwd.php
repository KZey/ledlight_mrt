<div class="form" style="border:1px solid gray;width:600px;height:360px; overflow:hidden;margin:0 auto;margin-top:50px;">
	
	<div style="border-bottom:1px solid gray;background:#C7D5DF;width:100%;height:30px; overflow:hidden;padding-top:10px;">
		<div style="float:left;padding-left:10px;">Forget a password</div>
		<div style="float:right;padding-right:10px;"><a href="/<?php echo BACKEND_ENTRY_NAME;?>">Backend Home</a></div>
	</div>
	<div style="border:0px solid gray;width:100%;margin:0 auto;">
		<div style="width:95%;margin:0 auto;margin-top:60px;text-align:center;">
			<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'manager-form',
				'enableAjaxValidation'=>false,
				'htmlOptions'=>array('enctype'=>'multipart/form-data',)
			)); ?>
			
				<div class="row">
					<ul class="regirest_form_row">
						<li class="regirest_form_row_li_1" style="padding-top:20px;"><?php echo $form->labelEx($model,'email'); ?></li>
						<li class="regirest_form_row_li_2">
							<?php echo $form->textField($model,'email',array('size'=>40,'style'=>'height:34px','maxlength'=>255,'placeholder'=>'Please input the email you registered')); ?>
						</li>
						<li style="margin-left:170px;"><?php echo CHtml::imageButton('/images/send.png'); ?></li>
						<li class="regirest_form_row_li_3"><?php echo $form->error($model,'email'); ?></li>
					</ul>
				</div>
				<div class="clear"></div>
					<?php if(Yii::app()->user->hasFlash('success')){
			// 		echo '<div class="info" style="color:red">'.Yii::app()->user->getFlash('success').'</div>'; 
					echo '<script>alert("'.Yii::app()->user->getFlash('success').'");</script>';
				}?>
					<?php if(Yii::app()->user->hasFlash('error')){
					echo '<div class="info_error" style="color:red;">'.Yii::app()->user->getFlash('error').'</div>'; 
				}?>
				
			<?php $this->endWidget(); ?>
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
</div>