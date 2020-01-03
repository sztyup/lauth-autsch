<?php

namespace Sztyup\LAuth\Authsch;

use Illuminate\Support\ServiceProvider;
use LaravelDoctrine\ORM\DoctrineManager;
use Sztyup\LAuth\Authsch\Entities\AuthschAccount;
use Sztyup\LAuth\LAuth;

class AuthschServiceProvider extends ServiceProvider
{
    public function boot(LAuth $LAuth, DoctrineManager $doctrineManager): void
    {
        $LAuth->addProvider('authsch', AuthschProvider::class, AuthschAccount::class);
        $doctrineManager->addPaths([__DIR__ . './Entities']);
    }
}
