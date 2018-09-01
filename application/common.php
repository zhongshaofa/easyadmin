<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

use app\common\service\NodeService;
use think\Request;
use app\common\service\AuthService;
use think\facade\Cache;

if (!function_exists('check_login')) {

    /**
     * 检测前端用户是否登录
     */
    function check_login() {
        if (empty(session('user'))) {
            return false;
        } else {
            return true;
        }
    }
}

if (!function_exists('auth')) {

    /**
     * 权限节点判断
     * @param $node 节点
     * @return bool （true：有权限，false：无权限）
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    function auth($node) {
        return AuthService::checkNode($node);
    }
}

if (!function_exists('parseNodeStr')) {

    /**
     * 驼峰转下划线规则
     * @param string $node
     * @return string
     */
    function parseNodeStr($node) {
        $tmp = [];
        foreach (explode('/', $node) as $name) {
            $tmp[] = strtolower(trim(preg_replace("/[A-Z]/", "_\\0", $name), "_"));
        }
        return trim(join('/', $tmp), '/');
    }
}

if (!function_exists('password')) {

    /**
     * 密码加密算法
     * @param $value 需要加密的值
     * @param $type  加密类型，默认为md5 （md5, hash）
     * @return mixed
     */
    function password($value) {
        $value = sha1('blog_') . md5($value) . md5('_encrypt') . sha1($value);
        return sha1($value);
    }

}

if (!function_exists('__buildData')) {

    /**
     * 构建数据
     * @param $data   模型数据
     * @param $method 模型方法
     */
    function __buildData(&$data, $method) {
        foreach ($data as &$vo) {
            $vo->$method;
        }
    }
}

if (!function_exists('alert')) {

    /**
     * 弹出层提示
     * @param string $msg  提示信息
     * @param string $url  跳转链接
     * @param int    $time 停留时间 默认2秒
     * @param int    $icon 提示图标
     * @return string
     */
    function alert($msg = '', $url = '', $time = 3, $icon = 6) {
        $success = '<meta name="renderer" content="webkit">';
        $success .= '<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">';
        $success .= '<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">';
        $success .= '<script type="text/javascript" src="/static/plugs/jquery/jquery-2.2.4.min.js"></script>';
        $success .= '<script type="text/javascript" src="/static/plugs/layui-layer/layer.js"></script>';
        if (empty($url)) {
            $success .= '<script>$(function(){layer.msg("' . $msg . '", {icon: ' . $icon . ', time: ' . ($time * 1000) . '});})</script>';
        } else {
            $success .= '<script>$(function(){layer.msg("' . $msg . '",{icon:' . $icon . ',time:' . ($time * 1000) . '});setTimeout(function(){self.location.href="' . $url . '"},2000)});</script>';
        }
        return $success;
    }
}

if (!function_exists('msg_success')) {

    /**
     * 成功时弹出层提示信息
     * @param string $msg  提示信息
     * @param string $url  跳转链接
     * @param int    $time 停留时间 默认2秒
     * @param int    $icon 提示图标
     * @return string
     */
    function msg_success($msg = '', $url = '', $time = 3, $icon = 1) {
        return alert($msg, $url, $time, $icon);
    }
}

if (!function_exists('msg_error')) {

    /**
     * 失败时弹出层提示信息
     * @param string $msg  提示信息
     * @param string $url  跳转链接
     * @param int    $time 停留时间 默认2秒
     * @param int    $icon 提示图标
     * @return string
     */
    function msg_error($msg = '', $url = '', $time = 3, $icon = 2) {
        return alert($msg, $url, $time, $icon);
    }
}

if (!function_exists('clear_menu')) {

    /**
     * 清空菜单缓存
     */
    function clear_menu() {
        Cache::clear('menu');
    }
}


if (!function_exists('clear_basic')) {

    /**
     * 清空菜单缓存
     */
    function clear_basic() {
        Cache::clear('basic');
    }
}

if (!function_exists('get_ip')) {

    /**
     * 获取用户ip地址
     * @return array|false|string
     */
    function get_ip() {
        $ip = false;
        if (!empty($_SERVER["HTTP_CLIENT_IP"])) {
            $ip = $_SERVER["HTTP_CLIENT_IP"];
        }
        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ips = explode(", ", $_SERVER['HTTP_X_FORWARDED_FOR']);
            if ($ip) {
                array_unshift($ips, $ip);
                $ip = false;
            }
            for ($i = 0; $i < count($ips); $i++) {
                if (!eregi("^(10│172.16│192.168).", $ips[$i])) {
                    $ip = $ips[$i];
                    break;
                }
            }
        }
        return ($ip ? $ip : $_SERVER['REMOTE_ADDR']);
    }
}

if (!function_exists('get_location')) {

    /**
     * 根据ip获取地理位置
     * @param string $ip
     * @return mixed
     */
    function get_location($ip = '') {
        empty($ip) && $ip = get_ip();
        $url = "http://ip.taobao.com/service/getIpInfo.php?ip={$ip}";
        $ret = file_get_contents($url);
        $arr = json_decode($ret, true);
        return $arr['data'];
    }
}

