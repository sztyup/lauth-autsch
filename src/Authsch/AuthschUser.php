<?php

namespace Sztyup\LAuth\Authsch;

use Sztyup\LAuth\ProviderUser;

class AuthschUser extends ProviderUser
{
    public $internalId;

    public $surname;

    public $givenName;

    public $linkedAccounts;

    public $lastSync;

    public $groupMemberships;

    public $phoneNumber;

    public $universityCourses;

    public $entrants;

    public $ADmemberships;

    public $unitScope;

    public $address;
}