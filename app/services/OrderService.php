<?php

/**
 * Created by PhpStorm.
 * User: foxett
 * Date: 12/2/2019
 * Time: 11:26
 */



class OrderService
{
    /**
     * @return bool
     */
    public static function checkPay(){
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://ya.ruu",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache"
            ),
        ));

        curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
          return false;
        }

        return true;
    }
}