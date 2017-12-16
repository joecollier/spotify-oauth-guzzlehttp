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

    public function __construct($config_json = null)
    {
        if (!empty($config_json)) {
            $this->setCredentials(json_decode($config_json, true)['credentials']);
            $this->setOptions(json_decode($config_json, true)['options']);
        }

        return $this;
    }
}