<?php
namespace Bine\wechat\interfaces;

interface MaterialInterface
{
    /**
     * @Author RJie
     * @return mixed
     */
    public function getMaterialCount();

    /**
     * @Author RJie
     * @param string $type
     * @return mixed
     */
    public function getMaterialList($type = 'image');

    /**
     * @Author RJie
     * @param $image
     * @return mixed
     */
    public function uploadImg($image);

    /**
     * @Author RJie
     * @param $img_url
     * @param string $type
     * @return mixed
     */
    public function addMaterial($img_url, $type = 'image');

    /**
     * @Author RJie
     * @param $articles
     * @return mixed
     */
    public function materialAddNews($articles);

    /**
     * @Author RJie
     * @param $content
     * @param string $type
     * @param string $is_filter
     * @param array $people
     * @return mixed
     */
    public function groupSending($content, $type = 'news', $is_filter = 'test',array $people=[]);
}
