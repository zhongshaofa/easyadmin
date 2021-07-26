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

namespace EasyAdmin\auth;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Doctrine\Common\Annotations\FileCacheReader;
use EasyAdmin\annotation\ControllerAnnotation;
use EasyAdmin\annotation\NodeAnotation;
use EasyAdmin\tool\CommonTool;

/**
 * 节点处理类
 * Class Node
 * @package EasyAdmin\auth
 */
class Node
{

    /**
     * @var 当前文件夹
     */
    protected $dir;

    /**
     * @var 命名空间前缀
     */
    protected $namespacePrefix;

    /**
     * 注解缓存地址
     * @var string
     */
    protected $annotationCacheDir;

    /**
     * 注解debug，建议常开
     * @var bool
     */
    protected $annotationDebug = true;

    /**
     * 构造方法
     * Node constructor.
     */
    public function __construct()
    {
        $this->dir                = base_path() . 'admin' . DIRECTORY_SEPARATOR . 'controller';
        $this->annotationCacheDir = runtime_path() . 'annotation' . DIRECTORY_SEPARATOR . 'node';
        $this->namespacePrefix    = "app\admin\controller";
        return $this;
    }

    /**
     * 设置当前文件夹
     * @param $dir
     * @return $this
     */
    public function setDir($dir)
    {
        $this->dir = $dir;
        return $this;
    }


    /**
     * 设置命名空间前缀
     * @param $namespacePrefix
     * @return $this
     */
    public function setNamespacePrefix($namespacePrefix)
    {
        $this->namespacePrefix = $namespacePrefix;
        return $this;
    }

    /**
     * 设置注解缓存地址
     * @param $annotationCacheDir
     * @return $this
     */
    public function setAnnotationCacheDir($annotationCacheDir)
    {
        $this->annotationCacheDir = $annotationCacheDir;
        return $this;
    }

    /**
     * 设置注解debug
     * @param $annotationDebug
     * @return $this
     */
    public function setAnnotationDebug($annotationDebug = true)
    {
        $this->annotationDebug = $annotationDebug;
        return $this;
    }

    /**
     * 获取所有节点
     * @return array
     * @throws \Doctrine\Common\Annotations\AnnotationException
     * @throws \ReflectionException
     */
    public function getNodelist()
    {
        list($nodeList, $controllerList) = [[], $this->getControllerList()];

        if (!empty($controllerList)) {
            AnnotationRegistry::registerLoader('class_exists');
            $reader = new FileCacheReader(new AnnotationReader(), $this->annotationCacheDir, $this->annotationDebug);
            foreach ($controllerList as $controllerFormat => $controller) {

                // 获取类和方法的注释信息
                $reflectionClass = new \ReflectionClass($controller);
                $methods         = $reflectionClass->getMethods();
                $actionList      = [];

                // 遍历读取所有方法的注释的参数信息
                foreach ($methods as $method) {
                    // 读取NodeAnotation的注解
                    $nodeAnnotation = $reader->getMethodAnnotation($method, NodeAnotation::class);
                    if (!empty($nodeAnnotation) && !empty($nodeAnnotation->title)) {
                        $actionTitle  = !empty($nodeAnnotation) && !empty($nodeAnnotation->title) ? $nodeAnnotation->title : null;
                        $actionAuth   = !empty($nodeAnnotation) && !empty($nodeAnnotation->auth) ? $nodeAnnotation->auth : false;
                        $actionList[] = [
                            'node'    => $controllerFormat . '/' . $method->name,
                            'title'   => $actionTitle,
                            'is_auth' => $actionAuth,
                            'type'    => 2,
                        ];
                    }
                }

                // 方法非空才读取控制器注解
                if (!empty($actionList)) {
                    // 读取Controller的注解
                    $controllerAnnotation = $reader->getClassAnnotation($reflectionClass, ControllerAnnotation::class);
                    $controllerTitle      = !empty($controllerAnnotation) && !empty($controllerAnnotation->title) ? $controllerAnnotation->title : null;
                    $controllerAuth       = !empty($controllerAnnotation) && !empty($controllerAnnotation->auth) ? $controllerAnnotation->auth : false;
                    $nodeList[]           = [
                        'node'    => $controllerFormat,
                        'title'   => $controllerTitle,
                        'is_auth' => $controllerAuth,
                        'type'    => 1,
                    ];
                    $nodeList             = array_merge($nodeList, $actionList);
                }

            }
        }
        return $nodeList;
    }

    /**
     * 获取所有控制器
     * @return array
     */
    public function getControllerList()
    {
        return $this->readControllerFiles($this->dir);
    }

    /**
     * 遍历读取控制器文件
     * @param $path
     * @return array
     */
    protected function readControllerFiles($path)
    {
        list($list, $temp_list, $dirExplode) = [[], scandir($path), explode($this->dir, $path)];
        $middleDir = isset($dirExplode[1]) && !empty($dirExplode[1]) ? str_replace('/', '\\', substr($dirExplode[1], 1)) . "\\" : null;

        foreach ($temp_list as $file) {
            // 排除根目录和没有开启注解的模块
            if ($file == ".." || $file == ".") {
                continue;
            }
            if (is_dir($path . DIRECTORY_SEPARATOR . $file)) {
                // 子文件夹，进行递归
                $childFiles = $this->readControllerFiles($path . DIRECTORY_SEPARATOR . $file);
                $list = array_merge($childFiles, $list);
            } else {
                // 判断是不是控制器
                $fileExplodeArray = explode('.', $file);
                if (count($fileExplodeArray) != 2 || end($fileExplodeArray) != 'php') {
                    continue;
                }
                // 根目录下的文件
                $className = str_replace('.php', '', $file);
                $controllerFormat = str_replace('\\', '.', $middleDir) . CommonTool::humpToLine(lcfirst($className));
                $list[$controllerFormat] = "{$this->namespacePrefix}\\{$middleDir}" . $className;
            }
        }
        return $list;
    }

}