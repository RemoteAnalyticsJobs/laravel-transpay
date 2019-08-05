<?php

namespace TransPay\Test;


use GuzzleHttp\Client;
use Tests\TestCase;
use TransPay\Sender;

class SenderTest extends TestCase
{

    /** @test */
    public function it_tests_if_sender_id_can_be_created() {
        $response = ['status' => true];
        $httpMock = $this->getHttpMock($response);
        $sender = new Sender($httpMock);
        $res = $sender
                ->create([
                    'name' => 'Sharik Shaikh',
                    'address' => '123 Main st',
                    'phoneMobile' => '1234567890',
                    'TypeOfId' => 'PA',
                    'IdNumber' => '12345677',
                    'DateOfBirth' =>'1994-09-06',
                ]);
        $this->assertTrue($res['status']);
    }


    public function getHttpMock($response) {
        $content = \Mockery::mock(Client::class)
            ->shouldReceive('getContents')
            ->once()
            ->andReturn(json_encode($response))
            ->getMock();
        $body = \Mockery::mock(Client::class)
            ->shouldReceive('getBody')
            ->once()
            ->andReturn($content)
            ->getMock();
        $mock = \Mockery::mock(Client::class)
                    ->shouldReceive('request')
                    ->once()
                    ->andReturn($body)
                    ->getMock();
        return $mock;
    }


}
