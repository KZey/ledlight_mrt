<?php 
$url = $data['type'] == 2 ?'rotherview':'cotherview';
?>
<div style="width:97%;margin-top:0px;">
	<div style="width: 80px;float:left;">
		<a href="/user/<?php echo $url;?>?uid=<?php echo $data['uid']; ?>">
			<img src="/upload/user_logo/<?php echo CHtml::encode($data['logo']); ?>" width=60 height=60 /></a>
	</div>
	<div style="width: 88%;float:left;border:0px solid red;">
		<div style="width: 100%;">
			<a href="/user/<?php echo $url;?>?uid=<?php echo $data['uid']; ?>" style="font-weight:bold;color:#000000;">
			<?php echo CHtml::encode($data['first_name']).' '.CHtml::encode($data['last_name']); ?></a>
		</div>
		<div style="width: 100%;margin-top:10px;">
			<div style="width: 100%;float:left;color:#63B8FF">
				<div style="float:left;width: 45%;">Email: <?php echo $data['email'];?></div>
				<div style="float:left;width: 25%;">Office: <?php echo $data['office'];?></div>
				<div style="float:left;width: 25%;">Mobile: <?php echo $data['mobile'];?></div>
				
				<div style="float:left;width: 45%;">Location: <?php echo $data['city'];if(!empty($data['city']))echo ', ';echo $data['state'];?></div>
				<div style="float:left;width: 25%;">Team: <?php echo $data['team'];?></div>
				<div style="float:left;width: 25%;">Brokerage: <?php echo $data['broker'];?></div>
			</div>
		</div>
	</div>
</div>
<div class="clear"></div>
<div style="border-bottom:1px dotted #cccccc;margin:15px 0;"></div>
 