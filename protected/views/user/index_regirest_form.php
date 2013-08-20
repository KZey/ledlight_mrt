<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/jquery.js');
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/customer/index.js');
?>

<div class="form" style="width:100%;border:0px solid blue;height:100%;over-flow:hidden;">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
)); ?>
	<?php echo CHtml::hiddenField('type',$type); ?>
	<?php if($type==1){?>
	<div  style="clear:both;"></div>
	<div class="row">
		<ul class="regirest_form_row">
			<li class="regirest_form_row_li_1"><?php echo $form->labelEx($modelUser,'buyorsell',array('style'=>'height:25px;padding-top:3px;top:1px;font-size:15px;font-weight:normal;')); ?></li>
			<li class="regirest_form_row_li_2"><?php echo $form->radioButtonList($modelUser,'buyorsell',array('1'=>'Buyer','2'=>'Seller'),array('separator'=>'&nbsp','labelOptions'=>array('class'=>'labelForRadio'))); ?></li>
			<li class="regirest_form_row_li_3"><?php echo $form->error($modelUser,'buyorsell'); ?></li>
		</ul>
	</div>
	<?php }?>
	<div  style="clear:both;"></div>
	<div class="row">
		<ul class="regirest_form_row">
			<li class="regirest_form_row_li_1"><?php echo $form->labelEx($modelUser,'first_name',array('style'=>'height:25px;padding-top:3px;top:1px;font-size:15px;font-weight:normal;')); ?></li>
			<li class="regirest_form_row_li_2"><?php echo $form->textField($modelUser,'first_name',array('size'=>30,'maxlength'=>255,'class'=>'regirest_text')); ?></li>
			<li class="regirest_form_row_li_3"><?php echo $form->error($modelUser,'first_name'); ?></li>
		</ul>
	</div>
<div  style="clear:both;"></div>
	<div class="row">
		<ul class="regirest_form_row">
			<li class="regirest_form_row_li_1"><?php echo $form->labelEx($modelUser,'last_name',array('style'=>'height:25px;padding-top:3px;top:1px;font-size:15px;font-weight:normal;')); ?></li>
			<li class="regirest_form_row_li_2"><?php echo $form->textField($modelUser,'last_name',array('size'=>30,'maxlength'=>255,'class'=>'regirest_text')); ?></li>
			<li class="regirest_form_row_li_3"><?php echo $form->error($modelUser,'last_name'); ?></li>
		</ul>
	</div>
	<div  style="clear:both;"></div>
	<div class="row">
		<ul class="regirest_form_row">
			<li class="regirest_form_row_li_1"><?php echo $form->labelEx($modelUser,'email',array('style'=>'height:25px;padding-top:3px;top:1px;font-size:15px;font-weight:normal;')); ?></li>
			<li class="regirest_form_row_li_2"><?php echo $form->textField($modelUser,'email',array('size'=>30,'maxlength'=>255,'class'=>'regirest_text')); ?></li>
			<li class="regirest_form_row_li_3"><?php echo $form->error($modelUser,'email'); ?></li>
		</ul>
	</div>
	<div  style="clear:both;"></div>
	<div class="row">
		<ul class="regirest_form_row">	
			<li class="regirest_form_row_li_1"><?php echo $form->labelEx($modelUser,'pwd',array('style'=>'height:25px;padding-top:3px;top:1px;font-size:15px;font-weight:normal;')); ?></li>
			<li class="regirest_form_row_li_2"><?php echo $form->passwordField($modelUser,'pwd',array('size'=>30,'maxlength'=>255,'class'=>'regirest_text')); ?></li>
			<li class="regirest_form_row_li_3"><?php echo $form->error($modelUser,'pwd'); ?></li>
		</ul>
	</div>
	<div  style="clear:both;"></div>
	<div class="row">
		<ul class="regirest_form_row">
			<li class="regirest_form_row_li_1"><?php echo $form->labelEx($modelUser,'repwd',array('style'=>'height:25px;padding-top:-3px;font-size:15px;font-weight:normal;')); ?></li>
			<li class="regirest_form_row_li_2"><?php echo $form->passwordField($modelUser,'repwd',array('size'=>30,'maxlength'=>255,'class'=>'regirest_text')); ?></li>
			<li class="regirest_form_row_li_3"><?php echo $form->error($modelUser,'repwd'); ?></li>
		</ul>
	</div>



  <div  style="clear:both;"></div>
  
        <div class="row">
            <ul class="regirest_form_row">
	              <li class="regirest_form_row_li_1"><?php echo $form->labelEx($modelUser,'phone',array('style'=>'height:25px;padding-top:3px;top:1px;font-size:15px;font-weight:normal;')); ?></li>
	               <li class="regirest_form_row_li_2"><?php echo $form->textField($modelUser,'phone',array('size'=>30,'maxlength'=>30,'class'=>'regirest_text')); ?></li>
	                <li class="regirest_form_row_li_3"><?php echo $form->error($modelUser,'phone'); ?></li>
	            </ul>
        </div>





