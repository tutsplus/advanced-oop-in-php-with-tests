<?php

namespace Books;

class NoSuchBookTypeException extends \Exception{

	function __construct($bookType) {
		$message = 'No such book type for the specified index: ' . $bookType;
		parent::__construct($message);
	}

} 