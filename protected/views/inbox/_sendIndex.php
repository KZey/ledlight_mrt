<?php 
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/jquery.js');
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/jquery.ui.core.js');
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/jquery.ui.widget.js');
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/jquery.ui.position.js');
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/datepicker/WdatePicker.js');
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/js/autocomplete/jquery.ui.autocomplete.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/jquery.ui.autocomplete.js');
?>
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'inbox-form',
	'enableAjaxValidation'=>true,
)); ?>
	<div class="row">
			<div style="float:left;text-align:right;width:100%;">
				<div style="float:left;text-align:right;width:10%;;">To</div>
				<div style="float:left;text-align:left;width:88%;margin-left:12px;">
					<?php echo $form->textField($modelInbox,'to_uid',array('style'=>'width:94%',
							'placeholder'=>'You can only send message to one contact at a time in the dropdown list'
							)); ?>
					<a href="javascript:" id="reset" name="reset">reset</a>
					<?php echo CHtml::hiddenField('hidden_to_uid',$hidden_to_uid); ?>&nbsp;&nbsp;
					
				</div>
			</div>
			<div class="clear"></div>
			<div style="float:left;text-align:right;width:100%;">
				<div style="float:left;text-align:right;width:10%;">Message</div>
				<div style="float:left;text-align:left;width:88%;margin-left:12px;">
					<?php echo $form->textArea($modelInbox,'content',array('rows'=>3, 'style'=>'width:100%;')); ?>
					<?php echo $form->error($modelInbox,'content'); ?>
				</div>
			</div>
	</div>
	
	<div class="row buttons" style="float:right;margin-right:5px;">
		<?php echo CHtml::imageButton('/images/send.png'); ?>
	</div>
	<?php $this->endWidget(); ?>

	<?php if(Yii::app()->user->hasFlash('success')){
// 		echo '<div class="info" style="color:red">'.Yii::app()->user->getFlash('success').'</div>'; 
		echo '<script>alert("'.Yii::app()->user->getFlash('success').'");</script>';
	}?>
		<?php if(Yii::app()->user->hasFlash('error')){
		echo '<div class="info_error" style="color:red">'.Yii::app()->user->getFlash('error').'</div>'; 
	}?>

<?php
/* Yii::app()->clientScript->registerScript(
   'myHideEffect',
   '$(".info").animate({opacity: 1.0}, 3000).fadeOut("slow");',
   CClientScript::POS_READY
); */
?>
<script>
	$(function() {
		$("#reset").click(function(){
			$("#hidden_to_uid").val('');
			$("#Inbox_to_uid").val('');
			$("#Inbox_to_uid").removeAttr("disabled");
		});
		function split( val ) {
			return val.split( /,\s*/ );
		}
		function extractLast( term ) {
			return split( term ).pop();
		}

		$( "#Inbox_to_uid" )
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
					if ( term.length < 1 ) {
						return false;
					}
				},
				focus: function() {
					return false;
				},
				select: function( event, ui ) {
					$("#Inbox_to_uid").attr("disabled","disabled");
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
</div>