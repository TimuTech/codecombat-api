<?php

namespace TimuTech\CodeCombat\Contracts;

interface ApiContract
{
    /**
    * Set OAuth AccessToken for the proxy
    * 
    * @param string $token
    * @return $this
    */
    public function setAccessToken($token);

	/**
    * Call to create a user on CodeCombat
    * 
    * @param array $data
    * @return mixed
    */
	public function createUser(array $data);

    /**
    * Call to create a user on CodeCombat
    * 
    * @param array $id
    * @return mixed
    */
    public function addOAuthIdentity($id);

	/**
    * Call to retrieve a user on CodeCombat by ID
    * 
    * @param string $id
    * @return mixed
    */
	public function getUser($id);

    /**
    * Get redirect url to login and redirect user to CodeCombat
    * 
    * @return string
    */
    public function redirectUrl();
}