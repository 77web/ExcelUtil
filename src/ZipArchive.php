<?php


namespace Nanaweb\ExcelUtil;


class ZipArchive
{
    private $contents = [];

    private $zip;

    public function __construct($path = null)
    {
        $this->contents = [];
        $this->zip = new \ZipArchive;
        if (null !== $path) {
            $this->zip->open($path);
        }
    }

    public function open($path)
    {
        $this->zip->open($path);
    }

    public function getFromName($name)
    {
        if (!isset($this->contents[$name])) {
            $this->contents[$name] = $this->zip->getFromName($name);
        }

        return $this->contents[$name];
    }

    public function addFromString($name, $content)
    {
        $this->contents[$name] = $content;
    }

    public function close()
    {
        foreach ($this->contents as $name => $content) {
            $this->zip->addFromString($name, $content);
        }

        return $this->zip->close();
    }
}
