<script type="text/javascript" rel="stylesheet" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.scrollto.js"></script>
<div style="border:0px solid red;width:950px;overflow:hidden;">

	<div class="menu_div">
		<div id="menu_dashboard" style="float:left;" class="menu_li_selected"><?php if(Yii::app()->user->type==1){?><img src="/images/menu_profile.png" /><?php }else{?><img src="/images/menu_dashboard.png" /><?php }?></div>
		<div id="menu_property" style="float:left;" class="menu_li_default"><img src="/images/menu_property.png" /></div>
		<div id="menu_realtor" style="float:left;" class="menu_li_default"><img src="/images/menu_realtor.png" /></div>
	</div>
	<div style="border:0px solid red;width:100%;overflow:hidden;margin:0 auto;margin-top:3px;z-index:1;">
		<div style="float: left;background:#ccccff;width:950px;height:100px;">
			<div style="float:left;padding:2px;">
				<img src="<?php echo '/upload/user_logo/'.$model->logo?>" width=90 height=90 style="border:3px solid #fff;"  />
			</div>
			<div style="float:left;padding:5px;">
				<span style="font-size:18px;font-weight:bold;"><?php echo $model->first_name.' '.$model->last_name;;?></span><br/>
				<div style="margin-top: 5px;"><span style="font-weight:bold;">Email:</span> <?php echo $model->email;?></div>
				<div style="margin-top: 5px;"><span style="font-weight:bold;">Mobile:</span> <?php echo $model->mobile;?></div>
				<div style="margin-top: 5px;"><span style="font-weight:bold;">Location:</span> <?php echo $model->city;?> <?php echo $model->state;?></div>
			</div>
			
			<div style="float: right;background:#99cccc;width:150px;height:100px;">
				<div style="margin: 10px 0px 0px 10px;color:#fff;cursor:pointer;">
					<img src="/images/mail_icon.png" border=0  />
					<a href="/inbox/detail/?uid=<?php echo $model->uid;?>">Send a Message</a>
				</div>
			</div>
		</div>
		<div class="clear"></div>
		<div style="float: left;border:0px solid red;overflow:hidden;width:100%">
			
			<div style="float: left;border:0px solid red;overflow:hidden;width:720px;">
				 <div style="float: left;width:700px;margin:10px 0 0 0;">
					 <?php if($check_repeat != 1){?>
					 	<div id="r_index" class="button_favorite_1">Favorites</div>
					 	<div style="float: left;width:585px;height:30px;padding-top:8px;border-bottom:1px solid #cccccc;"></div>
					 <?php }else{?>	
						<div id="cotherview_1" class="button_favorite_1">Favorites</div>
						<div id="cotherview_2"  class="button_favorite_2">Expenses</div>
						<div id="cotherview_3"  class="button_favorite_2">Notes</div>
						<div style="float: left;width:230px;height:30px;padding-top:9px;border-bottom:1px solid #cccccc;"></div>
					<?php }?>	
				</div>
				
				
				
				
				<div id="list_cotherview_1" style="float: left;width:100%;">
						<?php $this->widget('zii.widgets.CListView', array(
							'dataProvider'=>$dataProvider_favorites,
							'itemView'=>'_favoritelist',
							'sortableAttributes'=>array('price'=>'Price','lot_size'=>'Lot Size','pool'=>'Pool','house_size'=>'House Size'),
							'pagerCssClass'=>'inbox_pager',
							'template'=>"{sorter}\n{items}\n {pager}",
							'pager'=>array(
									'header'=>'',
							),
						)); ?>
				</div>
				
				
				
				
				<div id="list_cotherview_2" style="float: left;width:100%;display:none;">
				<?php $this->widget('zii.widgets.grid.CGridView', array(
						'dataProvider'=>$dataProvider_expenses,
// 						'htmlOptions ' => array('style'=>'width:100%'),
						'cssFile' => false,
						'columns'=>array(
									array(
											'selectableRows' => 2,
											'footer' => '<button type="button" onclick="GetCheckboxExpense();" style="width:76px;">delete</button>',
											'class' => 'CCheckBoxColumn',
// 											'headerHtmlOptions' => array('width'=>'33px'),
											'checkBoxHtmlOptions' => array('name' => 'selectdel_expense[]','style'=>'margin-left:33px;'),
									),
array('name'=>'advertising ($)','type'=>'raw','value'=>'number_format(intval($data->advertising))'),
array('name'=>'gas ($)','type'=>'raw','value'=>'number_format(intval($data->gas))'),
array('name'=>'meals ($)','type'=>'raw','value'=>'number_format(intval($data->meals))'),
array('name'=>'others ($)','type'=>'raw','value'=>'number_format(intval($data->others))'),
array('name'=>'add_date','type'=>'raw','value'=>'$data->add_date','htmlOptions'=>array('style'=>'width:140px;')),
array(
		'header'=>'Action',
		'class'=>'CButtonColumn',
// 		'htmlOptions' =>array("width"=>80),
		'template'=>'{update}',
		'buttons'=>array(
				'update'=>array(
						'label'=>'Edit',
						'url'=>'"javascript:setExpense($data->id,\'$data->advertising\',\'$data->gas\',\'$data->meals\',\'$data->others\',\'$data->add_date\');"',
						'imageUrl'=>false,
				),
		)),
								),
						'pagerCssClass'=>'inbox_pager',
						'template'=>'{items}{summary}{pager}',
						'pager'=>array('header'=>'',),
					)); ?>
					
				</div>
				
				
				
				
				
				<div id="list_cotherview_3" style="float: left;width:100%;display:none;">
						<?php $this->widget('zii.widgets.grid.CGridView', array(
						'dataProvider'=>$dataProvider_notes,
						'columns'=>array(
									array(
											'selectableRows' => 2,
											'footer' => '<button type="button" onclick="GetCheckboxNote();" style="width:76px;">delete</button>',
											'class' => 'CCheckBoxColumn',
// 											'headerHtmlOptions' => array('width'=>'33px'),
											'checkBoxHtmlOptions' => array('name' => 'selectdel_note[]','style'=>'margin-left:33px;'),
									),
									array('name'=>'note','type'=>'raw','value'=>'$data->note','htmlOptions'=>array('style'=>'word-wrap:break-word; word-break:break-all;')),
									array('name'=>'add_date','type'=>'raw','value'=>'$data->add_date','htmlOptions'=>array('style'=>'width:140px;')),
								),
						'pagerCssClass'=>'inbox_pager',
						'template'=>'{items}{summary}{pager}',
						'pager'=>array('header'=>'',),
					)); ?>
					
					
								<div class="form">
								<?php $form=$this->beginWidget('CActiveForm', array(
									'id'=>'client-notes-form',
									'enableAjaxValidation'=>false,
								)); ?>
									<div class="row">
										<?php echo $form->labelEx($modelClientNotes,'note'); ?>
										<?php echo $form->textArea($modelClientNotes,'note',array('rows'=>6, 'style'=>'width:99%')); ?>
										<?php echo $form->error($modelClientNotes,'note'); ?>
									</div>
									<div class="row buttons"><?php echo CHtml::imageButton('/images/save.png'); ?></div>
								<?php $this->endWidget(); ?>
								</div><!-- form -->


				</div>
			</div>
			<div style="float: right;border:0px solid red;width:210px;overflow:hidden;padding-top:10px;">
				<div style="border:1px solid #ffcccc;width:205px;padding-bottom:10px;overflow:hidden;">
					<div style="border:1px solid #ffcccc;background:#3399cc;width:100%;height:25px;color:#fff;font-weight:bold;padding-top:10px;padding-left:10px;">Contact Infomation</div>
					<div style="padding-top:10px;padding-left:10px;">
						<div style="float: left;font-weight:bold;">Email:</div> <div style="float: left;width:130px;word-wrap: break-word; word-break: normal;margin-left:5px;"><?php echo $model->email;?></div>
						<div class="clear"></div>
						<div style="float: left;font-weight:bold;margin-top:5px;">Mobile:</div> <div style="float: left;width:130px;word-wrap: break-word; word-break: normal;margin-left:5px;margin-top:5px;"><?php echo $model->mobile;?></div>
						<div class="clear"></div>
						<div style="float: left;font-weight:bold;margin-top:5px;">Location:</div> <div style="float: left;word-wrap: break-word; word-break: normal;margin-left:5px;margin-top:5px;"><?php echo $model->city;?> <?php echo $model->state;?></div>
					</div>
				</div>
				
				<?php echo $this->renderPartial('_clientExpenseForm', 
								array('modelClientExpense'=>$modelClientExpense,'realtor_uid'=>$realtor_uid,'client_uid'=>$client_uid,'expense_total'=>$expense_total
										,'check_repeat'=>$check_repeat,'modelContact'=>$modelContact
						)); ?>
						
						
				
			</div>
		</div>
		
	</div>
	
