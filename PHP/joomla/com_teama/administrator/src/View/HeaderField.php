<?php

namespace TheLoneBlackSheep\Component\TeamA\Administrator\View;

class HeaderField {

	public string $label;

	public string $name;

	public function __construct($name, $label) {
		$this->name = $name;
		$this->label = $label;
	}

}