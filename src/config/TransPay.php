<?php
namespace TransPay\Config;

return [
    'LIVE_TOKEN'           => env('TRANSPAY_API_KEY'),
    'SANDBOX_USER'      => env('TRANSPAY_SANDBOX_USER'),
    'SANDBOX_PASSWORD'  => env('TRANSPAY_SANDBOX_PASSWORD'),
    'SANDBOX_TOKEN'     => env('TRANSPAY_SANDBOX_TOKEN')
];
