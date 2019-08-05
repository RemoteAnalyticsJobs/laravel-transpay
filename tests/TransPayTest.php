<?php

namespace TransPay\Test;

use Tests\TestCase;
use TransPay\Transaction;
use TransPay\TransPay;

class TransPayTest extends TestCase {


    /** @test */
    public function it_tests_if_transaction_method_is_available_and_return_proper_instance() {
        $instance = new TransPay();
        $this->assertTrue(method_exists($instance, 'transaction'));
        $this->assertInstanceOf(Transaction::class, $instance->transaction());
    }



}
