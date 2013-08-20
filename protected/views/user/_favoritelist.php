<div style="width:100%;height:210px;margin-bottom:18px;background: #fff;">
<div style="width:97%;padding:10px;">
	<div style="float:left;border:0px solid red;">
		<a href="/property/<?php echo $data['property_id']; ?>">
			<img src="/upload/property/<?php echo $data['logo']; ?>" width=200 height=160 style="padding:3px;border:1px solid #cccccc;" /></a>
	</div>
	<div style="width: 68%;float:right;height:170px;border:0px solid red;">
		<div style="width: 95%;height:40px;">
			<div style="padding:10px;font-size:16px;float:left;width:85%;">
				<a href="/property/<?php echo $data['property_id']; ?>" style="font-weight:bold;">
			<?php echo HelperSubstring::truncate_utf8_string(CHtml::encode($data['title']),20); ?></a></div>
		</div>
		<div style="width: 95%;margin:0 auto;">
			<div style="width: 100%;float:left;">
				<div style="width: 100%;float:left;background:#f9f2f2;">
					<div style="float:left;width: 30%;padding:3px;font-weight:bold;">Price: </div>
					<div style="float:left;width: 65%;padding:3px;color:green;">$ <?php echo number_format($data['price']);?></div>
				</div>
				<div class="clear"></div>
				
				<div style="width: 100%;float:left;">
					<div style="float:left;width: 30%;padding:3px;font-weight:bold;">Beds: </div>
					<div style="float:left;width: 65%;padding:3px;"><?php echo $data['beds'];?></div>
				</div>
				<div class="clear"></div>
				
				<div style="width: 100%;float:left;background:#f9f2f2;">
					<div style="float:left;width: 30%;padding:3px;font-weight:bold;background:#f9f2f2;">Baths: </div>
					<div style="float:left;width: 65%;padding:3px;background:#f9f2f2;"><?php echo $data['baths'];?></div>
				</div>
				<div class="clear"></div>
				
				<div style="width: 100%;float:left;">
					<div style="float:left;width: 30%;padding:3px;font-weight:bold;">House Size: </div>
					<div style="float:left;width: 65%;padding:3px;"><?php echo $data['house_size'];?></div>
				</div>
				<div class="clear"></div>
				
				<div style="width: 100%;float:left;background:#f9f2f2;">
					<div style="float:left;width: 30%;padding:3px;font-weight:bold;background:#f9f2f2;">Lot Size: </div>
					<div style="float:left;width: 65%;padding:3px;background:#f9f2f2;"><?php echo $data['lot_size'];?></div>
				</div>
				<div class="clear"></div>
				
				<div style="width: 100%;float:left;">
					<div style="float:left;width: 30%;padding:3px;font-weight:bold;">Pool: </div>
					<div style="float:left;width: 65%;padding:3px;"><?php if($data['pool'] == 1)echo 'YES';else echo 'NO';?></div>
				</div>
				
			</div>
		</div>
	</div>
 </div>	
</div>

