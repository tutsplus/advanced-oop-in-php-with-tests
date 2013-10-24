<!DOCTYPE html>

<?php
	require_once './autoload.php';
	$library = new Library();
	$library->loadFromFile();

	if(isset($_GET['Add']))
		$library->add (new Novel ($_GET['title'], $_GET['author']));

	$library->save();
	$allBooks = $library->findAll();
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
			<input type='submit' name='Add' value='Add'>
		</form>


		<div>Existing books in the library:</div>

		<ul>
			<?php foreach($allBooks as $book):?>
			<li><?= $book->getTitle(); ?>
				<i>by <?= $book->getAuthor(); ?></i>
			</li>
			<?php endforeach;?>
		</ul>

	</body>
</html>
