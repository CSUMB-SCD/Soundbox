<?php
    include("ACRCloud.php");
    
    //instantiate object
    $acr = new ACRCloud();
    
    //if song was generated succesfull, make api call
    if($acr -> generateSong())
        $acr -> makeAPICall(); 
    
?>