<?php
require_once __DIR__ . '/../Book.php';
require_once __DIR__ . '/../Novel.php';
require_once __DIR__ . '/../ColoringBook.php';

class NovelTest extends PHPUnit_Framework_TestCase {

	function testNovel() {
		$title = 'The Lov of My Life';
		$author = 'Romantic Writer';
		$novel = new Novel($title, $author);
		$novel->setCategory('romance');

		$this->assertEquals('romance', $novel->getCategory());
		$this->assertEquals($title, $novel->getTitle());
		$this->assertEquals($author, $novel->getAuthor());
	}


}

?>
