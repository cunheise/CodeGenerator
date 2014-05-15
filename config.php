<?php

//class Config
//{
//    public function toArray()
//    {
//
//    }
//}
//
//$package_name = 'Joomlacreator';
//$module_name = 'Slideshow';
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

    public function __toArray()
    {
        $a = array();
        foreach ($this->_data as $k => $v) {
            $a[$k] = $this->getValue($v);
            if (strtolower($k) !== $k) {
                $a[strtolower($k)] = $this->getValue(str_replace('name', 'lowcase_name', $v));
            }
        }
        return $a;
    }
}

$config = new Config(array(
    'Joomlacreator' => 'package_name',
    'Slideshow' => 'module_name',
    'community' => 'code_pool',
    '0.0.1' => 'version',
    'Item' => 'model_name',
    'Image' => 'attribute_name_1',
    'Url' => 'attribute_name_2',
));
$config = new Config(array(
    'Joomlacreator' => 'package_name',
    'Celebrity' => 'module_name',
    'community' => 'code_pool',
    '0.0.1' => 'version',
    'Profile' => 'model_name',
    'Photo' => 'attribute_name_1',
    'Fullname' => 'attribute_name_2',
));
//return $config->__toArray();
return array_flip($config->__toArray());