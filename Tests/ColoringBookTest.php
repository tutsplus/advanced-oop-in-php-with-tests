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

	function testItCanTellActualNumberOfPages() {
		$coloringBook = new ColoringBook();
		$coloringBook->setAllPages(100);
		$coloringBook->setIntroToParents(10);
		$this->assertEquals(88, $coloringBook->numberOfPages());
	}
}

?>
