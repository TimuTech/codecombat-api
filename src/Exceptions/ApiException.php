<?php

namespace TimuTech\CodeCombat\Exceptions;

class ApiException extends \Exception
{
	public static emptyUserDetail()
	{
		return new static("Data must contain name and surname");
	}

	public static emptyUserId()
	{
		return new static("Identifier to retrieve user must be non-empty");
	}
}