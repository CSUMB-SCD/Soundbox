<?php

    use PHPUnit\Framework\TestCase;
    
    require_once __DIR__ . "/../src/YoutubeAudioLink.php";
    
    final class LinkTest extends TestCase
    {
        public function testAudioLink() {
            $youtube = new YoutubeAudioLink('AIzaSyDymolX0EqHJgpPdJYAZkqJ5illswu8wr0');
            $youtube->setBinPath("../bin/");
            $this->assertNull($youtube->getAudioLinkById(''));
            $this->assertStringMatchesFormat('%a',$youtube->getAudioLinkById('mASbK1ZYwKw'));
        }
        
        public function testSearchByKey() {
            $youtube = new YoutubeAudioLink('AIzaSyDymolX0EqHJgpPdJYAZkqJ5illswu8wr0');
            $youtube->setBinPath("../bin/");
            $this->assertStringMatchesFormat('%a',$youtube->getAudioBySearching('thor ragnarok soundtrack'));
            $this->assertNotNull($youtube->getAudioBySearching('thor ragnarok soundtrack'));
            $this->assertNotNull($youtube->getAudioBySearching(''));

        }
        
        public function testGetYoutubeIDFromSearchKey() {
            $youtube = new YoutubeAudioLink('AIzaSyDymolX0EqHJgpPdJYAZkqJ5illswu8wr0');
            
        }
        
    }