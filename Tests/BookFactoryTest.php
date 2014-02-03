<?php

namespace Books;

class BookFactoryTest extends \PHPUnit_Framework_TestCase {

	function testItCanCreateANovel() {
		$requestModel = [
			'title' => 'A new title',
			'author' => 'Some author',
			'bookType' => 'nv'
		];
		$factory = new BookFactory();
		$novel = new Novel($requestModel['title'], $requestModel['author']);
		$this->assertEquals($novel, $factory->makeFromRequestModel($requestModel));
	}

	function testItCanCreateAColoringBook() {
		$requestModel = [
			'title' => 'A new title',
			'author' => 'Some author',
			'bookType' => 'cb'
		];
		$factory = new BookFactory();
		$novel = new ColoringBook($requestModel['title'], $requestModel['author']);
		$this->assertEquals($novel, $factory->makeFromRequestModel($requestModel));
	}

	/**
	 * @expectedException \Books\NoSuchBookTypeException
	 **/
	function testAnExcpetionShouldBeThrownWhenAWrongRequestModelIsSentIn() {
		$requestModel = [
			'title' => 'A new title',
			'author' => 'Some author',
			'bookType' => 'error or mistake'
		];
		$factory = new BookFactory();
		$factory->makeFromRequestModel($requestModel);
	}

}
 