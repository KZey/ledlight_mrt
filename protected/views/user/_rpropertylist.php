<?php $modelPropertyShow = new Property();?>
<div style="width:100%;height:225px;margin-bottom:18px;background: #fff;">
<div style="width:97%;padding:10px;">
	<div style="float:left;">
		<a href="/property/<?php echo $data['property_id']; ?>">
			<img src="/upload/property/<?php echo $data['logo']; ?>" width=200 height=160 style="padding:3px;border:1px solid #cccccc;" /></a>
	</div>
	<div style="width: 68%;float:right;height:185px;border:0px solid red;">
		<div style="width: 97%;height:40px;border:0px solid red;">
			<div style="padding:10px;font-size:16px;float:left;width:100%;">
				<a href="/property/<?php echo $data['property_id']; ?>" style="font-weight:bold;">
			<?php echo HelperSubstring::truncate_utf8_string(CHtml::encode($data['title']),20); ?></a></div>
		</div>
		<div style="width: 95%;margin:0 auto;">
			<div style="width: 100%;float:left;">
				<div style="width: 100%;float:left;">
					<div style="float:left;width: 30%;padding:3px;font-weight:bold;"><?php echo CHtml::activeLabel($modelPropertyShow,'selling_status');?>: </div>
					<div style="float:left;width: 65%;padding:3px;color:green;">
						<?php 
							switch($data['selling_status'])
							{
								case 2:echo 'Sold';break;
								case 4:echo 'Never Sale';break;
								case 3:echo 'Pending Sale';break;
								default:echo 'Available';
							}
						?>
					</div>
				</div>
				<div class="clear"></div>
				
				<div style="width: 100%;float:left;background:#f9f2f2;">
					<div style="float:left;width: 30%;padding:3px;font-weight:bold;"><?php echo CHtml::activeLabel($modelPropertyShow,'price');?>: </div>
					<div style="float:left;width: 65%;padding:3px;color:green;">$ <?php echo number_format($data['price']);?></div>
				</div>
				<div class="clear"></div>
				
				<div style="width: 100%;float:left;">
					<div style="float:left;width: 30%;padding:3px;font-weight:bold;"><?php echo CHtml::activeLabel($modelPropertyShow,'beds');?>: </div>
					<div style="float:left;width: 65%;padding:3px;"><?php echo $data['beds'];?></div>
				</div>
				<div class="clear"></div>
				
				<div style="width: 100%;float:left;background:#f9f2f2;">
					<div style="float:left;width: 30%;padding:3px;font-weight:bold;background:#f9f2f2;"><?php echo CHtml::activeLabel($modelPropertyShow,'baths');?>: </div>
					<div style="float:left;width: 65%;padding:3px;background:#f9f2f2;"><?php echo $data['baths'];?></div>
				</div>
				<div class="clear"></div>
				
				<div style="width: 100%;float:left;">
					<div style="float:left;width: 30%;padding:3px;font-weight:bold;"><?php echo CHtml::activeLabel($modelPropertyShow,'house_size');?>: </div>
					<div style="float:left;width: 65%;padding:3px;"><?php echo number_format($data['house_size']);?> sq ft</div>
				</div>
				<div class="clear"></div>
				
				<div style="width: 100%;float:left;background:#f9f2f2;">
					<div style="float:left;width: 30%;padding:3px;font-weight:bold;background:#f9f2f2;"><?php echo CHtml::activeLabel($modelPropertyShow,'lot_size');?>: </div>
					<div style="float:left;width: 65%;padding:3px;background:#f9f2f2;"><?php echo number_format($data['lot_size']);?> sq ft</div>
				</div>
				<div class="clear"></div>
				
				<div style="width: 100%;float:left;">
					<div style="float:left;width: 30%;padding:3px;font-weight:bold;"><?php echo CHtml::activeLabel($modelPropertyShow,'pool');?>: </div>
					<div style="float:left;width: 65%;padding:3px;"><?php if($data['pool'] == 1)echo 'YES';else echo 'NO';?></div>
				</div>
				
			</div>
		</div>
	</div>
 </div>	
  <?php if($data['mrt_status'] == 0){ ?>
	<div style="float:right;width: 100%;background: #F7F7F7;text-align:right;border-bottom:1px solid #cccccc;padding:7px 0;margin-top:10px;">
		<a href="/user/editproperty?pid=<?php echo $data['property_id']; ?>">Edit</a> &nbsp;&nbsp;
		<a href="/user/closeproperty?pid=<?php echo $data['property_id']; ?>">Close</a>
		&nbsp;&nbsp;&nbsp;&nbsp;
	</div>
	<?php }?>			
</div>

