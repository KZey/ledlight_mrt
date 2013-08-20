 <div style="border:0px solid red;width:950px;overflow:hidden;">
 <div class="menu_div">
  <div id="menu_dashboard" style="float:left;" class="menu_li_selected"><img src="/images/menu_dashboard.png" /></div>
  <div id="menu_property" style="float:left;" class="menu_li_default"><img src="/images/menu_property.png" /></div>
  <div id="menu_realtor" style="float:left;" class="menu_li_default"><img src="/images/menu_realtor.png" /></div>
 </div>
 <div style="border:0px solid red;width:100%;overflow:hidden;margin:0 auto;margin-top:3px;z-index:1;">

 
  <div style="width:100%;overflow:hidden;margin:0 auto;">
			<div style="border:1px solid #C2C2C2;overflow:hidden;margin:0 auto;">
				<div style="width:100%;border-bottom:1px solid #C2C2C2;height:30px;background-image:url(/images/createproperty_title_bg.png);">
					<div style="padding:6px 0 0 10px;">Email Analytics</div>
				</div>
				<div style="border:0px solid red;overflow:hidden;padding:15px;background:#F7F7F7;">
				
				
<!--content starts-->
 <div class="form">				
		<div id='content_title'>Email</div>
		<div id='content_report'>
			<form action='/statemail/generatereport/' method='get'>
			
			<div class="row">
				<div style="float:left;width:100px;text-align:right;margin-right:15px;">Within:</div>
				<div>
					  <input type="radio" name="email_report_period" id="email_report_period" value="1" checked="true"> One Week
					  <input type="radio" name="email_report_period" id="email_report_period" value="2"> Two Weeks
					  <input type="radio" name="email_report_period" id="email_report_period" value="3"> One Month
					  <input type="radio" name="email_report_period" id="email_report_period" value="4"> Six Months
					  <input type="radio" name="email_report_period" id="email_report_period" value="5"> One year
				</div>
			</div>
			<div class="row">
				<div style="float:left;width:100px;text-align:right;margin-right:15px;">To:</div>
				<div>
					  <input type="checkbox" name="email_report_who[]" id="email_report_who[]" value='1' checked="true"> Buyers
					  <input type="checkbox" name="email_report_who[]" id="email_report_who[]" value='2'> Sellers
					  <input type="checkbox" name="email_report_who[]" id="email_report_who[]" value='3'> Agents
					  <input type="checkbox" name="email_report_who[]" id="email_report_who[]" value='4'> Lenders
					  <input type="checkbox" name="email_report_who[]" id="email_report_who[]" value='5'> Renters
					  <input type="checkbox" name="email_report_who[]" id="email_report_who[]" value='6'> Title Companies
					  <input type="checkbox" name="email_report_who[]" id="email_report_who[]" value='7'> Inspectors
					  <input type="checkbox" name="email_report_who[]" id="email_report_who[]" value='8'> Professional services
				</div>
			</div>
			<div class="row">
				<div style="float:left;width:100px;text-align:right;margin-right:15px;">Property:</div>
				<div>
					  <select name="email_report_property" id="property">
					  <option value ='0'>Please Select</option>
						<?php 
						    foreach ($prorperty_list as $prorperty_item)  {
						       echo '<option value='. $prorperty_item['property_id'] .'>'. $prorperty_item['title'] .'</option>';  
						    }				       
						?>
					  </select>
				</div>
			</div>
			<div class="row">
				<div style="float:left;width:100px;text-align:right;margin-right:15px;">&nbsp;</div>
			    <div>
				     <input type="hidden" name="generate_report" id="generate_report" value="submit">
				  	<input type="image" name="button" id="button" src="/images/green_submit.png">
			     </div>
			</div>
			</form>
		</div>
		<hr/>
		<div id='content_total_email'>
		   <div>Total Email amount you have sent within:</div>
		   <div>
		       <input type="radio" name="total_email_period" id="total_email_period" value="1" onclick="updateStatus(1,'1');"/> Last Week
		       <input type="radio" name="total_email_period" id="total_email_period" value="2" onclick="updateStatus(1,'2');"/> Last Two Weeks
		       <input type="radio" name="total_email_period" id="total_email_period" value="3" onclick="updateStatus(1,'3');"/> Last Month
		       <input type="radio" name="total_email_period" id="total_email_period" value="4" onclick="updateStatus(1,'4');"/> Last Six Months
		       <input type="radio" name="total_email_period" id="total_email_period" value="5" onclick="updateStatus(1,'5');"/> Last Year
		   </div>
		   <div id='total_email_result'></div>
		</div>
		<hr/>
		<div id='content_newsletter'>
		   There Are Currently <?php echo $newsletter_number;?> Users Who Receive Your Monthly Newsletter.
		</div>
