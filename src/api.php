<?php
namespace Datand\Spotify;

use GuzzleHttp;

class Api
{
    private static $base_url = 'https://api.spotify.com';
    private $guzzleClient;
    private $access_token;

    public function __construct($options)
    {
        $this->setAccessToken($options['access_token']);

        $this->guzzleClient = new GuzzleHttp\Client(
            [
                'base_uri' => static::$base_url,
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => sprintf('Bearer %s', $this->access_token)
                ]
            ]
        );
    }

    public function setAccessToken($access_token)
    {
        $this->access_token = $access_token;
    }

    public function getAlbum($album_id)
    {
        // $request = $this->guzzleClient->createRequest();

        // $reponse = $this->sendRequest();
    }
}