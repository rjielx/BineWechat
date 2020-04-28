<?php

namespace Bine\wechat\services\message;

use Bine\wechat\interfaces\MassMessageInterface;
use Bine\wechat\publics\Controller;

class MassMessage extends Controller implements MassMessageInterface
{
    /**
     * 群发消息
     *
     * @Author RJie
     * @param $content 图文ID或文本内容
     * @param array $people 接收人信息
     * @param string $type 发送类型
     * @param string $is_filter 发送路径
     * @return bool|string
     * @throws \ErrorException
     */
    public function groupSending($content, array $people = [], $type = 'news', $is_filter = 'filter')
    {
        // 发送路径
        $url = '';
        if ($is_filter == 'filter') {  // 根据标签进行群发
            $url = static::$uri . '/cgi-bin/message/mass/sendall?access_token=' . $this->getAccessToken;
        } elseif ($is_filter == 'touser') { // 根据OpenID列表群发
            $url = static::$uri . '/cgi-bin/message/mass/send?access_token=' . $this->getAccessToken;
        } elseif ($is_filter == 'dev') { // 预览接口
            $url = static::$uri . "/cgi-bin/message/mass/preview?access_token=" . $this->getAccessToken;
        }

        // 接收人
        $data = [];
        if ($is_filter == 'filter') {
            $data['filter'] = [
                'is_to_all' => $people['is_to_all'] ?? true,
                'tag_id' => $people['tag_id'] ?? '',
            ];
        } elseif ($is_filter == 'touser') {
            if ($people['touser'] || !is_array($people['touser'])) {
                throw new \ErrorException('openid格式错误');
            }
            $data['touser'] = $people['touser'];
        } elseif ($is_filter == 'dev') {
            $data['touser'] = $people['touser']; // 字符串
        }

        switch ($type) {
            case 'news': //图文消息发送
                $media_id = $content;
                if (!$media_id) {
                    throw new \ErrorException('图文素材ID不能为空');
                }

                $data['mpnews'] = ['media_id' => $media_id];
                $data['msgtype'] = 'mpnews';
                $data['send_ignore_reprint'] = 0;
                $data['clientmsgid'] = $media_id;

                break;
            case 'text': //文本群发消息
                $content = $content;
                if (!$content) {
                    throw new \ErrorException('文本消息不能为空');
                }

                $data['text'] = ['content' => $content];
                $data['msgtype'] = 'text';

                break;
            case 'image': //图片群发消息
                $media_id = $content;
                if (!$media_id) {
                    throw new \ErrorException('图片素材ID不能为空');
                }

                $data['image'] = ['media_id' => $media_id];
                $data['msgtype'] = 'image';
                $data['clientmsgid'] = $media_id;

                break;
        }

        $result = $this->curl_post($url, json_encode($data, JSON_UNESCAPED_UNICODE));
        return $result;
    }


    /**
     * 删除群发
     *
     * @Author RJie
     * @param $msg_id 发送出去的消息ID
     * @param int $article_idx 要删除的文章在图文消息中的位置，第一篇编号为1，该字段不填或填0会删除全部文章
     * @return mixed
     * @throws \ErrorException
     */
    public function massDelete($msg_id,$article_idx = 0)
    {
        if(!$msg_id){
            throw new \ErrorException('发送出去的消息ID不能为空');
        }

        $url = static::$uri . '/cgi-bin/message/mass/delete?access_token=' . $this->getAccessToken;

        $data = [
            'msg_id' => $msg_id,
            'article_idx' => $article_idx,
        ];

        $result = $this->ApiRequest('post',$url,$data,'json');
        return $result;
    }
}
