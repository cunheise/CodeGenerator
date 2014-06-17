<?php

class Config
{
    private $_data = array();
    private $_baseDir;
    private $_releaseDir;
    private $_isFlip = false;

    public function __construct($data, $baseDir = './src', $releaseDir = './tpl', $isFlip = false)
    {
        $this->_data = $data;
        $this->_baseDir = $baseDir;
        $this->_releaseDir = $releaseDir;
        $this->_isFlip = $isFlip;
    }

    public function getBaseDir()
    {
        return $this->_baseDir;
    }

    public function getReleaseDir()
    {
        return $this->_releaseDir;
    }

    public function getValue($v)
    {
        return '__' . $v . '__';
    }

    public function __toArray()
    {
        $a = array();
        uksort($this->_data, array($this, '_sortKey'));
        foreach ($this->_data as $k => $v) {
            $a[$k] = $this->getValue($v);
            if (strtolower($k) !== $k) {
                $a[strtolower($k)] = $this->getValue(str_replace('name', 'lowcase_name', $v));
            }
        }
        if ($this->_isFlip) {
            return array_flip($a);
        }
        return $a;
    }

    private function _sortKey($a, $b)
    {
        return strlen($a) < strlen($b);
    }
}

