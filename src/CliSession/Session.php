<?php

namespace InsulinJunkieDe\CliSession;

class Session
{
    private $handler;


    public function __construct($saveFile = null, $savePath = null)
    {
      $this->handler = new SessionHandler($saveFile, $savePath);
      session_set_save_handler($this->handler, true);
      session_start();
    }

    public function getParam($param){
      if(!array_key_exists($param, $_SESSION)){
        return null;
      }
      return $_SESSION[$param];
    }


    public function setParam($param, $value){
      return $_SESSION[$param] = $value;
    }

    public function getAll(){
      return $_SESSION;
    }

}
