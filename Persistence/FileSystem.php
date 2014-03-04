<?php

namespace Persistence;

class FileSystem implements \PersitenceGateway {

	static $persistenceDir = '/tmp/TutsLibrary';
	static $propertyReqeustModelMap = [
		'Type' => 'bookType'
	];
	static $DS = DIRECTORY_SEPARATOR;

	function add(\Books\Book $book) {
		$this->ensurePersistenceDirectoryExists();

		file_put_contents(self::$persistenceDir . self::$DS . $book->getTitle(), $book);
	}

	function remove($pattern) {
		// TODO: Implement remove() method.
	}

	function select($pattern) {
		if ($pattern == '*') {
			$this->ensurePersistenceDirectoryExists();
			$allBooks = [];
			$directoryIterator = new \DirectoryIterator(self::$persistenceDir);
			foreach ($directoryIterator as $fileInfo) {
				if (!$fileInfo->isFile()) {
					continue;
				}
				$allBooks[] = $this->select('title=' . $fileInfo->getFilename());
			}
			return $allBooks;
		} else {
			list($paramName, $title) = explode('=', $pattern);
			$bookAsString = file_get_contents(self::$persistenceDir . self::$DS . $title);
			$bookAsArray = $this->stringRepresentationToRequestModel($bookAsString);
			return $bookAsArray;
		}
	}

	private function stringRepresentationToRequestModel($bookAsString) {
		$bookAsArray = [];
		$bookAsLines = $this->splitIntoLines($bookAsString);
		foreach ($bookAsLines as $bookParamString) {
			$propertyValPair = explode("=", $bookParamString);
			if (count($propertyValPair) != 2) {
				continue;
			}
			$propertyValPair = $this->translateToRequestModel($propertyValPair);
			$bookAsArray[$propertyValPair[0]] = $propertyValPair[1];
		}
		return $bookAsArray;
	}

	private function splitIntoLines($string) {
		return explode("\n", $string);
	}

	private function translateToRequestModel($propertyValPair) {
		if (isset(self::$propertyReqeustModelMap[$propertyValPair[0]])) {
			return [self::$propertyReqeustModelMap[$propertyValPair[0]], $propertyValPair[1]];
		}
		return [strtolower($propertyValPair[0]), $propertyValPair[1]];
	}

	private function ensurePersistenceDirectoryExists() {
		if (!file_exists(self::$persistenceDir)) {
			mkdir(self::$persistenceDir);
		}
	}
}