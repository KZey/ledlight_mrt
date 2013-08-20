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
					<div style="padding:6px 0 0 10px;">Listing Analytics</div>
				</div>
				<div style="border:0px solid red;overflow:hidden;padding:15px;background:#F7F7F7;">
				

<!--content starts-->
	<div class="form">
		<div id='content_title'>Listing</div>
		<div id='content_report'>
			<form action='/statlisting/generatereport/' method='get'>
			<div class="row">
				<div style="float:left;width:190px;text-align:right;margin-right:15px;">Close Date:</div>
				<div><input type="radio" name="listing_report_close_date" id="listing_report_close_date" value="1" checked="true"> Last week
				  <input type="radio" name="listing_report_close_date" id="listing_report_close_date" value="2"> Last two weeks
				  <input type="radio" name="listing_report_close_date" id="listing_report_close_date" value="3"> Last month
				  <input type="radio" name="listing_report_close_date" id="listing_report_close_date" value="4"> Last six months
				  <input type="radio" name="listing_report_close_date" id="listing_report_close_date" value="5"> Last year
				 </div>
			</div>
			<div class="row">
			   <div style="float:left;width:190px;text-align:right;margin-right:15px;">Duration on market:</div>
			  <div> 
					 <input type="radio" name="listing_report_duration" id="listing_report_duration" value="30" checked="true"> < 30days
					  <input type="radio" name="listing_report_duration" id="listing_report_duration" value="60"> < 60days
					  <input type="radio" name="listing_report_duration" id="listing_report_duration" value="92"> < 3 months
					  <input type="radio" name="listing_report_duration" id="listing_report_duration" value="183"> < 6 months
					  <input type="radio" name="listing_report_duration" id="listing_report_duration" value="365"> < 1year
				</div>
			</div>

			<div class="row">
				<div style="float:left;width:190px;text-align:right;margin-right:15px;">Price: </div>
			    <div>
				      <input type="checkbox" name="listing_report_price[]" id="listing_report_price[]" value='1' checked="true"> <100K
					  <input type="checkbox" name="listing_report_price[]" id="listing_report_price[]" value='2'> 101K - 250K
					  <input type="checkbox" name="listing_report_price[]" id="listing_report_price[]" value='3'> 251K - 400K
					  <input type="checkbox" name="listing_report_price[]" id="listing_report_price[]" value='4'> 401K - 600K
					  <input type="checkbox" name="listing_report_price[]" id="listing_report_price[]" value='5'> 601K - 800K
			    </div>
			</div>
			<div class="row">
				<div style="float:left;width:190px;text-align:right;margin-right:15px;">Commission Rate: </div>
			    <div>
			    <input type="text" name="listing_report_commission_1" id="listing_report_commission_1" style="width:50px;" /> % - 
			    <input type="text" name="listing_report_commission_2" id="listing_report_commission_2" style="width:50px;" /> %
			     </div>
			</div>
			<div class="row">
				<div style="float:left;width:190px;text-align:right;margin-right:15px;">&nbsp;</div>
			    <div>
				     <input type="hidden" name="generate_report" id="generate_report" value="submit">
				  	<input type="image" name="listing_submit_button" id="listing_submit_button" src="/images/green_submit.png">
			     </div>
			</div>
			
			</form>
		</div>

		<hr/>
		<div id='content_client_referral'>
		
		
		  <div class="row">You have <?php echo $num_active_listing;?> Active listing on MRT</div>

		  <div class="row">
			   <div style="float:left;width:190px;text-align:right;margin-right:15px;">Number of closed listings:</div>
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
			   <div id='listing_report_closed_number_result'></div>
		  </div>
		   <div class="clear"> </div>
		   <div class="row" style="border:0px solid red;">
			   <div style="border:0px solid red;float:left;width:190px;text-align:right;margin-right:15px;">Average Closing Price :</div>
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
			   <div id='listing_report_closed_price_result'></div>
		  </div>
<div class="clear"> </div>
		  <div class="row">
			   <div style="float:left;width:190px;text-align:right;margin-right:15px;">Average Commission:</div>
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
			   <div id='listing_report_closed_commission_result'></div>
		   </div>
<div class="clear"> </div>
		  <div class="row" style="border:0px solid red;">
			   <div style="float:left;width:190px;text-align:right;margin-right:15px;">Average duration on market:</div>
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
			   <div id='listing_report_closed_duration_result'></div>
		   </div>
		</div>
</div>
<!--content ends-->		
		</div>
			</div>
		</div>
		
		
	</div>
</div>

<?php 
	if(Yii::app()->user->hasFlash('success'))echo '<script>alert("'.Yii::app()->user->getFlash('success').'");</script>';
 	if(Yii::app()->user->hasFlash('error'))echo '<script>alert("'.Yii::app()->user->getFlash('errorCommission').'");</script>'; 
?>
							
<script>


function updateStatus(type, value)
{
	var url;
	var container;
	if(type == 1)
	  url = '/statlisting/ClosedListingNumber/';
	else if(type == 2)
	  url = '/statlisting/ClosedAvgPrice/';
	else if(type == 3)
	  url = '/statlisting/ClosedAvgCommission/';
	else if(type == 4)
	  url = '/statlisting/ClosedAvgDuration/';
	if(type == 1) {
		$.ajax({url: url,
			type: 'POST',
			data:{value: value},
			dataType: 'html',
			timeout: 1000,
			//error: function(){alert('Error loading PHP document');},
			success: function(result){$("#listing_report_closed_number_result").html(result);}
		});
	}
	if(type == 2) {
		$.ajax({url: url,
			type: 'POST',
			data:{value: value},
			dataType: 'html',
			timeout: 1000,
			//error: function(){alert('Error loading PHP document');},
			success: function(result){$("#listing_report_closed_price_result").html("$ "+format_num(result));}
		});
	}
	if(type == 3) {
		$.ajax({url: url,
			type: 'POST',
			data:{value: value},
			dataType: 'html',
			timeout: 1000,
			//error: function(){alert('Error loading PHP document');},
			success: function(result){$("#listing_report_closed_commission_result").html("$ "+format_num(result));}
		});
	}
	if(type == 4) {
		$.ajax({url: url,
			type: 'POST',
			data:{value: value},
			dataType: 'html',
			timeout: 1000,
			//error: function(){alert('Error loading PHP document');},
			success: function(result){$("#listing_report_closed_duration_result").html(result+ ' Days');}
		});
	}
}
</script>



