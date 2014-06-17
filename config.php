<?php

class Config
{
    private $_data = array();

    public function __construct($data)
    {
        $this->_data = $data;
    }

    public function getValue($v)
    {
        return '__' . $v . '__';
    }

    public function __toArray($flip = false)
    {
        $a = array();
        uksort($this->_data, array($this, '_sortKey'));
        foreach ($this->_data as $k => $v) {
            $a[$k] = $this->getValue($v);
            if (strtolower($k) !== $k) {
                $a[strtolower($k)] = $this->getValue(str_replace('name', 'lowcase_name', $v));
            }
        }
        if ($flip) {
            return array_flip($a);
        }
        return $a;
    }

    private function _sortKey($a, $b)
    {
        return strlen($a) < strlen($b);
    }
}

