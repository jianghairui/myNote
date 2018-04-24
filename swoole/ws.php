<?php
/**
 * Created by PhpStorm.
 * User: 凯拓
 * Date: 2018/4/23
 * Time: 15:00
 */
class Ws
{
    CONST HOST = '0.0.0.0';
    CONST PORT = 9502;
    public $ws = NULL;

    public function __construct() {
        $this->ws = new swoole_websocket_server(self::HOST, self::PORT);

        $this->ws->set(array(
            'worker_num' => 2,
            'task_worker_num' => 2
        ));
        //监听WebSocket连接事件
        $this->ws->on('open', array($this,'onOpen'));
        //监听WebSocket消息事件
        $this->ws->on('message', array($this,'onMessage'));

        $this->ws->on('task', [$this, 'onTask']);

        $this->ws->on('finish', [$this, 'onFinish']);
        //监听WebSocket连接关闭事件
        $this->ws->on('close', array($this,'onClose'));
        //启动
        $this->ws->start();
    }

    public function onOpen($ws, $request) {
        echo "clientId:" . $request->fd . " 已连接\n";
        $ws->push($request->fd, "fd:" . $request->fd . "已连接");
    }

    public function onMessage($ws, $frame) {
        $arr = explode('::',$frame->data);
        //todo 10s task
//        $data = array(
//            'task' => 1,
//            'fd' => $frame->fd
//        );
//        $ws->task($data);
        try{
            $ws->push($arr[0], $arr[1]);
        }catch (Exception $e) {
            echo 'LALLALA';
        }
    }

    public function onTask($serv,$taskId,$workerId,$data) {
        print_r($data);
        sleep(10);
        return 'on task finish';//return to onFinish
    }

    public function onFinish($serv,$taskId,$data) {
        echo "taskId:{$taskId}\n";
        echo "finish-data-success:{$data}\n";
    }

    public function onClose($ws, $fd) {
        echo "clientId-{$fd} is closed\n";
    }

}
$ws = new Ws();