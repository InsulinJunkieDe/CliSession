<?php

namespace InsulinJunkieDe\CliSession;

class SessionHandler implements \SessionHandlerInterface
{
    private $savePath;
    private $saveFile;

    public function __construct($saveFile = null, $savePath = null)
    {
        if(!is_null($saveFile)){
            $this->setSaveFile($saveFile);
        }
        if(!is_null($savePath)){
            $this->setSavePath($savePath);
        }
    }

    public function setSavePath($savePath){
        $this->savePath = $savePath;
        if (!is_dir($this->savePath)) {
            if(!mkdir($this->savePath, 0777)){
                throw new \Exception('Directory ('.$this->savePath.')can\'t be created');
            }
        }
        return true;
    }
    
    public function getSavePath(){
        return $this->savePath;
    }

    public function setSaveFile($saveFile){
        $this->saveFile = $saveFile;
        return true;
    }

    public function getSaveFile(){
        return $this->saveFile;
    }


    public function open($savePath, $sessionName)
    {
        if(empty($this->savePath)){
            $this->setSavePath($savePath);
        }   

        return true;
    }

    public function close()
    {
        return true;
    }

    public function read($id)
    {
        $fullPath = $this->getSavePath() . DIRECTORY_SEPARATOR . $this->getSaveFile();
        if(!file_exists($fullPath)){
            return "";
        }
        return (string) file_get_contents($fullPath);
    }

    public function write($id, $data)
    {
        if(empty($this->saveFile)){
            $this->setSaveFile('sess_'.$id);
        }
        $fullPath = $this->getSavePath() . DIRECTORY_SEPARATOR . $this->getSaveFile();
        if(!empty($data)){
            if(!file_put_contents($fullPath, $data)){
                throw new \Exception('Session data could not be written into ' . $fullPath);
            }
        }
        return true;
    }

    public function destroy($id)
    {
        $fullPath = $this->getSavePath() . DIRECTORY_SEPARATOR . $this->getSaveFile();
        if (file_exists($fullPath)) {
            unlink($fullPath);
        }

        return true;
    }

    public function gc($maxlifetime)
    {
        return true;
    }
}
