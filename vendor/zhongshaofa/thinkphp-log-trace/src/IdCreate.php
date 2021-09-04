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

/**
 * 唯一ID
 * Class IdCreate
 * @package LogTrace
 */
class IdCreate
{

    private static $workerId = 1; // 工作机器ID
    private static $datacenterId = 1; // 数据中心ID
    private static $sequence = 0; // 毫秒内序列

    /**
     * @var null | SnowFlake
     */
    private static $snowFlake = null;

    /**
     * @param int $workerId
     */
    public static function setWorkerId(int $workerId): void
    {
        self::$workerId = $workerId;
    }

    /**
     * @param int $datacenterId
     */
    public static function setDatacenterId(int $datacenterId): void
    {
        self::$datacenterId = $datacenterId;
    }

    /**
     * @param int $sequence
     */
    public static function setSequence(int $sequence): void
    {
        self::$sequence = $sequence;
    }

    /**
     * 创建唯一ID
     * @return int
     * @throws \Exception
     */
    public static function createOnlyId()
    {
        if (self::$snowFlake == null) {
            self::$snowFlake = new  SnowFlake(self::$workerId, self::$datacenterId, self::$sequence);
        }
        return self::$snowFlake->nextId();
    }

}