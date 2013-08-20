<div id="login_cont" style="border:0px solid red;overflow:hidden;width:100%;">
	<div class="clear"></div>
	<div style="width:100%;border:0px solid #cccccc;margin:0 auto;">
	
	<div class="propertysearch_title"></div>
	<div style="border:1px solid #cccccc;background:#EDEDED;padding-top:10px;height:550px;margin:0 auto;">
	<!--***** Property start*****-->
	<form action="/property/search" method="get">
	<div class="form" style="margin:0 auto;border:0px solid #cccccc;width:50%;">
	<div class="row">
		<ul class="search_property_row">
			<li class="search_property_row_li_1"><?php echo CHtml::label('Property Type','',array('style'=>'height:25px;padding-top:3px;top:1px;font-size:15px;font-weight:normal;')); ?></li>
			<li class="search_property_row_li_2"><?php echo CHtml::dropDownList('property_type','',array(0=>'Please Select',1=>'SFH',2=>'Condominium',3=>'Townhouse',4=>'Multi-dwelling',5=>'High-rise'),array('style'=>'width:220px;height:25px;')); ?></li>

		</ul>
	</div>
	<div class="row">
		<ul class="search_property_row">
			<li class="search_property_row_li_1"><?php echo CHtml::label('Selling Status','',array('style'=>'height:25px;padding-top:3px;top:1px;font-size:15px;font-weight:normal;')); ?></li>
			<li class="search_property_row_li_2"><?php echo CHtml::dropDownList('selling_status','',array(0=>'Please Select',1=>'Available',4=>'Expired',2=>'Sold',3=>'Pending Sale'),array('style'=>'width:220px;height:25px;')); ?></li>

		</ul>
	</div>
	<div class="row">
		<ul class="search_property_row">
			<li class="search_property_row_li_1"><?php echo CHtml::label('Property Status','',array('style'=>'height:25px;padding-top:3px;top:1px;font-size:15px;font-weight:normal;')); ?></li>
			<li class="search_property_row_li_2"><?php echo CHtml::dropDownList('property_status','',array(0=>'Please Select',1=>'Bank Owned',2=>'Short Sale',3=>'New Construction',4=>'Recently Sold',5=>'Rental',6=>'Resale'),array('style'=>'width:220px;height:25px;')); ?></li>

		</ul>
	</div>
	<div class="row">
		<ul class="search_property_row">
			<li class="search_property_row_li_1"><?php echo CHtml::label('Beds','',array('style'=>'height:25px;padding-top:3px;top:1px;font-size:15px;font-weight:normal;')); ?></li>
			<li class="search_property_row_li_2">
				<li style="float:left; margin-left:10px;">
					<?php //echo CHtml::dropDownList('beds','',array(0=>'Select',1=>1,2=>2,3=>3,4=>4,5=>5,6=>6,7=>7,8=>8,9=>9,10=>10,11=>11,12=>12,13=>13,14=>14,15=>15),array('style'=>'width:80px;height:25px;')); 
					?>
					<?php echo CHtml::textField('beds','',array('style'=>'width:80px;','maxlength'=>255,'class'=>'regirest_text')); ?>
				</li>
				<li style="float:left; margin-left:7px;"><?php echo CHtml::label('baths','',array('style'=>'height:25px;padding-top:3px;top:1px;font-size:15px;font-weight:normal;')); ?></li>
				<li style="float:left; margin-left:8px;">
					<?php echo CHtml::textField('baths','',array('style'=>'width:80px;','maxlength'=>255,'class'=>'regirest_text')); ?>
					<!-- 
