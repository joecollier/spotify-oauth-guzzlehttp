<?php
namespace Datand\Spotify\Models\Config;

describe(ConfigModel::class, function () {
    $this->client_secret = 'some-client-secret';
    $this->client_id = 'some-client-id';
    $this->callback_uri = 'http://localhost:8080/callback';

    $this->config_json = json_encode(
        [
            'credentials' => [
                'client' => [
                    'client_secret' => $this->client_secret,
                    'client_id' => $this->client_id
                ]
            ],
            'options' => [
                'callback_uri' => $this->callback_uri
            ]
        ]
    );

    context('config json contains relevant data', function () {
        beforeEach(function () {
            $this->config = new ConfigModel($this->config_json);
        });

        it('sets credentials based on config json', function () {
            expect($this->config->getClientId())->toEqual($this->client_id);
            expect($this->config->getClientSecret())->toEqual($this->client_secret);
            expect($this->config->getCallbackUri())->toEqual($this->callback_uri);
        });
    });

    context('config json is empty or not set', function () {
        beforeEach(function () {
            $this->config = new ConfigModel(null);
        });

        it('sets options to empty strings', function () {
            expect($this->config->getClientId())->toEqual('');
            expect($this->config->getClientSecret())->toEqual('');
            expect($this->config->getCallbackUri())->toEqual('');
        });
    });
});