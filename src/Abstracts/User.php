<?php

namespace CodeCombat\Abstracts;

use CodeCombat\Exceptions\ResourceException;

abstract class User
{
	protected $id;
	protected $email;
	protected $name;
	protected $slug;
	protected $role;
	protected $stats = [];
	protected $oAuthIdentities = [];
	protected $subscription = [];
	protected $license = [];

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
			foreach($data as $key => $value)
				$this->{$key} = $value;
		}	
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