<select style="width:80px;height:25px;" name="baths" id="baths">
<option value="0">Select</option>
<option value="0.5">0.5</option>
<option value="1">1</option>
<option value="1.5">1.5</option>
<option value="2">2</option>
<option value="2.5">2.5</option>
<option value="3">3</option>
<option value="3.5">3.5</option>
<option value="4">4</option>
<option value="4.5">4.5</option>
<option value="5">5</option>
<option value="5.5">5.5</option>
<option value="6">6</option>
<option value="6.5">6.5</option>
<option value="7">7</option>
<option value="7.5">7.5</option>
<option value="8">8</option>
<option value="8.5">8.5</option>
<option value="9">9</option>
<option value="9.5">9.5</option>
<option value="10">10</option>
</select>	
 -->
				</li>
			</li>
		</ul>
	</div>
	<div class="row">
		<ul class="search_property_row">
			<li class="search_property_row_li_1"><?php echo CHtml::label('Address','',array('style'=>'height:25px;padding-top:3px;top:1px;font-size:15px;font-weight:normal;')); ?></li>
			<li class="search_property_row_li_2"><?php echo CHtml::textField('address','',array('style'=>'width:220px','maxlength'=>255,'class'=>'regirest_text')); ?></li>
		</ul>
	</div>
	<div class="row">
		<ul class="search_property_row">
			<li class="search_property_row_li_1"><?php echo CHtml::label('Price','',array('style'=>'height:25px;padding-top:3px;top:1px;font-size:15px;font-weight:normal;')); ?></li>
			<li class="search_property_row_li_2">
				<?php echo CHtml::textField('price_from','',array('style'=>'width:99px;','maxlength'=>255,'class'=>'regirest_text')); ?> - 
				<?php echo CHtml::textField('price_to','',array('style'=>'width:99px;','maxlength'=>255,'class'=>'regirest_text')); ?>
			</li>
		</ul>
	</div>
	<div class="row">
		<ul class="search_property_row">
			<li class="search_property_row_li_1"><?php echo CHtml::label('Lot Size','',array('style'=>'height:25px;padding-top:3px;top:1px;font-size:15px;font-weight:normal;')); ?></li>
			<li class="search_property_row_li_2">
				<?php echo CHtml::textField('lot_size_from','',array('style'=>'width:99px;','maxlength'=>255,'class'=>'regirest_text')); ?> - 
				<?php echo CHtml::textField('lot_size_to','',array('style'=>'width:99px;','maxlength'=>255,'class'=>'regirest_text')); ?>
		</ul>
	</div>
	<div class="row">
		<ul class="search_property_row">
			<li class="search_property_row_li_1"><?php echo CHtml::label('House Size','',array('style'=>'height:25px;padding-top:3px;top:1px;font-size:15px;font-weight:normal;')); ?></li>
			<li class="search_property_row_li_2">
				<?php echo CHtml::textField('house_size_from','',array('style'=>'width:99px;','maxlength'=>255,'class'=>'regirest_text')); ?> - 
				<?php echo CHtml::textField('house_size_to','',array('style'=>'width:99px;','maxlength'=>255,'class'=>'regirest_text')); ?>
		</ul>
	</div>
	
	<div class="row">
		<ul class="search_property_row">
			<li class="search_property_row_li_1">&nbsp;</li>
			<li class="search_property_row_li_2">
				<?php echo CHtml::imageButton('/images/button_green_search.png',array('id'=>'browse_listing')); ?>
		</ul>
	</div>
	
	<div id="error_msg" style="color:red;margin:10px 0 0 50px;"></div>
</div>
</form>
<!--***** Property end*****-->
	</div>
	
</div>
<script type="text/javascript">
$(function() {
	initInput('price_from','From','regirest_text');
	initInput('price_to','To','regirest_text');
	
	initInput('lot_size_from','From','regirest_text');
	initInput('lot_size_to','To','regirest_text');
	
	initInput('house_size_from','From','regirest_text');
	initInput('house_size_to','To','regirest_text');
	
	$("#browse_listing").click(function(){
		checkInputInitText('price_from','From');
		checkInputInitText('price_to','To');
		
		checkInputInitText('lot_size_from','From');
		checkInputInitText('lot_size_to','To');
		
		checkInputInitText('house_size_from','From');
		checkInputInitText('house_size_to','To');
		
		var property_type = $("#property_type").val();
		var selling_status = $("#selling_status").val();
		var property_status = $("#property_status").val();
		var beds = $("#beds").val();
		var baths = $("#baths").val();
		var address = $("#address").val();
		
		var price_from = $("#price_from").val();
		var price_to = $("#price_to").val();
		
		var lot_size_from = $("#lot_size_from").val();
		var lot_size_to = $("#lot_size_to").val();
		
		var house_size_from = $("#house_size_from").val();
		var house_size_to = $("#house_size_to").val();
		
		if(!isBlankTrimed(price_from) || !isBlankTrimed(price_to)){
			if(isInteger(price_from) || isInteger(price_to)){$("#error_msg").html("<br/>Price must be an interger number.");return false;}
		}
		if(!isBlankTrimed(lot_size_from) || !isBlankTrimed(lot_size_to)){
			if(isInteger(lot_size_from) || isInteger(lot_size_to)){$("#error_msg").html("<br/>Lot size must be an interger number.");return false;}
		}
		if(!isBlankTrimed(house_size_from) || !isBlankTrimed(house_size_to)){
			if(isInteger(house_size_from) || isInteger(house_size_to)){$("#error_msg").html("<br/>House size must be an interger number.");return false;}
		}
		return true;
		/**
		$.get("/property/search", {Action:"get",
			property_type:property_type,
			selling_status:selling_status,
			property_status:property_status,
			beds:beds,
			baths:baths,
			address:address,
			price_from:price_from,
			price_to:price_to,
			lot_size_from:lot_size_from,
			lot_size_to:lot_size_to,
			house_size_from:house_size_from,
			house_size_to:house_size_to
			}, 
			function (data, textStatus){
			//location.href="/property/search";
		});**/
	});
});

</script>