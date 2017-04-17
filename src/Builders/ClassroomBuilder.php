<?php

namespace TimuTech\CodeCombat\Builders;

use TimuTech\CodeCombat\Resources\CombatClassroom;

class ClassroomBuilder
{
	/**
    * Build our user object from the data received from CodeCombat.
    * Through this abstraction CodeCombat changing attribute names keeps us from refactoring with them
    * 
    * @param string $type
    * @param array $data
    * @return TimuTech\CodeCombat\Resources\Classroom
    */
	public function build($type, array $data)
	{
		switch($type)
		{
			case CombatClassroom::class:
				return $this->combatClassroom($data);
		}
	}

	protected function combatClassroom($data)
	{
		$buildData = [];
		$buildData['id'] = $data['_id'];
		$buildData['ownerID'] = $data['ownerID'];
		$buildData['name'] = $data['name'];
		$buildData['description'] = isset($data['description']) ? $data['description'] : '';
		$buildData['members'] = isset($data['members']) ? $data['members'] : [];

		return new CombatClassroom($buildData);
	}
}