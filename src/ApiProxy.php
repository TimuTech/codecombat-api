<?php

namespace TimuTech\CodeCombat;

use GuzzleHttp\Client;
use TimuTech\CodeCombat\Contracts\ApiContract;
use TimuTech\CodeCombat\Exceptions\ApiException;

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

	public function addCourseMember($classHandle, $courseHandle, array $userData)
	{
		if (empty($classHandle) || empty($courseHandle))
			throw ApiException::emptyClassroomHandle();
		if (!isset($userData['id']) || empty($userData['id']))
			throw ApiException::emptyUserHandle();

		$response = $this->httpClient->put($this->apiUrl.sprintf('classrooms/%s/courses/%s/enrolled', $classHandle, $courseHandle), [
				'json' => [
					'userId' => $userData['id']
				]
			]);

		return json_decode($response->getBody(), true);
	}

	public function addClassMember($handle, array $userData)
	{
		if (empty($handle) || !isset($userData['code']))
			throw ApiException::emptyClassroomHandle();
		if (!isset($userData['id']) || empty($userData['id']))
			throw ApiException::emptyUserHandle();

		$response = $this->httpClient->put($this->apiUrl.'classrooms/'.$handle.'/members', [
				'json' => [
					'userId' => $userData['id'],
					'code' => $userData['code']
				]
			]);

		return json_decode($response->getBody(), true);
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
		if (empty($data['name']))
			throw ApiException::emptyUserDetail();

		$response = $this->httpClient->post($this->apiUrl.'users', [
			'json' => [
				'name' => $data['name'],
				'email' => empty($data['email']) ? '' : $data['email'],
				'role' => isset($data['role']) ? $data['role'] : ''
			]
		]);

		return json_decode($response->getBody(), true);
	}

	public function getUser($id)
	{
		if (empty($id))
			throw ApiException::emptyUserHandle();

		$response = $this->httpClient->get($this->apiUrl.'users/'.$id);

		return json_decode($response->getBody(), true); 
	}
}