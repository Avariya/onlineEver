<?php

/**
 * Created by PhpStorm.
 * User: avariya
 * Date: 8/10/15
 * Time: 7:35 PM
 */
include_once('vendor/autoload.php');

class OnlineNotepadServer extends WebsocketDaemon
{
    private $currenttext = '';

    protected function onOpen($connectionId, $info)
    {//вызывается при соединении с новым клиентом
        $this->sendToClient($connectionId, $this->currenttext);
    }

    protected function onClose($connectionId)
    {//вызывается при закрытии соединения с существующим клиентом
    }

    protected function onMessage($connectionId, $data, $type)
    {//вызывается при получении сообщения от клиента
        if (!strlen($data)) {
            return;
        }
        //var_export($data);
        //шлем всем сообщение, о том, что пишет один из клиентов
        //echo $data . "\n";
        //$message = 'пользователь #' . $connectionId . ' (' . $this->pid . '): ' . strip_tags($data);
        echo 'New message:',PHP_EOL,'>>>>>>>>>>>>>',PHP_EOL,$data,PHP_EOL,'<<<<<<<<<<<<<<<<<<<',PHP_EOL;
        $this->currenttext = $data;
        foreach ($this->clients as $clientId => $client) {
            $this->sendToClient($clientId, $data);
        }
    }

}