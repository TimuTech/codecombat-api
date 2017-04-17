<?php

namespace TimuTech\CodeCombat\Contracts;

use TimuTech\CodeCombat\Resources\Abstracts\User;

interface ProviderContract
{
    /**
    * Adds a user to a classroom
    * 
    * @param string $handle  // of classroom
    * @param array $userData
    * @return mixed
    */
    public function addClassStudent($handle, User $user);

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