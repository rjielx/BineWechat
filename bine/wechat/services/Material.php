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
            throw new \ErrorException('图片路径不存在',601);
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
        if(!$img_url){
            throw new \ErrorException('图片路径不存在',601);
        }

        //这里是请求地址，token和素材类型(type)通过get方式传递
        $url = "https://api.weixin.qq.com/cgi-bin/material/add_material?access_token=".$this->getAccessToken."&type=".$type;

        //这里声明文件的路径，使用绝对路径
//        $file_path = $_SERVER['DOCUMENT_ROOT']."/uploads/images/20190417161541.jpg"; //todo 测试
        $file_path = $img_url;    //对比使用

        if(!file_exists($file_path)){
            throw new \ErrorException('图片不存在',601);
        }

        //判断图片是否大于2M
        if(filesize($file_path) > 1024*1024*2){
            throw new \ErrorException('图片不能大于2M',602);
        }

        $file_data = array("media"  => new \CURLFile($file_path)); //传递的数组，从PHP5.5版本以后，引入了新的CURLFile 类来指向文件，参数传入的也是绝对路径

        $result = $this->curl_post($url,$file_data);

        return $result;
    }


    public function materialAddNews()
    {

    }
}
