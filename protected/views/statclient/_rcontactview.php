
<div style="width:97%;margin-top:0px;">
	<div style="width: 80px;float:left;">
		<a href="/user/cotherview?uid=<?php echo $data['uid']; ?>">
			<img src="/upload/user_logo/<?php echo CHtml::encode($data['logo']); ?>" width=60 height=60 /></a>
	</div>
	<div style="width: 88%;float:left;border:0px solid red;">
		<div style="width: 100%;">
			<a href="/user/cotherview?uid=<?php echo $data['uid']; ?>" style="font-weight:bold;color:#000000;">
			<?php echo CHtml::encode($data['first_name']).' '.CHtml::encode($data['last_name']); ?></a>
		</div>
		<div style="width: 100%;margin-top:10px;">
			<div style="width: 100%;float:left;color:#63B8FF">
				<div style="float:left;width: 45%;">Email: <?php echo $data['email'];?></div>
				<div style="float:left;">Referral Type: <?php echo Contact::itemAlias('referral_type',$data['referral_type']);?></div>
				<div style="float:right;">Finacning Type: <?php echo Contact::itemAlias('finacning_type',$data['finacning_type']);?></div>
				<!-- 
				<div style="float:left;">Expenses: 
					<?php echo $data['advertising'] > 0 ? 'Advertising' : '' ;?>
					<?php echo $data['gas'] > 0 ? ' Gas' : '' ;?>
					<?php echo $data['meals'] > 0 ? ' Meals' : '' ;?>
					<?php echo $data['others'] > 0 ? ' Others' : '' ;?>
				</div>
				 -->
				<div style="float:left;width: 25%;">Advertising: $ <?php echo number_format($data['advertising']);?></div>
				<div style="float:left;width: 25%;">Gas: $ <?php echo number_format($data['gas']);?></div>
				<div style="float:left;width: 25%;">Meals: $ <?php echo number_format($data['meals']);?></div>
				<div style="float:left;width: 25%;">Others: $ <?php echo number_format($data['others']);?></div>
				
			</div>
		</div>
	</div>
</div>
<div class="clear"></div>
<div style="border-bottom:1px dotted #cccccc;margin:15px 0;"></div>
 