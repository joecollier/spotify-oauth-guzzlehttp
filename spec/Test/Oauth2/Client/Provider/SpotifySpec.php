<?php
namespace Datand\Spotify\Oauth2\Client\Provider;;

describe(Spotify::class, function () {
    context('spotify provider instantiated without config options', function () {
        beforeEach(function () {
            $config = [];
            $this->spotify_provider = new \Datand\Spotify\Oauth2\Client\Provider\Spotify($config);
            // $this->access_token = new \League\OAuth2\Client\Token\AccessToken([]);
        });

        it('sets public URIs', function () {
            expect($this->spotify_provider->getBaseAuthorizationUrl())->toEqual(
                'https://accounts.spotify.com/authorize'
            );

            expect($this->spotify_provider->getBaseAccessTokenUrl([]))->toEqual(
                'https://accounts.spotify.com/api/token'
            );

            // expect($this->spotify_provider->getResourceOwnerDetailsUrl(null))->toEqual(
            //     'https://accounts.spotify.com/authorize'
            // );
        });
    });
});