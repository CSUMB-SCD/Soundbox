<?php

    use PHPUnit\Framework\TestCase;
    
    require_once __DIR__ . "/../src/YoutubeAudioLink.php";
    
    final class LinkTest extends TestCase
    {
        public function testAudioLink() {
            $youtube = new YoutubeAudioLink('AIzaSyDymolX0EqHJgpPdJYAZkqJ5illswu8wr0');
            $youtube->setBinPath("bin/");
            $this->assertStringMatchesFormat('%a',$youtube->getAudioLinkById('mASbK1ZYwKw'));
            $this->assertContains('http',$youtube->getAudioLinkById('mASbK1ZYwKw'));
        }
        
        public function testSearchByKey() {
            $youtube = new YoutubeAudioLink('AIzaSyDymolX0EqHJgpPdJYAZkqJ5illswu8wr0');
            $youtube->setBinPath("bin/");
            $this->assertStringMatchesFormat('%a',$youtube->getAudioBySearching('thor ragnarok soundtrack'));
            $this->assertNotNull($youtube->getAudioBySearching('thor ragnarok soundtrack'));
            $this->assertNotNull($youtube->getAudioBySearching(''));

        }
        
        public function testGetYoutubeIDFromSearchKey() {
            $youtube = new YoutubeAudioLink('AIzaSyDymolX0EqHJgpPdJYAZkqJ5illswu8wr0');
            $this->assertStringMatchesFormat('%a',$youtube->getYoutubeLinkFromSearchKeys('thor ragnarok soundtrack'));
            $this->assertEquals($youtube->getYoutubeLinkFromSearchKeys('Thor: Ragnarok - Official Trailer Song (Magic Sword - In The Face Of Evil)'), 'mASbK1ZYwKw');
            
        }
        
        public function testGetVideoInfo() {
            $youtube = new YoutubeAudioLink('AIzaSyDymolX0EqHJgpPdJYAZkqJ5illswu8wr0');
            $this->assertNull($youtube->getVidInfo());
            $youtube->getAudioLinkById('mASbK1ZYwKw');
            $this->assertNotNull($youtube->getVidInfo());
            
        }
        
        public function testGetYoutubePlayerVideo() {
            $youtube = new YoutubeAudioLink('AIzaSyDymolX0EqHJgpPdJYAZkqJ5illswu8wr0');
            $this->assertNull($youtube->getYoutubePlayerVideo());
            $youtube->getAudioLinkById('mASbK1ZYwKw');
            $this->assertNotNull($youtube->getYoutubePlayerVideo());
            $this->assertContains('youtube',$youtube->getYoutubePlayerVideo());
        }
        
    }