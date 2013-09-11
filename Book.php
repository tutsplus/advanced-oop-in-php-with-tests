<?php

class Book {

	private $title;
	private $author;

	function __construct($title = 'N/A', $author = 'N/A') {
		$this->title = $title;
		$this->author = $author;
	}

	public function getAuthor() {
		return $this->author;
	}

	public function setAuthor($author) {
		$this->author = $author;
	}

	public function getTitle() {
		return $this->title;
	}

	public function setTitle($title) {
		$this->title = $title;
	}

	protected function pageNumber() {
		return 100;
	}

}

?>
