<?php 
//echo "IT IS HERE!!";
session_start();
$song;
if(!is_dir("recordings")){
	$res = mkdir("recordings",0777); 
//	echo "made new recording directory<br><br>";
}

if(isset($_FILES['file']) and !$_FILES['file']['error']){
    $song = "song.mp3";

    move_uploaded_file($_FILES['file']['tmp_name'], "recordings/" . $song);
   // echo"moved the song succesfully<br>";
}

//$command = escapeshellcmd(" python /home/ubuntu/workspace/ACRCloud/linux/x86-64/python2.7/test.py recordings/" . $song);
//$output = shell_exec($command);

header("Access-Control-Allow-Origin: *");
//header("Content-type: application/json");

//echo $output;
 $_SESSION['json'] = $output;
 
 unlink("recordings/" . $song);


if(!empty($output) || $output != NULL)
    $_SESSION['json'] =$output;
    
else {
   $_SESSION['json'] = "{\"status\":{\"msg\":\"Success\",\"code\":0,\"version\":\"1.0\"},\"metadata\":{\"music\":[{\"external_ids\"
   :{\"isrc\":\"USUM71606079\",\"upc\":\"602557080148\"},\"play_offset_ms\":13660,\"external_metadata\":{\"spotify\":{\"album\":{\"
   name\":\"Illuminate (Deluxe)\",\"id\":\"0S9QJQiRmG9JYYfJfKqhDF\"},\"artists\":[{\"name\":\"Shawn Mendes\",\"id\":\"7n2wHs1TKAczGzO7Dd2rGr\"}],\"
   track\":{\"name\":\"Roses\",\"id\":\"6xiVsK5u3Ke4guuMfJbETq\"}},\"youtube\":{\"vid\":\"8RhAP0fG2y0\"},\"deezer\":{\"album\":{\"name\":\"
   Illuminate (Deluxe)\",\"id\":\"14101012\"},\"artists\":[{\"name\":\"Shawn Mendes\",\"id\":\"5962948\"}],\"track\":{\"name\":\"Roses\",\"id\":\"
   132625750\"}}},\"title\":\"Roses\",\"release_date\":\"2016-09-23\",\"artists\":[{\"name\":\"Shawn Mendes\"}],\"label\":\"Universal Music\",\"
   duration_ms\":232000,\"album\":{\"name\":\"Illuminate (Deluxe)\"},\"acrid\":\"849aa7fdb1ccdc775401891292c6edc4\",\"result_from\":3,\"score\"
   :100}],\"timestamp_utc\":\"2017-11-01 21:52:45\"},\"result_type\":3}\n\n";
}



$string = str_replace('\n', '', $_SESSION['json']);
$string = str_replace('\"', '', $_SESSION['json']);

echo $string;
//echo json_decode($string, true);
$_SESSION['json'] = json_decode($string, true);
//echo "last error: " . json_last_error() . "<br><br>";
//echo  "last error message: " . json_last_error_msg() ."<br><br>";
//var_dump($_SESSION['json']);

$array = array_values($_SESSION['json']);
//print_r(array_values($_SESSION['json']));

$spotify = $array[1]["music"][0]['external_metadata']['spotify'];

//print_r($spotify);

$youtube = $array[1]["music"][0]['external_metadata']['youtube'];
//print_r($youtube);


?>