<?php

namespace Bine\wechat\services;

use Bine\wechat\interfaces\MaterialInterface;
use Bine\wechat\publics\Controller;

class Material extends Controller implements MaterialInterface
{
    /**
     * 查询素材总数
     *
     * @Author RJie
     * @return mixed
     * @throws \Exception
     */
    public function getMaterialCount()
    {
        $url = static::$uri . '/cgi-bin/material/get_materialcount';

        $result = $this->ApiRequest('get', $url, ['access_token' => $this->getAccessToken]);
        return $result;
    }


    /**
     * 查询永久素材列表
     * @Author RJie
     * @param string $type
     * @return mixed
     * @throws \ErrorException
     */
    public function getMaterialList($type = 'image')
    {
        $url = static::$uri . '/cgi-bin/material/batchget_material?access_token=' . $this->getAccessToken;

        $materialCount = $this->getMaterialCount();

        //返回微信错误码
        if (!empty($materialCount['errcode'])) {
            throw new \ErrorException($materialCount['errmsg'], $materialCount['errcode']);
        }

        $count = 0;
        switch ($type) {
            case 'image':   //图片
                $count = $materialCount['image_count'];
                break;
            case 'news':    //图文
                $count = $materialCount['news_count'];
                break;
            case 'voice':   //语音
                $count = $materialCount['voice_count'];
                break;
            case 'video':   //视频
                $count = $materialCount['video_count'];
                break;
        }

        $data = [
            'type' => $type,
            'offset' => 0,
            'count' => $count,
        ];

        if ($count <= 0) {
            return $this->resSuccess('暂无可用永久素材,请上传！');
        }

        $result = $this->ApiRequest('post', $url, $data, 'json');
        return $result;
    }

    /**
     * 上传图文消息内的图片获取URL
     *
     * @Author RJie
     * @param $image  图片绝对路径
     * @return bool|string
     * @throws \ErrorException
     */
    public function uploadImg($image)
    {
        if (!$image) {
            throw new \ErrorException('图片路径不存在', 601);
        }

        $imgInfo = getimagesize($image);
        if ($imgInfo['mime'] != 'image/jpeg' && $imgInfo['mime'] != 'image/jpg') {
            throw new \ErrorException('图片格式错误', 604);
        }

        //图片大小不能超过1M
        $imgLength = filesize($image);
        if ($imgLength > (1024 * 1024)) {
            throw new \ErrorException('图片大小不能超过1M', 602);
        }

        $url = static::$uri . '/cgi-bin/media/uploadimg?access_token=' . $this->getAccessToken;

        $data = [
            'media' => new \CURLFile($image),
        ];

        $result = $this->curl_post($url, $data);
        return $result;
    }

    /**
     * 新增其他类型永久素材
     *
     * @Author RJie
     * @param $img_url
     * @param string $type
     * @return bool|string
     * @throws \ErrorException
     */
    public function addMaterial($img_url, $type = 'image')
    {
        if (!$img_url) {
            throw new \ErrorException('图片路径不存在', 601);
        }

        //这里是请求地址，token和素材类型(type)通过get方式传递
        $url = "https://api.weixin.qq.com/cgi-bin/material/add_material?access_token=" . $this->getAccessToken . "&type=" . $type;

        //这里声明文件的路径，使用绝对路径
//        $file_path = $_SERVER['DOCUMENT_ROOT']."/uploads/images/20190417161541.jpg"; //todo 测试
        $file_path = $img_url;    //对比使用

        if (!file_exists($file_path)) {
            throw new \ErrorException('图片不存在', 601);
        }

        //判断图片是否大于2M
        if (filesize($file_path) > 1024 * 1024 * 2) {
            throw new \ErrorException('图片不能大于2M', 602);
        }

        $file_data = array("media" => new \CURLFile($file_path)); //传递的数组，从PHP5.5版本以后，引入了新的CURLFile 类来指向文件，参数传入的也是绝对路径

        $result = $this->curl_post($url, $file_data);

        return $result;
    }

