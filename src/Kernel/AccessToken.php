<?php
/**
 * User: qbhy
 * Date: 2019/1/26
 * Time: 下午3:07
 */

namespace Qbhy\Easemob\Kernel;

use Hanson\Foundation\AbstractAccessToken;
use Qbhy\Easemob\Easemob;

class AccessToken extends AbstractAccessToken
{
    protected $app;
    protected $expiresJsonKey = 'expires_in';
    protected $tokenJsonKey   = 'access_token';
    protected $prefix         = 'easemob_access_token';

    public function __construct(Easemob $easemob)
    {
        $this->app = $easemob;
    }

    public function getTokenFromServer()
    {
        return @json_decode($this->getHttp()->json($this->app->api->url('token'), [
            'grant_type'    => 'client_credentials',
            'client_id'     => $this->app->getClientId(),
            'client_secret' => $this->app->getClientSecret(),
        ])->getBody()->__toString(), true);
    }

    public function checkTokenResponse($result)
    {
    }
}