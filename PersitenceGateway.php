<?php

interface PersitenceGateway {

	function save(array $books, $filePath);

	function loadFromFile($filePath);
}

?>