    /**
     * 新增永久图文素材
     *
     * @Author RJie
     * @param $articles
     * @return mixed
     * @throws \ErrorException
     */
    public function materialAddNews($articles)
    {
        $url = 'https://api.weixin.qq.com/cgi-bin/material/add_news?access_token=' . $this->getAccessToken;

        try {
            $data['articles'] = [];
            foreach ($articles as $key => $value) {
                $res = [];

                if (array_key_exists('title', $value)) {
                    $res['title'] = $value['title'];
                } else {
                    throw new \ErrorException('标题不能为空', 700);
                }

                if (array_key_exists('thumb_media_id', $value)) {
                    $res['thumb_media_id'] = $value['thumb_media_id'];
                } else {
                    throw new \ErrorException('图文消息的封面图片素材id不能为空', 700);
                }
                $res['author'] = $value['author'];


                $res['digest'] = array_key_exists('digest', $value) ? $value['digest'] : '';

                $res['show_cover_pic'] = array_key_exists('show_cover_pic', $value) ? $value['show_cover_pic'] : 1;

                if (array_key_exists('content', $value) && strlen($value['content']) < 20000) {
                    $res['content'] = $value['content'];
                } else {
                    throw new \ErrorException('图文消息的具体内容不能为空', 700);
                }

                $res['content_source_url'] = array_key_exists('content_source_url', $value) ? $value['content_source_url'] : '';
                $res['need_open_comment'] = array_key_exists('need_open_comment', $value) ? $value['need_open_comment'] : 0;
                $res['only_fans_can_comment'] = array_key_exists('only_fans_can_comment', $value) ? $value['only_fans_can_comment'] : 0;

                $data['articles'][] = $res;
            }
        } catch (\Exception $e) {
            throw new \ErrorException($e->getMessage(), 702);
        }

        // 上传微信
        $result = $this->curl_post($url, json_encode($data, JSON_UNESCAPED_UNICODE));
        return $result;
    }

    /**
     * 群发消息
     *
     * @Author RJie
     * @param $content
     * @param string $type
     * @param string $is_filter
     * @param array $people
     * @return bool|string
     * @throws \ErrorException
     */
    public function groupSending($content, $type = 'news', $is_filter = 'test',array $people=[])
    {
        // 发送路径
        $url = '';
        if ($is_filter == 'filter') {
            $url = static::$uri . '/cgi-bin/message/mass/sendall?access_token=' . $this->getAccessToken;
        } elseif ($is_filter == 'touser') {
            $url = static::$uri . '/cgi-bin/message/mass/send?access_token=' . $this->getAccessToken;
        } elseif ($is_filter == 'test') { //TODO 测试号路径
            $url = static::$uri . "/cgi-bin/message/mass/preview?access_token=" . $this->getAccessToken;
        }

        // 发送内容
        $data = [];
        if ($is_filter == 'filter') {
            $data['filter'] = [
                'is_to_all' => $people['is_to_all'] ?? true,
                'tag_id' => $people['tag_id'] ?? '',
            ];
        } elseif ($is_filter == 'touser') {
            if($people['touser'] || !is_array($people['touser'])){
                throw new \ErrorException('openid格式错误');
            }
            $data['touser'] = $people['touser'];
        } elseif ($is_filter == 'test') {
            $data['touser'] = 'oKvOqwmQW-PT1f2ws4-b0fu7FzAA';
        }

        switch ($type) {
            case 'news': //图文消息发送
                $media_id = $content;
                if (!$media_id) {
                    throw new \ErrorException('图文素材ID不能为空');
                }

                $data['mpnews'] = [
                    'media_id' => $media_id
                ];
                $data['msgtype'] = 'mpnews';
                $data['send_ignore_reprint'] = 0;

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
                    throw new \ErrorException('图文素材ID不能为空');
                }

                $data['image'] = ['media_id' => $media_id];
                $data['msgtype'] = 'image';

                break;
        }

        $result = $this->curl_post($url, json_encode($data, JSON_UNESCAPED_UNICODE));
        return $result;
    }
}
