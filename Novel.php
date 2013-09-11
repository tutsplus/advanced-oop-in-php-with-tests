<?php

class Novel extends Book {

	private $category;

	public function setCategory($category) {
		$this->category = $category;
	}

	public function getCategory() {
		return $this->category;
	}

}

?>
