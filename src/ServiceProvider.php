<?php
/**
 * User: qbhy
 * Date: 2019/1/26
 * Time: 下午2:41
 */

namespace Qbhy\Easemob;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Qbhy\Easemob\Kernel\AccessToken;
use Qbhy\Easemob\Kernel\Api;

class ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        $pimple['api'] = function (Easemob $easemob) {
            return new Api($easemob);
        };

        $pimple['user'] = function (Easemob $easemob) {
            return new User($easemob);
        };

        $pimple['access_token'] = function (Easemob $easemob) {
            return new AccessToken($easemob);
        };
    }

}