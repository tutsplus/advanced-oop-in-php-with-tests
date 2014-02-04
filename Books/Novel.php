<?php
namespace Books;

class Novel extends Book {

	public $category;
	private $paperWeight = 5;
	protected $type = 'Novel';

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
		return $this->numberOfPages() * $this->paperWeight;
	}

	function numberOfPages() {
		return $this->allPages - self::COVERPAGES;
	}

}

?>
