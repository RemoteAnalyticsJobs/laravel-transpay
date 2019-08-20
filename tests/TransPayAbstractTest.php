<?php
namespace TransPay\Test;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;
use TransPay\TransPayAbstract;

class TransPayAbstractTest extends TestCase
{

    /** @test */
    public function it_tests_if_it_sets_http_client() {
        $instance = $this->getMockForAbstractClass(TransPayAbstract::class);
        $this->assertInstanceOf(Client::class, $instance->_httpClient);

        $mock = [];
        $instance->_setHttpClient($mock);
        $this->assertCount(0, $instance->_httpClient);
    }

    /** @test */
    public function it_tests_if_it_return_proper_base_url() {
        $sandBoxUrl = 'https://demo-api.transfast.net/';

        $instance = $this->getMockForAbstractClass(TransPayAbstract::class);
        $this->assertEquals($sandBoxUrl, $instance::_getBaseUrl());
    }

    /** @test */
    public function it_tests_if_api_token_can_be_set() {
        $instance = $this->getMockForAbstractClass(TransPayAbstract::class);
        $this->assertEquals(env('TRANSPAY_SANDBOX_TOKEN'), $instance->_apiKey);
    }

    /** @test */
    public function it_gets_token_for_sandbox() {
        $instance = $this->getMockForAbstractClass(TransPayAbstract::class);
        $this->assertEquals(env('TRANSPAY_SANDBOX_TOKEN'), $instance->_apiKey);
    }

}
