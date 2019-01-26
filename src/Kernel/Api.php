<?php
/**
 * User: qbhy
 * Date: 2019/1/26
 * Time: 下午3:08
 */

namespace Qbhy\Easemob\Kernel;

use Hanson\Foundation\AbstractAPI;
use Qbhy\Easemob\Easemob;

class Api extends AbstractAPI
{
    const API_DOMAIN = 'http://a1.easemob.com/';
    protected $app;

    public function __construct(Easemob $easemob)
    {
        $this->app = $easemob;
    }

    /**
     * @param string $method
     * @param string $url
     * @param array  $options
     *
     * @return array
     */
    public function request(string $method, string $url, array $options = [])
    {
        $options['headers'] = array_merge($options['headers'] ?? [], ['Authorization' => 'Bearer ' . $this->app->access_token->getToken(),]);

        return @json_decode($this->getHttp()->request($method, $this->url($url), $options)->getBody()->__toString(), true);
    }

    public function url(string $url)
    {
        return Api::API_DOMAIN . $this->app->getOrgName() . '/' . $this->app->getAppName() . '/' . $url;
    }
}