<?php

require_once('../WaterGlass.php');

$template = new WaterGlass('template.html');

// Using Template TAG Variables
// Note : This could also have been achieved by passing 'tpl' as a the second argument of the WaterGlass constructor
$template->setVariableTag('tpl');

// Finding the tpl tag identified by "page_title" and replacing it with the value "Demo Template"
// Note : It works as "adding" the value to the tpl#page_title's parent
$template->add('page_title', 'Demo Template');

// Finding the tpl#big_text, and replacing its parent's content with the given html text
// Note : It works as "setting" the tpl#big_text's parent content
$template->set('big_text', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non <a href="http://www.google.com">proident</a>, sunt in culpa qui officia deserunt mollit anim id est laborum.');


// Using existing DOM element with CSS selector
$template->set('#another_big_text', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non <a href="http://www.yahoo.com">proident</a>, sunt in culpa qui officia deserunt mollit anim id est laborum.');



// Duplicating an element and setting their values
$arr = array('dummy', 'fake', 'item', 'none');
$template->loop('.item_list', $arr);

// Set the value of every elements found
$template->set('.multiple', 'My clone and I');



// Using DOMElement API From PHP
// Note : getElement method returns a DOMElement
$img = $template->getElement('#logo');
$img->setAttribute('src', 'http://github.com/images/modules/header/logov3-hover.png');

$bold = $template->getElement('#nomore');
$bold->parentNode->removeChild($bold);


echo $template;


?>