<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'prospects-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'uid_parent'); ?>
		<?php echo $form->textField($model,'uid_parent'); ?>
		<?php echo $form->error($model,'uid_parent'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo $form->textField($model,'type'); ?>
		<?php echo $form->error($model,'type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'first_name'); ?>
		<?php echo $form->textField($model,'first_name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'first_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'middle_name'); ?>
		<?php echo $form->textField($model,'middle_name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'middle_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'last_name'); ?>
		<?php echo $form->textField($model,'last_name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'last_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'suffix'); ?>
		<?php echo $form->textField($model,'suffix',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'suffix'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email_1'); ?>
		<?php echo $form->textField($model,'email_1',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'email_1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email_2'); ?>
		<?php echo $form->textField($model,'email_2',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'email_2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email_3'); ?>
		<?php echo $form->textField($model,'email_3',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'email_3'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mobile'); ?>
		<?php echo $form->textField($model,'mobile',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'mobile'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'notes'); ?>
		<?php echo $form->textArea($model,'notes',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'notes'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'profession'); ?>
		<?php echo $form->textField($model,'profession',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'profession'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'referred_buy'); ?>
		<?php echo $form->textField($model,'referred_buy',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'referred_buy'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'birthday'); ?>
		<?php echo $form->textField($model,'birthday',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'birthday'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'spouse'); ?>
		<?php echo $form->textField($model,'spouse',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'spouse'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'gender'); ?>
		<?php echo $form->textArea($model,'gender',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'gender'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'home_street_1'); ?>
		<?php echo $form->textField($model,'home_street_1',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'home_street_1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'home_street_2'); ?>
		<?php echo $form->textField($model,'home_street_2',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'home_street_2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'home_street_3'); ?>
		<?php echo $form->textField($model,'home_street_3',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'home_street_3'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'home_address_po_box'); ?>
		<?php echo $form->textField($model,'home_address_po_box',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'home_address_po_box'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'home_city'); ?>
		<?php echo $form->textField($model,'home_city',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'home_city'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'home_state'); ?>
		<?php echo $form->textField($model,'home_state',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'home_state'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'home_postal_code'); ?>
		<?php echo $form->textField($model,'home_postal_code',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'home_postal_code'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'home_country_region'); ?>
		<?php echo $form->textField($model,'home_country_region',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'home_country_region'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'home_phone_1'); ?>
		<?php echo $form->textField($model,'home_phone_1',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'home_phone_1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'home_phone_2'); ?>
		<?php echo $form->textField($model,'home_phone_2',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'home_phone_2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'home_fax'); ?>
		<?php echo $form->textField($model,'home_fax',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'home_fax'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'company'); ?>
		<?php echo $form->textField($model,'company',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'company'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'department'); ?>
		<?php echo $form->textField($model,'department',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'department'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'job_title'); ?>
		<?php echo $form->textField($model,'job_title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'job_title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'business_street_1'); ?>
		<?php echo $form->textField($model,'business_street_1',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'business_street_1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'business_street_2'); ?>
		<?php echo $form->textField($model,'business_street_2',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'business_street_2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'business_street_3'); ?>
		<?php echo $form->textField($model,'business_street_3',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'business_street_3'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'business_address_po_box'); ?>
		<?php echo $form->textField($model,'business_address_po_box',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'business_address_po_box'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'business_city'); ?>
		<?php echo $form->textField($model,'business_city',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'business_city'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'business_state'); ?>
		<?php echo $form->textField($model,'business_state',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'business_state'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'business_postal_code'); ?>
		<?php echo $form->textField($model,'business_postal_code',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'business_postal_code'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'business_country_region'); ?>
		<?php echo $form->textField($model,'business_country_region',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'business_country_region'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'company_main_phone'); ?>
		<?php echo $form->textField($model,'company_main_phone',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'company_main_phone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'business_phone_1'); ?>
		<?php echo $form->textField($model,'business_phone_1',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'business_phone_1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'business_phone_2'); ?>
		<?php echo $form->textField($model,'business_phone_2',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'business_phone_2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'business_fax'); ?>
		<?php echo $form->textField($model,'business_fax',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'business_fax'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'web_page'); ?>
		<?php echo $form->textField($model,'web_page',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'web_page'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'assistants_name'); ?>
		<?php echo $form->textField($model,'assistants_name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'assistants_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'assistants_phone'); ?>
		<?php echo $form->textField($model,'assistants_phone',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'assistants_phone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'managers_name'); ?>
		<?php echo $form->textField($model,'managers_name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'managers_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'other_street_1'); ?>
		<?php echo $form->textField($model,'other_street_1',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'other_street_1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'other_street_2'); ?>
		<?php echo $form->textField($model,'other_street_2',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'other_street_2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'other_street_3'); ?>
		<?php echo $form->textField($model,'other_street_3',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'other_street_3'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'other_address_po_box'); ?>
		<?php echo $form->textField($model,'other_address_po_box',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'other_address_po_box'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'other_city'); ?>
		<?php echo $form->textField($model,'other_city',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'other_city'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'other_state'); ?>
		<?php echo $form->textField($model,'other_state',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'other_state'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'other_postal_code'); ?>
		<?php echo $form->textField($model,'other_postal_code',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'other_postal_code'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'other_country_region'); ?>
		<?php echo $form->textField($model,'other_country_region',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'other_country_region'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'other_phone'); ?>
		<?php echo $form->textField($model,'other_phone',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'other_phone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'other_fax'); ?>
		<?php echo $form->textField($model,'other_fax',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'other_fax'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'isdn'); ?>
		<?php echo $form->textField($model,'isdn',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'isdn'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'account'); ?>
		<?php echo $form->textField($model,'account',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'account'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'anniversary'); ?>
		<?php echo $form->textField($model,'anniversary',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'anniversary'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'billing_information'); ?>
		<?php echo $form->textArea($model,'billing_information',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'billing_information'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'callback'); ?>
		<?php echo $form->textField($model,'callback',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'callback'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'car_phone'); ?>
		<?php echo $form->textField($model,'car_phone',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'car_phone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'categories'); ?>
		<?php echo $form->textField($model,'categories',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'categories'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'children'); ?>
		<?php echo $form->textField($model,'children',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'children'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'directory_server'); ?>
		<?php echo $form->textField($model,'directory_server',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'directory_server'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email_2_display_name'); ?>
		<?php echo $form->textField($model,'email_2_display_name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'email_2_display_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email_2_type'); ?>
		<?php echo $form->textField($model,'email_2_type',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'email_2_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email_3_display_name'); ?>
		<?php echo $form->textField($model,'email_3_display_name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'email_3_display_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email_3_type'); ?>
		<?php echo $form->textField($model,'email_3_type',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'email_3_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email_display_name'); ?>
		<?php echo $form->textField($model,'email_display_name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'email_display_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email_type'); ?>
		<?php echo $form->textField($model,'email_type',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'email_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'government_id_number'); ?>
		<?php echo $form->textField($model,'government_id_number',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'government_id_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'hobby'); ?>
		<?php echo $form->textField($model,'hobby',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'hobby'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pager'); ?>
		<?php echo $form->textField($model,'pager',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'pager'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'primary_phone'); ?>
		<?php echo $form->textField($model,'primary_phone',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'primary_phone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'radio_phone'); ?>
		<?php echo $form->textField($model,'radio_phone',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'radio_phone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'telex'); ?>
		<?php echo $form->textField($model,'telex',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'telex'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tty_tdd_phone'); ?>
		<?php echo $form->textField($model,'tty_tdd_phone',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'tty_tdd_phone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'initials'); ?>
		<?php echo $form->textField($model,'initials',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'initials'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'internet_free_busy'); ?>
		<?php echo $form->textField($model,'internet_free_busy',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'internet_free_busy'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'keywords'); ?>
		<?php echo $form->textArea($model,'keywords',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'keywords'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'language'); ?>
		<?php echo $form->textField($model,'language',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'language'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'location'); ?>
		<?php echo $form->textArea($model,'location',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'location'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mileage'); ?>
		<?php echo $form->textField($model,'mileage',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'mileage'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'office_location'); ?>
		<?php echo $form->textArea($model,'office_location',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'office_location'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'orgainization_id_number'); ?>
		<?php echo $form->textField($model,'orgainization_id_number',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'orgainization_id_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'priority'); ?>
		<?php echo $form->textField($model,'priority',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'priority'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'private'); ?>
		<?php echo $form->textField($model,'private',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'private'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sensitivity'); ?>
		<?php echo $form->textArea($model,'sensitivity',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'sensitivity'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_1'); ?>
		<?php echo $form->textField($model,'user_1',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'user_1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_2'); ?>
		<?php echo $form->textField($model,'user_2',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'user_2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_3'); ?>
		<?php echo $form->textField($model,'user_3',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'user_3'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_4'); ?>
		<?php echo $form->textField($model,'user_4',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'user_4'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->