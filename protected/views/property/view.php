<?php
$this->pageTitle=$model->title.'-'.'Property'.'-'.Yii::app()->name;
$arr_photos = '';
function getStrPhotos($logo,$photos,$width,$height)
{
	$str_photos = '';
	if(!empty($photos))
	{
		$arr_photos = explode(',', $photos);
		for($i=0;$i<count($arr_photos);$i++)
		{
			if(!empty($arr_photos[$i]))
			$str_photos .= '["/upload/property/'.$arr_photos[$i].'", "", "", "","'.$width.'","'.$height.'"],';
		}
		if(!empty($str_photos))$str_photos = substr($str_photos,0,strlen($str_photos)-1);
	}else{
		$str_photos = '["/upload/property/'.$logo.'", "", "", "","'.$width.'","'.$height.'"],';
	}
	return $str_photos;
}
$str_photos_1 = getStrPhotos($model->logo,$model->photos,330,250);
$str_photos_2 = getStrPhotos($model->logo,$model->photos,610,510);
?>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.0/jquery.min.js"></script>
<script type="text/javascript" src="/js/jquery.zxxbox.3.0.js"></script>
<script type="text/javascript" src="/js/jquery.PrintArea.js"></script>
<script type="text/javascript" src="/js/simplegallery.js"></script>
<script type="text/javascript" src="/js/jquery.yiiactiveform.js"></script>
<script type="text/javascript" src="/js/swfobject.js"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<style type="text/css">
#simplegallery1{
visibility: hidden;
border: 0px solid darkred;
margin:10px;
}
#simplegallery1 .gallerydesctext{
text-align: left;
padding: 2px 5px;
}
</style>
<script type="text/javascript">
var mygallery=new simpleGallery({
	wrapperid: "simplegallery1",
	dimensions: [310, 240],
	imagearray: [<?php echo $str_photos_1;?>],
	autoplay: [false, 2500, 2],
	persist: false,
	fadeduration: 500,
	oninit:function(){ //event that fires when gallery has initialized/ ready to run
		//Keyword "this": references current gallery instance (ie: try this.navigate("play/pause"))
	},
	onslide:function(curslide, i){ //event that fires after each slide is shown
		//Keyword "this": references current gallery instance
		//curslide: returns DOM reference to current slide's DIV (ie: try alert(curslide.innerHTML)
		//i: integer reflecting current image within collection being shown (0=1st image, 1=2nd etc)
	}
});
var mygallery2=new simpleGallery({
	wrapperid: "simplegallery2",
	dimensions: [600, 500],
	imagearray: [<?php echo $str_photos_2;?>],
	autoplay: [true, 2500, 2],
	persist: false,
	fadeduration: 500,
	oninit:function(){ //event that fires when gallery has initialized/ ready to run
		//Keyword "this": references current gallery instance (ie: try this.navigate("play/pause"))
	},
	onslide:function(curslide, i){ //event that fires after each slide is shown
		//Keyword "this": references current gallery instance
		//curslide: returns DOM reference to current slide's DIV (ie: try alert(curslide.innerHTML)
		//i: integer reflecting current image within collection being shown (0=1st image, 1=2nd etc)
	}
});


</script>
<div style="border:0px solid red;width:950px;overflow:hidden;">

	<div class="menu_div">
		<div id="menu_dashboard" style="float:left;" class="menu_li_default"><?php if(Yii::app()->user->type==1){?><img src="/images/menu_profile.png" /><?php }else{?><img src="/images/menu_dashboard.png" /><?php }?></div>
		<div id="menu_property" style="float:left;" class="menu_li_selected"><img src="/images/menu_property.png" /></div>
		<?php
		    if($userType == 2) {
		?>
			<div id="menu_realtor" style="float:left;" class="menu_li_default"><img src="/images/menu_realtor.png" /></div>
		<?
		     }
        ?> 	
</div>
<div style="border:0px solid red;width:100%;overflow:hidden;margin:0 auto;margin-top:3px;z-index:1;">

