<?php
$this->pageTitle=$model->first_name.' '.$model->last_name.'-'.'Agent'.'-'.Yii::app()->name;
?>
<div style="border:0px solid red;width:950px;overflow:hidden;background:#fff;">

	<div class="menu_div">
		<div id="menu_dashboard" style="float:left;" class="menu_li_default"><?php if(Yii::app()->user->type==1){?><img src="/images/menu_profile.png" /><?php }else{?><img src="/images/menu_dashboard.png" /><?php }?></div>
		<div id="menu_property" style="float:left;" class="menu_li_default"><img src="/images/menu_property.png" /></div>
		<div id="menu_realtor" style="float:left;" class="menu_li_selected"><img src="/images/menu_realtor.png" /></div>
	</div>
	<div style="border:0px solid red;width:100%;overflow:hidden;margin:0 auto;margin-top:3px;z-index:1;padding-left:15px;padding-top:15px;">
		<div style="float: left;border:0px solid red;width:48%;">
			<div style="float:left;width:165px;background:#fff;">
				<img src="<?php echo '/upload/user_logo/'.$model->logo?>" width=150 height=150 style="border:1px solid gray;" />
			</div>
			<div style="float:left;padding:5px;width:270px;border:0px solid red;">
				<span style="font-size:18px;font-weight:bold;"><?php echo $model->first_name.' '.$model->last_name;?></span><br/>
				<div style="float:left;margin-top: 5px;width:75px;color:#336699">Brokerage:</div>
				<div style="float:left;margin-top: 5px;"><?php echo $model->broker;?></div>
				<div class="clear"></div>
				
				<div style="float:left;margin-top: 5px;width:60px;color:#336699">Team:</div>
				<div style="float:left;margin-top: 5px;"><?php echo $model->team;?></div>
				<div class="clear"></div>
				
				<div style="float:left;margin-top: 5px;width:60px;color:#336699">Office:</div>
				<div style="float:left;margin-top: 5px;"><?php echo $model->office;?></div>
				<div class="clear"></div>
				
				<div style="float:left;margin-top: 5px;width:60px;color:#336699">Fax:</div>
				<div style="float:left;margin-top: 5px;"><?php echo $model->fax;?></div>
				<div class="clear"></div>
				
				<div style="float:left;margin-top: 5px;width:60px;color:#336699">Email:</div>
				<div style="float:left;margin-top: 5px;"><?php echo $model->email;?></div>
			</div>
			
			<div class="clear"></div>
			<div style="margin-top: 0px;">
				
				<div style="float:left;height:30px;margin-top: 15px;">
				
<?php //if(!empty($model->facebook_uname)){?>
<div style="float:left;">
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div class="fb-like" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false"></div>
</div>
<?php //}?>
<?php if(!empty($model->twitter_uname)){?>
<div style="float:left;">&nbsp;
<a href="https://twitter.com/<?php echo $model->twitter_uname;?>" class="twitter-follow-button" data-show-screen-name="false" data-lang="en">Follow @<?php echo $model->twitter_uname;?></a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
</div>
<?php }?>		

				</div>
				<div class="clear"></div>
				<div style="float:left;margin-top:5px;">
					<?php 
// 						if($check_repeat==0 && Yii::app()->user->id != $model->uid){
						if(Yii::app()->user->id != $model->uid){
					?>
						<?php $form=$this->beginWidget('CActiveForm', array(
							'id'=>'contact-form',
							'enableAjaxValidation'=>true,
						)); ?>
							<?php echo $form->hiddenField($modelContact,'uid_parent'); ?>
							<?php echo $form->hiddenField($modelContact,'uid_child'); ?>
							<div class="row buttons">
								<?php echo CHtml::imageButton('/images/connect_me.png'); ?>
							</div>
							<?php 
								if(Yii::app()->user->hasFlash('successContact'))
									echo '<div class="info" style="color:red">'.Yii::app()->user->getFlash('successContact').'</div>';
							 	if(Yii::app()->user->hasFlash('errorContact'))
								echo '<div class="info_error" style="color:red">'.Yii::app()->user->getFlash('errorContact').'</div>'; 
							?>
						<?php $this->endWidget(); ?>
					<?php }?>



					<?php if($subscribe_show == 1){?>
						&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" id="subscribe_button" name="subscribe_button" /> Subscribe to newsletter
					<?php }?>
				</div>
				
			</div>
			
			<div class="clear"></div>
			<div style="margin-top: 20px;">
				<span style="font-weight:bold;">About Me</span><br/>
				<div style="margin-top:5px;"><?php echo $model->about;?></div>
			</div>
			<div class="clear"></div>
			<div style="border-bottom:1px solid #cccccc;margin:15px 0;"></div>
			<div style="overflow:hidden;border:0px solid red;">
				<div style="overflow:hidden;font-weight:bold;">Send This Agent A Message</div>
					<?php echo $this->renderPartial('_send', array('model'=>$modelInbox,'hidden_to_uid'=>$hidden_to_uid)); ?>
			</div>
			
		</div>
		
		<div style="float: left;border:0px solid red;overflow:hidden;width:48%;margin-left:10px;">
			<div style="font-weight:bold;margin-left:10px;font-size:18px;background:#fff;">
				<img src="/images/rotherview_title.png" />
			</div>
			<style>
				.sorterMrt{
					background:#fff;
					margin: 0 0 5px;text-align:right;padding-bottom:5px;
				}
				.list-view .sorterMrt {
				    font-size: 0.9em;
				}
				.list-view .sorterMrt ul {
				    display: inline;
				    list-style: none outside none;
				    margin: 0;
				    padding: 0;
				}
				.list-view .sorterMrt li {
				    display: inline;
				    margin: 0 0 0 5px;
				    padding: 0;
				}
				.list-view .sorterMrt a.asc {
				    background: url("up.gif") no-repeat scroll right center transparent;
				    padding-right: 10px;
				}
				.list-view .sorterMrt a.desc {
				    background: url("down.gif") no-repeat scroll right center transparent;
				    padding-right: 10px;
				}
				
		     </style>
			<div style="float: left;border:0px solid red;overflow:hidden;width:100%;background:#fff;">
				
				<?php $this->widget('zii.widgets.CListView', array(
						'dataProvider'=>$dataProvider,
						'itemView'=>'_rother_propertylist',
						'sortableAttributes'=>array('price','lot_size','pool','house_size'),
						'pagerCssClass'=>'inbox_pager',
						'sorterCssClass'=>'sorterMrt',
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
	var subscribe_status = <?php echo $subscribe_status;?>;
	if(subscribe_status == 1)$("#subscribe_button").attr("checked","true");
	$("#subscribe_button").click(function(){
		if($("#subscribe_button").attr("checked")){
			check_subscribe(1);//add
		}else{
			check_subscribe(0);//cancel
		}
	});
});
function check_subscribe(status)
{
	var realtor_uid = <?php echo $realtor_uid;?>;
	$.get("/user/newsletter", {Action:"get",realtor_uid:realtor_uid,status:status}, 
		function (data, textStatus){
			if(data == 3)alert("You can not subscribe yourself");
	});
}
</script>
