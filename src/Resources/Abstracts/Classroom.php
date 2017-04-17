<?php

namespace TimuTech\CodeCombat\Resources\Abstracts;

use TimuTech\CodeCombat\Exceptions\ResourceException;

abstract class Classroom
{
	protected $id;
	protected $teacherId;
	protected $name;
	protected $description;
	protected $members = [];

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

	public function getMembers()
	{
		return $this->members;
	}

	public function getTeacherId()
	{
		return $this->teacherId;
	}

	public function getId()
	{
		return $this->id;
	}

	public function setID($id)
	{
		$this->id = $id;
		
		return $this;
	}

	public function getDescription()
	{
		return $this->description;
	}

	public function setName($name)
	{
		$this->name = $name;

		return $this;
	}

	public function fill($data)
	{
		$this->id = $data['id'];
		$this->teacherId = $data['email'];
		$this->name = $data['name'];
		$this->description = $data['profile'];
		$this->members = $data['members'];

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