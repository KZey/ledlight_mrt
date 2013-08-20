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
<?php if(!Yii::app()->user->isGuest){?>
	<div class="menu_div">
		<div id="menu_dashboard" style="float:left;" class="menu_li_default"><?php if(Yii::app()->user->type==1){?><img src="/images/menu_profile.png" /><?php }else{?><img src="/images/menu_dashboard.png" /><?php }?></div>
		<div id="menu_property" style="float:left;" class="menu_li_default"><img src="/images/menu_property.png" /></div>
		<div id="menu_realtor" style="float:left;" class="menu_li_selected"><img src="/images/menu_realtor.png" /></div>
	</div>
<?php }?>
	<div style="border:0px solid red;width:100%;overflow:hidden;margin:0 auto;margin-top:3px;z-index:1;">
		<div style="width:96%;margin:0 auto;"><img src="/images/realtor.png" /></div>
		<div style="float:right;padding-left:20px;padding-top:-70px;cursor:pointer;" onclick="location.href='/user/search';"><img src="/images/button_search.png" /></div>
		
		<div style="width:96%;margin:0 auto;">
				<?php 
				if(!empty($dataProvider))
				{
				$this->widget('zii.widgets.CListView', array(
						'dataProvider'=>$dataProvider,
						'itemView'=>'_rlistview',
						'sortableAttributes'=>array('first_name','last_name','city','broker'),
						'pagerCssClass'=>'inbox_pager',
'sorterCssClass'=>'property_sort',
						'template'=>"{sorter}\n{items}\n {pager}",
						'pager'=>array(
								'header'=>'',
						),
					)); 

				}
				?>
		</div>
	</div>
</div>