if (!function_exists('install_substring')) {

    /**
     * 格式化安装配置信息
     * @param     $str
     * @param     $lenth
     * @param int $start
     * @return string
     */
    function install_substring($str, $lenth, $start = 0) {
        $len = strlen($str);
        $r = [];
        $n = 0;
        $m = 0;

        for ($i = 0; $i < $len; $i++) {
            $x = substr($str, $i, 1);
            $a = base_convert(ord($x), 10, 2);
            $a = substr('00000000 ' . $a, -8);

            if ($n < $start) {
                if (substr($a, 0, 1) == 0) {
                } elseif (substr($a, 0, 3) == 110) {
                    $i += 1;
                } elseif (substr($a, 0, 4) == 1110) {
                    $i += 2;
                }
                $n++;
            } else {
                if (substr($a, 0, 1) == 0) {
                    $r[] = substr($str, $i, 1);
                } elseif (substr($a, 0, 3) == 110) {
                    $r[] = substr($str, $i, 2);
                    $i += 1;
                } elseif (substr($a, 0, 4) == 1110) {
                    $r[] = substr($str, $i, 3);
                    $i += 2;
                } else {
                    $r[] = ' ';
                }
                if (++$m >= $lenth) {
                    break;
                }
            }
        }
        return join('', $r);
    }
}

if (!function_exists('parse_sql')) {

    /**
     * 格式化导入的sql语句
     * @param string $sql
     * @param int    $limit
     * @return array|string
     */
    function parse_sql($sql = '', $limit = 0) {
        if ($sql != '') {
            // 纯sql内容
            $pure_sql = [];

            // 多行注释标记
            $comment = false;

            // 按行分割，兼容多个平台
            $sql = str_replace(["\r\n", "\r"], "\n", $sql);
            $sql = explode("\n", trim($sql));

            // 循环处理每一行
            foreach ($sql as $key => $line) {
                // 跳过空行
                if ($line == '') {
                    continue;
                }

                // 跳过以#或者--开头的单行注释
                if (preg_match("/^(#|--)/", $line)) {
                    continue;
                }

                // 跳过以/**/包裹起来的单行注释
                if (preg_match("/^\/\*(.*?)\*\//", $line)) {
                    continue;
                }

                // 多行注释开始
                if (substr($line, 0, 2) == '/*') {
                    $comment = true;
                    continue;
                }

                // 多行注释结束
                if (substr($line, -2) == '*/') {
                    $comment = false;
                    continue;
                }

                // 多行注释没有结束，继续跳过
                if ($comment) {
                    continue;
                }

                // sql语句
                array_push($pure_sql, $line);
            }

            // 只返回一条语句
            if ($limit == 1) {
                return implode($pure_sql, "");
            }

            // 以数组形式返回sql语句
            $pure_sql = implode($pure_sql, "\n");
            $pure_sql = explode(";\n", $pure_sql);
            return $pure_sql;
        } else {
            return $limit == 1 ? '' : [];
        }
    }
}

if (!function_exists('curl')) {

    /**
     * 模拟请求
     * @return \app\common\service\CurlService
     */
    function curl() {
        return new \tool\Curl();
    }
}

if (!function_exists('__success')) {

    /**
     * 成功时返回的信息
     * @param $msg 消息
     * @return \think\response\Json
     */
    function __success($msg) {
        return json(['code' => 0, 'msg' => $msg]);
    }
}

if (!function_exists('__error')) {

    /**
     * 错误时返回的信息
     * @param $msg 消息
     * @return \think\response\Json
     */
    function __error($msg) {
        return json(['code' => 1, 'msg' => $msg]);
    }
}

if (!function_exists('is_mobile')) {

    /**
     * 判断客户端是否为手机
     * @return bool
     */
    function is_mobile() {
        $agent = strtolower($_SERVER['HTTP_USER_AGENT']);
        $is_pc = (strpos($agent, 'windows nt')) ? true : false;
        $is_mac = (strpos($agent, 'mac os')) ? true : false;
        $is_iphone = (strpos($agent, 'iphone')) ? true : false;
        $is_android = (strpos($agent, 'android')) ? true : false;
        $is_ipad = (strpos($agent, 'ipad')) ? true : false;
        if ($is_pc) return false;
        if ($is_mac) return true;
        if ($is_iphone) return true;
        if ($is_android) return true;
        if ($is_ipad) return true;
    }
}

if (!function_exists('get_time')) {

    /**
     * 获取当前时间
     * @return false|string
     */
    function get_time() {
        return date('Y-m-d H:i:s');
    }
}

if (!function_exists('code')) {

    /**
     * 生成随机数验证码
     * @param string $num
     * @return int
     */
    function code($num = '6') {
        $max = pow(10, $num) - 1;
        $min = pow(10, $num - 1);
        return rand($min, $max);
    }
}