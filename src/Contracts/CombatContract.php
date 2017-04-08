<?php

namespace CodeCombat\Contracts;

interface CombatContract
{
	/**
    * Create a User on CodeCombat
    * 
    * @param array $data
    * @return CodeCombat\Resources\User
    */
	public function createUser($data);
}