<?php

namespace CodeCombat\Contracts;

use CodeCombat\Resources\Abstracts\User;

interface ProviderContract
{
    /**
    * Create and set oAuth2 data
    * 
    * @param string $token
    * @return $this
    */
    public function setAuth($token);

    /**
    * Create and set oAuth2 data
    * 
    * @param CodeCombat\Resources\Abstracts\User $user
    * @return $this
    */
    public function createIdentity(User $user);

	/**
    * Create a User on CodeCombat
    * 
    * @param array $data
    * @return CodeCombat\Resources\User
    */
	public function register(array $data);

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
    * @return string
    */
	public function redirect();
}