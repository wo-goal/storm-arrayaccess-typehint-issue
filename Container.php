<?php

require_once('ContainerTrait.php');

class Container
{

  use ContainerTrait;

  /**
   * Container constructor.
   * @param array $config Initial values
   */
  public function __construct($config = [])
  {
    $this->fromArray($config);
  }

}
