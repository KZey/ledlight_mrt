<div class="view" style="width:100%;height:160px;margin-top:0px;border:0px solid #ccccff;">
	<div style="float:left;">
		<a href="/property/<?php echo $data['property_id']; ?>">
			<img src="/upload/property/<?php echo $data['logo']; ?>" width=200 height=170 style="padding:3px;border:1px solid #cccccc;" /></a>
	</div>
	<div style="width: 70%;float:right;height:156px;">
		<div style="width: 100%;background:#99cc66;height:40px;">
			<div style="padding:10px;font-size:16px;float:left;width:85%;"><a href="/property/<?php echo $data['property_id']; ?>" style="font-weight:bold;color:#fff;">
			<?php echo CHtml::encode($data['title']); ?></a></div>
			<div style="width:7%;float:right;"><img src="/images/white_zero.png" border=0 /></div>
		</div>
		<div style="width: 100%;margin-top:10px;">
			<div style="width: 100%;float:left;">
				<div style="float:left;width: 30%;font-weight:bold;background:#f9f2f2;">Price: </div>
				<div style="float:left;width: 70%;color:green;background:#f9f2f2;">$ <?php echo number_format($data['price']);?></div>
				
				<div style="float:left;width: 30%;font-weight:bold;">beds: </div>
				<div style="float:left;width: 70%;color:green;"><?php echo $data['beds'];?></div>
				
				<div style="float:left;width: 30%;font-weight:bold;background:#f9f2f2;">baths: </div>
				<div style="float:left;width: 70%;color:green;background:#f9f2f2;"><?php echo $data['baths'];?></div>
				
				<div style="float:left;width: 30%;font-weight:bold;">house_size: </div>
				<div style="float:left;width: 70%;color:green"><?php echo $data['house_size'];?></div>
				
				<div style="float:left;width: 30%;font-weight:bold;background:#f9f2f2;">lot_size: </div>
				<div style="float:left;width: 70%;color:green;background:#f9f2f2;"><?php echo $data['lot_size'];?></div>
				
				<div style="float:left;width: 30%;font-weight:bold;">pool: </div>
				<div style="float:left;width: 70%;color:green"><?php echo $data['pool'];?></div>
				
				<div style="float:right;width: 50%;border:0px solid #ccccff;text-align:right;margin-right:10px;">
					<a href="/user/editproperty?pid=<?php echo $data['property_id']; ?>">Edit</a> &nbsp;&nbsp;
					<a href="javascript:void(0);" onclick="closeproperty(<?php echo $data['property_id']; ?>)">Closed</a>&nbsp;&nbsp;&nbsp;&nbsp;
					<a href="javascript:void(0);" onclick="deleteproperty(<?php echo $data['property_id']; ?>)">Delete</a>
				</div>
			</div>
		</div>
	</div>
</div>

 