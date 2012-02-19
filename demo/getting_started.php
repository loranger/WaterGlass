<?php

require_once('../WaterGlass.php');

$template = new WaterGlass('<h2>My Title</h2>
<div id="mytext">This is a text</div>
<div class="extra">Here is an extra div</div>
<ul>
	<li>list item</li>
</ul>');

$template->set('h2', "I'm so exciting");
$template->add('#mytext', ", the most textual I can write.");
$template->set('div.extra', "extra information is extra");

$template->loop('ul li', array('one', 'two', 'three', 'four'));

echo $template;

?>