
<div style="border:0px solid red;width:950px;overflow:hidden;">

<?php if(!Yii::app()->user->isGuest){?>
	<div class="menu_div">
		<div id="menu_dashboard" style="float:left;" class="menu_li_default"><?php if(Yii::app()->user->type==1){?><img src="/images/menu_profile.png" /><?php }else{?><img src="/images/menu_dashboard.png" /><?php }?></div>
		<div id="menu_property" style="float:left;" class="menu_li_selected"><img src="/images/menu_property.png" /></div>
		<div id="menu_realtor" style="float:left;" class="menu_li_default"><img src="/images/menu_realtor.png" /></div>
	</div>
<?php }?>
	<div style="border:0px solid red;width:100%;overflow:hidden;margin:0 auto;margin-top:3px;z-index:1;">
		<div style="width:100%;margin:0 auto;">
			<div style="float:left;padding-top:10px;"><img src="/images/Property.png" /></div>
			<div style="float:right;padding-left:20px;cursor:pointer;" onclick="location.href='/property/propertysearch';"><img src="/images/button_search.png" /></div>
			
		<?php $this->widget('zii.widgets.CListView', array(
			'dataProvider'=>$dataProvider,
			'itemView'=>'_searchlist',
			'sortableAttributes'=>array('price','lot_size','pool','house_size'),
			'pagerCssClass'=>'inbox_pager',
				'sorterCssClass'=>'property_sort',
			'template'=>"{sorter}\n{items}\n {pager}",
			'pager'=>array(
					'header'=>'',
			),
		)); ?>
	</div></div>
</div>