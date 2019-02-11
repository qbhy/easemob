<?php
/**
 * User: qbhy
 * Date: 2019-02-11
 * Time: 11:23
 */

namespace Qbhy\Easemob;

use Qbhy\Easemob\Kernel\Api;

class Room extends Api
{
    /**
     * 获取app中的所有聊天室
     *
     * @link http://docs-im.easemob.com/im/server/basics/chatroom#%E8%8E%B7%E5%8F%96_app_%E4%B8%AD%E6%89%80%E6%9C%89%E7%9A%84%E8%81%8A%E5%A4%A9%E5%AE%A4
     * @return array
     */
    public function allRooms()
    {
        return $this->request('GET', 'chatrooms');
    }

    /**
     * 获取用户加入的聊天室
     *
     * @param string $username
     *
     * @link http://docs-im.easemob.com/im/server/basics/chatroom#%E8%8E%B7%E5%8F%96%E7%94%A8%E6%88%B7%E5%8A%A0%E5%85%A5%E7%9A%84%E8%81%8A%E5%A4%A9%E5%AE%A4
     * @return array
     */
    public function getUserJoinedRooms(string $username)
    {
        return $this->request('GET', "users/{$username}/joined_chatrooms");
    }

    /**
     * 获取聊天室详情
     *
     * @link http://docs-im.easemob.com/im/server/basics/chatroom#%E8%8E%B7%E5%8F%96%E8%81%8A%E5%A4%A9%E5%AE%A4%E8%AF%A6%E6%83%85
     *
     * @param $roomId
     *
     * @return array
     */
    public function roomInfo($roomId)
    {
        return $this->request('GET', 'chatrooms/' . $roomId);
    }

    /**
     * 创建聊天室
     *
     * @param string $owner
     * @param string $name
     * @param string $description
     * @param array  $optional
     *
     * @link http://docs-im.easemob.com/im/server/basics/chatroom#%E5%88%9B%E5%BB%BA%E8%81%8A%E5%A4%A9%E5%AE%A4
     * @return array
     */
    public function create(string $owner, string $name, string $description, array $optional = [])
    {
        return $this->request('POST', 'chatrooms', ['json' => array_merge(compact('name', 'owner', 'description'), $optional)]);
    }

    /**
     * 修改聊天室信息
     *
     * @param string $name
     * @param string $description
     * @param int    $maxusers
     *
     * @link http://docs-im.easemob.com/im/server/basics/chatroom#%E4%BF%AE%E6%94%B9%E8%81%8A%E5%A4%A9%E5%AE%A4%E4%BF%A1%E6%81%AF
     * @return array
     */
    public function update(string $name, string $description, $maxusers)
    {
        return $this->request('PUT', 'chatrooms', ['json' => compact('name', 'description', 'maxusers')]);
    }

    /**
     * 删除聊天室
     *
     * @param string $roomId
     *
     * @link http://docs-im.easemob.com/im/server/basics/chatroom#%E5%88%A0%E9%99%A4%E8%81%8A%E5%A4%A9%E5%AE%A4
     * @return array
     */
    public function destroy(string $roomId)
    {
        return $this->request('DELETE', 'chatrooms/' . $roomId);
    }

    /**
     * 管理聊天室成员
     *
     * @link http://docs-im.easemob.com/im/server/basics/chatroom#%E7%AE%A1%E7%90%86%E8%81%8A%E5%A4%A9%E5%AE%A4%E6%88%90%E5%91%98
     */

    /**
     *分页获取聊天室成员
     *
     * @link http://docs-im.easemob.com/im/server/basics/chatroom#%E5%88%86%E9%A1%B5%E8%8E%B7%E5%8F%96%E8%81%8A%E5%A4%A9%E5%AE%A4%E6%88%90%E5%91%98
     *
     * @param $roomId
     * @param $pagesize
     * @param $pagenum
     *
     * @return array
     */
    public function users($roomId, $pagenum, $pagesize = 15)
    {
        return $this->request('GET', 'chatrooms/' . $roomId . '/users', ['query' => compact('pagenum', 'pagesize')]);
    }

    /**
     * 添加单个聊天室成员
     *
     * @link http://docs-im.easemob.com/im/server/basics/chatroom#%E6%B7%BB%E5%8A%A0%E5%8D%95%E4%B8%AA%E8%81%8A%E5%A4%A9%E5%AE%A4%E6%88%90%E5%91%98
     *
     * @param string $roomId
     * @param string $username
     *
     * @return array
     */
    public function pushUser(string $roomId, string $username)
    {
        return $this->request('POST', "chatrooms/{$roomId}/users/{$username}");
    }

