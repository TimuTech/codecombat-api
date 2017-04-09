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

	/**
    * Call to retrieve a user on CodeCombat by ID
    * 
    * @param array $data
    * @return mixed
    */
	public function getUser($id);

    /**
    * Get redirect url to login and redirect user to CodeCombat
    * 
    * @param string $authId
    * @return string
    */
    public function redirectUrl($authId);
}