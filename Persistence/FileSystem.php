<?php

namespace Persistence;

class FileSystem implements \PersitenceGateway {

	static $persistenceDir = '/tmp/TutsLibrary';

	function add(\Books\Book $book) {
		if (! file_exists(self::$persistenceDir)) {
			mkdir(self::$persistenceDir);
		}

		file_put_contents(self::$persistenceDir . DIRECTORY_SEPARATOR . $book->getTitle(), $book);
	}

	function remove($pattern) {
		// TODO: Implement remove() method.
	}

	function select($pattern) {
		// TODO: Implement select() method.
	}
}