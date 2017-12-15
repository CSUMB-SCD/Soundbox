<?php

    use PHPUnit\Framework\TestCase;
    
    require_once __DIR__ . "/../src/Spotify.php";
    
    final class SpotifyTest extends TestCase
    {
        
        public function retrieveAccessToken() {
            $Spotify = new Spotify();
            $this->assertNull( $Spotify->retrieveAccessToken() );
        }
        
        public function getClientId(){
            $Spotify = new Spotify();
            $this->assertNotNull( $Spotify->getClientId() );
        }
        
        public function getClientSecret(){
            $Spotify = new Spotify();
            $this->assertNotNull( $Spotify->getClientSecret() );
        }
    }
    
?>