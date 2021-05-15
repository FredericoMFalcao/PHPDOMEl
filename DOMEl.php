<?php

/*
*  Class: DOMEl
*
*  A jQuery inspired PHP DOM element constructor
*/


class DOMEl {

  private $xml_tag;
  private $attributes = [];
  private $children = [];
  private $innerText = "";

  public function __construct(string $xml_tag) { $this->xml_tag = $xml_tag; }

  public function attr(string $key, string $value = null) {
	if (is_null($value)) return $this->attributes[$key];

	$this->attributes[$key] = $value;

	return $this;
  }

  public function addClass(string|array $classes) {
	if (!is_array($classes)) $classes = [$classes];
	foreach($classes as $class) {
		if (isset($this->attributes["class"])) 
			$this->attributes["class"] .= " $class"; 
		else
			$this->attributes["class"] = $class;
	}

	return $this;
  }

  public function addChild(DOMEl $child) { $this->children[] = $child; return $this; }

  public function setText(string $text) { $this->innerText = htmlspecialchars($text); return $this; }

  public function render() {
	if ($this->xml_tag == "br") return "<br/>";
	
	return "<{$this->xml_tag}"
		.array_reduce(array_keys($this->attributes), function($c,$i){return $c." ".$i."=\"".$this->attributes[$i]."\"";},"")
		.">"
		.$this->innerText
		.implode("",array_map(function($o){return $o->render();},$this->children))
		."</{$this->xml_tag}>";
  }

  public function __toString() { return $this->render(); }

}