    /**
     * 批量添加聊天室成员
     *
     * @link http://docs-im.easemob.com/im/server/basics/chatroom#%E6%89%B9%E9%87%8F%E6%B7%BB%E5%8A%A0%E8%81%8A%E5%A4%A9%E5%AE%A4%E6%88%90%E5%91%98
     *
     * @param string $roomId
     * @param array  $usernames
     *
     * @return array
     */
    public function pushUsers(string $roomId, array $usernames)
    {
        return $this->request('POST', "chatrooms/{$roomId}/users", ['json' => compact('usernames')]);
    }

    /**
     * 删除单个聊天室成员
     *
     * @link http://docs-im.easemob.com/im/server/basics/chatroom#%E6%B7%BB%E5%8A%A0%E5%8D%95%E4%B8%AA%E8%81%8A%E5%A4%A9%E5%AE%A4%E6%88%90%E5%91%98
     *
     * @param string $roomId
     * @param string $username
     *
     * @return array
     */
    public function removeUser(string $roomId, string $username)
    {
        return $this->request('DELETE', "chatrooms/{$roomId}/users/{$username}");
    }

    /**
     * 批量删除聊天室成员
     *
     * @link http://docs-im.easemob.com/im/server/basics/chatroom#%E6%89%B9%E9%87%8F%E5%88%A0%E9%99%A4%E8%81%8A%E5%A4%A9%E5%AE%A4%E6%88%90%E5%91%98
     *
     * @param string $roomId
     * @param array  $usernames
     *
     * @return array
     */
    public function removeUsers(string $roomId, array $usernames)
    {
        return $this->request('DELETE', "chatrooms/{$roomId}/users/" . implode(',', $usernames));
    }

    /**
     * 获取聊天室管理员列表
     *
     * @link http://docs-im.easemob.com/im/server/basics/chatroom#%E8%8E%B7%E5%8F%96%E8%81%8A%E5%A4%A9%E5%AE%A4%E7%AE%A1%E7%90%86%E5%91%98%E5%88%97%E8%A1%A8
     *
     * @param string $roomId
     *
     * @return array
     */
    public function admins(string $roomId)
    {
        return $this->request('GET', "chatrooms/{$roomId}/admin");
    }

    /**
     * 添加聊天室管理员
     *
     * @link http://docs-im.easemob.com/im/server/basics/chatroom#%E6%B7%BB%E5%8A%A0%E8%81%8A%E5%A4%A9%E5%AE%A4%E7%AE%A1%E7%90%86%E5%91%98
     *
     * @param string $roomId
     * @param string $admin
     *
     * @return array
     */
    public function addAdmin(string $roomId, string $admin)
    {
        return $this->request('POST', "chatrooms/{$roomId}/admin", ['json' => ['newadmin' => $admin]]);
    }

    /**
     * 移除聊天室管理员
     *
     * @link http://docs-im.easemob.com/im/server/basics/chatroom#%E7%A7%BB%E9%99%A4%E8%81%8A%E5%A4%A9%E5%AE%A4%E7%AE%A1%E7%90%86%E5%91%98
     *
     * @param string $roomId
     * @param string $admin
     *
     * @return array
     */
    public function removeAdmin(string $roomId, string $admin)
    {
        return $this->request('DELETE', "chatrooms/{$roomId}/admin/{$admin}");
    }

    /**
     * 管理禁言
     *
     * @link http://docs-im.easemob.com/im/server/basics/chatroom#%E7%AE%A1%E7%90%86%E7%A6%81%E8%A8%80
     */

    /**
     * 获取禁言列表
     *
     * @link http://docs-im.easemob.com/im/server/basics/chatroom#%E8%8E%B7%E5%8F%96%E7%A6%81%E8%A8%80%E5%88%97%E8%A1%A8
     *
     * @param string $roomId
     *
     * @return array
     */
    public function mutes(string $roomId)
    {
        return $this->request('GET', "chatrooms/{$roomId}/mute");
    }

    /**
     * 添加禁言
     *
     * @link http://docs-im.easemob.com/im/server/basics/chatroom#%E6%B7%BB%E5%8A%A0%E7%A6%81%E8%A8%80
     *
     * @param string $roomId
     * @param array  $usernames
     * @param        $mute_duration
     *
     * @return array
     */
    public function addMute(string $roomId, array $usernames, $mute_duration)
    {
        return $this->request('POST', "chatrooms/{$roomId}/mute", ['json' => compact('usernames', 'mute_duration')]);
    }

    /**
     * 移除禁言
     *
     * @link http://docs-im.easemob.com/im/server/basics/chatroom#%E7%A7%BB%E9%99%A4%E7%A6%81%E8%A8%80
     *
     * @param string $roomId
     * @param array  $usernames
     *
     * @return array
     */
    public function removeMute(string $roomId, array $usernames)
    {
        return $this->request('DELETE', "chatrooms/{$roomId}/mute/" . implode(',', $usernames));
    }

}