<?php
$this->breadcrumbs=array(
	'Inboxes',
);

// $this->menu=array(
// 	array('label'=>'Create Inbox', 'url'=>array('create')),
// 	array('label'=>'Manage Inbox', 'url'=>array('admin')),
// );
?>
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
		<div id="menu_dashboard" style="float:left;" class="menu_li_selected"><?php if(Yii::app()->user->type==1){?><img src="/images/menu_profile.png" /><?php }else{?><img src="/images/menu_dashboard.png" /><?php }?></div>
		<div id="menu_property" style="float:left;" class="menu_li_default"><img src="/images/menu_property.png" /></div>
		<div id="menu_realtor" style="float:left;" class="menu_li_default"><img src="/images/menu_realtor.png" /></div>
	</div>
	<div style="border:0px solid red;width:100%;overflow:hidden;margin:0 auto;margin-top:3px;z-index:1;">
		<div style="float: left;width:98%;">
			<div style="float: left;width:150px;height:30px;text-align:center;font-weight:bold;font-size:16px;padding-top:8px;">
				Message Center
			</div>
		</div>
		<div style="float: left;width:98%;margin:10px;">
			<a href="/inbox">Back to all messages</a>
		</div>
		<div class="clear"></div>
		<div style="width:90%;margin-top:3px;margin:0 auto;border:0px solid red;">
			<?php echo $this->renderPartial('_send', array('model'=>$model,'hidden_to_uid'=>$hidden_to_uid)); ?>
		</div>
		<div class="clear"></div>
		<div style="width:90%;margin-top:3px;margin:0 auto;border:0px solid red;">
				<?php $this->widget('zii.widgets.CListView', array(
						'dataProvider'=>$dataProvider,
						'itemView'=>'_detailview',
						'pagerCssClass'=>'inbox_pager',
						'template'=>"{items}\n {pager}",
						'pager'=>array(
								'header'=>'',
						),
					)); ?>
		</div>
	</div>
</div>