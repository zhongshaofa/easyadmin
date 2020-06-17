<?php


namespace addons\email;

use addons\email\service\EmailService;

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

    /**
     * 发送邮箱
     * @param $toemail
     * @param $title
     * @param $info
     * @return array
     * @throws library\PHPMailer\Exception
     */
    public function send($toemail, $title, $info)
    {
        $result = (new EmailService())->send($toemail, $title, $info);
        return $result;
    }

}