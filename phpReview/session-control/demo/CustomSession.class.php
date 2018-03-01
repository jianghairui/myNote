<?php
/**
 * Created by PhpStorm.
 * User: JHR
 * Date: 2018/3/1
 * Time: 19:29
 */
function p($array) {
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}

/**
 * Class CustomSession 自定义会话控制-session入库,下面以mysql举例,实际最好使用Redis等缓存技术
 */
class CustomSession implements SessionHandlerInterface
{
    private $link;
    private $lifetime;

    public function open($save_path, $name)
    {
        $this->link = mysqli_connect('localhost','root','root') or die(mysqli_error($this->link));
        $this->lifetime = get_cfg_var('session.gc_maxlifetime');
        mysqli_set_charset($this->link,'utf8');
        mysqli_select_db($this->link,'session') or die(mysqli_error($this->link));
        if($this->link) {
            return true;
        }
        return false;
    }

    public function close()
    {
        mysqli_close($this->link);
        return true;
    }

    public function read($session_id)
    {
        $session_id = mysqli_escape_string($this->link,$session_id);
        $sql = "SELECT * FROM sessions WHERE session_id='{$session_id}' AND session_expires > " . time();
        $result = mysqli_query($this->link,$sql);
        if(mysqli_num_rows($result) == 1) {
            return mysqli_fetch_assoc($result)['session_data'];
        }
        return '';
    }

    public function write($session_id, $session_data)
    {
        $newExp = time()+$this->lifetime;
        $session_id = mysqli_escape_string($this->link,$session_id);
        $sql = "SELECT * FROM sessions WHERE session_id='{$session_id}'";
        $result = mysqli_query($this->link,$sql);
        if(mysqli_num_rows($result) == 1) {
            if(mysqli_fetch_assoc($result)['session_expires'] == $newExp) {
                return true;
            }
            $sql = "UPDATE sessions SET session_expires='{$newExp}',session_data='{$session_data}'";
        }else {
            $sql = "INSERT INTO sessions (session_id,session_expires,session_data) VALUES ('{$session_id}',{$newExp},'{$session_data}')";
        }
        mysqli_query($this->link,$sql);
        return mysqli_affected_rows($this->link)==1;
    }

    public function gc($maxlifetime)
    {
        $sql = "DELETE FROM sessions WHERE session_expires < " . time();
        mysqli_query($this->link,$sql);
        if(mysqli_affected_rows($this->link) > 0) {
            return true;
        }
        return false;
    }

    public function destroy($session_id)
    {
        $session_id = mysqli_escape_string($this->link,$session_id);
        $sql = "DELETE FROM sessions WHERE session_id='{$session_id}'";
        mysqli_query($this->link,$sql);
        return mysqli_affected_rows($this->link)==1;
    }
}