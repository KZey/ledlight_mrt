<?php 
	$start_time = $modelCalendar->start_time;
	$from = strtotime($start_time) === false ? '' : strtotime($start_time);
	if(!empty($from))
	{
		$from_date = date('Y-m-d',$from);
		$from_time = date('H:i:s',$from);
	}
	
	$end_time = $modelCalendar->end_time;
	
	$to = strtotime($end_time) === false ? '' : strtotime($end_time);
	if(!empty($to))
	{
		$to_date = date('Y-m-d',$to);
		$to_time = date('H:i:s',$to);
	}
?>
<script>
	$(function() {
		$( "#Calendar_start_date" ).click(function(){WdatePicker({dateFmt: 'yyyy-MM-dd' });});
		$( "#Calendar_start_time" ).click(function(){WdatePicker({dateFmt: 'HH:mm:ss' });});
		$( "#Calendar_end_date" ).click(function(){WdatePicker({dateFmt: 'yyyy-MM-dd' });});
		$( "#Calendar_end_time" ).click(function(){WdatePicker({dateFmt: 'HH:mm:ss' });});
		function split( val ) {
			return val.split( /,\s*/ );
		}
		function extractLast( term ) {
			return split( term ).pop();
		}

		var from_date = '<?php echo $from_date;?>';
		var from_time = '<?php echo $from_time;?>';
		var to_date = '<?php echo $to_date;?>';
		var to_time = '<?php  echo $to_time;?>';
		if(from_date != '')$( "#Calendar_start_date" ).val(from_date);
		if(from_time != '')$( "#Calendar_start_time" ).val(from_time);
		if(to_date != '')$( "#Calendar_end_date" ).val(to_date);
		if(to_time != '')$( "#Calendar_end_time" ).val(to_time);
	});
	</script>
<div class="form" style="padding:10px;">
<?php
 $form=$this->beginWidget('CActiveForm', array(
	'id'=>'calendar-form',
	'enableAjaxValidation'=>false,
)); ?>
	<div class="row">
		<div style="border:0px solid red;width:20%;float:left;padding-top:9px;">
			<?php echo $form->labelEx($modelCalendar,'title');?>
		</div>
		<div style="border:0px solid red;">
			<?php echo $form->textField($modelCalendar,'title',array('style'=>'width:460px;','maxlength'=>255)); ?>
		</div>
	</div>
	<div class="clear"></div>
	<div class="row">
		<div style="width:20%;float:left;">&nbsp;</div>
		<div><?php echo $form->error($modelCalendar,'title'); ?></div>
	</div>
	<div class="clear"></div>
	
	<div class="row">
		<div style="border:0px solid red;width:20%;float:left;padding-top:9px;">
			<?php echo $form->labelEx($modelCalendar,'content');?>
		</div>
		<div style="border:0px solid red;">
			<?php echo $form->textArea($modelCalendar,'content',array('rows'=>6, 'style'=>'width:460px;')); ?>
		</div>
	</div>
	<div class="clear"></div>
	<div class="row">
		<div style="width:20%;float:left;">&nbsp;</div>
		<div><?php echo $form->error($modelCalendar,'content'); ?></div>
	</div>
	<div class="clear"></div>
	<div class="row">
		<div style="border:0px solid red;width:20%;float:left;padding-top:9px;">
			<?php echo $form->labelEx($modelCalendar,'invite_uid');?>
		</div>
		<div style="border:0px solid red;">
			<?php echo $form->textField($modelCalendar,'invite_uid',array('size'=>60,'style'=>'width:400px;', 'maxlength'=>255,'placeholder'=>'Input your contact name')); ?>
			<input type="button" id="reset" name="reset" value="reset" />
			<?php echo CHtml::hiddenField('hidden_invite_uid',$hidden_invite_uid); ?>
		</div>
	</div>
	<div class="clear"></div>
	<div class="row">
		<div style="width:20%;float:left;">&nbsp;</div>
		<div><?php echo $form->error($modelCalendar,'invite_uid'); ?></div>
	</div>
	
	<div class="clear"></div>
	<div class="row">
		<div style="border:0px solid red;width:20%;float:left;padding-top:9px;">
			<?php echo $form->labelEx($modelCalendar,'start_time');?>
		</div>
		<div style="border:0px solid red;">
			Date: <input style="width:185px;" name="Calendar_start_date" id="Calendar_start_date" type="text" />		
			Time: <input style="width:185px;" name="Calendar_start_time" id="Calendar_start_time" type="text" />	
		</div>
	</div>
	<div class="clear"></div>
	<div class="row">
		<div style="border:0px solid red;width:20%;float:left;padding-top:9px;">
			<?php echo $form->labelEx($modelCalendar,'end_time');?>
		</div>
		<div style="border:0px solid red;">
			Date: <input style="width:185px;" name="Calendar_end_date" id="Calendar_end_date" type="text" />		
			Time: <input style="width:185px;" name="Calendar_end_time" id="Calendar_end_time" type="text" />	
		</div>
	</div>
	<div class="clear"></div>
	<div class="row">
		<div style="width:20%;float:left;">&nbsp;</div>
		<div><?php echo $form->error($modelCalendar,'end_time'); ?></div>
	</div>
	<div class="clear"></div>
	<div class="row buttons" ">
		<?php echo CHtml::imageButton('/images/save.png');?>
	</div>
<?php $this->endWidget(); ?>
<script>
	$(function() {
		$("#cancel_button").click(function(){
			history.go(-1);
		});
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