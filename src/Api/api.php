<?php
namespace Datand\Spotify\Api;

use Audeio\Spotify\Entity;
use Audeio\Spotify\Hydrator;
use Zend\Stdlib\Hydrator\Aggregate\AggregateHydrator;

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

    /**
     * @param string $id
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function getAlbum($album_id)
    {
        $response = $this->guzzleClient->get(sprintf('/v1/albums/%s', $album_id));

        $contents = $response->getBody()->getContents();
        return json_decode($contents, true);
    }

    /**
     * @param string $id
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function getAlbums(array $album_ids)
    {
        $response = $this->guzzleClient->request('GET', '/v1/albums/', [
            'query' => ['ids' => implode(',', $album_ids)]
        ]);

        $contents = $response->getBody()->getContents();
        return json_decode($contents, true);
    }

    /**
     * @param string $id
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function getAlbumTracks($album_id, $limit = 50, $offset = 0)
    {
        $response = $this->guzzleClient->request('GET', sprintf('/v1/albums/%s/tracks/', $album_id), [
            'query' => [
                'limit' => $limit,
                'offset' => $offset
            ]
        ]);

        $contents = $response->getBody()->getContents();
        return json_decode($contents, true);
    }
}