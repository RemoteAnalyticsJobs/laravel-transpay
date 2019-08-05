<?php
namespace TransPay;


class Sender extends TransPayAbstract {


    public function create(array $data) {
        $response = $this->_httpClient->request('api/transaction/sender');
        return json_decode($response->getBody()->getContents(), true);
    }




}
