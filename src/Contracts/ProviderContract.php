<?php

namespace CodeCombat\Contracts;

interface ProviderContract
{
	/**
    * Create a User on CodeCombat
    * 
    * @param array $data
    * @param Closure $getAuth
    * @return CodeCombat\Resources\User
    */
	public function createUser(array $data, $getAuth);

	/**
    * Retrieve a User on CodeCombat
    * 
    * @param string $handle
    * @return CodeCombat\Resources\User
    */
	public function getUser($handle);

	/**
    * Get redirect url to login and redirect user to CodeCombat
    * 
    * @param Closure $getAuth
    * @return string
    */
	public function redirect();
}