<?php
	require_once 'OpenTok.php';
	$apiKey=API_Config::API_KEY;
	
	$rs = OpenTok::getRS();
	
	$sessionId = $rs[0];
	$token = $rs[1];

?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
  <title>OpenTok Getting Started</title>
  <script src="http://static.opentok.com/v0.91/js/TB.min.js"></script>
 
  <script type="text/javascript">
    var apiKey = '<?php echo $apiKey;?>';
    var sessionId = '<?php echo $sessionId;?>';
    var token = '<?php echo $token;?>';        
	//var token = 'devtoken';        	
     
    TB.setLogLevel(TB.DEBUG);     
 
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
		var publisherProperties = {width: 300, height:200, name:"Willie's stream"};
		publisher = TB.initPublisher(apiKey, 'publisher', publisherProperties);
	
     // publisher = TB.initPublisher('myPublisherDiv');
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
			div.setAttribute('style', 'clear:both;margin:10px');
			document.getElementById('all').appendChild(div);
							   
			// Subscribe to the stream
			session.subscribe(streams[i], div.id);
		}
      }
    }
  </script>
</head>
 
<body>
	<div style="margin:0 auto;width:90%;border:0px solid green;padding:5px;">
		<div style="padding:10px;margin-top:0;width:20%;height:300px;float:left;border-right:0px solid green;" id="all"></div>

		<div id="myPublisherDiv" style="height:300px;padding:10px 30px;width:70%;float:left;border:0px solid #000;"></div>
	</div>
</body>
</html>