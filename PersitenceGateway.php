<?php

interface PersitenceGateway {

	function add(\Books\Book $book);

	function remove($pattern);

	function select($pattern);

	function loadFromFile($filePath);
}

?>
