<?php

class LibraryTest extends PHPUnit_Framework_TestCase {

	private $library;
	private $persistence;

	protected function setUp() {
		$this->persistence = \Mockery::mock('PersitenceGateway');
		$this->library = new Library($this->persistence);
	}

	protected function tearDown() {
		\Mockery::close();
	}

	function testItCanHoldABook() {
		$novel = new Novel();
		$this->persistence->shouldReceive('save')->once()->withAnyArgs();
		$this->library->add($novel);

		$this->assertEquals(array($novel), $this->library->findAll());
	}

	function testItCanAddSeveralBooks() {
		$novel = new Novel();
		$anotherNovel = new Novel();
		$this->persistence->shouldReceive('save')->twice()->withAnyArgs();
		$this->library->add($novel);
		$this->library->add($anotherNovel);

		$this->assertEquals(array($novel, $anotherNovel), $this->library->findAll());
	}

	function testItCanFindABookByTitle() {
		$title = 'Interstelar Warrior';
		$novel = $this->aMockedNovelWithTitle($title);
		$anotherNovel = $this->aMockedNovelWithTitle('Hommade Cookies');
		$this->persistence->shouldReceive('save')->twice()->withAnyArgs();
		$this->library->add($novel);
		$this->library->add($anotherNovel);

		$this->assertEquals(array($novel), $this->library->findByTitle($title));
	}

	function testItCanDeleteABookByTitle() {
		$title = 'Interstelar Warrior';
		$novel = $this->aMockedNovelWithTitle($title);
		$anotherNovel = $this->aMockedNovelWithTitle('Hommade Cookies');
		$this->persistence->shouldReceive('save')->twice()->withAnyArgs();
		$this->library->add($novel);
		$this->library->add($anotherNovel);

		$this->library->removeByTitle($title);

		$this->assertEquals(array($anotherNovel), $this->library->findAll());
	}

	function testItCanSaveItselfWithAPersistenceGateway() {
		$novel = new Novel('some title');
		$this->persistence->shouldReceive('save')->once()->withAnyArgs();
		$this->library->add($novel);

		$this->persistence->shouldReceive('save')->once()->with($this->library->findAll(), Library::$persistencePath);
		$this->library->save();
	}

	function testItCanLoadItselfWithAPersistenceGateway() {
		$novel = new Novel('some title');
		$this->persistence->shouldReceive('loadFromFile')->once()->with(Library::$persistencePath)->andReturn(array($novel));

		$this->library->loadFromFile();

		$this->assertEquals([$novel], $this->library->findAll());
	}

//
//	function testItCanSaveItself() {
//		$novel = new Novel('some title');
//		$this->library->add($novel);
//		$this->library->save();
//
//		$this->assertEquals($this->library->findAll(), unserialize(file_get_contents(Library::$persistencePath)));
//	}
//
//	function testItCanLoadBooksFromFile() {
//		$novel = new Novel('some title');
//		$this->library->add($novel);
//		$this->library->save();
//
//		$anotherLibrary = new Library();
//		$anotherLibrary->loadFromFile();
//
//		$this->assertEquals($this->library->findAll(), $anotherLibrary->findAll());
//	}
	private function aMockedNovelWithTitle($title) {
		$novel = $this->getMock('Novel');
		$novel->expects($this->once())->method('getTitle')->will($this->returnValue($title));
		return $novel;
	}

}

?>
