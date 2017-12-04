<?php

    require __DIR__ . "/src/YoutubeAudioLink.php";
    
    $audioLink = new YoutubeAudioLink();
    
    echo $audioLink->getAudioLink('https://www.youtube.com/watch?v=yC9bCd1-btk') . '<br>';
    //var_dump($audioLink->getVidInfo());
    echo $audioLink->getYoutubePlayerVideo();
    echo "<br>";
    echo $audioLink->getAudioBySearching('thor ragnarok soundtrack');
    echo $audioLink->getYoutubePlayerVideo();
    
?>

