<?php
/**
 * Created by PhpStorm.
 * User: foxett
 * Date: 11/28/2019
 * Time: 19:08
 */

class Route
{

   public static function init()
        {
       $uriArr = explode('/', filter_input(INPUT_SERVER, 'REQUEST_URI'));
       $attribute = [];
       if(! $uriArr) {
           $module='index'; $method='index';
       }else{
           preg_match('/([a-z0-9]+)/si', $uriArr[1], $found);
           $module = ucfirst(strtolower($found[1])).'Controller';

           if(isset($uriArr[1])){
               preg_match('/([a-z0-9]+)/si', $uriArr[2], $found);
               $method = $found[1];
           }else{$method='index';}
       }

       if(!is_callable([new $module, $method])){
           throw new Exception('Not found');
       }

        call_user_func_array([new $module, $method], [$attribute]);
        }
}