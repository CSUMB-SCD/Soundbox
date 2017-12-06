<?php
class Spotify{
 
    private $client_id;
    private $client_secret;
    private $access_token;
    private $artist_id;
    private $recommendation_artists;
    private $recommendation_artists_images;

    // constructor
    
    public function __construct(){
        
        $this->client_id = getenv('SPOTIFY_CLIENT_ID');
        $this->client_secret = getenv('SPOTIFY_CLIENT_SECRET');
        $this->access_token = "";
        $this->artist_id = "";
        $this->recommendation_artists = array();
        $this->recommendation_artists_images = array();
        
        // set access token
        $this->retrieveAccessToken();
    }
    
    // getters
    
    public function getClientId(){
        return $this->client_id;
    }

    public function getClientSecret(){
        return $this->client_secret;
    }
    
    public function getAccessToken(){
        return $this->access_token;
    }
    
    public function getAccessID(){
        return $this->access_id;
    }
    
    public function getRecommendedArtists(){
        return $this->recommendation_artists;
    }
    
    public function getRecommendedArtistsImages(){
        return $this->recommendation_artists_images;
    }
    
    // setters
    
    public function setClientId( $id ){
        $this->client_id = $id;
    }

    public function setClientSecret( $secret ){
        $this->client_secret = $secret;
    }
    
    public function setAccessToken( $token ){
        $this->access_token = $token;
    }
    
    public function setArtistID( $id ){
        $this->artist_id = $id;
    }
    
    public function setRecommendedArtists( $artists ){
        $this->recommendation_artists  = $artists;
    }
    
    public function setRecommendedArtistsImages( $images ){
        $this->recommendation_artists_images = $images;
    }
    
    // helpers
    
    public function retrieveAccessToken(){
        
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL,            'https://accounts.spotify.com/api/token' );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt($ch, CURLOPT_POST,           1 );
        curl_setopt($ch, CURLOPT_POSTFIELDS,     'grant_type=client_credentials' ); 
        curl_setopt($ch, CURLOPT_HTTPHEADER,     array('Authorization: Basic '.base64_encode( $this->client_id . ':' . $this->client_secret))); 
        
        $result = curl_exec($ch);
        $accessToken = json_decode($result, true);
        $accessToken = $accessToken['access_token'];   
        
        $this->access_token = $accessToken;
    }
    
    public function getArtistId( $name ){
        
        $getArtistId_url = 'https://api.spotify.com/v1/search?query=' 
                            . urlencode( $name )
                            . '&type=artist&market=US&offset=0&limit=1&access_token='
                            . $this->access_token;
        
        $url = $getArtistId_url;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        $artist_array = curl_exec($curl);
        curl_close($curl);
        
        $parsed_json = json_decode( $artist_array, true);
        $artistID = $parsed_json['artists']['items'][0]['id'];
        
        $this->artist_id = $artistID;
        
        return $artistID;
    }
  
    public function retrieveRecommendedArtists(){
        
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://api.spotify.com/v1/artists/" . $this->artist_id . "/related-artists");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        
        
        $headers = array();
        $headers[] = "Accept: application/json";
        $headers[] = "Authorization: Bearer " . $this->access_token;
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        
        $result = curl_exec($ch);
        
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        
        curl_close ($ch);
        
        $parsedRecommended_json = json_decode($result, true);
        
        $this->recommendation_artists = 
            array(
                $parsedRecommended_json['artists'][0]['name'],
                $parsedRecommended_json['artists'][1]['name'],
                $parsedRecommended_json['artists'][2]['name']
            );
            
        return $this->recommendation_artists;
    }
  
    public function retrieveRecommendedArtistsImages(){
        
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://api.spotify.com/v1/artists/" . $this->artist_id . "/related-artists");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        
        
        $headers = array();
        $headers[] = "Accept: application/json";
        $headers[] = "Authorization: Bearer " . $this->access_token;
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        
        $result = curl_exec($ch);
        
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        
        curl_close ($ch);
        
        $parsedRecommended_json = json_decode($result, true);
        
        $this->recommendation_artists_images = 
            array(
                $parsedRecommended_json['artists'][0]['images'][0]['url'],
                $parsedRecommended_json['artists'][1]['images'][0]['url'],
                $parsedRecommended_json['artists'][2]['images'][0]['url']
            );
    }
    
    public function displayArtistWithImages(){
        
        echo "Recommended artist:<br>";

        if ( !empty( $artist_array ) ) {
            
            for ($i = 0; $i < sizeof( $this->recommendation_artists ); $i++) {
                //name
                echo "<p style='text-indent: 50px'>" . $this->recommendation_artists[$i] . "<br>";
                 
                //image
                $imageData = base64_encode( file_get_contents( $this->recommendation_artists[$i] ) );
                echo '<img width="304" height="236" src="data:image/jpeg;base64,' . $imageData . '"><br>';
            }
            
        }//if
            
    }
    
    
}
?>