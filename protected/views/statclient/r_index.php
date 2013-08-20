<script type="text/javascript" rel="stylesheet" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.zxxbox.3.0.js"></script>
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
					<div style="padding:6px 0 0 10px;">Client Analytics</div>
				</div>
				<div style="border:0px solid red;overflow:hidden;padding:15px;background:#F7F7F7;">
				
<!--content starts-->
 <div class="form">
		<div id='content_title'>Client</div>
		<div id='content_report'>
			<form action='/statclient/generatereport/' method='get'>
			<div class="row">
				<div style="float:left;width:190px;text-align:right;margin-right:15px;">Financing Type:</div>
				<div>
					  <input type="radio" name="client_report_finance" id="client_report_finance" value="1" checked="true"> Cash
					  <input type="radio" name="client_report_finance" id="client_report_finance" value="2"> FHA
					  <input type="radio" name="client_report_finance" id="client_report_finance" value="3"> Conventional
					  <input type="radio" name="client_report_finance" id="client_report_finance" value="4"> VA
				</div>
			</div>
			<div class="row">
				<div style="float:left;width:190px;text-align:right;margin-right:15px;">Expense:</div>
				<div>
					  <input type="checkbox" name="client_report_expense[]" id="client_report_expense[]" value='1' checked='true'> Gas
					  <input type="checkbox" name="client_report_expense[]" id="client_report_expense[]" value='2'> Meals
					  <input type="checkbox" name="client_report_expense[]" id="client_report_expense[]" value='3'> Advertising
					  <input type="checkbox" name="client_report_expense[]" id="client_report_expense[]" value='4'> Others
				</div>
			</div>
			<div class="row">
				<div style="float:left;width:190px;text-align:right;margin-right:15px;">Referral Type:</div>
				<div>
					  <input type="checkbox" name="client_report_referral[]" id="client_report_referral[]" value='1' checked='true'> Associate/Co-Worker
					  <input type="checkbox" name="client_report_referral[]" id="client_report_referral[]" value='2'> Agent
					  <input type="checkbox" name="client_report_referral[]" id="client_report_referral[]" value='3'> Previous Client
					  <input type="checkbox" name="client_report_referral[]" id="client_report_referral[]" value='4'> MRT
					  <input type="checkbox" name="client_report_referral[]" id="client_report_referral[]" value='5'> Sign Call
					  <input type="checkbox" name="client_report_referral[]" id="client_report_referral[]" value='6'> Friends
				</div>
			</div>
			<div class="row">
				<div style="float:left;width:190px;text-align:right;margin-right:15px;">&nbsp;</div>
			    <div>
				     <input type="hidden" name="generate_report" id="generate_report" value="submit">
				  	<input type="image" name="button" id="button" src="/images/green_submit.png">
			     </div>
			</div>
			
			</form>
		</div>

		<hr/>
		<div id='content_client_referral'>
		   <div class="row">
				<div style="float:left;width:190px;text-align:right;margin-right:15px;">Client of this referral type:</div>
				<div>
					  <input type="checkbox" name="client_report_referral_num[]" id="client_report_referral_num" value='1' onclick='updateClientNumByReferral()' > Associate/Co-Worker
					  <input type="checkbox" name="client_report_referral_num[]" id="client_report_referral_num" value='2' onclick='updateClientNumByReferral()'> Agent
					  <input type="checkbox" name="client_report_referral_num[]" id="client_report_referral_num" value='3' onclick='updateClientNumByReferral()'> Previous Client
					  <input type="checkbox" name="client_report_referral_num[]" id="client_report_referral_num" value='4' onclick='updateClientNumByReferral()'> MRT
					  <input type="checkbox" name="client_report_referral_num[]" id="client_report_referral_num" value='5' onclick='updateClientNumByReferral()'> Sign Call
					  <input type="checkbox" name="client_report_referral_num[]" id="client_report_referral_num" value='6' onclick='updateClientNumByReferral()'> Friends
		   		</div>
		   </div>
		    <div class="clear"> </div>
		   <div class="row" style="border:0px solid red;">
			   <div style="float:left;width:190px;text-align:right;margin-right:15px;">&nbsp;</div>
			   <div id='client_report_referral_num_result'></div>
		   </div>
			<div class="clear"> </div>
		</div>

		<hr/>
		<div id='content_expense'>
		   <div class="row">
				<div style="float:left;width:190px;text-align:right;margin-right:15px;">Your Expense in:</div>
				<div>
				       <input type="radio" name="client_expense_period" id="client_expense_period" value="1" checked='true' onclick='updateExpense()'/> Last Week
				       <input type="radio" name="client_expense_period" id="client_expense_period" value="2" onclick='updateExpense()' /> Last Two Weeks
				       <input type="radio" name="client_expense_period" id="client_expense_period" value="3" onclick='updateExpense()' /> Last Month
				       <input type="radio" name="client_expense_period" id="client_expense_period" value="4" onclick='updateExpense()' /> Last Six Months
				       <input type="radio" name="client_expense_period" id="client_expense_period" value="5" onclick='updateExpense()' /> Last Year
		   		</div>
		   </div>
		   <div class="row">
				<div style="float:left;width:190px;text-align:right;margin-right:15px;">Expense on:</div>
				<div>
			  		<input type="checkbox" name="client_report_expense" id="client_report_expense" value='1' checked='true' onclick='updateExpense()'> Gas
				     <input type="checkbox" name="client_report_expense" id="client_report_expense" value='2' onclick='updateExpense()' > Meals
				     <input type="checkbox" name="client_report_expense" id="client_report_expense" value='3' onclick='updateExpense()'> Advertising
				     <input type="checkbox" name="client_report_expense" id="client_report_expense" value='4' onclick='updateExpense()'> Others
		   		</div>
		   </div>
		    <div class="clear"> </div>
		   <div class="row" style="border:0px solid red;">
			   <div style="float:left;width:190px;text-align:right;margin-right:15px;">&nbsp;</div>
			   <div id='content_expense_result'></div>
		   </div>
			<div class="clear"> </div>
		</div>
		
		
		
		
		
				<hr/>
		<div id='content_client_referral'>
		  <div class="row">
			   <div style="float:left;width:190px;text-align:right;margin-right:15px;">Advertising:</div>
				<div>
					<input type="radio" name="listing_report_closed_number" id="listing_report_closed_number" value="1"   onclick="updateStatus(1,'1');"> Last week
				  <input type="radio" name="listing_report_closed_number" id="listing_report_closed_number" value="2"  onclick="updateStatus(1,'2');"> Last two weeks
				  <input type="radio" name="listing_report_closed_number" id="listing_report_closed_number" value="3"  onclick="updateStatus(1,'3');"> Last month
				  <input type="radio" name="listing_report_closed_number" id="listing_report_closed_number" value="4"  onclick="updateStatus(1,'4');"> Last six months
				  <input type="radio" name="listing_report_closed_number" id="listing_report_closed_number" value="5"  onclick="updateStatus(1,'5');"> Last year
			   </div>
		  </div>
		   <div class="clear"> </div>
		  <div class="row" style="border:0px solid red;">
			   <div style="float:left;width:190px;text-align:right;margin-right:15px;">&nbsp;</div>
			   <div id='expense_report_result_1'></div>
		  </div>
		   <div class="clear"> </div>
		   <div class="row" style="border:0px solid red;">
			   <div style="border:0px solid red;float:left;width:190px;text-align:right;margin-right:15px;">Gas :</div>
			  <div>
				  <input type="radio" name="listing_report_closed_price" id="listing_report_closed_price" value="1" onclick="updateStatus(2,'1');"> Last week
				  <input type="radio" name="listing_report_closed_price" id="listing_report_closed_price" value="2" onclick="updateStatus(2,'2');"> Last two weeks
				  <input type="radio" name="listing_report_closed_price" id="listing_report_closed_price" value="3" onclick="updateStatus(2,'3');"> Last month
				  <input type="radio" name="listing_report_closed_price" id="listing_report_closed_price" value="4" onclick="updateStatus(2,'4');"> Last six months
				  <input type="radio" name="listing_report_closed_price" id="listing_report_closed_price" value="5" onclick="updateStatus(2,'5');"> Last year
		  	 </div>
		   </div>
		   <div class="clear"> </div>
 			<div class="row" style="border:0px solid red;">
			   <div style="float:left;width:190px;text-align:right;margin-right:15px;">&nbsp;</div>
			   <div id='expense_report_result_2'></div>
		  </div>
