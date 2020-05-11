<?php

namespace Bine\wechat\services\userManage;

use Bine\wechat\interfaces\TagsInterface;
use Bine\wechat\publics\Controller;

class Tags extends Controller implements TagsInterface
{
    /**
     * 创建标签
     *
     * @Author RJie
     * @param $tag_name
     * @return bool|string
     */
    public function tagsCreate($tag_name)
    {
        $url = static::$uri . '/cgi-bin/tags/create?access_token=' . $this->getAccessToken;

        $data = [
            'tag' => [
                'name' => $tag_name,
            ]
        ];

        $result = $this->curl_post($url, json_encode($data, JSON_UNESCAPED_UNICODE));
        return $result;
    }

    /**
     * 获取公众号已创建的标签
     *
     * @Author RJie
     * @return mixed
     * @throws \Exception
     */
    public function getTags()
    {
        $url = static::$uri . '/cgi-bin/tags/get?access_token=' . $this->getAccessToken;

        $result = $this->ApiRequest('get', $url);
        return $result;
    }

    /**
     * 编辑标签
     *
     * @Author RJie
     * @param $tag_id
     * @param $tag_name
     * @return bool|string
     */
    public function tagsUpdate($tag_id, $tag_name)
    {
        $url = static::$uri . '/cgi-bin/tags/update?access_token=' . $this->getAccessToken;

        $data = [
            'tag' => [
                'id' => $tag_id,
                'name' => $tag_name
            ]
        ];

        $result = $this->curl_post($url, json_encode($data, JSON_UNESCAPED_UNICODE));
        return $result;
    }

    /**
     * 删除标签
     *
     * @Author RJie
     * @param $tag_id
     * @return mixed
     * @throws \Exception
     */
    public function tagsDelete($tag_id)
    {
        $url = static::$uri . '/cgi-bin/tags/delete?access_token=' . $this->getAccessToken;

        $data = [
            'tag' => [
                'id' => $tag_id
            ]
        ];

        $result = $this->ApiRequest('post', $url, $data, 'json');
        return $result;
    }

    /**
     * 获取标签下粉丝列表
     *
     * @Author RJie
     * @param $tag_id
     * @param string $next_openid
     * @return mixed
     * @throws \Exception
     */
    public function getUserTags($tag_id, $next_openid = '')
    {
        $url = static::$uri . '/cgi-bin/user/tag/get?access_token=' . $this->getAccessToken;

        $data = [
            'tagid' => $tag_id,
            'next_openid' => $next_openid
        ];

        $result = $this->ApiRequest('post', $url, $data, 'json');
        return $result;
    }

    /**
     * 批量为用户打标签
     *
     * @Author RJie
     * @param $tag_id
     * @param array $opinid_list
     * @return mixed
     * @throws \Exception
     */
    public function batchTagging($tag_id, array $opinid_list)
    {
        $url = static::$uri . '/cgi-bin/tags/members/batchtagging?access_token=' . $this->getAccessToken;

        $data = [
            "openid_list" => $opinid_list,
            "tagid" => $tag_id
        ];

        $result = $this->ApiRequest('post', $url, $data, 'json');
        return $result;
    }


    /**
     * 批量为用户取消标签
     *
     * @Author RJie
     * @param $tag_id
     * @param array $opinid_list
     * @return mixed
     * @throws \Exception
     */
    public function batchUnTagging($tag_id, array $opinid_list)
    {
        $url = static::$uri . '/cgi-bin/tags/members/batchuntagging?access_token=' . $this->getAccessToken;

        $data = [
            "openid_list" => $opinid_list,
            "tagid" => $tag_id
        ];

        $result = $this->ApiRequest('post', $url, $data, 'json');
        return $result;
    }


    /**
     * 获取用户身上的标签列表
     *
     * @Author RJie
     * @param $openid
     * @return mixed
     * @throws \Exception
     */
    public function getIdList($openid)
    {
        $url = static::$uri . '/cgi-bin/tags/getidlist?access_token=' . $this->getAccessToken;
        $data = [
            'openid' => $openid
        ];

        $result = $this->ApiRequest('post', $url, $data, 'json');
        return $result;
    }
}
