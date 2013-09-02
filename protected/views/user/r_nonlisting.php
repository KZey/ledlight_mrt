<script type="text/javascript" rel="stylesheet" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.zxxbox.3.0.js"></script>
<div style="border:0px solid red;width:950px;overflow:hidden;">
	<div class="menu_div">
		<div id="menu_dashboard" style="float:left;" class="menu_li_selected"><?php if(Yii::app()->user->type==1){?><img src="/images/menu_profile.png" /><?php }else{?><img src="/images/menu_dashboard.png" /><?php }?></div>
		<div id="menu_property" style="float:left;" class="menu_li_default"><img src="/images/menu_property.png" /></div>
		<div id="menu_realtor" style="float:left;" class="menu_li_default"><img src="/images/menu_realtor.png" /></div>
	</div>
	<div style="border:0px solid red;width:100%;overflow:hidden;margin:0 auto;margin-top:3px;z-index:1;">
		<?php echo $this->renderPartial('_Rleft', array('model'=>$model,'modelEmail'=>$modelEmail,'hidden_to_uid'=>$hidden_to_uid)); ?>
		<div style="float: right;border:0px solid red;width:76%;overflow:hidden;margin:0 auto;padding-TOP:10px;">
			 <div style="float: right;width:99%;margin-bottom:15px;">
				<div id="r_index" class="rindex_right_list_2"><div><img src="/images/rindex_right_list_1.png" /></div></div>
				<div id="r_nonlisting" class="rindex_right_nonlisting_1"><div><img src="/images/rindex_right_nonlist_2.png" /></div></div>
				<div id="r_contact" class="rindex_right_contact_2"><div><img src="/images/rindex_right_agent_1.png" /></div></div>
				<div id="r_client" class="rindex_right_prospects_2"><div>    <img src="/images/rindex_right_client_1.png" /></div></div>
				<div id="r_prospects" class="rindex_right_prospects_2"><div><img src="/images/rindex_right_prospects_1.png" /></div></div>
			</div>
			<div id="r_index_content" style="float: right;width:99%;">
					<?php $this->widget('zii.widgets.CListView', array(
						'dataProvider'=>$dataProvider,
						'itemView'=>'_rnonlisting',
						'sortableAttributes'=>array('price','lot_size','pool','house_size'),
						'pagerCssClass'=>'inbox_pager',
						'template'=>"{sorter}\n{items}\n {pager}",
						'pager'=>array(
								'header'=>'',
						),
					)); ?>
			</div>
		</div>
	</div>
</div>

<div id="div_share" style='display:none;'>
	<div style='padding:10px;'>
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ShareNonListing-form',
	'action'=>'/user/rnonlisting',
	'enableAjaxValidation'=>true,
));
?>
	<span id="span_checkbox"></span>
	
	<div class="clear"></div>
	<div class="row" style="height:30px;">
		<div style="text-align:right;float:right">
			<input type="hidden" id="ShareNonListing_property_id" name="ShareNonListing[property_id]"  />
			<?php echo CHtml::imageButton('/images/save.png');?>
		</div>
	</div>

</div>
	</div>
</div>
<?php $this->endWidget(); ?>
	<?php if(Yii::app()->user->hasFlash('successShared')){
		echo '<script>alert("'.Yii::app()->user->getFlash('successShared').'");</script>';
	}?>
	<?php if(Yii::app()->user->hasFlash('errorShared')){
		echo '<script>alert("'.Yii::app()->user->getFlash('errorShared').'");</script>';
	}?>
<script>
$(function() {
	$("#r_index").click(function(){location.href="/user/rindex";});
	$("#r_contact").click(function(){location.href="/user/rcontact";});
	$("#r_nonlisting").click(function(){location.href="/user/rnonlisting";});
	$("#r_client").click(function(){location.href="/user/rclient";});
	$("#r_prospects").click(function(){location.href="/user/rprospects";});
});

function shareproperty(property_id){
	$("#ShareNonListing_property_id").val(property_id);

	var span_checkbox_html = '';
		<?php 
			$num = count($client_list);
			for($i=0;$i<$num;$i++){
		?>
		span_checkbox_html = span_checkbox_html +  '<div style="border:1px solid #EEEEEE;float:left;width:30%;height:20px;margin:0 0 5px 5px;padding:3px;">';
		
			span_checkbox_html = span_checkbox_html +  '<input type="checkbox"  name="share_uid[]" value="<?php echo $client_list[$i]['uid'];?>" />&nbsp;';
		
		span_checkbox_html = span_checkbox_html + '<?php echo $client_list[$i]['first_name'].' '.$client_list[$i]['last_name'];?></div>';
		
		<?php }?>
	
	$("#span_checkbox").html(span_checkbox_html);
	$("#div_share").zxxbox({title:'Share Non-Listing to your clients',drag:true,width:750});
}
function closeproperty(property_id)
{
	$.get("/property/closeproperty", {Action:"get",property_id:property_id}, 
		function (data, textStatus){
		alert(data);
	});
}
function deleteproperty(property_id)
{
	$.get("/property/deleteproperty", {Action:"get",property_id:property_id}, 
		function (data, textStatus){
		location.href="/user";
	});
}
</script>
