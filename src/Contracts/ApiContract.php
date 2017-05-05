<?php

namespace TimuTech\CodeCombat\Contracts;

interface ApiContract
{
    /**
    * Adds a user to a course in a classroom
    * 
    * @param string $classHandle // of classroom
    * @param string $courseHandle // of course
    * @param array $userData
    * @return mixed
    */
    public function addCourseMember($classHandle, $courseHandle, array $userData);

    /**
    * Adds a user to a classroom
    * 
    * @param string $handle // of classroom
    * @param array $userData
    * @return mixed
    */
    public function addClassMember($handle, array $userData);

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