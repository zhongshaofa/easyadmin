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

use Aliyun\Core\Config;
use Aliyun\Core\Profile\DefaultProfile;
use Aliyun\Core\DefaultAcsClient;
use Aliyun\Api\Sms\Request\V20170525\SendSmsRequest;
use Aliyun\Api\Sms\Request\V20170525\SendBatchSmsRequest;
use Aliyun\Api\Sms\Request\V20170525\QuerySendDetailsRequest;
use think\Db;
use think\Controller;

// 加载区域结点配置
Config::load();

/**
 * 短信服务类
 * Class SmsService
 * @package app\common\service
 */
class SmsService extends Controller {

    static $acsClient = null;

    /**
     * 取得AcsClient
     * @return DefaultAcsClient
     */
    public static function getAcsClient() {
        $smsInfo = Db::name('SystemConfig')->where('group', 'sms')->column('name,value');
        $accessKeyId = $smsInfo['AccessKeyId'];
        $accessKeySecret = $smsInfo['AccessKeySecret'];
        $product = "Dysmsapi";
        $domain = "dysmsapi.aliyuncs.com";
        $region = "cn-hangzhou";
        $endPointName = "cn-hangzhou";
        if (static::$acsClient == null) {
            $profile = DefaultProfile::getProfile($region, $accessKeyId, $accessKeySecret);
            DefaultProfile::addEndpoint($endPointName, $region, $product, $domain);
            static::$acsClient = new DefaultAcsClient($profile);
        }
        return static::$acsClient;
    }


    /**
     * 发送短信
     * @param string $phone         手机号
     * @param string $templateParam 短信参数，数组形式 ['code'=>'123456','product'=>'测试']
     * @param string $signName      签名名称
     * @param string $templateCode  模板CODE
     * @return mixed|\SimpleXMLElement
     */
    public static function sendSms($Phone = '', $TemplateParam = '', $SignName = '', $TemplateCode = '') {
        //为空设置默认值
        empty($TemplateParam) && $TemplateParam = ['code' => code()];
        empty($SignName) && $SignName = Db::name('SystemConfig')->where(['group' => 'sms', 'name' => 'SignName'])->value('value');
        empty($TemplateCode) && $TemplateCode = Db::name('sms_template')->where(['type' => 1])->value('name');

        // 初始化SendSmsRequest实例用于设置发送短信的参数
        $request = new SendSmsRequest();
        //可选-启用https协议
        //$request->setProtocol("https");
        // 必填，设置短信接收号码
        $request->setPhoneNumbers($Phone);
        // 必填，设置签名名称，应严格按"签名名称"填写，请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/sign
        $request->setSignName($SignName);
        // 必填，设置模板CODE，应严格按"模板CODE"填写, 请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/template
        $request->setTemplateCode($TemplateCode);
        // 可选，设置模板参数, 假如模板中存在变量需要替换则为必填项
        $request->setTemplateParam(json_encode($TemplateParam, JSON_UNESCAPED_UNICODE));// 短信模板中字段的值,以数组形式
        // 可选，设置流水号
        $request->setOutId("sms_" . time());
        // 选填，上行短信扩展码（扩展码字段控制在7位或以下，无特殊需求用户请忽略此字段）
//        $request->setSmsUpExtendCode("1234567");
        // 发起访问请求
        $acsResponse = static::getAcsClient()->getAcsResponse($request);
        return $acsResponse;
    }

    /**
     * 批量发送短信
     * @param string $PhoneArray         手机号列表["1500000000","1500000001",]
     * @param string $TemplateParamArray 短信参数 [["name" => "Tom","code" => "123",],["name" => "Jack","code" => "456",],]
     * @param string $SignNameArray      短信签名列表["云通信","云通信",]
     * @param string $TemplateCode       短信模板 SMS_1000000
     * @return mixed|\SimpleXMLElement
     */
    public static function sendBatchSms($PhoneArray = '', $TemplateParamArray = '', $SignNameArray = '', $TemplateCode = '') {

        //为空设置默认值
        if (empty($SignNameArray)) {
            $SignName = Db::name('SystemConfig')->where(['group' => 'sms', 'name' => 'SignName'])->value('value');
            for ($i = 0; $i < count($PhoneArray); $i++) {
                $SignNameArray[] = $SignName;
            }
        }
        if (empty($TemplateParamArray)) {
            for ($i = 0; $i < count($PhoneArray); $i++) {
                $TemplateParamArray[] = ['code' => code()];
            }
        }
        empty($TemplateCode) && $TemplateCode = Db::name('sms_template')->where(['type' => 1])->value('name');;

        // 初始化SendSmsRequest实例用于设置发送短信的参数
        $request = new SendBatchSmsRequest();
        //可选-启用https协议
        //$request->setProtocol("https");
        // 必填:待发送手机号。支持JSON格式的批量调用，批量上限为100个手机号码,批量调用相对于单条调用及时性稍有延迟,验证码类型的短信推荐使用单条调用的方式
        $request->setPhoneNumberJson(json_encode($PhoneArray, JSON_UNESCAPED_UNICODE));
        // 必填:短信签名-支持不同的号码发送不同的短信签名
        $request->setSignNameJson(json_encode($SignNameArray, JSON_UNESCAPED_UNICODE));
        // 必填:短信模板-可在短信控制台中找到
        $request->setTemplateCode($TemplateCode);
        // 必填:模板中的变量替换JSON串,如模板内容为"亲爱的${name},您的验证码为${code}"时,此处的值为
        // 友情提示:如果JSON中需要带换行符,请参照标准的JSON协议对换行符的要求,比如短信内容中包含\r\n的情况在JSON中需要表示成\\r\\n,否则会导致JSON在服务端解析失败
        $request->setTemplateParamJson(json_encode($TemplateParamArray, JSON_UNESCAPED_UNICODE));
        // 可选-上行短信扩展码(扩展码字段控制在7位或以下，无特殊需求用户请忽略此字段)
        // $request->setSmsUpExtendCodeJson("[\"90997\",\"90998\"]");
        // 发起访问请求
        $acsResponse = static::getAcsClient()->getAcsResponse($request);
        return $acsResponse;
    }

    /**
     * 短信发送记录查询
     * @param string $Phone       手机号
     * @param string $SendDate    时间 20180612
     * @param string $BizId       流水号
     * @param string $PageSize    每页显示数量
     * @param string $CurrentPage 当前页
     * @return mixed|\SimpleXMLElement
     */
    public static function querySendDetails($Phone = '', $SendDate = '', $BizId = '', $PageSize = '10', $CurrentPage = '1') {

        //时间为空设置默认值
        empty($SendDate) && $SendDate = date("Ymd");

        // 初始化QuerySendDetailsRequest实例用于设置短信查询的参数
        $request = new QuerySendDetailsRequest();

        //可选-启用https协议
        //$request->setProtocol("https");

        // 必填，短信接收号码
        $request->setPhoneNumber($Phone);

        // 必填，短信发送日期，格式Ymd，支持近30天记录查询
        $request->setSendDate($SendDate);

        // 必填，分页大小
        $request->setPageSize($PageSize);

        // 必填，当前页码
        $request->setCurrentPage($CurrentPage);

        // 选填，短信发送流水号
        $request->setBizId($BizId);

        // 发起访问请求
        $acsResponse = static::getAcsClient()->getAcsResponse($request);
    }
}

