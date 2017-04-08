<?php

namespace CodeCombat;

class CodeCombat implements CombatContract
{
	protected $userBuilder;
	protected $httpService;

	public function __construct()
	{
		$this->userBuilder = new UserBuilder();
		$this->httpService = new ApiProxy();
	}

	public function createUser($data)
	{
		$userData = $this->httpService->createUser($data);

		return $this->userBuilder->build(CombatUser::class, $userData);
	}
}