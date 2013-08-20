
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
		
		<div style="width:90%;overflow:hidden;margin:0 auto;">
			My Broadcast List<br/><br/><br/>
<div style="width:97%;overflow:hidden;border:1px solid #CCCCff;color:gray;padding:10px;">
Use the links on this page to view Live Broadcasts from your Agent.<br/><br/>
NOTES: If there are no links displayed, then you do not have any Live Broadcast invitations.<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
If any of the links below do not display video, then that broadcast has already ended.
</div><br/><br/><br/>
<div class="clear"></div>
			<?php $this->widget('zii.widgets.CListView', array(
						'dataProvider'=>$dataProvider,
						'itemView'=>'_viewBroadcastlist',
						'pagerCssClass'=>'inbox_pager',
						'template'=>"{items}\n {pager}",
						'pager'=>array('header'=>'',),
						'emptyText'=>'There are currently no valid Live Broadcast invitations.',
					)); ?>
		
		</div>
	</div>
	
</div><br/><br/>
