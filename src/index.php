
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

	<title>SoundBox</title>
	  <link rel="stylesheet" type="text/css" href="css/style.css">
	  <link href="https://fonts.googleapis.com/css?family=Biryani" rel="stylesheet">

  <style type='text/css'>
    ul { list-style: none; }
    #recordingslist audio { display: block; margin-bottom: 10px; }
  </style>
  
  
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>

</head>
<body>

  <div id="mainTitle"><h1>Soundbox</h1></div>

  <div id="detectBox">
  <h1>Detect Song</h1>

  <button id = "start" onclick="startRecording(this);">Detect Song</button>

  
  <h2>Recently Identified Songs</h2>
  <ul id="recordingslist"></ul>
  
  <h2>Log</h2>
  <pre id="log"></pre>

  <script>
  function __log(e, data) {
    log.innerHTML += "\n" + e + " " + (data || '');
  }

  var audio_context;
  var recorder;
  var musicPlaying = false;
  

  function startUserMedia(stream) {
    var input = audio_context.createMediaStreamSource(stream);
    __log('Media stream created.');
    
  
    recorder = new Recorder(input);
    __log('Recorder initialised.');
  }

  function startRecording(button) {
    recorder && recorder.record();
    button.disabled = true;
    button.nextElementSibling.disabled = false;
  
    __log('Recording...');
    
    setTimeout(stopRecording, 9000);
    console.log("After five seconds");
  }
  
  function stopRecording()
  {
    recorder && recorder.stop();
    var button = document.getElementById("start");
    button.disabled = false;
    //button.previousElementSibling.disabled = false;
      createDownloadLink();
      uploadAudio();
    
    recorder.clear();
  }
  
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
          __log("Title: " + data['title']);
          __log("Youtube link: " + data['audio_link']);
        },    
        error: function(data) {
          console.log("There was an error with ajax call!");
          
        }
      });	 
  	    
  	  }, "audio/mp3");
      
  	}


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
      li.appendChild(au);
      li.appendChild(hf);
      recordingslist.appendChild(li);
      
      
    }, "audio/mp3");
    
  
  }

  window.onload = function init() {
    try {
      // webkit shim
      window.AudioContext = window.AudioContext || window.webkitAudioContext;
      navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia;
      window.URL = window.URL || window.webkitURL;
      
      audio_context = new AudioContext;
      __log('Audio context set up.');
      __log('navigator.getUserMedia ' + (navigator.getUserMedia ? 'available.' : 'not present!'));
    } catch (e) {
      alert('No web audio support in this browser!');
    }
    
    navigator.getUserMedia({audio: true}, startUserMedia, function(e) {
      __log('No live audio input: ' + e);
    });
  };
  
  </script>

  <script src="js/recorder.js"></script>
  
  
  </div>
</body>
