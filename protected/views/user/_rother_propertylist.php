<div  style="width:440px;background:#fff;height:180px;margin:5px;float:left;border:0px solid red;">
	<div  style="padding:10px;">
		<div style="width: 43%;float:left;border:0px solid red;">
			<a href="/property/<?php echo $data['property_id']; ?>">
				<img src="/upload/property/<?php echo $data['logo']; ?>" width=170 height=150 style="padding:3px;border:1px solid #cccccc;" /></a>
		</div>
		<div style="width: 55%;float:left;border:0px solid red;margin-left:3px;">
			<div style="float:left;width: 100%;">
				<div style="font-size:14px;float:left;"><a href="/property/<?php echo $data['property_id']; ?>" style="font-weight:bold;color:#336699;">
				<?php echo HelperSubstring::truncate_utf8_string(CHtml::encode($data['title']),10); ?></a></div>
			</div>
			<div style="float:left;width: 100%;margin-top:10px;">
				
				<div style="width: 100%;float:left;background:#f9f2f2;padding:3px;">
					<div style="float:left;width: 40%;font-weight:bold;">Price: </div>
					<div style="float:left;width: 60%;color:green;">$ <?php echo number_format($data['price']);?></div>
				</div>
				<div class="clear"></div>
				
				<div style="width: 100%;float:left;padding:3px;">
					<div style="float:left;width: 40%;font-weight:bold;">Beds: </div>
					<div style="float:left;width: 60%;"><?php echo $data['beds'];?></div>
				</div>
				<div class="clear"></div>
				
				<div style="width: 100%;float:left;background:#f9f2f2;padding:3px;">
					
					<div style="float:left;width: 40%;font-weight:bold;background:#f9f2f2;">Baths: </div>
					<div style="float:left;width: 60%;background:#f9f2f2;"><?php echo $data['baths'];?></div>
				</div>
				<div class="clear"></div>
				
				<div style="width: 100%;float:left;padding:3px;">
					<div style="float:left;width: 40%;font-weight:bold;">House Size: </div>
					<div style="float:left;width: 60%;"><?php echo number_format($data['house_size']);?> sq ft</div>
				</div>
				<div class="clear"></div>
				
				<div style="width: 100%;float:left;background:#f9f2f2;padding:3px;">
					
					<div style="float:left;width: 40%;font-weight:bold;background:#f9f2f2;">Lot Size: </div>
					<div style="float:left;width: 60%;background:#f9f2f2;"><?php echo number_format($data['lot_size']);?> sq ft</div>
				</div>
				<div class="clear"></div>
				
				<div style="width: 100%;float:left;padding:3px;">
					<div style="float:left;width: 40%;font-weight:bold;">Pool: </div>
					<div style="float:left;width: 60%;"><?php if($data['pool'] == 1)echo 'YES';else echo 'NO';?></div>
				</div>
				<div class="clear"></div>
					
			</div>
		</div>
	</div>
</div>

 
<div class="clear"></div>
<div style="border-bottom:1px dotted #cccccc;margin:5px 0;"></div>
 