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


use LogTrace\IdCreate;
use LogTrace\SnowFlake;
use PHPUnit\Framework\TestCase;

class IdCreateTest extends TestCase
{

    public function testCreate()
    {
        $id = IdCreate::createOnlyId();

        $this->assertIsInt($id);
    }

    public function testCreateBatch()
    {
        $array = [];
        $i = 0;
        while ($i < 1000) {
            $array[] = IdCreate::createOnlyId();
            $i++;
        }
        $this->assertNotEmpty($array);
        $this->assertEquals(count($array), 1000);
        $uniqueArray = array_unique($array);
        $this->assertEquals(count($uniqueArray), 1000);
    }


}