<?php
$this->breadcrumbs=array(
	'Prospects'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Prospects', 'url'=>array('index')),
	array('label'=>'Create Prospects', 'url'=>array('create')),
	array('label'=>'Update Prospects', 'url'=>array('update', 'id'=>$model->uid)),
	array('label'=>'Delete Prospects', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->uid),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Prospects', 'url'=>array('admin')),
);
?>

<h1>View Prospects #<?php echo $model->uid; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'uid',
		'uid_parent',
		'type',
		'title',
		'first_name',
		'middle_name',
		'last_name',
		'suffix',
		'email_1',
		'email_2',
		'email_3',
		'mobile',
		'notes',
		'profession',
		'referred_buy',
		'birthday',
		'spouse',
		'gender',
		'home_street_1',
		'home_street_2',
		'home_street_3',
		'home_address_po_box',
		'home_city',
		'home_state',
		'home_postal_code',
		'home_country_region',
		'home_phone_1',
		'home_phone_2',
		'home_fax',
		'company',
		'department',
		'job_title',
		'business_street_1',
		'business_street_2',
		'business_street_3',
		'business_address_po_box',
		'business_city',
		'business_state',
		'business_postal_code',
		'business_country_region',
		'company_main_phone',
		'business_phone_1',
		'business_phone_2',
		'business_fax',
		'web_page',
		'assistants_name',
		'assistants_phone',
		'managers_name',
		'other_street_1',
		'other_street_2',
		'other_street_3',
		'other_address_po_box',
		'other_city',
		'other_state',
		'other_postal_code',
		'other_country_region',
		'other_phone',
		'other_fax',
		'isdn',
		'account',
		'anniversary',
		'billing_information',
		'callback',
		'car_phone',
		'categories',
		'children',
		'directory_server',
		'email_2_display_name',
		'email_2_type',
		'email_3_display_name',
		'email_3_type',
		'email_display_name',
		'email_type',
		'government_id_number',
		'hobby',
		'pager',
		'primary_phone',
		'radio_phone',
		'telex',
		'tty_tdd_phone',
		'initials',
		'internet_free_busy',
		'keywords',
		'language',
		'location',
		'mileage',
		'office_location',
		'orgainization_id_number',
		'priority',
		'private',
		'sensitivity',
		'user_1',
		'user_2',
		'user_3',
		'user_4',
	),
)); ?>
