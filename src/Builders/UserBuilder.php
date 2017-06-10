<?php

namespace TimuTech\CodeCombat\Builders;

use TimuTech\CodeCombat\Resources\CombatStats;
use TimuTech\CodeCombat\Resources\CombatUser;

class UserBuilder
{
	/**
    * Build our user object from the data received from CodeCombat.
    * Through this abstraction CodeCombat changing attribute names keeps us from refactoring with them
    * 
    * @param string $type
    * @param array $data
    * @return timuTech\CodeCombat\Resources\User
    */
	public function build($type, array $data)
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
		$statsData = [];

		// user data
		$buildData['id'] = $data['_id'];
		$buildData['email'] = isset($data['email']) ? $data['email'] : '';
		$buildData['name'] = $data['name'];
		$buildData['slug'] = $data['slug'];
		$buildData['role'] = isset($data['role']) ? $data['role'] : '';
		$buildData['oAuthIdentities'] = isset($data['oAuthIdentities']) ? $data['oAuthIdentities'] : '';
		$buildData['subscription'] = isset($data['subscription']) ? $data['subscription']: '';
		$buildData['license'] = isset($data['license']) ? $data['license'] : '';
		$buildData['profile'] = 'https://codecombat.com/user/' . $data['slug'];

		// stats
		$statsData['score'] = isset($data['points']) ? $data['points'] : '';
		$statsData['concepts'] = isset($data['stats']['concepts']) ? $data['stats']['concepts'] : [];

		return (new CombatUser($buildData))->setStats(new CombatStats($statsData));
	}
}