<div  style="clear:both;"></div>

	<div class="row">
		<ul class="regirest_form_row">
			<li class="regirest_form_row_li_1"><?php echo $form->labelEx($modelUser,'city',array('style'=>'height:25px;padding-top:3px;top:1px;font-size:15px;font-weight:normal;')); ?></li>
			<li class="regirest_form_row_li_2"><?php echo $form->textField($modelUser,'city',array('size'=>30,'maxlength'=>50,'class'=>'regirest_text')); ?></li>
			<li class="regirest_form_row_li_3"><?php echo $form->error($modelUser,'city'); ?></li>
		</ul>
	</div>


  <div  style="clear:both;"></div>
   
        <div class="row">
             <ul class="regirest_form_row">
	              <li class="regirest_form_row_li_1"><?php echo $form->labelEx($modelUser,'state',array('style'=>'height:25px;padding-top:3px;top:1px;font-size:15px;font-weight:normal;')); ?></li>
	               <li class="regirest_form_row_li_2"><?php echo $form->dropDownList($modelUser,'state',User::itemAlias('state'),array('style'=>'width:222px;')); ?></li>
	               <li class="regirest_form_row_li_3"><?php echo $form->error($modelUser,'state'); ?></li>
	         </ul>
       </div>



	   <div  style="clear:both;"></div>

	   <div class="row">
	   <ul class="regirest_form_row">
	   <li class="regirest_form_row_li_1"><?php echo $form->labelEx($modelUser,'agent',array('style'=>'height:25px;padding-top:3px;top:1px;font-size:15px;font-weight:normal;')); ?></li>
	   <li class="regirest_form_row_li_2"><select name='agent' id = 'agent'>
	   <?php
	    foreach($agentList as $agent) {
	   ?>
	   <option value='<?php echo $agent['uid'];?>'><?php echo $agent['first_name'];?>&nbsp;<?php echo $agent['last_name'];?></option>
	   <?php
	   }
	   ?>
	   </select></li>
	   </ul>
	   </div>


	   <div  style="clear:both;"></div>
	   <?php if($type==2){?>
		   <div class="row" id="div_state_license">
			   <ul class="regirest_form_row">
			   <li class="regirest_form_row_li_1"><?php echo $form->labelEx($modelUser,'state_license',array('style'=>'height:25px;padding-top:3px;top:1px;font-size:15px;font-weight:normal;')); ?></li>
			   <li class="regirest_form_row_li_2"><?php echo $form->textField($modelUser,'state_license',array('size'=>30,'maxlength'=>255,'class'=>'regirest_text')); ?></li>
			   <li class="regirest_form_row_li_3"><?php echo $form->error($modelUser,'state_license'); ?></li>
			   </ul>
			   </div>
			   <?php }?>
			   <div  style="clear:both;"></div>
			   <div class="row buttons" style="width:100%;height:30px;">
			   <div class="row buttons" style="width:188px;margin:0 auto;">
			   <?php echo  CHtml::submitButton('',array('class'=>'submitButton')); ?>
			   </div>
			   </div>

			   <?php $this->endWidget(); ?>
			   <?php if(Yii::app()->user->hasFlash('success')){
				   echo '<div class="info" style="color:red">'.Yii::app()->user->getFlash('success').'</div>';
				   // 		echo '<script>alert("'.Yii::app()->user->getFlash('success').'");</script>';
			   }?>
<?php if(Yii::app()->user->hasFlash('error')){
	echo '<div class="info_error" style="color:red">'.Yii::app()->user->getFlash('error').'</div>'; 
}?>
</div><!-- form -->
