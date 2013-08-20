
<div style="border:0px solid red;width:950px;overflow:hidden;">
	<div class="menu_div">
		<div id="menu_dashboard" style="float:left;" class="menu_li_selected"><img src="/images/menu_dashboard.png" /></div>
		<div id="menu_property" style="float:left;" class="menu_li_default"><img src="/images/menu_property.png" /></div>
		<div id="menu_realtor" style="float:left;" class="menu_li_default"><img src="/images/menu_realtor.png" /></div>
	</div>
	<div style="border:0px solid red;width:100%;overflow:hidden;margin:0 auto;margin-top:3px;z-index:1;">
		<?php echo $this->renderPartial('_Rleft', array('model'=>$model,'modelEmail'=>$modelEmailGroup,'hidden_to_uid'=>$hidden_to_uid
				)); ?>
		<div style="float: right;border:1px solid #C2C2C2;width:75%;overflow:hidden;">
			<div style="padding:5px 0 7px 10px;width:100%;border-bottom:1px solid #C2C2C2;background-image:url(/images/createproperty_title_bg.png);">
				<img src="/images/rgroupemail_title_text.png" />
			</div>
			<div style="float: right;border:0px solid red;overflow:hidden;padding:15px;width:96%;background:#F7F7F7;">
			
	
			<div id="r_index_content" style="float: left;width:100%;margin-left:10px;">
					<br/>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'email-form',
	'action'=>'/user/rgroupemailsubmit',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype'=>'multipart/form-data',)
)); ?>
<input type="hidden" id="newsletter_value" name="newsletter_value" />
					<!-------------- BEGIN: Newsletter ------------------>
					<div id="div_newsletter" style="float: left;width:100%;">
						<div style="float: left;width:155px;">&nbsp;</div>
						<div style="float: left;font-weight:bold;">
							<input type="radio" id="button_newsletter_1" name="button_newsletter" checked />
							This Is A Newsletter (All Subscribers Will Receive)
						</div>
					</div>
					<!-------------- END: Newsletter ------------------>
					
					<!-------------- BEGIN: type ------------------>
						<div id="div_type_1" style="float: left;width:100%;margin-top:10px;">
							<div style="float: left;width:155px;">&nbsp;</div>
							<div style="float: left;font-weight:bold;">
								<input type="radio" id="button_newsletter_3" name="button_newsletter"  />
								Group Email By Contact Types
							</div>
						</div>
						<div style="clear:both;height:10px;"></div>
						<div id="div_type_2" style="float: left;width:100%;display:none;">
							<div style="float: left;width:185px;">&nbsp;</div>
							<div style="float: left;width:200px;border:0px solid gray;">
								<div style="width:160px;height:25px;padding-top:5px;font-size:12px;">Contacts:&nbsp;</div>
								<div style=""><?php echo CHtml::checkBoxList('contact_type','',Prospects::itemAlias('Type')); ?></div>
							</div>
							<div style="float: left;width:200px;border:0px solid gray;">
								<div style="width:160px;height:25px;padding-top:5px;font-size:12px;">Prospects:&nbsp;</div>
								<div style=""><?php echo CHtml::checkBoxList('prospect_type','',Prospects::itemAlias('Type')); ?></div>
							</div>
							<div style="clear:both;height:10px;"></div>
						</div>
						<!-------------- END: type ------------------>
						
					<!-------------- BEGIN: search interest ------------------>
					<div id="div_search_1" style="float: left;width:100%;">
						<div style="float: left;width:155px;">&nbsp;</div>
						<div style="float: left;font-weight:bold;">
							<input type="radio" id="button_newsletter_2" name="button_newsletter"  />
							 Group Email By Multiple Criteria
						</div>
					</div>
					<div id="div_search_2" style="display:none;"> 
						<div style="clear:both;height:10px;"></div>
						<div style="float: left;width:100%;">
							<div style="float: left;width:160px;text-align:right;">State:&nbsp;</div>
							<div style="float: left;">
								<?php echo CHtml::dropDownList('state','',User::itemAlias('state'),array('style'=>'width:200px;','empty'=>'Please Select')); ?>
							</div>
						</div>
						<div style="clear:both;height:10px;"></div>
						<div style="float: left;width:100%;">
							<div style="float: left;width:160px;text-align:right;">City:&nbsp;</div>
							<div style="float: left;">
								<input type="text" id="city" name="city" style="width:200px" />
							</div>
						</div>
						<div style="clear:both;height:10px;"></div>
						<div style="float: left;width:100%;">
							<div style="float: left;width:160px;text-align:right;">Clients Interested In:&nbsp;</div>
							<div style="float: left;">
								Number Of Beds&nbsp;&nbsp;&nbsp;
								<input type="text" id ='beds_1'  value = '1' name="beds1"  style="width:30px"> - 
								<input type="text" id ='beds_1' name="beds2"  value = '2' style="width:30px">
                                <!--
								<input type="radio" id="beds_1" name="beds" value=1 checked /> 1&nbsp;&nbsp;
								<input type="radio" id="beds_2" name="beds" value=2  /> 2&nbsp;&nbsp;
								<input type="radio" id="beds_3" name="beds" value=3  /> 3&nbsp;&nbsp;
								<input type="radio" id="beds_4" name="beds" value=4  /> 4&nbsp;&nbsp;
								<input type="radio" id="beds_5" name="beds" value=5  /> 5+
								-->

							</div>
						</div>
						<div style="clear:both;height:10px;"></div>
						<div style="float: left;width:100%;">
							<div style="float: left;width:160px;text-align:right;">&nbsp;</div>
							<div style="float: left;">
								Number Of Baths&nbsp;&nbsp;
								<input type="text" id ='bath_1' name="bath1"  style="width:30px" value='1'> -
								<input type="text" id ='bath_2' name="bath2"  style="width:30px" value='2'>
								<!--
								<input type="radio" id="baths_1" name="baths" value=1 checked /> 1&nbsp;&nbsp;
								<input type="radio" id="baths_2" name="baths" value=2  /> 2&nbsp;&nbsp;
								<input type="radio" id="baths_3" name="baths" value=3  /> 3&nbsp;&nbsp;
								<input type="radio" id="baths_4" name="baths" value=4  /> 4&nbsp;&nbsp;
								<input type="radio" id="baths_5" name="baths" value=5  /> 5+
								-->
							</div>
						</div>
						<div style="clear:both;height:10px;"></div>
						<div style="float: left;width:100%;">
							<div style="float: left;width:160px;text-align:right;">&nbsp;</div>
							<div style="float: left;width:500px;">
								<div style="float: left;width:126px;">Price Range</div>
								<div style="float: left;width:320px;">
									<li style="float: left;width:150px;"><input type="radio" value=1 id="price_range_1" name="price_range" checked /> <100k</li>
									<li style="float: left;width:150px;"><input type="radio" id="price_range_2" name="price_range" value=2  /> 100k - 250k</li>
									<li style="float: left;width:150px;"><input type="radio" id="price_range_3" name="price_range" value=3  /> 251k - 400k</li>
									<li style="float: left;width:150px;"><input type="radio" id="price_range_4" name="price_range" value=4  /> 401k - 600k</li>
									<li style="float: left;width:150px;"><input type="radio" id="price_range_5" name="price_range" value=5  /> 601k - 800k</li>
									<li style="float: left;width:150px;"><input type="radio" id="price_range_6" name="price_range" value=6  /> 801k - 1M</li>
									<li style="float: left;width:150px;"><input type="radio" id="price_range_7" name="price_range" value=7  /> 1.1M - 1.25M</li>
									<li style="float: left;width:150px;"><input type="radio" id="price_range_8" name="price_range" value=8  /> 1.26M+</li>
								</div>	
							</div>
						</div>
					</div>
					<!-------------- END: search interest ------------------>
						
						
						
					
					<div style="clear:both;height:30px;"></div>
					<div style="float: left;width:100%;">
						<div style="float: left;width:160px;text-align:right;">
							<?php echo $form->labelEx($modelEmailGroup,'title',array('style'=>'height:25px;padding-top:5px;font-size:12px;')); ?>:&nbsp;
						</div>
						<div style="float: left;">
							<?php echo $form->textField($modelEmailGroup,'title',array('size'=>40,'style'=>'width:390px;','maxlength'=>255,'class'=>'regirest_text')); ?>
						</div>
					</div>
					<div style="clear:both;height:10px;"></div>
					<div style="float: left;width:100%;">
						<div style="float: left;width:160px;text-align:right;">
							<?php echo $form->labelEx($modelEmailGroup,'contents',array('style'=>'height:25px;padding-top:5px;font-size:12px;')); ?>:&nbsp;
						</div>
						<div style="float: left;">
							<?php echo $form->textArea($modelEmailGroup,'contents',array('rows'=>6, 'style'=>'width:390px;')); ?>
						</div>
					</div>
					<div style="clear:both;height:10px;"></div>
					<div style="float: left;width:100%;">
						<div style="float: left;width:160px;text-align:right;">&nbsp;</div>
						<div style="float: left;">
							<div style="text-align:right;float:left;margin-top:10px;">
								<span style="cursor:pointer;" id="group_link_add_attachment">Add Attachments</span>
							</div>
							<div  style="display:none;float:left;" id="group_div_add_attachment">&nbsp;
								<?php echo $form->fileField($modelEmailGroup,'attachments',array('size'=>10,'maxlength'=>255,'class'=>'regirest_text')); ?>
								<?php echo $form->error($modelEmailGroup,'attachments');?>
								<span style="cursor:pointer;" id="link_del_attachment" onclick='hide_attachments()'> Delete</span>
							</div>
						</div>
					</div>
				
					
							
					<div style="clear:both;height:10px;"></div>
					<div style="float: left;width:100%;">
						<div style="float: left;width:160px;text-align:right;">&nbsp;</div>
						<div style="float: left;">
							<img src='/images/loading_1.gif' id="loading_img_1" style="display:none;" />
							<?php echo CHtml::imageButton('/images/send.png',array('id'=>'button_send_groupemail'));?>
						</div>
					</div>
					<br/><br/><br/>
