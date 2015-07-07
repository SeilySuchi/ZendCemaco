<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
      $productsModel = new Application_Model_DbTable_Products();
      $products = $productsModel->fetchAll(null, null, 10);
      $this->view->assign('products', $products);
    }

    /*
     * Method addAction
     */
    public function addAction()
    {
      $req = $this->getRequest();
      $form = new Application_Form_Product();
      $this->view->form = $form;

      if($req->isPost())
      {
        if ($form->isValid($req->getPost()))
        {
          $data = $form->getValues();

          unset($data['productCode']);
        //var_dump($data); exit;
          $product = new Application_Model_Product($data);
          $productMapper = new Application_Model_ProductMapper();
          $productMapper->save($product);

          //unset($newProduct['submit']);
          $this->view->assign('success', true);
          $form->reset();
        }
      }
    }

    /*
     * Method updateAction
     */
    public function updateAction()
    {
      $req = $this->getRequest();
      $productId = $req->getParam('productid');
      $productMapper = new Application_Model_ProductMapper();
      $productOriginal = $productMapper->getProduct($productId);
      //$product = new Application_Model_Product($productOriginal);

      $form = new Application_Form_Product();
      $form->populate($productOriginal->toArray());
      $this->view->form = $form;

      if ($req->isPost()) {

      }
    }

    /*
     * Method testAction
     */
    public function testAction()
    {
      $this->view->data = $this->getRequest()->getParam('data');
    }
}