<?php

class LibraryTest extends PHPUnit_Framework_TestCase {

	private $library;
	private $persistence;

	protected function setUp() {
		$this->persistence = new \Persistence\InMemory();
		$this->library = new Library($this->persistence);
	}

	protected function tearDown() {
		\Mockery::close();
	}

	function testItCanHoldABook() {
		$novel = new \Books\Novel();
		$this->library->add($novel);

		$this->assertEquals(array($novel), $this->library->findAll());
	}

	function testItCanFindAllBooksFromPersistence() {
		$novel = new \Books\Novel();
		$this->persistence->add($novel);

		$this->assertEquals([$novel], $this->library->findAll());
	}

	function testItCanAddSeveralBooks() {
		list($novel, $anotherNovel) = $this->addTwoNovelsToTheLibrary('anything');
		$this->assertEquals([$novel, $anotherNovel], $this->library->findAll());
	}

	function testItCanFindABookByTitle() {
		$title = 'Interstelar Warrior';
		list($novel, $anotherNovel) = $this->addTwoNovelsToTheLibrary($title);
		$this->assertEquals([$novel], $this->library->findByTitle($title));
	}

	function testItCanDeleteABookByTitle() {
		$title = 'Interstelar Warrior';
		list($novel, $anotherNovel) = $this->addTwoNovelsToTheLibrary($title);
		$this->library->removeByTitle($title);
		$this->assertEquals([$anotherNovel], $this->library->findAll());
	}

	private function addTwoNovelsToTheLibrary($title) {
		$novel = new \Books\Novel($title);
		$anotherNovel = new \Books\Novel('Hommade Cookies');
		$this->library->add($novel);
		$this->library->add($anotherNovel);
		return [$novel, $anotherNovel];
	}


}

?>
