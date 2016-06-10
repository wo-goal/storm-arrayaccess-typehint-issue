<?php

require_once('Collection.php');
require_once('SomeItem.php');

/**
 * @method SomeItem offsetGet($offset)
 */
class SomeItems extends Collection
{

    protected $_itemsType = 'SomeItem';

    public function someMethod()
    {
        
    }

}
