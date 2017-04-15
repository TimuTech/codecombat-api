<?php

namespace CodeCombat\Builders;

use CodeCombat\Resources\CombatUser;

class UserBuilder
{
	/**
    * Build our user object from the data received from CodeCombat.
    * Through this abstraction CodeCombat changing attribute names keeps us from refactoring with them
    * 
    * @param array $data
    * @return CodeCombat\Resources\User
    */
	public function build($type, $data)
	{
		switch($type)
		{
			case CombatUser::class:
				return $this->combatUser($data);
		}
	}

	protected function combatUser($data)
	{
		$buildData = [];
		$buildData['id'] = $data['_id'];
		$buildData['email'] = $data['email'];
		$buildData['slug'] = $data['slug'];
		$buildData['role'] = $data['role'];
		$buildData['stats'] = $data['stats'];
		$buildData['oAuthIdentities'] = $data['oAuthIdentities'];
		$buildData['subscription'] = $data['subscription'];
		$buildData['license'] = $data['license'];
		$buildData['profile'] = 'https://codecombat.com/user/' . $data['slug'];

		return new CombatUser($buildData);
	}
}