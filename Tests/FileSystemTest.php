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

		$expectedNovel = [
			'title' => 'Star Trek',
			'author' => 'Gene Roddenberry',
			'bookType' => 'nv',
			'allpages' => null,
			'category' => null
		];
		$actualNovel = $p->select('Title=Star Trek');

		$this->assertEquals([$expectedNovel], $actualNovel);
	}

	function testItCanFindAuthor() {
		$p = new FileSystem();
		$novel = $this->createBook();
		$p->add($novel);
		$p->add(new \Books\Novel('T', 'A'));

		$expectedNovel = [[
			'title' => 'Star Trek',
			'author' => 'Gene Roddenberry',
			'bookType' => 'nv',
			'allpages' => null,
			'category' => null
		]];
		$actualNovel = $p->select('Author=Gene Roddenberry');

		$this->assertEquals($expectedNovel, $actualNovel);
	}

	function testItCanFindAllTheBooks() {
		$p = new FileSystem();
		$novel = $this->createBook();
		$p->add($novel);
		$p->add(new \Books\Novel('T', 'A'));

		$expectedNovel = [
			[
				'title' => 'T',
				'author' => 'A',
				'bookType' => 'nv',
				'allpages' => null,
				'category' => null
			],
			[
				'title' => 'Star Trek',
				'author' => 'Gene Roddenberry',
				'bookType' => 'nv',
				'allpages' => null,
				'category' => null
			]
		];
		$actualNovel = $p->select('*');

		$this->assertEquals($expectedNovel, $actualNovel);
	}

	function testItCanRemoveBooks() {
		$p = new FileSystem();
		$novel = $this->createBook();
		$p->add($novel);
		$p->add(new \Books\Novel('T', 'A'));

		$p->remove('title=T');

		$expectedBook = [
			'title' => 'Star Trek',
			'author' => 'Gene Roddenberry',
			'bookType' => 'nv',
			'allpages' => null,
			'category' => null
		];
		$this->assertEquals([$expectedBook], $p->select('*'));
	}

	private function createBook() {
		return new \Books\Novel('Star Trek', 'Gene Roddenberry');
	}

}
 