<?php

namespace TimuTech\CodeCombat;

use TimuTech\CodeCombat\ApiProxy;
use TimuTech\CodeCombat\Builders\UserBuilder;
use TimuTech\CodeCombat\Contracts\ProviderContract;
use TimuTech\CodeCombat\Resources\Abstracts\User;
use TimuTech\CodeCombat\Resources\CombatUser;

class CodeCombat implements ProviderContract
{
	protected $userBuilder;
	protected $httpService;

	public function __construct($id, $secret, $providerId)
	{
		$this->userBuilder = new UserBuilder();
		$this->httpService = new ApiProxy($id, $secret, $providerId);
	}

	public function setAuth($token)
	{
		$this->httpService->setAccessToken($token);

		return $this;
	}

	public function createIdentity(User $user)
	{
		$this->httpService->addOAuthIdentity($user->getId());

		return $this;
	}

	public function redirect()
	{
		return $this->httpService->redirectUrl();
	}

	public function register(array $data)
	{
		$userData = $this->httpService->createUser($data);

		return $this->userBuilder->build(CombatUser::class, $userData);
	}

	public function getUser($handle)
	{
		$userData = $this->httpService->getUser($handle);

		return $this->userBuilder->build(CombatUser::class, $userData);
	}
}