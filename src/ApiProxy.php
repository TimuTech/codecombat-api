<?php

namespace CodeCombat;

use CodeCombat\Contracts\ApiContract;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\TransferException;

class ApiProxy implements ApiContract
{
	protected $httpClient;
	protected $apiUrl = 'https://codecombat.com/api/';
	protected $authUrl = 'https://codecombat.com/auth/';

	public function __construct($name, $secret)
	{
		$this->httpClient = new Client([
				'headers' => [
					'Auth' => 'Basic ' . base64_encode($name . ':' . $secret)
				]
			]);
	}

	public function redirectUrl($authId)
	{
		return $this->authUrl.'login-o-auth?'.http_build_query([
				'provider' => $authId,
				'accessToken' => '1234'
			]);
	}

	public function createUser($data)
	{
		if (empty($data['email'] || empty($data['name'])))
			throw ApiException::emptyUserDetail();

		$response = $this->httpClient->post($this->apiUrl.'users', [
			'json' => [
				'name' => $data['name'],
				'email' => $data['email']
			]
		]);

		return json_decode($response->getBody(), true);
	}

	public function getUser($id)
	{
		if (empty($id))
			throw ApiException::emptyUserId();

		$response = $this->httpClient->get($this->apiUrl.'users/'.$id);

		return json_decode($response->getBody(), true); 
	}
}