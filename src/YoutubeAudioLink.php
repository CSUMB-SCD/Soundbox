<?php

require __DIR__ . '/../vendor/autoload.php';

class YoutubeAudioLink { 
    private $mYoutubeApiKey;
    private $mBinPath;
    private $mYoutube;
    private $mAudioSettings;
    private $mVideoInfo;
    
    const YOUTUBE_LINK = "https://www.youtube.com/watch?v=";

    function __construct($youtubeKey = null){
        
        if(is_null($youtubeKey)) {
            $this->mYoutubebeApiKey = getenv('YOUTUBE_API_KEY');
        }
        else{
            $this->mYoutubebeApiKey = $youtubeKey;
        }
        
        $this->mVideoInfo = null;
        $this->mBinPath = "bin/";
        $this->mAudioSettings = "youtube-dl --add-metadata --extract-audio --audio-format mp3 --audio-quality 0 -o '" . __DIR__ . "/../Audio/%(title)s-%(id)s.%(ext)s' ";
        
        $this->mYoutube = new Madcoda\Youtube\Youtube(array('key' => $this->mYoutubebeApiKey));
    }
    
    //Use this function when using keywords to search for a video. For example the title of a video.
    public function getAudioBySearching($searchKey) {
        
        $youtubeLink = $this->getYoutubeLinkFromSearchKeys($searchKey);
        
        return $this->getAudioLink($youtubeLink);

    }
    
    //Use this function once you have the youtube link to the video.
    public function getAudioLink($yLink) {
        
        $videoId = $this->mYoutube->parseVIdFromURL($yLink);
        $this->mVideoInfo = $this->mYoutube->getVideoInfo($videoId);
        
        return shell_exec($this->mBinPath . $this->mAudioSettings . $yLink);
    }
    
    public function getYoutubeLinkFromSearchKeys($searchKey) {
        
        return self::YOUTUBE_LINK . $this->getVideoIdBySearching($searchKey);
    }
    
    public function getVideoIdBySearching($searchKey){
        
        $videoList = $this->mYoutube->searchVideos($searchKey);
        $arrayMap = $videoList[0];      //Just grab the first result
        
        return $arrayMap->id->videoId;
    }
    
    public function setBinPath($path){
        $this->mBinPath = $path;
    }
    
    public function getVidInfo(){
        return $this->mVideoInfo;
    }
    
    public function getYoutubePlayerVideo() {
        if($this->mVideoInfo !== null){
            return $this->mVideoInfo->player->embedHtml;
        }
        
        return null;
    }
} 