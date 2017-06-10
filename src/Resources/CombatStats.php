<?php

namespace TimuTech\CodeCombat\Resources;

use TimuTech\CodeCombat\Resources\Abstracts\UserStats;

class CombatStats extends UserStats
{
	public function fill($data)
	{
		$this->score = $data['score'];
		$this->concepts = $data['concepts'];

		return $this;
	}
}