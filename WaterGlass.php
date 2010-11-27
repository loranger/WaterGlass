<?php

class WaterGlass extends DOMDocument
{
	private $varTagName;
	private $customVars = array();

	function __construct( $content, $var_tag_name = 'wg' )
	{
		parent::__construct();

		$this->strictErrorChecking = false;
		$this->preserveWhiteSpace = false;
		$this->formatOutput = true;
		if( is_file($content) )
		{
			$this->loadFromFile($content);
		}
		else
		{
			$this->loadFromString($content);
		}
		
		$this->setVariableTag( $var_tag_name );
	}

	private function loadFromFile( $filename )
	{
		@$this->loadHTMLFile( $filename );
	}

	private function loadFromString( $string )
	{
		@$this->loadHTML( $filename );
	}

	private function fetchVars()
	{
		if( $list = $this->find( sprintf('%s[id]', $this->varTagName) ) )
		{
			foreach ($list as $element)
			{
				$this->customVars[ $element->getAttribute('id') ] = $element;
			}			
		}
	}

	private function find( $expression )
	{
		if( array_key_exists( $expression, $this->customVars ) )
		{
			return array($this->customVars[$expression]->parentNode);
		}
		else
		{
			$xpath = new DOMXPath($this);
			if(!preg_match('/\//', $expression))
			{
				$sel = new DOMSelector($expression);
				$expression = $sel->toXpath();
			}
			$nodelist = $xpath->query($expression, $this);

			$list = array();
			foreach($nodelist as $node)
			{
				$list[] = $node;
			}

			return ( count($list) ) ? $list : false;
		}
	}

	private function inject($expression, $value, $replace_content = false, $duplicate_element = false)
	{
		if( is_array($value) )
		{
			foreach( $value as $iter )
			{
				$this->inject($expression, $iter, $replace_content, $duplicate_element);
			}
		}
		else
		{
			$elements = $this->find( $expression );
			if( !$elements )
			{
				throw new Exception( sprintf('%s element not found', $expression) );
			}

			if( $duplicate_element && count($elements) )
			{
				$source = $elements[count($elements) - 1];
				if( count($elements) == 1 )
				{
					$this->customVars[uniqid()] = $source;
				}
				$clone = $source->cloneNode( true );
				$clone->removeAttribute('id');
				$source->parentNode->appendChild( $clone );
				$elements = array($clone);
			}

			foreach ($elements as $element) {
				$fragment = $this->createDocumentFragment();
				$fragment->appendXML( $value );
				if( $replace_content && $element->hasChildNodes() )
				{
					foreach( $element->childNodes as $child)
					{
						$element->removeChild( $child );
					}
				}
				$element->appendChild($fragment);
			}
		}
	}
	
	function setVariableTag( $name )
	{
		$this->varTagName = $name;
		$this->fetchVars();
	}

	function getElement( $expression )
	{
		$list = $this->find( $expression );
		return ( $list && is_array($list) && count($list) == 1) ? $list[0] : $list;
	}

	function set($expression, $value)
	{
		return $this->inject($expression, $value, true);
	}
	
	function setAll($array)
	{
		foreach ($array as $expression => $value) {
			$this->set($expression, $value);
		}
	}

	function add($expression, $value)
	{
		return $this->inject($expression, $value);
	}
	
	function addAll($array)
	{
		foreach ($array as $expression => $value) {
			$this->add($expression, $value);
		}
	}

	function loop($expression, $value)
	{
		return $this->inject($expression, $value, true, true);
	}

	function __toString()
	{
		foreach($this->customVars as $node)
		{
			$node->parentNode->removeChild( $node );
		}
		return $this->saveXML();
	}

}

class DOMSelector
{
	private $expression;

	function __construct($expression)
	{
		$this->expression = $expression;
	}

	function toXpath()
	{
		$xpath = './/'.$this->expression;
		$xpath = preg_replace("/\[(?!\w+\()/", '[@', $xpath);
		$xpath = preg_replace("/(\#([a-z][a-z0-9_]+))/i", '[@id="$2"]', $xpath);
		$xpath = preg_replace("/(\.([a-z][a-z0-9_]+))/i", '[contains(@class,"$2")]', $xpath);
		$xpath = preg_replace("/\s(\+|\s)+/", '/following-sibling::', $xpath);
		$xpath = preg_replace("/\s(>|\s)*/", '/', $xpath);
		$xpath = preg_replace("/\/\[/", '/*[', $xpath);

		return $xpath;
	}
}

?>