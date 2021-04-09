<?php


namespace utils\service;


use Workerman\Connection\TcpConnection;
use Workerman\Crontab\Crontab;
use Workerman\MySQL\Connection;
use Workerman\Protocols\Http\Request;
use Workerman\Worker;

/**
 * 注意：定时器开始、暂停、重起 都是在下一分钟开始执行
 * Class SystemCrontab
 * @package worker\service
 */
class CrontabService
{
    const OPERATION_CREATE = 'create';
    const OPERATION_DELETE = 'delete';
    const OPERATION_RELOAD = 'reload';

    private $worker;

    /**
     * 进程名
     * @var string
     */
    private $workerName = "Workerman System Crontab";

    /**
     * 数据库配置
     * @var array
     */
    private $dbConfig = [
        'hostname' => '127.0.0.1',
        'hostport' => '3306',
        'username' => 'root',
        'password' => 'root',
        'database' => 'test',
        'charset' => 'utf8mb4'
    ];

    /**
     * 数据库进程池
     * @var Connection[] array
     */
    private $dbPool = [];

    /**
     * 任务进程池
     * @var Crontab[] array
     */
    private $crontabPool = [];

    /**
     * 调试模式
     * @var bool
     */
    private $debug = false;

    /**
     * 监听任何端口
     * @var string
     */
    private static $socketName = 'http://127.0.0.1:2345';

    /**
     * 错误信息
     * @var
     */
    private $errorMsg = [];

    /**
     * 定时任务表
     * @var string
     */
    private $systemCrontabTable = 'system_crontab';

    /**
     * 定时任务日志表
     * @var string
     */
    private $systemCrontabFlowTable = 'system_crontab_flow';

    /**
     * 最低PHP版本
     * @var string
     */
    private $lessPhpVersion = '5.3.3';

    /**
     * @param string $socketName 不填写表示不监听任何端口,格式为 <协议>://<监听地址> 协议支持 tcp、udp、unix、http、websocket、text
     * @param array $contextOption socket 上下文选项 http://php.net/manual/zh/context.socket.php
     */
    public function __construct($socketName = '', array $contextOption = [])
    {
        $this->checkEnv();
        $this->initWorker($socketName, $contextOption);
    }

    /**
     * 初始化 worker
     * @param string $socketName
     * @param array $contextOption
     */
    private function initWorker($socketName = '', $contextOption = [])
    {
        $socketName && self::$socketName = $socketName;
        $this->worker = new Worker(self::$socketName, $contextOption);
        $this->worker->name = $this->workerName;
        if (isset($contextOption['ssl'])) {
            $this->worker->transport = 'ssl';//设置当前Worker实例所使用的传输层协议，目前只支持3种(tcp、udp、ssl)。默认为tcp。
        }
        $this->registerCallback();
    }

    /**
     * 是否调试模式
     * @param bool $bool
     * @return $this
     */
    public function setDebug($bool = false)
    {
        $this->debug = $bool;

        return $this;
    }

    /**
     * 设置当前Worker实例的名称,方便运行status命令时识别进程
     * 默认为none
     * @param string $name
     * @return $this
     */
    public function setName($name = "Workerman System Crontab")
    {
        $this->worker->name = $name;

        return $this;
    }

    /**
     * 设置当前Worker实例启动多少个进程
     * Worker主进程会 fork出 count个子进程同时监听相同的端口，并行的接收客户端连接，处理连接上的事件
     * 默认为1
     * windows系统不支持此特性
     * @param int $count
     * @return $this
     */
    public function setCount($count = 1)
    {
        $this->worker->count = $count;

        return $this;
    }

    /**
     * 设置当前Worker实例以哪个用户运行
     * 此属性只有当前用户为root时才能生效，建议$user设置权限较低的用户
     * 默认以当前用户运行
     * windows系统不支持此特性
     * @param string $user
     * @return $this
     */
    public function setUser($user = "root")
    {
        $this->worker->user = $user;

        return $this;
    }

