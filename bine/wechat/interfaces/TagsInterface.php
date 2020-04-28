<?php
namespace Bine\wechat\interfaces;

interface TagsInterface
{
    /**
     * @Author RJie
     * @param $tag_name
     * @return mixed
     */
    public function tagsCreate($tag_name);

    /**
     * @Author RJie
     * @return mixed
     */
    public function getTags();

    /**
     * @Author RJie
     * @param $tag_id
     * @param $tag_name
     * @return mixed
     */
    public function tagsUpdate($tag_id,$tag_name);

    /**
     * @Author RJie
     * @param $tag_id
     * @return mixed
     */
    public function tagsDelete($tag_id);

    /**
     * @Author RJie
     * @param $tag_id
     * @param string $next_openid
     * @return mixed
     */
    public function getUserTags($tag_id, $next_openid = '');
}
