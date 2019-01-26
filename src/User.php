<?php
/**
 * User: qbhy
 * Date: 2019/1/26
 * Time: 下午3:53
 */

namespace Qbhy\Easemob;

use GuzzleHttp\RequestOptions;
use Qbhy\Easemob\Kernel\Api;

class User extends Api
{
    /**
     * 删除单个用户
     *
     * @link http://docs-im.easemob.com/im/server/ready/user#%E5%88%A0%E9%99%A4%E5%8D%95%E4%B8%AA%E7%94%A8%E6%88%B7
     *
     * @param string $username
     *
     * @return array
     */
    public function destroy(string $username)
    {
        return $this->request('DELETE', 'users/' . $username);
    }

    /**
     * 批量删除用户
     *
     * @link http://docs-im.easemob.com/im/server/ready/user#%E6%89%B9%E9%87%8F%E5%88%A0%E9%99%A4%E7%94%A8%E6%88%B7
     *
     * @param $limit
     *
     * @return array
     */
    public function batchDestroy($limit)
    {
        return $this->request('DELETE', 'users', ['json' => compact('limit')]);
    }

    /**
     * 批量获取用户
     *
     * @link http://docs-im.easemob.com/im/server/ready/user#%E6%89%B9%E9%87%8F%E8%8E%B7%E5%8F%96%E7%94%A8%E6%88%B7
     *
     * @param $limit
     * @param $cursor
     *
     * @return array
     */
    public function users($limit, $cursor = null)
    {
        return $this->request('GET', 'users', ['query' => compact('limit', 'cursor')]);
    }

    /**
     * 注册单个用户(授权)
     *
     * @link http://docs-im.easemob.com/im/server/ready/user#%E6%B3%A8%E5%86%8C%E5%8D%95%E4%B8%AA%E7%94%A8%E6%88%B7_%E6%8E%88%E6%9D%83
     *
     * @param string $username
     * @param string $password
     * @param string $nickname
     *
     * @return array
     */
    public function register(string $username, string $password, string $nickname)
    {
        return $this->request('POST', 'users', ['json' => compact('username', 'password', 'nickname')]);
    }

    /**
     * 批量注册用户
     *
     * @link http://docs-im.easemob.com/im/server/ready/user#%E6%89%B9%E9%87%8F%E6%B3%A8%E5%86%8C%E7%94%A8%E6%88%B7
     *
     * @param array $users
     *
     * @return array
     */
    public function batchRegister(array $users)
    {
        return $this->request('POST', 'users', ['json' => compact('users')]);
    }

    /**
     * 获取单个用户
     *
     * @link http://docs-im.easemob.com/im/server/ready/user#%E8%8E%B7%E5%8F%96%E5%8D%95%E4%B8%AA%E7%94%A8%E6%88%B7
     *
     * @param string $username
     *
     * @return array
     */
    public function find(string $username)
    {
        return $this->request('GET', 'users/' . $username);
    }

    /**
     * 修改用户密码
     *
     * @link http://docs-im.easemob.com/im/server/ready/user#%E4%BF%AE%E6%94%B9%E7%94%A8%E6%88%B7%E5%AF%86%E7%A0%81
     *
     * @param string $username
     * @param string $password
     *
     * @return array
     */
    public function setUserPassword(string $username, string $password)
    {
        return $this->request('PUT', "users/{$username}/password", ['json' => ['newpassword' => $password]]);
    }

    /**
     * 设置推送消息显示昵称
     *
     * @link http://docs-im.easemob.com/im/server/ready/user#%E8%AE%BE%E7%BD%AE%E6%8E%A8%E9%80%81%E6%B6%88%E6%81%AF%E6%98%BE%E7%A4%BA%E6%98%B5%E7%A7%B0
     *
     * @param string $username
     * @param string $nickname
     *
     * @return array
     */
    public function setUserPushNickname(string $username, string $nickname)
    {
        return $this->setUserAttributes($username, compact('nickname'));
    }

    /**
     * 设置推送消息展示方式
     *
     * @link http://docs-im.easemob.com/im/server/ready/user#%E8%AE%BE%E7%BD%AE%E6%8E%A8%E9%80%81%E6%B6%88%E6%81%AF%E5%B1%95%E7%A4%BA%E6%96%B9%E5%BC%8F
     *
     * @param string $username
     * @param string $notification_no_disturbing “true”仅通知，“false“通知以及消息详情
     *
     * @return array
     */
    public function setUserNotifyStyle(string $username, $notification_no_disturbing)
    {
        return $this->setUserAttributes($username, compact('notification_no_disturbing'));
    }

    /**
     * 设置免打扰
     *
     * @link http://docs-im.easemob.com/im/server/ready/user#%E8%AE%BE%E7%BD%AE%E6%8E%A8%E9%80%81%E6%B6%88%E6%81%AF%E5%B1%95%E7%A4%BA%E6%96%B9%E5%BC%8F
     *
     * @param string $username
     * @param string $notification_no_disturbing
     * @param string $notification_no_disturbing_start
     * @param string $notification_no_disturbing_end
     *
     * @return array
     */
    public function setUserDonDisturb(string $username, string $notification_no_disturbing, $notification_no_disturbing_start, $notification_no_disturbing_end)
    {
        return $this->setUserAttributes($username, compact('notification_no_disturbing', 'notification_no_disturbing_start', 'notification_no_disturbing_end'));
    }

    /**
     * 更新用户数据
     *
     * @param string $username
     * @param array  $attributes
     *
     * @return array
     */
    public function setUserAttributes(string $username, array $attributes)
    {
        return $this->request('PUT', "users/{$username}", ['json' => $attributes]);
    }

    // 好友与黑名单


}