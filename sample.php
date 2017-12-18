<?php
namespace Client;

require __DIR__ . '/vendor/autoload.php';

use Datand\Spotify\Oauth2\Client\Provider\Spotify;
use Datand\Spotify\Api\Api;
use Datand\Spotify\Models\Config\ConfigModel;

class Client
{
    private static $scope = [
        'playlist-read-private',
        'user-read-private'
    ];

    private static $config_path = '/src/Config/config.json';
    private static $config_path_sample = '/src/Config/config.sample.json';

    private function getConfigFromJson()
    {
        $config_file = null;
        if ($config_file = file_get_contents(__DIR__ . self::$config_path)) {}
        else {
            $config_file = file_get_contents(__DIR__ . self::$config_path_sample);
        }

        return new \Datand\Spotify\Models\Config\ConfigModel($config_file);
    }

    protected $sample_album_ids = ['1NCSGAab77B3uvaT38UWz0','2noRn2Aes5aoNVsU6iWThc'];

    protected $sample_user_ids = ['124787553'];

    private function setConfig($config)
    {
        $this->config = $config;
    }

    private function authorize()
    {
        $auth_provider = new \Datand\Spotify\Oauth2\Client\Provider\Spotify([
            'clientId' => $this->config->credentials['client']['client_id'],
            'clientSecret' => $this->config->credentials['client']['client_secret'],
            'redirectUri' => $this->config->options['callback_uri'], 
        ]);

        return $auth_provider;
    }

    public function __construct()
    {
        $this->setConfig($this->getConfigFromJson());

        $auth_provider = $this->authorize();
        $auth_url = $auth_provider->getAuthorizationUrl(['scope' => self::$scope]);
        $access_token = $auth_provider->getAccessToken('client_credentials');

        $this->api = new \Datand\Spotify\Api\Api(['access_token' => $access_token->getToken()]);

        // $album = $this->api->getAlbum($this->sample_album_ids[0]);
        // echo json_encode($album, JSON_PRETTY_PRINT);

        // $albums = $this->api->getAlbums($this->sample_album_ids);
        // echo json_encode($albums, JSON_PRETTY_PRINT);

        // $album_tracks = $this->api->getAlbumTracks($this->sample_album_ids[0]);
        // echo json_encode($album_tracks, JSON_PRETTY_PRINT);

        // $user_playlists = $this->api->getAlbumTracks($this->sample_album_ids[0]);
        // echo json_encode($user_playlists, JSON_PRETTY_PRINT);
    }
}

$c = new Client();