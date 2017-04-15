<?php

namespace CodeCombat;

use CodeCombat\Contracts\ApiContract;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class ApiProxy implements ApiContract
{
	protected $httpClient;
	protected $apiUrl = 'https://codecombat.com/api/';
	protected $authUrl = 'https://codecombat.com/auth/';
	protected $accessToken;
	protected $providerId;

	public function __construct($name, $secret, $providerId)
	{
		$this->httpClient = new Client([
				'headers' => [
					'Authorization' => 'Basic ' . base64_encode($name . ':' . $secret)
				]
			]);

		$this->providerId = $providerId;
	}

	public function setAccessToken($token)
	{
		$this->accessToken = $token;

		return $this;
	}

	public function redirectUrl()
	{
		return $this->authUrl.'login-o-auth?'.http_build_query([
				'provider' => $this->providerId,
				'accessToken' => $this->accessToken
			]);
	}

	public function addOAuthIdentity($id)
	{
		if (empty($id))
			throw ApiException::emptyUserId();

		$response = $this->httpClient->post($this->apiUrl.'users/'.$id.'/o-auth-identities', [
				'json' => [
					'provider' => $this->providerId,
					'accessToken' => $this->accessToken
				]
			]);

		return json_decode($response->getBody(), true);
	}

	public function createUser(array $data)
	{
		if (empty($data['email'] || empty($data['name'])))
			throw ApiException::emptyUserDetail();

		$response = $this->httpClient->post($this->apiUrl.'users', [
			'json' => [
				'name' => $data['name'],
				'email' => $data['email'],
				'role' => isset($data['role']) ? $data['role'] : ''
			]
		]);

		return json_decode($response->getBody(), true);
	}

	public function getUser($id)
	{
		if (empty($id))
			throw ApiException::emptyUserId();

		$response = $this->httpClient->get($this->apiUrl.'users/'.$id);
		dd(json_decode($response->getBody(), true));
		return json_decode($response->getBody(), true); 
	}
}