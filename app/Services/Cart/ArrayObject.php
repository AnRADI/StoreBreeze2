<?php


namespace App\Services\Cart;


class ArrayObject implements \ArrayAccess, \Iterator, \Countable
{
	public $items = [];
	protected $_position;


	public function offsetExists($offset)
	{
		return isset($this->items[$offset]);
	}


	public function offsetGet($offset)
	{
		return $this->offsetExists($offset) ? $this->items[$offset] : null;
	}


	public function offsetSet($offset, $value)
	{
		if (is_null($offset))
		{
			$this->items[] = $value;
		}
		else
		{
			$this->items[$offset] = $value;
		}
	}


	public function offsetUnset($offset)
	{
		unset($this->items[$offset]);
	}


	public function rewind()
	{
		reset($this->items);

		$this->_position = key($this->items);
	}


	public function current()
	{
		return $this->items[$this->_position];
	}


	public function key()
	{
		return $this->_position;
	}


	public function next()
	{
		next($this->items);

		$this->_position = key($this->items);
	}


	public function valid()
	{
		return isset($this->items[$this->_position]);
	}


	public function count()
	{
		return count($this->items);
	}
}