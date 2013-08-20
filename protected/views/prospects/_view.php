<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('uid')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->uid), array('view', 'id'=>$data->uid)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('uid_parent')); ?>:</b>
	<?php echo CHtml::encode($data->uid_parent); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
	<?php echo CHtml::encode($data->type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('first_name')); ?>:</b>
	<?php echo CHtml::encode($data->first_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('middle_name')); ?>:</b>
	<?php echo CHtml::encode($data->middle_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('last_name')); ?>:</b>
	<?php echo CHtml::encode($data->last_name); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('suffix')); ?>:</b>
	<?php echo CHtml::encode($data->suffix); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email_1')); ?>:</b>
	<?php echo CHtml::encode($data->email_1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email_2')); ?>:</b>
	<?php echo CHtml::encode($data->email_2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email_3')); ?>:</b>
	<?php echo CHtml::encode($data->email_3); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mobile')); ?>:</b>
	<?php echo CHtml::encode($data->mobile); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('notes')); ?>:</b>
	<?php echo CHtml::encode($data->notes); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('profession')); ?>:</b>
	<?php echo CHtml::encode($data->profession); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('referred_buy')); ?>:</b>
	<?php echo CHtml::encode($data->referred_buy); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('birthday')); ?>:</b>
	<?php echo CHtml::encode($data->birthday); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('spouse')); ?>:</b>
	<?php echo CHtml::encode($data->spouse); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gender')); ?>:</b>
	<?php echo CHtml::encode($data->gender); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('home_street_1')); ?>:</b>
	<?php echo CHtml::encode($data->home_street_1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('home_street_2')); ?>:</b>
	<?php echo CHtml::encode($data->home_street_2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('home_street_3')); ?>:</b>
	<?php echo CHtml::encode($data->home_street_3); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('home_address_po_box')); ?>:</b>
	<?php echo CHtml::encode($data->home_address_po_box); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('home_city')); ?>:</b>
	<?php echo CHtml::encode($data->home_city); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('home_state')); ?>:</b>
	<?php echo CHtml::encode($data->home_state); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('home_postal_code')); ?>:</b>
	<?php echo CHtml::encode($data->home_postal_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('home_country_region')); ?>:</b>
	<?php echo CHtml::encode($data->home_country_region); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('home_phone_1')); ?>:</b>
	<?php echo CHtml::encode($data->home_phone_1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('home_phone_2')); ?>:</b>
	<?php echo CHtml::encode($data->home_phone_2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('home_fax')); ?>:</b>
	<?php echo CHtml::encode($data->home_fax); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('company')); ?>:</b>
	<?php echo CHtml::encode($data->company); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('department')); ?>:</b>
	<?php echo CHtml::encode($data->department); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('job_title')); ?>:</b>
	<?php echo CHtml::encode($data->job_title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('business_street_1')); ?>:</b>
	<?php echo CHtml::encode($data->business_street_1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('business_street_2')); ?>:</b>
	<?php echo CHtml::encode($data->business_street_2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('business_street_3')); ?>:</b>
	<?php echo CHtml::encode($data->business_street_3); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('business_address_po_box')); ?>:</b>
	<?php echo CHtml::encode($data->business_address_po_box); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('business_city')); ?>:</b>
	<?php echo CHtml::encode($data->business_city); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('business_state')); ?>:</b>
	<?php echo CHtml::encode($data->business_state); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('business_postal_code')); ?>:</b>
	<?php echo CHtml::encode($data->business_postal_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('business_country_region')); ?>:</b>
	<?php echo CHtml::encode($data->business_country_region); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('company_main_phone')); ?>:</b>
	<?php echo CHtml::encode($data->company_main_phone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('business_phone_1')); ?>:</b>
	<?php echo CHtml::encode($data->business_phone_1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('business_phone_2')); ?>:</b>
	<?php echo CHtml::encode($data->business_phone_2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('business_fax')); ?>:</b>
	<?php echo CHtml::encode($data->business_fax); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('web_page')); ?>:</b>
	<?php echo CHtml::encode($data->web_page); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('assistants_name')); ?>:</b>
	<?php echo CHtml::encode($data->assistants_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('assistants_phone')); ?>:</b>
	<?php echo CHtml::encode($data->assistants_phone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('managers_name')); ?>:</b>
	<?php echo CHtml::encode($data->managers_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('other_street_1')); ?>:</b>
	<?php echo CHtml::encode($data->other_street_1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('other_street_2')); ?>:</b>
	<?php echo CHtml::encode($data->other_street_2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('other_street_3')); ?>:</b>
	<?php echo CHtml::encode($data->other_street_3); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('other_address_po_box')); ?>:</b>
	<?php echo CHtml::encode($data->other_address_po_box); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('other_city')); ?>:</b>
	<?php echo CHtml::encode($data->other_city); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('other_state')); ?>:</b>
	<?php echo CHtml::encode($data->other_state); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('other_postal_code')); ?>:</b>
	<?php echo CHtml::encode($data->other_postal_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('other_country_region')); ?>:</b>
	<?php echo CHtml::encode($data->other_country_region); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('other_phone')); ?>:</b>
	<?php echo CHtml::encode($data->other_phone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('other_fax')); ?>:</b>
	<?php echo CHtml::encode($data->other_fax); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('isdn')); ?>:</b>
	<?php echo CHtml::encode($data->isdn); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('account')); ?>:</b>
	<?php echo CHtml::encode($data->account); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('anniversary')); ?>:</b>
	<?php echo CHtml::encode($data->anniversary); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('billing_information')); ?>:</b>
	<?php echo CHtml::encode($data->billing_information); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('callback')); ?>:</b>
	<?php echo CHtml::encode($data->callback); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('car_phone')); ?>:</b>
	<?php echo CHtml::encode($data->car_phone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('categories')); ?>:</b>
	<?php echo CHtml::encode($data->categories); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('children')); ?>:</b>
	<?php echo CHtml::encode($data->children); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('directory_server')); ?>:</b>
	<?php echo CHtml::encode($data->directory_server); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email_2_display_name')); ?>:</b>
	<?php echo CHtml::encode($data->email_2_display_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email_2_type')); ?>:</b>
	<?php echo CHtml::encode($data->email_2_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email_3_display_name')); ?>:</b>
	<?php echo CHtml::encode($data->email_3_display_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email_3_type')); ?>:</b>
	<?php echo CHtml::encode($data->email_3_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email_display_name')); ?>:</b>
	<?php echo CHtml::encode($data->email_display_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email_type')); ?>:</b>
	<?php echo CHtml::encode($data->email_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('government_id_number')); ?>:</b>
	<?php echo CHtml::encode($data->government_id_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hobby')); ?>:</b>
	<?php echo CHtml::encode($data->hobby); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pager')); ?>:</b>
	<?php echo CHtml::encode($data->pager); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('primary_phone')); ?>:</b>
	<?php echo CHtml::encode($data->primary_phone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('radio_phone')); ?>:</b>
	<?php echo CHtml::encode($data->radio_phone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('telex')); ?>:</b>
	<?php echo CHtml::encode($data->telex); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tty_tdd_phone')); ?>:</b>
	<?php echo CHtml::encode($data->tty_tdd_phone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('initials')); ?>:</b>
	<?php echo CHtml::encode($data->initials); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('internet_free_busy')); ?>:</b>
	<?php echo CHtml::encode($data->internet_free_busy); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('keywords')); ?>:</b>
	<?php echo CHtml::encode($data->keywords); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('language')); ?>:</b>
	<?php echo CHtml::encode($data->language); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('location')); ?>:</b>
	<?php echo CHtml::encode($data->location); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mileage')); ?>:</b>
	<?php echo CHtml::encode($data->mileage); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('office_location')); ?>:</b>
	<?php echo CHtml::encode($data->office_location); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('orgainization_id_number')); ?>:</b>
	<?php echo CHtml::encode($data->orgainization_id_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('priority')); ?>:</b>
	<?php echo CHtml::encode($data->priority); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('private')); ?>:</b>
	<?php echo CHtml::encode($data->private); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sensitivity')); ?>:</b>
	<?php echo CHtml::encode($data->sensitivity); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_1')); ?>:</b>
	<?php echo CHtml::encode($data->user_1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_2')); ?>:</b>
	<?php echo CHtml::encode($data->user_2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_3')); ?>:</b>
	<?php echo CHtml::encode($data->user_3); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_4')); ?>:</b>
	<?php echo CHtml::encode($data->user_4); ?>
	<br />

	*/ ?>

</div>