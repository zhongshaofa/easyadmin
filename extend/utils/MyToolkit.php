<?php


namespace utils;

class MyToolkit
{
    const SUCCESS_CODE = 200;
    const LOGIN_CODE = 401;
    const AUTH_CODE = 403;
    const VALIDATE_CODE = 422;
    const ERROR_CODE = 500;

    public static function success($data = '', $msg = '信息调用成功！')
    {
        return self::returnData($data, $msg, self::SUCCESS_CODE);
    }

    public static function error($data = '', $msg = '信息调用成功！')
    {
        return self::returnData($data, $msg, self::ERROR_CODE);
    }

    public static function validate($data = '', $msg = '验证错误！')
    {
        return self::returnData($data, $msg, self::VALIDATE_CODE);
    }

    public static function login($data = '', $msg = '请先登录！')
    {
        return self::returnData($data, $msg, self::LOGIN_CODE);
    }

    public static function auth($data = '', $msg = '没有权限！')
    {
        return self::returnData($data, $msg, self::AUTH_CODE);
    }

    public static function returnData($data = '', $msg = '信息调用成功！', $code = 200)
    {
        return ['code' => $code, 'data' => $data, 'msg' => $msg, 'time' => request()->time()];
    }

    public static function paginate($data, $page, $limit, $total)
    {
        return [
            'items' => $data, 'page' => (int)$page, 'limit' => (int)$limit, 'total' => $total, 'pages' => ceil($total / $limit)
        ];
    }

