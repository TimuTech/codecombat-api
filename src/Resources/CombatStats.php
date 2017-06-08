<?php

namespace TimuTech\CodeCombat\Resources;

use TimuTech\CodeCombat\Resources\Abstracts\UserStats;

class CombatStats extends UserStats
{
	public function fill($data)
	{
		$this->score = $data['points'];
		$this->concepts = $data['stats']['concepts'];

		return $this;
	}
}