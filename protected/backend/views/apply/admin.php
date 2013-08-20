<?php
$this->breadcrumbs=array(
	'Applies'=>array('index'),
	'Manage',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('apply-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<!--
<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>

</div> 

-->

<?php 
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'apply-grid',
	'dataProvider'=>$dataProvider,
	//'filter'=>$model,
	'columns'=>array(
array(
		'selectableRows' => 2,
		'footer' => '<button type="button" id="button_reject" onclick="GetCheckbox(1);" style="width:80px;">Reject</button><br/><br/>
					 <button type="button" id="button_agree" onclick="GetCheckbox(2);" style="width:80px;">Accept</button>',
		'class' => 'CCheckBoxColumn',
		'headerHtmlOptions' => array('width'=>'33px'),
		'checkBoxHtmlOptions' => array('name' => 'selectdel[]','style'=>'margin-left:33px;'),
),
		'id',
		'email',
		'first_name',
		'last_name',
		'state',
		'state_license',
		'add_date',
array(
		'name'=>'status','type'=>'raw','value'=>'Apply::itemAlias("status", "$data->status")','htmlOptions'=>array('style'=>'width:150px;word-wrap:break-word; word-break:break-all;'),
),
		/*
		'broker',
		'team',
		'about',
		'office',
		'city',
		'mobile',
		'forgetpwd',
		
		*/
		/* array(
			'class'=>'CButtonColumn',
		), */
	),
)); ?>
<img src="/images/loading_1.gif"  style="display:none;margin:10px;" id="div_loading" />
<script>
	var GetCheckbox = function (status){
		$("#div_loading").show();

		$("#button_reject").hide();
		$("#button_agree").hide();

		var data=new Array();
		$("input:checkbox[name='selectdel[]']").each(function ()
		{
			if($(this).attr("checked"))
			{
				data.push($(this).val());
			}
		});
		if(data.length > 0) 
		{
			$.post('<?php echo CHtml::normalizeUrl(array('/apply/verify/'));?>',{'selectdel[]':data,status:status}, function (data) {
				//if (data == 1) 
					$.fn.yiiGridView.update('apply-grid');
					$("#div_loading").hide();
			});
		}else{
			alert("Please select");
			window.location.reload();
		}
	}

</script>