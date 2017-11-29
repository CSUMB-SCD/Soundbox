<?php
    require __DIR__ . '/vendor/athlon1600/youtube-downloader/src/YouTubeDownloader.php';

    
    //$output = shell_exec('youtube-dl -x --audio-format mp3 https://www.youtube.com/watch?v=8QxtIQ1F1ig');

    $yt = new YouTubeDownloader();

    $links = $yt->getDownloadLinks("https://www.youtube.com/watch?v=QxsmWxxouIM", "mp4");

    echo "<video width=\"320\" height=\"240\" controls>";
    echo "<source src=" . $links[0]['url'] . " type=\"video/mp4\">";
    echo "<source src=\"movie.ogg\" type=\"video/ogg\">";
    echo "Your browser does not support the video tag.";
    echo "</video>";
    
    //22
    //var_dump($links);
    

?>