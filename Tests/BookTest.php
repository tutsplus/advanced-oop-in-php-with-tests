<?php

namespace Books;

class BookTest extends \PHPUnit_Framework_TestCase {

	private $bookFactory;

	function setUp() {
		$this->bookFactory = new BookFactory();
	}

	function testDifferentBooksCanHaveDifferentTitles() {
		$book1 = $this->createBook();
		$title1 = 'The Great Book of PHP';
		$book1->setTitle($title1);
		$this->assertEquals($title1, $book1->getTitle());

		$book2 = $this->createBook();
		$title2 = 'The Book of Java';
		$book2->setTitle($title2);
		$this->assertEquals($title2, $book2->getTitle());
	}

	function testDifferentBooksCanHaveDifferentAuthors() {
		$book1 = $this->createBook();
		$author1 = 'John Doe';
		$book1->setAuthor($author1);
		$this->assertEquals($author1, $book1->getAuthor());

		$book2 = $this->createBook();
		$author2 = 'The Book of Java';
		$book2->setAuthor($author2);
		$this->assertEquals($author2, $book2->getAuthor());
	}

	function testWeCanCreateANewBookWithTheInformationWeWant() {
		$book = $this->createBook();
		$this->assertEquals('A title', $book->getTitle());
		$this->assertEquals('An author', $book->getAuthor());

	}

	function createBook() {
		$requestModel = [
			'bookType' => 'nv',
			'title' => 'A title',
			'author' => 'An author'
		];
		return $this->bookFactory->makeFromRequestModel($requestModel);
	}

}

?>
