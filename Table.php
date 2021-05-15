<?php

class Table {

	private $data;
	private $headerCols;

	public function addAssocArray(array $data) {
		$this->headerCols = array_keys($data);
		$this->data = $data; 
		return $this;
	}

	public function asDOMEl() {
		return (new DOMEl("table"))
			->addClass("table")
			->addChild( (new DOMEl("thead"))
				->addChild( (new DOMEl("tr"))
					->addChildren( array_map(function($o) {return (new DOMEl("th"))->setText($o);},$this->headerCols) )
				)
			)
			->addChild( (new DOMEl("tbody"))
				->addChildren( array_map(function($row) {
					return (new DOMEl("tr"))->addChildren(
						array_map(function($cell) {
							return (new DOMEl("td"))->setText($cell);
						},$row)
					);
				},$this->data))
			)
		;
	}

}