    /**
     * 设置当前Worker实例的协议类
     * 协议处理类可以直接在实例化Worker时在监听参数直接指定
     * @param string $protocol
     * @return $this
     */
    public function setProtocol($protocol)
    {
        $this->worker->protocol = $protocol;

        return $this;
    }

    /**
     * 以daemon(守护进程)方式运行
     * windows系统不支持此特性
     * @param bool $bool
     * @return $this
     */
    public function setDaemon($bool = false)
    {
        Worker::$daemonize = $bool;

        return $this;
    }

    /**
     * 设置所有连接的默认应用层发送缓冲区大小。默认1M。可以动态设置
     * @param float|int $size
     * @return $this
     */
    public function setMaxSendBufferSize($size = 1024 * 1024)
    {
        TcpConnection::$defaultMaxSendBufferSize = $size;

        return $this;
    }

    /**
     * 设置每个连接接收的数据包。默认10M。超包视为非法数据，连接会断开
     * @param float|int $size
     * @return $this
     */
    public function setMaxPackageSize($size = 10 * 1024 * 1024)
    {
        TcpConnection::$defaultMaxPackageSize = $size;

        return $this;
    }

    /**
     * 指定日志文件
     * 默认为位于workerman下的 workerman.log
     * 日志文件中仅仅记录workerman自身相关启动停止等日志，不包含任何业务日志
     * @param string $path
     * @return $this
     */
    public function setLogFile($path = "./workerman.log")
    {
        Worker::$logFile = $path;

        return $this;
    }

    /**
     * 指定打印输出文件
     * 以守护进程方式(-d启动)运行时，所有向终端的输出(echo var_dump等)都会被重定向到 stdoutFile指定的文件中
     * 默认为/dev/null,也就是在守护模式时默认丢弃所有输出
     * windows系统不支持此特性
     * @param string $path
     * @return $this
     */
    public function setStdoutFile($path = "./workerman_debug.log")
    {
        Worker::$stdoutFile = $path;

        return $this;
    }

    /**
     * 设置数据库链接信息
     * @param array $config
     * @return $this
     */
    public function setDbConfig(array $config = [])
    {
        $this->dbConfig = array_merge($this->dbConfig, $config);

        return $this;
    }

    /**
     * 注册子进程回调函数
     */
    private function registerCallback()
    {
        $this->worker->onWorkerStart = [$this, 'onWorkerStart'];
        $this->worker->onWorkerReload = [$this, 'onWorkerReload'];
        $this->worker->onWorkerStop = [$this, 'onWorkerStop'];
        $this->worker->onConnect = [$this, 'onConnect'];
        $this->worker->onMessage = [$this, 'onMessage'];
        $this->worker->onClose = [$this, 'onClose'];
        $this->worker->onBufferFull = [$this, 'onBufferFull'];
        $this->worker->onBufferDrain = [$this, 'onBufferDrain'];
        $this->worker->onError = [$this, 'onError'];
    }

    /**
     * 设置Worker子进程启动时的回调函数，每个子进程启动时都会执行
     * @param Worker $worker
     */
    public function onWorkerStart($worker)
    {
        $this->dbPool[$worker->id] = new Connection(
            $this->dbConfig['hostname'],
            $this->dbConfig['hostport'],
            $this->dbConfig['username'],
            $this->dbConfig['password'],
            $this->dbConfig['database'],
            $this->dbConfig['charset']
        );
        $this->checkCrontabTables();
        $this->crontabInit();
    }

    /**
     * @param Worker $worker
     */
    public function onWorkerStop($worker)
    {

    }

    /**
     * 设置Worker收到reload信号后执行的回调
     * 如果在收到reload信号后只想让子进程执行onWorkerReload，不想退出，可以在初始化Worker实例时设置对应的Worker实例的reloadable属性为false
     * @param Worker $worker
     */
    public function onWorkerReload($worker)
    {

    }

