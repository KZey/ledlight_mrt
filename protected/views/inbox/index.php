<div style="border:0px solid red;width:950px;overflow:hidden;">
	<div class="menu_div">
		<div id="menu_dashboard" style="float:left;" class="menu_li_selected"><?php if(Yii::app()->user->type==1){?><img src="/images/menu_profile.png" /><?php }else{?><img src="/images/menu_dashboard.png" /><?php }?></div>
		<div id="menu_property" style="float:left;" class="menu_li_default"><img src="/images/menu_property.png" /></div>
		<?php
		 if($userType == 2) {
		?>
		<div id="menu_realtor" style="float:left;" class="menu_li_default"><img src="/images/menu_realtor.png" /></div>
		<?php
		}
		?>
	</div>
	<div style="border:0px solid red;width:100%;overflow:hidden;margin:0 auto;margin-top:3px;z-index:1;">
		<div style="float: left;width:98%;">
			<div style="float: left;width:150px;height:30px;text-align:center;font-weight:bold;font-size:16px;padding-top:8px;">
				Message Center
			</div>
		</div>
		
		<!-- Begin: send msg -->
		<div class="clear"></div>
		<div style="width:99%;margin-top:3px;border:0px solid red;">
			<?php echo $this->renderPartial('_sendIndex', array('modelInbox'=>$modelInbox,'hidden_to_uid'=>$hidden_to_uid)); ?>
		</div>
		<!-- End: send msg -->
		
		<!-- Begin: msg list -->
		<div class="clear"></div>
		<div style="float: left;width:98%;margin-top:3px;">
				<?php $this->widget('zii.widgets.CListView', array(
						'dataProvider'=>$dataProvider,
						'itemView'=>'_view',
						'pagerCssClass'=>'inbox_pager',
						'template'=>"{items}\n {pager}",
						'pager'=>array(
								'header'=>'',
						),
					)); ?>
		</div>
		<!-- End: msg list -->
		
	</div>
</div>
<script>
function del_msg(uid){
	if(!confirm('Are you sure to do this？')) return false;
	$.post("inbox/del", { action: "post", uid: uid },
			function (data){location.reload();}, "json");
}
</script>
