<?php

namespace Persistence;

class FileSystemTest extends \PHPUnit_Framework_TestCase {

	static $DS;

	function setUp() {
		self::$DS = FileSystem::$DS;
	}

	function tearDown() {
		foreach (glob(FileSystem::$persistenceDir . self::$DS . '*') as $file) {
			unlink($file);
		}
		rmdir(FileSystem::$persistenceDir);
	}

	function testItCanAddABookToThePersistence() {
		$p = new FileSystem();
		$novel = $this->createBook();
		$p->add($novel);

		$plaintextBook = file_get_contents(FileSystem::$persistenceDir . self::$DS . $novel->getTitle());
		$this->assertEquals($novel->__toString(), $plaintextBook);

	}

	function testItCanFindABookByTitle() {
		$p = new FileSystem();
		$novel = $this->createBook();
		$p->add($novel);
		$p->add(new \Books\Novel('T', 'A'));

		$expectedNovel = $novel;
		$actualNovel = $p->select('Title=Star Trek');

		$this->assertEquals($expectedNovel, $actualNovel);
		$this->assertInstanceOf('\Books\Novel', $actualNovel);
	}

	private function createBook() {
		return new \Books\Novel('Star Trek', 'Gene Roddenberry');
	}

}
 