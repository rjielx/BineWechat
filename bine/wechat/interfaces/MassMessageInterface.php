<?php
namespace Bine\wechat\interfaces;

interface MassMessageInterface
{
    /**
     * @Author RJie
     * @param $content
     * @param array $people
     * @param string $type
     * @param string $is_filter
     * @return mixed
     */
    public function groupSending($content, array $people = [], $type = 'news', $is_filter = 'filter');


    /**
     * @Author RJie
     * @param $msg_id
     * @param int $article_idx
     * @return mixed
     */
    public function massDelete($msg_id,$article_idx = 0);
}
