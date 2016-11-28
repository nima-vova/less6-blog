<?php

namespace Nima\BlogBundle;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class NimaGetAndPutFile
{
    private $fileName='less7.json';
    public $paramJson;

    public function nimaGetFile()
    {
        return file_get_contents($this->fileName);
    }
    public function nimaPutFile($paramJson)
    {
        file_put_contents($this->fileName, $paramJson);
    }
}