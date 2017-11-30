<?php

//session is just for debuggin purposes
session_start();

//boolean to check if directory for song to be stored if it was created succesfully
$_SESSION["dirCreated"] = false;

class ACRCloud{
    
    //class attributes
    private $apiResponse;
    private $spotifyData;
    private $youtubeData;
    private $song;
    
    //default constructor
    public function __construct() {
            $this-> apiResponse = "";
            $this -> spotifyData  = "";
            $this -> youtubeData = "";
            $this -> song = "";
        }
    
    //this function  will get song send from the client
    public function generateSong()
    {
        //if no directory 'recordings' is present it will create it.
        //this is used for debuggin if heroku can create directory dynamically
        if(!is_dir("recordings"))
        {
            //creating dir and changing permissions
    	    $res = mkdir("recordings",0777); 
    	    echo "recordings directory was created<br>";
    	    $_SESSION["dirCreated"] = true;
        }
    	    
    	 //if file was uploaded to server
    	 if(isset($_FILES['file']))
    	 {
    	     echo "file was uploaded to server<br>";
    	 }
    	 
    	 //check to see if there is an error in file
    	 if($_FILES['file']['error'])
    	 {
    	     echo "there is an error in the file<br>";
    	 }
    	 
        
        //display all information of FILE array
        var_dump($_FILES);
        //ini_set('upload_tmp_dir','/home/ubuntu/workspace/src/uploadFolder'); 
        
        //echo "TEMP DIR: ". sys_get_temp_dir(). "<br>";
        //var_dump($_POST);

        //if there is no error and file is present
        if(isset($_FILES['file']) and !$_FILES['file']['error'])
        {
            //attribute variable is assigned to song.mp3
            $this -> song = "song.mp3";
            
            //move the song.mp3 file to the recordings directory.
            move_uploaded_file($_FILES['file']['tmp_name'], "recordings/" . $this -> song);
            
            //return true meaning succesful
            return true;
        }
        
        //if there was an error display an error message and return false
        else
        {
            echo "There was a problem with generating song.<br><br>";
            return false;   
        }
        

    }
    
    //this function will make the api call to get metadata of song
    public function makeAPICall()
    {
        //prepare bash shell command through shell through php acr functions and song attribute as an argument
        $command = escapeshellcmd("python ACRCloudPy/linux/x86-64/python2.7/test.py recordings/" . $this -> song);
        //echo "command is: ". $command;
        
        //execute command
        $output = shell_exec($command);
        
        //system("python ACRCloudPy/linux/x86-64/python2.7/test.py recordings/" . $this -> song, $return_value); //shell_exec($command);
        
        //after execute command remove song from recordings directory to allow multiple requests from different people
        unlink("recordings/" . $this -> song);
        
       

        //remove new line characters and backlashes from api response to decode into json and split into array format
        $string = str_replace('\n', '', $output);
        $string = str_replace('\"', '', $output);
        
        //display api response to console
        echo $string;
    
        //convert string into a json format
        $this -> apiResponse = json_decode($string, true);
        
        //breakdown json format into array to obtain values by indexing
        $array = array_values($this -> apiResponse);
        
        //store spotify data
        $this -> spotifyData = $array[1]["music"][0]['external_metadata']['spotify'];

        //store youtubeData
        $this -> youtubeData = $array[1]["music"][0]['external_metadata']['youtube'];

    }
    
    //get full response from api
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