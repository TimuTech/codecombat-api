<?php

namespace CodeCombat\Exceptions;

class ApiException extends \Exception
{
	public static emptyUserDetail()
	{
		return new static("Data must contain name and surname");
	}
}