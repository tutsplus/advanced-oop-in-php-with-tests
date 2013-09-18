<?php

require_once '../Book.php';
require_once '../Novel.php';
require_once '../Library.php';

class LibraryTest extends PHPUnit_Framework_TestCase {

	private $library;

	protected function setUp() {
		$this->library = new Library();
	}

	function testItCanHoldABook() {
		$novel = new Novel();
		$this->library->add($novel);

		$this->assertEquals(array($novel), $this->library->findAll());
	}

	function testItCanAddSeveralBooks() {
		$novel = new Novel();
		$anotherNovel = new Novel();

		$this->library->add($novel);
		$this->library->add($anotherNovel);

		$this->assertEquals(array($novel, $anotherNovel), $this->library->findAll());
	}

	function testItCanFindABookByTitle() {
		$title = 'Interstelar Warrior';
		$novel = $this->aMockedNovelWithTitle($title);
		$anotherNovel = $this->aMockedNovelWithTitle('Hommade Cookies');
		$this->library->add($novel);
		$this->library->add($anotherNovel);

		$this->assertEquals(array($novel), $this->library->findByTitle($title));
	}

	function testItCanDeleteABookByTitle() {
		$title = 'Interstelar Warrior';
		$novel = $this->aMockedNovelWithTitle($title);
		$anotherNovel = $this->aMockedNovelWithTitle('Hommade Cookies');
		$this->library->add($novel);
		$this->library->add($anotherNovel);

		$this->library->removeByTitle($title);

		$this->assertEquals(array($anotherNovel), $this->library->findAll());
	}

	private function aMockedNovelWithTitle($title) {
		$novel = $this->getMock('Novel');
		$novel->expects($this->once())->method('getTitle')->will($this->returnValue($title));
		return $novel;
	}

}

?>
