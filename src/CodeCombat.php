<?php

namespace CodeCombat;

use CodeCombat\ApiProxy;
use CodeCombat\Builders\UserBuilder;
use CodeCombat\Contracts\ProviderContract;
use CodeCombat\Resources\Abstracts\User;
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

	public function setAuth($id, $token)
	{
		$this->httpService->setAuth($id, $token);

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