<?php


namespace addons\alisms;


/**
 * 插件公共方法
 * Class Addon
 * @package addons\email
 */
class Plugin
{

    /**
     * 安装方法
     */
    public function install()
    {
        return true;
    }

    /**
     * 卸载方法
     */
    public function uninstall()
    {
        return true;
    }


    public function send($phone)
    {
        return true;
    }

    public function check(){

    }

}