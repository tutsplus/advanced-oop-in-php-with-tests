<?php

class LibraryFacade {

	private $library;

	public function __construct() {
		$this->library = new Library();
		$this->library->loadFromFile();
	}

	function findAll() {
		return $this->library->findAll();
	}

	function addBook($title, $author) {
		$this->library->add(new Novel($title, $author));
		$this->library->save();
	}

}

?>
