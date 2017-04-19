<?php

namespace TimuTech\CodeCombat\Exceptions;

class ResourceException extends \Exception
{
	public static function notAssociative()
	{
		return new static("Resource creation array must be associative.");
	}
}