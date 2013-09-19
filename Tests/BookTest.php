<?php

class BookTest extends PHPUnit_Framework_TestCase {

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
		$title = 'New Title';
		$author = 'Someone Really Cool';

		$book = new Novel($title, $author);

		$this->assertEquals($title, $book->getTitle());
		$this->assertEquals($author, $book->getAuthor());

	}

	function createBook() {
		return new Novel();
	}

}

?>
