<?php

class SerializedPersister implements PersitenceGateway {

	public function loadFromFile($filePath) {
		if(!file_exists($filePath))
			return [];
		return unserialize(file_get_contents($filePath));
	}

	public function add(array $books, $filePath) {
		file_put_contents($filePath, serialize($books));
	}

	public function remove($string) {
	}

}

?>