<!-- left start -->
<div style="float: left;border:0px solid red;overflow:hidden;width:680px;" id="printContent">
<!-- left-top start -->
<div style="float: left;overflow:hidden;width:680px;background:#f8f3f3;">
<div style="border-top:1px solid #ffcccc;padding:5px;border-left:1px solid #ffcccc;border-right:1px solid #ffcccc;background:#fff;font-weight:bold;font-size:16px;"><?php echo $model->title;?></div>
<div style="float: left;background:#fff;width:340px;border-left:1px solid #ffcccc;border-bottom:1px solid #ffcccc;">
<div id="simplegallery1" style="padding:5px;text-align:center;"></div>
</div>
<div style="float: left;border:0px solid #ffcccc;background:#fff;width:337px;height:270px;border-left:1px solid #ffcccc;border-bottom:1px solid #ffcccc;border-right:1px solid #ffcccc;">
<div style="padding:10px;font-weight:bold;color:#669900;width:90%;font-size:16px;">$ <?php echo number_format($model->price);?></div>
<div style="padding:0 10px 10px 10px;width:93%">
<ul style="list-style-type:none;width:100%">
<li style="float:left;width:40%;border-bottom:1px dotted #ffcccc;font-weight:bold;">Property Status</li>
	<li style="float:left;width:60%;border-bottom:1px dotted #ffcccc;">&nbsp;<?php 
switch($model->property_status)
{
	case 2:echo 'Short';break;
	case 3:echo 'New Construction';break;
	case 4:echo 'Recently Sold';break;
	case 5:echo 'Rental';break;
	case 6:echo 'Resale';break;
	default:echo 'Bank Owned';
}
?>
</li>
</ul>
</div>
<div class="clear"></div>
<div style="padding:10px;width:93%">
<ul style="list-style-type:none;width:100%">
<li style="float:left;width:40%;border-bottom:1px dotted #ffcccc;font-weight:bold;">Beds</li>
<li style="float:left;width:60%;border-bottom:1px dotted #ffcccc;">&nbsp;<?php echo $model->beds;?> beds</li>
</ul>
</div>
<div class="clear"></div>
<div style="padding:10px;width:93%;">
<ul style="list-style-type:none;width:100%">
<li style="float:left;width:40%;border-bottom:1px dotted #ffcccc;font-weight:bold;">Baths</li>
<li style="float:left;width:60%;border-bottom:1px dotted #ffcccc;">&nbsp;<?php echo $model->baths;?> baths</li>
</ul>
</div>
<div class="clear"></div>
<div style="padding:10px;width:93%">
<ul style="list-style-type:none;width:100%">
<li style="float:left;width:40%;border-bottom:1px dotted #ffcccc;font-weight:bold;">House Size</li>
<li style="float:left;width:60%;border-bottom:1px dotted #ffcccc;">&nbsp;<?php echo number_format($model->house_size);?> sq ft</li>
</ul>
</div>
<div class="clear"></div>
<div style="padding:10px;width:93%">
<ul style="list-style-type:none;width:100%">
<li style="float:left;width:40%;font-weight:bold;">Lot Size</li>
<li style="float:left;width:60%;">&nbsp;<?php echo number_format($model->lot_size);?> sq ft</li>
</ul>
</div>
<div style="padding:5px;">

