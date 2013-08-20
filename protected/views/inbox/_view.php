<?php 
	$url_otherview = 'cotherview';
	if($data['to_type']==2)$url_otherview = 'rotherview';
	$detail_uid=$data['from_uid'];
	if($data['from_uid'] == Yii::app()->user->id)$detail_uid=$data['to_uid'];
?>
<div style="width:99%;height:100%;border:1px solid #ccccff;overflow:hidden;padding:6px;">
	<div style="width: 80px;float:left;">
		<a href="/user/<?php echo $url_otherview;?>?uid=<?php echo $data['from_uid']; ?>">
			<img src="/upload/user_logo/<?php echo CHtml::encode($data['to_logo']); ?>" width=50 height=50 /></a>
	</div>
	<div style="width: 88%;float:left;border:0px solid red;">
		<div style="width: 100%;">
			<a href="/user/<?php if($data['from_type']==2)echo 'rotherview';?>?uid=<?php echo $data['from_uid']; ?>" style="font-weight:bold;color:#000000;">
				<?php 
					if($data['from_uid'] != Yii::app()->user->id)
						echo CHtml::encode($data['from_first_name']).' '.CHtml::encode($data['from_last_name']); 
					else
						echo 'Me';
				?>
			</a>
			&nbsp;To&nbsp;
			<a href="/user/<?php if($data['to_type']==2)echo 'rotherview';?>?uid=<?php echo $data['to_uid']; ?>" style="font-weight:bold;color:#000000;">
				<?php 
					if($data['to_uid'] != Yii::app()->user->id)
						echo CHtml::encode($data['to_first_name']).' '.CHtml::encode($data['to_last_name']); 
					else
						echo 'Me';
				?>
			</a>
			<br/>
			<?php 
				echo $data['content']; 
				$from_uid = $data['from_uid'];
				if($data['type'] == 1 && $data['to_uid'] == Yii::app()->user->id)
				{
					$accept = '<input type=button id="button_yes" name="button_yes" value="Yes" onclick="invite_yes('.$from_uid.')" />';
					echo '<br/><br/><p style="color:gray">MyRealTour Tips: Would you like to send this user an invitation to connect with you on MyRealTour? '.$accept;
				}
			?>
		</div>
		<div style="width: 100%;margin-top:10px;">
			<div style="width: 50%;float:left;color:#63B8FF"><?php echo $data['date']; ?></div>
			<div style="width: 50%;float:right;text-align:right;">
				<a href="/inbox/detail?uid=<?php echo $detail_uid; ?>"><?php echo $data['num']; ?> Messages in total</a></div>
		</div>
	</div>
	<div style="width: 10px;height: 10px;float:right;text-align:center;border:0px solid #ccccff;cursor:pointer;"
		 onclick="del_msg(<?php echo $detail_uid; ?>)">
		<img src="/images/del.png" />
	</div>
</div>
<br/>
