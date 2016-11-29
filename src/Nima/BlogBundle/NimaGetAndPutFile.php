<?php

namespace Nima\BlogBundle;

class NimaGetAndPutFile
{
    private $fileName = '/less7_test.json';
    public $paramJson;
    /**
     * @return string
     */
    public function nimaGetFile()
    {
        return file_get_contents(sys_get_temp_dir().$this->fileName);
    }
    /**
     * @param string $paramJson
     *
     * @return object
     */
    public function nimaPutFile($paramJson)
    {
        return file_put_contents(sys_get_temp_dir().$this->fileName, $paramJson);
    }
}
