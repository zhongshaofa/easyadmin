<?php


namespace addons\email;

/**
 * 插件公共方法
 * Class Addon
 * @package addons\email
 */
class Addon
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

    /**
     * 发送邮箱
     * @param $email
     * @param $msg
     * @return string
     */
    public function send($email, $msg)
    {
        return "发送邮箱成功, 邮箱号：{$email}, 发送信息：{$msg}";
    }

}