<?php

declare(strict_types=1);

namespace Sztyup\LAuth\Authsch;

class BmeProvider extends AuthschProvider
{
    protected function redirectUrl($state): string
    {
        $parameters = [
            'state'         => $state,
            'client_id'     => $this->config['client_id'],
            'client_secret' => $this->config['client_secret'],
            'scope'         => implode(' ', $this->config['scopes']),
            'response_type' => 'code'
        ];

        $target = 'https://auth.sch.bme.hu/site/login/provider/bme?' . http_build_query($parameters);

        return "https://auth.sch.bme.hu/Shibboleth.sso/Login?target=" . urlencode($target);
    }
}