<!--content ends-->		
	</div>

</div>
</div>
</div>

				<div class="clear"></div><br/>
				<div style="border:1px solid #C2C2C2;overflow:hidden;margin:0 auto;">
				<div style="width:100%;border-bottom:1px solid #C2C2C2;height:30px;background-image:url(/images/createproperty_title_bg.png);">
					<div style="padding:6px 0 0 10px;">Unsubscribed list in contacts</div>
				</div>
				<div style="border:0px solid red;overflow:hidden;padding:15px;background:#F7F7F7;">
								<div id="r_index_content" style="float: left;width:98%;margin-left:10px;">
										<?php $this->widget('zii.widgets.grid.CGridView', array(
											'dataProvider'=>$dataProviderContact,
											'columns'=>array(
														array(
																'selectableRows' => 2,
																'footer' => '<button type="button" onclick="GetCheckboxContact();" style="width:76px;">delete</button>',
																'class' => 'CCheckBoxColumn',
																'headerHtmlOptions' => array('width'=>'33px'),
																'checkBoxHtmlOptions' => array('name' => 'selectdelcontact[]','style'=>'margin-left:33px;'),
														),
array('name'=>'First Name','type'=>'raw','value'=>'$data["first_name"]',),
array('name'=>'Last Name','type'=>'raw','value'=>'$data["last_name"]',),
array('name'=>'Email','type'=>'raw','value'=>'$data["email"]',),
													),
											'pagerCssClass'=>'inbox_pager',
											'template'=>'{items}{summary}{pager}',
											'pager'=>array('header'=>'',),
										)); ?>
								</div>
				</div>
				</div>
				
				
				
				<div class="clear"></div><br/>
				<div style="border:1px solid #C2C2C2;overflow:hidden;margin:0 auto;">
				<div style="width:100%;border-bottom:1px solid #C2C2C2;height:30px;background-image:url(/images/createproperty_title_bg.png);">
					<div style="padding:6px 0 0 10px;">Unsubscribed list in prospects</div>
				</div>
				<div style="border:0px solid red;overflow:hidden;padding:15px;background:#F7F7F7;">
								<div id="r_index_content" style="float: left;width:98%;margin-left:10px;">
										<?php $this->widget('zii.widgets.grid.CGridView', array(
											'dataProvider'=>$dataProviderProspects,
											'columns'=>array(
														array(
																'selectableRows' => 2,
																'footer' => '<button type="button" onclick="GetCheckboxProspects();" style="width:76px;">delete</button>',
																'class' => 'CCheckBoxColumn',
																'headerHtmlOptions' => array('width'=>'33px'),
																'checkBoxHtmlOptions' => array('name' => 'selectdelProspects[]','style'=>'margin-left:33px;'),
														),
														'first_name','last_name','email_1',
array('name'=>'first name','type'=>'raw','value'=>'$data->first_name',),
array('name'=>'last name','type'=>'raw','value'=>'$data->last_name',),
array('name'=>'email','type'=>'raw','value'=>'$data->email_1',),
													),
											'pagerCssClass'=>'inbox_pager',
											'template'=>'{items}{summary}{pager}',
											'pager'=>array('header'=>'',),
										)); ?>
								</div>
				</div>
				</div>
				
				


</div>




			
			
			
			
<script>
var GetCheckboxContact = function (){
	var data=new Array();
	$("input:checkbox[name='selectdelcontact[]']").each(function ()
	{
		if($(this).attr("checked"))
		{
			data.push($(this).val());
		}
	});
	if(data.length > 0) 
	{
		$.post('<?php echo CHtml::normalizeUrl(array('/statemail/Unscribecontactdel/'));?>',{'selectdelcontact[]':data}, function (data) {
			//if (data == 1) 
				$.fn.yiiGridView.update('yw0');
		});
	}else{
		alert("Please select");
	}
}


var GetCheckboxProspects = function (){
	var data=new Array();
	$("input:checkbox[name='selectdelProspects[]']").each(function ()
	{
		if($(this).attr("checked"))
		{
			data.push($(this).val());
		}
	});
	if(data.length > 0) 
	{
		$.post('<?php echo CHtml::normalizeUrl(array('/statemail/UnscribeProspectsdel/'));?>',{'selectdelProspects[]':data}, function (data) {
			//if (data == 1) 
				$.fn.yiiGridView.update('yw2');
		});
	}else{
		alert("Please select");
	}
}

function updateStatus(id,type)
{
	$.ajax({url: '/statemail/CallTotalEmailAmount/',
		type: 'POST',
		data:{id:id, type:type},
		dataType: 'html',
		timeout: 1000,
		error: function(){alert('Error loading PHP document');},
		success: function(result){$("#total_email_result").html(result);}
	});

}
</script>

