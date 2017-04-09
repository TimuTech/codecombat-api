<?php

namespace CodeCombat;

class CodeCombat implements CombatContract
{
	protected $userBuilder;
	protected $httpService;

	public function __construct($id, $secret)
	{
		$this->userBuilder = new UserBuilder();
		$this->httpService = new ApiProxy($id, $secret);
	}

	public function redirect($authId)
	{
		return $this->httpService->redirectUrl($authId);
	}

	public function createUser($data)
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