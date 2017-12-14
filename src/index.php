
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

	<title>SoundBox</title>
	 
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Biryani" rel="stylesheet">
	<link rel="shortcut icon" href="http://abardie.com/wp-content/uploads/2017/02/JBL-Charge2-Subwoofer-Best-Portable-Bluetooth-Speaker-Abardie-1-600x400.jpg" />
  
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="js/recorder.js"></script>

</head>
<body>

  <!--title-->
  <div id="mainTitle"><h1>SoundBox</h1></div>

  <!--information and button container-->
  <div id="detectBox">
  
    <!--button to begin song detection-->
    <button id = "start" onclick="startRecording(this);">Detect Song</button><br></br>
    
    <!--song information appears when song has been detected-->
    <!--title-->
    <h3 id="songInfoHeader" style="display:none"><strong><u>Song Information</u></strong></h3><br></br>
    
    <!--song information-->
    <div id="songInfoBlock">
      
      <!--artist-->
      <h4 id="artistHeader" style="display:none">Artist:</h4>
      <div id="artistDiv"></div><br>
      
      <!--title-->
      <h4 id="titleHeader" style="display:none">Title:</h4>
      <div id="titleDiv"></div><br>
      
      <!--recommendations-->
      <h4 id="recommendationsHeader" style="display:none">Recommended Artist:</h4>
      <div id="recommendationsDiv"></div><br>
      
    </div>
    
    <!--download links-->
    <pre id="downloadLinks"></pre>
    
    <!--recording details-->
    <pre id="log"></pre>
  
    <!--loading gif-->
    <div id = "loadDiv" style="display:none"><img id ="loading" src = "img/ellipsis.gif"></div><br>
    
    <!--link to heroku chat application-->
    <a href="https://ancient-beach-64449.herokuapp.com/"><strong>Live Chat!</strong></a>
    
    
    <script>
      
      var audio_context;
      var recorder;
      var musicPlaying = false;
    
      // __Log -----------------------------------------------------------------
      function __log(e, data) {
        log.innerHTML += "\n" + e + " " + (data || '');
      }
    
      // startUserMedia --------------------------------------------------------
      function startUserMedia(stream) {
        var input = audio_context.createMediaStreamSource(stream);
        recorder = new Recorder(input);
      }
    
      // startRecording --------------------------------------------------------
      function startRecording(button) {
        recorder && recorder.record();
        button.disabled = true;
        button.nextElementSibling.disabled = false;
      
        __log('<p><hr width="60%">Capturing Audio...');
        
        document.getElementById("loadDiv").style.display="block";
        setTimeout("hide()", 9000);
    
        setTimeout(stopRecording, 9000);
        console.log("After five seconds");
      }
      
      // hide ------------------------------------------------------------------
      function hide() 
      {
        document.getElementById("loadDiv").style.display="none";
        __log('Audio Captured');
        
        //displaySongInfo();
      }
      
      // stopRecording ---------------------------------------------------------
      function stopRecording()
      {
        recorder && recorder.stop();
        var button = document.getElementById("start");
        button.disabled = false;
          createDownloadLink();
          uploadAudio();
        recorder.clear();
      }
      
      // uploadAudio -----------------------------------------------------------
    	function uploadAudio()
    	{
      	  recorder && recorder.exportWAV(function(blob)
      	  {
        	  var url = (window.URL || window.webkitURL).createObjectURL(blob);
            console.log("url created in uploadAudio(): " + url);
      
            var rawData = new FormData();
            rawData.append('file', blob);
      
            $.ajax({
              url :  "upload.php",
              type: 'POST',
              data: rawData,
              contentType: false,
              processData: false,
              success: function(data) {
                console.log(data);
                displaySongInfo(data['artists'],data['title'], data['recommendation_list']);
              },    
              error: function(data) {
                console.log("There was an error with ajax call!");
                
              }
            });	 
      	    
      	  }, "audio/mp3");
          
      	}
      
      // createDownloadLink ----------------------------------------------------
      function createDownloadLink() {
        recorder && recorder.exportWAV(function(blob) {
          var url = URL.createObjectURL(blob);
          var li = document.createElement('li');
          var au = document.createElement('audio');
          var hf = document.createElement('a');
        
          au.controls = true;
          au.src = url;
          hf.href = url;
          hf.download = new Date().toISOString() + '.mp3';
          hf.innerHTML = hf.download;
          
          // link to download song
          li.appendChild(hf);
          downloadLinks.appendChild(li);
          
        }, "audio/mp3");
        
      }
    
      // window.onload ---------------------------------------------------------
      window.onload = function init() {
        try {
          // webkit shim
          window.AudioContext = window.AudioContext || window.webkitAudioContext;
          navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia;
          window.URL = window.URL || window.webkitURL;
          
          audio_context = new AudioContext;
        } 
        catch (e) {
          alert('No web audio support in this browser!');
        }
        
        navigator.getUserMedia({audio: true}, startUserMedia, function(e) {
          __log('No live audio input: ' + e);
        });
      };
    
      // displaySongInfo -------------------------------------------------------
      function displaySongInfo(artist, title, recommendations){
        
        // display song info
        document.getElementById("songInfoHeader").style.display="initial";
        document.getElementById("artistHeader").style.display="initial";
        document.getElementById("titleHeader").style.display="initial";
        document.getElementById("recommendationsHeader").style.display="initial";
        
        // artist
        document.getElementById("artistDiv").style.visibility="visible";
        var div = document.getElementById('artistDiv');
        div.innerHTML = artist;
        
        // title
        document.getElementById("titleDiv").style.visibility="visible";
        var div = document.getElementById('titleDiv');
        div.innerHTML = title;
        
        // reccomendations
        document.getElementById("recommendationsDiv").style.visibility="visible";
        var div = document.getElementById('recommendationsDiv');
        div.innerHTML = recommendations;
        
      }
    
    </script>
  
    
    
    
  </div>
</body>
