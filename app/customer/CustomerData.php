<?php
/**
 * Created by PhpStorm.
 * User: leonardoavella
 * Date: 10/06/21
 * Time: 9:54 PM
 */

namespace App\customer;

use GuzzleHttp\Client;


class CustomerData {

    function getData($apiUrl){
        $client = new Client();
        $req = $client->request('GET', $apiUrl);
        $res = json_decode($req->getBody()->getContents(), true);
        return $res;
    }

}

