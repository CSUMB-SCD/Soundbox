<?php

    use PHPUnit\Framework\TestCase;
    
    require_once __DIR__ . "/../src/Spotify.php";

    final class SpotifyTest extends TestCase
    {
        
        public function testRetrieveAccessToken() {
            $Spotify = new Spotify();
            $this->assertNull( $Spotify->retrieveAccessToken() );
        }
        
        public function testGetClientId(){
            $Spotify = new Spotify();
            $this->assertNotNull( $Spotify->getClientId() );
        }
        
        public function testGetClientSecret(){
            $Spotify = new Spotify();
            $this->assertNotNull( $Spotify->getClientSecret() );
        }
        
        public function testGetArtistId(){
            $Spotify = new Spotify();
            $this->assertNotNull( $Spotify->getArtistId( "Calvin Harris" ) );
        }

        public function retrieveRecommendedArtists(){
            $Spotify = new Spotify();
            $Spotify->getArtistId( "Calvin Harris" );
            $this->assertNotNull( $Spotify->retrieveRecommendedArtists() );
        }

    }
    
?>