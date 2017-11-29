<?php


    // require __DIR__ . '/Youtube-DL/vendor/autoload.php';

    // use YoutubeDl\YoutubeDl;
    
    
    // $dl = new YoutubeDl([
    //     'extract-audio' => true,
    //     'audio-format' => 'mp3',
    //     'audio-quality' => 0, // best
    //     'output' => '%(title)s.%(ext)s',
    // ]);
    
    // $dl->setDownloadPath(__DIR__ . '/Youtube-DL/Audio');
    

    
    // $video = $dl->download('https://www.youtube.com/watch?v=8QxtIQ1F1ig');
    
    // echo $video->getTitle() . " <br>";
    
    
    
    
    
    
    
    
    echo shell_exec("echo Hello");
    
    $output = shell_exec('youtube-dl -x --audio-format mp3 https://www.youtube.com/watch?v=8QxtIQ1F1ig');
    echo "<h1>$output</h1>";
    echo getcwd();
    echo "<h1>Finished</h1>";
    
    

?>