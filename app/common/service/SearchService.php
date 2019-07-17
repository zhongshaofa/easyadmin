<?php


namespace app\common\service;


/**
 * 生成查询语句
 * Class SearchService
 * @package app\common\service
 */
class SearchService
{

    /**
     * 生成的where语句
     * @var null
     */
    protected $where = null;

    /**
     * 请求的参数
     * @var null
     */
    protected $request = null;

    /**
     * 指定字段
     * @var null
     */
    protected $appointField = null;

    /**
     * 构造函数
     * SearchService constructor.
     * @param $request
     */
    public function __construct($request)
    {
        $this->request = $request;
        return $this;
    }

    /**
     * 模糊查询
     * @param $fields
     * @param string $type
     * @return $this
     */
    public function like($fields, $type = 'all', $appointField = null)
    {
        !empty($appointField) && $this->appointField = $appointField;
        !is_array($fields) && $fields = [$fields];
        foreach ($fields as $field) {
            $value = $this->value($field);
            if (!empty($value)) {
                if (strtolower($type) == 'all') {
                    $this->where[] = [$field, 'like', "%{$value}%"];
                } elseif (strtolower($type) == 'left') {
                    $this->where[] = [$field, 'like', "%{$value}"];
                } elseif (strtolower($type) == 'right') {
                    $this->where[] = [$field, 'like', "{$value}%"];
                }
            }
        }
        return $this;
    }

    /**
     * 构造条件 = > <
     * @param $fields
     * @param string $type
     * @param null $appointField
     * @return $this
     */
    public function where($fields, $type = '=', $appointField = null)
    {
        !empty($appointField) && $this->appointField = $appointField;
        !is_array($fields) && $fields = [$fields];
        foreach ($fields as $field) {
            $value = $this->value($field);
            if (!empty($value)) {
                $this->where[] = [$field, $type, $value];
            }
        }
        return $this;
    }

    /**
     * 范围查询
     * @param $fields
     * @param null $appointField
     */
    public function in($fields, $appointField = null)
    {
        !empty($appointField) && $this->appointField = $appointField;
        !is_array($fields) && $fields = [$fields];
        foreach ($fields as $field) {
            $value = $this->value($field);
            if (!empty($value)) {
                $this->where[] = [$field, 'in', $value];
            }
        }
    }

    public function time($fields, $appointField = null)
    {
        !empty($appointField) && $this->appointField = $appointField;
    }

    /**
     * 获取查询的值
     * @param $field
     * @return mixed|null
     */
    protected function value($field)
    {
        $value = null;
        if (!empty($this->appointField)) {
            $value = $this->request[$this->appointField];
        }
        if (empty($value) && isset($this->request[$field])) {
            $value = $this->request[$field];
        }
        return $value;
    }

    /**
     * 获取where语句
     * @return null
     */
    public function build()
    {
        return $this->where;
    }
}