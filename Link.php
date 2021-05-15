<?php

require_once "DOMEl.php";

class Link extends DOMEl {

	public function __construct(string $label, string $url) { 
		parent::__construct("a");
		$this->setText($label);
		$this->attr("href",$url);
	}
	
}
