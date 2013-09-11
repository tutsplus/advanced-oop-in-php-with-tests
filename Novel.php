<?php

class Novel extends Book {

	public $category;
	private $paperWeight = 5;

	public function setCategory($category) {
		$this->category = $category;
	}

	public function getCategory() {
		return $this->doComplexCategoryGuessing();
	}

	private function doComplexCategoryGuessing() {
		return $this->category;
	}

	public function getWeight() {
		return $this->pageNumber() * $this->paperWeight;
	}

}

?>
