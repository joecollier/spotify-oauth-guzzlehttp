<?php
	namespace Client;

	require __DIR__ . '/vendor/autoload.php';

	use Datand\Spotify\Api;

	class Client
	{
		public function __construct()
		{
			$access_token = 121;

			$api = new \Datand\Spotify\Api(
				['access_token' => $access_token]
			);
			// $api->setAccessToken(121);
			// $api->setGuzzleOptions();

			$api->getAlbum(1);
		}
	}

	$c = new Client();