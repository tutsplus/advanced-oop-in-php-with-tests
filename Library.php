<?php

class Library {

	private $books = array();
	private $persistence;
	public static $persistencePath = '/tmp/library.txt';

	public function __construct(PersitenceGateway $persistence = null) {
		$this->persistence = $persistence ? : new SerializedPersister();
	}

	function add(\Books\Book $book) {
		$this->books[] = $book;
		$this->save();
	}

	function findAll() {
		return $this->books;
	}

	function findByTitle($title) {
		return array_filter($this->books, function ($book) use ($title) {
					return $book->getTitle() == $title;
				});
	}

	function removeByTitle($title) {
		$this->books = array_values(
				array_filter($this->books, function ($book) use ($title) {
							return $book->getTitle() != $title;
						})
		);
	}

	function save() {
		$this->persistence->save($this->books, self::$persistencePath);
	}

	function loadFromFile() {
		$this->books = $this->persistence->loadFromFile(self::$persistencePath);
	}

}

?>