    /**
     * 当客户端与Workerman建立连接时(TCP三次握手完成后)触发的回调函数
     * 每个连接只会触发一次onConnect回调
     * 此时客户端还没有发来任何数据
     * 由于udp是无连接的，所以当使用udp时不会触发onConnect回调，也不会触发onClose回调
     * @param TcpConnection $connection
     */
    public function onConnect($connection)
    {

    }

    /**
     * 当客户端连接与Workerman断开时触发的回调函数
     * 不管连接是如何断开的，只要断开就会触发onClose
     * 每个连接只会触发一次onClose
     * 由于udp是无连接的，所以当使用udp时不会触发onConnect回调，也不会触发onClose回调
     * @param TcpConnection $connection
     */
    public function onClose($connection)
    {

    }

    /**
     * 当客户端通过连接发来数据时(Workerman收到数据时)触发的回调函数
     * @param TcpConnection $connection
     * @param $data
     */
    public function onMessage($connection, $data)
    {
        if ($data instanceof Request) {
            $get = $data->get();
            if (isset($get['type']) && isset($get['id'])) {
                $ids = explode(',', $get['id']);
                switch ($get['type']) {
                    case self::OPERATION_CREATE:
                        $this->crontabCreate($ids);
                        $connection->send('添加定时器任务' . $get['id'] . PHP_EOL);
                        break;
                    case self::OPERATION_DELETE:
                        $this->crontabDelete($ids);
                        $connection->send('删除定时器任务' . $get['id'] . PHP_EOL);
                        break;
                    case self::OPERATION_RELOAD:
                        $this->crontabReload($ids);
                        $connection->send('重启定时器任务' . $get['id'] . PHP_EOL);
                        break;
                    default:
                        $connection->send('type参数非法');
                }
            } else {
                $connection->send('参数非法');
            }
        }
    }

    /**
     * 缓冲区满则会触发onBufferFull回调
     * 每个连接都有一个单独的应用层发送缓冲区，如果客户端接收速度小于服务端发送速度，数据会在应用层缓冲区暂存
     * 只要发送缓冲区还没满，哪怕只有一个字节的空间，调用Connection::send($A)肯定会把$A放入发送缓冲区,
     * 但是如果已经没有空间了，还继续Connection::send($B)数据，则这次send的$B数据不会放入发送缓冲区，而是被丢弃掉，并触发onError回调
     * @param TcpConnection $connection
     */
    public function onBufferFull($connection)
    {

    }

    /**
     * 在应用层发送缓冲区数据全部发送完毕后触发
     * @param TcpConnection $connection
     */
    public function onBufferDrain($connection)
    {

    }

    /**
     * 客户端的连接上发生错误时触发
     * @param TcpConnection $connection
     * @param $code
     * @param $msg
     */
    public function onError($connection, $code, $msg)
    {

    }

    /**
     * 初始化定时任务
     * @return bool
     */
    private function crontabInit()
    {
        $jobs = $this->getCrontabs();
        foreach ($jobs as $job) {
            $this->crontabRun($job);
        }

        return true;
    }

    /**
     * 创建定时任务
     * @param array $ids
     * @return bool
     */
    private function crontabCreate(array $ids)
    {
        foreach ($ids as $k => $id) {
            if (isset($this->crontabPool[$id])) {
                unset($ids[$k]);
            }
        }

        if (empty($ids)) {
            return false;
        }

        $data = $this->dbPool[$this->worker->id]
            ->select('*')
            ->from($this->systemCrontabTable)
            ->where('id in (:ids)')
            ->bindValues(['ids' => join(',', $ids)])
            ->query();

        foreach ($data as $row) {
            $this->crontabRun($row);
        }

        return true;
    }

