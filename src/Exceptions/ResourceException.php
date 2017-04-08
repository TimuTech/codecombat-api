<?php

namespace CodeCombat\Exceptions;

class ResourceException extends \Exception
{
	public static notAssociative()
	{
		return new static("Resource creation array must be associative.");
	}
}