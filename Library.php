<?php

class Library {

	private $persistence;
	private $bookFactory;

	public function __construct(PersitenceGateway $persistence = null) {
		$this->persistence = $persistence ? : new \Persistence\FileSystem();
		$this->bookFactory = new \Books\BookFactory();
	}

	function add(\Books\Book $book) {
		$this->persistence->add($book);
	}

	function findAll() {
		return $this->bookFactory->makeManyFromRequestModels($this->persistence->select('*'));
	}

	function findByTitle($title) {
		return $this->bookFactory->makeManyFromRequestModels($this->persistence->select('title=' . $title));
	}

	function removeByTitle($title) {
		$this->persistence->remove('title=' . $title);
	}



}

?>
