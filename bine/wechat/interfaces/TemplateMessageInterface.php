<?php

namespace Bine\wechat\interfaces;

interface TemplateMessageInterface
{
    /**
     * @Author RJie
     * @return mixed
     */
    public function getIndustry();

    /**
     * @Author RJie
     * @param $industry_id1
     * @param $industry_id2
     * @return mixed
     */
    public function setIndustry($industry_id1, $industry_id2);

    /**
     * @Author RJie
     * @return mixed
     */
    public function getAllPrivateTemplate();

    /**
     * @Author RJie
     * @param $template_id
     * @return mixed
     */
    public function delPrivateTemplate($template_id);
}
