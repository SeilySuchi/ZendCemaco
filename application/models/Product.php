<?php

class Application_Model_Product implements ArrayAccess
{
  protected $ProductCode = null;

  protected $ProductDescription = null;

  protected $ProductName = null;

  protected $buyPrice = 0;

  /*
   * Method __construct
   */
  public function __construct($options)
  {
    $methods = get_class_methods($this);
    foreach ($options as $key => $value)
    {
      $method = 'set' . ucfirst($key);
      if (in_array($method, $methods))
        $this->$method($value);
    }
  }

  /*
   * Method __set
   * @param $property
   * @param $value
   */
  public function __set($property, $value)
  {
    $method = 'set' . ucfirst($property);
    if (!method_exists($this, $method))
      throw new Exception('Invalid property');

    $this->$method($value);
  }

  /*
   * Method __get
   * @param $property
   */
  public function __get($property)
  {
    $method = 'get' . $property;
    if (!method_exists($this, $method))
      throw new Exception('Invalid property');

    return $this->$method();
  }

  /*
   * Method set
   * @param $code
   */
  public function setProductCode($code)
  {
    if (!is_numeric($code) && (strlen($code)!=6))
      return false;

    $this->ProductCode = $code;
  }

  /*
   * Method getProductCode
   */
  public function getProductCode()
  {
    return $this->ProductCode;
  }

  /*
   * Method setProductDescription
   * @param $description
   */
  public function setProductDescription($description)
  {
    $this->ProductDescription = $description;
  }

  /*
   * Method getProductDescription
   */
  public function getProductDescription()
  {
    return $this->ProductDescription;
  }

  /*
   * Method setProductName
   * @param $name
   */
  public function setProductName($name)
  {
    $this->ProductName = $name;
  }

  /*
   * Method getProductName
   */
  public function getProductName()
  {
    return $this->ProductName;
  }

  /*
   * Method setBuyPrice
   * @param $price
   */
  public function setBuyPrice($price)
  {
    $this->buyPrice = $price;
  }

  /*
   * Method getBuyPrice
   */
  public function getBuyPrice()
  {
    return 'Q.' . number_format($this->buyPrice, 2, '.', ',');
  }

  public function offsetSet($offset, $valor)
  {
    $this->$offset = $valor;
  }

  public function offsetExists($offset)
  {
    return isset($this->$offset);
  }

  public function offsetUnset($offset)
  {
    $this->$offset = null;
  }

  public function offsetGet($offset)
  {
    if (!empty($this->$offset))
      return $this->$offset;
    else
      return null;
  }
}