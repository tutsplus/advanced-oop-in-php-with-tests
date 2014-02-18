<?php

namespace Persistence;

class FileSystemTest extends \PHPUnit_Framework_TestCase {

	function tearDown() {
		foreach (glob(FileSystem::$persistenceDir . DIRECTORY_SEPARATOR . '*') as $file) {
			unlink($file);
		}
		rmdir(FileSystem::$persistenceDir);
	}

	function testItCanAddABookToThePersistence() {
		$p = new FileSystem();
		$novel = new \Books\Novel('Star Trek', 'Gene Roddenberry');
		$p->add($novel);

		$plaintextBook = file_get_contents(FileSystem::$persistenceDir . DIRECTORY_SEPARATOR . $novel->getTitle());
		$this->assertEquals($novel->__toString(), $plaintextBook);

	}

}
 