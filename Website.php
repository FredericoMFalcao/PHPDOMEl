<?php

require_once "DOMEl.php";

class Website {

	private $html;
	private $head;
	private $body;

	public function __construct() {
		$this->html = (new DOMEl("html"))->attr("xmlns","http://www.w3.org/1999/xhtml");
		$this->head = new DOMEl("head");
		$this->body = new DOMEl("body");
	}

	public function addJSLib(string $url) {
		$this->head->addChild((new DOMEl("script"))->attr("src",$url));
		return $this;
	}
	public function addCSSStyleSheet(string $url) {
		$this->head->addChild((new DOMEl("link"))->attr("rel","stylesheet")->attr("href",$url));
		return $this;
	}

	public function setTitle(string $title) {
		$this->head->addChild((new DOMEl("title"))->setText($title));
		return $this;
	}



	public function render() {
		$this->html->addChild($this->head);
		$this->html->addChild($this->body);

		$this->html->addChild(
			(new DOMEl("body"))
		);

		return $this->html;
	}

	public function __toString() { return $this->render(); }



}