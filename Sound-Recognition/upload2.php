<?php
    include("ACRCloud.php");
    
    $acr = new ACRCloud();
    
    if($acr -> generateSong())
        $acr -> makeAPICall(); 
        
    
    print_r($acr -> getSpotifyData());
   
    print_r($acr -> getYoutubeData());     
    //$acr -> setSpotifyData("Hello world");
    
    //echo $acr -> getSpotifyData();
    
?>