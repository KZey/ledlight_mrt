<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'prospects-form',
	'enableAjaxValidation'=>false,
)); ?>
	
	
	<!---------------- first_name ---------------->
	<div class="row" style="float:left;font-weight:bold;font-size:18px;word-wrap:break-word; word-break:break-all;">
		<?php echo $model->first_name.' '.$model->middle_name.' '.$model->last_name.' '.$model->suffix;?> <br/>
		<?php echo $model->profession.' '.$model->title;?> 
	</div>
	<div class="clear"></div>
	
	<div class="row" style="float:left;width:240px;">
		<div style="float:left"><?php echo $form->labelEx($model,'type',array('style'=>'font-weight:normal')); ?></div>
		<div>&nbsp;</div>
		<?php echo $form->dropDownList($model,'type',Prospects::itemAlias('Type'),array('style'=>'width:210px;')); ?>
		<?php echo $form->error($model,'type'); ?>
	</div>
		
	<div class="row buttons" style="float:right;margin-right:15px;">
		<?php 
		 $url_parm = 'first_name='.$model->first_name.'&last_name='.$model->last_name.'&email='.$model->email_1.'&city='.$model->home_city.'&mobile='.$model->mobile;
		echo CHtml::image('/images/send_invitation.png','',array('style'=>'cursor:pointer','onclick'=>'location.href="/user/invite?'.$url_parm.'";'));?>
	</div>
				
	<div class="clear"></div>
	<div style="float:left;border:0px solid red;">
		<div class="row" style="float:left;width:240px;">
			<div style="float:left"><?php echo $form->labelEx($model,'mobile',array('style'=>'font-weight:normal')); ?></div>
			<div>&nbsp;</div>
			<?php echo $form->textField($model,'mobile',array('maxlength'=>255,'style'=>'width:210px;',));?>
			<?php echo $form->error($model,'mobile'); ?>
		</div>
		<div class="row" style="float:left;width:237px;">
			<div style="float:left"><?php echo $form->labelEx($model,'referred_buy',array('style'=>'font-weight:normal')); ?></div>
			<div>&nbsp;</div>
			<?php echo $form->textField($model,'referred_buy',array('maxlength'=>255,'style'=>'width:210px;',)); ?>
			<?php echo $form->error($model,'referred_buy'); ?>
		</div>
		<div class="clear"></div>
		
		<div class="row" style="float:left;width:240px;">
			<div style="float:left"><?php echo $form->labelEx($model,'email_1',array('style'=>'font-weight:normal')); ?></div>
			<div>&nbsp;</div>
			<?php echo $form->textField($model,'email_1',array('maxlength'=>255,'style'=>'width:210px;',));?>
			<?php echo $form->error($model,'email_1'); ?>
		</div>
		<div class="row" style="float:left;width:237px;">
			<div style="float:left"><?php echo $form->labelEx($model,'birthday',array('style'=>'font-weight:normal')); ?></div>
			<div>&nbsp;</div>
			<?php echo $form->textField($model,'birthday',array('maxlength'=>255,'style'=>'width:210px;',)); ?>
			<?php echo $form->error($model,'birthday'); ?>
		</div>
		<div class="clear"></div>
		
		<div class="row" style="float:left;width:240px;">
			<div style="float:left"><?php echo $form->labelEx($model,'email_2',array('style'=>'font-weight:normal')); ?></div>
			<div>&nbsp;</div>
			<?php echo $form->textField($model,'email_2',array('maxlength'=>255,'style'=>'width:210px;',));?>
			<?php echo $form->error($model,'email_2'); ?>
		</div>
		<div class="row" style="float:left;width:237px;">
			<div style="float:left"><?php echo $form->labelEx($model,'spouse',array('style'=>'font-weight:normal')); ?></div>
			<div>&nbsp;</div>
			<?php echo $form->textField($model,'spouse',array('maxlength'=>255,'style'=>'width:210px;',)); ?>
			<?php echo $form->error($model,'spouse'); ?>
		</div>
		<div class="clear"></div>
		
		
		<div class="row" style="float:left;width:240px;">
			<div style="float:left"><?php echo $form->labelEx($model,'email_3',array('style'=>'font-weight:normal')); ?></div>
			<div>&nbsp;</div>
			<?php echo $form->textField($model,'email_3',array('maxlength'=>255,'style'=>'width:210px;',));?>
			<?php echo $form->error($model,'email_3'); ?>
		</div>
		<div class="row" style="float:left;width:237px;">
			<div style="float:left"><?php echo $form->labelEx($model,'gender',array('style'=>'font-weight:normal')); ?></div>
			<div>&nbsp;</div>
			<?php echo $form->textField($model,'gender',array('maxlength'=>255,'style'=>'width:210px;',)); ?>
			<?php echo $form->error($model,'gender'); ?>
		</div>
		<div class="clear"></div>
	</div>
	<div style="float:left;border:0px solid red;">
		<div class="row">
			<?php echo $form->labelEx($model,'notes',array('style'=>'font-weight:normal')); ?>
			<?php echo $form->textArea($model,'notes',array('rows'=>13, 'cols'=>25,'style'=>'width:210px;',)); ?>
			<?php echo $form->error($model,'notes'); ?>
		</div>
	</div>
	
	<!---------------- Home ---------------->
	<div class="clear"></div>
	<div class="row" style="float:left;font-weight:bold;font-size:18px;"><br/>Home</div>
	<div class="clear"></div>
	<div class="row" style="float:left;width:240px;">
		<div style="float:left"><?php echo $form->labelEx($model,'home_street_1',array('style'=>'font-weight:normal')); ?></div>
		<div>&nbsp;</div>
		<?php echo $form->textField($model,'home_street_1',array('maxlength'=>255,'style'=>'width:210px;',));?>
		<?php echo $form->error($model,'home_street_1'); ?>
	</div>
	<div class="row" style="float:left;width:237px;">
		<div style="float:left"><?php echo $form->labelEx($model,'home_street_2',array('style'=>'font-weight:normal')); ?></div>
		<div>&nbsp;</div>
		<?php echo $form->textField($model,'home_street_2',array('maxlength'=>255,'style'=>'width:210px;',)); ?>
		<?php echo $form->error($model,'home_street_2'); ?>
	</div>
	<div class="row" style="float:left;">
		<div style="float:left"><?php echo $form->labelEx($model,'home_street_3',array('style'=>'font-weight:normal')); ?></div>
		<div>&nbsp;</div>
		<?php echo $form->textField($model,'home_street_3',array('maxlength'=>255,'style'=>'width:210px;',)); ?>
		<?php echo $form->error($model,'home_street_3'); ?>
	</div>
		
	<div class="clear"></div>
	<div class="row" style="float:left;width:240px;">
		<div style="float:left"><?php echo $form->labelEx($model,'home_address_po_box',array('style'=>'font-weight:normal')); ?></div>
		<div>&nbsp;</div>
		<?php echo $form->textField($model,'home_address_po_box',array('maxlength'=>255,'style'=>'width:210px;',));?>
		<?php echo $form->error($model,'home_address_po_box'); ?>
	</div>
	
		
	<div class="clear"></div>
	<div class="row" style="float:left;width:240px;">
		<div style="float:left"><?php echo $form->labelEx($model,'home_city',array('style'=>'font-weight:normal')); ?></div>
		<div>&nbsp;</div>
		<?php echo $form->textField($model,'home_city',array('maxlength'=>255,'style'=>'width:210px;',));?>
		<?php echo $form->error($model,'home_city'); ?>
	</div>
	<div class="row" style="float:left;width:237px;">
		<div style="float:left"><?php echo $form->labelEx($model,'home_state',array('style'=>'font-weight:normal')); ?></div>
		<div>&nbsp;</div>
		<?php echo $form->textField($model,'home_state',array('maxlength'=>255,'style'=>'width:210px;',)); ?>
		<?php echo $form->error($model,'home_state'); ?>
	</div>
	<div class="row" style="float:left;">
		<div style="float:left"><?php echo $form->labelEx($model,'home_postal_code',array('style'=>'font-weight:normal')); ?></div>
		<div>&nbsp;</div>
		<?php echo $form->textField($model,'home_postal_code',array('maxlength'=>255,'style'=>'width:210px;',)); ?>
		<?php echo $form->error($model,'home_postal_code'); ?>
	</div>
			
	<div class="clear"></div>
	
	<div class="row" style="float:left;width:237px;">
		<div style="float:left"><?php echo $form->labelEx($model,'home_country_region',array('style'=>'font-weight:normal')); ?></div>
		<div>&nbsp;</div>
		<?php echo $form->textField($model,'home_country_region',array('maxlength'=>255,'style'=>'width:210px;',)); ?>
		<?php echo $form->error($model,'home_country_region'); ?>
	</div>
	
		
	<div class="clear"></div>
	<div class="row" style="float:left;width:240px;">
		<div style="float:left"><?php echo $form->labelEx($model,'home_phone_1',array('style'=>'font-weight:normal')); ?></div>
		<div>&nbsp;</div>
		<?php echo $form->textField($model,'home_phone_1',array('maxlength'=>255,'style'=>'width:210px;',));?>
		<?php echo $form->error($model,'home_phone_1'); ?>
	</div>
	<div class="row" style="float:left;width:237px;">
		<div style="float:left"><?php echo $form->labelEx($model,'home_phone_2',array('style'=>'font-weight:normal')); ?></div>
		<div>&nbsp;</div>
		<?php echo $form->textField($model,'home_phone_2',array('maxlength'=>255,'style'=>'width:210px;',)); ?>
		<?php echo $form->error($model,'home_phone_2'); ?>
	</div>
	<div class="row" style="float:left;">
		<div style="float:left"><?php echo $form->labelEx($model,'home_fax',array('style'=>'font-weight:normal')); ?></div>
		<div>&nbsp;</div>
		<?php echo $form->textField($model,'home_fax',array('maxlength'=>255,'style'=>'width:210px;',)); ?>
		<?php echo $form->error($model,'home_fax'); ?>
	</div>
			
		
	
	
	
	
	
	
	<!---------------- company ---------------->
	<div class="clear"></div>
	<div class="row" style="float:left;font-weight:bold;font-size:18px;"><br/>
		<?php echo $model->company.' '.$model->department.' '.$model->job_title;?> <br/>
		<?php echo $model->web_page;?> 
	</div>
	<div class="clear"></div>
			
	<div class="clear"></div>
	<div class="row" style="float:left;width:240px;">
		<div style="float:left"><?php echo $form->labelEx($model,'business_street_1',array('style'=>'font-weight:normal')); ?></div>
		<div>&nbsp;</div>
		<?php echo $form->textField($model,'business_street_1',array('maxlength'=>255,'style'=>'width:210px;',));?>
		<?php echo $form->error($model,'business_street_1'); ?>
	</div>
	<div class="row" style="float:left;width:237px;">
		<div style="float:left"><?php echo $form->labelEx($model,'business_street_2',array('style'=>'font-weight:normal')); ?></div>
		<div>&nbsp;</div>
		<?php echo $form->textField($model,'business_street_2',array('maxlength'=>255,'style'=>'width:210px;',)); ?>
		<?php echo $form->error($model,'business_street_2'); ?>
	</div>
	<div class="row" style="float:left;">
		<div style="float:left"><?php echo $form->labelEx($model,'business_street_3',array('style'=>'font-weight:normal')); ?></div>
		<div>&nbsp;</div>
		<?php echo $form->textField($model,'business_street_3',array('maxlength'=>255,'style'=>'width:210px;',)); ?>
		<?php echo $form->error($model,'business_street_3'); ?>
	</div>
	
	<div class="clear"></div>
	<div class="row" style="float:left;width:240px;">
		<div style="float:left"><?php echo $form->labelEx($model,'business_address_po_box',array('style'=>'font-weight:normal')); ?></div>
		<div>&nbsp;</div>
		<?php echo $form->textField($model,'business_address_po_box',array('maxlength'=>255,'style'=>'width:210px;',));?>
		<?php echo $form->error($model,'business_address_po_box'); ?>
	</div>
	
	<div class="clear"></div>
	<div class="row" style="float:left;width:240px;">
		<div style="float:left"><?php echo $form->labelEx($model,'business_city',array('style'=>'font-weight:normal')); ?></div>
		<div>&nbsp;</div>
		<?php echo $form->textField($model,'business_city',array('maxlength'=>255,'style'=>'width:210px;',));?>
		<?php echo $form->error($model,'business_city'); ?>
	</div>
	<div class="row" style="float:left;width:237px;">
		<div style="float:left"><?php echo $form->labelEx($model,'business_state',array('style'=>'font-weight:normal')); ?></div>
		<div>&nbsp;</div>
		<?php echo $form->textField($model,'business_state',array('maxlength'=>255,'style'=>'width:210px;',)); ?>
		<?php echo $form->error($model,'business_state'); ?>
	</div>
	<div class="row" style="float:left;">
		<div style="float:left"><?php echo $form->labelEx($model,'business_postal_code',array('style'=>'font-weight:normal')); ?></div>
		<div>&nbsp;</div>
		<?php echo $form->textField($model,'business_postal_code',array('maxlength'=>255,'style'=>'width:210px;',)); ?>
		<?php echo $form->error($model,'business_postal_code'); ?>
	</div>
	
	<div class="clear"></div>
	<div class="row" style="float:left;width:237px;">
		<div style="float:left"><?php echo $form->labelEx($model,'business_country_region',array('style'=>'font-weight:normal')); ?></div>
		<div>&nbsp;</div>
		<?php echo $form->textField($model,'business_country_region',array('maxlength'=>255,'style'=>'width:210px;',)); ?>
		<?php echo $form->error($model,'business_country_region'); ?>
	</div>
	
	<div class="clear"></div>
	<div class="row" style="float:left;width:240px;">
		<div style="float:left"><?php echo $form->labelEx($model,'business_phone_1',array('style'=>'font-weight:normal')); ?></div>
		<div>&nbsp;</div>
		<?php echo $form->textField($model,'business_phone_1',array('maxlength'=>255,'style'=>'width:210px;',));?>
		<?php echo $form->error($model,'business_phone_1'); ?>
	</div>
	<div class="row" style="float:left;width:237px;">
		<div style="float:left"><?php echo $form->labelEx($model,'business_phone_2',array('style'=>'font-weight:normal')); ?></div>
		<div>&nbsp;</div>
		<?php echo $form->textField($model,'business_phone_2',array('maxlength'=>255,'style'=>'width:210px;',)); ?>
		<?php echo $form->error($model,'business_phone_2'); ?>
	</div>
	<div class="row" style="float:left;">
		<div style="float:left"><?php echo $form->labelEx($model,'business_fax',array('style'=>'font-weight:normal')); ?></div>
		<div>&nbsp;</div>
		<?php echo $form->textField($model,'business_fax',array('maxlength'=>255,'style'=>'width:210px;',)); ?>
		<?php echo $form->error($model,'business_fax'); ?>
	</div>
	
			
	
	

	<div class="clear"></div>
	<div class="row" style="float:left;width:240px;">
		<div style="float:left"><?php echo $form->labelEx($model,'assistants_name',array('style'=>'font-weight:normal')); ?></div>
		<div>&nbsp;</div>
		<?php echo $form->textField($model,'assistants_name',array('maxlength'=>255,'style'=>'width:210px;',));?>
		<?php echo $form->error($model,'assistants_name'); ?>
	</div>
	<div class="row" style="float:left;width:240px;">
		<div style="float:left"><?php echo $form->labelEx($model,'assistants_phone',array('style'=>'font-weight:normal')); ?></div>
		<div>&nbsp;</div>
		<?php echo $form->textField($model,'assistants_phone',array('maxlength'=>255,'style'=>'width:210px;',));?>
		<?php echo $form->error($model,'assistants_phone'); ?>
	</div>
	
	<div class="row" style="float:left;">
		<div style="float:left"><?php echo $form->labelEx($model,'managers_name',array('style'=>'font-weight:normal')); ?></div>
		<div>&nbsp;</div>
		<?php echo $form->textField($model,'managers_name',array('maxlength'=>255,'style'=>'width:210px;',)); ?>
		<?php echo $form->error($model,'managers_name'); ?>
	</div>
	
	
	
	<!---------------- others ---------------->
	<div class="clear"></div>
	<div class="row" style="float:left;font-weight:bold;font-size:18px;"><br/>Other Info</div>
	<div class="clear"></div>
			
	<div class="clear"></div>
	<div class="row" style="float:left;width:240px;">
		<div style="float:left"><?php echo $form->labelEx($model,'other_street_1',array('style'=>'font-weight:normal')); ?></div>
		<div>&nbsp;</div>
		<?php echo $form->textField($model,'other_street_1',array('maxlength'=>255,'style'=>'width:210px;',));?>
		<?php echo $form->error($model,'other_street_1'); ?>
	</div>
	<div class="row" style="float:left;width:237px;">
		<div style="float:left"><?php echo $form->labelEx($model,'other_street_2',array('style'=>'font-weight:normal')); ?></div>
		<div>&nbsp;</div>
		<?php echo $form->textField($model,'other_street_2',array('maxlength'=>255,'style'=>'width:210px;',)); ?>
		<?php echo $form->error($model,'other_street_2'); ?>
	</div>
	<div class="row" style="float:left;">
		<div style="float:left"><?php echo $form->labelEx($model,'other_street_3',array('style'=>'font-weight:normal')); ?></div>
		<div>&nbsp;</div>
		<?php echo $form->textField($model,'other_street_3',array('maxlength'=>255,'style'=>'width:210px;',)); ?>
		<?php echo $form->error($model,'other_street_3'); ?>
	</div>
	
	<div class="clear"></div>
	<div class="row" style="float:left;width:240px;">
		<div style="float:left"><?php echo $form->labelEx($model,'other_address_po_box',array('style'=>'font-weight:normal')); ?></div>
		<div>&nbsp;</div>
		<?php echo $form->textField($model,'other_address_po_box',array('maxlength'=>255,'style'=>'width:210px;',));?>
		<?php echo $form->error($model,'other_address_po_box'); ?>
	</div>
	
	<div class="clear"></div>
	<div class="row" style="float:left;width:240px;">
		<div style="float:left"><?php echo $form->labelEx($model,'other_city',array('style'=>'font-weight:normal')); ?></div>
		<div>&nbsp;</div>
		<?php echo $form->textField($model,'other_city',array('maxlength'=>255,'style'=>'width:210px;',));?>
		<?php echo $form->error($model,'other_city'); ?>
	</div>
	<div class="row" style="float:left;width:237px;">
		<div style="float:left"><?php echo $form->labelEx($model,'other_state',array('style'=>'font-weight:normal')); ?></div>
		<div>&nbsp;</div>
		<?php echo $form->textField($model,'other_state',array('maxlength'=>255,'style'=>'width:210px;',)); ?>
		<?php echo $form->error($model,'other_state'); ?>
	</div>
	<div class="row" style="float:left;">
		<div style="float:left"><?php echo $form->labelEx($model,'other_postal_code',array('style'=>'font-weight:normal')); ?></div>
		<div>&nbsp;</div>
		<?php echo $form->textField($model,'other_postal_code',array('maxlength'=>255,'style'=>'width:210px;',)); ?>
		<?php echo $form->error($model,'other_postal_code'); ?>
	</div>
	
	
	<div class="clear"></div>
	<div class="row" style="float:left;width:237px;">
		<div style="float:left"><?php echo $form->labelEx($model,'other_country_region',array('style'=>'font-weight:normal')); ?></div>
		<div>&nbsp;</div>
		<?php echo $form->textField($model,'other_country_region',array('maxlength'=>255,'style'=>'width:210px;',)); ?>
		<?php echo $form->error($model,'other_country_region'); ?>
	</div>
	
	<div class="clear"></div>
	<div class="row" style="float:left;width:240px;">
		<div style="float:left"><?php echo $form->labelEx($model,'other_phone',array('style'=>'font-weight:normal')); ?></div>
		<div>&nbsp;</div>
		<?php echo $form->textField($model,'other_phone',array('maxlength'=>255,'style'=>'width:210px;',));?>
		<?php echo $form->error($model,'other_phone'); ?>
	</div>
	<div class="row" style="float:left;width:237px;">
		<div style="float:left"><?php echo $form->labelEx($model,'other_fax',array('style'=>'font-weight:normal')); ?></div>
		<div>&nbsp;</div>
		<?php echo $form->textField($model,'other_fax',array('maxlength'=>255,'style'=>'width:210px;',)); ?>
		<?php echo $form->error($model,'other_fax'); ?>
	</div>
	
	
	<div class="clear"></div>
	<div style=""><?php echo CHtml::imageButton('/images/save.png'); ?></div>
<?php $this->endWidget(); ?>	
</div><!-- form -->
	
<script>
$(function() {
	$( "#Prospects_birthday" ).click(function(){WdatePicker({dateFmt: 'yyyy-MM-dd' });});
});
</script>