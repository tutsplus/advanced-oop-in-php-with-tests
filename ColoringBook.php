<?php

class ColoringBook extends Book {

	private $recommendedAge = array();

	public function __construct($title = 'N/A') {
		parent::__construct($title, 'Not Required');
	}

	public function getRecommendedAge() {
		return $this->recommendedAge;
	}

	public function setRecommendedAge($recommendedAge) {
		$this->recommendedAge = $recommendedAge;
	}




}

?>
