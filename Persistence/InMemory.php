<?php

namespace Persistence;


class InMemory implements \PersitenceGateway {

	private $inMemoryDatabase = [];

	function add(\Books\Book $book) {
		$this->inMemoryDatabase[] = [
			'title' => $book->getTitle(),
			'author' => $book->getAuthor(),
			'bookType' => $book->getType(),
			'allpages' => $book->getAllPages(),
			'category' => null
		];
	}

	function remove($pattern) {
		$this->removeByTitle($this->getTitleFromPattern($pattern));
	}

	function select($pattern) {
		if ($pattern == '*') {
			return $this->inMemoryDatabase;
		} elseif (strpos($pattern, 'title=') !== false) {
			return $this->findByTitle($this->getTitleFromPattern($pattern));
		}

		return [];
	}

	private function findByTitle($title) {
		return array_filter($this->inMemoryDatabase, function ($book) use ($title) {
			return $book['title'] == $title;
		});
	}

	private function removeByTitle($title) {
		$this->inMemoryDatabase = array_values(
			array_filter($this->inMemoryDatabase, function ($book) use ($title) {
				return $book['title'] != $title;
			})
		);
	}

	private function getTitleFromPattern($pattern) {
		$titleArray = explode('=', $pattern);
		$title = end($titleArray);
		return $title;
	}
}