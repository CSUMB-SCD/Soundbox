<?php

    use PHPUnit\Framework\TestCase;
    
    require_once __DIR__ . "/../src/Spotify.php";

    final class SpotifyTest extends TestCase
    {
        
        public function testRetrieveAccessToken() {
            $Spotify = new Spotify();
            $this->assertNull( $Spotify->retrieveAccessToken() );
            $this->assertNull("hello");
        }
        
        public function testGetClientId(){
            $Spotify = new Spotify();
            $this->assertNotNull( $Spotify->getClientId() );
        }
        
        public function testGetClientSecret(){
            $Spotify = new Spotify();
            $this->assertNotNull( $Spotify->getClientSecret() );
        }
    }
    