<div class="clear"> </div>
		  <div class="row">
			   <div style="float:left;width:190px;text-align:right;margin-right:15px;">Meals:</div>
			   <div>
					  <input type="radio" name="listing_report_closed_commission" id="listing_report_closed_commission" value="1"  onclick="updateStatus(3,'1');"> Last week
					  <input type="radio" name="listing_report_closed_commission" id="listing_report_closed_commission" value="2"  onclick="updateStatus(3,'2');"> Last two weeks
					  <input type="radio" name="listing_report_closed_commission" id="listing_report_closed_commission" value="3"  onclick="updateStatus(3,'3');"> Last month
					  <input type="radio" name="listing_report_closed_commission" id="listing_report_closed_commission" value="4"  onclick="updateStatus(3,'4');"> Last six months
					  <input type="radio" name="listing_report_closed_commission" id="listing_report_closed_commission" value="5"  onclick="updateStatus(3,'5');"> Last year
				</div>
		   </div>
		   <div class="clear"> </div>
		   <div class="row" style="border:0px solid red;">
			   <div style="float:left;width:190px;text-align:right;margin-right:15px;">&nbsp;</div>
			   <div id='expense_report_result_3'></div>
		   </div>
<div class="clear"> </div>
		  <div class="row" style="border:0px solid red;">
			   <div style="float:left;width:190px;text-align:right;margin-right:15px;">Others:</div>
			   <div>
					  <input type="radio" name="listing_report_closed_duration" id="listing_report_closed_duration" value="1" onclick="updateStatus(4,'1');"> Last week
					  <input type="radio" name="listing_report_closed_duration" id="listing_report_closed_duration" value="2" onclick="updateStatus(4,'2');"> Last two weeks
					  <input type="radio" name="listing_report_closed_duration" id="listing_report_closed_duration" value="3" onclick="updateStatus(4,'3');"> Last month
					  <input type="radio" name="listing_report_closed_duration" id="listing_report_closed_duration" value="4" onclick="updateStatus(4,'4');"> Last six months
					  <input type="radio" name="listing_report_closed_duration" id="listing_report_closed_duration" value="5" onclick="updateStatus(4,'5');"> Last year
		   		</div>
		   </div>
		   <div class="clear"> </div>
		    <div class="row">
			   <div style="float:left;width:190px;text-align:right;margin-right:15px;">&nbsp;</div>
			   <div id='expense_report_result_4'></div>
		   </div>
		</div>
		
		
		


