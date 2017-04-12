<?php

namespace CodeCombat\Resources;

use CodeCombat\Abstracts\User;

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
		$this->stats = isset($data['stats']) ? $data['stats'] : '';
		$this->oAuthIdentities = isset($data['oAuthIdentities']) ? $data['oAuthIdentities'] : '';
		$this->subscription = isset($data['subscription']) ? $data['subscription'] : '';
		$this->license = isset($data['license']) ? $data['license'] : '';

		return $this;
	}
}