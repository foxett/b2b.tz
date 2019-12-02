<?php

/**
 * Created by PhpStorm.
 * User: foxett
 * Date: 11/29/2019
 * Time: 14:30
 */
use Symfony\Component\HttpFoundation\Request;

class OrderController extends BaseController
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(){
       $request = Request::createFromGlobals();
       $productModel = new ProductModel();

       $errorIds = [];
       $products = json_decode($request->getContent())->products;

       foreach ($products as $product){
            $found = $productModel->find($product->id);

            if($found === null){
                $errorIds [] = $product->id;
            }
        }

        if($errorIds){
           return parent::sendJsonResponse(['result' => false, 'message' => 'Products with this ids not found', 'data' => $errorIds]);
        }

        $orderModel = new OrderModel();
        $productModel = new ProductModel();
        $orderModel->cost = $productModel->getProductsCost($products)['cost'];
        $createdOrder = $orderModel->create();
        $orderId = $createdOrder['id'];

        foreach ($products as $product){
            $orderProducts = new OrderProductsModel();
            $orderProducts->order_id = $orderId;
            $orderProducts->product_id = $product->id;
            $orderProducts->create();
        }

        return $this->sendJsonResponse(['result' => true, 'order' => $orderId]);

    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function pay(){
        $request = Request::createFromGlobals();
        $request = json_decode($request->getContent());

        if(empty($request->order) || empty($request->order->amount) || empty($request->order->id)){
            return $this->sendJsonResponse(['result' => false, 'message' => 'Invalid request data']);
        }

        $requestOrder = $request->order;

        $amount = $requestOrder->amount;
        $orderId = $requestOrder->id;

        $orderModel = new OrderModel();

        $foundOrder = $orderModel->find($orderId);

        if($foundOrder === null){
            return $this->sendJsonResponse(['result' => false, 'message' => 'Order not found']);
        }

        if($foundOrder['cost'] != $amount){
            return $this->sendJsonResponse(['result' => false, 'message' => 'Order not found']);
        }

        $payResult = OrderService::checkPay();

        if(!$payResult){
            return $this->sendJsonResponse(['result' => false, 'message' => 'Payment failed']);
        }

        $orderModel->setStatus($orderId, OrderModel::STATUS_PAID);

        return $this->sendJsonResponse(['result' => true, 'message' => 'Order paid']);
    }
}