</div>

<script>
function setExpense(id,advertising,gas,meals,others,add_date)
{
	$("#ClientExpense_id").val(id);
	$("#ClientExpense_advertising").val(advertising);
	$("#ClientExpense_gas").val(gas);
	$("#ClientExpense_meals").val(meals);
	$("#ClientExpense_others").val(others);
	$("#ClientExpense_add_date").val(add_date);
	$("#button_expense").attr('src','/images/update_expense.png');
	$("#button_save").ScrollTo(800);
}


var GetCheckboxExpense = function (){
	var data=new Array();
	$("input:checkbox[name='selectdel_expense[]']").each(function ()
	{
		if($(this).attr("checked"))data.push($(this).val());
	});
	if(data.length > 0) 
	{
		$.post('<?php echo CHtml::normalizeUrl(array('/user/cexpensedelete/'));?>',{'selectdel_expense[]':data}, function (data) {
			//if (data == 1) 
				$.fn.yiiGridView.update('yw2');
		});
	}else{
		alert("Please select");
	}
}
var GetCheckboxNote = function (){
	var data=new Array();
	$("input:checkbox[name='selectdel_note[]']").each(function ()
	{
		if($(this).attr("checked"))data.push($(this).val());
	});
	if(data.length > 0) 
	{
		$.post('<?php echo CHtml::normalizeUrl(array('/user/cnotedelete/'));?>',{'selectdel_note[]':data}, function (data) {
			//if (data == 1) 
				$.fn.yiiGridView.update('yw4');
		});
	}else{
		alert("Please select");
	}
}
function cotherview_2_click()
{
	$("#cotherview_1").attr('class','button_favorite_2');
	$("#cotherview_2").attr('class','button_favorite_1');
	$("#cotherview_3").attr('class','button_favorite_2');
	$("#list_cotherview_1").hide();
	$("#list_cotherview_2").show();
	$("#list_cotherview_3").hide();
	setTimeout(function(){$("#yw2").attr('style','width:100%');},1000);
	
}
function cotherview_3_click()
{
	$("#cotherview_1").attr('class','button_favorite_2');
	$("#cotherview_2").attr('class','button_favorite_2');
	$("#cotherview_3").attr('class','button_favorite_1');
	$("#list_cotherview_1").hide();
	$("#list_cotherview_2").hide();
	$("#list_cotherview_3").show();
// 	setTimeout(function(){$("#yw2").attr('style','width:100%');},100);
}
$(function() {
	$("#cotherview_1").click(function(){
		$("#cotherview_1").attr('class','button_favorite_1');
		$("#cotherview_2").attr('class','button_favorite_2');
		$("#cotherview_3").attr('class','button_favorite_2');
		$("#list_cotherview_1").show();
		$("#list_cotherview_2").hide();
		$("#list_cotherview_3").hide();
	});
	$("#cotherview_2").click(function(){
		$("#cotherview_1").attr('class','button_favorite_2');
		$("#cotherview_2").attr('class','button_favorite_1');
		$("#cotherview_3").attr('class','button_favorite_2');
		$("#list_cotherview_1").hide();
		$("#list_cotherview_2").show();
		$("#list_cotherview_3").hide();
		$("#yw2").attr('style','width:100%');
	});
	$("#cotherview_3").click(function(){
		$("#cotherview_1").attr('class','button_favorite_2');
		$("#cotherview_2").attr('class','button_favorite_2');
		$("#cotherview_3").attr('class','button_favorite_1');
		$("#list_cotherview_1").hide();
		$("#list_cotherview_2").hide();
		$("#list_cotherview_3").show();
	});
});
</script>
<?php 
	if(Yii::app()->user->hasFlash('showExpenseList') && Yii::app()->user->getFlash('showExpenseList') == 1)echo '<script>cotherview_2_click();</script>';
	if(Yii::app()->user->hasFlash('showNoteList') && Yii::app()->user->getFlash('showNoteList') == 2)echo '<script>cotherview_3_click();</script>';
	
?>