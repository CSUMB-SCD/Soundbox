<?php

session_start();

$_SESSION["dirCreated"] = false;

class ACRCloud{
    
    private $apiResponse;
    private $spotifyData;
    private $youtubeData;
    private $song;
    
    
    public function __construct() {
            $this-> apiResponse = "";
            $this -> spotifyData  = "";
            $this -> youtubeData = "";
            $this -> song = "";
        }
    
    
    public function generateSong()
    {
        var_dump($_POST);
        if(!is_dir("recordings"))
        {
    	    $res = mkdir("recordings",0777); 
    	    echo "recordings directory was created<br>";
    	    $_SESSION["dirCreated"] = true;
        }
        else{
            echo "recodings directory created? = " . $_SESSION["dirCreated"];
        }
    	    
    	 if(isset($_FILES['file']))
    	 {
    	     echo "file was uploaded to server<br>";
    	 }
    	 
    	 if($_FILES['file']['error'])
    	 {
    	     echo "there is an error in the file<br>";
    	 }
    	 
        
        var_dump($_FILES);

        
        if(isset($_FILES['file']) and !$_FILES['file']['error'])
        {
            $this -> song = "song.mp3";
            move_uploaded_file($_FILES['file']['tmp_name'], "recordings/" . $this -> song);
            
            return true;
        }
        
        else
        {
            echo "There was a problem with generating song.<br><br>";
            return false;   
        }
        

    }
    
    public function makeAPICall()
    {
        $command = escapeshellcmd("python /home/ubuntu/workspace/ACRCloud/linux/x86-64/python2.7/test.py recordings/" . $this -> song);
        $output = shell_exec($command);
        unlink("recordings/" . $this -> song);
       

        $string = str_replace('\n', '', $output);
        $string = str_replace('\"', '', $output);
        
        echo $string;
    
        $this -> apiResponse = json_decode($string, true);
        
        $array = array_values($this -> apiResponse);
        
        $this -> spotifyData = $array[1]["music"][0]['external_metadata']['spotify'];

        $this -> youtubeData = $array[1]["music"][0]['external_metadata']['youtube'];

    }
    
    public function getAPIResponse()
    {
        return $this -> apiResponse;
    }
        
    public function getSpotifyData()
    {
        return $this -> spotifyData;
    }
    
    public function getYoutubeData()
    {
        return $this -> youtubeData;
    }
    
    public function setSpotifyData($name)
    {
        $this -> spotifyData = $name;
    }
    
}

?>