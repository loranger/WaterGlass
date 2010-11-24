<?php

require_once('WaterGlass.php');

$template = new WaterGlass('demo_template.html');

// Using Template TAG Variables
$template->setVariableTag('tpl');

$template->add('page_title', 'Demo Template');

$template->set('big_text', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non <a href="http://www.urban-rivals.com">proident</a>, sunt in culpa qui officia deserunt mollit anim id est laborum.');



// Using existing DOM element
$template->set('#another_big_text', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non <a href="http://www.urban-rivals.com">proident</a>, sunt in culpa qui officia deserunt mollit anim id est laborum.');



// Looping on a "loopable" element
$arr = array('dummy', 'fake', 'item', 'none');
$template->loop('.item_list', $arr);

$template->set('.multiple', 'My clone and I');



// Using DOMElement's attributes
$logo_src = 'http://github.com/images/modules/header/logov3-hover.png';
$img = $template->getElement('#logo');
$img->setAttribute('src', $logo_src);

$bold = $template->getElement('#nomore');
$bold->parentNode->removeChild($bold);


echo $template;


?>