<?php
/**
 * 发送消息
 *
 * @link http://docs-im.easemob.com/im/server/basics/messages
 * User: qbhy
 * Date: 2019/2/12
 * Time: 上午11:46
 */

namespace Qbhy\Easemob;

use Qbhy\Easemob\Kernel\Api;

class Message extends Api
{
    const TARGET_USER        = 'users'; // 用户
    const TARGET_CHAT_GROUPS = 'chatgroups'; // 群
    const TARGET_CHAT_ROOMS  = 'chatrooms'; // 聊天室

    const TEXT     = 'text';
    const IMAGE    = 'img';
    const LOCATION = 'loc';
    const AUDIO    = 'audio';
    const VIDEO    = 'video';
    const FILE     = 'file';

    /**
     * 发送消息
     *
     * @param array  $targets
     * @param string $targetType
     * @param string $from
     * @param array  $msg
     * @param array  $extras
     *
     * @return array
     */
    public function send(string $from, array $targets, array $msg, string $targetType = Message::TARGET_USER, array $extras = [])
    {
        return $this->request('POST', 'messages', [
            'json' => ['target' => $targets, 'target_type' => $targetType, 'from' => $from, 'msg' => $msg, 'ext' => $extras]
        ]);
    }

    /**
     * 发送图片消息
     *
     * @link http://docs-im.easemob.com/im/server/basics/messages#%E5%8F%91%E9%80%81%E5%9B%BE%E7%89%87%E6%B6%88%E6%81%AF
     *
     * @param string $from
     * @param array  $targets
     * @param array  $image
     * @param string $targetType
     * @param array  $extras
     *
     * @return array
     */
    public function sendImage(string $from, array $targets, array $image, string $targetType = Message::TARGET_USER, array $extras = [])
    {
        return $this->send($from, $targets, array_merge(['type' => Message::IMAGE,], $image), $targetType, $extras);
    }

    /**
     * 发送语音消息
     *
     * @link http://docs-im.easemob.com/im/server/basics/messages#%E5%8F%91%E9%80%81%E8%AF%AD%E9%9F%B3%E6%B6%88%E6%81%AF
     *
     * @param string $from
     * @param array  $targets
     * @param array  $audio
     * @param string $targetType
     * @param array  $extras
     *
     * @return array
     */
    public function sendAudio(string $from, array $targets, array $audio, string $targetType = Message::TARGET_USER, array $extras = [])
    {
        return $this->send($from, $targets, array_merge(['type' => Message::AUDIO], $audio), $targetType, $extras);
    }

    /**
     * 发送文本消息
     *
     * @link http://docs-im.easemob.com/im/server/basics/messages#%E5%8F%91%E9%80%81%E6%96%87%E6%9C%AC%E6%B6%88%E6%81%AF
     *
     * @param string $from
     * @param array  $targets
     * @param string $text
     * @param string $targetType
     * @param array  $extras
     *
     * @return array
     */
    public function sendText(string $from, array $targets, string $text, string $targetType = Message::TARGET_USER, array $extras = [])
    {
        return $this->send($from, $targets, ['type' => Message::TEXT, 'msg' => $text], $targetType, $extras);
    }


    /**
     * 发送视频消息
     *
     * @link http://docs-im.easemob.com/im/server/basics/messages#%E5%8F%91%E9%80%81%E8%A7%86%E9%A2%91%E6%B6%88%E6%81%AF
     *
     * @param string $from
     * @param array  $targets
     * @param array  $video
     * @param string $targetType
     * @param array  $extras
     *
     * @return array
     */
    public function sendVideo(string $from, array $targets, array $video, string $targetType = Message::TARGET_USER, array $extras = [])
    {
        return $this->send($from, $targets, array_merge(['type' => Message::VIDEO], $video), $targetType, $extras);
    }

    /**
     * 发送透传消息
     *
     * @link http://docs-im.easemob.com/im/server/basics/messages#%E5%8F%91%E9%80%81%E8%A7%86%E9%A2%91%E6%B6%88%E6%81%AF
     *
     * @param string $from
     * @param array  $targets
     * @param array  $msg
     * @param string $targetType
     * @param array  $extras
     *
     * @return array
     */
    public function sendCommand(string $from, array $targets, array $msg, string $targetType = Message::TARGET_USER, array $extras = [])
    {
        return $this->send($from, $targets, $msg, $targetType, $extras);
    }


}