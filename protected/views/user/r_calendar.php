<script type="text/javascript" rel="stylesheet" src="/js/jquery.zxxbox.3.0.js"></script>
<div style="border:0px solid red;width:950px;overflow:hidden;background:#fff;">
	<div class="menu_div">
		<div id="menu_dashboard" style="float:left;" class="menu_li_selected"><?php if(Yii::app()->user->type==1){?><img src="/images/menu_profile.png" /><?php }else{?><img src="/images/menu_dashboard.png" /><?php }?></div>
		<div id="menu_property" style="float:left;" class="menu_li_default"><img src="/images/menu_property.png" /></div>
		<div id="menu_realtor" style="float:left;" class="menu_li_default"><img src="/images/menu_realtor.png" /></div>
	</div>
	<div style="border:0px solid red;width:98%;overflow:hidden;margin:0 auto;margin-top:3px;z-index:1;">
		<div style="width:99%;overflow:hidden;margin:0 auto;">
			
		<link rel="stylesheet" type="text/css" href="/css/calendar.css">
		<div class="php-calendar">
		
		<div>
		<div id="phpc-summary-view">
			<div class="phpc-summary-head">
				<div id="phpc-summary-title"></div>
				<div id="phpc-summary-time"></div>
			</div>
			<div id="phpc-summary-body"></div>
		</div>
<div class="phpc-month-nav">
	<?php echo $month_navbar;?>
</div>
<table class="phpc-main phpc-calendar">
<div style="float:left;font-size:22px;font-weight:bold;"><?php echo $now_month_name.' '.$now_year;?></div>
<div style="float:right;margin-bottom:10px;cursor:pointer;" onclick="location.href='/calendar/create';"><img src="/images/add_event.png" /></div>
<colgroup span="7" width="14%"><col width="3%">
</colgroup>
<thead><tr><th>W</th>
<th>Sunday</th>
<th>Monday</th>
<th>Tuesday</th>
<th>Wednesday</th>
<th>Thursday</th>
<th>Friday</th>
<th>Saturday</th>
</tr>
</thead>
<?php echo $month_table;?>
</table>
</div>
</div>
		</div>
	</div>
</div>

<div id="div_addevents" style='display:none;'>
<?php echo $this->renderPartial('_form_calendar',array('modelCalendar'=>$modelCalendar,'hidden_invite_uid'=>$hidden_invite_uid)); ?>
</div>