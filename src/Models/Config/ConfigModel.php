<?php

namespace Datand\Spotify\Models\Config;

class ConfigModel
{
    public $credentials = [
        'client' => [
            'client_id' => '',
            'client_secret' => ''
        ],
        'options' => [
            'callback_uri' => ''
        ]
    ];

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