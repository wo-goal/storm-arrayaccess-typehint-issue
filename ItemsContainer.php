<?php

require_once('Container.php');
require_once('SomeItems.php');

/**
 * @property SomeItems $items
 */
class ItemsContainer extends Container
{

    /** @var SomeItems */
    protected $_items;

    /**
     * @return SomeItems
     */
    public function getItems()
    {
        return $this->_items;
    }

    /**
     * @param $items
     */
    public function setItems($items)
    {
        $this->_items = $items;
    }

}
