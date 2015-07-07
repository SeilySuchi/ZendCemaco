<?php

class Application_Form_Product extends Zend_Form
{
  /*
   * Method init
   */
  public function init()
  {
    $this->setMethod('post');

    $this->addElement('text', 'productCode', [
      'label' => 'Ingrese codigo de producto',
      'required' => true,
      'class' => 'custom'
    ]);

    $this->addElement('text', 'productName', [
      'label' => 'Ingrese el nombre',
      'required' => true
    ]);

    $this->addElement('text', 'productDescription', [
      'label' => 'Descripcion del producto',
      'required' => false
    ]);

    $this->addElement('submit', 'submit', [
      'label' => 'Guadar',
      'ignore' => false
    ]);
  }
}