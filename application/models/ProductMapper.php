<?php

class Application_Model_ProductMapper
{
  protected $dataSource = null;

  /*
   * Method setDataSource
   * @param $dataSource
   */
  public function setDataSource($dataSource)
  {
    $this->dataSource = $dataSource;
  }

  /*
   * Method getDataSource
   */
  public function getDataSource()
  {
    if (empty($this->dataSource))
      $this->dataSource = new Application_Model_DbTable_Products();

    return $this->dataSource;
  }

  /*
   * Method getProduct
   * @param $productId
   */
  public function getProduct($productId)
  {
    $product = $this->getDataSource()->find($productId);

    if (count($product))
      return $product[0];
    else
      return null;
  }

  /*
   * Method save
   * @param $product
   */
  public function save($product)
  {
    $defaultValues = [
      'productCode' => ' ',
      'productName' => ' ',
      'productLine' => 'Motorcycles',
      'productScale' => ' ',
      'productVendor' => ' ',
      'productDescription' => ' ',
      'quantityInStock' => ' ',
      'buyPrice' => ' ',
      'MSRP' => ' '
    ];

    $productData = [
      //'productCode' => $product->ProductCode,
      'productName' => $product->ProductName,
      'productDescription' => $product->ProductDescription
    ];

    $newProduct = $productData + $defaultValues;
    if (empty($product->ProductCode))
    {
      $newProduct['ProductCode'] = mt_rand(10,100);
      $this->getDataSource()->insert($newProduct);
    }
    else
      $this->getDataSource()->update($newProduct, 'ProductCode='.$product->ProductCode);
  }
}