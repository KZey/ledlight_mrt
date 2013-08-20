<script>
	$(function() {
		$( "#Calendar_start_time" ).click(function(){WdatePicker();});
		$( "#Calendar_end_time" ).click(function(){WdatePicker();});
		function split( val ) {
			return val.split( /,\s*/ );
		}
		function extractLast( term ) {
			return split( term ).pop();
		}
	});
	</script>
<div class="form" style="padding:10px;">
<?php
 $form=$this->beginWidget('CActiveForm', array(
	'id'=>'calendar-form',
	'action'=>'/calendar/create',
	'enableAjaxValidation'=>false,
)); ?>
	<div class="row">
		<?php echo $form->labelEx($modelCalendar,'start_time'); ?>
		<?php echo $form->textField($modelCalendar,'start_time',array('style'=>'width:200px;')); ?>
		<?php echo $form->error($modelCalendar,'start_time'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($modelCalendar,'end_time'); ?>
		<?php echo $form->textField($modelCalendar,'end_time',array('style'=>'width:200px;')); ?>
		<?php echo $form->error($modelCalendar,'end_time'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($modelCalendar,'invite_uid'); ?>
		<?php echo $form->textField($modelCalendar,'invite_uid',array('size'=>60,'style'=>'width:200px;', 'maxlength'=>255,'placeholder'=>'Input your contact name')); ?>
		<?php echo $form->error($modelCalendar,'invite_uid'); ?>
		<input type="button" id="reset" name="reset" value="reset" />
		
		<?php echo CHtml::hiddenField('hidden_invite_uid',$hidden_invite_uid); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($modelCalendar,'title');?>
		<?php echo $form->textField($modelCalendar,'title',array('style'=>'width:420px;','maxlength'=>255)); ?>
		<?php echo $form->error($modelCalendar,'title'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($modelCalendar,'content'); ?>
		<?php echo $form->textArea($modelCalendar,'content',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($modelCalendar,'content'); ?>
	</div>
	<div class="row buttons" style="text-align:right">
		<?php echo CHtml::submitButton($modelCalendar->isNewRecord ? 'Create' : 'Save'); ?>
	</div>
<?php $this->endWidget(); ?>
<script>
	$(function() {
		$("#reset").click(function(){
			$("#hidden_invite_uid").val('');
			$("#Calendar_invite_uid").val('');
		});
		function split( val ) {
			return val.split( /,\s*/ );
		}
		function extractLast( term ) {
			return split( term ).pop();
		}
		$( "#Calendar_invite_uid" )
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
					var terms = split( this.value );
					terms.pop();
					terms.push( ui.item.value );
					var hidden_invite_uids = $('#hidden_invite_uid').val();
					hidden_invite_uids = split(hidden_invite_uids);
					hidden_invite_uids.pop();
					hidden_invite_uids.push( ui.item.id );
					hidden_invite_uids.push( "" );
					hidden_invite_uids = hidden_invite_uids.join( "," );
					$('#hidden_invite_uid').val(hidden_invite_uids);
					
					terms.push( "" );
					this.value = terms.join( ", " );
					return false;
				}
			});
	});
	</script>
</div><!-- form -->