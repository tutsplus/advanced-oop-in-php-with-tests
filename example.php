<?php

class Calculator {

	function add($first, $second) {
		return $first + $second;
	}

	function multiply($first, $second) {
		$result = 0;
		for ($i = 0; $i < $second; $i++)
			$result = $this->add($first, $result);
		return $result;
	}

}


?>
