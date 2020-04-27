<?php

namespace Bine\wechat\interfaces;

interface MenuInterface
{
    /**
     * @Author RJie
     * @param $data
     * @param string $data_type
     * @return mixed
     */
    public function setMenu($data, $data_type = 'array');

    /**
     * @Author RJie
     * @return mixed
     */
    public function queryMenu();

    /**
     * @Author RJie
     * @return mixed
     */
    public function deleteMenu();
}
