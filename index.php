<?php

require_once __DIR__ . '/vendor/autoload.php';

use Workerman\Worker;
use Workerman\Lib\Timer;
Use Services\Config;
Use Services\Base;
Use Services\Connection;
Use Services\Service;

$user_object = [
    1=>'Services\Teacher',
    2=>'Services\Teacher',
    3=>'Services\Student',
    4=>'Services\Teacher',
    5=>'Services\Student'
];

$ws_worker = new Worker("websocket://127.0.0.1:" . Config::$wsPort);
$ws_worker->count = Config::$wsCount;
$ws_worker->room = array();

$ws_worker->onConnect = function ($connection) {
    $connection->lastMessageTime = time();

    // 30秒内未发送token断开连接
    $connection->auth_timer_id = Timer::add(15, function()use($connection){
        $connection->close(Base::success('no_token', '未接受到登录信息'));
    }, null, false);
};

$ws_worker->onWorkerStart = function ($ws_worker) {
    // 初始化Database操作
    global $db;
    $db = new \Workerman\MySQL\Connection(Config::$dbHost, Config::$dbPort, Config::$dbUser, Config::$dbPassword, Config::$dbName);

    // 定时器心跳检测发送心跳
    Timer::add(Config::$heartTime, function()use($ws_worker){
        $time_now = time();
        foreach($ws_worker->connections as $connection) {
            $connection->send(Base::success('heart'));
            if ($time_now - $connection->lastMessageTime > Config::$heartOutTime) {
                $connection->close(Base::success('no_heart', '未检测到心跳'));
            }
        }
    });
};

$ws_worker->onMessage = function ($connection, $data) {
    global $ws_worker;
    global $db;
    global $user_object;

    // 更新心跳时间
    $connection->lastMessageTime = time();

    // 解析json
    $data = json_decode($data, true);

    if ($data['code'] == 'token') {
        Timer::del($connection->auth_timer_id);
        Connection::openConnect($connection, $ws_worker, $data, $db);
        Connection::ready($connection, $ws_worker, $db);
    } elseif ($data['code'] == 'heart') {} elseif ($data['code'] == 'quality') {
        Service::netQuality($connection, $ws_worker, $data);
    } else {
        // var_dump($connection->type);
        // var_dump($data);
        if (!method_exists($user_object[$connection->type], $data['code'])) {
            $connection->send(Base::success('code_error', '未找到相应操作'));
        } else {
            $user_object[$connection->type]::{$data['code']}($connection, $ws_worker, $data);
        }
    }
};

$ws_worker->onClose = function ($connection) {
    global $ws_worker;
    global $db;
    Connection::closeConnect($connection, $ws_worker, $db);
};

Worker::runAll();