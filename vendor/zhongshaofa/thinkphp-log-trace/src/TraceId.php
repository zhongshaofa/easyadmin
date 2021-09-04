<?php

// +----------------------------------------------------------------------
// | EasyAdmin
// +----------------------------------------------------------------------
// | PHP交流群: 763822524
// +----------------------------------------------------------------------
// | 开源协议  https://mit-license.org 
// +----------------------------------------------------------------------
// | github开源项目：https://github.com/zhongshaofa/EasyAdmin
// +----------------------------------------------------------------------

namespace LogTrace;

class TraceId
{

    /**
     * 链路ID
     * @var string|null
     */
    protected static $traceId = null;

    /**
     * reset traceId value
     */
    public static function reset()
    {
        self::$traceId = null;
    }

    /**
     *  set traceId value
     * @param string $traceId
     */
    public static function setTraceId($traceId): void
    {
        self::$traceId = $traceId;
    }

    /**
     * get traceId value
     * @return string
     */
    public static function getTraceId()
    {
        if (self::$traceId == null) {
            $id = IdCreate::createOnlyId();
            self::$traceId = md5($id);
        }
        return self::$traceId;
    }

}