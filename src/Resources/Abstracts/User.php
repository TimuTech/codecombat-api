<?php

namespace CodeCombat\Resources\Abstracts;

use CodeCombat\Exceptions\ResourceException;

abstract class User
{
	protected $id;
	protected $email;
	protected $name;
	protected $token;
	protected $profile;

	/**
    * Fill the class attributes from an associate array
    * 
    * @param array $data
    */
	public function __construct($data)
	{
		if (!$this->isAssociative($data))
		{
			throw ResourceException::notAssociative();
		}
		else
		{	
			$this->fill($data);
		}	
	}

	public function getProfile()
	{
		return $this->profile;
	}

	public function getId()
	{
		return $this->id;
	}

	public function getEmail()
	{
		return $this->email;
	}

	public function setToken($token)
	{
		$this->token = $token;

		return $this;
	}

	public function setID($id)
	{
		$this->id = $id;
		
		return $this;
	}

	public function setEmail($email)
	{
		$this->email = $email;

		return $this;
	}

	public function setName($name)
	{
		$this->name = $name;

		return $this;
	}

	public function fill($data)
	{
		$this->id = $data['id'];
		$this->email = $data['email'];
		$this->name = $data['name'];
		$this->profile = $data['profile'];

		return $this;
	}

	public function __toString()
	{
		return serialize($this);
	}

	protected static function isAssociative(array $array)
	{
	    // Keys of the array
	    $keys = array_keys($array);

	    // If the array keys of the keys match the keys, then the array must
	    // not be associative (e.g. the keys array looked like {0:0, 1:1...}).
	    return array_keys($keys) !== $keys;
	}
}