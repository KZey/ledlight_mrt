<?php
$this->breadcrumbs=array(
	'My profile',
);
?>

<div style="border:0px solid red;width:950px;overflow:hidden;">

	<div class="menu_div">
		<div id="menu_dashboard" style="float:left;" class="menu_li_selected"><?php if(Yii::app()->user->type==1){?><img src="/images/menu_profile.png" /><?php }else{?><img src="/images/menu_dashboard.png" /><?php }?></div>
		<div id="menu_property" style="float:left;" class="menu_li_default"><img src="/images/menu_property.png" /></div>
		<div id="menu_realtor" style="float:left;" class="menu_li_default"><img src="/images/menu_realtor.png" /></div>
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
			<div style="float: right;background:#99cccc;width:150px;height:100px;display:none;">
				<div style="margin: 10px 0px 0px 10px;color:#fff;cursor:pointer;">
					<img src="/images/mail_icon.png" border=0  />
					<a href="/inbox/detail/?uid=<?php echo $model->uid;?>">Send a Message</a>
				</div>
			</div>
		</div>
		<div class="clear"></div>
		
		<div style="float: left;width:100%;border:0px solid red;overflow:hidden;background:#fff;">
			<div style="padding:10px;"><a href="/user/">Profile</a> > Edit Profile</div>
				<?php //echo $this->renderPartial('_c_updateform', array('model'=>$model)); ?>
 <?php session_destroy(); ?>
 <br/><b>Profile deleted</b><br/>

		</div>
		
	</div>
	
</div>
