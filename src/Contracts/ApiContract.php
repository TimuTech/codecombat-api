<?php

namespace CodeCombat\Contracts;

interface ApiContract
{
	/**
    * Call to create a user on CodeCombat
    * 
    * @param array $data
    * @return mixed
    */
	public function createUser($data);
}