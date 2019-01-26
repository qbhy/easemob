<?php
/**
 * User: qbhy
 * Date: 2019/1/26
 * Time: 下午3:56
 */

namespace Qbhy\Easemob\Kernel;

use Qbhy\Easemob\Easemob;

abstract class Module
{
    protected $app;

    public function __construct(Easemob $easemob)
    {
        $this->app = $easemob;
    }

}