<?php
namespace Datand\Spotify\Models\Config;

class ConfigModel
{
    public $credentials = [
        'client' => [
            'client_id' => '',
            'client_secret' => ''
        ]
    ];

    public $sample_album_ids = [];
    public $sample_user_ids = [];
    public $options = ['callback_uri' => ''];

    public function getCallbackUri()
    {
        return $this->options['callback_uri'];
    }

    public function getClientSecret()
    {
        return $this->credentials['client']['client_secret'];
    }

    public function getClientId()
    {
        return $this->credentials['client']['client_id'];
    }

    protected function setCredentials($credentials = [])
    {
        $this->credentials = $credentials;
    }

    protected function getCredentials()
    {
        return $this->credentials;
    }

    protected function setOptions($options = [])
    {
        $this->options = $options;
    }

    protected function getOptions()
    {
        return $this->options;
    }

    protected function setSampleAlbumIds($sample_album_ids = [])
    {
        $this->sample_album_ids = $sample_album_ids;
    }

    protected function setSampleUserIds($sample_user_ids = [])
    {
        $this->sample_user_ids = $sample_user_ids;
    }

    protected function setSampleValues($sample_values = [])
    {
        $this->setSampleAlbumIds($sample_values['sample_album_ids']);
        $this->setSampleUserIds($sample_values['sample_user_ids']);
    }

    public function __construct($config_json = null)
    {
        if (!empty($config_json)) {
            $config_array = json_decode($config_json, true);

            $this->setCredentials($config_array['credentials']);
            $this->setOptions($config_array['options']);
            $this->setSampleValues($config_array['sample_values']);
        }

        return $this;
    }
}