<div id="login_cont" style="border:0px solid red;overflow:hidden;width:100%;">
	<div style="float:right;width:100%;border:0px solid red;margin-top: 20px;">
		<?php if($type == 2){?><div class="index_regirest_title_agents"></div><?php }?>
		<?php if($type == 1){?><div class="index_regirest_title_clients"></div><?php }?>
		
		<div style="border:1px solid #cccccc;height:530px;background:#EDEDED;padding-top:10px;">
			<div style="height:480px;;border:0px solid #cccccc;width:55%;margin:0 auto;">
				<?php echo $this->renderPartial('/user/index_regirest_form', array('modelUser'=>$modelUser,'type'=>$type,'header_class_1'=>$header_class_1,'header_class_2'=>$header_class_2)); ?>
				<?php if(Yii::app()->user->hasFlash('regirestError'))echo '<script>alert("'.Yii::app()->user->getFlash('regirestError').'");</script>'; ?>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
$(function() {
	$("#browse_agents").click(function(){
		location.href="/user/search?User[first_name]=&User[last_name]=&User[broker]=&User[team]=&User[state]=&User[city]=";
	});
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
	});
});
</script>