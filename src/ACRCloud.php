<?php

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
        if(!is_dir("recordings"))
    	    $res = mkdir("recordings",0777); 
    	    
    	 if(isset($_FILES['file']))
    	 {
    	     echo "file was uploaded to server<br>";
    	 }
    	 
    	 if($_FILES['file']['error'])
    	 {
    	     echo "there is error in the file<br>";
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
            
            echo "last error: " . json_last_error() . "<br><br>";
             echo  "last error message: " . json_last_error_msg() ."<br><br>";
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