<?php $this->endWidget(); ?>
	<?php if(Yii::app()->user->hasFlash('successSendemailGroup')){
		echo '<script>alert("'.Yii::app()->user->getFlash('successSendemailGroup').'");</script>';
	}?>
	<?php if(Yii::app()->user->hasFlash('errorSendemailGroup')){
		echo '<script>alert("'.Yii::app()->user->getFlash('errorSendemailGroup').'");</script>'; 
	}?>

<!-- /**********send_email End*************/ -->
					
					
			</div>
		</div>
	</div>
	
</div>
<script>
	function hide_attachments()
	{
		$("#group_div_add_attachment").hide();$(":file").val('');
	}
$(function() {

	$("#button_send_groupemail").click(function(){
		$("#loading_img_1").show();
		$("#button_send_groupemail").hide();
	});
	$("#group_link_add_attachment").click(function(){
		$("#group_div_add_attachment").show();
	});
	$("#reset").click(function(){
		$("#hidden_to_uid").val('');
		$("#Email_to_uid").val('');
		$("#Email_to_uid").removeAttr("disabled");
	});
	
	$("#group_email_button").click(function(){
		location.href="/user/rgroupemail";
	});
	$("#link_add_attachment").click(function(){
		$("#div_add_attachment").show();
	});
	
	$("#r_index").click(function(){location.href="/user/rindex";});
	$("#r_contact").click(function(){location.href="/user/rcontact";});
	
	$("#newsletter_value").val(1);
	$("#button_newsletter_1").click(function(){
		$("#newsletter_value").val(1);
		$("#div_search_2").hide();
		$("#div_type_2").hide();
	});
	$("#button_newsletter_2").click(function(){
		$("#newsletter_value").val(2);
		$("#div_search_2").show();
		$("#div_type_2").hide();
	});
	$("#button_newsletter_3").click(function(){
		$("#newsletter_value").val(3);
		$("#div_search_2").hide();
		$("#div_type_2").show();
	});
});
</script>
