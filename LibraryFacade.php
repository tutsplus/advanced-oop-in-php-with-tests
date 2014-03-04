<?php

class LibraryFacade {

	private $library;
	private $bookFactory;

	public function __construct() {
		$this->library = new Library();
		$this->bookFactory = new \Books\BookFactory();
	}

	function findAll() {
		return $this->library->findAll();
	}

	function addBook($requestModel) {
		$this->library->add($this->bookFactory->makeFromRequestModel($requestModel));
	}

}

?>
