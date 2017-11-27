<?php


    echo "Hello World";
    
    $output = shell_exec('youtube-dl -x --audio-format mp3 https://www.youtube.com/watch?v=8QxtIQ1F1ig');
    echo "<pre>$output</pre>";
    echo getcwd();
    echo "<h1>Finished</h1>";

?>