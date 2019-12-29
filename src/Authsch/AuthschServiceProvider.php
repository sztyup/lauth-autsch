<?php

namespace Sztyup\LAuth\Authsch;

use Illuminate\Support\ServiceProvider;
use Sztyup\LAuth\LAuth;

class AuthschServiceProvider extends ServiceProvider
{
    public function boot(LAuth $LAuth): void
    {
        $LAuth->addProvider('authsch', AuthschProvider::class);
    }
}
