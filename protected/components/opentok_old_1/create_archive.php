<?php
	require_once 'OpenTok.php';
	$apiKey = OpenTok::getApiKey();
	$sessionId = OpenTok::getSessionId();
	$token = OpenTok::getToken(3);
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
  <title>OpenTok Getting Started</title>
  <script src="http://staging.tokbox.com/v0.91/js/TB.min.js"></script>
  <script src="json.js"></script>
  <script type="text/javascript">
    var apiKey = '<?php echo $apiKey;?>';
    var sessionId = '<?php echo $sessionId;?>';
    var token = '<?php echo $token;?>';        
	var token = 'devtoken';     

  	var archive="";
	var archiveId="";
	TB.setLogLevel(5);
  </script>
</head>
<body>
	<div style="margin:0 auto;width:90%;border:1px solid green;padding:5px;">
		<div style="padding:10px;margin-top:0;width:20%;height:300px;float:left;border-right:1px solid green;" id="all"></div>
		<div id="myPublisherDiv" style="height:300px;padding:10px 30px;width:70%;float:left;border:1px solid #000;"></div>
		
		<input type="text" id="archiveIdDiv" width=200 />
		
		<div style="clear:both;"></div>
		<br/><br/><br/><br/><br/><br/>
		&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="buttonArchiveCreate();">createArchive</a>
		&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="buttonStartRecording(archive);">StartRecording</a>
		&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="buttonStopRecording(archive);">StopRecording</a>
		&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="startPlayback();">startPlayback</a>
		&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="stopPlayback();">stopPlayback</a>
		&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="closeArchive();">closeArchive</a>
		&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="session.disconnect();">disconnect</a>
		
	</div>
	
	<script>
	TB.addEventListener("exception", exceptionHandler);
	
	var session = TB.initSession(sessionId);      
    session.addEventListener('sessionConnected', sessionConnectedHandler);
    session.addEventListener('streamCreated', streamCreatedHandler);      
	session.addEventListener('archiveCreated',archiveCreatedHandler);
	session.addEventListener("sessionDisconnected", sessionDisconnectHandler);
	session.addEventListener("sessionRecordingStarted", sessionRecordingStartedHandler);
	session.addEventListener("sessionRecordingStopped", sessionRecordingStoppedHandler);
	session.addEventListener("archiveLoaded", archiveLoadedHandler);
	session.addEventListener("playbackStarted", playbackStartedHandler);
	session.addEventListener("playbackStopped", playbackStoppedHandler);
	 
    session.connect(apiKey, token);  
  
    var publisher;

	 
	
	
/* Called in response to the moderator clicking the "Start playback" link.
* Starts playing back the archive.
*/
function startPlayback() {
alert('loadArchive:'+archiveId);
session.loadArchive(archiveId);
alert('11111');
archive.startPlayback();
alert('222');
}

// Called in response to the playbackStarted event. The moderator can now (optionally) stop playing back the archive.
function playbackStartedHandler(event) {
//show("stopPlaybackLink");
}

/* Called in response to the moderator clicking the "Stop playback" link.
* Stops playing back the archive.
*/
function stopPlayback() {
archive.stopPlayback();
}

// Called in response to the playbackStopped event. The moderator can now (optionally) play back the archive again.
function playbackStoppedHandler(event) {
//hide("stopPlaybackLink");
//show("startPlaybackLink");
}
	
	
	
	
	
	function buttonPlayBack()
	{
		alert('buttonPlayBack');
		session.loadArchive(archiveId);
	}
	function buttonStartRecording(archive)
	{
		alert('buttonStartRecording');
		session.startRecording(archive);
	}
	
	function buttonStopRecording(archive)
	{
		alert('buttonStopRecording');
		session.stopRecording(archive);
	}
	
	function buttonArchiveCreate()
	{
		alert('buttonArchiveCreate');
		var uniqueTitle = "archive" + new Date().getTime();
		session.createArchive(apiKey,'perSession',uniqueTitle);
	}
	function archiveLoadedHandler(event) {
		alert("archiveLoadedHandler");
		loadedArchive = event.archives[0];
		loadedArchive.startPlayback();
		alert("archiveLoadedHandler");
		
	}
	function closeArchive() {
		session.closeArchive(archive);
		alert("closeArchiveLink");
	}

	// Called in response to the archiveClosed event. The moderator can now load the archive (and play it back).
	function archiveClosedHandler(event) {
		alert("archiveClosedHandler");
	}
 	function sessionRecordingStartedHandler(event) {
		//event.preventDefault();
		alert('sessionRecordingStartedHandler');
		alert(event.type);
		
	}
	 function sessionRecordingStoppedHandler(event) {
		//event.preventDefault();
		alert('sessionRecordingStoppedHandler');
		alert(event.type);
	}
	
	function sessionDisconnectHandler(sessionDisconnectEvent) {
		//event.preventDefault();
		alert('sessionDisconnectEvent');
		session.cleanup();
	}

	function archiveCreatedHandler(event)
	{
		alert('archiveCreatedHandler');
		//alert(event.type);
		
		archive = event.archives[0];
		
		archiveId = archive.archiveId;
		alert(archiveId);
		//alert(archive.type);
		
		alert(archive.toJSONString());
	}
 
    function sessionConnectedHandler(event) {
		if (event.archives && event.archives.length > 0)
		{
			alert("There is already an archive! Archive ID: " + event.archives[0].archiveId);
		}
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
	  
	  var mycapabilities = session.capabilities;
	  alert(mycapabilities.toJSONString());
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
	
	function exceptionHandler(event) {
		alert("Exception: " + event.code + "::" + event.message);
	}
	</script>
</body>
</html>