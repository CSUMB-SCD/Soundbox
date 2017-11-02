<?php
    include("ACRCloud.php");
    
    $acr = new ACRCloud();
    
    if($acr -> generateSong())
        $acr -> makeAPICall(); 
        
    echo "spotify data: ";
    print_r($acr -> getSpotifyData());
   
   echo"youtube data: ";
    print_r($acr -> getYoutubeData());     
    //$acr -> setSpotifyData("Hello world");
    
    //echo $acr -> getSpotifyData();
    
?>