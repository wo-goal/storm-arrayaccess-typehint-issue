<?php

trait ContainerTrait
{

  public function __get($name)
  {
    $getter = 'get' . $name;
    if (method_exists($this, $getter)) {
      return $this->$getter();
    } else if (method_exists($this, 'set' . $name)) {
      throw new \Exception('Getting write-only property: ' . get_class($this) . '::' . $name);
    } else {
      throw new \Exception('Getting unknown property: ' . get_class($this) . '::' . $name);
    }
  }

  public function __set($name, $value)
  {
    $setter = 'set' . $name;
    if (method_exists($this, $setter)) {
      $this->$setter($value);
    } else if (method_exists($this, 'get' . $name)) {
      throw new \Exception('Setting read-only property: ' . get_class($this) . '::' . $name);
    } else {
      throw new \Exception('Setting unknown property: ' . get_class($this) . '::' . $name);
    }
  }

  public function __isset($name)
  {
    $getter = 'get' . $name;
    return method_exists($this, $getter) ? ($this->$getter() !== null) : false;
  }

  public function __unset($name)
  {
    $setter = 'set' . $name;
    if (method_exists($this, $setter)) {
      $this->$setter(null);
    } else {
      throw new \Exception('Unsetting read-only property: ' . get_class($this) . '::' . $name);
    }
  }

  /**
   * @return array
   */
  public function toArray()
  {
    $result = [];
    foreach (get_class_methods($this) as $method) {
      if (substr($method, 0, 3) == 'get') {
        $key = lcfirst(substr($method, 3));
        $result[$key] = $this->$method();
      }
    }
    return $result;
  }

  /**
   * @param array $array
   * @param bool $strict
   * @return $this
   * @throws \Exception
   */
  public function fromArray($array, $strict = false)
  {
    foreach ($array as $key => $val) {
      $method = 'set' . $key;
      if (method_exists($this, $method)) {
        $this->$method($val);
      } else if ($strict) {
        throw new \Exception('Unknown property: ' . $key);
      }
    }
    return $this;
  }

}
