<?php

require_once '../example.php';

class exampleTest extends PHPUnit_Framework_TestCase {

	private $calculator;
	private $firstNumber;
	private $secondNumber;

	protected function setUp() {
		$this->calculator = new Calculator();
		$this->firstNumber = 3;
		$this->secondNumber = 2;
	}

	function testItCanAddTwoNumbers() {
		$this->assertEquals(5, $this->calculator->add($this->firstNumber, $this->secondNumber));
	}

	function testItCanMultiplyTwoNumbers() {
		$this->assertEquals(6, $this->calculator->multiply($this->firstNumber, $this->secondNumber));
	}

}

?>
