<?php 
	$url_otherview = 'cotherview';
	if($data['type']==2)$url_otherview = 'rotherview';
// 	echo '<br/>from_uid=='.$data['from_uid'];
// 	echo '<br/>seesion_uid=='.Yii::app()->user->id;
?>
<?php //if($data['type'] == 1 && $data['from_uid'] != Yii::app()->user->id){?>
<div class="" style="width:100%;border:0px solid #ccccff;margin:5px 0 0 5px;;overflow:hidden">
	<div style="float:left;width: 60px;height:60px;float:left;border:0px solid #ccccff;">
		<?php if($data['from_uid']!=Yii::app()->user->id){?>
				<a href="/user/<?php echo $url_otherview;?>?uid=<?php echo $data['from_uid']; ?>">
				<img src="/upload/user_logo/<?php echo CHtml::encode($data['logo']); ?>" width=50 height=50 /></a>
				<?php }?>
	</div>
	<div class="" style="float:left;width:80%;border:1px solid #ccccff;">
		
		<div style="width: 95%;float:left;border:0px solid #ccccff;padding:10px;">
			<div style="width: 100%;">
				
				<?php 
					if($data['from_uid']==Yii::app()->user->id)
					{
						echo '<span style="font-weight:bold;color:#000000;">Me</span>';
					}else{
				?>
				<a href="/user/<?php echo $url_otherview;?>?uid=<?php echo $data['from_uid']; ?>" style="font-weight:bold;">
				<?php echo CHtml::encode($data['first_name']).' '.CHtml::encode($data['last_name']);
					}
				 ?>: </a>
				<?php 
					if(!empty($data['title']))echo CHtml::encode($data['title']).'.&nbsp;';
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
			</div>
		</div>
	</div>
	<div style="float:left;width: 60px;height:60px;float:left;border:0px solid #ccccff;margin-left:10px;">
		<?php if($data['from_uid']==Yii::app()->user->id){?>
				<a href="/user/<?php echo $url_otherview;?>?uid=<?php echo $data['from_uid']; ?>">
				<img src="/upload/user_logo/<?php echo CHtml::encode($data['logo']); ?>" width=50 height=50 /></a>
				<?php }?>
	</div>
</div>
<div class="clear"></div>
<?php //}else{echo 1;}?>