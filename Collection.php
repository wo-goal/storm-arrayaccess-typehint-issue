<?php

class Collection implements \Countable, \IteratorAggregate, \ArrayAccess
{

  /** @var array */
  protected $_items = [];

  /** @var null|string Item's type */
  protected $_itemsType = null;

  /**
   * @return null|string
   */
  public function getItemsType()
  {
    return $this->_itemsType;
  }

  /*
   * \Countable interface
   */

  public function count()
  {
    return count($this->_items);
  }

  /*
   * \IteratorAggregate interface
   */

  public function getIterator()
  {
    return new \ArrayIterator($this->_items);
  }

  /*
   * \ArrayAccess interface
   */

  public function offsetExists($offset)
  {
    return array_key_exists($offset, $this->_items);
  }

  public function offsetGet($offset)
  {
    return isset($this->_items[$offset]) ? $this->_items[$offset] : null;
  }

  public function offsetSet($offset, $value)
  {
    if (!(is_null($this->_itemsType) || $value instanceof $this->_itemsType)) {
      throw new \Exception(sprintf('%s item type must be "%s", but "%s" given',
        get_class($this), $this->_itemsType, get_class($value)));
    }
    if (is_null($offset)) {
      $this->_items[] = $value;
    } else {
      $this->_items[$offset] = $value;
    }
  }

  public function offsetUnset($offset)
  {
    unset($this->_items[$offset]);
  }

}
