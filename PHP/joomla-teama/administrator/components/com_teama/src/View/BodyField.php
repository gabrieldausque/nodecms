<?php

namespace TheLoneBlackSheep\Component\TeamA\Administrator\View;

class BodyField {

	public function __construct(string $name, $isFieldSet = false) {
		$this->name = $name;
		$this->isFieldSet = $isFieldSet;
	}

	public string $name;

	public bool $isFieldSet = false;
}