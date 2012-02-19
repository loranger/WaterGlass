WaterGlass
========

Template dans un verre d'eau
----------------------------------------

WaterGlass is a tiny and very (very) simple template engine using PHP DOM Implementation...

“PHP is a template engine so you don't need to use another one”. Agreed, so WaterGlass may help because it's build on the PHP DOM Implementation itself.

Basically, it's a kind of wrapper which extends DOMDocument. Once the template is loaded and parsed, every single DOM node can be modified or deleted. WaterGlass provide few methods to alter the template easily.

**Requirements**

* [PHP5](http://www.php.net/) with [DOM](http://php.net/manual/book.dom.php) extension

**To do**

* A complete documentation
* Caching system using [APC](http://php.net/manual/book.apc.php)
* Template inheritance

**Getting started**

Create a php file and load the WaterClass library

	require_once('WaterGlass.php');

Then instanciate the WaterGlass class by passing your html template content (this could be a filename instead of an html string)

	$template = new WaterGlass('<h2>My Title</h2><div id="mytext">This is a text</div><div class="extra">Here is an extra div</div><ul><li>list item</li></ul>');

Now, you're ready to alter your template and set the content you wish to whatever element you want.  
Let say you want to change your title to a more exciting one. Simply use a classic CSS selector to target your element and specify your new content.  
This works with all the major CSS selectors (your favorite one is missing ? Please tell me)

	$template->set('h2', "I'm so exciting");

You can set the value of an element using the `set` method, but you can also add a value to an exisiting one with the `add` method and you can clone an element to populate them with multiple values using the `loop` method

	$template->add('#mytext', ", the most textual I can write.");
	$template->set('div.extra', "extra information is extra");
	$template->loop('ul li', array('one', 'two', 'three', 'four'));

Once you're done, just output the WaterGlass instanciation and you'll get the template back, in the state you left it.

	echo $template;

This should display

	<?xml version="1.0" standalone="yes"?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/REC-html40/loose.dtd">
	<html>
	  <body><h2>I'm so exciting</h2>
	<div id="mytext">This is a text, the most textual I can write.</div>
	<div class="extra">extra information is extra</div>
	<ul>
	<li>one</li><li>two</li><li>three</li><li>four</li></ul></body>
	</html>


You can also use custom tag names, it's perfect for placeholders or temporary html code : Unused or remaining tags are removed when the template is display.  
Take a look at the demo folder (index.php and template.html) for a real world example

`♡ Copying is an act of love. Please copy.`