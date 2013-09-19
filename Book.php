<?php

abstract class Book {
	const COVERPAGES = 2;

	private $title;
	private $author;
	protected $allPages;

	function __construct($title = 'N/A', $author = 'N/A') {
		$this->title = $title;
		$this->author = $author;
	}

	public function getAllPages() {
		return $this->allPages;
	}

	public function setAllPages($allPages) {
		$this->allPages = $allPages;
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

	abstract function numberOfPages();
}

?>
