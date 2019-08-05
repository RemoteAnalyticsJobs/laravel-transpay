<?php
namespace TransPay;

use Illuminate\Support\ServiceProvider;

class TransPayServiceProvider extends ServiceProvider
{
    public function register() {

    }

    public function boot() {
        $this->mergeConfigFrom(__DIR__.'/config/TransPay.php', 'transpay');
    }

}
