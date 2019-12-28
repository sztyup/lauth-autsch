<?php

namespace Sztyup\LAuth\Authsch;

use Sztyup\LAuth\AbstractProvider;
use Sztyup\LAuth\Entities\Account;
use Sztyup\LAuth\ProviderUser;

class AuthschProvider extends AbstractProvider
{
    public function getName(): string
    {
        return 'authsch';
    }

    public function createAccount(ProviderUser $providerUser): Account
    {
        $account = new AuthschAccount();

        $this->updateAccount($account, $providerUser);

        $this->em->persist($account);

        return $account;
    }

    protected function redirectUrl(string $state): string
    {
        $parameters = [
            'state' => $state,
            'client_id' => $this->config['client_id'],
            'client_secret' => $this->config['client_secret'],
            'scope' => implode(' ', $this->config['scopes']),
            'response_type' => 'code'
        ];

        return $this->config['base'] . '/site/login?' . http_build_query($parameters);
    }

    protected function getResponseFromToken(string $accessToken): array
    {
        $userUrl = sprintf('%s/api/profile?access_token=%s', $this->config['base'], $accessToken);

        $response = $this->guzzle->get($userUrl);

        return json_decode($response->getBody(), true);
    }

    /**
     * @param Account|AuthschAccount $account
     * @param ProviderUser $providerUser
     */
    protected function updateAccount(Account $account, ProviderUser $providerUser): void
    {
        $data = $providerUser->data;

        if (isset($data['mobile'])) {
            $account->setPhone($data['mobile']);
        }

        if (isset($data['niifPersonOrgID'])) {
            $account->setNeptun($data['niifPersonOrgID']);
        }

        if (isset($data['sn'])) {
            $account->setLastName($data['sn']);
        }
        if (isset($data['givenName'])) {
            $account->setFirstName($data['givenName']);
        }

        if (isset($data['linkedAccounts'])) {
            if (isset($data['linkedAccounts']['schacc'])) {
                $account->setSchacc($data['linkedAccounts']['schacc']);
            }

            if (isset($data['linkedAccounts']['vir'])) {
                $account->setVirId($data['linkedAccounts']['vir']);
            }

            if (isset($data['linkedAccounts']['virUid'])) {
                $account->setVirUid($data['linkedAccounts']['virUid']);
            }

            if (isset($data['linkedAccounts']['bme'])) {
                $arr = explode('@', $data['linkedAccounts']['bme']);
                $account->setBmeId($arr[0]);
            }
        }

        if (isset($data['bmeunitscope'])) {
            if (in_array('BME_VIK_NEWBIE', $data['bmeunitscope'], true)) {
                $account->setBmeStatus(AuthschAccount::BME_STATUS_NEWBIE);
            } elseif (in_array('BME_VIK_ACTIVE', $data['bmeunitscope'], true)) {
                $account->setBmeStatus(AuthschAccount::BME_STATUS_VIK_ACTIVE);
            } elseif (in_array('BME_VIK', $data['bmeunitscope'], true)) {
                $account->setBmeStatus(AuthschAccount::BME_STATUS_VIK_PASSIVE);
            } elseif (in_array('BME', $data['bmeunitscope'], true)) {
                $account->setBmeStatus(AuthschAccount::BME_STATUS_BME);
            } else {
                $account->setBmeStatus(AuthschAccount::BME_STATUS_NONE);
            }
        } else {
            $account->setBmeStatus(AuthschAccount::BME_STATUS_NONE);
        }
    }
}
