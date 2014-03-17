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
		$foundBooks = $this->select($pattern);
		foreach($foundBooks as $book) {
			$bookFile = self::$persistenceDir . self::$DS . $book['title'];
			if(file_exists($bookFile)) {
				unlink($bookFile);
			}
		}
	}

	function select($pattern) {
		if ($pattern == '*') {
			return $this->getAllBooks();
		} else {
			list($paramName, $value) = explode('=', $pattern);
			if (strtolower($paramName) == 'title') {
				return [$this->getBooksByTitle($value)];
			}
			return $this->getBooksByAnyProperty($pattern);
		}
	}

	private function getBookFromFile($filePath) {
		$bookAsString = file_get_contents($filePath);
		return $this->stringRepresentationToRequestModel($bookAsString);
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

	private function getAllBooks() {
		$this->ensurePersistenceDirectoryExists();
		$allBooks = [];
		$directoryIterator = new \DirectoryIterator(self::$persistenceDir);
		foreach ($directoryIterator as $fileInfo) {
			if (!$fileInfo->isFile()) {
				continue;
			}
			$allBooks[] = $this->getBooksByTitle( $fileInfo->getFilename());
		}
		return $allBooks;
	}

	private function getBooksByTitle($value) {
		return $this->getBookFromFile(self::$persistenceDir . self::$DS . $value);
	}

	private function getBooksByAnyProperty($pattern) {
		$foundBooks = [];
		exec('grep -H -r "' . $pattern . '" ' . self::$persistenceDir, $output);
		foreach ($output as $fileAndString) {
			$fullFilename = explode(':', $fileAndString)[0];
			$foundBooks[] = $this->getBookFromFile($fullFilename);
		}
		return $foundBooks;
	}
}