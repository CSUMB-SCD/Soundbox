<?php

    use PHPUnit\Framework\TestCase;
    
    require_once __DIR__ . "/../src/Spotify.php";
    
    final class SpotifyTest extends TestCase
    {
        
        public function retrieveAccessToken() {
            $Spotify = new Spotify();
            $this->assertNull( $Spotify->retrieveAccessToken() );
        }
        
        
    }
    
?>