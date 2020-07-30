<?php

declare(strict_types=1);

namespace Sztyup\LAuth\Authsch;

use Illuminate\Support\ServiceProvider;
use Sztyup\LAuth\ProviderRegistry;

class AuthschServiceProvider extends ServiceProvider
{
    public function boot(ProviderRegistry $providerRegistry): void
    {
        $providerRegistry->register('authsch', AuthschProvider::class);
        $providerRegistry->register('authsch-bme', BmeProvider::class);
    }
}
