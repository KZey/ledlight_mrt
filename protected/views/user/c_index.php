
<div style="border:0px solid red;width:950px;overflow:hidden;">

	<div class="menu_div">
		<div id="menu_dashboard" style="float:left;" class="menu_li_selected"><?php if(Yii::app()->user->type==1){?><img src="/images/menu_profile.png" /><?php }else{?><img src="/images/menu_dashboard.png" /><?php }?></div>
		<div id="menu_property" style="float:left;" class="menu_li_default"><img src="/images/menu_property.png" /></div>
		<div id="menu_realtor" style="float:left;" class="menu_li_default"><!--<img src="/images/menu_realtor.png" />--></div>
	</div>
	<div style="border:0px solid red;width:100%;overflow:hidden;margin:0 auto;margin-top:3px;z-index:1;">
		<div style="float: left;background:#ccccff;width:950px;height:100px;">
			<div style="float:left;padding:2px;">
				<img src="<?php echo '/upload/user_logo/'.$model->logo?>" width=90 height=90 style="border:3px solid #fff;"  />
			</div>
			<div style="float:left;padding:10px;">
				<span style="font-size:18px;font-weight:bold;"><?php echo $model->first_name.' '.$model->last_name;;?></span><br/>
				<div style="margin-top: 5px;"><span style="font-weight:bold;">Email:</span> <?php echo $model->email;?></div>
				<div style="margin-top: 5px;"><span style="font-weight:bold;">Mobile:</span> <?php echo $model->mobile;?></div>
				<div style="margin-top: 5px;"><span style="font-weight:bold;">Location:</span> <?php echo $model->city;?> <?php echo $model->state;?></div>
			</div>
			
			<div style="float: right;width:150px;height:100px;">
				<div style="margin: 10px 0px 0px 10px;color:#fff;cursor:pointer;">
					<a href="/user/cupdate">Edit Profile</a>
				</div>
			</div>
		</div>
		<div class="clear"></div>
		<div style="float: left;border:0px solid red;overflow:hidden;width:100%">
			<div style="float: left;border:0px solid red;overflow:hidden;width:700px;padding-top:10px;">
				<div style="float: left;width:99%;">
					<div id="button_favorite" class="button_favorite_1">
						Favorite
					</div>
					<div id="button_share"  class="button_share_2">
						Other Listings
					</div>
					<div style="float: right;width:390px;margin-left:10px;border-bottom:1px solid #cccccc;"></div>
				</div>
				<div id="div_favorite" style="float: left;width:99%;margin-top:3px;">
					<?php $this->widget('zii.widgets.CListView', array(
						'dataProvider'=>$dataProvider,
						'itemView'=>'_favoritelist',
						'sortableAttributes'=>array('price'=>'Price','lot_size'=>'Lot Size','pool'=>'Pool','house_size'=>'House Size'),
						'pagerCssClass'=>'inbox_pager',
						'template'=>"{sorter}\n{items}\n {pager}",
						'pager'=>array(
								'header'=>'',
						),
					)); ?>
				</div>
				
				<div id="div_share" style="display:none;float: left;width:99%;margin-top:3px;">
					<?php $this->widget('zii.widgets.CListView', array(
						'dataProvider'=>$dataProviderShare,
						'itemView'=>'_clientsharelist',
						'sortableAttributes'=>array('price'=>'Price','lot_size'=>'Lot Size','pool'=>'Pool','house_size'=>'House Size'),
						'pagerCssClass'=>'inbox_pager',
						'template'=>"{sorter}\n{items}\n {pager}",
						'pager'=>array(
								'header'=>'',
						),
					)); ?>
				</div>
				
			</div>
		
			<div style="float: right;border:0px solid red;width:240px;overflow:hidden;padding-top:10px;padding-right:5px;">
				<div style="border:1px solid #ffcccc;background:#faf5f5;width:240px;height:150px;overflow:hidden;">
					<div style="border:1px solid #ffcccc;background:#3399cc;width:100%;height:25px;color:#fff;font-weight:bold;padding-top:10px;padding-left:10px;">Contact Information</div>
					<div style="padding-top:10px;padding-left:10px;">
						<span style="font-weight:bold;">Email:</span> <?php echo $model->email;?><br/><br/>
						<span style="font-weight:bold;">Location:</span> <?php echo $model->city;?> <?php echo $model->state;?><br/><br/>
						<span style="font-weight:bold;">Mobile:</span> <?php echo $model->mobile;?><br/>
					</div>
				</div>
			</div>
		</div>
		
	</div>
	
</div>

<script>
$(function() {
	$("#button_favorite").click(function(){
		$("#div_favorite").show();
		$("#div_share").hide();
		$("#button_favorite").attr('class','button_favorite_1');
		$("#button_share").attr('class','button_share_2');
	});
	$("#button_share").click(function(){
		$("#div_share").show();
		$("#div_favorite").hide();
		$("#button_favorite").attr('class','button_favorite_2');
		$("#button_share").attr('class','button_share_1');
	});
});
</script>
