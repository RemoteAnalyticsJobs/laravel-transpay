<?php


use GuzzleHttp\Client;

if (!function_exists('createHttpMock')) {
    function createHttpMock($response = []) {
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
