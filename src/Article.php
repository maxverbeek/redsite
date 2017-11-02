<?php

if (! defined('ROOT')) {
	die('UNAUTHORIZED!');
}

class Article {

	protected $path;
	protected $parser;
	protected $meta = [];
	protected $content;

	public function __construct(Parsedown $parser, $path) {
		$this->parser = $parser;
		$this->path = $path;

		$this->content = file_get_contents($path);

		$this->extractMetaData($this->content);
	}

	protected function extractMetaData($text) {
		$lines = preg_split('/[\r\n]/', $text);

		$i = 0;

		while (isset($lines[$i]) && substr($lines[$i], 0, 1) == ':') {

			$line = substr($lines[$i], 1); // remove the first character

			$key = strstr($line, '=', true);
			$value = $this->parseMetaValue($key, substr(strstr($line, '='), 1));

			$this->meta[$key] = $value;

			$lines[$i++] = '';
		}

		// set content to the text without the metadata
		$this->content = trim(join(PHP_EOL, $lines));
	}

	protected function parseMetaValue($key, $unparsed) {
		switch ($key) {
			case 'date':
				$date = DateTime::createFromFormat('Y-m-d', $unparsed);
				$unparsed = $date->format('l F jS, Y');
				break;

			// add more exceptions here
		}

		return $unparsed;
	}

	protected function getContents() {
		return $this->content;
	}

	public function render() {
		return $this->parser->text($this->getContents());
	}

	public function meta($key) {
		if (isset($this->meta[$key])) return $this->meta[$key];

		return null;
	}
}