<div style="border:0px solid red;margin:5px 0 0 5px;">
<img src="/images/blue_bg.png" border=0 />
<div><img src="/images/icon_print.png" border=0 />&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" id="print_listing">Print Listing</a></div>
<?php if($model->non_listing != 1){?>
	<?php if(Yii::app()->user->type == 1){?>
		<div style="margin-top:5px;"><img src="/images/icon_favorite.png" border=0 />&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" id="add_favorites">Add to Favorites</a></div>
			<?php }?>
			<!-- 
			<div style="margin-top:5px;"><img src="/images/icon_email.png" border=0 />&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" id="email_to_me">Email Listing</a></div>
			-->
			<?php }?>
			</div>

			<?php if($model->non_listing != 1){?>


				<div style="border:0px solid red;margin:5px 0 0 5px;">
					<img src="/images/blue_bg.png" border=0 /><br/>
					<a href="https://twitter.com/intent/tweet?text=Check out this property listing on MyRealTour.com: http://myrealtour.com/property/<?php echo $model->property_id;?>" class="twitter-share-button" count="none" data-lang="en">11111Twitter</a>
					<div class="fb-like" data-href="http://www.myrealtour.com/property/<?php echo $model->property_id;?>" data-width="450" data-show-faces="false" data-send="false"></div><!---facebook like button--->

					<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
					<div class="fb-like" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false"></div>
					</div>
					<?php }?>

					</div>

					</div>
					</div>
					<!-- left-top end -->
					<!-- left-bottom start -->
					<style>
					.selected_tab{
						border-top:1px solid #cccccc;border-left:1px solid #cccccc;border-right:1px solid #cccccc;
					}
.no_selected_tab{
background:#cccccc;border-top:1px solid #cccccc;border-left:1px solid #cccccc;border-right:1px solid #cccccc;color:#fff;
}
</style>
<div class="clear"></div>
<div style="margin-top:10px;">
<div style="float: left;width:100%;">
<div id="link_detail" class="selected_tab" style="float: left;width:224px;height:30px;text-align:center;font-weight:bold;font-size:16px;padding-top:8px;cursor:pointer;">
Details
</div>
<div id="link_photos" class="no_selected_tab" style="float: left;width:224px;margin-left:1px;height:30px;text-align:center;font-weight:bold;font-size:16px;padding-top:8px;cursor:pointer;">
Photo Gallery
</div>
<div id="link_videos" class="no_selected_tab" style="float: left;margin-left:1px;width:224px;height:30px;text-align:center;font-weight:bold;font-size:16px;padding-top:8px;cursor:pointer;">
Video Archive
</div>
<div style="float: left;width:100%;border-bottom:1px solid #cccccc;"></div>
</div>

<!-- detail start -->
<div id="div_detail" style="float: left;width:100%; padding:10px;">
<div style="float: left;width:100%;"><?php echo $model->desc;?></div>
<div class="clear"></div>
<div style="float: left;width:100%;margin-top:30px;">
<div style="float: left;width:100%;border-bottom:1px solid #ccccff;padding-bottom:5px;"><img src="/images/blue.png" border=0 />  General Information</div>
<div style="float: left;width:100%;padding:3px;border:0px solid red;">

<div style="float: left;width:45%;border:0px solid red;">
<ul>
<li class="property_detail_label"><?php echo CHtml::activeLabel($model,'ml_num',array('required'=>false));?></li>
<li class="property_detail_label_content"><?php echo $model->ml_num;?></li>
<div class="clear"></div>

<li class="property_detail_label"><?php echo CHtml::activeLabel($model,'update_date',array('required'=>false));?></li>
<li class="property_detail_label_content"><?php echo HelperSubstring::truncate_utf8_string($model->update_date,5,false);?></li>
<div class="clear"></div>

<li class="property_detail_label"><?php echo CHtml::activeLabel($model,'date',array('required'=>false));?></li>
<li class="property_detail_label_content"><?php echo HelperSubstring::truncate_utf8_string($model->date,5,false);?></li>
<div class="clear"></div>

<li class="property_detail_label"><?php echo CHtml::activeLabel($model,'price',array('required'=>false));?></li>
<li class="property_detail_label_content">$ <?php echo number_format($model->price);?></li>
<div class="clear"></div>


<li class="property_detail_label"><?php echo CHtml::activeLabel($model,'year_built',array('required'=>false));?></li>
<li class="property_detail_label_content"><?php echo $model->year_built;?></li>
<div class="clear"></div>

<li class="property_detail_label"><?php echo CHtml::activeLabel($model,'property_type',array('required'=>false));?></li>
<li class="property_detail_label_content">
	<?php 