    /**
     * 清除定时任务
     * @param array $ids
     * @return bool
     */
    private function crontabDelete(array $ids)
    {
        if (empty($ids)) {
            return false;
        }

        foreach ($ids as $id) {
            if (isset($this->crontabPool[$id])) {
                $this->crontabPool[$id]->destroy();
                unset($this->crontabPool[$id]);
            }
        }

        return true;
    }

    /**
     * 重启定时任务
     * @param array $ids
     * @return bool
     */
    private function crontabReload(array $ids)
    {
        if (empty($ids)) {
            return false;
        }

        $this->crontabDelete($ids);
        $this->crontabCreate($ids);

        return true;
    }

    /**
     * 执行定时器
     * 0   1   2   3   4   5
     * |   |   |   |   |   |
     * |   |   |   |   |   +------ day of week (0 - 6) (Sunday=0)
     * |   |   |   |   +------ month (1 - 12)
     * |   |   |   +-------- day of month (1 - 31)
     * |   |   +---------- hour (0 - 23)
     * |   +------------ min (0 - 59)
     * +-------------- sec (0-59)[可省略，如果没有0位,则最小时间粒度是分钟]
     * @param array $data
     */
    private function crontabRun(array $data)
    {
        $this->crontabPool[$data['id']] = new Crontab($data['frequency'], function () use ($data) {
            $time = time();
            $shell = trim($data['shell']);
            exec($shell, $output);
            $this->crontabLog(['remark' => $data['frequency'] . ' ' . $shell . '<br/>' . var_export($output, true), 'sid' => $data['id'], 'create_time' => $time]);
            if ($this->debug) {
                $this->writeln('执行定时器任务-' . $data['id'] . ' ' . $data['frequency'] . ' ' . $shell);
            }
        });
    }

    /**
     * 记录执行日志
     * @param array $data
     * @return mixed
     */
    private function crontabLog(array $data)
    {
        return $this->dbPool[$this->worker->id]
            ->insert($this->systemCrontabFlowTable)
            ->cols($data)
            ->query();
    }

    /**
     * 获取所有的定时器任务
     * @return mixed
     */
    private function getCrontabs()
    {
        return $this->dbPool[$this->worker->id]
            ->select('*')
            ->from($this->systemCrontabTable)
            ->where("status=1")
            ->orderByDESC(['sort'])
            ->query();
    }

    /**
     * 获取socketName
     * @return string
     */
    public static function getSocketName()
    {
        return self::$socketName;
    }

    /**
     * 函数是否被禁用
     * @param $method
     * @return bool
     */
    public function functionDisabled($method)
    {
        return in_array($method, explode(',', ini_get('disable_functions')));
    }

    /**
     * 扩展是否加载
     * @param $extension
     * @return bool
     */
    public function extensionLoaded($extension)
    {
        return in_array($extension, get_loaded_extensions());
    }

    /**
     * 是否是Linux操作系统
     * @return bool
     */
    public function isLinux()
    {
        return strpos(PHP_OS, "Linux") !== false ? true : false;
    }

    /**
     * 版本比较
     * @param $version
     * @param string $operator
     * @return bool
     */
    public function versionCompare($version, $operator = ">=")
    {
        return version_compare(phpversion(), $version, $operator);
    }

    /**
     * 检测运行环境
     */
    public function checkEnv()
    {
        $errorMsg = [];
        $this->functionDisabled('exec') && $errorMsg[] = 'exec函数被禁用';
        if ($this->isLinux()) {
            $this->versionCompare($this->lessPhpVersion, '<') && $errorMsg[] = 'PHP版本必须≥' . $this->lessPhpVersion;
            $checkExt = ["pcntl", "posix"];
            foreach ($checkExt as $ext) {
                !$this->extensionLoaded($ext) && $errorMsg[] = $ext . '扩展没有安装';
            }
            $checkFunc = [
                "stream_socket_server",
                "stream_socket_client",
                "pcntl_signal_dispatch",
                "pcntl_signal",
                "pcntl_alarm",
                "pcntl_fork",
                "posix_getuid",
                "posix_getpwuid",
                "posix_kill",
                "posix_setsid",
                "posix_getpid",
                "posix_getpwnam",
                "posix_getgrnam",
                "posix_getgid",
                "posix_setgid",
                "posix_initgroups",
                "posix_setuid",
                "posix_isatty",
            ];
            foreach ($checkFunc as $func) {
                $this->functionDisabled($func) && $errorMsg[] = $func . '函数被禁用';
            }
        }

        if (!empty($errorMsg)) {
            $this->errorMsg = array_merge($this->errorMsg, $errorMsg);
        }
    }

