<?php
namespace TransPay\Test;


use Tests\TestCase;
use TransPay\Transaction;

class TransactionTest extends TestCase {

    /** @test */
    public function it_tests_if_creates_transaction() {
        $transaction = new Transaction();
        $response = $transaction->create();
    }



}