switch($model->property_type)
{
	case 2:echo 'Condominium';break;
	case 3:echo 'Townhouse';break;
	case 4:echo 'Multi-dwelling';break;
	case 5:echo 'High-rise';break;
	case 6:echo 'Resale';break;
	default:echo 'SFH';
}
?>
</li>
<div class="clear"></div>

<li class="property_detail_label"><?php echo CHtml::activeLabel($model,'selling_status',array('required'=>false));?></li>
<li class="property_detail_label_content">
	<?php 
switch($model->selling_status)
{
	case 2:echo 'Sold';break;
	case 4:echo 'Expired';break;
	case 3:echo 'Pending Sale';break;
	default:echo 'Available';
}
?>
</li>
<div class="clear"></div>

<li class="property_detail_label"><?php echo CHtml::activeLabel($model,'property_status',array('required'=>false));?></li>
<li class="property_detail_label_content">
	<?php 
switch($model->property_status)
{
	case 2:echo 'Short';break;
	case 3:echo 'New Construction';break;
	case 4:echo 'Recently Sold';break;
	case 5:echo 'Rental';break;
	case 6:echo 'Resale';break;
	default:echo 'Bank Owned';
}
?>
</li>
<div class="clear"></div>

<li class="property_detail_label"><?php echo CHtml::activeLabel($model,'beds',array('required'=>false));?></li>
<li class="property_detail_label_content"><?php echo $model->beds;?> beds</li>
<div class="clear"></div>

<li class="property_detail_label"><?php echo CHtml::activeLabel($model,'baths',array('required'=>false));?></li>
<li class="property_detail_label_content"><?php echo $model->baths;?> baths</li>
<div class="clear"></div>

</li>
</ul>
</div>


<div style="float: left;width:45%;padding:5px;border-left:1px dotted #cccccc;margin-left:20px;">
<ul>


<li class="property_detail_label"><?php echo CHtml::activeLabel($model,'house_size',array('required'=>false));?></li>
<li class="property_detail_label_content"><?php echo number_format($model->house_size);?> sq ft</li>
<div class="clear"></div>

<li class="property_detail_label"><?php echo CHtml::activeLabel($model,'lot_size',array('required'=>false));?></li>
<li class="property_detail_label_content"><?php echo number_format($model->lot_size);?> sq ft</li>
<div class="clear"></div>

<li class="property_detail_label"><?php echo CHtml::activeLabel($model,'pool',array('required'=>false));?></li>
<li class="property_detail_label_content"><?php echo $model->pool == 1 ? 'YES' : 'NO';?></li>
<div class="clear"></div>


<li class="property_detail_label"><?php echo CHtml::activeLabel($model,'garage',array('required'=>false));?></li>
<li class="property_detail_label_content"><?php echo $model->garage;?></li>
<div class="clear"></div>

<li class="property_detail_label"><?php echo CHtml::activeLabel($model,'stories',array('required'=>false));?></li>
<li class="property_detail_label_content"><?php echo $model->stories;?></li>
<div class="clear"></div>

<li class="property_detail_label"><?php echo CHtml::activeLabel($model,'street',array('required'=>false));?></li>
<li class="property_detail_label_content"><?php echo $model->street;?></li>
<div class="clear"></div>

<li class="property_detail_label"><?php echo CHtml::activeLabel($model,'apt',array('required'=>false));?></li>
<li class="property_detail_label_content"><?php echo $model->apt;?> </li>
<div class="clear"></div>

<li class="property_detail_label"><?php echo CHtml::activeLabel($model,'city',array('required'=>false));?></li>
<li class="property_detail_label_content"><?php echo $model->city;?> </li>
<div class="clear"></div>

<li class="property_detail_label"><?php echo CHtml::activeLabel($model,'state',array('required'=>false));?></li>
<li class="property_detail_label_content"><?php echo $model->state;?> </li>
<div class="clear"></div>

<li class="property_detail_label"><?php echo CHtml::activeLabel($model,'zip',array('required'=>false));?></li>
<li class="property_detail_label_content"><?php echo $model->zip;?> </li>
<div class="clear"></div>

</ul>
</div>

</div>

