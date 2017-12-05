<?php

    require __DIR__ . "/src/YoutubeAudioLink.php";
    
    $audioLink = new YoutubeAudioLink();
    
    echo $audioLink->getAudioLink('https://www.youtube.com/watch?v=2VjFxuIiqRo') . '<br>';
    //var_dump($audioLink->getVidInfo());
    echo $audioLink->getYoutubePlayerVideo();
    echo "<br>";
    echo $audioLink->getAudioBySearching('thor ragnarok soundtrack');
    echo $audioLink->getYoutubePlayerVideo();
    echo "<br>"; 



    echo system('./DwnAudioMp3');
/** ------------------------------------------
 *  Function Usage
 *  ------------------------------------------
 */
//$bytes = downloadFile(shell_exec("youtube-dl --add-metadata --extract-audio --audio-format mp3 --audio-quality 0 https://www.youtube.com/watch?v=mASbK1ZYwKw"), 'thorragnarok.mp3');


