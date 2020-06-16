<?php

namespace addons\email\service;


use addons\email\library\PHPMailer\PHPMailer;

class EmailService
{

    protected $mail;

    public function __construct()
    {
        $config = get_addon_config('email');
        $this->mail = new PHPMailer();
        $this->mail->isSMTP();                                                                      // 使用SMTP服务
        $this->mail->CharSet = "utf8";                                                              // 编码格式为utf8，不设置编码的话，中文会出现乱码
        $this->mail->Host = $config['mail_host'];                                                   // 发送方的SMTP服务器地址
        $this->mail->SMTPAuth = true;                                                               // 是否使用身份验证
        $this->mail->Username = $config['mail_username'];                                           // 发送方的QQ邮箱用户名，就是自己的邮箱名
        $this->mail->Password = $config['mail_password'];                                           // 发送方的邮箱密码，不是登录密码,是qq的第三方授权登录码,要自己去开启,在邮箱的设置->账户->POP3/IMAP/SMTP/Exchange/CardDAV/CalDAV服务 里面
        $this->mail->setFrom($config['mail_username'], $config['mail_nickname']);   // 设置发件人信息，如邮件格式说明中的发件人,
        $this->mail->addReplyTo($config['mail_reply_to'], $config['mail_nickname']);// 设置回复人信息，指的是收件人收到邮件后，如果要回复，回复邮件将发送到的邮箱地址
        $this->mail->SMTPSecure = "ssl";                                                            // 使用ssl协议方式,
        $this->mail->Port = 465;
    }

    /**
     * 发送邮箱
     * @param $toemail
     * @param $title
     * @param $info
     * @return array
     * @throws \addons\email\library\PHPMailer\Exception
     */
    public function send($toemail, $title, $info)
    {
        $this->mail->Subject = $title;
        $this->mail->Body = $info;
        if (is_array($toemail)) {
            $msg = [];
            foreach ($toemail as $vo) {
                $this->mail->addAddress($vo, 'send');
                $msg[] = $this->mail->send() ? ['mail' => $vo, 'msg' => $this->mail->ErrorInfo] : ['mail' => $vo, 'msg' => '邮箱发送成功！'];
            }
            return ['code' => 1, 'msg' => $msg];
        }
        $this->mail->addAddress($toemail, 'send');
        if (!$this->mail->send()) {
            return ['code' => 0, 'msg' => $this->mail->ErrorInfo];
        } else {
            return ['code' => 1, 'msg' => '邮箱发送成功！'];
        }
    }

}