    /**
     * 输出日志
     * @param $msg
     * @param bool $ok
     */
    public function writeln($msg, $ok = true)
    {
        echo '[' . date('Y-m-d H:i:s') . '] ' . $msg . ($ok ? " \033[32;40m [Ok] \033[0m" : " \033[31;40m [Fail] \033[0m") . PHP_EOL;
    }

    /**
     * 检测表是否存在
     */
    private function checkCrontabTables()
    {
        $allTables = $this->getDbTables($this->dbConfig['database']);
        !isset($allTables[$this->systemCrontabTable]) && $this->createSystemCrontabTable();
        !isset($allTables[$this->systemCrontabFlowTable]) && $this->createSystemCrontabFlowTable();
    }

    /**
     * 创建定时器任务表
     */
    private function createSystemCrontabTable()
    {
        $sql = <<<SQL
 CREATE TABLE IF NOT EXISTS `{$this->systemCrontabTable}`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '任务标题',
  `type` tinyint(4) NOT NULL DEFAULT 0 COMMENT '任务类型[0请求url,1执行sql,2执行shell]',
  `frequency` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '任务频率',
  `shell` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '任务脚本',
  `remark` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '任务备注',
  `sort` int(11) NOT NULL DEFAULT 0 COMMENT '排序，越大越前',
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '任务状态状态[0:禁用;1启用]',
  `create_time` int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
  `update_time` int(11) NOT NULL DEFAULT 0 COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `title`(`title`) USING BTREE,
  INDEX `type`(`type`) USING BTREE,
  INDEX `create_time`(`create_time`) USING BTREE,
  INDEX `status`(`status`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '定时器任务表' ROW_FORMAT = DYNAMIC
SQL;

        return $this->dbPool[$this->worker->id]->query($sql);
    }

    /**
     * 定时器任务流水表
     */
    private function createSystemCrontabFlowTable()
    {
        $sql = <<<SQL
CREATE TABLE IF NOT EXISTS `{$this->systemCrontabFlowTable}`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `sid` int(60) NOT NULL COMMENT '任务id',
  `remark` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '备注',
  `create_time` int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
  `update_time` int(11) NULL DEFAULT 0 COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `create_time`(`create_time`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '定时器任务流水表' ROW_FORMAT = DYNAMIC
SQL;

        return $this->dbPool[$this->worker->id]->query($sql);
    }

    /**
     * 获取数据库表名
     * @param $dbname
     * @return array
     */
    private function getDbTables($dbname)
    {
        return $this->dbPool[$this->worker->id]
            ->select('TABLE_NAME')
            ->from('information_schema.TABLES')
            ->where("TABLE_TYPE='BASE TABLE'")
            ->where("TABLE_SCHEMA='" . $dbname . "'")
            ->column();
    }

    /**
     * 运行所有Worker实例
     * Worker::runAll()执行后将永久阻塞
     * windows版本的workerman不支持在同一个文件中实例化多个Worker
     * windows版本的workerman需要将多个Worker实例初始化放在不同的文件中
     */
    public function run()
    {
        if (empty($this->errorMsg)) {
            Worker::runAll();
        } else {
            foreach ($this->errorMsg as $v) {
                $this->writeln($v, false);
            }
        }
    }
}
