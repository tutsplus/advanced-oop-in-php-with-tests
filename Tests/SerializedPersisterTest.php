<?php

class SerializedPersisterTest extends PHPUnit_Framework_TestCase {

	private $persister;
	private static $persistencePath = '/tmp/persister.txt';

	function testItCanPersistAnArray() {
		$books = [new \Books\Novel('something else')];
		$persister = new SerializedPersister();

		$persister->save($books, self::$persistencePath);

		$this->assertEquals($books, unserialize(file_get_contents(self::$persistencePath)));
	}

	function testItCanLoadAnArrayFromFile() {
		$books = [new \Books\Novel('something else')];
		$persister = new SerializedPersister();
		$persister->save($books, self::$persistencePath);

		$this->assertEquals($books, $persister->loadFromFile(self::$persistencePath));
	}

	function testItWillNOTBreakWhenWeTryToLoadItFromAnInexitentFile() {
		$persister = new SerializedPersister();
		$this->assertEquals(array(), $persister->loadFromFile('inexitent/file/path'));
	}

}

?>
