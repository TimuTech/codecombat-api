<?php

namespace CodeCombat;

use CodeCombat\Contracts\ApiContract;
use GuzzleHttp\Client;

class ApiProxy implements ApiContract
{
	protected $httpClient;
	protected $apiUrl = 'https://codecombat.com/api/';
	protected $authUrl = 'https://codecombat.com/auth/';

	public function __construct()
	{
		$this->httpClient = new Client();
	}

	public function createUser($data)
	{
		if (empty($data['email'] || empty($data['name'])))
			throw ApiException::emptyUserDetail();

		$response = $this->httpClient->post($this->apiUrl . 'users', [
				'json' => [
					'name' => $data['name'],
					'email' => $data['email']
				]
			]);

		return json_decode($response->getBody(), true);
	}
}