<?php
/**
 * User: qbhy
 * Date: 2019/1/26
 * Time: 下午2:38
 */

namespace Qbhy\Easemob;

use Hanson\Foundation\Foundation;
use Qbhy\Easemob\Kernel\AccessToken;
use Qbhy\Easemob\Kernel\Api;

/**
 * Class Easemob
 *
 * @property Api         $api
 * @property AccessToken $access_token
 * @property User        $user
 *
 * @package Qbhy\Easemob
 */
class Easemob extends Foundation
{
    protected $providers = [
        ServiceProvider::class,
    ];

    public function getOrgName()
    {
        return $this->getConfig('org_name');
    }

    public function getAppName()
    {
        return $this->getConfig('app_name');
    }

    public function getAppKey()
    {
        return $this->getConfig('app_key');
    }

    public function getClientId()
    {
        return $this->getConfig('client_id');
    }

    public function getClientSecret()
    {
        return $this->getConfig('client_secret');
    }

}