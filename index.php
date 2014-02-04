<!DOCTYPE html>

<?php
	require_once './autoload.php';
	$libraryFacade = new LibraryFacade();
	if(isset($_GET['Add'])) {
		$requestModel = [
			'bookType' => $_GET['bookType'],
			'title' => $_GET['title'],
			'author' => $_GET['author']
		];
		$libraryFacade->addBook($requestModel);
	}

	$allBooks = $libraryFacade->findAll();
?>

<html>
	<head>
		<title>Tuts Library</title>

	</head>

	<body style="background-color: #2e3436; color: white;">

		<a href='index.php' style='color:white;'>Home</a>
		<br/><br/>

		<form action="" method='GET'>
			<div>Add a new book to the library</div>
			<label for='title'>Title</label>
			<input id='title' type='text' name='title'/>
			<br/>
			<label for='author'>Author</label>
			<input id='author' type='text' name='author'/>
			<br/>
			<label for="bookType">Select a book type</label>
			<select id="bookType" name="bookType">
				<option value="nv">Novel</option>
				<option value="cb">Coloring Book</option>
			</select>
			<br />
			<input type='submit' name='Add' value='Add'>
		</form>


		<div>Existing books in the library:</div>

		<ul>
			<?php foreach($allBooks as $book):?>
			<li><?= $book->getTitle(); ?>
				a <?= $book->getType(); ?>
				<i>by <?= $book->getAuthor(); ?></i>
			</li>
			<?php endforeach;?>
		</ul>

	</body>
</html>
