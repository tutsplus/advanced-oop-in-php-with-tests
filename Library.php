<?php

class Library {

	private $persistence;

	public function __construct(PersitenceGateway $persistence = null) {
		$this->persistence = $persistence ? : new \Persistence\InMemory();
	}

	function add(\Books\Book $book) {
		$this->persistence->add($book);
	}

	function findAll() {
		return $this->persistence->select('*');
	}

	function findByTitle($title) {
		return $this->persistence->select('title=' . $title);
	}

	function removeByTitle($title) {
		$this->persistence->remove('title=' . $title);
	}

}

?>
