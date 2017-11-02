<?php

if (! defined('ROOT')) {
	die('UNAUTHORIZED!');
}

class Finder {

	protected $parser;
	protected $directory;

	public function __construct(Parsedown $parser) {
		$this->parser = $parser;
		$this->directory = ROOT . '/articles';
	}

	public function list() {
		$articles = [];

		foreach (array_reverse(array_diff(scandir($this->directory), ['.', '..'])) as $file) {
			$articles[] = new Article($this->parser, ROOT . '/articles/' . $file);
		}

		return $articles;
	}
}