    /**
     * 密码加密
     * @param $password
     * @return bool|string
     */
    public static function bcrypt($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    /**
     * 验证bcrypt的密码是否正确
     * @param $password
     * @param $hash
     * @return bool
     */
    public static function checkBcrypt($password, $hash)
    {
        return password_verify($password, $hash);
    }

    public static function convertToArray($items)
    {
        $result = [];
        foreach ($items as $k => $v) {
            $result[] = [
                'text' => $v,
                'value' => $k
            ];
        }

        return $result;
    }

    public static function setArrayIndex(array $arr, $key)
    {
        $newarr = [];
        foreach ($arr as $k => $v) {
            $newarr[$v[$key]] = $v;
        }

        return $newarr;
    }

    public static function setArray2Index(array $arr, $key)
    {
        $newArr = [];
        foreach ($arr as $k => $v) {
            if (is_array($v)) {
                $newArr[$v[$key]][] = $v;
            }
        }

        return $newArr;
    }

    public static function setArray2Column(array $arr, $key, $value)
    {
        $newArr = [];
        foreach ($arr as $k => $v) {
            $newArr[$v[$key]][] = $v[$value];
        }

        return $newArr;
    }

    /**
     * 数组转树状结构
     * @param array $data
     * @param string $fields
     * @param int $parentId
     * @param int $level
     * @param bool $allowChildEmpty 是否显示空的子节点
     * @return array
     */
    public static function makeTree(array $data, $fields = 'id|pid|children|_level', $parentId = 0, $level = 1, $allowChildEmpty = true)
    {
        $tree = [];
        list($idField, $pidField, $childField, $levelField) = explode('|', $fields);
        foreach ($data as $k => $v) {
            if ($v[$pidField] == $parentId) {
                $v[$levelField] = $level;
                unset($data[$k]);
                $childData = self::makeTree($data, $fields, $v[$idField], $level + 1);
                if ($childData || $allowChildEmpty) {
                    $v[$childField] = $childData;
                }
                $tree[] = $v;
            }
        }

        return $tree;
    }

    public static function timeDiff($beginTime, $endTime)
    {
        if ($beginTime > $endTime) {
            return ["day" => 0, "hour" => 0, "min" => 0, "sec" => 0];
        }

        $diffTime = $endTime - $beginTime;
        $days = intval($diffTime / 86400);
        $remain = $diffTime % 86400;
        $hours = intval($remain / 3600);
        $remain = $remain % 3600;
        $mins = intval($remain / 60);
        $secs = $remain % 60;

        return ["day" => $days, "hour" => $hours, "min" => $mins, "sec" => $secs];
    }

    /**
     * 下划线转驼峰
     * @param $str
     * @return null|string|string[]
     */
    public static function lineToHump($str)
    {
        $str = preg_replace_callback('/([-_]+([a-z]{1}))/i', function ($matches) {
            return strtoupper($matches[2]);
        }, $str);
        return $str;
    }

    /**
     * 驼峰转下划线
     * @param $str
     * @return null|string|string[]
     */
    public static function humpToLine($str)
    {
        $str = preg_replace_callback('/([A-Z]{1})/', function ($matches) {
            return '_' . strtolower($matches[0]);
        }, $str);
        return $str;
    }

    /**
     * 获取真实IP
     * @return mixed
     */
    public static function getRealIp()
    {
        $ip = $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && preg_match_all('#\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}#s', $_SERVER['HTTP_X_FORWARDED_FOR'], $matches)) {
            foreach ($matches[0] AS $xip) {
                if (!preg_match('#^(10|172\.16|192\.168)\.#', $xip)) {
                    $ip = $xip;
                    break;
                }
            }
        } elseif (isset($_SERVER['HTTP_CLIENT_IP']) && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/', $_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (isset($_SERVER['HTTP_CF_CONNECTING_IP']) && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/', $_SERVER['HTTP_CF_CONNECTING_IP'])) {
            $ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
        } elseif (isset($_SERVER['HTTP_X_REAL_IP']) && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/', $_SERVER['HTTP_X_REAL_IP'])) {
            $ip = $_SERVER['HTTP_X_REAL_IP'];
        }
        return $ip;
    }

    /**
     * 读取文件夹下的所有文件
     * @param $path
     * @param $basePath
     * @return array|mixed
     */
    public static function readDirAllFiles($path, $basePath = '')
    {
        list($list, $temp_list) = [[], scandir($path)];
        empty($basePath) && $basePath = $path;
        foreach ($temp_list as $file) {
            if ($file != ".." && $file != ".") {
                if (is_dir($path . DIRECTORY_SEPARATOR . $file)) {
                    $childFiles = self::readDirAllFiles($path . DIRECTORY_SEPARATOR . $file, $basePath);
                    $list = array_merge($childFiles, $list);
                } else {
                    $filePath = $path . DIRECTORY_SEPARATOR . $file;
                    $fileName = str_replace($basePath . DIRECTORY_SEPARATOR, '', $filePath);
                    $list[$fileName] = $filePath;
                }
            }
        }
        return $list;
    }

    /**
     * 模板值替换
     * @param $string
     * @param $array
     * @return mixed
     */
    public static function replaceTemplate($string, $array)
    {
        foreach ($array as $key => $val) {
            $string = str_replace("{{" . $key . "}}", $val, $string);
        }
        return $string;
    }

    /**
     * 发送请求
     * @param string $url
     * @param string $data
     * @param string $cert
     * @param int $timeout
     * @return bool|string
     * @throws \Exception
     */
    public static function curlRequest(string $url, $data = '', string $cert = '', $timeout = 10)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        //https请求 不验证证书和hosts
        if (preg_match('/^https:\/\//', $url)) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        }
        //如果传参数$data不为空, 发送的POST请求
        if (!empty($data)) {
            //true时会发送 POST 请求 application/x-www-form-urlencoded
            curl_setopt($ch, CURLOPT_POST, true);
            // 设置post域(post数据) 数组['para1' => val1, 'para2' => 'val2']或者字符串 para1=val1&para2=val2
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }
        //true将curl_exec()获取的信息以字符串返回，而不是直接输出
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //API证书
        if ($cert) {
            $certArr = explode('|', $cert);
            curl_setopt($ch, CURLOPT_SSLCERTTYPE, 'PEM');
            curl_setopt($ch, CURLOPT_SSLCERT, $certArr[0]);
            curl_setopt($ch, CURLOPT_SSLKEYTYPE, 'PEM');
            curl_setopt($ch, CURLOPT_SSLKEY, $certArr[1]);
        }
        $result = curl_exec($ch);
        $error = curl_error($ch);
        curl_close($ch);
        if (!empty($error)) {
            throw new \Exception($error);
        } else {
            return $result;
        }
    }

    /**
     * 函数是否被禁用
     * @param $method
     * @return bool
     */
    public static function functionDisabled($method)
    {
        return in_array($method, explode(',', ini_get('disable_functions')));
    }

    /**
     * 扩展是否安装
     * @param $extension
     * @return bool
     */
    public static function extensionLoaded($extension)
    {
        return in_array($extension, get_loaded_extensions());
    }

    /**
     * 是否是Linux操作系统
     * @return bool
     */
    public static function isLinux()
    {
        return strpos(PHP_OS, "Linux") !== false ? true : false;
    }

    /**
     * 版本比较
     * @param $version
     * @param string $operator
     * @return bool
     */
    public static function versionCompare($version, $operator = ">=")
    {
        return version_compare(phpversion(), $version, $operator);
    }
}
