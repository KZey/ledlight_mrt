<script type="text/javascript" rel="stylesheet" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.cookie.js"></script>
<div style="float: left;width:228px;border:0px solid red;background:#DEDEDE;">
	<div style="width:180px;height:160px;padding:15px;">
		<img src="<?php echo '/upload/user_logo/'.$model->logo?>" width=150 height=150 style="padding:8px;" />
	</div>
	<div class="clear"></div>
	<div style="font-size:15px;padding-left:15px;font-weight:bold;">
		<?php echo $model->first_name.' '.$model->last_name;;?>
	</div>
	<div class="clear"></div><div class="left_line"></div><div class="clear"></div>
	<div style="width:85%;height:50px;margin:0 auto;">
		<a href="/user/rupdate" style="text-decoration:underline">Edit Profile</a><br/><br/>
		<a href="/user/rotherview" style="text-decoration:underline">View Public Profile</a>
	</div>
	<div class="clear"></div>
	<div class="left_button_green" onclick='location.href="/user/createproperty"'><div>Add Listing</div></div>
	<div class="clear"></div>
	<div class="left_button_blue" onclick='location.href="/user/invite"'><div>Enroll A Client</div></div>
	<div class="clear"></div>
	<div class="left_button_blue" id='send_email_button'><div>Send Email</div></div>
	<div class="clear"></div>
	<div class="left_button_blue" id='group_email_button'><div>Group Email</div></div>
	<div class="clear"></div>
	<div class="left_button_blue" id='mycalendar_button'><div>My Calendar</div></div>
	<div class="clear"></div><div class="left_line"></div><div class="clear"></div>
	<div class="clear"></div>
	<div class="left_button_blue" id='analytic_email'><div>Email Analytics</div></div>
	<div class="clear"></div>
	<div class="left_button_blue" id='analytic_client'><div>Client Analytics</div></div>
	<div class="clear"></div>
	<div class="left_button_blue" id='analytic_listing'><div>Listing Analytics</div></div>
	

</div>
	<?php if(Yii::app()->user->hasFlash('successSendemail'))echo '<script>alert("'.Yii::app()->user->getFlash('successSendemail').'");</script>'; ?>
	<?php if(Yii::app()->user->hasFlash('errorSendemail'))echo '<script>alert("'.Yii::app()->user->getFlash('errorSendemail').'");</script>'; ?>	
	
<div id="div_send_email" style='display:none;'>
	<div style='padding:10px;'>
<!-- /**********send_email Start*************/ -->
<?php 
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/jquery.ui.core.js');
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/jquery.ui.widget.js');
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/jquery.ui.position.js');
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/js/autocomplete/jquery.ui.autocomplete.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/jquery.ui.autocomplete.js');
?>
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'email-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype'=>'multipart/form-data',)
)); ?>
	<div class="row">
		<ul class="send_email_form_row">
			<li class="send_email_form_row_li_1"><?php echo $form->labelEx($modelEmail,'to_uid',array('style'=>'height:25px;padding-top:-3px;font-size:12px;')); ?></li>
			<li class="send_email_form_row_li_2">
				<?php echo $form->textField($modelEmail,'to_uid',array('style'=>'width:300px;','maxlength'=>255,'class'=>'regirest_text',
						'placeholder'=>'Send email to one contact at a time')); ?>
				<a id="reset" href="javascript:void(0);">reset</a>
			</li>
			<li class="send_email_form_row_li_3"><?php echo $form->error($modelEmail,'to_uid'); ?></li>
		</ul>
	</div>
	<?php echo CHtml::hiddenField('hidden_to_uid',$hidden_to_uid);?>
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
					<span style="cursor:pointer;" id="link_add_attachment">Add Attachments</span>
				</div>
				<div  style="display:none;float:left;" id="div_add_attachment">&nbsp;
					<?php echo $form->fileField($modelEmail,'attachments',array('size'=>10,'maxlength'=>255,'class'=>'regirest_text')); ?>
					<span style="cursor:pointer;" id="link_del_attachment"> Delete</span>
				</div>
				<div style="text-align:right;float:right">
					<img src='/images/loading_1.gif' id="loading_img" style="display:none;" />
					<?php echo CHtml::imageButton('/images/send.png',array('id'=>'button_send_email'));?>
				</div>
			<?php echo $form->error($modelEmail,'attachments');?>
	</div>
<?php $this->endWidget(); ?>
	<?php if(Yii::app()->user->hasFlash('success')){
		echo '<script>alert("'.Yii::app()->user->getFlash('success').'");</script>';
	}?>
	<?php if(Yii::app()->user->hasFlash('error')){
		echo '<div class="info_error" style="color:red">'.Yii::app()->user->getFlash('error').'</div>'; 
	}?>

</div><!-- form -->
<!-- /**********send_email End*************/ -->
	</div>
</div>


				
<script>
$(function() {
	$("#link_del_attachment").click(function(){
		$("#div_add_attachment").hide();
		$("#Email_attachments").val('');
	});
	
	$("#button_send_email").click(function(){
		$("#button_send_email").hide();
		$("#loading_img").show();
	});
	
	$("#reset").click(function(){
		$("#hidden_to_uid").val('');
		$("#Email_to_uid").val('');
		$("#Email_to_uid").removeAttr("disabled");
	});
	
	$("#mycalendar_button").click(function(){
		location.href="/user/rcalendar";
	});
	$("#group_email_button").click(function(){
		location.href="/user/rgroupemail";
	});
	$("#link_add_attachment").click(function(){
		$("#div_add_attachment").show();
	});

	$("#analytic_email").click(function(){
		location.href="/statemail/rindex";
	});
	$("#analytic_client").click(function(){
		location.href="/statclient/rindex";
	});
	$("#analytic_listing").click(function(){
		location.href="/statlisting/rindex";
	});

	function split( val ) {return val.split( /,\s*/ );}
	function extractLast( term ) {return split( term ).pop();}
	$( "#Email_to_uid" )
		.bind( "keydown", function( event ) {
			if ( event.keyCode === $.ui.keyCode.TAB &&
					$( this ).data( "autocomplete" ).menu.active ) {
				event.preventDefault();
			}
		})
		.autocomplete({
			source: function( request, response ) {
				$.getJSON( "<?php echo $this->createUrl('contact/GetMyContactList');?>", {
					term: extractLast( request.term )
				}, response );
			},
			search: function() {
				var term = extractLast( this.value );
				if ( term.length < 1 ) {return false;}
			},
			focus: function() {return false;},
			select: function( event, ui ) {
				$("#Email_to_uid").attr("disabled","disabled");
				var terms = split( this.value );
				terms.pop();
				terms.push( ui.item.value );

				var hidden_invite_uids = $('#hidden_to_uid').val();
				hidden_invite_uids = split(hidden_invite_uids);
				hidden_invite_uids.pop();
				hidden_invite_uids.push( ui.item.id );
				hidden_invite_uids.push( "" );
				hidden_invite_uids = hidden_invite_uids.join( "" );
				$('#hidden_to_uid').val(hidden_invite_uids);
				
				terms.push( "" );
				this.value = terms.join( "" );
				return false;
			}
		});
});
</script>
						