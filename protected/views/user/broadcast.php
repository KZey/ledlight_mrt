<?php
$sessionid = $rs['sessionid'];
// $token = ($rs['create_uid'] == Yii::app()->user->id) ? $rs['create_token'] : $rs['push_token'];
$token = $rs['push_token'];
?>
<div style="border:0px solid red;width:950px;overflow:hidden;">

	<div class="menu_div">
		<div id="menu_dashboard" style="float:left;" class="menu_li_selected"><?php if(Yii::app()->user->type==1){?><img src="/images/menu_profile.png" /><?php }else{?><img src="/images/menu_dashboard.png" /><?php }?></div>
		<div id="menu_property" style="float:left;" class="menu_li_default"><img src="/images/menu_property.png" /></div>
		<div id="menu_realtor" style="float:left;" class="menu_li_default"><img src="/images/menu_realtor.png" /></div>
	</div>
	<div style="border:0px solid red;width:100%;overflow:hidden;margin:0 auto;margin-top:3px;z-index:1;">
		
		<div style="width:100%;overflow:hidden;margin:0 auto;">
			<div style="border:1px solid #C2C2C2;width:67%;overflow:hidden;margin:0 auto;">
				<div style="padding:5px 0 7px 10px;width:100%;border-bottom:1px solid #C2C2C2;background-image:url(/images/createproperty_title_bg.png);">
					<img src="/images/live_broadcast.png" />
				</div>
				<div style="border:0px solid red;overflow:hidden;padding:10px;width:100%;background:#F7F7F7;">
			<?php 
				if($error_tokbox_session==1)
				{
					echo Yii::t("PageJs","link_invild");			
				}
				else if($error_tokbox_session==2)
				{
					echo Yii::t("PageJs","not_invited");			
				}else{
			?>
			  <script src="http://static.opentok.com/v0.91/js/TB.min.js"></script>
			  <script type="text/javascript">
			    var apiKey = '<?php echo $apiKey;?>';
			    var sessionId = '<?php echo $sessionid;?>';
			    var token = '<?php echo $token;?>';
				//var token = 'devtoken';
			   // TB.setLogLevel(TB.DEBUG);
			 
			    var session = TB.initSession(sessionId);      
			    session.addEventListener('sessionConnected', sessionConnectedHandler);
			    session.addEventListener('streamCreated', streamCreatedHandler);      
			    session.connect(apiKey, token);
			 
			    var publisher;
			 
			    function sessionConnectedHandler(event) {
				
					var div = document.createElement('div');
					div.setAttribute('id', 'publisher');
					
					var publisherContainer = document.getElementById('myPublisherDiv');   
					publisherContainer.appendChild(div); 
					var publisherProperties = {width: 600, height:500, name:"<?php echo $model->first_name.' '.$model->last_name;?>"};
					publisher = TB.initPublisher(apiKey, 'publisher', publisherProperties);
			        session.publish(publisher);
			       
			      // Subscribe to streams that were in the session when we connected
			      subscribeToStreams(event.streams);
			    }
			     
			    function streamCreatedHandler(event) {
			      // Subscribe to any new streams that are created
			      subscribeToStreams(event.streams);
			    }
			     
			    function subscribeToStreams(streams) {
			      for (var i = 0; i < streams.length; i++) {
			        // Make sure we don't subscribe to ourself
			        if (streams[i].connection.connectionId != session.connection.connectionId) {
						// Create the div to put the subscriber element in to
						var div = document.createElement('div');
						div.setAttribute('id', 'stream' + streams[i].streamId);
						div.setAttribute('style', 'clear:both;margin:10px;');
						document.getElementById('all').appendChild(div);
						
						// Subscribe to the stream
						session.subscribe(streams[i], div.id,{width: 600, height:400});
					}
			      }
			    }
			  </script>
			<div id="myPublisherDiv" style="display:none;height:300px;padding:10px 30px;width:70%;float:left;border:0px solid #000;"></div>
			<div style="padding:10px;margin-top:0;float:left;border:0px solid green;" id="all"></div>
			<?php }?>
		
		</div>
			</div>
		</div>
		
	</div>
</div>