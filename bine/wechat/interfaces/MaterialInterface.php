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
     * @param $media_id
     * @return mixed
     */
    public function getMaterial($media_id);

    /**
     * @Author RJie
     * @param $media_id
     * @return mixed
     */
    public function delMaterial($media_id);

    /**
     * @Author RJie
     * @param array $params
     * @return mixed
     */
    public function materialUpdateNews(array $params);
}
