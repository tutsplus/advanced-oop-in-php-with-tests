<?php

class ColoringBookTest extends PHPUnit_Framework_TestCase {

	function testColoringBooks() {
		$title = 'Rainbow';
		$coloringBook = new ColoringBook($title);
		$range = range(2, 4);
		$coloringBook->setRecommendedAge($range);

		$this->assertEquals($range, $coloringBook->getRecommendedAge());
		$this->assertEquals($title, $coloringBook->getTitle());
		$this->assertEquals('Not Required', $coloringBook->getAuthor());
	}

}

?>
