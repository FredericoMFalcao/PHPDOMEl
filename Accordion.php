<?php

class Accordion {
	
	private $items = [];

	public function addChildren(array $items) { foreach($items as $item) call_user_func_array([$this,"addChild"],$item); return $this; }
	public function addChild(string $label, DOMEl $content)  { $this->items[] = ["label"=>$label, "content" => $content]; return $this;}
	public function asDOMEl() {
		$md5OfWholeAccordion = md5(json_encode($this->items));
		return (new DOMEl("div"))
			->addClass("accordion")
			->attr("id","_".$md5OfWholeAccordion)
			->addChildren(
				array_map(function($item) use ($md5OfWholeAccordion) { 
					extract($item); 
					return (new DOMEl("div"))
					->addClass("accordion-item")
					->addChild(
						(new DOMEl("h2"))
						->addClass("accordion-header")
						->addChild( (new DOMEl("button"))
								->addClass(["accordion-button","collapsed"])
								->attr("type","button")
								->attr("data-bs-toggle","collapse")
								->attr("data-bs-target","#_".md5($content))
								->setText($label)
						)
					)->addChild(
						(new DOMEl("div"))
						->addClass(["accordion-collapse","collapse"])
						->attr("id",md5($content))
						->attr("data-bs-parent","#_".$md5OfWholeAccordion)
						->addChild(
							( new DOMEl("div") )
							->addClass("accordion-body")
							->addChild( $content )
				
						)
					);
			     },$this->items)
			);
	}
}
