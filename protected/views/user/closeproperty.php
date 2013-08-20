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
		<div id="menu_dashboard" style="float:left;" class="menu_li_selected"><?php if(Yii::app()->user->type==1){?><img src="/images/menu_profile.png" /><?php }else{?><img src="/images/menu_dashboard.png" /><?php }?></div>
		<div id="menu_property" style="float:left;" class="menu_li_default"><img src="/images/menu_property.png" /></div>
		<div id="menu_realtor" style="float:left;" class="menu_li_default"><img src="/images/menu_realtor.png" /></div>
	</div>
	<div style="border:0px solid red;width:100%;overflow:hidden;margin:0 auto;margin-top:3px;z-index:1;">
		<?php echo $this->renderPartial('_Rleft', array('model'=>$model,'modelEmail'=>$modelEmail,'hidden_to_uid'=>$hidden_to_uid)); ?>
		<div style="float: right;border:1px solid #C2C2C2;width:75%;overflow:hidden;">
			<div style="padding:5px 0 7px 10px;width:100%;border-bottom:1px solid #C2C2C2;background-image:url(/images/createproperty_title_bg.png);">
				<img src="/images/closed_title.png" />
			</div>
			<div style="float: right;border:0px solid red;overflow:hidden;padding:15px;width:96%;background:#F7F7F7;">
					<?php echo $this->renderPartial('_closeProperty', array('modelProperty'=>$modelProperty)); ?>
			</div>
		</div>
	</div>
	
</div>
<script>
$(function() {

	$("#r_index").click(function(){
		location.href="/user/rindex";
	});
	$("#r_contact").click(function(){
		location.href="/user/rcontact";
	});
	
});
</script>