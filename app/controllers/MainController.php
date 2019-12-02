<?php

/**
 * Created by PhpStorm.
 * User: foxett
 * Date: 11/28/2019
 * Time: 19:49
 */

class MainController extends BaseController
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
   public function generate(){
       $generatedProducts = ['products' => ProductService::generateProducts(20)] ;

       return $this->sendJsonResponse(array_merge(['result' => true], $generatedProducts));
   }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
   public function all(){

       $products = ProductService::getAll();

       if($products == null){
           return $this->sendJsonResponse(['result' => false, 'message' => 'No products']);
       }

       $data = ['products' => $products];

       return $this->sendJsonResponse(array_merge(['result' =>true], $data));
   }
}