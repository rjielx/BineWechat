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
     * @return mixed
     */
    public function materialAddNews();
}
