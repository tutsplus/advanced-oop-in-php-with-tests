<?php

class Library {
	private $books = array();

	function add(Book $book) {
		$this->books[] = $book;
	}

	function findAll() {
		return $this->books;
	}

	function findByTitle($title) {
		return array_filter($this->books, function ($book) use ($title){
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

}

?>
