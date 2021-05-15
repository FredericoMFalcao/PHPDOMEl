<?php

require "DOMEl.php";

echo (new DOMEl("html"))
    ->attr("lang","en")
    ->addChild(
	(new DOMEl("head"))
    )
;
