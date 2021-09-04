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

namespace Test;

use LogTrace\TraceId;
use PHPUnit\Framework\TestCase;

/**
 * ./vendor/bin/phpunit tests/TraceIdTest.php
 * Class TraceIdTest
 * @package Test
 */
class TraceIdTest extends TestCase
{

    public function testTraceIdEquals()
    {
        $traceId1 = TraceId::getTraceId();
        $traceId2 = TraceId::getTraceId();
        $this->assertEquals($traceId1, $traceId2);
    }

    public function testTraceIdReset()
    {
        $traceId1 = TraceId::getTraceId();
        TraceId::reset();
        $traceId2 = TraceId::getTraceId();
        $this->assertNotEquals($traceId1, $traceId2);
    }

    public function testTraceIdSet()
    {
        $definitionID = md5(time());
        TraceId::setTraceId($definitionID);
        $traceId = TraceId::getTraceId();
        $this->assertEquals($traceId, $definitionID);
    }

}