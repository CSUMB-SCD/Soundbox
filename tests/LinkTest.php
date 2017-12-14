<?php

    use PHPUnit\Framework\TestCase;
    
    final class LinkTest extends TestCase
    {
        public function testAudioLink() {
            $youtube = new YoutubeAudioLink('AIzaSyDymolX0EqHJgpPdJYAZkqJ5illswu8wr0');
            $this->assertNull($youtube->getAudioLinkById(''));
            $this->assertStringMatchesFormat('%a',$youtube->getAudioLinkById('mASbK1ZYwKw'));
        }
        
        public function testSearchByKey() {
            $youtube = new YoutubeAudioLink('AIzaSyDymolX0EqHJgpPdJYAZkqJ5illswu8wr0');
            $this->assertStringMatchesFormat('%a',$youtube->getAudioBySearching('thor ragnarok soundtrack'));
            $this->assertNotNull($youtube->getAudioBySearching('thor ragnarok soundtrack'));
            $this->assertNotNull($youtube->getAudioBySearching(''));

        }
        
        public function testGetYoutubeIDFromSearchKey() {
            $youtube = new YoutubeAudioLink('AIzaSyDymolX0EqHJgpPdJYAZkqJ5illswu8wr0');
            
        }
        
    }