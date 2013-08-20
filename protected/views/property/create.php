<div style="border:0px solid red;width:950px;overflow:hidden;">

	<div style="border:0px solid red;width:100%;height:40px;overflow:hidden;background:#067db9;color:#fff;font-weight:bold;">
		<div id="menu_dashboard" style="margin-left:10px;" class="menu_li_default"><?php if(Yii::app()->user->type==1)echo 'Profile';else echo 'Dashboard';?></div>
		<div id="menu_property" class="menu_li_default">Property</div>
		<div id="menu_realtor" class="menu_li_default">Realtor</div>
	</div>
	<div style="border:0px solid red;width:98%;overflow:hidden;padding:10px 5px;margin:0 auto;">
		
<h1>Create Property</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
	</div>
</div>
