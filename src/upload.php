<?php
    include("ACRCloud.php");
    
    //instantiate object
    $acr = new ACRCloud();
    
    //if song was generated succesful, make api call
    if($acr -> generateSong())
        $acr -> makeAPICall(); 
        
    //display spotify data
    echo "spotify data: ";
    print_r($acr -> getSpotifyData());
   
   
   //display youtube data
   echo"youtube data: ";
    print_r($acr -> getYoutubeData());     
    //$acr -> setSpotifyData("Hello world");
    
    //echo $acr -> getSpotifyData();
    
?>