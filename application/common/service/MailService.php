<?php

// +----------------------------------------------------------------------
// | Think.Admin
// +----------------------------------------------------------------------
// | 版权所有 2014~2017 广州楚才信息科技有限公司 [ http://www.cuci.cc ]
// +----------------------------------------------------------------------
// | 官方网站: http://think.ctolog.com
// +----------------------------------------------------------------------
// | 开源协议 ( https://mit-license.org )
// +----------------------------------------------------------------------
// | github开源项目：https://github.com/zoujingli/Think.Admin
// +----------------------------------------------------------------------

namespace app\common\service;

use app\admin\model\User;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use think\Db;

/**
 * 邮箱服务类
 * Class MailService
 * @package app\common\service
 */
class MailService {

    /**
     * @var 邮箱服务类对象
     */
    public static $mail;

    /**
     * 初始化服务类
     * MailService constructor.
     */
    public static function __init() {
        $mailInfo = Db::name('SystemConfig')->where('group', 'mail')->column('name,value');//获取邮箱配置信息
        self::$mail = new PHPMailer();
        self::$mail->isSMTP();// 使用SMTP服务
        self::$mail->CharSet = "utf8";// 编码格式为utf8，不设置编码的话，中文会出现乱码
        self::$mail->Host = $mailInfo['MailHost'];// 发送方的SMTP服务器地址
        self::$mail->SMTPAuth = true;// 是否使用身份验证
        self::$mail->Username = $mailInfo['MailUsername'];// 发送方的QQ邮箱用户名，就是自己的邮箱名
        self::$mail->Password = $mailInfo['MailPassword'];// 发送方的邮箱密码，不是登录密码,是qq的第三方授权登录码,要自己去开启,在邮箱的设置->账户->POP3/IMAP/SMTP/Exchange/CardDAV/CalDAV服务 里面
        self::$mail->setFrom($mailInfo['MailUsername'], $mailInfo['MailNickname']);// 设置发件人信息，如邮件格式说明中的发件人,
        self::$mail->addReplyTo($mailInfo['MailReplyTo'], $mailInfo['MailNickname']);// 设置回复人信息，指的是收件人收到邮件后，如果要回复，回复邮件将发送到的邮箱地址
        self::$mail->SMTPSecure = "ssl";// 使用ssl协议方式,
        self::$mail->Port = 465;// QQ邮箱的ssl协议方式端口号是465/587
    }

    /**
     * 发送邮箱信息
     * @param $toemail 邮箱 （可以为单个：chung@99php.cn  可以为数组：[chung@99php.cn, blog@99php.cn]）
     * @param $title   标题
     * @param $info    内容
     * @return array
     */
    public static function send($toemail, $title, $info) {
        self::__init();
        self::$mail->Subject = $title;
        self::$mail->Body = $info;
//        self::$mail->addCC("xxx@163.com");// 设置邮件抄送人，可以只写地址，上述的设置也可以只写地址(这个人也能收到邮件)
//        self::$mail->addBCC("xxx@163.com");// 设置秘密抄送人(这个人也能收到邮件)
//        self::$mail->addAttachment("bug0.jpg");// 添加附件
//        self::$mail->AltBody = "纯文本";// 这个是设置纯文本方式显示的正文内容，如果不支持Html方式，就会用到这个，基本无用

        //判断是否为群发信息
        if (is_array($toemail)) {
            foreach ($toemail as $vo) {
                self::$mail->addAddress($vo, 'send');
                !self::$mail->send() ? $msg[] = ['mail' => $vo, 'msg' => self::$mail->ErrorInfo] : $msg[] = ['mail' => $vo, 'msg' => '邮箱发送成功！'];
            }
            return ['code' => 1, 'msg' => $msg];
        } else {
            self::$mail->addAddress($toemail, 'send');
            if (!self::$mail->send()) {
                return ['code' => 1, 'msg' => self::$mail->ErrorInfo];
            } else {
                return ['code' => 0, 'msg' => '邮箱发送成功！'];
            }
        }
    }

}