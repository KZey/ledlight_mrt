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
	<?php echo $form->errorSummary($model); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'To a client'); ?>
		<?php echo $form->textField($model,'to_uid'); ?>
		<?php echo $form->error($model,'to_uid'); ?>
		<input type="button" id="reset" name="reset" value="reset" />
		<?php echo CHtml::hiddenField('hidden_to_uid',$hidden_to_uid); ?>
		<br/>Tips: input some words of your contact .
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>47,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'content'); ?>
		<?php echo $form->textArea($model,'content',array('rows'=>6, 'cols'=>40)); ?>
		<?php echo $form->error($model,'content'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Send' : 'Save'); ?>
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
					// custom minLength
					var term = extractLast( this.value );
					if ( term.length < 1 ) {
						return false;
					}
				},
				focus: function() {
					// prevent value inserted on focus
					return false;
				},
				select: function( event, ui ) {
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
</div><!-- form -->