</div>
</div>
<!-- detail end -->

<!-- photo start -->
<div id="div_photos" style="float: left;width:100%; padding:10px;display:none;">
<?php 
if(!empty($model->photos)){
	$arr_photos = explode(',', $model->photos);
	for($i=0;$i<count($arr_photos);$i++){
		if(!empty($arr_photos[$i])){
			?>
				<div style="width:30%;margin:10px;float:left;cursor:pointer;" onclick="show_box()">
				<img src="/upload/property/<?php echo $arr_photos[$i];?>" width=200 height=180 border=0
				style="padding:5px;border:1px solid #ffcccc;" />
				</div>
				<?php }}}?>
				<div id="simplegallery2" style="padding:5px;text-align:center;display:none;"></div>
				</div>

				<!-- photo end -->

				<!-- video start -->
				<div id="div_videos" style="float: left;width:100%; padding:10px;display:none;">
				<?php 
				if(!empty($model->videos)){
					$arr_videos = explode(',', $model->videos);
					for($i=0;$i<count($arr_videos);$i++){
						if(!empty($arr_videos[$i])){
							?>
								<div style="width:30%;margin:10px;float:left;cursor:pointer;" 
								onclick="show_video('<?php echo Yii::app()->request->hostInfo.'/upload/video/'.$arr_videos[$i];?>')">
								<img src="/images/video_default.png" width=200 height=180 border=0
								style="padding:5px;border:1px solid #ffcccc;" />
								</div>
								<?php }}}?>

								</div>
								<!-- video end -->

								</div>
								<!-- left-bottom end -->
								</div>	
								<!-- left end -->	
								<!-- right start -->	
								<div style="float: right;border:0px solid red;width:250px;margin-right:3px;">
								<div style="border:1px solid #ffcccc;width:100%;overflow:hidden;">
								<div style="background:#ffffff;height:70px;">
								<div style="width:55px;float:left;padding:10px;">
								<img src="<?php echo '/upload/user_logo/'.$modelUser->logo?>" width=50 height=50 />
								</div>
								<div style="float:left;padding:8px 5px;font-weight:bold;width:130px;">
								<p style="color:#99cccc;font-size:14px;">Posted by</p>
								<a href="/user/rotherview?uid=<?php echo $modelUser->uid;?>"><?php echo $modelUser->first_name.' '.$modelUser->last_name;?></a>
								</div>
								</div>
								<div style="background:#faf5f5;height:100%">
								<div style="padding:10px;">
								<ul style="list-style-type:none;width:100%">
								<li style="float:left;width:35%;font-weight:bold;">Office</li>
								<li style="float:left;width:65%;"><?php echo $modelUser->office;?></li>
								</ul>
								</div>
								<div style="padding:10px;">
								<ul style="list-style-type:none;width:100%">
								<li style="float:left;width:35%;font-weight:bold;">Mobile</li>
								<li style="float:left;width:65%;"><?php echo $modelUser->mobile;?></li>
								</ul>
								</div>
								<div style="padding:10px;">
								<ul style="list-style-type:none;width:100%">
								<li style="float:left;width:35%;font-weight:bold;">Fax</li>
								<li style="float:left;width:65%;"><?php echo $modelUser->fax;?></li>
								</ul>
								</div>
								<div style="padding:10px;">
								<ul style="list-style-type:none;width:100%">
								<li style="float:left;width:35%;font-weight:bold;">Brokerage</li>
								<li style="float:left;width:65%;"><?php echo $modelUser->broker;?></li>
								</ul>
								</div>
								<div class="clear"></div>
								<div style="padding:10px;margin-top:10px;border-top:1px dotted #ffcccc;">
								<a href="javascript:void(0);" id="send_email_button_property">Email Agent</a><br/>
								<a href="/user/rotherview?uid=<?php echo $modelUser->uid;?>">View Agent's Listings</a>
								</div>
								</div>
								</div>
								<div class="clear"></div>
								<?php if($model->non_listing != 1){?>
									<div style="border:1px solid #3399cc;width:100%;height:265px;overflow:hidden;margin-top:10px;">
										<div style="background:#3399cc;height:30px;color:#fff;font-weight:bold;">
										<div style="padding:5px;">
										Request more information
										</div>
										</div>

										<div class="form" style="width:90%;border:0px solid #ccccff;margin:0 auto;">
										<?php $form=$this->beginWidget('CActiveForm', array(
													'id'=>'inbox-form',
													'enableAjaxValidation'=>false,
													)); ?>
										<?php echo CHtml::hiddenField('hidden_to_uid',$modelUser->uid); ?>
										<div class="row">
										<input style="width:100%;height:20px;" name="uname" id="uname" type="text" maxlength="255" />
										</div>
										<div class="row">
										<?php echo $form->textField($modelInbox,'title',array('style'=>'width:225px;height:20px;')); ?>
										<?php echo $form->error($modelInbox,'title'); ?>
										</div>
										<div class="row">
										<?php echo $form->textArea($modelInbox,'content',array('rows'=>3, 'style'=>'width:225px')); ?>
										<?php echo $form->error($modelInbox,'content'); ?>
										</div>
										<div class="row buttons" style="float:left;border:0px solid red;height:25px;">
										<div style="float:left;"><?php echo CHtml::imageButton('/images/send.png',array('id'=>'sendMsgButton')); ?></div>

										<?php if(Yii::app()->user->type == 1){?>
											<div style="float:left;margin-top:7px;">&nbsp;&nbsp;<?php echo CHtml::checkBox('checkBox_property_id',false); ?></div>
												<div style="float:left;margin-top:7px;">&nbsp;Save to favorite</div>
												<?php }?>

												<?php echo CHtml::hiddenField('hidden_property_id',0); ?>
												<?php echo CHtml::hiddenField('property_id',$model->property_id); ?>
												</div>
												<?php $this->endWidget(); ?>

												<div class="clear"></div><br/>
												<?php if(Yii::app()->user->hasFlash('success')){
													echo '<div class="info_error" style="color:red">'.Yii::app()->user->getFlash('success').'</div>';
												}?>
									<?php if(Yii::app()->user->hasFlash('error')){
										echo '<div class="info_error" style="color:red">'.Yii::app()->user->getFlash('error').'</div>'; 
									}?>
									</div>
										</div>
										<?php }?>
										<div class="clear"></div>

										<div style="border:1px solid #3399cc;width:100%;height:240px;overflow:hidden;margin-top:10px;">
										<div style="background:#3399cc;height:30px;color:#fff;font-weight:bold;">
										<div style="padding:5px;">
										Listing Location
										</div>
										</div>
										<div class="form" id="map_canvas" style="width:100%;height:400px;border:0px solid #ccccff;margin:0 auto;">

										</div>
										</div>

										</div>
										<!-- right end -->		

										</div>
										</div>

										<div id="div_send_email" style='display:none;'>
										<div style='padding:10px;'>
										<!-- /**********send_email Start*************/ -->
										<div class="form">
										<?php $form=$this->beginWidget('CActiveForm', array(
													'id'=>'email-form',
													'enableAjaxValidation'=>false,
													'htmlOptions'=>array('enctype'=>'multipart/form-data',)
													)); ?>
										<div class="row" style="display:none;">
										<ul class="send_email_form_row">
										<li class="send_email_form_row_li_1"><?php echo $form->labelEx($modelEmail,'to_uid',array('style'=>'height:25px;padding-top:-3px;font-size:12px;')); ?></li>
										<li class="send_email_form_row_li_2">
										<?php echo $form->textField($modelEmail,'to_uid',array('value'=>$modelUser->uid,'maxlength'=>255,'class'=>'regirest_text')); ?>
										<a id="reset" href="javascript:void(0);">Reset</a>
										</li>
										<li class="send_email_form_row_li_3"><?php echo $form->error($modelEmail,'to_uid'); ?></li>
										</ul>
										</div>
										<?php echo CHtml::hiddenField('hidden_to_uid',$modelUser->uid);?>
										<input type="hidden" value="<?php echo $model->property_id;?>" name="Email[property_id]" id="Email_property_id" />
										<div class="row">
										<ul class="send_email_form_row">
										<li class="send_email_form_row_li_1"><?php echo $form->labelEx($modelEmail,'title',array('style'=>'height:25px;padding-top:-3px;font-size:12px;')); ?></li>
										<li class="send_email_form_row_li_2"><?php echo $form->textField($modelEmail,'title',array('size'=>40,'style'=>'width:390px;','maxlength'=>255,'class'=>'regirest_text')); ?></li>
										<li class="send_email_form_row_li_3"><?php echo $form->error($modelEmail,'title'); ?></li>
										</ul>
										</div>
										<div class="row">
										<ul class="send_email_form_row">
										<li class="send_email_form_row_li_1"><?php echo $form->labelEx($modelEmail,'contents',array('style'=>'height:25px;padding-top:-3px;font-size:12px;')); ?></li>
										<li class="send_email_form_row_li_2"><?php echo $form->textArea($modelEmail,'contents',array('rows'=>6, 'style'=>'width:390px;')); ?></li>
										<li class="send_email_form_row_li_3"><?php echo $form->error($modelEmail,'contents'); ?></li>
										</ul>
										</div>
										<div class="row" style="height:30px;">
										<div style="text-align:right;float:left;margin-top:10px;">
										<span style="cursor:pointer;" id="link_add_attachment" onclick='$("#div_add_attachment").show();'>Add Attachments</span>
										</div>
										<div  style="display:none;float:left;" id="div_add_attachment">&nbsp;
										<?php echo $form->fileField($modelEmail,'attachments',array('size'=>10,'maxlength'=>255,'class'=>'regirest_text')); ?>
										<span style="cursor:pointer;" id="link_del_attachment"> Delete</span>
										</div>
										<div style="text-align:right;float:right">
										<img src='/images/loading_1.gif' id="loading_img" style="display:none;" />
										<?php echo CHtml::imageButton('/images/send.png',array('id'=>'submit_send_email'));?>
										</div>
										<?php echo $form->error($modelEmail,'attachments');?>
										</div>
										<?php $this->endWidget(); ?>	


										</div><!-- form -->
										<!-- /**********send_email End*************/ -->
										</div></div>

										<?php if(Yii::app()->user->hasFlash('successSendemail'))echo '<script>alert("'.Yii::app()->user->getFlash('successSendemail').'");</script>'; ?>
										<?php if(Yii::app()->user->hasFlash('errorSendemail'))echo '<script>alert("'.Yii::app()->user->getFlash('errorSendemail').'");</script>'; ?>

										<?php if(Yii::app()->user->hasFlash('success')){echo '<script>alert("'.Yii::app()->user->getFlash('success').'");</script>';}?>
										<?php if(Yii::app()->user->hasFlash('error')){echo '<div class="info_error" style="color:red">'.Yii::app()->user->getFlash('error').'</div>'; }?>

										<div id="div_video_id" style="display:none;background:#000000;"></div>

										<script>
										var geocoder;
										var map;
										var query = "<?php echo $model->address;?>";
										var display = "";

										function initialize() {
											geocoder = new google.maps.Geocoder();
											var myOptions = {
zoom: 17,
	  mapTypeId: google.maps.MapTypeId.ROADMAP
											}
											map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
											codeAddress();
										}

