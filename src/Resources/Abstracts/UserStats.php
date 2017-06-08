<?php

namespace TimuTech\CodeCombat\Resources\Abstracts;

use TimuTech\CodeCombat\Exceptions\ResourceException;

abstract class UserStats
{
	protected $score;
	protected $concepts;

	/**
    * Fill the class attributes from an associate array
    * 
    * @param array $data
    */
	public function __construct(array $data)
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