<?php

namespace TimuTech\CodeCombat\Resources;

use TimuTech\CodeCombat\Resources\Abstracts\User;

class CombatUser extends User
{
	protected $slug;
	protected $role;
	protected $stats = [];
	protected $oAuthIdentities = [];
	protected $subscription = [];
	protected $license = [];

	public function fill($data)
	{
		parent::fill($data);
		$this->slug = isset($data['slug']) ? $data['slug'] : '';
		$this->role = isset($data['role']) ? $data['role'] : '';;
		$this->oAuthIdentities = isset($data['oAuthIdentities']) ? $data['oAuthIdentities'] : '';
		$this->subscription = isset($data['subscription']) ? $data['subscription'] : '';
		$this->license = isset($data['license']) ? $data['license'] : '';

		return $this;
	}
}