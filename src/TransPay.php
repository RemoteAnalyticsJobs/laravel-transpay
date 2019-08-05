<?php
namespace TransPay;


class TransPay extends TransPayAbstract {

    /**
     * @return Transaction
     */
    public function transaction() {
        return new Transaction();
    }


}
