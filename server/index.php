#!/usr/bin/env php
<?php
include_once('vendor/autoload.php');

if (empty($argv[1]) || !in_array($argv[1], array('start', 'stop', 'restart'))) {
    die("не указан параметр (start|stop|restart)\r\n");
}

$config = array(
    'class' => 'OnlineNotepadServer',
    'pid' => '/tmp/websocket_chat.pid',
    'websocket' => 'tcp://127.0.0.1:8000',
    //'localsocket' => 'tcp://127.0.0.1:8010',
    //'master' => 'tcp://127.0.0.1:8020',
    //'eventDriver' => 'event'
);

spl_autoload_register(function ($class) { include $class . '.php'; });

$WebsocketServer = new WebsocketServer($config);
call_user_func(array($WebsocketServer, $argv[1]));