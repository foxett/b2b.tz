<?php

/**
 * Created by PhpStorm.
 * User: foxett
 * Date: 11/28/2019
 * Time: 19:38
 */
class BaseController
{
    public $model;
    public $view;

    /**
     * BaseController constructor.
     */
    function __construct()
    {
        $this->view = new \BaseView();
    }

    public function index(){

    }

    /**
     * @param array $data
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function sendJsonResponse(array $data){

        $response = new \Symfony\Component\HttpFoundation\Response(
            json_encode($data),
            \Symfony\Component\HttpFoundation\Response::HTTP_OK,
            ['content-type' => 'application/json']
        );

        return $response->send();
    }
}