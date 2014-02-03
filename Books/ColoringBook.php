<?php
namespace Books;

class ColoringBook extends Book {

	private $recommendedAge = array();
	private $introductionToParents;

	public function __construct($title = 'N/A') {
		parent::__construct($title, 'Not Required');
	}

	public function getRecommendedAge() {
		return $this->recommendedAge;
	}

	public function setRecommendedAge($recommendedAge) {
		$this->recommendedAge = $recommendedAge;
	}

	function setIntroToParents($pageNumbers) {
		$this->introductionToParents = $pageNumbers;
	}

	function numberOfPages() {
		return $this->allPages - self::COVERPAGES - $this->introductionToParents;
	}




}

?>
