<?php

namespace TimuTech\CodeCombat\Exceptions;

class ApiException extends \Exception
{
	public static function emptyClassroomHandle()
	{
		return new static("Classroom identifier must be non-empty");
	}

	public static function emptyUserDetail()
	{
		return new static("Data must contain name and surname");
	}

	public static function emptyUserHandle()
	{
		return new static("Identifier to retrieve user must be non-empty");
	}
}