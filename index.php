<?php
    // require __DIR__ . '/vendor/athlon1600/youtube-downloader/src/YouTubeDownloader.php';

    
    // //$output = shell_exec('youtube-dl -x --audio-format mp3 https://www.youtube.com/watch?v=8QxtIQ1F1ig');

    // $yt = new YouTubeDownloader();

    // $links = $yt->getDownloadLinks("https://www.youtube.com/watch?v=QxsmWxxouIM", "mp4");

    // echo "<video width=\"320\" height=\"240\" controls>";
    //     echo "<source src=" . $links[0]['url'] . " type=\"video/mp4\">";
    //     echo "<source src=\"movie.ogg\" type=\"video/ogg\">";
    //     echo "Your browser does not support the video tag.";
    // echo "</video>";
    
    // downloadUrlToFile($links[0]['url'], __DIR__ . "/Youtube-DL/Audio/temp.mp4");
    
    // //22
    // //var_dump($links);
    
    // $m4a = "Youtube-DL/Audio/temp.mp4";
    
    // $mp3 = "Youtube-DL/Audio/convertedSong.mp3";
    
    // system( "ffmpeg -i " . $m4a . " -ar 44100 -ab 128k -ac 2 " . $mp3 );
    // echo "<div>";
    // echo "<audio controls>";
    //   echo "<source src=\"Youtube-DL/Audio/convertedSong.mp3\" type=\"audio/mpeg\">";
    //   echo "Your browser does not support the audio tag.";
    // echo "</audio>";
    // echo "</div>";
    
    // // This function allows me to download a video to the server.
    // function downloadUrlToFile($url, $outFileName)
    // {   
    //     if(is_file($url)) {
    //         copy($url, $outFileName); 
    //     } else {
    //         $options = array(
    //           CURLOPT_FILE    => fopen($outFileName, 'w'),
    //           CURLOPT_TIMEOUT =>  28800, // set this to 8 hours so we dont timeout on big files
    //           CURLOPT_URL     => $url
    //         );
    
    //         $ch = curl_init();
    //         curl_setopt_array($ch, $options);
    //         curl_exec($ch);
    //         curl_close($ch);
    //     }
    // }
    
    
    //-----------------------------------------------------------------------------
    
    
    require __DIR__ . '/vendor/Youtube-DL/vendor/autoload.php';

    use YoutubeDl\YoutubeDl;
    
    $dl = new YoutubeDl([
        'extract-audio' => true,
        'audio-format' => 'mp3',
        'audio-quality' => 0, // best
        'output' => '%(title)s.%(ext)s',
    ]);
    $dl->setDownloadPath(__DIR__ . '/Audio');
    
    $video = $dl->download('https://www.youtube.com/watch?v=oDAw7vW7H0c');

    echo "<h1>Finished</h1>";
?>