function codeAddress() {
	var address = query;
	geocoder.geocode({
			'address': address
			}, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
			map.setCenter(results[0].geometry.location);
			var marker = new google.maps.Marker({
map: map,
position: results[0].geometry.location
});
			var infowindow = new google.maps.InfoWindow({
				// content: "<b></b>" + address + "<br>" + display
				});
			infowindow.open(map, marker);
			} else {
			//alert("error:" + status);
			}
			});
}

$(function() {
		$("#link_del_attachment").click(function(){
			$("#div_add_attachment").hide();
			$("#Email_attachments").val('');
			});
		$("#submit_send_email").click(function(){
			$("#submit_send_email").hide();
			$("#loading_img").show();
			});
		$("#menu_dashboard").click(function(){
			location.href="/user";
			});
		$("#menu_property").click(function(){
			location.href="/property";
			});
		$("#menu_realtor").click(function(){
			location.href="/user/rlist";
			});

		if(query != '')initialize();
		$("#link_add_attachment").click(function(){
			$("#div_add_attachment").show();
			});
		$("#send_email_button_property").click(function(){
				$("#div_send_email").zxxbox({title:'Send New Email To This Agent',drag:true,width:500});
				var pageTitle = getTitle();
				var pageUrl = '<?php echo Yii::app()->request->hostInfo.Yii::app()->request->url;?>';
				$("#Email_title").val(pageTitle);
				$("#Email_contents").val(pageUrl);
				});
		$("#email_to_me").click(function(){
				$("#div_send_email").zxxbox({title:'Send New Email To ME',drag:true,width:500});
				$("#hidden_to_uid").val(<?php echo Yii::app()->user->id;?>);
				var pageTitle = 'MRT Property Title: ' + getTitle();
				var pageUrl = '<?php echo Yii::app()->request->hostInfo.Yii::app()->request->url;?>';
				$("#Email_title").val(pageTitle);
				$("#Email_contents").val(pageUrl);
				});

		$("#link_detail").click(function(){
				$("#link_detail").attr("class","selected_tab");
				$("#link_photos").attr("class","no_selected_tab");
				$("#link_videos").attr("class","no_selected_tab");
				$("#div_detail").show();
				$("#div_photos").hide();
				$("#div_videos").hide();
				});
		$("#link_photos").click(function(){
				$("#link_detail").attr("class","no_selected_tab");
				$("#link_photos").attr("class","selected_tab");
				$("#link_videos").attr("class","no_selected_tab");
				$("#div_photos").show();
				$("#div_detail").hide();
				$("#div_videos").hide();
				});
		$("#link_videos").click(function(){
				$("#link_detail").attr("class","no_selected_tab");
				$("#link_photos").attr("class","no_selected_tab");
				$("#link_videos").attr("class","selected_tab");
				$("#div_detail").hide();
				$("#div_photos").hide();
				$("#div_videos").show();
				});

		initInput('uname','Name');
		initInput('Inbox_title','Phone');
		initInput('Inbox_content','Enter your message here');

		$("#sendMsgButton").click(function(){
				if($("#Inbox_title").val() == 'Phone' && $("#Inbox_content").val() == 'Enter your message here')
				{
				$("#Inbox_title").val('');
				$("#Inbox_content").val('');
				}
				});
		$("#checkBox_property_id").click(function(){
				if($("#checkBox_property_id").is(':checked') == true)
				{
				$("#hidden_property_id").val(1);
				}else{
				$("#hidden_property_id").val(0);
				}
				});
		$("#add_favorites").click(function(){
				$.get("/property/Addfavorite", {Action:"get",property_id:<?php echo $model->property_id;?>}, 
					function (data, textStatus){
					alert(data);
					});
				});
		$("#print_listing").click(function(){
				$("#printContent").printArea(); 
				});
});
function show_box()
{
	$("#simplegallery2").zxxbox({title:'Photo Gallery',drag:true,width:615}); 
}
function show_video(flv_url)
{
	var so = new SWFObject('/js/flvplayer.swf','div_video_id','600','500','7');
	so.addParam("allowfullscreen","true");
	so.addVariable("file",flv_url);
	so.write('div_video_id');
	$("#div_video_id").zxxbox({title:'Property Video',drag:true,width:600}); 
}
</script>

<div id="fb-root"></div>
<script>
(function(d, s, id) {
 var js, fjs = d.getElementsByTagName(s)[0];
 if (d.getElementById(id)) return;
 js = d.createElement(s); js.id = id;
 js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1&appId=403927466287238";
 fjs.parentNode.insertBefore(js, fjs);
 }(document, 'script', 'facebook-jssdk'));
</script>