<!--content ends-->		
	</div>
</div>

<script>
function updateClientNumByReferral()
{
	var selectedItems = new Array();
	$("#client_report_referral_num:checked").each(function() {selectedItems.push($(this).val());});
	if (selectedItems.length == 0){
	     $("#client_report_referral_num_result").html(0);
	}
	else {
	    $.ajax({
		type: "POST",
		url: "/statclient/ReferralClientNum/",
		data: "items=" + selectedItems.join('|'),
		dataType: "text",
		success: function (result) {
		    $("#client_report_referral_num_result").html(result);
		  },
		error: function(request,error){
		    //alert('Error proceeding the action');
		  }
		}
	    )
	}
}

function updateExpense()
{
	var selectedItems = new Array();
	$("#client_expense_period:checked").each(function() {selectedItems.push($(this).val());});
	var selectedItems1 = new Array();
	$("#client_report_expense:checked").each(function() {selectedItems1.push($(this).val());});

	if ((selectedItems.length == 0) || (selectedItems1.length == 0)){
	     $("#content_expense_result").html(0);
	}
	else {
	    $.ajax({
		type: "POST",
		url: "/statclient/ExpenseTotal/",
		data: "items=" + selectedItems.join('|')+"-"+selectedItems1.join('|'),
		dataType: "text",
		success: function (result) {
		    $("#content_expense_result").html(result);
		  },
		error: function(request,error){
// 		    alert('Error proceeding the action.');
		  }
		}
	    )
	}
}

function updateStatus(type, value)
{
	$.ajax({url: '/statclient/getexpense/',
		type: 'POST',
		data:{type: type,value: value},
		dataType: 'html',
		timeout: 1000,
		//error: function(){alert('Error loading PHP document');},
		success: function(result){$("#expense_report_result_"+type).html("$ "+format_num(result));}
	});
}
</script>

