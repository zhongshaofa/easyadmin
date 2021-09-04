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

use EasyAdmin\auth\Node;
use PHPUnit\Framework\TestCase;

/**
 * 测试注解读取
 * ./vendor/bin/phpunit tests/AnnotationTest.php
 * Class AnnotationTest
 * @package Test
 */
class AnnotationTest extends TestCase
{

    public function testNode()
    {
        $basePath = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'mock_app';
        $baseNamespace = 'MockApp';
        $list = (new Node($basePath, $baseNamespace))->getNodelist();

        $this->assertNotEmpty($list);
        $this->assertIsArray($list);
        $this->assertEquals(count($list), 13);
    }

}