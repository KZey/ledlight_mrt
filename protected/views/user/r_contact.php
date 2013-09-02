	<script type="text/javascript" rel="stylesheet" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.zxxbox.3.0.js"></script>
<style>
.inbox_pager {
	width:100%;
	height:30px;
    padding-top: 15px;
    text-align: center;
    clear:both;
}
</style>
<div style="border:0px solid red;width:950px;overflow:hidden;">
	<div class="menu_div">
		<div id="menu_dashboard" style="float:left;" class="menu_li_selected"><img src="/images/menu_dashboard.png" /></div>
		<div id="menu_property" style="float:left;" class="menu_li_default"><img src="/images/menu_property.png" /></div>
		<div id="menu_realtor" style="float:left;" class="menu_li_default"><img src="/images/menu_realtor.png" /></div>
	</div>
	
	<div style="border:0px solid red;width:100%;overflow:hidden;margin:0 auto;margin-top:3px;z-index:1;">
		<?php echo $this->renderPartial('_Rleft', array('model'=>$model,'modelEmail'=>$modelEmail,'hidden_to_uid'=>$hidden_to_uid)); ?>
		<div style="float: right;border:0px solid red;width:76%;overflow:hidden;margin:0 auto;padding-TOP:10px;">
			 <div style="float: left;width:98%;margin-left:10px;margin-bottom:15px;">
				<div id="r_index" class="rindex_right_list_2"><div><img src="/images/rindex_right_list_1.png" /></div></div>
				<div id="r_nonlisting" class="rindex_right_nonlisting_2"><div><img src="/images/rindex_right_nonlist_1.png" /></div></div>
				<div id="r_contact" class="rindex_right_contact_1"><div><img src="/images/rindex_right_agent_2.png" /></div></div>
				<div id="r_client" class="rindex_right_prospects_2"><div>    <img src="/images/rindex_right_client_1.png" /></div></div>
				<div id="r_prospects" class="rindex_right_prospects_2"><div><img src="/images/rindex_right_prospects_1.png" /></div></div>
				</div>
			<div id="r_index_content" style="float: left;width:98%;margin-left:10px;">
					<?php $this->widget('zii.widgets.CListView', array(
						'dataProvider'=>$dataProvider,
						'itemView'=>'_rcontactview',
						'sortableAttributes'=>array('first_name'=>'First Name','last_name'=>'Last Name','city'=>'City','broker'=>'Brokerage'),
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
<script>
$(function() {
	$("#r_index").click(function(){location.href="/user/rindex";});
	$("#r_contact").click(function(){location.href="/user/rcontact";});
	$("#r_nonlisting").click(function(){location.href="/user/rnonlisting";});
	$("#r_client").click(function(){location.href="/user/rclient";});
	$("#r_prospects").click(function(){location.href="/user/rprospects";});
});
</script>
