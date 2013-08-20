<?php
$this->breadcrumbs=array(
	'Prospects'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Prospects', 'url'=>array('index')),
	array('label'=>'Create Prospects', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('prospects-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Prospects</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'prospects-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'uid',
		'uid_parent',
		'type',
		'title',
		'first_name',
		'middle_name',
		/*
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
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
