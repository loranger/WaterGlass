WaterGlass
========

Template dans un verre d'eau
----------------------------------------

WaterGlass is a tiny and very (very) simple template engine using PHP DOM Implementation...  

“PHP is a template engine so you don't need to use another one”. Ok, so WaterGlass may help because it's build on the PHP DOM Implementation itself.  

Basically, it's a kind of wrapper which extends DOMDocument. Once the template is loaded and parsed, every single DOM node can be modified or deleted. WaterGlass provide few methods to alter the template easily.

**Requirements**

* [PHP5](http://www.php.net/) with [DOM](http://php.net/manual/book.dom.php) extension

**To do**

* A real Getting started article
* A Documentation
* Caching system using [APC](http://php.net/manual/book.apc.php)
* Global variables replacements ( ie : `WaterGlass::setVars( $array)` )
* Template inheritance

**Getting started**

Take a look at demo.php and demo_template.html for a real world example