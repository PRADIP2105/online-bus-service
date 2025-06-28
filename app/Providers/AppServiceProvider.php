<?php

namespace App\Providers;

use App\Models\Bus;
use App\Policies\BusPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Bus::class => BusPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}