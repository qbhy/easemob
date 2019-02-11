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
        return $this->request('POST', 'chatrooms', array_merge(compact('name', 'owner', 'description'), $optional));
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
        return $this->request('PUT', 'chatrooms', compact('name', 'description', 'maxusers'));
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
}