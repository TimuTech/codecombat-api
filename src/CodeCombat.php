<?php

namespace CodeCombat;

use CodeCombat\ApiProxy;
use CodeCombat\Builders\UserBuilder;
use CodeCombat\Contracts\ProviderContract;
use CodeCombat\Resources\CombatUser;

class CodeCombat implements ProviderContract
{
	protected $userBuilder;
	protected $httpService;

	public function __construct($id, $secret)
	{
		$this->userBuilder = new UserBuilder();
		$this->httpService = new ApiProxy($id, $secret);
	}

	public function redirect()
	{
		// $auth = $getAuth();
		return $this->httpService
					// ->setAuth($auth['id'], $auth['token'])
					->redirectUrl();
	}

	public function createUser(array $data, $getAuth)
	{
		$userData = $this->httpService->createUser($data);
		$auth = $getAuth();
		$userData = $this->httpService
						->setAuth($auth['id'], $auth['token'])
						->addOAuthIdentity($userData['id']);

		return $this->userBuilder->build(CombatUser::class, $userData);
	}

	public function getUser($handle)
	{
		$userData = $this->httpService->getUser($handle);

		return $this->userBuilder->build(CombatUser::class, $userData);
	}
}