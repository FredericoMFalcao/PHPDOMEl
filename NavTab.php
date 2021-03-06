<?php

require_once "DOMEl.php";
require_once "Link.php";

class NavTab {

	private $tabs = [];

	public function addTabs(array $tabs) { foreach($tabs as $tab) call_user_func_array([$this,"addTab"],$tab); return $this;}
	public function addTab(string $label, DOMEl $content, int $active = -1) {
		if ($active == -1 && empty($this->tabs)) $active = 1;
		if ($active == -1 && !empty($this->tabs)) $active = 0;
		$this->tabs[$label] = ["active"=>$active, "content"=>$content];
		return $this;
	}

	public function render() {
		return (new DOMEl("div"))->addChild(
				(new DOMEl("ul"))
				->addClass(["nav","nav-tabs"])
				->addChildren(array_map(function($label) {
						return (new DOMEl("li"))
							->addClass("nav-item")
							->attr("role","presentation")
							->addChild(
								(new Link($label,"#"."_".md5($label)))
								->addClass("nav-link")
								->attr("data-bs-toggle","tab")
								->addClass(($this->tabs[$label]["active"]?"active":""))
							)
							;
					},array_keys($this->tabs))
				)
			)->addChild(
				(new DOMEl("div"))
				->addClass("tab-content")
				->addChildren(array_map(function($label){
						return (new DOMEl("div"))
							->addClass(["tab-pane","fade"])
							->attr("id","_".md5($label))
							->attr("role","tabpanel")
							->addClass(($this->tabs[$label]["active"]?["active","show"]:""))
							->addChild($this->tabs[$label]["content"])
						;
					},array_keys($this->tabs))
				)

			)
		;
	}

}
