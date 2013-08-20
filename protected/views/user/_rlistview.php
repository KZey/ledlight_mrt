
<div  style="width:98%;overflow:hidden;padding-top:50px;">
	<div style="width: 80px;float:left;">
		<a href="/index.php/user/rotherview?uid=<?php echo $data->uid; ?>">
			<img src="/upload/user_logo/<?php echo CHtml::encode($data->logo); ?>" style="border:5px solid #fff;" width=60 height=60 /></a>
	</div>
	<div style="width: 88%;float:left;border:0px solid red;">
		<div style="width: 100%;">
			<a href="/index.php/user/rotherview?uid=<?php echo $data->uid; ?>" style="font-weight:bold;color:#336699;text-decoration:underline">
			<?php echo CHtml::encode($data->first_name).' '.CHtml::encode($data->last_name); ?></a>
		</div>
		<div style="width: 100%;margin-top:10px;">
			<div style="width: 100%;float:left;color:#666666">
				<div style="float:left;width: 40%;">Email: <?php echo $data->email;?></div>
				<div style="float:left;width: 30%;">Office: <?php echo $data->office;?></div>
				<div style="float:left;width: 30%;">Mobile: <?php echo $data->mobile;?></div>
				
				<div style="float:left;width: 40%;">Location: <?php echo $data->city;if(!empty($data->city))echo ', ';echo $data->state;?></div>
				<div style="float:left;width: 30%;">Team: <?php echo $data->team;?></div>
				<div style="float:left;width: 30%;">Brokerage: <?php echo $data->broker;?></div>
			</div>
		</div>
	</div>
</div>
<div style="border-bottom:1px dotted #cccccc;margin:15px 0;"></div>
 
